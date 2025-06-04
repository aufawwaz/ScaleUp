<!-- Header -->
<div class="flex justify-between w-full mb-[0.5rem] items-center">
    <div class="flex items-center gap-2">
        @if(!empty($back))
            <a href="{{ $back }}" class="p-2 rounded hover:bg-gray-200 transition" title="Kembali">
                <!-- Icon panah kiri -->
                <svg xmlns="http://www.w3.org/2000/svg" class="inline" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif
        <h1 class="font-bold">{{ $title }}</h1>
    </div>
    {{ $slot }}
</div>

<!-- Line -->
<div class="w-full h-[1px] bg-gray-300"></div>
