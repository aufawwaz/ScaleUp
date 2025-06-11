<x-layout
  titlePage="Penjualan - ScaleUp"
  title="Penjualan"  
>

<main class="main-container pb-0 grid grid-cols-3 h-full overflow-hidden">
  <div class="col-span-2 h-full overflow-auto scrollbar-hidden">
    <div class="flex flex-col gap-[1rem] p-[1rem] h-fit">
      <!-- Header -->
      <x-header-page title="DATA PRODUK">
        <div class="flex gap-[0.5rem]">
          <!-- Tambah produk, kategori dan satuan -->
          <x-custom-button href="#" color="primary">Riwayat Transaksi</x-custom-button>
        </div>
      </x-header-page>
    
      <!-- Filter Search -->
      @if($products->isEmpty())
    
      @else
      <div class="flex gap-5 justify-between sticky top-0 z-10 py-2">
        <x-search-bar
          placeholder="Cari produk..."  name="search" :value="request('search')"
        ></x-search-bar>
      </div>
      @endif
    
      <!-- Produk Grid / Empty State -->
      @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center h-[500px] opacity-50">
            <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada produk</h2>
            <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah produk pertamamu agar <br> dapat dikelola!</p>
        </div>
      @else
        <div class="grid grid-cols-4 gap-[0.5rem] mt-4 overflow-auto scrollbar-hidden pb-5 mb-10">
          @foreach($products as $product)
            <x-product-card-transaction :product="$product" />
          @endforeach
        </div>
      @endif
    </div>
  </div>

  {{-- Rincian Pesanan --}}
  <div class="bg-white h-screen p-4 pb-[22%] shadow-xl flex flex-col gap-[10px]">
    <div class="flex flex-col gap-[10px]">
      <div class="flex flex-row justify-between">
        <h3 class="text-base font-bold">Rincian Pesanan</h3>
        <p class="text-xs text-gray cursor-pointer transition-all  hover:text-danger">Hapus Pesanan</p>
      </div>
      <div class="w-full h-[1px] z-50 bg-gray-300 text-gray"></div>
      <x-input-form
        type="text"
        name="kontak"
        placeholder="Tambah Pelanggan"
        icon="/asset/ic_person.svg"
        textSize="xs"
      />
      <x-input-form
        type="text"
        name="saldo"
        placeholder="Tambah Saldo"
        icon="/asset/ic_credit_card.svg"
        textSize="xs"
      />
    </div>

    {{-- list Pesanan --}}
    <div class="w-full flex-1 overflow-auto">
      <div id="list-pesanan-container" class="h-fit pr-1"></div>
    </div>

    {{-- Total Pesanan --}}
    <div class="flex flex-col gap-[8px]">
      <div class="w-full h-[1px] z-50 bg-gray-300 text-gray"></div>
      <div class="flex justify-between">
        <span class="font-bold text-xs">Subtotal</span>
        <span class="font-bold text-xs">Rp 100.000</span>
      </div>
      <div class="flex justify-between">
        <span class="text-xs">Biaya Layanan</span>
        <span class="text-xs">%</span>
      </div>
      <div class="flex justify-between">
        <span class="text-xs">Pajak Layanan</span>
        <span class="text-xs">%</span>
      </div>
      <div class="flex justify-between">
        <span class="font-bold text-xs">Diskon</span>
        <span class="font-bold text-xs">10%</span>
      </div>
      <div class="flex justify-between">
        <span class="text-xs">Biaya Lainnya</span>
        <span class="text-xs">%</span>
      </div>
      <div class="flex justify-between">
        <span class="font-bold text-xs">Total Transaksi</span>
        <span class="font-bold text-xs">Rp 100.000</span>
      </div>
      <x-custom-button>Pembayaran</x-custom-button>
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

  @if(session('success'))
  <div 
    x-data="{ show: false }" 
    x-init="
      setTimeout(() => show = true, 300);
      setTimeout(() => show = false, 3300)" 
    x-show="show"
    x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="translate-y-10 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform ease-in duration-300"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-10 opacity-0"
    class="fixed bottom-6 right-6 bg-success/10 text-success border border-success px-6 py-3 rounded-md text-xs shadow-lg z-[9999]"
  >
    {{ session('success') }}
  </div>
  @endif
</x-layout>

<script>
window.addEventListener('DOMContentLoaded', function(){
  let listPesanan = [];
  const listPesananContainer = document.getElementById('list-pesanan-container');

  document.querySelectorAll('.product-card-transaction').forEach(card => {
    card.addEventListener('click', function() {
      const id = this.dataset.id;
      const nama = this.dataset.nama;
      const harga = this.dataset.harga;
      const satuan = this.dataset.satuan;
      
      const existing = listPesanan.find(p => p.id === id);
      if (existing) {
        existing.jumlah += 1;
      } else {
        listPesanan.push({ id, nama, harga, satuan, jumlah: 1 });
      }

      updateListPesanan();
    });
  });

  function updateListPesanan() {
    listPesananContainer.innerHTML = '';
    listPesanan.forEach((pesanan, idx) => {
      const div = document.createElement('div');
      const namaLimited = pesanan.nama.length > 30 ? pesanan.nama.substring(0, 18) + '…' : pesanan.nama;
      const hargaFormatted = 'Rp ' + Number(pesanan.harga).toLocaleString('id-ID');
      div.className = 'flex justify-between items-center py-1 text-xs gap-2';

      div.innerHTML = `
        <div class="flex gap-2 items-center">
          <button class="delete-btn w-[24px] h-[24px] flex justify-center items-center bg-danger rounded-sm text-white cursor-pointer hover:bg-red-700" data-idx="${idx}">
            <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
          </button>
          <div class="flex flex-col">
            <p class="text-xs">${namaLimited}</p>
            <p class="text-xs font-bold">${hargaFormatted}</p>
          </div>
        </div>
        <span class="flex items-center gap-1">
          <button class="plus-btn w-[24px] h-[24px] text-center bg-primary rounded-sm text-bold text-white cursor-pointer hover:bg-primary-800" data-idx="${idx}">+</button>
          <input type="number" min="1" class="jumlah-input text-xs text-bold w-[36px] text-center border border-gray-300 rounded" value="${pesanan.jumlah}" data-idx="${idx}">
          <button class="minus-btn w-[24px] h-[24px] text-center bg-white rounded-sm text-primary text-bold border-1 border-primary cursor-pointer hover:bg-gray-200" data-idx="${idx}">-</button>
        </span>
      `;

      listPesananContainer.appendChild(div);
    });

    // Event: tambah jumlah
    listPesananContainer.querySelectorAll('.plus-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const idx = this.dataset.idx;
        listPesanan[idx].jumlah++;

        updateListPesanan();
      });
    });

    // Event: kurang jumlah
    listPesananContainer.querySelectorAll('.minus-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const idx = this.dataset.idx;
        if (listPesanan[idx].jumlah > 1)
          listPesanan[idx].jumlah--;
        else listPesanan.splice(idx, 1);

        updateListPesanan();
      });
    });

    // Event: input jumlah manual
    listPesananContainer.querySelectorAll('.jumlah-input').forEach(input => {
      input.addEventListener('change', function() {
        const idx = this.dataset.idx;
        let val = parseInt(this.value);
        if (isNaN(val) || val < 1) val = 1;
        listPesanan[idx].jumlah = val;

        updateListPesanan();
      });
    });

    // Event: hapus pesanan
    listPesananContainer.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const idx = this.dataset.idx;
        listPesanan.splice(idx, 1);

        updateListPesanan();
      });
    });
  }
});
</script>

<style>
/* hapus controller bawaan input 'Number' */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}
</style>