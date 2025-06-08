<?php
use Carbon\Carbon;
use App\Http\Controllers\NewsController;
?>

<x-layout 
  titlePage="Berita - ScaleUp"
  title="Berita"  
>
  <main class="main-container cursor-default scrollbar-hidden">
    
    {{-- first news dijadiin header --}}
    <div class="flex flex-row w-full h-[400px] relative">
      {{-- bg img --}}
      <img src="{{ $firstNews['image_url'] ?? asset('asset/news_dummy_image.png') }}" alt="" class="absolute w-[90%] h-full object-cover right-0">
      {{-- gradient --}}
      <div class="w-[20%] absolute bg-white left-0 top-0 h-full z-[9]"></div>
      <div style="background: linear-gradient(90deg, white, transparent);" class="w-[40%] h-full absolute left-[19.9%] z-[9]"></div>
      
      {{-- info newsnya --}}
      <div class="w-[50%] h-full absolute pl-[7%] z-[10] flex flex-col justify-center gap-2">
        <judul class="text-3xl font-bold">{{ $firstNews['title'] }}</judul>
        <deskripsi class="text-xs line-clamp-3">{{ $firstNews['description'] }}</deskripsi>

        <inpo class="text-xs text-gray flex mt-1.5">
          {{ Carbon::parse($firstNews['pubDate'])->translatedFormat('d F Y') }} - 
          {{ $firstNews['source_id'] }}
        </inpo>

        {{-- pelajari selengkapnya --}}
        @if(isset($firstNews['article_id']))
          <a href="{{ route('news.show', $firstNews['article_id']) }}" class="w-[180px] py-1.5 mt-3 bg-primary rounded-2xl text-white text-xs cursor-pointer hover:bg-primary-800 flex items-center justify-center" style="transition: background-color 0.1s ease-out;">
            Pelajari selengkapnya →
          </a>
        @else
          <span class="w-[180px] py-1.5 mt-3 bg-gray-400 rounded-2xl text-white text-xs flex items-center justify-center opacity-60 cursor-not-allowed">Pelajari selengkapnya →</span>
        @endif
      </div>
    </div>

    {{-- news --}}
    <div id="news-point" class="flex flex-row w-full h-16 bg-primary text-white font-bold items-center px-5 rounded-b-2xl">
      Berita Terkini
    </div>
    <div id="news-container" class="container w-full flex flex-wrap gap-2 gap-y-4 p-5 justify-around">
      <p id="no-news" class="text-sm text-gray">Tidak ada berita lainnya saat ini</p>
    </div>

    {{-- pagination navigation --}}
    <div class="flex justify-center my-5">
      <button id="prev-page" class="px-4 py-2 mx-1 bg-gray-200 rounded hover:bg-gray-300 cursor-pointer disabled:hover:bg-gray-200 disabled:text-gray-500 disabled:cursor-default" disabled>
        &laquo; Prev
      </button>
      <span id="page-info" class="px-4 py-2 mx-1 text-sm"></span>
      <button id="next-page" class="px-4 py-2 mx-1 bg-gray-200 rounded hover:bg-gray-300 cursor-pointer disabled:hover:bg-gray-200 disabled:text-gray-500 disabled:cursor-default">
        Next &raquo;
      </button>
    </div>
  </main>
</x-layout>

<script>
  // pagination & fade-in untuk news card
  document.addEventListener('DOMContentLoaded', function(){
    let currentPage = 1;
    const perPage = 9;
    let totalPages = 1;

    const pageInfo = document.getElementById('page-info');
    const prevPage = document.getElementById('prev-page');
    const nextPage = document.getElementById('next-page');
    const container = document.getElementById('news-container');

    function triggerFadeMoveUp() {
      document.querySelectorAll('.fade-move-up-news').forEach((el, i) => {
        el.classList.remove('show-news');
        setTimeout(() => el.classList.add('show-news'), 100 + i * 50);
      });
    }

    function fetchPage(page) {
      fetch(`{{ route('news.fetch') }}?page=${page}`)
        .then(res => {
          if (!res.ok) throw new Error('Fetch gagal');
          return res.json();
        })
        .then(data => {
          console.log('Fetched data.html:', data.html);
          container.innerHTML = data.html;

          totalPages = Math.max(1, Math.ceil(data.total / perPage));
          pageInfo.textContent = `Halaman ${page} dari ${totalPages}`;
          
          prevPage.disabled = page === 1;
          nextPage.disabled = page === totalPages;
          // tunggu DOM render dulu baru animasi
          setTimeout(triggerFadeMoveUp, 50);
        })
        .catch(console.error);
    }

    prevPage.onclick = () => {
      if (currentPage > 1) {
        currentPage--;
        fetchPage(currentPage);
        document.getElementById('news-point').scrollIntoView({ behavior: 'smooth' });
      }
    };
    nextPage.onclick = () => {
      if (currentPage < totalPages) {
        currentPage++;
        fetchPage(currentPage);
        document.getElementById('news-point').scrollIntoView({ behavior: 'smooth' });
      }
    };

    // initial
    fetchPage(currentPage);
  });
</script>

<style>
    .fade-move-up-news {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.3s ease;
    }
    .fade-move-up-news.show-news {
        opacity: 1;
        transform: translateY(0);
    }
</style>