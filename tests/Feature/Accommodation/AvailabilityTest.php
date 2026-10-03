<?php

namespace Tests\Feature\Accommodation;

use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\RoomType;
use App\Services\Accommodation\AvailabilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AvailabilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }

    private function createAdmin(): User
    {
        $role = Role::findOrCreate('Super Admin', 'web');
        $user = User::factory()->create();
        $user->assignRole($role);
        return $user;
    }

    private function createRoomType(array $overrides = []): RoomType
    {
        return RoomType::create(array_merge([
            'name' => 'Deluxe ' . uniqid(),
            'slug' => 'deluxe-' . uniqid(),
            'capacity' => 2,
            'adult_capacity' => 2,
            'child_capacity' => 1,
            'base_price' => 5000,
            'status' => 1,
        ], $overrides));
    }

    private function createRoom(RoomType $type, array $overrides = []): Room
    {
        return Room::create(array_merge([
            'room_type_id' => $type->id,
            'room_number' => 'R-' . uniqid(),
            'name' => 'Room ' . uniqid(),
            'capacity' => 2,
            'price' => 5000,
            'status' => 'AVAILABLE',
        ], $overrides));
    }

    private function createGuest(array $overrides = []): Guest
    {
        return Guest::create(array_merge([
            'full_name' => 'Test Guest',
            'mobile' => '017' . rand(10000000, 99999999),
            'email' => 'guest' . uniqid() . '@test.com',
        ], $overrides));
    }

    private function createBooking(Room $room, Guest $guest, array $overrides = []): Booking
    {
        $checkIn = $overrides['check_in'] ?? '2026-09-10';
        $checkOut = $overrides['check_out'] ?? '2026-09-15';
        $nights = (new \DateTime($checkIn))->diff(new \DateTime($checkOut))->days;
        $defaults = [
            'guest_id' => $guest->id,
            'room_id' => $room->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'adults' => 2,
            'children' => 0,
            'guests_count' => 2,
            'nights' => $nights,
            'room_rate' => 5000,
            'subtotal' => 5000 * $nights,
            'discount' => 0,
            'tax' => 0,
            'service_charge' => 0,
            'grand_total' => 5000 * $nights,
            'paid_amount' => 0,
            'due_amount' => 5000 * $nights,
            'payment_status' => 'UNPAID',
            'booking_status' => 'CONFIRMED',
        ];
        return Booking::create(array_merge($defaults, $overrides));
    }

    public function test_available_room_search_returns_only_available(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $type = $this->createRoomType();
        $roomAvailable1 = $this->createRoom($type, ['room_number' => 'AV-101', 'status' => 'AVAILABLE', 'capacity' => 2]);
        $roomAvailable2 = $this->createRoom($type, ['room_number' => 'AV-102', 'status' => 'AVAILABLE', 'capacity' => 2]);
        $roomBooked = $this->createRoom($type, ['room_number' => 'AV-103', 'status' => 'AVAILABLE', 'capacity' => 2]);
        $guest = $this->createGuest();

        $this->createBooking($roomBooked, $guest, [
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'booking_status' => 'CONFIRMED',
        ]);

        $results = AvailabilityService::searchAvailableRooms('2026-09-10', '2026-09-15', 2);

        $ids = $results->pluck('id')->toArray();
        $this->assertContains($roomAvailable1->id, $ids, 'Available room 1 should be returned');
        $this->assertContains($roomAvailable2->id, $ids, 'Available room 2 should be returned');
        $this->assertNotContains($roomBooked->id, $ids, 'Booked room should not be returned');
        $this->assertCount(2, $results);
    }

    public function test_overlapping_booking_prevention(): void
    {
        $type = $this->createRoomType();
        $room = $this->createRoom($type);
        $guest = $this->createGuest();

        $this->createBooking($room, $guest, [
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'booking_status' => 'CONFIRMED',
        ]);

        // Overlapping cases should be NOT available (isRoomAvailable = false)
        // condition: checkIn < requestedCheckOut AND checkOut > requestedCheckIn
        $overlapping = [
            ['2026-09-12', '2026-09-17'], // overlaps end
            ['2026-09-08', '2026-09-12'], // overlaps start
            ['2026-09-11', '2026-09-14'], // inside
            ['2026-09-10', '2026-09-15'], // exact same
            ['2026-09-08', '2026-09-20'], // contains
        ];

        foreach ($overlapping as [$ci, $co]) {
            $this->assertFalse(
                Booking::isRoomAvailable($room->id, $ci, $co),
                "Failed asserting overlapping [$ci - $co] should NOT be available"
            );
            $this->assertFalse(
                AvailabilityService::isRoomAvailable($room->id, $ci, $co),
                "Service should block overlapping [$ci - $co]"
            );
        }

        // Adjacent bookings should be available (no overlap)
        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-15', '2026-09-20'), 'Adjacent after should be available');
        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-05', '2026-09-10'), 'Adjacent before should be available');
        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-16', '2026-09-18'), 'Non-overlapping later should be available');
        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-01', '2026-09-05'), 'Non-overlapping earlier should be available');
    }

    public function test_cancelled_booking_does_not_block(): void
    {
        $type = $this->createRoomType();
        $room = $this->createRoom($type);
        $guest = $this->createGuest();

        $this->createBooking($room, $guest, [
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'booking_status' => 'CANCELLED',
        ]);

        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-10', '2026-09-15'), 'Cancelled booking should not block');
        $this->assertTrue(Booking::isRoomAvailable($room->id, '2026-09-12', '2026-09-14'), 'Cancelled booking inner range should not block');
        $this->assertTrue(AvailabilityService::isRoomAvailable($room->id, '2026-09-10', '2026-09-15'));

        // search should return room
        $results = AvailabilityService::searchAvailableRooms('2026-09-10', '2026-09-15', 1);
        $this->assertTrue($results->contains('id', $room->id), 'Cancelled booking room should appear in search');

        // NO_SHOW also should not block
        $room2 = $this->createRoom($type, ['room_number' => 'NS-'.uniqid()]);
        $this->createBooking($room2, $guest, [
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'booking_status' => 'NO_SHOW',
        ]);
        $this->assertTrue(Booking::isRoomAvailable($room2->id, '2026-09-10', '2026-09-15'), 'NO_SHOW should not block');
    }

    public function test_maintenance_room_cannot_be_booked(): void
    {
        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'MAINTENANCE']);
        $guest = $this->createGuest();

        $this->assertFalse(AvailabilityService::isRoomAvailable($room->id, '2026-09-10', '2026-09-15'), 'MAINTENANCE room cannot be booked');

        $results = AvailabilityService::searchAvailableRooms('2026-09-10', '2026-09-15', 1);
        $this->assertFalse($results->contains('id', $room->id), 'MAINTENANCE room should not appear in search');

        $errors = AvailabilityService::validateBookingData([
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'guests_count' => 1,
        ]);
        $this->assertNotEmpty($errors, 'Validation should fail for MAINTENANCE room');
    }

    public function test_blocked_room_cannot_be_booked(): void
    {
        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'BLOCKED']);

        $this->assertFalse(AvailabilityService::isRoomAvailable($room->id, '2026-09-10', '2026-09-15'), 'BLOCKED room cannot be booked');

        $results = AvailabilityService::searchAvailableRooms('2026-09-10', '2026-09-15', 1);
        $this->assertFalse($results->contains('id', $room->id), 'BLOCKED room should not appear in search');

        $errors = AvailabilityService::validateBookingData([
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'guests_count' => 1,
        ]);
        $this->assertNotEmpty($errors);
        $this->assertStringContainsString('not available', implode(' ', $errors));
    }

    public function test_capacity_validation(): void
    {
        $type = $this->createRoomType(['capacity' => 2]);
        $room = $this->createRoom($type, ['capacity' => 2]);

        // guests_count 3 exceeds capacity 2
        $errors = AvailabilityService::validateBookingData([
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-12',
            'guests_count' => 3,
        ]);
        $this->assertContains('Room capacity exceeded', $errors);

        // exact capacity should pass
        $errorsOk = AvailabilityService::validateBookingData([
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-12',
            'guests_count' => 2,
        ]);
        $this->assertNotContains('Room capacity exceeded', $errorsOk, 'Exact capacity should not error');
        $this->assertEmpty($errorsOk, 'Exact capacity should have no errors when room available');

        // single guest should pass
        $errorsOne = AvailabilityService::validateBookingData([
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-12',
            'guests_count' => 1,
        ]);
        $this->assertEmpty($errorsOne);
    }
}
