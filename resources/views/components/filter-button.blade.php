@php
    // Jika filter aktif, klik akan menghapus filter (reset ke default)
    $url = $active
        ? request()->fullUrlWithQuery(['filter' => null])
        : request()->fullUrlWithQuery(['filter' => $value]);
@endphp

<a href="{{ $url }}"
   class="cursor-pointer flex items-center gap-2 px-4 h-full rounded-full shadow text-xs
       {{ $active ? 'bg-blue-600 text-white' : 'bg-white hover:bg-slate-100' }}">
    @if($icon){!! $icon !!}@endif
    @if($label)<span>{!! $label !!}</span>@endif
</a>