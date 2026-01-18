<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
	public function run(): void
	{
		// 1. Create Admin User
		User::create([
			'name' => 'Admin Migura',
			'email' => 'admin@migura.com',
			'phone' => '081234567890',
			'password' => Hash::make('password'),
			'role' => 'admin',
			'is_active' => true,
			'email_verified_at' => now(),
		]);

		// 2. Create Staff User
		User::create([
			'name' => 'Staff Cucian',
			'email' => 'staff@migura.com',
			'phone' => '081234567891',
			'password' => Hash::make('password'),
			'role' => 'staff',
			'is_active' => true,
			'email_verified_at' => now(),
		]);

		// 3. Create Demo Customer
		User::create([
			'name' => 'Wahyu Abrar',
			'email' => 'customer@migura.com',
			'phone' => '083168445268',
			'password' => Hash::make('password'),
			'role' => 'customer',
			'address' => 'Jalan Swakarya, Pekanbaru',
			'loyalty_points' => 0,
			'total_bookings' => 0,
			'is_active' => true,
			'email_verified_at' => now(),
		]);

		// 4. Engine Capacities
		$engineCapacities = [
			['name' => '110cc', 'min_cc' => 0, 'max_cc' => 110, 'price_multiplier' => 1.00, 'is_active' => true],
			['name' => '150cc', 'min_cc' => 111, 'max_cc' => 150, 'price_multiplier' => 1.20, 'is_active' => true],
			['name' => '250cc+', 'min_cc' => 151, 'max_cc' => null, 'price_multiplier' => 1.50, 'is_active' => true],
		];

		foreach ($engineCapacities as $capacity) {
			DB::table('engine_capacities')->insert(array_merge($capacity, [
				'created_at' => now(),
				'updated_at' => now(),
			]));
		}

		// 5. Service Packages
		$servicePackages = [
			[
				'name' => 'Regular Wash',
				'description' => 'Cuci motor standar dengan air dan sabun berkualitas',
				'base_price' => 25000,
				'features' => json_encode([
					'Cuci bodi & velg',
					'Lap kering',
					'Semir ban',
					'Waktu ~20 menit'
				]),
				'estimated_duration' => 20,
				'is_popular' => false,
				'is_active' => true,
				'sort_order' => 1,
			],
			[
				'name' => 'Premium Wash & Wax',
				'description' => 'Cuci premium dengan wax untuk hasil lebih mengkilap',
				'base_price' => 50000,
				'features' => json_encode([
					'Semua fitur Regular',
					'Polish body',
					'Wax premium',
					'Detailing mesin',
					'Waktu ~40 menit'
				]),
				'estimated_duration' => 40,
				'is_popular' => true,
				'is_active' => true,
				'sort_order' => 2,
			],
			[
				'name' => 'Coating & Detailing',
				'description' => 'Perawatan lengkap dengan coating untuk perlindungan maksimal',
				'base_price' => 75000,
				'features' => json_encode([
					'Semua fitur Premium',
					'Nano coating',
					'Deep cleaning mesin',
					'Polish & compound',
					'Detailing interior',
					'Waktu ~60 menit'
				]),
				'estimated_duration' => 60,
				'is_popular' => false,
				'is_active' => true,
				'sort_order' => 3,
			],
		];

		foreach ($servicePackages as $package) {
			DB::table('service_packages')->insert(array_merge($package, [
				'created_at' => now(),
				'updated_at' => now(),
			]));
		}

		// 6. Operating Hours (Senin - Minggu, 09:00 - 17:00)
		$operatingHours = [
			['day_of_week' => 'monday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_closed' => false],
			['day_of_week' => 'tuesday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_closed' => false],
			['day_of_week' => 'wednesday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_closed' => false],
			['day_of_week' => 'thursday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_closed' => false],
			['day_of_week' => 'friday', 'open_time' => '09:00:00', 'close_time' => '17:00:00', 'is_closed' => false],
			['day_of_week' => 'saturday', 'open_time' => '09:00:00', 'close_time' => '15:00:00', 'is_closed' => false],
			['day_of_week' => 'sunday', 'open_time' => '00:00:00', 'close_time' => '00:00:00', 'is_closed' => true],
		];

		foreach ($operatingHours as $hours) {
			DB::table('operating_hours')->insert(array_merge($hours, [
				'created_at' => now(),
				'updated_at' => now(),
			]));
		}

		// 7. System Settings
		$settings = [
			// Loyalty Settings
			['key' => 'loyalty_points_per_booking', 'value' => '1', 'type' => 'integer', 'description' => 'Poin per booking'],
			['key' => 'loyalty_free_wash_points', 'value' => '10', 'type' => 'integer', 'description' => 'Poin untuk cuci gratis'],

			// Booking Settings
			['key' => 'max_bookings_per_slot', 'value' => '5', 'type' => 'integer', 'description' => 'Max booking per slot waktu'],
			['key' => 'booking_advance_days', 'value' => '7', 'type' => 'integer', 'description' => 'Max hari booking ke depan'],
			['key' => 'cancellation_hours', 'value' => '24', 'type' => 'integer', 'description' => 'Min jam untuk cancel booking'],

			// Payment Settings
			['key' => 'payment_verification_auto', 'value' => 'false', 'type' => 'boolean', 'description' => 'Auto verifikasi pembayaran'],
			['key' => 'payment_timeout_hours', 'value' => '24', 'type' => 'integer', 'description' => 'Timeout upload bukti pembayaran (jam)'],

			// Notification Settings
			['key' => 'notification_enabled', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable notifikasi'],
			['key' => 'notification_email', 'value' => 'true', 'type' => 'boolean', 'description' => 'Send email notification'],

			// AI Prediction Settings
			['key' => 'ai_prediction_enabled', 'value' => 'true', 'type' => 'boolean', 'description' => 'Enable AI prediction'],
			['key' => 'ai_base_wait_time', 'value' => '30', 'type' => 'integer', 'description' => 'Base wait time (minutes)'],
			['key' => 'ai_wait_time_per_booking', 'value' => '5', 'type' => 'integer', 'description' => 'Additional time per booking ahead'],

			// Business Info
			['key' => 'business_name', 'value' => 'Cucian Motor Migura', 'type' => 'string', 'description' => 'Nama usaha'],
			['key' => 'business_phone', 'value' => '081234567890', 'type' => 'string', 'description' => 'Nomor telepon usaha'],
			['key' => 'business_email', 'value' => 'info@migura.com', 'type' => 'string', 'description' => 'Email usaha'],
		];

		foreach ($settings as $setting) {
			DB::table('system_settings')->insert(array_merge($setting, [
				'created_at' => now(),
				'updated_at' => now(),
			]));
		}

		$this->command->info('✅ Initial data seeded successfully!');
		$this->command->info('📧 Admin: admin@migura.com | Password: password');
		$this->command->info('👥 Staff: staff@migura.com | Password: password');
		$this->command->info('🧑 Customer: customer@migura.com | Password: password');
	}
}
