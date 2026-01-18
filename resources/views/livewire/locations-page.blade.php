<x-slot name="title">Lokasi Kami</x-slot>

<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
    <x-container>
        <!-- Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Lokasi Kami</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan outlet Migura Wash terdekat dari lokasi Anda. Kami siap melayani dengan layanan terbaik!
            </p>
        </div>

        @if ($locations->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Lokasi</h3>
                <p class="text-gray-600">Saat ini belum ada outlet yang tersedia.</p>
            </div>
        @else
            <!-- Map -->
            <div class="mb-12">
                <div class="bg-white rounded-3xl border-2 border-gray-200 overflow-hidden">
                    <div wire:ignore id="locations-map" class="w-full h-[500px] bg-gray-100"></div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 text-center">
                    <div class="w-14 h-14 bg-sky-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">{{ $locations->count() }}</div>
                    <div class="text-sm text-gray-600">Total Outlet</div>
                </div>

                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 text-center">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">
                        {{ $locations->where('is_main_branch', true)->count() }}</div>
                    <div class="text-sm text-gray-600">Cabang Utama</div>
                </div>

                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">Setiap Hari</div>
                    <div class="text-sm text-gray-600">Siap Melayani</div>
                </div>
            </div>

            <!-- Location Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($locations as $location)
                    <div
                        class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden hover:border-sky-300 hover:shadow-lg transition-all duration-300">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-white mb-2">{{ $location->name }}</h3>
                                    <p class="text-sm text-sky-100 font-medium">{{ $location->code }}</p>
                                </div>
                                @if ($location->is_main_branch)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Cabang Utama
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <!-- Address -->
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Alamat</div>
                                    <div class="text-sm text-gray-900 font-medium">{{ $location->address }}</div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @if ($location->phone)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs font-semibold text-gray-500 uppercase">Telepon</div>
                                            <a href="tel:{{ $location->phone }}"
                                                class="text-sm text-gray-900 font-medium hover:text-sky-600 transition-colors">
                                                {{ $location->phone }}
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if ($location->email)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-xs font-semibold text-gray-500 uppercase">Email</div>
                                            <a href="mailto:{{ $location->email }}"
                                                class="text-sm text-gray-900 font-medium hover:text-sky-600 transition-colors truncate block">
                                                {{ $location->email }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Operating Hours -->
                            <div class="flex items-center gap-3 bg-gray-50 rounded-xl p-4">
                                <div
                                    class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Jam Operasional
                                    </div>
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ substr($location->open_time, 0, 5) }} -
                                        {{ substr($location->close_time, 0, 5) }} WIB
                                    </div>
                                    @if ($location->operating_days)
                                        <div class="text-xs text-gray-600 mt-1">
                                            {{ count($location->operating_days) }} hari operasional
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Service Info -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-blue-50 rounded-xl p-3 text-center">
                                    <div class="text-lg font-bold text-blue-900">
                                        {{ $location->max_service_radius_km }}
                                        km</div>
                                    <div class="text-xs text-blue-700">Radius Layanan</div>
                                </div>
                                <div class="bg-green-50 rounded-xl p-3 text-center">
                                    <div class="text-lg font-bold text-green-900">{{ $location->daily_capacity }}
                                    </div>
                                    <div class="text-xs text-green-700">Kapasitas Harian</div>
                                </div>
                            </div>

                            <!-- Facilities -->
                            @if ($location->facilities && count($location->facilities) > 0)
                                <div>
                                    <div class="text-xs font-semibold text-gray-500 uppercase mb-2">Fasilitas</div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($location->facilities as $facility)
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                                {{ $facility }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex gap-3 pt-4">
                                <button wire:click="selectLocation({{ $location->id }})"
                                    class="flex-1 px-4 py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition-colors">
                                    Lihat di Peta
                                </button>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $location->latitude }},{{ $location->longitude }}"
                                    target="_blank"
                                    class="flex-1 px-4 py-3 bg-white border-2 border-gray-200 hover:border-sky-500 text-gray-900 font-semibold rounded-xl transition-colors text-center">
                                    Google Maps
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CTA Section -->
            <div class="mt-12 bg-gradient-to-r from-sky-500 to-blue-600 rounded-3xl p-8 sm:p-12 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Siap untuk Booking?</h2>
                <p class="text-lg text-sky-100 mb-8 max-w-2xl mx-auto">
                    Pilih outlet terdekat dan reservasi sekarang! Nikmati layanan cuci motor berkualitas dengan teknisi
                    profesional.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('booking.index') }}" wire:navigate
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-sky-600 font-bold rounded-2xl hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Booking Sekarang
                    </a>
                    <a href="{{ route('home-service') }}" wire:navigate
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home Service
                    </a>
                </div>
            </div>
        @endif
    </x-container>

    @if ($locations->isNotEmpty())
        @push('styles')
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        @endpush

        @push('scripts')
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        @endpush

        @push('scripts')
            <script>
                window.locationsPageMap = window.locationsPageMap || null;
                window.locationsMarkers = window.locationsMarkers || [];

                const locationsData = @json($locationsForMap);

                function initLocationsMap() {
                    // Cleanup existing map
                    if (window.locationsPageMap) {
                        try {
                            window.locationsPageMap.remove();
                        } catch (e) {
                            console.log('Error removing old map:', e);
                        }
                        window.locationsPageMap = null;
                        window.locationsMarkers = [];
                    }

                    const mapContainer = document.getElementById('locations-map');
                    if (!mapContainer) {
                        console.error('Map container not found');
                        return;
                    }

                    mapContainer.innerHTML = '';

                    // Calculate center (average of all locations)
                    let avgLat = 0,
                        avgLng = 0;
                    locationsData.forEach(loc => {
                        avgLat += parseFloat(loc.lat);
                        avgLng += parseFloat(loc.lng);
                    });
                    avgLat /= locationsData.length;
                    avgLng /= locationsData.length;

                    try {
                        window.locationsPageMap = L.map('locations-map', {
                            center: [avgLat, avgLng],
                            zoom: locationsData.length === 1 ? 15 : 12,
                            zoomControl: true,
                        });
                    } catch (error) {
                        console.error('Error initializing map:', error);
                        return;
                    }

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap',
                        maxZoom: 19,
                    }).addTo(window.locationsPageMap);

                    // Icon definitions
                    const blueIcon = L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    const orangeIcon = L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    // Add markers for all locations
                    locationsData.forEach((location) => {
                        const marker = L.marker([location.lat, location.lng], {
                            icon: location.is_main ? orangeIcon : blueIcon
                        }).addTo(window.locationsPageMap);

                        const popupContent = `
                        <div class="text-center" style="min-width: 200px;">
                            <strong class="text-lg">${location.name}</strong>
                            ${location.is_main ? '<br/><span class="text-orange-600 text-xs font-semibold">⭐ Cabang Utama</span>' : ''}
                            <br/><span class="text-xs text-gray-600">${location.address}</span>
                            ${location.phone ? '<br/><span class="text-xs text-gray-600">📞 ' + location.phone + '</span>' : ''}
                            <br/><span class="text-xs text-gray-600">Radius: ${location.radius} km</span>
                        </div>
                    `;
                        marker.bindPopup(popupContent);

                        // Service area circle
                        L.circle([location.lat, location.lng], {
                            color: location.is_main ? '#f97316' : '#0ea5e9',
                            fillColor: location.is_main ? '#f97316' : '#0ea5e9',
                            fillOpacity: location.is_main ? 0.15 : 0.1,
                            radius: location.radius * 1000,
                            weight: location.is_main ? 2 : 1
                        }).addTo(window.locationsPageMap);

                        window.locationsMarkers.push({
                            id: location.id,
                            marker: marker
                        });
                    });

                    console.log('Locations map initialized with', locationsData.length, 'markers');
                }

                // Initialize map when Livewire component loads
                document.addEventListener('livewire:navigated', function() {
                    if (document.getElementById('locations-map')) {
                        setTimeout(() => initLocationsMap(), 100);
                    }
                });

                // Initialize on first load
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(() => initLocationsMap(), 100);
                    });
                } else {
                    setTimeout(() => initLocationsMap(), 100);
                }

                // Listen for location selection
                Livewire.on('locationSelected', (locationId) => {
                    const markerData = window.locationsMarkers.find(m => m.id === locationId);
                    if (markerData && window.locationsPageMap) {
                        window.locationsPageMap.setView(markerData.marker.getLatLng(), 16);
                        markerData.marker.openPopup();

                        // Smooth scroll to map
                        document.getElementById('locations-map').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                });
            </script>
        @endpush
    @endif
</div>
