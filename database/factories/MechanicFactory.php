<?php

namespace Database\Factories;

use App\Models\Mechanic;
use Illuminate\Database\Eloquent\Factories\Factory;

class MechanicFactory extends Factory
{
    protected $model = Mechanic::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'status' => 1,
            'experience' => $this->faker->numberBetween(1, 20),
            'rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
