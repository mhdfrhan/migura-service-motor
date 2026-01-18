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
        // MySQL doesn't support ALTER ENUM directly, so we need to modify the column
        \DB::statement("ALTER TABLE loyalty_transactions MODIFY COLUMN type ENUM('earned', 'redeemed', 'expired', 'adjusted', 'progress') DEFAULT 'earned'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'progress' from enum
        \DB::statement("ALTER TABLE loyalty_transactions MODIFY COLUMN type ENUM('earned', 'redeemed', 'expired', 'adjusted') DEFAULT 'earned'");
    }
};
