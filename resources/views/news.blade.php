<?php
use Carbon\Carbon;
?>

<x-layout 
  titlePage="Berita - ScaleUp"
  title="Berita"  
>
  <main class="main-container">
    
    {{-- most popular news ==> ditampilin di header news ges ya ges --}}
    <div class="flex flex-row w-full h-[400px] relative">
      {{-- bg img --}}
      <img src="asset/news_dummy_image.png" alt="" class="absolute w-[90%] h-full object-cover right-0">
      {{-- gradient --}}
      <div class="w-[20%] absolute bg-white left-0 top-0 h-full z-[9]"></div>
      <div style="background: linear-gradient(90deg, white, transparent);" class="w-[40%] h-full absolute left-[19.9%] z-[9]"></div>
      
      {{-- info newsnya --}}
      <div class="w-[50%] h-full absolute pl-[7%] z-[10] flex flex-col justify-center gap-2">
        <judul class="text-3xl font-bold">{{ $mostPopularNews->title }}</judul>
        <deskripsi class="text-xs">{{ $mostPopularNews->description }}</deskripsi>
        <inpo class="text-xs text-gray flex mt-1.5">
          {{ Carbon::parse($mostPopularNews->date)->translatedFormat('d F Y') }} - 
          {{ $mostPopularNews->view > 999 ? number_format($mostPopularNews->view / 1000, 1) . 'K' : $mostPopularNews->view }}
          <img src="asset/ic_view_gray.svg" alt="" class="w-[16px] mr-1">
        </inpo>
        <button onclick="" class="w-[180px] py-1.5 mt-3 bg-primary rounded-2xl text-white text-xs cursor-pointer hover:bg-primary-800" style="transition: background-color 0.3s ease-out;">
          Pelajari selengkapnya →
        </button>
      </div>

    </div>

    <div class="flex flex-row w-full h-16 bg-primary text-white font-bold items-center px-5">
      Berita Terkini
    </div>
    <div class="container w-full flex flex-wrap gap-2 p-5 justify-around">
      @foreach ($data as $da)
        <x-news-card :news="$da"/>
      @endforeach
    </div>
  </main>
</x-layout>