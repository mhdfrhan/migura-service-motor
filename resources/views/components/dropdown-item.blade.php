<a wire:navigate {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150']) }}>
    {{ $slot }}
</a>

