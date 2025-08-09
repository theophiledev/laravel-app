@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md'])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 min-h-[44px] touch-manipulation';

$variantClasses = [
    'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-white',
    'secondary' => 'bg-gray-300 hover:bg-gray-400 focus:ring-gray-500 text-gray-800',
    'success' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 text-white',
    'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white',
    'warning' => 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-400 text-white',
    'info' => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 text-white',
];

$sizeClasses = [
    'sm' => 'px-3 py-2 text-sm',
    'md' => 'px-4 py-3 text-base',
    'lg' => 'px-6 py-4 text-lg',
];

$classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button> 