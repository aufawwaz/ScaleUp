<div class="h-[154px] flex flex-col justify-between p-[1rem] rounded-2xl bg-white text-dark shadow w-full">
    <p class="text-sm font-medium opacity-60">{{ $title }}</p>
    <div class="flex gap-[1rem] items-center">
        {!! $icon !!}
        <p class="text-xl font-semibold">{{ $value }}</p>
    </div>
    <a href="{{ $buttonUrl }}" class="flex justify-between items-center font-medium bg-primary hover:opacity-80 text-white p-2 px-3 text-xs rounded-xl transition">
        <p>{{ $buttonLabel }}</p>
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M504-480 348-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L404-268q-11 11-28 11t-28-11q-11-11-11-28t11-28l156-156Z"/></svg>
    </a>
</div>