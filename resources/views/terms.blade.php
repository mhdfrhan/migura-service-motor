<x-main-layout>
    <x-slot name="title">Syarat & Ketentuan</x-slot>

    <div class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Syarat & Ketentuan</h1>
                <p class="text-lg text-gray-600">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-12 space-y-8">
                <!-- Section 1 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Penerimaan Syarat</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Dengan mengakses dan menggunakan layanan Migura E-Booking Wash Service ("Layanan"), Anda menyetujui untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, Anda tidak boleh menggunakan Layanan kami.
                    </p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Deskripsi Layanan</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Migura menyediakan platform pemesanan online untuk layanan pencucian sepeda motor. Layanan kami meliputi:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                        <li>Pemesanan layanan cuci motor secara online</li>
                        <li>Prediksi antrean menggunakan teknologi AI</li>
                        <li>Pembayaran digital melalui QRIS dan Transfer Bank</li>
                        <li>Layanan antar jemput (Home Service)</li>
                        <li>Program loyalitas dan poin reward</li>
                        <li>Asisten virtual 24/7</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Akun Pengguna</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            <strong class="text-gray-900">3.1. Pendaftaran:</strong> Anda harus mendaftar untuk membuat akun dan menggunakan Layanan. Informasi yang Anda berikan harus akurat dan terkini.
                        </p>
                        <p>
                            <strong class="text-gray-900">3.2. Keamanan Akun:</strong> Anda bertanggung jawab untuk menjaga kerahasiaan password akun Anda dan membatasi akses ke komputer atau perangkat Anda.
                        </p>
                        <p>
                            <strong class="text-gray-900">3.3. Tanggung Jawab:</strong> Anda bertanggung jawab atas semua aktivitas yang terjadi di bawah akun Anda.
                        </p>
                    </div>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Pemesanan dan Pembayaran</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            <strong class="text-gray-900">4.1. Konfirmasi Pemesanan:</strong> Semua pemesanan harus dikonfirmasi melalui platform kami. Kami berhak menolak atau membatalkan pemesanan atas kebijakan kami.
                        </p>
                        <p>
                            <strong class="text-gray-900">4.2. Harga:</strong> Harga layanan dapat berubah sewaktu-waktu. Harga yang berlaku adalah harga pada saat pemesanan dikonfirmasi.
                        </p>
                        <p>
                            <strong class="text-gray-900">4.3. Pembayaran:</strong> Pembayaran dapat dilakukan melalui QRIS atau Transfer Bank. Pembayaran harus diselesaikan sebelum atau sesudah layanan diberikan sesuai dengan metode yang dipilih.
                        </p>
                        <p>
                            <strong class="text-gray-900">4.4. Pembatalan:</strong> Pembatalan pemesanan dapat dilakukan minimal 2 jam sebelum waktu pemesanan. Pembatalan mendadak dapat dikenakan biaya pembatalan.
                        </p>
                    </div>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Layanan Home Service</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            Untuk layanan antar jemput, Anda setuju untuk:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li>Memberikan lokasi yang akurat dan dapat diakses</li>
                            <li>Memastikan sepeda motor dalam kondisi yang dapat dikerjakan</li>
                            <li>Bertanggung jawab atas keamanan kunci dan dokumen kendaraan</li>
                            <li>Berada di lokasi pada waktu yang telah dijadwalkan</li>
                        </ul>
                    </div>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Program Loyalitas</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Poin loyalitas diberikan untuk setiap transaksi yang diselesaikan. Poin dapat ditukarkan dengan hadiah atau diskon sesuai dengan ketentuan program yang berlaku. Kami berhak mengubah atau menghentikan program loyalitas kapan saja dengan pemberitahuan terlebih dahulu.
                    </p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Tanggung Jawab dan Jaminan</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p>
                            <strong class="text-gray-900">7.1. Kualitas Layanan:</strong> Kami berkomitmen untuk memberikan layanan berkualitas tinggi, namun tidak menjamin hasil yang sempurna untuk setiap kondisi kendaraan.
                        </p>
                        <p>
                            <strong class="text-gray-900">7.2. Kerusakan:</strong> Kami tidak bertanggung jawab atas kerusakan yang sudah ada sebelumnya atau kerusakan yang terjadi akibat kondisi kendaraan yang buruk.
                        </p>
                        <p>
                            <strong class="text-gray-900">7.3. Kehilangan:</strong> Kami bertanggung jawab atas kehilangan atau kerusakan yang terjadi selama kendaraan berada dalam perawatan kami, sesuai dengan nilai yang wajar.
                        </p>
                    </div>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Penggunaan Platform</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">Anda setuju untuk tidak:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                        <li>Menggunakan platform untuk tujuan ilegal atau tidak sah</li>
                        <li>Mengganggu atau mencoba mengganggu pengoperasian platform</li>
                        <li>Menyalahgunakan atau mencoba mengakses akun pengguna lain</li>
                        <li>Mengirim spam, virus, atau kode berbahaya lainnya</li>
                        <li>Mengumpulkan informasi pengguna lain tanpa izin</li>
                    </ul>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Perubahan Syarat</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Kami berhak mengubah syarat dan ketentuan ini kapan saja. Perubahan akan efektif setelah diposting di situs web kami. Penggunaan Layanan yang berkelanjutan setelah perubahan merupakan penerimaan Anda terhadap syarat yang diperbarui.
                    </p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Hubungi Kami</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Jika Anda memiliki pertanyaan tentang Syarat & Ketentuan ini, silakan hubungi kami:
                    </p>
                    <div class="mt-4 space-y-2 text-gray-700">
                        <p><strong class="text-gray-900">Email:</strong> cucianmigura@gmail.com</p>
                        <p><strong class="text-gray-900">Telepon:</strong> +62 812 3456 7890</p>
                        <p><strong class="text-gray-900">Alamat:</strong> Jalan. Melati Indah, Kota Pekanbaru, Indonesia</p>
                    </div>
                </section>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a wire:navigate href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-main-layout>

