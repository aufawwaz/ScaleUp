<?php
use Carbon\Carbon;
use App\Http\Controllers\NewsController;
?>

<x-layout 
  titlePage="Berita - ScaleUp"
  title="Berita"  
>
  <main class="main-container cursor-default">
    
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
          <a href="{{ route('news.show', $firstNews['article_id']) }}" class="w-[180px] py-1.5 mt-3 bg-primary rounded-2xl text-white text-xs cursor-pointer hover:bg-primary-800 flex items-center justify-center" style="transition: background-color 0.3s ease-out;">
            Pelajari selengkapnya →
          </a>
        @else
          <span class="w-[180px] py-1.5 mt-3 bg-gray-400 rounded-2xl text-white text-xs flex items-center justify-center opacity-60 cursor-not-allowed">Pelajari selengkapnya →</span>
        @endif
      </div>
    </div>

    {{-- news --}}
    <div id="news-point" class="flex flex-row w-full h-16 bg-primary text-white font-bold items-center px-5">
      Berita Terkini
    </div>
    <div id="news-container" class="container w-full flex flex-wrap gap-2 gap-y-4 p-5 justify-around">
      <p id="no-news" class="text-sm text-gray">Tidak ada berita lainnya saat ini</p>
    </div>

    {{-- pagination navigation --}}
    <div class="flex justify-center my-5">
      <button id="prev-page" class="px-4 py-2 mx-1 bg-gray-200 rounded hover:bg-gray-300 cursor-pointer" disabled>
        &laquo; Prev
      </button>
      <span id="page-info" class="px-4 py-2 mx-1 text-sm"></span>
      <button id="next-page" class="px-4 py-2 mx-1 bg-gray-200 rounded hover:bg-gray-300 cursor-pointer">
        Next &raquo;
      </button>
    </div>
  </main>
</x-layout>

<script>
  let currentPage = 1;
  const perPage = 9;
  let totalPages = 1;

  function triggerFadeMoveUp() {
    document.querySelectorAll('.fade-move-up').forEach(function(el, i) {
      el.classList.remove('show');
      setTimeout(() => el.classList.add('show'), 200 + i * 50);
    });
  }

  function fetchPage(page) {
    fetch(`{{ route('news.fetch') }}?page=${page}`)
      .then(response => {
        if (!response.ok) throw new Error('Gagal fetch');
        return response.json();
      })
      .then(data => {
        document.getElementById('news-container').innerHTML = data.html;
        totalPages = Math.max(1, Math.ceil(data.total / perPage));
        document.getElementById('page-info').textContent = `Halaman ${page} dari ${totalPages}`;
        document.getElementById('prev-page').disabled = page === 1;
        document.getElementById('next-page').disabled = page === totalPages;
        triggerFadeMoveUp();
      })
      .catch(err => console.error(err));
  }

  // pagination btn
  document.getElementById('prev-page').onclick = function() {
    if (currentPage > 1) {
      currentPage--;
      fetchPage(currentPage);
      document.getElementById('news-point').scrollIntoView({ behavior: 'smooth' });
    }
  };
  document.getElementById('next-page').onclick = function() {
    if (currentPage < totalPages) {
      currentPage++;
      fetchPage(currentPage);
      document.getElementById('news-point').scrollIntoView({ behavior: 'smooth' });
    }
  };

  // Initial load
  fetchPage(currentPage);

  // fade in
  document.getElementById('news-container').innerHTML = data.html;
  triggerFadeMoveUp();
</script>