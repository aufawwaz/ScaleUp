<?php
use Carbon\Carbon;
use App\Http\Controllers\NewsController;
?>

<x-layout 
  titlePage="Berita - ScaleUp"
  title="Berita"
>
    <main class="main-container p-7 relative cursor-default">
        <button onclick="window.location.href='{{ route('news') }}'" class="border-1 border-gray-400 text-gray text-xs rounded-md px-3 py-1.5 hover:bg-gray-100 hover:text-gray-500 hover:bordrer-500 cursor-pointer">
            &lt; Kembali
        </button>

        {{-- berita-nya --}}
        <div class="w-full p-5 flex flex-col gap-4">

            <div>
                <h1 class="text-3xl font-bold">{{ $news['title'] }}</h1>
                
                {{-- tanggal dan views --}}
                <inpo class="text-sm text-gray flex items-center gap-0.5">
                    <a href="{{ $news['source_url'] }}" target="_blank" rel="noopener noreferrer">
                        <div class="flex flex-row py-0.5 px-1 hover:bg-primary hover:text-white gap-1 cursor-pointer rounded-sm transition">
                            <img src="{{ $news['source_icon'] }}" alt="" class="h-5 w-5"> 
                            {{ $news['source_id'] }}
                        </div>
                    </a>
                    -
                    {{ Carbon::parse($news['pubDate'])->translatedFormat('d F Y') }}
                </inpo>
            </div>

            <img src={{ $news['image_url'] ?? asset('asset/news_dummy_image.png') }} alt="" class="w-full h-200px">
            <p class="text-sm">{{ $news['description'] }}</p>
            {{-- Content ternyata fitur berbayar :( --}}
            <p class="text-sm">{{ $news['content'] == "ONLY AVAILABLE IN PAID PLANS" ? " " : $news['content']}}</p> 
        </div>
    </main>
</x-layout>