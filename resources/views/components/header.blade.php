<div class="z-10 w-[calc(100%-240px)] pl-[1rem] pr-[1.5rem] h-[60px] fixed flex justify-between items-center left-[240px] bg-white shadow-sm">
    <h3 class="text-base uppercase font-bold">{{ $title }}</h3>
    <div class="flex items-center gap-[1rem]">
        <img src="{{ $imgSrc }}" alt="" class="w-[36px] rounded-full">
        <div>
        <p class="text-sm font-bold">Hey, {{ $userName }}</p>
        <p class="text-xs font-light">{{ $date }}</p>
        </div>
    </div>
</div>