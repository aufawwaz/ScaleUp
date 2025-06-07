@props([
    'title' => null, // button, submit, reset
    'back'  => null,
])

<!-- Header -->
<div class="flex justify-between w-full mb-[0.5rem] items-center">
    <div class="flex items-center gap-2">
        @if($back)
            <a href="{{ $back }}" class="p-2 rounded-full hover:bg-gray-100 transition rotate-180" title="Kembali">
                <!-- Icon panah kiri -->
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1b1051"><path d="M504-480 348-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L404-268q-11 11-28 11t-28-11q-11-11-11-28t11-28l156-156Z"/></svg>
            </a>
        @endif
        <h1 class="font-bold">{{ $title }}</h1>
    </div>
    {{ $slot }}
</div>

<!-- Line -->
<div class="w-full h-[1px] z-50 bg-gray-300"></div>
