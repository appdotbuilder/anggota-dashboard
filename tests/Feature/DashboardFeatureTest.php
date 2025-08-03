<?php

use App\Models\Member;
use App\Models\Product;
use App\Models\LoanItem;
use App\Models\Transaction;

it('displays member information correctly', function () {
    // Create a member with related data
    $member = Member::factory()->create([
        'member_number' => '12345',
        'name' => 'Test Member',
        'savings_pokok' => 500000,
        'savings_wajib' => 15000,
        'savings_sukarela' => 8750000,
        'total_loans' => 10500000,
        'notifications_count' => 3,
    ]);

    // Create loan items
    LoanItem::factory()->create([
        'member_id' => $member->id,
        'name' => 'Pinjaman TV',
        'amount' => 2500000,
    ]);

    // Create transactions
    Transaction::factory()->create([
        'member_id' => $member->id,
        'title' => 'Test Transaction',
        'amount' => 100000,
        'type' => 'income',
    ]);

    // Create promotional products
    Product::create([
        'name' => 'TV LED 55"',
        'price' => 5999000,
        'status' => 'promo',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('welcome')
            ->has('member')
            ->has('promotionalProducts')
            ->where('member.member_number', '12345')
            ->where('member.name', 'Test Member')
    );
});

it('creates sample data when no member exists', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    // Check that a member was created
    $this->assertDatabaseHas('members', [
        'member_number' => '12345',
        'name' => 'Anggota',
    ]);

    // Check that loan items were created
    $this->assertDatabaseHas('loan_items', [
        'name' => 'Pinjaman TV',
    ]);

    // Check that transactions were created
    $this->assertDatabaseHas('transactions', [
        'title' => 'Angsuran Pinjaman (PMK-TV42)',
    ]);

    // Check that products were created
    $this->assertDatabaseHas('products', [
        'name' => 'TV LED 55"',
    ]);
});

it('tests member model relationships', function () {
    $member = Member::factory()->create();
    
    $loanItem = LoanItem::factory()->create(['member_id' => $member->id]);
    $transaction = Transaction::factory()->create(['member_id' => $member->id]);

    expect($member->loanItems->contains($loanItem))->toBeTrue();
    expect($member->transactions->contains($transaction))->toBeTrue();
    expect($loanItem->member->id)->toBe($member->id);
    expect($transaction->member->id)->toBe($member->id);
});

it('calculates member total savings correctly', function () {
    $member = Member::factory()->create([
        'savings_pokok' => 500000,
        'savings_wajib' => 15000,
        'savings_sukarela' => 8750000,
    ]);

    $expectedTotal = 500000 + 15000 + 8750000;
    expect($member->total_savings)->toBe((float)$expectedTotal);
});