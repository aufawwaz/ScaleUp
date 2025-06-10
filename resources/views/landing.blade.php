<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ScaleUp - Kelola Bisnis Lebih Efisien</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@headlessui/react@latest/dist/headlessui.umd.js"></script>
    @vite('resources/css/app.css')  
  <!-- AOS Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="font-poppins bg-white text-dark scroll-smooth overflow-x-hidden">
  <script>
    AOS.init({
      duration: 1000, 
      once: false, 
    });
  </script>
  <!-- Navbar -->
  <nav class="fixed top-0 left-0 w-full bg-white shadow z-50" data-aos="fade-down">
    <div class="w-10/12 mx-auto flex items-center justify-between px-4 py-3">
      <div class="flex items-center gap-2">
        <div class="flex items-center justify-center gap-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 500 500" class="mr-[-6px]">
          <path fill="#007AFF" d="M176 112c3.225 2.709 6.177 5.644 9.135 8.64l2.611 2.597c2.368 2.358 4.726 4.725 7.081 7.096 2.55 2.564 5.112 5.116 7.672 7.669 5.005 4.995 9.999 10 14.99 15.009a13101.85 13101.85 0 0 0 17.475 17.495 29616.608 29616.608 0 0 1 31.182 31.229 28755.761 28755.761 0 0 0 30.229 30.269l1.883 1.883 1.879 1.879a56065.038 56065.038 0 0 1 34.472 34.501c4.056 4.061 8.113 8.121 12.171 12.179 4.947 4.949 9.891 9.902 14.83 14.859 2.518 2.527 5.037 5.052 7.561 7.573 2.739 2.737 5.471 5.482 8.202 8.228l2.403 2.393c6.18 6.234 11.776 12.434 15.036 20.689l1.208 2.98c3.893 11.247 2.651 23.021-2.02 33.832-2.042 3.613-4.351 6.81-7 10l-1.586 1.961c-7.117 7.95-17.88 12.498-28.406 13.254-14.172.417-25.221-3.533-35.559-13.178l-1.687-1.568c-8.722-8.171-17.125-16.676-25.578-25.124l-5.912-5.897c-5.319-5.305-10.633-10.614-15.947-15.923l-9.974-9.963a72152.909 72152.909 0 0 1-27.677-27.651l-1.782-1.78-1.785-1.785-3.58-3.578-1.793-1.793a39150.464 39150.464 0 0 0-28.841-28.796 36081.995 36081.995 0 0 1-29.687-29.651 16288.45 16288.45 0 0 0-16.639-16.613 8196.02 8196.02 0 0 1-14.146-14.134 3057.677 3057.677 0 0 0-7.209-7.198 2512.175 2512.175 0 0 1-7.827-7.83l-2.281-2.257c-10.691-10.791-17.113-21.581-17.604-37.058.426-13.798 6.169-25.005 16.02-34.512C136.01 97.57 157.409 99.3 176 112Zm-2 158c9.169 7.902 17.673 16.535 26.214 25.1l4.143 4.143c3.712 3.712 7.421 7.427 11.13 11.142 3.89 3.897 7.782 7.79 11.675 11.684 7.354 7.357 14.705 14.716 22.056 22.077 8.375 8.386 16.753 16.77 25.132 25.154A209799.1 209799.1 0 0 1 326 421c-1.654 4.509-3.923 7.466-7.312 10.812l-1.606 1.589c-14.951 14.299-34.844 21.143-55.325 20.952-27.642-.824-45.75-15.21-64.518-33.953l-2.783-2.768a5803.053 5803.053 0 0 1-7.456-7.431l-4.672-4.662c-4.891-4.877-9.78-9.756-14.667-14.639a11121.16 11121.16 0 0 0-16.851-16.8 8486.91 8486.91 0 0 1-13.094-13.061 3358.493 3358.493 0 0 0-7.794-7.769c-2.901-2.882-5.79-5.776-8.679-8.67a8595.57 8595.57 0 0 0-2.579-2.551c-10.568-10.643-16.694-21.299-17.164-36.612.429-13.895 6.221-25.053 16.168-34.582C134.27 257.646 157.04 257.577 174 270ZM282.167 60.64c6.333 4.975 12.094 10.33 17.777 16.03l2.843 2.826c2.543 2.53 5.081 5.068 7.616 7.606 2.128 2.129 4.259 4.255 6.39 6.38 5.03 5.02 10.054 10.043 15.075 15.07 5.16 5.167 10.33 10.324 15.504 15.477a8017.32 8017.32 0 0 1 13.374 13.353c2.65 2.653 5.303 5.303 7.961 7.947 2.964 2.949 5.916 5.91 8.866 8.872l2.636 2.612c6.279 6.334 11.928 12.987 15.103 21.437l.926 2.391c3.602 11.156 2.367 22.701-2.238 33.359-2.042 3.613-4.351 6.81-7 10l-1.586 1.961c-7.117 7.95-17.88 12.498-28.406 13.254-14.444.425-25.405-3.701-35.902-13.518l-1.713-1.594c-6.721-6.29-13.222-12.799-19.72-19.317l-4.144-4.143c-3.708-3.708-7.413-7.419-11.117-11.13-3.887-3.893-7.778-7.784-11.667-11.675a65462.91 65462.91 0 0 1-22.035-22.056 99162.27 99162.27 0 0 0-25.11-25.132C208.397 113.437 191.197 96.22 174 79c4.662-12.56 18.637-20.787 30.102-26.563 25.708-11.395 55.536-8.847 78.065 8.203Z"/>
        </svg>
        <p class="text-2xl font-medium text-primary">cale<span class="font-bold">Up</span></p>
      </div>
      </div>
      <div class="hidden md:flex gap-8 items-center">
        <a href="#hero" class="hover:text-primary transition">Home</a>
        <a href="#tentang" class="hover:text-primary transition">About</a>
        <a href="#fitur" class="hover:text-primary transition">Fitur</a>
        <a href="#faq" class="hover:text-primary transition">FAQ</a>
        <x-custom-button
        href="{{ route('login') }}"
        >Login</x-custom-button>
      </div>
      <div class="md:hidden">
        <!-- Mobile menu button -->
        <button id="menuBtn" class="focus:outline-none">
          <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
      <a href="#fitur" class="block py-2">Fitur</a>
      <a href="#harga" class="block py-2">Harga</a>
      <a href="#faq" class="block py-2">FAQ</a>
      <a href="/login" class="block py-2 text-primary font-semibold">Login</a>
    </div>
    <script>
      document.getElementById('menuBtn').onclick = function() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
      };
    </script>
  </nav>

  <!-- Hero Section -->
  <section class="pt-28 pb-16 bg-white h-dvh flex" id="hero">
    <div class="max-w-10/12 mx-auto flex flex-col md:flex-row items-center gap-10 px-4">
      <div class="flex-1" data-aos="fade-up">
        <h1 class="text-3xl md:text-5xl font-bold mb-5 leading-tight">Kelola Bisnis Lebih Efisien dengan <span class="text-primary">ScaleUp</span></h1>
        <p class="text-lg md:text-base mb-8">Solusi manajemen bisnis untuk pemilik usaha. Keuangan, produk, pelanggan dalam satu platform</p>
        <div class="flex gap-4 mb-8">
          <x-custom-button href="{{ route('register') }}" size="md" data-aos="zoom-in"><span class="text-sm font-semibold">Coba Gratis</span></x-custom-button>
          <x-custom-button href="#fitur" size="md" outline="true" data-aos="zoom-in"><span class="text-sm">Lihat Fitur</span></x-custom-button>
        </div>
      </div>
      <div class="flex-1 flex justify-center" data-aos="fade-left">
        <div class="w-[340px] h-[260px] md:w-[700px] rounded-2xl flex items-center justify-center text-gray-400 text-xl">
          <img src="{{ asset('asset/mockup_dashboard.svg') }}" alt="">
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang ScaleUp -->
  <section class="py-16 bg-gray-50" id="tentang">
    <div class="max-w-10/12 mx-auto">
      <h2 class="text-3xl md:text-4xl font-bold text-left mt-10 mb-10" data-aos="fade-right">Apa itu <span class="text-primary">ScaleUp?</span></h2>
      <div class="flex gap-[8rem]">
        <img src="{{ asset('asset/onboard_1.svg') }}" alt="" class="w-1/4 pl-10" data-aos="fade-up">
        <p class="text-gray-600 w-3/4 text-lg text-left mb-12" data-aos="fade-left">ScaleUp adalah platform digital terpadu yang dirancang untuk membantu pemilik usaha dalam mengelola bisnis secara lebih efisien dan profesional. Melalui fitur-fitur seperti pencatatan keuangan otomatis, manajemen produk, dan pengelolaan pelanggan, ScaleUp memungkinkan pelaku usaha—khususnya UMKM—untuk menjalankan operasional harian dengan lebih mudah, terstruktur, dan hemat waktu. Selain fungsi manajerial, ScaleUp juga menyediakan konten edukatif yang relevan guna meningkatkan pemahaman pengguna dalam aspek bisnis, keuangan, dan strategi pengembangan usaha. Dengan antarmuka yang sederhana namun fungsional, ScaleUp hadir sebagai solusi modern yang mendorong efisiensi, pertumbuhan, dan digitalisasi usaha di tengah tantangan dunia bisnis yang terus berkembang.</p>
      </div>
    </div>
  </section>
  
  <!-- Fitur Utama -->
  <section class="py-16 bg-white" id="fitur">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-4xl font-bold mt-10 mb-12" data-aos="fade-up">Berbisnis Jadi Lebih Mudah</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Dashboard</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_dashboard.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Lihat semua aktivitas penting bisnis secara menyeluruh mulai dari produk, transaksi, hingga saldo langsung dari halaman utama.</div>
        </div>
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Kelola Produk</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_produk.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Tambah, edit, dan atur semua produk jualanmu dengan mudah. Cocok untuk usaha dengan banyak variasi barang.</div>
        </div>
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Transaksi</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_transaksi.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Layani pelanggan, catat pembelian stok, dan kelola tagihan dengan sistem kasir digital yang efisien dan mudah digunakan.</div>
        </div>
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Relasi Kontak</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_kontak.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Kelola informasi pelanggan, supplier, atau mitra usaha tanpa batas. Cocok untuk membangun relasi jangka panjang.</div>
        </div>
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Kartu Saldo</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_saldo.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Lihat saldo kas masuk dan keluar secara langsung. Mudah untuk memantau keuangan harian usaha.</div>
        </div>
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col gap-6 bg-white" data-aos="fade-up">
          <div class="font-bold text-2xl mb-2">Insight Bisnis</div>
          <div data-aos="zoom-in">
            <img src="{{ asset('asset/mockup_berita.svg') }}" alt="">
          </div>
          <div class="text-gray-500">Dapatkan berita, artikel, dan tips bisnis terkini yang relevan untuk UMKM. Bantu kamu mengambil langkah strategis ke depan.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Keuntungan -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-10/12 mx-auto px-4" data-aos="fade-left">
      <h2 class="text-2xl md:text-4xl font-bold text-center mb-12">Keuntungan Menggunakan <span class="text-primary">ScaleUp</span></h2>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#007AFF"><path d="M480-260q53 0 100.5-23t76.5-67q11-17 3-33.5T634-400q-8 0-14.5 3.5T609-386q-23 31-57 48.5T480-320q-38 0-72-17.5T351-386q-5-7-11.5-10.5T325-400q-18 0-26 16t3 32q29 45 76.5 68.5T480-260Zm140-260q25 0 42.5-17.5T680-580q0-25-17.5-42.5T620-640q-25 0-42.5 17.5T560-580q0 25 17.5 42.5T620-520Zm-280 0q25 0 42.5-17.5T400-580q0-25-17.5-42.5T340-640q-25 0-42.5 17.5T280-580q0 25 17.5 42.5T340-520ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Z"/></svg>
          </div>
          <div class="font-semibold mb-1">Mudah Digunakan</div>
          <div class="text-gray-500 text-sm">Antarmuka intuitif, cocok untuk semua kalangan.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#007AFF"><path d="m438-452-56-56q-12-12-28-12t-28 12q-12 12-12 28.5t12 28.5l84 85q12 12 28 12t28-12l170-170q12-12 12-28.5T636-593q-12-12-28.5-12T579-593L438-452Zm42 368q-7 0-13-1t-12-3q-135-45-215-166.5T160-516v-189q0-25 14.5-45t37.5-29l240-90q14-5 28-5t28 5l240 90q23 9 37.5 29t14.5 45v189q0 140-80 261.5T505-88q-6 2-12 3t-13 1Zm0-80q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z"/></svg>
          </div>
          <div class="font-semibold mb-1">Aman & Terpercaya</div>
          <div class="text-gray-500 text-sm">Data bisnis tersimpan aman dan terenkripsi.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          </div>
          <div class="font-semibold mb-1">Terintegrasi</div>
          <div class="text-gray-500 text-sm">Satu platform untuk semua kebutuhan bisnis.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#007AFF"><path d="M480-280q17 0 28.5-11.5T520-320v-160q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480v160q0 17 11.5 28.5T480-280Zm0-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
          </div>
          <div class="font-semibold mb-1">Dukungan Penuh</div>
          <div class="text-gray-500 text-sm">Tim support siap membantu kapan saja.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni Pengguna -->
  <section class="py-16 bg-white" data-aos="fade-up">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-4xl font-bold text-center mb-12">Testimoni Pengguna</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-full p-6 flex flex-col items-center">
          <div class="w-50 h-50 bg-gray-200 rounded-full mb-4">
            <img src="{{ asset('asset\testi_1.png') }}" alt="" class="rounded-full object-cover">
          </div>
          <div class="font-semibold text-lg mb-2">Aril Fadla Hudallah</div>
          <div class="text-gray-500 text-sm mt-2 text-center">"Sejak pakai ScaleUp, pencatatan keuangan usaha saya jadi jauh lebih rapi. Dulu saya bingung menghitung untung rugi, sekarang semua otomatis dan jelas. Saya juga suka fitur edukasinya, banyak insight yang membantu mengembangkan bisnis kecil saya."</div>
        </div>
        <div class="bg-white rounded-xl p-6 flex flex-col items-center">
          <div class="w-50 h-50 bg-gray-200 rounded-full overflow-hidden mb-4">
            <img src="{{ asset('asset\testi_2.png') }}" alt="" class="rounded-full object-cover">
          </div>
          <div class="font-semibold text-lg mb-2">Ariel Josua S.</div>
          <div class="text-gray-500 text-sm mt-2 text-center">"ScaleUp sangat memudahkan saya dalam mengatur stok dan transaksi. Produk saya sudah ratusan, tapi semua bisa saya kelola dengan mudah lewat satu dashboard. Aplikasi ini cocok banget buat UMKM yang ingin naik level secara digital."</div>
        </div>
        <div class="bg-white rounded-xl p-6 flex flex-col items-center">
          <div class="w-50 h-50 bg-gray-200 rounded-full mb-4">
            <img src="{{ asset('asset\testi_3.png') }}" alt="" class="rounded-full object-cover">
          </div>
          <div class="font-semibold text-lg mb-2">Aufa Fawwaz Aryasatya</div>
          <div class="text-gray-500 text-sm mt-2 text-center">"Manajemen pelanggan jadi lebih tertata dengan ScaleUp. Saya bisa simpan data pelanggan dan riwayat servis mereka tanpa catatan manual lagi. Harganya juga terjangkau, fitur-fitur premiumnya sangat worth it buat usaha jasa seperti saya."</div>
        </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="py-16 bg-white" id="faq" data-aos="fade-right">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center">Pertanyaan Umum</h2>
      <div class="flex gap-[8rem]">
        <div class="flex w-full flex-col gap-6 transition-all">
          <details class="bg-gray-50 rounded-lg p-4">
            <summary class="font-semibold cursor-pointer">Apakah ScaleUp gratis selamanya?</summary>
            <div class="mt-2 text-gray-600">ScaleUp menyediakan fitur gratis dan fitur premium berbayar. Fitur gratis dapat digunakan tanpa batas waktu.</div>
          </details>
          <details class="bg-gray-50 rounded-lg p-4">
            <summary class="font-semibold cursor-pointer">Bagaimana cara upgrade ke PRO?</summary>
            <div class="mt-2 text-gray-600">Kamu bisa upgrade ke PRO melalui menu harga di aplikasi atau hubungi tim support kami.</div>
          </details>
          <details class="bg-gray-50 rounded-lg p-4">
            <summary class="font-semibold cursor-pointer">Apakah data saya aman di ScaleUp?</summary>
            <div class="mt-2 text-gray-600">Data kamu tersimpan aman di server kami dan terenkripsi.</div>
          </details>
        </div>
        <img src="{{ asset('asset/onboard_3.svg') }}" alt="" class="w-1/4 pr-10" data-aos="fade-up">
      </div>
    </div>
  </section>

  <!-- Bottom CTA -->
  <section data-aos="fade-up">
    <section class="py-16 bg-primary" >
      <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">Siap Tingkatkan Efisiensi Bisnismu?</h2>
        <a href="/register" class="px-8 py-4 bg-white text-primary rounded-full font-bold text-lg shadow hover:bg-blue-50 transition">Coba Gratis Sekarang</a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
      <div class="max-w-10/12 mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex gap-4 items-center mt-4 md:mt-0">
          <a href="mailto:support@scaleup.com" class="hover:text-primary text-sm">support@scaleup.com</a>
        </div>
        <div class="text-xs text-gray-400 mt-4 md:mt-0">&copy; {{ date('Y') }} ScaleUp. All rights reserved.</div>
      </div>
    </footer>
  </section>

  <script>
  // Smooth scrolling for navbar links
  document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Highlight active navbar link on scroll
  const sections = document.querySelectorAll('section');
  const navLinks = document.querySelectorAll('nav a[href^="#"]');

  window.addEventListener('scroll', () => {
    let currentSection = '';

    sections.forEach(section => {
      const sectionTop = section.offsetTop - 300;
      const sectionHeight = section.offsetHeight;
      if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
        currentSection = section.getAttribute('id');
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('text-primary', 'font-bold');
      if (link.getAttribute('href').substring(1) === currentSection) {
        link.classList.add('text-primary', 'font-bold');
      }
    });
  });
</script>
</body>
</html>
