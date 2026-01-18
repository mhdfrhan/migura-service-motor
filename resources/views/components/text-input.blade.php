@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200 disabled:bg-gray-50 disabled:cursor-not-allowed']) }}>
