<div onclick="
        @if(isset($id))window.location.href='{{ route('news.show', $id) }}'
        @else event.preventDefault();@endif" 
    class="w-[280px] h-[250px] bg-white hover:bg-[#ddd] shadow-md cursor-pointer fade-move-up-news rounded-md"
>
    {{-- gambar --}}
    <div class="relative">
        @if (empty($image))
            <img src="asset/news_dummy_image.png" alt="" class="w-full h-[120px] object-cover">
        @else
            <img src={{ $image }} alt="" class="w-full h-[120px] object-cover rounded-t-md">
        @endif
        <div style="background: linear-gradient(transparent, black);" class="absolute w-full h-[40px] bottom-0 z-[9]"></div>
        <tanggal class="text-white text-xs z-[10] absolute bottom-2 left-4">{{ $date }}</tanggal>
    </div>

    {{-- teksnya --}}
    <div class="container p-2 h-[130px] flex flex-col justify-between">
        <div>
            <judul class="text-base font-bold line-clamp-2">{{ $title }}</judul>
            <deskripsi class="text-xs line-clamp-3">{{ $description }}</deskripsi>
        </div>
        <div class="w-full text-xs text-gray flex flex-row-reverse bottom-0">
            {{ $source }}
        </div>
    </div>
</div>