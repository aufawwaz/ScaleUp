<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $titlePage }}</title>
  @vite('resources/css/app.css')  

  <!-- AlpineJs -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Chart.js Script -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- AOS Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="font-poppins text-dark h-[100dvh] w-full">
  <!-- AOS Initialization -->
  <script>
    AOS.init({
      duration: 500, 
      once: false, 
    });
  </script>

  <!-- Sidebar component -->
  <x-sidebar/>

  <!-- Header component -->
  <x-header
    :title="$title"
    userName="Biru"
    date="12 Maret 2025"
    imgSrc="{{ asset('asset/Light logo.png') }}"
  />

  {{ $slot }}
</body>
</html>

<style>
    .fade-move-up {
        opacity: 0;
        transform: translateY(40px);
    }
    .fade-move-up.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fade-move-up').forEach(function(el, i) {
            setTimeout(() => el.classList.add('show'), 200 + i * 150);
        });
    });
</script>