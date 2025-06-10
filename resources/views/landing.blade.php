<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ScaleUp - Kelola Bisnis Lebih Efisien</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@headlessui/react@latest/dist/headlessui.umd.js"></script>
    @vite('resources/css/app.css')  
</head>
<body class="font-poppins bg-white text-dark">
  <!-- Navbar -->
  <nav class="fixed top-0 left-0 w-full bg-white shadow z-50">
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
        <a href="#fitur" class="hover:text-[#007AFF] transition">Home</a>
        <a href="#fitur" class="hover:text-[#007AFF] transition">About</a>
        <a href="#fitur" class="hover:text-[#007AFF] transition">Fitur</a>
        <a href="#harga" class="hover:text-[#007AFF] transition">Harga</a>
        <a href="#faq" class="hover:text-[#007AFF] transition">FAQ</a>
        <x-custom-button
        href="{{ route('login') }}"
        >Login</x-custom-button>
      </div>
      <div class="md:hidden">
        <!-- Mobile menu button -->
        <button id="menuBtn" class="focus:outline-none">
          <svg class="w-7 h-7 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
      <a href="#fitur" class="block py-2">Fitur</a>
      <a href="#harga" class="block py-2">Harga</a>
      <a href="#faq" class="block py-2">FAQ</a>
      <a href="/login" class="block py-2 text-[#007AFF] font-semibold">Login</a>
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
      <div class="flex-1">
        <h1 class="text-3xl md:text-5xl font-bold mb-5 leading-tight">Kelola Bisnis Lebih Efisien dengan <span class="text-[#007AFF]">ScaleUp</span></h1>
        <p class="text-lg md:text-base mb-8">Solusi manajemen bisnis untuk pemilik usaha. Keuangan, produk, pelanggan dalam satu platform</p>
        <div class="flex gap-4 mb-8">
          <x-custom-button href="{{ route('register') }}" size="md"><span class="text-sm font-semibold">Coba Gratis</span></x-custom-button>
          <x-custom-button href="#fitur" size="md" outline="true"><span class="text-sm">Lihat Fitur Premium</span></x-custom-button>
        </div>
      </div>
      <div class="flex-1 flex justify-center">
        <div class="w-[340px] h-[260px] md:w-[700px] rounded-2xl flex items-center justify-center text-gray-400 text-xl">
          <img src="{{ asset('asset/mockup_dashboard.svg') }}" alt="">
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang ScaleUp -->
  <section class="py-16 bg-gray-50" id="tentang">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-2xl md:text-3xl font-bold mb-4">Apa itu ScaleUp?</h2>
      <p class="text-gray-600 mb-6">ScaleUp adalah platform digital yang membantu pemilik usaha mengelola bisnis lebih efisien, memberikan edukasi, dan solusi digital terintegrasi untuk keuangan, produk, dan pelanggan. Dengan fitur lengkap dan mudah digunakan, ScaleUp mendukung pertumbuhan UMKM di era digital.</p>
      <div class="flex flex-wrap justify-center gap-8 mt-8">
        <div class="flex flex-col items-center">
          <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-2">
            <svg class="w-7 h-7 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6a2 2 0 012-2h12a2 2 0 012 2v8c0 2.21-3.582 4-8 4z"/></svg>
          </div>
          <span class="font-semibold">Efisiensi</span>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-2">
            <svg class="w-7 h-7 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 0l-9-5m9 5l9-5"/></svg>
          </div>
          <span class="font-semibold">Edukasi</span>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-2">
            <svg class="w-7 h-7 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m4 0a4 4 0 00-4-4H7a4 4 0 00-4 4v4a4 4 0 004 4h3"/></svg>
          </div>
          <span class="font-semibold">Solusi Digital</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur Utama -->
  <section class="py-16 bg-white" id="fitur">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-4xl font-bold mb-12">Berbisnis Jadi Lebih Mudah</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Dashboard -->
        <div class="border border-gray-300 rounded-xl p-8 flex flex-col bg-white">
          <div class="font-bold text-2xl mb-2">Dashboard</div>
          <div>
            <img src="{{ asset('asset/mockup_dashboard.svg') }}" alt="">
          </div>
          <div class="text-gray-500">User-friendly interface and easy navigation for less training.</div>
        </div>
        <!-- Product Management -->
        <!-- Transaction Management -->
        <!-- Contact Management -->
        <!-- Saldo Management -->
        <!-- Knowledge Card -->
      </div>
    </div>
  </section>

  <!-- Keuntungan -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Keuntungan Menggunakan ScaleUp</h2>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-8 h-8 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V6a2 2 0 012-2h12a2 2 0 012 2v8c0 2.21-3.582 4-8 4z"/></svg>
          </div>
          <div class="font-semibold mb-1">Mudah Digunakan</div>
          <div class="text-gray-500 text-sm">Antarmuka intuitif, cocok untuk semua kalangan.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-8 h-8 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2z"/></svg>
          </div>
          <div class="font-semibold mb-1">Aman & Terpercaya</div>
          <div class="text-gray-500 text-sm">Data bisnis tersimpan aman dan terenkripsi.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-8 h-8 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          </div>
          <div class="font-semibold mb-1">Terintegrasi</div>
          <div class="text-gray-500 text-sm">Satu platform untuk semua kebutuhan bisnis.</div>
        </div>
        <div class="flex flex-col items-center text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-8 h-8 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div class="font-semibold mb-1">Dukungan Penuh</div>
          <div class="text-gray-500 text-sm">Tim support siap membantu kapan saja.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Paket Harga -->
  <section class="py-16 bg-white" id="harga">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Pilih Paket Sesuai Kebutuhanmu</h2>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="bg-gray-50 rounded-xl shadow p-6 flex flex-col items-center">
          <div class="text-lg font-semibold mb-2">Bulanan</div>
          <div class="text-2xl font-bold mb-4">Rp49.000</div>
          <a href="#" class="w-full text-center py-2 bg-[#007AFF] text-white rounded-full font-semibold hover:bg-blue-700 transition">Beli Sekarang</a>
        </div>
        <div class="bg-gray-50 rounded-xl shadow p-6 flex flex-col items-center relative">
          <span class="absolute top-3 right-3 bg-green-400 text-white text-xs font-bold px-3 py-1 rounded-full">hemat 20%</span>
          <div class="text-lg font-semibold mb-2">Tahunan</div>
          <div class="text-2xl font-bold mb-4">Rp469.000</div>
          <a href="#" class="w-full text-center py-2 bg-[#007AFF] text-white rounded-full font-semibold hover:bg-blue-700 transition">Beli Sekarang</a>
        </div>
        <div class="bg-gray-50 rounded-xl shadow p-6 flex flex-col items-center">
          <div class="text-lg font-semibold mb-2">Sekali Bayar Bulan</div>
          <div class="text-2xl font-bold mb-4">Rp59.000</div>
          <a href="#" class="w-full text-center py-2 bg-[#007AFF] text-white rounded-full font-semibold hover:bg-blue-700 transition">Beli Sekarang</a>
        </div>
        <div class="bg-gray-50 rounded-xl shadow p-6 flex flex-col items-center">
          <div class="text-lg font-semibold mb-2">Sekali Bayar Minggu</div>
          <div class="text-2xl font-bold mb-4">Rp19.000</div>
          <a href="#" class="w-full text-center py-2 bg-[#007AFF] text-white rounded-full font-semibold hover:bg-blue-700 transition">Beli Sekarang</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni Pengguna -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-10/12 mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Testimoni Pengguna</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
          <div class="w-16 h-16 bg-gray-200 rounded-full mb-3"></div>
          <div class="font-semibold">Rina, Toko Kue</div>
          <div class="text-gray-500 text-sm mt-2 text-center">“ScaleUp sangat membantu saya memantau keuangan dan stok toko setiap hari!”</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
          <div class="w-16 h-16 bg-gray-200 rounded-full mb-3"></div>
          <div class="font-semibold">Budi, Laundry</div>
          <div class="text-gray-500 text-sm mt-2 text-center">“Fitur gratisnya sudah cukup lengkap, apalagi kalau upgrade ke PRO!”</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center">
          <div class="w-16 h-16 bg-gray-200 rounded-full mb-3"></div>
          <div class="font-semibold">Sari, Fashion Store</div>
          <div class="text-gray-500 text-sm mt-2 text-center">“Dashboardnya mudah dipahami, cocok untuk pemula.”</div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="py-16 bg-white" id="faq">
    <div class="max-w-4xl mx-auto px-4">
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">Pertanyaan Umum</h2>
      <div class="space-y-4">
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
    </div>
  </section>

  <!-- Bottom CTA -->
  <section class="py-16 bg-[#007AFF]">
    <div class="max-w-3xl mx-auto px-4 text-center">
      <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">Siap Tingkatkan Efisiensi Bisnismu?</h2>
      <a href="/register" class="px-8 py-4 bg-white text-[#007AFF] rounded-full font-bold text-lg shadow hover:bg-blue-50 transition">Coba Gratis Sekarang</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-8">
    <div class="max-w-10/12 mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <a href="#fitur" class="hover:text-[#007AFF]">Fitur</a>
        <a href="#harga" class="hover:text-[#007AFF]">Harga</a>
        <a href="#faq" class="hover:text-[#007AFF]">FAQ</a>
        <a href="/login" class="hover:text-[#007AFF]">Login</a>
      </div>
      <div class="flex gap-4 items-center mt-4 md:mt-0">
        <a href="mailto:support@scaleup.com" class="hover:text-[#007AFF] text-sm">support@scaleup.com</a>
        <a href="#" class="hover:text-[#007AFF]">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.56v14.91c0 2.52-2.05 4.57-4.57 4.57H4.57C2.05 24 0 21.95 0 19.47V4.56C0 2.05 2.05 0 4.57 0h14.86C21.95 0 24 2.05 24 4.56zM8.09 19.47V9.53H5.09v9.94h3zm-1.5-11.25c.97 0 1.75-.79 1.75-1.75s-.78-1.75-1.75-1.75-1.75.79-1.75 1.75.78 1.75 1.75 1.75zm15.41 11.25v-4.99c0-2.66-1.42-3.9-3.32-3.9-1.53 0-2.22.84-2.6 1.43v-1.23h-3v9.94h3v-4.94c0-1.3.25-2.57 1.87-2.57 1.61 0 1.63 1.5 1.63 2.66v4.85h3z"/></svg>
        </a>
        <a href="#" class="hover:text-[#007AFF]">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.56v14.91c0 2.52-2.05 4.57-4.57 4.57H4.57C2.05 24 0 21.95 0 19.47V4.56C0 2.05 2.05 0 4.57 0h14.86C21.95 0 24 2.05 24 4.56zM8.09 19.47V9.53H5.09v9.94h3zm-1.5-11.25c.97 0 1.75-.79 1.75-1.75s-.78-1.75-1.75-1.75-1.75.79-1.75 1.75.78 1.75 1.75 1.75zm15.41 11.25v-4.99c0-2.66-1.42-3.9-3.32-3.9-1.53 0-2.22.84-2.6 1.43v-1.23h-3v9.94h3v-4.94c0-1.3.25-2.57 1.87-2.57 1.61 0 1.63 1.5 1.63 2.66v4.85h3z"/></svg>
        </a>
      </div>
      <div class="text-xs text-gray-400 mt-4 md:mt-0">&copy; {{ date('Y') }} ScaleUp. All rights reserved.</div>
    </div>
  </footer>
</body>
</html>
