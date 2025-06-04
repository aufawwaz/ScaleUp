<div onclick="window.location.href='{{ route('news') }}'" class="w-[280px] h-[250px] bg-white hover:bg-[#f7f7f7] shadow-lg cursor-pointer">
    {{-- gambar --}}
    <div class="relative">
        <img src="asset/news_dummy_image.png" alt="" class="w-full h-[120px] object-cover">
        <div style="background: linear-gradient(transparent, black);" class="absolute w-full h-[40px] bottom-0 z-[9]"></div>
        <tanggal class="text-white text-xs z-[10] absolute bottom-2 left-4">{{ $date }}</tanggal>
    </div>

    {{-- teksnya --}}
    <div class="container p-2">
        <judul class="text-base font-bold line-clamp-2">{{ $title }}</judul>
        <deskripsi class="text-xs line-clamp-4">{{ $description }}</deskripsi>
        <div class="w-full text-xs px-2 text-gray flex flex-row-reverse">
            <img src="asset/ic_view_gray.svg" alt="" class="w-[16px] mr-1">
            {{ $views }} 
        </div>
    </div>
</div>