@props(['active' => false])

<a wire:navigate {{ $attributes->merge(['class' => $active 
    ? 'text-sky-600 font-semibold' 
    : 'text-gray-700 hover:text-sky-600 font-medium transition-colors duration-200']) }}>
    {{ $slot }}
</a>
