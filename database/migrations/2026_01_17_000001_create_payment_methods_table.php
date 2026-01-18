<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('payment_methods', function (Blueprint $table) {
			$table->id();
			$table->enum('type', ['bank_transfer', 'e_wallet']);
			$table->string('name');             // BCA, BNI, GoPay, etc.
			$table->string('code')->unique();    // bca, bni, gopay, etc.
			$table->string('account_number')->nullable();
			$table->string('account_name');
			$table->string('icon_color')->default('#0ea5e9');
			$table->boolean('is_active')->default(true);
			$table->integer('sort_order')->default(0);
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('payment_methods');
	}
};
