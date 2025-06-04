@props([
    'type' => 'button', // button, submit, reset
    'href' => null,     // jika ingin jadi link
    'color' => 'primary', // primary, secondary, danger, success, dll
    'icon' => null,     // svg/icon html
    'size' => 'md',     // sm, md, lg
    'outline' => false,
    'block' => false,
    'disabled' => false,
])

@php
    $base = 'cursor-pointer inline-flex items-center justify-center rounded-xl font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 whitespace-nowrap';
    $sizes = [
        'sm' => 'px-2 py-2 text-[10px]',
        'md' => 'px-4 py-3 text-xs',
        'lg' => 'px-8 py-5 text-sm',
    ];
    $colors = [
        'primary' => $outline
            ? 'border border-primary text-primary hover:bg-primary/10'
            : 'bg-primary text-white hover:bg-primary-dark',
        'secondary' => $outline
            ? 'border border-gray-400 text-gray-700 hover:bg-gray-50'
            : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
        'danger' => $outline
            ? 'border border-red-400 text-red-500 hover:bg-red-50'
            : 'bg-red-500 text-white hover:bg-red-600',
        'success' => $outline
            ? 'border border-green-400 text-green-500 hover:bg-green-50'
            : 'bg-green-500 text-white hover:bg-green-600',
    ];
    $classes = $base . ' ' . ($sizes[$size] ?? $sizes['md']) . ' ' . ($colors[$color] ?? $colors['primary']) . ($block ? ' w-full' : '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ($disabled ? ' opacity-50 pointer-events-none' : '')]) }}>
        @if($icon)
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes . ($disabled ? ' opacity-50 cursor-not-allowed' : '')]) }} {{ $disabled ? 'disabled' : '' }}>
        @if($icon)
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $slot }}
    </button>
@endif