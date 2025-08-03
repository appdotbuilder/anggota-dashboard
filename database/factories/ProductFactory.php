<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'TV LED 55"',
            'Kulkas 2 Pintu',
            'Mesin Cuci 8kg',
            'AC 1 PK',
            'Sofa 3 Dudukan',
            'Meja Makan Set',
            'Lemari Pakaian',
            'Smartphone Android',
        ];

        return [
            'name' => $this->faker->randomElement($products),
            'price' => $this->faker->numberBetween(1000000, 10000000),
            'status' => $this->faker->randomElement(['promo', 'baru', 'regular']),
        ];
    }
}