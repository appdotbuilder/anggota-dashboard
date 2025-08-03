<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // For demo purposes, get the first member or create a sample one
        $member = Member::with(['loanItems', 'transactions' => function ($query) {
            $query->latest()->limit(5);
        }])->first();

        if (!$member) {
            // Create sample data if none exists
            $member = Member::create([
                'member_number' => '12345',
                'name' => 'Anggota',
                'savings_pokok' => 500000,
                'savings_wajib' => 15000,
                'savings_sukarela' => 8750000,
                'total_loans' => 10500000,
                'notifications_count' => 3,
            ]);

            // Create sample loan items
            $member->loanItems()->createMany([
                ['name' => 'Pinjaman TV', 'code' => 'PMK-TV42', 'amount' => 2500000],
                ['name' => 'Pinjaman Kulkas', 'code' => 'PMK-KLK01', 'amount' => 3000000],
                ['name' => 'Furnitur Sofa', 'code' => 'PMK-SF15', 'amount' => 5000000],
            ]);

            // Create sample transactions
            $member->transactions()->createMany([
                [
                    'title' => 'Angsuran Pinjaman (PMK-TV42)',
                    'subtitle' => 'TV LED 42"',
                    'amount' => 154000,
                    'type' => 'expense'
                ],
                [
                    'title' => 'Simpanan Wajib',
                    'subtitle' => 'Bulan Januari 2024',
                    'amount' => 15000,
                    'type' => 'income'
                ],
                [
                    'title' => 'Angsuran Pinjaman (PMK-KLK01)',
                    'subtitle' => 'Kulkas 2 Pintu',
                    'amount' => 125000,
                    'type' => 'expense'
                ],
                [
                    'title' => 'Bunga Simpanan',
                    'subtitle' => 'Bunga Desember 2023',
                    'amount' => 87500,
                    'type' => 'income'
                ],
            ]);

            // Reload with relationships
            $member = $member->load(['loanItems', 'transactions' => function ($query) {
                $query->latest()->limit(5);
            }]);
        }

        // Get promotional products
        $promotionalProducts = Product::whereIn('status', ['promo', 'baru'])
            ->latest()
            ->limit(3)
            ->get();

        // Create sample products if none exist
        if ($promotionalProducts->isEmpty()) {
            Product::create(['name' => 'TV LED 55"', 'price' => 5999000, 'status' => 'promo']);
            Product::create(['name' => 'Kulkas 2 Pintu', 'price' => 3299000, 'status' => 'baru']);
            Product::create(['name' => 'Mesin Cuci 8kg', 'price' => 2799000, 'status' => 'promo']);

            $promotionalProducts = Product::whereIn('status', ['promo', 'baru'])
                ->latest()
                ->limit(3)
                ->get();
        }

        return Inertia::render('welcome', [
            'member' => $member,
            'promotionalProducts' => $promotionalProducts,
        ]);
    }
}