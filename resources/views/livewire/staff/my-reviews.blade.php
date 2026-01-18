<div class="p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Review & Rating Saya</h1>
        <p class="text-gray-600">Lihat feedback dari pelanggan tentang layanan Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Average Rating -->
        <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Rating Rata-rata</p>
            <p class="text-4xl font-bold">{{ number_format($stats->average_rating ?? 0, 1) }}</p>
            <p class="text-sm opacity-75 mt-1">dari 5.0 bintang</p>
        </div>

        <!-- Total Reviews -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Total Review</p>
            <p class="text-4xl font-bold">{{ $stats->total_reviews ?? 0 }}</p>
            <p class="text-sm opacity-75 mt-1">review diterima</p>
        </div>

        <!-- 5 Star Reviews -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Review 5 Bintang</p>
            <p class="text-4xl font-bold">{{ $stats->five_stars ?? 0 }}</p>
            <p class="text-sm opacity-75 mt-1">rating sempurna</p>
        </div>

        <!-- Satisfaction Rate -->
        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Tingkat Kepuasan</p>
            <p class="text-4xl font-bold">
                {{ $stats->total_reviews > 0 ? number_format((($stats->five_stars + $stats->four_stars) / $stats->total_reviews) * 100, 0) : 0 }}%
            </p>
            <p class="text-sm opacity-75 mt-1">rating 4-5 bintang</p>
        </div>
    </div>

    <!-- Rating Distribution -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Distribusi Rating</h2>
        <div class="space-y-3">
            @foreach([5, 4, 3, 2, 1] as $star)
                @php
                    $count = match($star) {
                        5 => $stats->five_stars ?? 0,
                        4 => $stats->four_stars ?? 0,
                        3 => $stats->three_stars ?? 0,
                        2 => $stats->two_stars ?? 0,
                        1 => $stats->one_star ?? 0,
                    };
                    $percentage = $stats->total_reviews > 0 ? ($count / $stats->total_reviews) * 100 : 0;
                @endphp
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1 w-20">
                        <span class="text-sm font-bold text-gray-900">{{ $star }}</span>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="flex-1 h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full transition-all duration-500"
                             style="width: {{ $percentage }}%"></div>
                    </div>
                    <span class="text-sm font-bold text-gray-900 w-12 text-right">{{ $count }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
        <button wire:click="setFilter('all')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === 'all' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            Semua ({{ $stats->total_reviews ?? 0 }})
        </button>
        <button wire:click="setFilter('5')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === '5' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            ⭐ 5 ({{ $stats->five_stars ?? 0 }})
        </button>
        <button wire:click="setFilter('4')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === '4' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            ⭐ 4 ({{ $stats->four_stars ?? 0 }})
        </button>
        <button wire:click="setFilter('3')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === '3' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            ⭐ 3 ({{ $stats->three_stars ?? 0 }})
        </button>
        <button wire:click="setFilter('2')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === '2' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            ⭐ 2 ({{ $stats->two_stars ?? 0 }})
        </button>
        <button wire:click="setFilter('1')"
            class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterRating === '1' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
            ⭐ 1 ({{ $stats->one_star ?? 0 }})
        </button>
    </div>

    <!-- Reviews List -->
    <div class="space-y-4">
        @forelse($reviews as $review)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $review->user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $review->booking->servicePackage->name }} • {{ $review->booking->booking_code }}</p>
                            </div>
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-700 mb-3">{{ $review->comment }}</p>
                        @if($review->photos && count($review->photos) > 0)
                            <div class="flex gap-2 mb-3">
                                @foreach($review->photos as $photo)
                                    <img src="{{ Storage::url($photo) }}" alt="Review Photo" class="w-24 h-24 object-cover rounded-xl border-2 border-gray-200">
                                @endforeach
                            </div>
                        @endif
                        <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Review</h3>
                <p class="text-gray-600">Anda belum memiliki review pada kategori ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($reviews->hasPages())
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
