<?php
use Carbon\Carbon;
use App\Http\Controllers\NewsController;
?>

<x-layout 
  titlePage="Berita - ScaleUp"
  title="Berita"
>
    <main class="main-container p-7 relative">
        <button onclick="window.location.href='{{ route('news') }}'" class="border-1 border-gray-400 text-gray text-xs rounded-md px-3 py-1.5 hover:bg-gray-100 hover:text-gray-500 hover:bordrer-500 cursor-pointer">
            &lt; Kembali
        </button>

        {{-- berita-nya --}}
        <div class="w-full p-5 flex flex-col gap-4">

            <div>
                <h1 class="text-3xl font-bold">{{ $news->title }}</h1>
                
                {{-- tanggal dan views --}}
                <inpo class="text-xs text-gray flex">
                    {{ Carbon::parse($news->date)->translatedFormat('d F Y') }} - 
                    {{ $news->view > 999 ? number_format($news->view / 1000, 1) . 'K' : $news->view }}
                    <img src="/asset/ic_view_gray.svg" alt="" class="w-[16px]">
                </inpo>
            </div>

            <img src={{ $news->image }} alt="" class="w-full h-200px">
            <p class="text-sm">{{ $news->content }}</p>
        </div>
    </main>
</x-layout>