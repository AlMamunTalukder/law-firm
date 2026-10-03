<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'branch_id' => fake()->numberBetween(1,6),
            'acc_class_id' => fake()->numberBetween(1,5),
            'status' => fake()->numberBetween(1,1),
            'photo'=>'student/default.jpg'
        ];
    }
}
