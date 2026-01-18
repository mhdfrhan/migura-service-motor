<?php

namespace App\Livewire;

use Livewire\Component;

class HelpSupport extends Component
{
	public array $faqs = [];
	public array $contactInfo = [];

	public function mount(): void
	{
		$this->faqs = [
			[
				'question' => 'Bagaimana cara melakukan pemesanan?',
				'answer' => 'Anda dapat melakukan pemesanan melalui menu "Pesan Cucian Baru" di halaman dashboard. Pilih layanan, tanggal, dan waktu yang diinginkan, lalu lanjutkan dengan pembayaran.',
			],
			[
				'question' => 'Metode pembayaran apa saja yang tersedia?',
				'answer' => 'Kami menerima pembayaran melalui transfer bank (BCA, BNI, Mandiri) dan e-wallet (GoPay, OVO, DANA). Setelah transfer, upload bukti pembayaran untuk verifikasi.',
			],
			[
				'question' => 'Berapa lama waktu verifikasi pembayaran?',
				'answer' => 'Verifikasi pembayaran umumnya membutuhkan waktu 1x24 jam. Anda akan mendapat notifikasi setelah pembayaran terverifikasi.',
			],
			[
				'question' => 'Bagaimana cara kerja program loyalitas?',
				'answer' => 'Setiap 10 kali cuci berbayar, Anda akan mendapatkan 1 poin gratis yang dapat digunakan untuk cuci gratis. Poin akan otomatis ditambahkan setelah transaksi selesai.',
			],
			[
				'question' => 'Apakah bisa membatalkan pesanan?',
				'answer' => 'Pesanan dapat dibatalkan sebelum bukti pembayaran di-upload. Setelah pembayaran terverifikasi, pesanan tidak dapat dibatalkan.',
			],
			[
				'question' => 'Bagaimana jika motor saya memiliki kerusakan setelah dicuci?',
				'answer' => 'Segera hubungi tim support kami melalui WhatsApp atau email. Kami akan membantu menyelesaikan masalah Anda dengan cepat.',
			],
		];

		$this->contactInfo = [
			'whatsapp' => '+62 812-3456-7890',
			'email' => 'support@migurawash.com',
			'address' => 'Jl. Contoh No. 123, Kota ABC, Indonesia',
			'operating_hours' => 'Senin - Sabtu: 08:00 - 17:00 WIB',
		];
	}

	public function render()
	{
		return view('livewire.help-support');
	}
}
