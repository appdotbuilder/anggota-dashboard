<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanItem>
 */
class LoanItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            ['name' => 'Pinjaman TV', 'code' => 'PMK-TV'],
            ['name' => 'Pinjaman Kulkas', 'code' => 'PMK-KLK'],
            ['name' => 'Furnitur Sofa', 'code' => 'PMK-SF'],
            ['name' => 'Pinjaman Motor', 'code' => 'PMK-MTR'],
            ['name' => 'Elektronik AC', 'code' => 'PMK-AC'],
        ];

        $item = $this->faker->randomElement($items);

        return [
            'member_id' => Member::factory(),
            'name' => $item['name'],
            'code' => $item['code'] . $this->faker->numerify('##'),
            'amount' => $this->faker->numberBetween(1000000, 10000000),
        ];
    }
}