<x-layout
  titlePage="Product - ScaleUp"
  title="Produk"  
>
  <main class="main-container">
    <div class="flex flex-col gap-[1rem] w-full p-[1rem]">
      <!-- Header -->
      <x-header-page title="DATA PRODUK">
        <a href="{{ route('product.create') }}" class="bg-primary text-white rounded-xl text-xs px-4 py-2">Tambah Produk</a>
      </x-header-page>

      <!-- Filter Search -->
      <div class="w-full flex gap-[0.5rem] h-[32px]">
        <p class="text-xs h-full flex items-center">Filter</p>
        <x-filter-button label="Hari Ini" value="today"   :active="request('filter')" />
        <x-filter-button label="Minggu Ini" value="week"  :active="request('filter')" />
        <x-filter-button label="Bulan Ini" value="month"  :active="request('filter')" />
        <x-filter-button label="Tahun Ini" value="year"   :active="request('filter')" />
      </div>

      <!-- Produk Grid -->
      <div class="grid grid-cols-4 gap-[1rem] mt-4">
          @foreach($products as $product)
              <x-product-card :product="$product" />
          @endforeach
      </div>
    </div>
  </main>
</x-layout>