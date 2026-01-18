<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
	public function run(): void
	{
		$paymentMethods = [
			// Bank Transfers
			[
				'type' => 'bank_transfer',
				'name' => 'Bank BCA',
				'code' => 'BCA',
				'account_number' => '1234567890',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#1e40af',
				'sort_order' => 1,
			],
			[
				'type' => 'bank_transfer',
				'name' => 'Bank BNI',
				'code' => 'BNI',
				'account_number' => '0987654321',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#ea580c',
				'sort_order' => 2,
			],
			[
				'type' => 'bank_transfer',
				'name' => 'Bank Mandiri',
				'code' => 'Mandiri',
				'account_number' => '1122334455',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#eab308',
				'sort_order' => 3,
			],
			// E-Wallets
			[
				'type' => 'e_wallet',
				'name' => 'GoPay',
				'code' => 'GoPay',
				'account_number' => '0812-3456-7890',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#16a34a',
				'sort_order' => 1,
			],
			[
				'type' => 'e_wallet',
				'name' => 'OVO',
				'code' => 'OVO',
				'account_number' => '0812-3456-7890',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#9333ea',
				'sort_order' => 2,
			],
			[
				'type' => 'e_wallet',
				'name' => 'DANA',
				'code' => 'DANA',
				'account_number' => '0812-3456-7890',
				'account_name' => 'Migura Wash Service',
				'icon_color' => '#0ea5e9',
				'sort_order' => 3,
			],
		];

		foreach ($paymentMethods as $method) {
			PaymentMethod::updateOrCreate(
				['code' => $method['code']],
				$method
			);
		}
	}
}
