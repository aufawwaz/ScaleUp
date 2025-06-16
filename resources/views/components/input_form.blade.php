<div class="text-xs rounded-[12px] border-1 border-gray h-[44px] px-3 w-full flex gap-2 items-center hover:border-primary focus-within:border-primary transition-all">
    @php
        $svg = file_get_contents(public_path($icon));
        $svg = str_replace('fill="#020507"', 'fill="currentColor"', $svg);
        $svg = str_replace('stroke="#020507"', 'stroke="currentColor"', $svg);
    @endphp
    <span class="max-w-4 max-h-4 text-gray flex items-center">{!! $svg !!}</span>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}"
        placeholder="{{ $placeholder }}" 
        class="w-full text-xs text-{{ $textSize }} truncate border-none focus:border-none focus:ring-0 focus:truncate outline-none leading-tight"
        autocomplete="{{ $autoComplete }}"
    >
</div>