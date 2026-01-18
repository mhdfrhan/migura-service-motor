<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedIntents();
        $this->seedFAQs();
    }

    private function seedIntents(): void
    {
        $intents = [
            [
                'name' => 'greeting',
                'description' => 'User greeting the bot',
                'patterns' => json_encode([
                    'halo',
                    'hai',
                    'hi',
                    'hello',
                    'selamat pagi',
                    'selamat siang',
                    'selamat sore',
                    'selamat malam',
                    'permisi',
                    'assalamualaikum',
                ]),
                'responses' => json_encode([
                    'Halo! Selamat datang di Migura Wash 👋 Ada yang bisa saya bantu?',
                    'Hai! Saya asisten virtual Migura Wash. Ada yang ingin ditanyakan?',
                    'Halo! Senang bertemu dengan Anda. Bagaimana saya bisa membantu hari ini?',
                ]),
                'quick_replies' => json_encode([
                    'Booking sekarang',
                    'Lihat harga',
                    'Jam operasional',
                    'Lokasi kami',
                ]),
                'priority' => 100,
            ],
            [
                'name' => 'booking_intent',
                'description' => 'User wants to make a booking',
                'patterns' => json_encode([
                    'booking',
                    'pesan',
                    'reservasi',
                    'cuci motor',
                    'mau cuci',
                    'book',
                    'daftar',
                    'jadwal cuci',
                    'order',
                    'mesen',
                ]),
                'responses' => json_encode([
                    'Siap! Saya akan bantu Anda booking cuci motor. Silakan klik tombol di bawah untuk mulai.',
                    'Oke! Yuk booking cuci motor sekarang. Klik tombol "Booking Sekarang" ya!',
                ]),
                'actions' => json_encode(['redirect_to_booking']),
                'quick_replies' => json_encode([
                    'Booking sekarang',
                    'Lihat paket',
                    'Tanya harga',
                ]),
                'priority' => 90,
            ],
            [
                'name' => 'price_inquiry',
                'description' => 'User asking about prices',
                'patterns' => json_encode([
                    'harga',
                    'berapa',
                    'biaya',
                    'tarif',
                    'price',
                    'cost',
                    'bayar',
                    'ongkos',
                    'rate',
                    'murah',
                    'mahal',
                ]),
                'responses' => json_encode([
                    "Harga cuci motor di Migura Wash mulai dari Rp 15.000 untuk Regular Wash. Kami punya beberapa paket:\n\n💧 Regular Wash: Rp 15.000\n✨ Premium Wash: Rp 30.000\n🌟 Detailing: Rp 50.000\n\nMau lihat detail paket-paketnya?",
                ]),
                'quick_replies' => json_encode([
                    'Detail paket',
                    'Booking sekarang',
                    'Ada diskon?',
                ]),
                'priority' => 85,
            ],
            [
                'name' => 'operating_hours',
                'description' => 'User asking about operating hours',
                'patterns' => json_encode([
                    'jam',
                    'buka',
                    'tutup',
                    'jam berapa',
                    'operasional',
                    'hours',
                    'kapan buka',
                    'libur',
                    'open',
                    'close',
                ]),
                'responses' => json_encode([
                    "Migura Wash buka setiap hari:\n\n⏰ Senin - Jumat: 08:00 - 20:00\n⏰ Sabtu - Minggu: 08:00 - 18:00\n\nYuk booking sekarang!",
                ]),
                'quick_replies' => json_encode([
                    'Booking sekarang',
                    'Tanya lokasi',
                    'Lihat paket',
                ]),
                'priority' => 80,
            ],
            [
                'name' => 'location',
                'description' => 'User asking about location',
                'patterns' => json_encode([
                    'lokasi',
                    'alamat',
                    'dimana',
                    'di mana',
                    'tempat',
                    'location',
                    'address',
                    'maps',
                    'arah',
                    'ke mana',
                ]),
                'responses' => json_encode([
                    '📍 Lokasi Migura Wash:\nJl. Contoh No. 123, Jakarta Selatan\n\nKami juga menyediakan layanan Home Service lho! Motor Anda bisa dicuci di rumah 🏠',
                ]),
                'quick_replies' => json_encode([
                    'Home Service',
                    'Booking sekarang',
                    'Lihat maps',
                ]),
                'priority' => 75,
            ],
            [
                'name' => 'complaint',
                'description' => 'User complaining or reporting issue',
                'patterns' => json_encode([
                    'complaint',
                    'keluhan',
                    'komplain',
                    'masalah',
                    'problem',
                    'tidak puas',
                    'kecewa',
                    'jelek',
                    'buruk',
                    'lapor',
                ]),
                'responses' => json_encode([
                    'Mohon maaf atas ketidaknyamanannya 🙏 Kami sangat menghargai masukan Anda. Bisa dijelaskan masalahnya? Tim kami akan segera menindaklanjuti.',
                ]),
                'quick_replies' => json_encode([
                    'Chat dengan admin',
                    'Kirim feedback',
                ]),
                'priority' => 95,
            ],
            [
                'name' => 'thanks',
                'description' => 'User thanking the bot',
                'patterns' => json_encode([
                    'terima kasih',
                    'thank you',
                    'thanks',
                    'makasih',
                    'thx',
                    'ok',
                    'oke',
                    'siap',
                    'baik',
                ]),
                'responses' => json_encode([
                    'Sama-sama! Senang bisa membantu 😊',
                    'Terima kasih kembali! Ada lagi yang bisa dibantu?',
                    'You\'re welcome! Jangan ragu tanya lagi ya! 👍',
                ]),
                'quick_replies' => json_encode([
                    'Booking sekarang',
                    'Selesai',
                ]),
                'priority' => 70,
            ],
            [
                'name' => 'fallback',
                'description' => 'Default response when intent not recognized',
                'patterns' => json_encode(['.*']),
                'responses' => json_encode([
                    'Maaf, saya kurang mengerti pertanyaan Anda 😅 Bisa dijelaskan lebih detail?',
                    'Hmm, saya belum paham maksudnya. Coba pilih dari menu di bawah ya!',
                ]),
                'quick_replies' => json_encode([
                    'Booking',
                    'Harga',
                    'Jam buka',
                    'Lokasi',
                    'Chat admin',
                ]),
                'priority' => 1,
            ],
        ];

        foreach ($intents as $intent) {
            DB::table('chatbot_intents')->updateOrInsert(
                ['name' => $intent['name']],
                array_merge($intent, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    private function seedFAQs(): void
    {
        $faqs = [
            [
                'category' => 'price',
                'question' => 'Berapa harga cuci motor di Migura Wash?',
                'answer' => 'Harga cuci motor di Migura Wash mulai dari Rp 15.000 untuk Regular Wash. Paket lainnya: Premium Wash (Rp 30.000) dan Detailing (Rp 50.000). Harga dapat berbeda tergantung ukuran mesin motor Anda.',
                'keywords' => json_encode(['harga', 'biaya', 'tarif', 'berapa']),
                'sort_order' => 1,
            ],
            [
                'category' => 'hours',
                'question' => 'Jam operasional Migura Wash?',
                'answer' => 'Kami buka Senin-Jumat: 08:00-20:00 dan Sabtu-Minggu: 08:00-18:00. Buka setiap hari!',
                'keywords' => json_encode(['jam', 'buka', 'tutup', 'operasional']),
                'sort_order' => 2,
            ],
            [
                'category' => 'location',
                'question' => 'Di mana lokasi Migura Wash?',
                'answer' => 'Lokasi kami di Jl. Contoh No. 123, Jakarta Selatan. Kami juga menyediakan layanan Home Service!',
                'keywords' => json_encode(['lokasi', 'alamat', 'dimana', 'tempat']),
                'sort_order' => 3,
            ],
            [
                'category' => 'service',
                'question' => 'Apa saja yang termasuk dalam paket Regular Wash?',
                'answer' => 'Paket Regular Wash meliputi: Cuci bodi motor, Cuci velg, Lap kering, dan Semir ban. Estimasi waktu 30 menit.',
                'keywords' => json_encode(['regular', 'paket', 'termasuk', 'include']),
                'sort_order' => 4,
            ],
            [
                'category' => 'service',
                'question' => 'Apakah ada layanan antar jemput motor?',
                'answer' => 'Saat ini kami belum menyediakan layanan antar jemput, tapi kami punya layanan Home Service di mana petugas kami datang ke lokasi Anda!',
                'keywords' => json_encode(['antar', 'jemput', 'pickup', 'delivery']),
                'sort_order' => 5,
            ],
            [
                'category' => 'payment',
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami menerima pembayaran via Transfer Bank (BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, DANA, ShopeePay), dan QRIS.',
                'keywords' => json_encode(['bayar', 'payment', 'transfer', 'metode']),
                'sort_order' => 6,
            ],
            [
                'category' => 'loyalty',
                'question' => 'Bagaimana cara mendapatkan poin loyalty?',
                'answer' => 'Setiap kali Anda menyelesaikan cuci motor, Anda akan mendapatkan +1 poin loyalty. Kumpulkan 10 poin untuk mendapatkan 1x cuci gratis!',
                'keywords' => json_encode(['loyalty', 'poin', 'point', 'gratis', 'reward']),
                'sort_order' => 7,
            ],
            [
                'category' => 'booking',
                'question' => 'Berapa lama sebelumnya saya harus booking?',
                'answer' => 'Anda bisa booking untuk hari ini atau hingga 3 bulan ke depan. Kami sarankan booking minimal H-1 untuk memastikan slot tersedia.',
                'keywords' => json_encode(['booking', 'kapan', 'lama', 'jadwal']),
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('chatbot_faqs')->updateOrInsert(
                ['question' => $faq['question']],
                array_merge($faq, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
