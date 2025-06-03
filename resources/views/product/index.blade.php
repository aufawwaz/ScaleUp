<x-layout
  titlePage="Product - ScaleUp"
  title="Produk"  
>
  <main class="main-container">
    <div class="flex flex-col gap-[1rem] w-full p-[1rem]">
      <!-- Header -->
      <x-header-page title="DATA PRODUK">
        <x-custom-button href="{{ route('product.create') }}" color="primary">Tambah Produk</x-custom-button>
      </x-header-page>

      <!-- Filter Search -->
      <div class="w-full flex gap-[0.5rem] h-[32px]">
          <p class="text-xs h-full flex items-center">Filter</p>
          <x-filter-button label="Kategori" value="kategori" :active="request('filter') == 'kategori'" />
          <x-filter-button label="Satuan" value="satuan" :active="request('filter') == 'satuan'" />
          <x-filter-button label="Stok" value="stok" :active="request('filter') == 'stok'" />
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