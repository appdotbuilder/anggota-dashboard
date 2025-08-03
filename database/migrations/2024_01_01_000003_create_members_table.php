<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_number')->unique()->comment('Member identification number');
            $table->string('name')->comment('Member full name');
            $table->decimal('savings_pokok', 15, 2)->default(0)->comment('Pokok savings amount');
            $table->decimal('savings_wajib', 15, 2)->default(0)->comment('Wajib savings amount');
            $table->decimal('savings_sukarela', 15, 2)->default(0)->comment('Sukarela savings amount');
            $table->decimal('total_loans', 15, 2)->default(0)->comment('Total loan amount');
            $table->integer('notifications_count')->default(0)->comment('Unread notifications count');
            $table->timestamps();
            
            // Indexes
            $table->index('member_number');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};