<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-sky-500 border border-transparent rounded-xl font-semibold text-sm text-white shadow-sm hover:bg-sky-600 focus:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200']) }}>
    {{ $slot }}
</button>
