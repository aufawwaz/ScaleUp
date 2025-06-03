<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $titlePage }}</title>
  @vite('resources/css/app.css')  

  <!-- AlpineJs -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-poppins text-dark h-[100dvh] w-full">
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