<div x-data="{ show: false, message: '', type: 'success' }" x-show="show"
    x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type || 'success'; setTimeout(() => { show = false }, 4000)"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
    class="fixed bottom-4 left-4 right-4 sm:left-1/2 sm:right-auto sm:-translate-x-1/2 sm:max-w-sm z-[9999] px-4 py-3 rounded-2xl backdrop-blur-xl shadow-lg"
    :class="{
        'bg-green-500/90 text-white shadow-green-500/20': type === 'success',
        'bg-red-500/90 text-white shadow-red-500/20': type === 'error',
        'bg-amber-500/90 text-white shadow-amber-500/20': type === 'warning',
        'bg-indigo-500/90 text-white shadow-indigo-500/20': type === 'info'
    }">
    <div class="flex items-start gap-3">
        <svg x-show="type === 'success'" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>

        <svg x-show="type === 'error'" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <svg x-show="type === 'warning'" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>

        <svg x-show="type === 'info'" class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <span x-text="message" class="text-sm font-medium flex-1 break-words"></span>

        <button @click="show = false" class="p-1 rounded-lg hover:bg-white/20 transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
