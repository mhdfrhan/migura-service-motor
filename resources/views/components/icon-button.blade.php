<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center w-10 h-10 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>

