<x-layout titlePage="Detail Produk - ScaleUp" title="Detail Produk">
    <div x-data="{ showModal: false, deleteUrl: '', productName: '' }" x-cloak>
    <main class="main-container">
        <div class="p-[1rem] flex flex-col gap-[1rem] h-fit">
            <x-header-page back="{{ $backRoute ? route($backRoute) : route('product.index') }}" title="{{ strtoupper($product->nama_produk) }}">
                    <div class="flex gap-[0.5rem]">
                    <x-custom-button
                        color="danger"
                        outline="true"
                        @click.stop="showModal = true; deleteUrl = '{{ route('product.destroy', $product->slug) }}'; productName = '{{ $product->nama_produk }}'"
                        >
                        Hapus Produk
                    </x-custom-button>
                        <x-custom-button :href="route('product.edit', $product->slug)" color="primary" block="true">
                            Atur Produk
                        </x-custom-button>
                    </div>
            </x-header-page>
            <div class="flex gap-[1rem] max-h-[720px]">
                <!-- Gambar & Detail Produk -->
                <div class="w-1/3 flex flex-col items-center bg-white rounded-2xl p-6 shadow min-h-full">
                    <div class="relative w-full aspect-square rounded-xl flex items-center justify-center overflow-hidden mb-4">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('asset/default_produk.svg') }}"
                            alt="{{ $product->nama_produk }}"
                            class="object-cover w-full h-full" />
                            <span class="absolute top-[1rem] right-[1rem] bg-gray-200 text-xs px-3 py-1 rounded-full text-gray-600">{{ $product->kategori ?? 'Tanpa Kategori' }}</span>
                    </div>
                    <div class="w-full text-xl text-primary font-bold py-[1rem]">Rp{{ number_format($product->harga_jual, 0, ',', '.') }}<span> | {{ $product->satuan }}</span></div>
                    <div class="w-full text-sm text-gray-700 flex flex-col gap-[1rem] mt-2">
                        <div class="flex w-full justify-between"><span class="font-semibold">Harga Modal</span> Rp{{ number_format($product->harga_modal, 0, ',', '.') }}</div>
                        <div class="flex w-full justify-between"><span class="font-semibold">Stok</span> {{ $product->stok ?: 0 }}</div>
                        <div>
                            <span class="font-semibold flex flex-col mb-1">Deskripsi Produk</span>
                            <div class="max-h-[9rem] overflow-y-auto scrollbar-hidden pr-2 whitespace-pre-line">
                                {{ $product->deskripsi ?? '-' }}
                            </div>
                        </div>    
                    </div>
                </div>
                <!-- Pergerakan Stok (Dinamis) -->
                <div class="rounded-2xl w-2/3 max-h-full">
                    <div class="bg-white p-6 shadow w-full h-full rounded-2xl">
                        <h3 class="font-bold text-lg mb-4">PERGERAKAN STOK</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm rounded-xl overflow-clip">
                                <thead>
                                    <tr class="bg-primary/10 text-primary">
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
                                        @forelse($stockMovements as $item)
                                        <tr class="border-b border-gray-100">
                                            <td class="py-3 px-3">{{ $item->transaction ? \Carbon\Carbon::parse($item->transaction->tanggal)->format('d/m/Y') : '-' }}</td>
                                            <td class="py-3 px-3">{{ $item->transaction->id ?? '-' }}</td>
                                            <td class="py-3 px-3">{{ $item->transaction && $item->transaction->contact ? $item->transaction->contact->nama_kontak : '-' }}</td>
                                            <td class="py-3 px-3 {{ $item->transaction && $item->transaction->jenis === 'pembelian' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $item->transaction && $item->transaction->jenis === 'pembelian' ? '+' : '-' }}{{ $item->jumlah }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="4" class="text-center py-6 text-gray-400">Belum ada pergerakan stok</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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