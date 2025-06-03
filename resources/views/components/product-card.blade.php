@props(['product'])

<div class="bg-white rounded-2xl shadow flex flex-col overflow-hidden w-full">
    <div class="w-full aspect-square bg-gray-100 flex items-center justify-center">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->nama_produk }}" class="object-cover w-full h-full" />
        @else
            <span class="text-gray-400 text-xs">No Image</span>
        @endif
    </div>
    <div class="p-4 flex flex-col gap-2">
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
</div>