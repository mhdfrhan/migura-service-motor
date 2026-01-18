<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		// 1. Users table (sudah ada dari Laravel Breeze, tapi kita extend)
		Schema::table('users', function (Blueprint $table) {
			$table->string('phone', 20)->nullable()->after('email');
			$table->enum('role', ['customer', 'admin', 'staff'])->default('customer')->after('phone');
			$table->text('address')->nullable()->after('role');
			$table->decimal('latitude', 10, 8)->nullable()->after('address');
			$table->decimal('longitude', 11, 8)->nullable()->after('latitude');
			$table->integer('loyalty_points')->default(0)->after('longitude');
			$table->integer('total_bookings')->default(0)->after('loyalty_points');
			$table->boolean('is_active')->default(true)->after('total_bookings');
		});

		// 2. Engine Capacities table
		Schema::create('engine_capacities', function (Blueprint $table) {
			$table->id();
			$table->string('name'); // e.g., "110cc", "150cc", "250cc+"
			$table->integer('min_cc');
			$table->integer('max_cc')->nullable();
			$table->decimal('price_multiplier', 5, 2)->default(1.00); // Pengali harga
			$table->boolean('is_active')->default(true);
			$table->timestamps();
		});

		// 3. Service Packages table
		Schema::create('service_packages', function (Blueprint $table) {
			$table->id();
			$table->string('name'); // "Regular Wash", "Premium Wash & Wax", "Coating & Detailing"
			$table->text('description');
			$table->decimal('base_price', 10, 2);
			$table->json('features')->nullable(); // Array of features
			$table->integer('estimated_duration')->default(30); // minutes
			$table->boolean('is_popular')->default(false);
			$table->boolean('is_active')->default(true);
			$table->integer('sort_order')->default(0);
			$table->timestamps();
		});

		// 4. Bookings table
		Schema::create('bookings', function (Blueprint $table) {
			$table->id();
			$table->string('booking_code')->unique(); // MIG-2025-0001
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('service_package_id')->constrained()->onDelete('restrict');
			$table->foreignId('engine_capacity_id')->constrained()->onDelete('restrict');

			// Booking details
			$table->enum('booking_type', ['regular', 'home_service'])->default('regular');
			$table->date('booking_date');
			$table->time('booking_time');
			$table->text('customer_address')->nullable();
			$table->decimal('customer_latitude', 10, 8)->nullable();
			$table->decimal('customer_longitude', 11, 8)->nullable();
			$table->decimal('distance_km', 5, 2)->nullable(); // For home service

			// Pricing
			$table->decimal('service_price', 10, 2);
			$table->decimal('engine_surcharge', 10, 2)->default(0);
			$table->decimal('home_service_fee', 10, 2)->default(0);
			$table->decimal('discount_amount', 10, 2)->default(0);
			$table->decimal('total_price', 10, 2);

			// Status tracking
			$table->enum('status', [
				'pending',              // Baru dibuat
				'awaiting_payment',     // Menunggu upload bukti
				'payment_uploaded',     // Bukti sudah diupload
				'payment_verified',     // Admin verifikasi
				'confirmed',            // Booking dikonfirmasi
				'in_progress',          // Sedang dikerjakan
				'completed',            // Selesai
				'cancelled',            // Dibatalkan
				'rejected'              // Ditolak
			])->default('pending');

			$table->text('notes')->nullable();
			$table->text('cancellation_reason')->nullable();
			$table->boolean('is_loyalty_reward')->default(false); // True if free from loyalty
			$table->integer('ai_prediction_wait_time')->nullable(); // minutes

			// Timestamps for status changes
			$table->timestamp('payment_uploaded_at')->nullable();
			$table->timestamp('payment_verified_at')->nullable();
			$table->timestamp('confirmed_at')->nullable();
			$table->timestamp('started_at')->nullable();
			$table->timestamp('completed_at')->nullable();
			$table->timestamp('cancelled_at')->nullable();

			$table->timestamps();
			$table->softDeletes();

			// Indexes
			$table->index('booking_code');
			$table->index('booking_date');
			$table->index('status');
			$table->index(['user_id', 'status']);
		});

		// 5. Payment Proofs table
		Schema::create('payment_proofs', function (Blueprint $table) {
			$table->id();
			$table->foreignId('booking_id')->constrained()->onDelete('cascade');
			$table->enum('payment_method', ['bank_transfer', 'e_wallet'])->nullable();
			$table->string('bank_name')->nullable(); // BCA, BNI, Mandiri, GoPay, OVO, DANA
			$table->string('account_number')->nullable();
			$table->string('account_name')->nullable();
			$table->decimal('amount', 10, 2);
			$table->string('proof_image_path'); // Storage path
			$table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
			$table->text('rejection_reason')->nullable();
			$table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
			$table->timestamp('verified_at')->nullable();
			$table->timestamps();
		});

		// 6. Reviews & Ratings table
		Schema::create('reviews', function (Blueprint $table) {
			$table->id();
			$table->foreignId('booking_id')->constrained()->onDelete('cascade');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');
			$table->integer('rating')->unsigned(); // 1-5
			$table->text('comment')->nullable();
			$table->json('photos')->nullable(); // Array of photo paths
			$table->boolean('is_published')->default(true);
			$table->timestamps();

			// Unique constraint: one review per booking
			$table->unique('booking_id');
		});

		// 7. Loyalty Transactions table
		Schema::create('loyalty_transactions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
			$table->enum('type', ['earned', 'redeemed', 'expired', 'adjusted'])->default('earned');
			$table->integer('points'); // Positive for earned, negative for redeemed
			$table->integer('balance_after'); // Balance after this transaction
			$table->text('description');
			$table->timestamps();

			$table->index(['user_id', 'created_at']);
		});

		// 8. Promo Codes table
		Schema::create('promo_codes', function (Blueprint $table) {
			$table->id();
			$table->string('code')->unique();
			$table->text('description');
			$table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
			$table->decimal('discount_value', 10, 2);
			$table->decimal('min_transaction', 10, 2)->default(0);
			$table->decimal('max_discount', 10, 2)->nullable();
			$table->integer('usage_limit')->nullable();
			$table->integer('usage_count')->default(0);
			$table->date('valid_from');
			$table->date('valid_until');
			$table->boolean('is_active')->default(true);
			$table->timestamps();
		});

		// 9. Promo Code Usage table
		Schema::create('promo_code_usages', function (Blueprint $table) {
			$table->id();
			$table->foreignId('promo_code_id')->constrained()->onDelete('cascade');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('booking_id')->constrained()->onDelete('cascade');
			$table->decimal('discount_amount', 10, 2);
			$table->timestamps();
		});

		// 10. Notifications table
		Schema::create('notifications', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('type'); // booking_confirmed, payment_verified, service_completed, etc.
			$table->string('title');
			$table->text('message');
			$table->json('data')->nullable(); // Additional data (booking_id, etc.)
			$table->boolean('is_read')->default(false);
			$table->timestamp('read_at')->nullable();
			$table->timestamps();

			$table->index(['user_id', 'is_read']);
			$table->index('created_at');
		});

		// 11. Operating Hours table
		Schema::create('operating_hours', function (Blueprint $table) {
			$table->id();
			$table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
			$table->time('open_time');
			$table->time('close_time');
			$table->boolean('is_closed')->default(false);
			$table->timestamps();

			$table->unique('day_of_week');
		});

		// 12. Booking Time Slots table
		Schema::create('booking_time_slots', function (Blueprint $table) {
			$table->id();
			$table->date('date');
			$table->time('time_slot');
			$table->integer('capacity')->default(5); // Max bookings per slot
			$table->integer('booked_count')->default(0);
			$table->boolean('is_available')->default(true);
			$table->timestamps();

			$table->unique(['date', 'time_slot']);
			$table->index('date');
		});

		// 13. Staff Assignments table (untuk tracking petugas)
		Schema::create('staff_assignments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('booking_id')->constrained()->onDelete('cascade');
			$table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
			$table->timestamp('assigned_at');
			$table->timestamp('started_at')->nullable();
			$table->timestamp('completed_at')->nullable();
			$table->text('notes')->nullable();
			$table->timestamps();
		});

		// 14. System Settings table
		Schema::create('system_settings', function (Blueprint $table) {
			$table->id();
			$table->string('key')->unique();
			$table->text('value')->nullable();
			$table->string('type')->default('string'); // string, integer, boolean, json
			$table->text('description')->nullable();
			$table->timestamps();
		});

		// 15. Chatbot Conversations table
		Schema::create('chatbot_conversations', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
			$table->string('session_id')->index();
			$table->enum('sender', ['user', 'bot']);
			$table->text('message');
			$table->json('metadata')->nullable(); // Intent, context, etc.
			$table->timestamps();

			$table->index(['session_id', 'created_at']);
		});

		// 16. Activity Logs table (untuk audit trail)
		Schema::create('activity_logs', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
			$table->string('action'); // created_booking, verified_payment, etc.
			$table->string('model_type')->nullable();
			$table->unsignedBigInteger('model_id')->nullable();
			$table->json('old_values')->nullable();
			$table->json('new_values')->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->text('user_agent')->nullable();
			$table->timestamps();

			$table->index(['model_type', 'model_id']);
			$table->index('created_at');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('activity_logs');
		Schema::dropIfExists('chatbot_conversations');
		Schema::dropIfExists('system_settings');
		Schema::dropIfExists('staff_assignments');
		Schema::dropIfExists('booking_time_slots');
		Schema::dropIfExists('operating_hours');
		Schema::dropIfExists('notifications');
		Schema::dropIfExists('promo_code_usages');
		Schema::dropIfExists('promo_codes');
		Schema::dropIfExists('loyalty_transactions');
		Schema::dropIfExists('reviews');
		Schema::dropIfExists('payment_proofs');
		Schema::dropIfExists('bookings');
		Schema::dropIfExists('service_packages');
		Schema::dropIfExists('engine_capacities');

		// Rollback users table extensions
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn([
				'phone',
				'role',
				'address',
				'latitude',
				'longitude',
				'loyalty_points',
				'total_bookings',
				'is_active'
			]);
		});
	}
};
