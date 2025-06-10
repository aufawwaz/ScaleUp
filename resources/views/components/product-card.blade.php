@props(['product'])

<div class="relative group bg-white rounded-2xl shadow flex flex-col overflow-hidden w-full transition hover:shadow-lg">
    <!-- Tombol Edit & Hapus (kanan atas, hanya muncul saat hover) -->
    <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition z-20">
        <a href="{{ route('product.edit', $product->slug) }}"
           class="bg-primary hover:brightness-80 text-white p-3 rounded-full shadow transition"
           title="Edit"> 
            <!-- Icon edit -->
            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160v-97q0-16 6-30.5t17-25.5l505-504q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L313-143q-11 11-25.5 17t-30.5 6h-97Zm544-528 56-56-56-56-56 56 56 56Z"/></svg>
        </a>
        <button
            @click.stop="showModal = true; deleteUrl = '{{ route('product.destroy', $product->slug) }}'; productName = '{{ $product->nama_produk }}'"
            class="bg-danger cursor-pointer hover:brightness-80 text-white p-3 rounded-full shadow transition"
            >
            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
        </button>
    </div>

    <!-- Card clickable ke detail -->
    <a href="{{ route('product.show', $product->slug) }}" class="flex-1 flex flex-col no-underline text-inherit relative">
        <div class="w-full aspect-square bg-gray-100 flex items-center justify-center relative overflow-hidden">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('asset/default_produk.svg') }}"
                 alt="{{ $product->nama_produk }}"
                 class="w-full h-full object-cover  rounded-t-xl transition duration-300 group-hover:scale-105" />
            <!-- Overlay gelap saat hover -->
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition duration-300 pointer-events-none"></div>
        </div>
        <div class="p-4 flex flex-col gap-2 transition-colors duration-300 group-hover:bg-gray-50">
            <div>
                <p class="font-bold text-base">{{ $product->nama_produk }} | {{ $product->satuan }}</p>
                <span class="text-xs text-gray-500">{{ $product->stok ?: 0 }} Tersedia</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-xl">Keuntungan</span>
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