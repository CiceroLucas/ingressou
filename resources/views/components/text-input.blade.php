@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-neutral-900 focus:ring-neutral-900 rounded-md shadow-sm']) }}>
