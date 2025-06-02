<div class="rounded-[12px] border-1 border-gray p-2 w-full flex gap-2 items-center">
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
        class="w-[100%] text-sm border-none focus:border-none focus:ring-0 outline-none leading-tight pb-0.75"
    >
</div>