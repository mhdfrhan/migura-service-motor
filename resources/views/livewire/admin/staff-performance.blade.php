<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Performa Petugas</h1>
            <p class="mt-1 text-sm text-gray-600">Analytics dan ranking review petugas</p>
        </div>
    </div>

    <!-- Overall Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Petugas</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $overallStats['total_staff'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Review</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $overallStats['total_reviews'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rating Rata-rata</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $overallStats['average_rating'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm font-medium text-gray-600">Petugas Terbaik</p>
                    <p class="text-lg font-bold text-gray-900 mt-2 truncate">
                        {{ $overallStats['top_rated_staff']['name'] ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-600 mt-1">⭐ {{ $overallStats['top_rated_staff']['average_rating'] ?? 0 }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff Ranking -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-900">Ranking Petugas</h2>
        </div>

        <div class="divide-y divide-gray-200">
            @foreach ($staffPerformance as $index => $staff)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors cursor-pointer"
                    wire:click="selectStaff({{ $staff['id'] }})">
                    <div class="flex items-center gap-4">
                        <!-- Rank Badge -->
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center font-bold flex-shrink-0 {{ $index === 0 ? 'bg-yellow-100 text-yellow-700' : ($index === 1 ? 'bg-gray-200 text-gray-700' : ($index === 2 ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-600')) }}">
                            {{ $index + 1 }}
                        </div>

                        <!-- Staff Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $staff['name'] }}</h3>
                                @if ($index === 0)
                                    <span
                                        class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">🏆
                                        TERBAIK</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 truncate">{{ $staff['email'] }}</p>
                        </div>

                        <!-- Stats -->
                        <div class="flex items-center gap-6">
                            <div class="text-center">
                                <div class="flex items-center gap-1 justify-center mb-1">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <p class="text-lg font-bold text-gray-900">{{ $staff['average_rating'] }}</p>
                                </div>
                                <p class="text-xs text-gray-500">Rating</p>
                            </div>

                            <div class="text-center">
                                <p class="text-lg font-bold text-gray-900 mb-1">{{ $staff['total_reviews'] }}</p>
                                <p class="text-xs text-gray-500">Review</p>
                            </div>

                            <div class="text-center">
                                <p class="text-lg font-bold text-green-600 mb-1">{{ $staff['satisfaction_rate'] }}%</p>
                                <p class="text-xs text-gray-500">Kepuasan</p>
                            </div>
                        </div>

                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Selected Staff Details -->
    @if ($selectedStaffDetails)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900">Detail Review: {{ $selectedStaffDetails['staff']->name }}</h2>
                <x-secondary-button wire:click="clearSelection" type="button">
                    Tutup
                </x-secondary-button>
            </div>

            <div class="space-y-4">
                @forelse ($selectedStaffDetails['recent_reviews'] as $review)
                    <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-semibold flex-shrink-0">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $review->booking->servicePackage->name }}</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-2">{{ $review->comment }}</p>
                                <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8">Belum ada review</p>
                @endforelse
            </div>
        </div>
    @endif
</div>
