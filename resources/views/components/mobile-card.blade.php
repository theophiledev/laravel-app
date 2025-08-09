@props(['padding' => 'md', 'shadow' => 'md', 'hover' => true])

@php
$paddingClasses = [
    'sm' => 'p-3',
    'md' => 'p-4 md:p-6',
    'lg' => 'p-6 md:p-8',
];

$shadowClasses = [
    'sm' => 'shadow-sm',
    'md' => 'shadow-lg',
    'lg' => 'shadow-xl',
];

$hoverClasses = $hover ? 'hover:shadow-xl transition-shadow duration-200' : '';

$classes = 'bg-white rounded-lg ' . $shadowClasses[$shadow] . ' ' . $paddingClasses[$padding] . ' ' . $hoverClasses;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div> 