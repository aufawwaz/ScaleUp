@props(['product', 'backlink' => 'transaction'])

<div class="relative group bg-white rounded-lg shadow flex flex-col overflow-hidden w-full transition hover:shadow-lg product-card-transaction"
     data-id="{{ $product->id }}"
     data-nama="{{ $product->nama_produk }}"
     data-harga="{{ $backlink == 'purchase' ? $product-> harga_modal : $product->harga_jual }}"
     data-satuan="{{ $product->satuan }}"
     style="cursor:pointer;">
    
    <!-- Tombol Inpo (kanan atas, hanya muncul saat hover) -->
    <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition z-20">
        <a href="{{ route('product.show', [$product->slug, 'back' => $backlink]) }}"
           class="bg-primary hover:brightness-80 text-white p-1.5 rounded-full shadow transition"
           title="Informasi Product"> 
            <!-- Icon edit -->
            <svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
        </a>
    </div>

    <!-- Card clickable ke detail -->
    <div class="flex-1 flex flex-col no-underline text-inherit relative">
        <div class="w-full aspect-square bg-gray-100 flex items-center justify-center relative overflow-hidden">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/default_produk.png') }}"
                 alt="{{ $product->nama_produk }}"
                 class="w-full h-full object-cover rounded-t-xl transition duration-300 group-hover:scale-105 bg-white" />
            <!-- Overlay gelap saat hover -->
            <div class="absolute opacity-0 group-hover:opacity-100 text-xs text-center transition-opacity duration-300 font-semibold text-white z-10 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px" fill="currentColor"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                <p>Tambah Pesanan</p>
            </div>
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition duration-300 pointer-events-none"></div>
        </div>
        <div class="p-2.5 flex flex-col gap-1 transition-colors duration-300 group-hover:bg-gray-50">
            <div class="flex flex-col">
                <p class="font-bold text-sm line-clamp-1">{{ $product->nama_produk  }}</p>
                <span class="text-xs text-gray-500  m-0 p-0">{{ $product->stok ?: 0 }} Tersedia</span>
            </div>
            <div>
                <span class="text-sm font-bold">Rp {{ number_format($backlink == 'purchase' ? $product-> harga_modal : $product->harga_jual, 0, ',', '.') }}</span>
                <span class="text-sm font-bold">/{{ $product->satuan }}</span>
            </div>
        </div>
    </div>
</div>