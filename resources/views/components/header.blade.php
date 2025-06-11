@php use Illuminate\Support\Str; @endphp
<div class="z-10 w-[calc(100%-240px)] pl-[1rem] pr-[1.5rem] h-[60px] fixed flex justify-between items-center left-[240px] bg-white shadow-sm">
    <h3 class="text-base uppercase font-bold">{{ $title }}</h3>
    @if(Auth::check())
    <a href="{{ route('profile.show') }}" class="flex items-center gap-[1rem] group">
        @if(Auth::user()->profile_photo)
            @if(Str::startsWith(Auth::user()->profile_photo, 'http'))
                <img src="{{ Auth::user()->profile_photo }}" alt="" class="w-[36px] h-[36px] rounded-full border group-hover:ring-2 group-hover:ring-blue-400 transition object-cover">
            @else
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="" class="w-[36px] h-[36px] rounded-full border group-hover:ring-2 group-hover:ring-blue-400 transition object-cover">
            @endif
        @else
            <div class="w-[36px] h-[36px] rounded-full bg-gray-200 flex items-center justify-center text-base font-bold text-gray-700 border">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        <div>
        <p class="text-sm font-bold">Hey, {{ Auth::user()->name }}</p>
        <p class="text-xs font-light">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
    </a>
    @endif
</div>