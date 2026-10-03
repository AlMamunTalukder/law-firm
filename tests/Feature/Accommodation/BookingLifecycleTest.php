<?php

namespace Tests\Feature\Accommodation;

use Tests\TestCase;
use App\Models\User;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\Maintenance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Services\Accommodation\AvailabilityService;

class BookingLifecycleTest extends TestCase
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

    private function createRoomType(): RoomType
    {
        return RoomType::create([
            'name' => 'Deluxe ' . uniqid(),
            'slug' => 'deluxe-' . uniqid(),
            'capacity' => 2,
            'adult_capacity' => 2,
            'child_capacity' => 1,
            'base_price' => 5000,
            'status' => 1,
        ]);
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

    private function createGuest(): Guest
    {
        return Guest::create([
            'full_name' => 'Test Guest',
            'mobile' => '017' . rand(10000000, 99999999),
            'email' => 'guest' . uniqid() . '@test.com',
        ]);
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
            'booking_status' => 'PENDING',
        ];
        return Booking::create(array_merge($defaults, $overrides));
    }

    public function test_check_in_state_transition(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'AVAILABLE']);
        $guest = $this->createGuest();
        $booking = $this->createBooking($room, $guest, ['booking_status' => 'PENDING']);

        $this->assertEquals('PENDING', $booking->booking_status);
        $this->assertEquals('AVAILABLE', $room->status);

        // PENDING -> CONFIRMED
        $resp1 = $this->post(route('admin.accommodation.bookings.status', $booking->id), [
            'booking_status' => 'CONFIRMED',
        ]);
        $resp1->assertSessionHasNoErrors();
        $booking->refresh();
        $this->assertEquals('CONFIRMED', $booking->booking_status);

        // CONFIRMED -> CHECKED_IN via checkIn route, Room should become OCCUPIED
        $resp2 = $this->post(route('admin.accommodation.bookings.checkin', $booking->id));
        $resp2->assertSessionHasNoErrors();

        $booking->refresh();
        $room->refresh();
        $this->assertEquals('CHECKED_IN', $booking->booking_status, 'Booking should be CHECKED_IN after check-in');
        $this->assertEquals('OCCUPIED', $room->status, 'Room status should be OCCUPIED after check-in');
    }

    public function test_check_out_state_transition(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'OCCUPIED']);
        $guest = $this->createGuest();
        // CHECKED_IN booking with no due
        $booking = $this->createBooking($room, $guest, [
            'booking_status' => 'CHECKED_IN',
            'paid_amount' => 25000,
            'due_amount' => 0,
            'grand_total' => 25000,
            'payment_status' => 'PAID',
        ]);

        $resp = $this->post(route('admin.accommodation.bookings.checkout', $booking->id));
        $resp->assertSessionHasNoErrors();

        $booking->refresh();
        $room->refresh();
        $this->assertEquals('CHECKED_OUT', $booking->booking_status, 'Booking should be CHECKED_OUT after checkout');
        $this->assertEquals('CLEANING', $room->status, 'Room should be CLEANING after checkout');

        // Test checkout fails when due >0
        $room2 = $this->createRoom($type, ['status' => 'OCCUPIED', 'room_number' => 'R-' . uniqid()]);
        $bookingDue = $this->createBooking($room2, $guest, [
            'booking_status' => 'CHECKED_IN',
            'grand_total' => 10000,
            'paid_amount' => 4000,
            'due_amount' => 6000,
            'payment_status' => 'PARTIALLY_PAID',
        ]);
        $respDue = $this->post(route('admin.accommodation.bookings.checkout', $bookingDue->id));
        $respDue->assertSessionHasErrors(['due_amount']);
        $bookingDue->refresh();
        $this->assertEquals('CHECKED_IN', $bookingDue->booking_status, 'Should not checkout with due >0');
    }

    public function test_room_cleaning_to_available(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'CLEANING']);

        $resp = $this->post(route('admin.accommodation.rooms.cleaned', $room->id));
        $resp->assertSessionHasNoErrors();

        $room->refresh();
        $this->assertEquals('AVAILABLE', $room->status, 'CLEANING room should become AVAILABLE after cleaned');

        // Only CLEANING can be marked available via this endpoint
        $roomAvailable = $this->createRoom($type, ['status' => 'AVAILABLE', 'room_number' => 'R-' . uniqid()]);
        $respFail = $this->post(route('admin.accommodation.rooms.cleaned', $roomAvailable->id));
        $respFail->assertSessionHasErrors(['status']);
        $roomAvailable->refresh();
        $this->assertEquals('AVAILABLE', $roomAvailable->status, 'AVAILABLE room should stay AVAILABLE');
    }

    public function test_maintenance_completion_auto_available(): void
    {
        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['status' => 'MAINTENANCE']);
        $guest = $this->createGuest();

        // Create maintenance IN_PROGRESS -> should set room to MAINTENANCE (already)
        $maintenance = Maintenance::create([
            'room_id' => $room->id,
            'issue_title' => 'AC repair',
            'description' => 'AC not cooling',
            'priority' => 'HIGH',
            'status' => 'IN_PROGRESS',
            'reported_date' => now()->toDateString(),
        ]);

        $room->refresh();
        $this->assertEquals('MAINTENANCE', $room->status, 'Room should be MAINTENANCE when maintenance IN_PROGRESS');

        // Update to COMPLETED -> auto AVAILABLE via booted hook
        $maintenance->update(['status' => 'COMPLETED']);

        $room->refresh();
        $this->assertEquals('AVAILABLE', $room->status, 'Room should be AVAILABLE after maintenance COMPLETED');

        // Also test via controller update flow for REPORTED -> IN_PROGRESS -> COMPLETED
        $room2 = $this->createRoom($type, ['status' => 'AVAILABLE', 'room_number' => 'R-' . uniqid()]);
        $admin = $this->createAdmin();
        $this->actingAs($admin);
        $maint2 = Maintenance::create([
            'room_id' => $room2->id,
            'issue_title' => 'Plumbing',
            'priority' => 'MEDIUM',
            'status' => 'REPORTED',
            'reported_date' => now()->toDateString(),
        ]);
        // Update via model to IN_PROGRESS should set MAINTENANCE
        $maint2->update(['status' => 'IN_PROGRESS']);
        $room2->refresh();
        $this->assertEquals('MAINTENANCE', $room2->status);

        $maint2->update(['status' => 'COMPLETED']);
        $room2->refresh();
        $this->assertEquals('AVAILABLE', $room2->status, 'Maintenance completion should auto set room AVAILABLE');
    }

    public function test_duplicate_booking_race_condition(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $type = $this->createRoomType();
        $room = $this->createRoom($type, ['price' => 4000, 'status' => 'AVAILABLE']);
        $guest1 = $this->createGuest();
        $guest2 = Guest::create([
            'full_name' => 'Second Guest',
            'mobile' => '018' . rand(10000000, 99999999),
            'email' => 'guest2' . uniqid() . '@test.com',
        ]);

        $bookingData1 = [
            'guest_id' => $guest1->id,
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'adults' => 2,
            'children' => 0,
            'guests_count' => 2,
            'discount' => 0,
            'tax' => 0,
            'service_charge' => 0,
            'paid_amount' => 0,
            'booking_status' => 'CONFIRMED',
            'created_by' => $admin->id,
        ];

        $bookingData2 = [
            'guest_id' => $guest2->id,
            'room_id' => $room->id,
            'check_in' => '2026-09-10',
            'check_out' => '2026-09-15',
            'adults' => 1,
            'children' => 0,
            'guests_count' => 1,
            'discount' => 0,
            'tax' => 0,
            'service_charge' => 0,
            'paid_amount' => 0,
            'booking_status' => 'PENDING',
            'created_by' => $admin->id,
        ];

        // First booking should succeed using DB::transaction + lockForUpdate
        $first = AvailabilityService::createBookingWithLock($bookingData1);
        $this->assertNotNull($first->id, 'First booking should be created');
        $this->assertDatabaseHas('bookings', ['id' => $first->id, 'room_id' => $room->id]);

        // Second overlapping booking should throw exception due to lock + availability check
        $exceptionThrown = false;
        try {
            DB::transaction(function () use ($room, $bookingData2) {
                // Explicitly demonstrate lockForUpdate usage as per spec
                $lockedRoom = Room::where('id', $room->id)->lockForUpdate()->firstOrFail();
                if (!AvailabilityService::isRoomAvailable($lockedRoom->id, $bookingData2['check_in'], $bookingData2['check_out'])) {
                    throw new \Exception("Room {$lockedRoom->room_number} is no longer available");
                }
                // Also test via service method which internally uses lockForUpdate
                AvailabilityService::createBookingWithLock($bookingData2);
            });
        } catch (\Exception $e) {
            $exceptionThrown = true;
            $this->assertStringContainsString('no longer available', $e->getMessage());
        }

        $this->assertTrue($exceptionThrown, 'Duplicate booking should throw exception due to race condition prevention');

        // Ensure only one booking exists for that room/dates
        $count = Booking::where('room_id', $room->id)
            ->where('check_in', '<', '2026-09-15')
            ->where('check_out', '>', '2026-09-10')
            ->whereNotIn('booking_status', ['CANCELLED', 'NO_SHOW'])
            ->count();
        $this->assertEquals(1, $count, 'Only one active booking should exist for overlapping dates');

        // Direct service call also should fail
        $this->expectException(\Exception::class);
        AvailabilityService::createBookingWithLock($bookingData2);
    }
}
