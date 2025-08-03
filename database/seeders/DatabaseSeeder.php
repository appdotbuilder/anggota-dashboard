<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\LoanItem;
use App\Models\Transaction;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create sample cooperative member
        $member = Member::factory()->create([
            'member_number' => '12345',
            'name' => 'Anggota',
            'savings_pokok' => 500000,
            'savings_wajib' => 15000,
            'savings_sukarela' => 8750000,
            'total_loans' => 10500000,
            'notifications_count' => 3,
        ]);

        // Create loan items for the member
        LoanItem::factory()->createMany([
            [
                'member_id' => $member->id,
                'name' => 'Pinjaman TV',
                'code' => 'PMK-TV42',
                'amount' => 2500000,
            ],
            [
                'member_id' => $member->id,
                'name' => 'Pinjaman Kulkas',
                'code' => 'PMK-KLK01',
                'amount' => 3000000,
            ],
            [
                'member_id' => $member->id,
                'name' => 'Furnitur Sofa',
                'code' => 'PMK-SF15',
                'amount' => 5000000,
            ],
        ]);

        // Create transactions for the member
        Transaction::factory()->createMany([
            [
                'member_id' => $member->id,
                'title' => 'Angsuran Pinjaman (PMK-TV42)',
                'subtitle' => 'TV LED 42"',
                'amount' => 154000,
                'type' => 'expense',
            ],
            [
                'member_id' => $member->id,
                'title' => 'Simpanan Wajib',
                'subtitle' => 'Bulan Januari 2024',
                'amount' => 15000,
                'type' => 'income',
            ],
            [
                'member_id' => $member->id,
                'title' => 'Angsuran Pinjaman (PMK-KLK01)',
                'subtitle' => 'Kulkas 2 Pintu',
                'amount' => 125000,
                'type' => 'expense',
            ],
            [
                'member_id' => $member->id,
                'title' => 'Bunga Simpanan',
                'subtitle' => 'Bunga Desember 2023',
                'amount' => 87500,
                'type' => 'income',
            ],
        ]);

        // Create promotional products
        Product::factory()->create([
            'name' => 'TV LED 55"',
            'price' => 5999000,
            'status' => 'promo',
        ]);

        Product::factory()->create([
            'name' => 'Kulkas 2 Pintu',
            'price' => 3299000,
            'status' => 'baru',
        ]);

        Product::factory()->create([
            'name' => 'Mesin Cuci 8kg',
            'price' => 2799000,
            'status' => 'promo',
        ]);
    }
}
