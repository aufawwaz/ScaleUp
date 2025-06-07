<x-layout
  titlePage="Produk - ScaleUp"
  title="Produk"  
>
<div x-data="{ showModal: false, deleteUrl: '', productName: '' }" x-cloak>

<main class="main-container">
  <div class="flex flex-col gap-[1rem] w-full p-[1rem]">
    <!-- Header -->
    <x-header-page title="DATA PRODUK">
      <div class="flex gap-[0.5rem]">
        <!-- Tambah produk, kategori dan satuan -->
        <x-custom-button href="{{ route('product.create') }}" color="primary">Tambah Produk</x-custom-button>
      </div>
    </x-header-page>
    
    <!-- Filter Search -->
    @if($products->isEmpty())
    
    @else
    <div class="w-full flex gap-[0.5rem] h-[32px]">
      <p class="text-xs h-full flex items-center">Filter</p>
      <x-filter-button label="Kategori" value="kategori" :active="request('filter') == 'kategori'" />
      <x-filter-button label="Satuan" value="satuan" :active="request('filter') == 'satuan'" />
      <x-filter-button label="Stok" value="stok" :active="request('filter') == 'stok'" />
    </div>
    @endif
    
    <!-- Produk Grid / Empty State -->
      @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center h-[500px] opacity-50">
            <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada produk</h2>
            <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah produk pertamamu agar <br> dapat dikelola!</p>
        </div>
      @else
        <div class="grid grid-cols-4 gap-[1rem] mt-4">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
      @endif
    </div>
  </main>

<!-- Overlay -->
  <div
    x-show="showModal"
    class="fixed inset-0 bg-[rgba(0,0,0,0.3)] z-50"
    x-cloak
    @click="showModal = false"
  ></div>

  <!-- Modal -->
  <div
    x-show="showModal"
    x-cloak
    class="fixed inset-0 flex items-center justify-center z-50"
  >
    <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg">
      <h2 class="text-lg font-semibold mb-2 text-gray-800">Hapus Produk</h2>
      <p class="text-sm text-gray-600">
        Apakah kamu yakin ingin menghapus produk <span class="font-semibold" x-text="productName"></span>?
      </p>

      <form :action="deleteUrl" method="POST" class="mt-4 flex justify-end gap-2">
        @csrf
        @method('DELETE')
        <x-custom-button
            type="button"
            color="secondary"
            outline="true"
            @click="showModal = false"
        >
            Batal
        </x-custom-button>

        <x-custom-button
            type="submit"
            color="danger"
        >
            Hapus
        </x-custom-button>
      </form>
    </div>
  </div>
  </div>

</x-layout>