<x-layout titlePage="Detail Produk - ScaleUp" title="Detail Produk">
    <main class="main-container">
        <div class="p-[1rem] flex flex-col gap-[1rem] h-fit">
        <x-header-page back="route('product.index')" title="{{ strtoupper($product->nama_produk) }}" class="">
                <div class="flex gap-[0.5rem]">
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <x-custom-button color="danger" outline="true" block="true" type="submit">
                            Hapus Produk
                        </x-custom-button>
                    </form>
                    <x-custom-button :href="route('product.edit', $product->id)" color="primary" block="true">
                        Atur Produk
                    </x-custom-button>
                </div>
        </x-header-page>
        <div class="flex gap-[1rem] max-h-[720px]">
            <!-- Gambar & Detail Produk -->
            <div class="w-1/3 flex flex-col items-center bg-white rounded-2xl p-6 shadow min-h-full">
                <div class="relative w-full aspect-square rounded-xl flex items-center justify-center overflow-hidden mb-4">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/default.png') }}"
                        alt="{{ $product->nama_produk }}"
                        class="object-cover w-full h-full" />
                        <span class="absolute top-[1rem] right-[1rem] bg-gray-200 text-xs px-3 py-1 rounded-full text-gray-600">{{ $product->kategori ?? 'Tanpa Kategori' }}</span>
                </div>
                <div class="w-full text-xl text-primary font-bold py-[1rem]">Rp{{ number_format($product->harga_jual, 0, ',', '.') }}<span> | {{ $product->satuan }}</span></div>
                <div class="w-full text-sm text-gray-700 flex flex-col gap-[1rem] mt-2">
                    <div class="flex w-full justify-between"><span class="font-semibold">Harga Modal</span> Rp{{ number_format($product->harga_modal, 0, ',', '.') }}</div>
                    <div class="flex w-full justify-between"><span class="font-semibold">Stok</span> {{ $product->stok }}</div>
                    <div>
                        <span class="font-semibold flex flex-col mb-1">Deskripsi Produk</span>
                        <div class="max-h-[9rem] overflow-y-auto scrollbar-hidden pr-2 whitespace-pre-line">
                            {{ $product->deskripsi ?? '-' }}
                        </div>
                    </div>    
                </div>
            </div>
            <!-- Pergerakan Stok (Statis) -->
            <div class="rounded-2xl w-2/3 max-h-full">
                <div class="bg-white p-6 shadow w-full h-full rounded-2xl">
                    <h3 class="font-bold text-lg mb-4">PERGERAKAN STOK</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm rounded-xl overflow-clip">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="py-2 px-3 font-semibold">Tanggal</th>
                                    <th class="py-2 px-3 font-semibold">Invoice</th>
                                    <th class="py-2 px-3 font-semibold">Pelanggan</th>
                                    <th class="py-2 px-3 font-semibold">Jumlah</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="max-h-[600px] overflow-y-auto scrollbar-hidden">
                            <table class="min-w-full text-sm">
                                <tbody>
                                    <!-- Baris data di sini -->
                                    @for($i = 0; $i < 20; $i++)
                                    <tr class="border-b border-gray-100">
                                        <td class="py-3 px-3">22/03/2025</td>
                                        <td class="py-3 px-3">085423318989</td>
                                        <td class="py-3 px-3">Ariel</td>
                                        <td class="py-3 px-3 text-red-600">-3</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</x-layout>