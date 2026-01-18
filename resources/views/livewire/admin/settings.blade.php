<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Pengaturan Sistem</h1>
        <p class="mt-1 text-sm text-gray-600">Kelola konfigurasi aplikasi</p>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Settings List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Key</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Value</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($settings as $key => $setting)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">{{ $key }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($editingKey === $key)
                                    @if($editType === 'boolean')
                                        <select wire:model="editValue" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                            <option value="1">True</option>
                                            <option value="0">False</option>
                                        </select>
                                    @elseif($editType === 'json' || $editType === 'array')
                                        <textarea wire:model="editValue" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg font-mono text-sm"></textarea>
                                    @else
                                        <input type="{{ $editType === 'integer' ? 'number' : 'text' }}" wire:model="editValue" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                    @endif
                                @else
                                    <p class="text-sm text-gray-900">
                                        @if(is_array($setting['value']))
                                            <pre class="text-xs">{{ json_encode($setting['value'], JSON_PRETTY_PRINT) }}</pre>
                                        @elseif(is_bool($setting['value']))
                                            <span class="px-2 py-1 rounded text-xs font-medium {{ $setting['value'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $setting['value'] ? 'True' : 'False' }}
                                            </span>
                                        @else
                                            {{ $setting['value'] }}
                                        @endif
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded bg-blue-100 text-blue-800">{{ $setting['type'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $setting['description'] ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($editingKey === $key)
                                    <div class="flex items-center gap-2">
                                        <button wire:click="saveSetting('{{ $key }}')" class="text-green-600 hover:text-green-900 font-semibold">
                                            Simpan
                                        </button>
                                        <button wire:click="cancelEdit" class="text-gray-600 hover:text-gray-900 font-semibold">
                                            Batal
                                        </button>
                                    </div>
                                @else
                                    <button wire:click="startEdit('{{ $key }}')" class="text-sky-600 hover:text-sky-900 font-semibold">
                                        Edit
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada pengaturan</p>
                                    <p class="text-sm mt-1">Belum ada konfigurasi yang tersedia</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
