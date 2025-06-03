@props(['product'])

<div class="relative group bg-white rounded-2xl shadow flex flex-col overflow-hidden w-full transition hover:shadow-lg">
    <!-- Tombol Edit & Hapus (kanan atas, hanya muncul saat hover) -->
    <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition z-20">
        <a href="{{ route('product.edit', $product->id) }}"
           class="bg-white hover:bg-gray-200 text-dark p-3 rounded-full shadow transition"
           title="Edit">
            <!-- Icon edit -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h2v2h2v-2h2v-2h-2v-2h-2v2h-2v-2z"/>
            </svg>
        </a>
        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-white hover:bg-gray-200 text-dark p-3 rounded-full shadow transition cursor-pointer" title="Hapus">
                <!-- Icon hapus -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Card clickable ke detail -->
    <a href="{{ route('product.show', $product->id) }}" class="flex-1 flex flex-col no-underline text-inherit relative">
        <div class="w-full aspect-square bg-gray-100 flex items-center justify-center relative overflow-hidden">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/default.png') }}"
                 alt="{{ $product->nama_produk }}"
                 class="w-full h-full object-cover rounded-t-xl transition duration-300 group-hover:scale-105" />
            <!-- Overlay gelap saat hover -->
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition duration-300 pointer-events-none"></div>
        </div>
        <div class="p-4 flex flex-col gap-2 transition-colors duration-300 group-hover:bg-gray-50">
            <div>
                <p class="font-bold text-base">{{ $product->nama_produk }} | {{ $product->satuan }}</p>
                <span class="text-xs text-gray-500">{{ $product->stok }} Tersedia</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">Keuntungan</span>
                <span class="text-green-500 text-sm font-semibold">
                    Rp{{ number_format($product->harga_jual - $product->harga_modal, 0, ',', '.') }}
                </span>
            </div>
            <div class="flex items-end justify-between mt-2">
                <div>
                    <p class="text-xl font-bold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</p>
                    <span class="text-xs text-gray-500">100 Terjual</span>
                </div>
            </div>
        </div>
    </a>
</div>