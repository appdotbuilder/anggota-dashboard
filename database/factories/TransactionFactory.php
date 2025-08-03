<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactions = [
            [
                'title' => 'Angsuran Pinjaman (PMK-TV42)',
                'subtitle' => 'TV LED 42"',
                'type' => 'expense'
            ],
            [
                'title' => 'Simpanan Wajib',
                'subtitle' => 'Bulan ' . $this->faker->monthName(),
                'type' => 'income'
            ],
            [
                'title' => 'Bunga Simpanan',
                'subtitle' => 'Bunga ' . $this->faker->monthName(),
                'type' => 'income'
            ],
            [
                'title' => 'Angsuran Pinjaman (PMK-KLK01)',
                'subtitle' => 'Kulkas 2 Pintu',
                'type' => 'expense'
            ],
        ];

        $transaction = $this->faker->randomElement($transactions);

        return [
            'member_id' => Member::factory(),
            'title' => $transaction['title'],
            'subtitle' => $transaction['subtitle'],
            'amount' => $this->faker->numberBetween(10000, 500000),
            'type' => $transaction['type'],
        ];
    }
}