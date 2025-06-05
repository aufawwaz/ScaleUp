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
            ? 'border border-primary text-primary hover:bg-primary/10 transition'
            : 'bg-primary text-white hover:scale-103 hover:shadow-md transition',
        'secondary' => $outline
            ? 'border border-gray-400 text-gray-700 hover:bg-gray-50 transition'
            : 'bg-gray-200 text-gray-700 hover:bg-gray-300 transition',
        'danger' => $outline
            ? 'border border-red-400 text-red-500 hover:bg-red-50 transition'
            : 'bg-red-500 text-white hover:bg-red-600 transition',
        'success' => $outline
            ? 'border border-green-400 text-green-500 hover:bg-green-50 transition'
            : 'bg-green-500 text-white hover:bg-green-600 transition',
    ];

    // Deteksi jika hanya icon tanpa teks
    $isOnlyIcon = $icon && trim($slot) === '';

    // Kelas utama
    $classes = $base
        . ' ' . ($sizes[$size] ?? $sizes['md'])
        . ' ' . ($colors[$color] ?? $colors['primary'])
        . ($block ? ' w-full' : '')
        . ($isOnlyIcon ? ' p-2 aspect-square' : '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ($disabled ? ' opacity-50 pointer-events-none' : '')]) }}>
        @if($icon)
            <span class="{{ $isOnlyIcon ? '' : 'mr-2' }}">{!! $icon !!}</span>
        @endif
        @unless($isOnlyIcon)
            {{ $slot }}
        @endunless
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes . ($disabled ? ' opacity-50 cursor-not-allowed' : '')]) }} {{ $disabled ? 'disabled' : '' }}>
        @if($icon)
            <span class="{{ $isOnlyIcon ? '' : 'mr-2' }}">{!! $icon !!}</span>
        @endif
        @unless($isOnlyIcon)
            {{ $slot }}
        @endunless
    </button>
@endif