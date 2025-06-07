@props([
    'placeholder' => 'Cari...',
    'name' => 'search',
    'value' => request('search'),
    'action' => url()->current(), // default action: current URL
])

<form method="GET" action="{{ $action }}" class="relative flex items-center w-full">
    <input
        type="text"
        autocomplete="off"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-xs focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition"
    />
    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none"
         stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
    </svg>
</form>