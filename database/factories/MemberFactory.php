<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_number' => $this->faker->unique()->numerify('#####'),
            'name' => $this->faker->name(),
            'savings_pokok' => $this->faker->numberBetween(100000, 1000000),
            'savings_wajib' => $this->faker->numberBetween(10000, 50000),
            'savings_sukarela' => $this->faker->numberBetween(500000, 10000000),
            'total_loans' => $this->faker->numberBetween(1000000, 20000000),
            'notifications_count' => $this->faker->numberBetween(0, 10),
        ];
    }
}