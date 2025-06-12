<x-layout
  titlePage="Penjualan - ScaleUp"
  title="{{ $title }}"
>

<main x-data="{
  showModalPembayaran: false,
  modalContentPembayaran: '',
  openPembayaran(content) {
    this.modalContentPembayaran = content;
    this.showModalPembayaran = true;
  },
  closePembayaran() {
    this.showModalPembayaran = false;
  }
}" class="main-container pb-0 grid grid-cols-3 h-full overflow-hidden">
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
            <x-product-card-transaction :product="$product" backlink="{{ request()->routeIs('sale') ? 'sale' : (request()->routeIs('bill') ? 'bill' : (request()->routeIs('purchase') ? 'purchase' : 'transaction')) }}" />
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
        <p class="delete-all-btn text-xs text-gray cursor-pointer transition-all  hover:text-danger">Hapus Pesanan</p>
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
      
      {{-- FITUR DISKON DAN BIAYA LAINNYA UNTUK PENJUALAN
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
      --}}

      <div class="flex justify-between">
        <span class="font-bold text-xs">Total Transaksi</span>
        <span id="total-transaksi" class="font-bold text-xs">Rp 100.000</span>
      </div>
      <x-custom-button id="btn-pembayaran">Pembayaran</x-custom-button>
    </div>
  </div>
</main>

<!-- Overlay & Modal Pop Up Pembayaran (gunakan Alpine.js) -->
<div
  x-data="{ showModal: false, modalContent: '' }"
  x-ref="modalRoot"
>
  <div
    x-show="showModal"
    class="fixed inset-0 bg-[rgba(0,0,0,0.3)] z-50"
    x-cloak
    @click="showModal = false"
  ></div>
  <div
    x-show="showModal"
    x-cloak
    class="fixed inset-0 flex items-center justify-center z-50"
  >
    <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg relative">
      <button class="absolute top-2 right-4 text-2xl text-gray-400 cursor-pointer hover:text-danger" @click="showModal = false">&times;</button>
      <div id="modal-content" x-html="modalContent"></div>
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
  // tentukan key localStorage berdasarkan route
  let routeName = '{{ Route::currentRouteName() }}';
  let pesananKey = 'listPesanan';
  if(routeName === 'sale') pesananKey = 'listPesanan_sale';
  else if(routeName === 'bill') pesananKey = 'listPesanan_bill';
  else if(routeName === 'purchase') pesananKey = 'listPesanan_purchase';

  let pelangganKey = 'pelanggan_' + pesananKey.replace('listPesanan_', '');
  let saldoKey = 'saldo_' + pesananKey.replace('listPesanan_', '');

  // ambil input dalso dan kontak
  const inputKontak = document.querySelector('input[name="kontak"]');
  const inputSaldo = document.querySelector('input[name="saldo"]');

  // local storage untuk saldo dan kontak
  if(inputKontak && localStorage.getItem(pelangganKey)) {
    inputKontak.value = localStorage.getItem(pelangganKey);
  }
  if(inputSaldo && localStorage.getItem(saldoKey)) {
    inputSaldo.value = localStorage.getItem(saldoKey);
  }

  // simpan ke localStorage HANYA saat user memilih dari auto-complete
  function setupAutocompleteWithStorage(inputSelector, endpoint, storageKey) {
    const input = document.querySelector(inputSelector);
    if (!input) return;
    let dropdown = document.createElement('div');
    dropdown.className = 'autocomplete-dropdown';
    dropdown.style.position = 'absolute';
    dropdown.style.background = '#fff';
    dropdown.style.border = '1px solid #e5e7eb';
    dropdown.style.zIndex = 1000;
    dropdown.style.width = input.offsetWidth + 'px';
    dropdown.style.maxHeight = '180px';
    dropdown.style.overflowY = 'auto';
    dropdown.style.display = 'none';
    dropdown.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
    input.parentNode.style.position = 'relative';
    input.parentNode.appendChild(dropdown);

    function updateDropdownPosition() {
      const rect = input.getBoundingClientRect();
      const parentRect = input.parentNode.getBoundingClientRect();
      dropdown.style.left = (rect.left - parentRect.left) + 'px';
      dropdown.style.top = (rect.bottom - parentRect.top) + 'px';
      dropdown.style.width = rect.width + 'px';
    }

    let lastResults = [];
    let lastSelectedId = null;
    let lastSelectedLabel = '';

    input.addEventListener('input', function() {
      const q = input.value.trim();
      input.dataset.id = '';
      lastSelectedId = null;
      lastSelectedLabel = '';
      if (q.length < 1) {
        dropdown.style.display = 'none';
        return;
      }
      fetch(endpoint + '?q=' + encodeURIComponent(q))
        .then(res => res.json())
        .then(data => {
          lastResults = data;
          dropdown.innerHTML = '';
          if (!data.length) {
            dropdown.style.display = 'none';
            return;
          }
          data.forEach(item => {
            const opt = document.createElement('div');
            opt.className = 'autocomplete-option hover:bg-primary/10 px-3 py-2 cursor-pointer text-xs';
            opt.textContent = item.label;
            opt.dataset.id = item.id;
            opt.addEventListener('mousedown', function(e) {
              e.preventDefault();
              input.value = item.label;
              input.dataset.id = item.id;
              lastSelectedId = item.id;
              lastSelectedLabel = item.label;
              dropdown.style.display = 'none';
              // Simpan ke localStorage HANYA saat pilih dari auto-complete
              localStorage.setItem(storageKey, item.label);
            });
            dropdown.appendChild(opt);
          });
          dropdown.style.display = 'block';
        });
      updateDropdownPosition();
    });

    input.addEventListener('blur', function() {
      setTimeout(() => {
        dropdown.style.display = 'none';
        if (!lastResults.some(item => item.label === input.value && item.id == input.dataset.id)) {
          input.value = '';
          input.dataset.id = '';
          localStorage.removeItem(storageKey);
        }
      }, 120);
    });
    input.addEventListener('focus', function() {
      if (lastResults.length) dropdown.style.display = 'block';
      updateDropdownPosition();
    });
    window.addEventListener('resize', updateDropdownPosition);
    window.addEventListener('scroll', updateDropdownPosition, true);
  }
  setupAutocompleteWithStorage('input[name="kontak"]', '/autocomplete/contact', pelangganKey);
  setupAutocompleteWithStorage('input[name="saldo"]', '/autocomplete/saldo', saldoKey);

  // ============================= PEMBAYARAN ===============================================
  // Helper untuk akses Alpine modal
  function setModalContent(content) {
    const modalRoot = document.querySelector('[x-ref="modalRoot"]');
    if (!modalRoot) return;
    // Coba trigger Alpine dengan dispatch event jika akses langsung gagal
    try {
      if (window.Alpine && Alpine.version && Alpine.version.startsWith('3')) {
        Alpine.$data(modalRoot).modalContent = content;
        Alpine.$data(modalRoot).showModal = true;
      } else if (modalRoot.__x && modalRoot.__x.$data) {
        modalRoot.__x.$data.modalContent = content;
        modalRoot.__x.$data.showModal = true;
      } else {
        // fallback: dispatch event agar Alpine reaktif
        modalRoot.dispatchEvent(new CustomEvent('show-modal', { detail: content }));
      }
    } catch (e) {
      // fallback: dispatch event agar Alpine reaktif
      modalRoot.dispatchEvent(new CustomEvent('show-modal', { detail: content }));
    }
  }

  // Integrasi event listener Alpine jika dispatch event
  const modalRoot = document.querySelector('[x-ref="modalRoot"]');
  if (modalRoot) {
    modalRoot.addEventListener('show-modal', function(e) {
      if (window.Alpine && Alpine.version && Alpine.version.startsWith('3')) {
        Alpine.$data(modalRoot).modalContent = e.detail;
        Alpine.$data(modalRoot).showModal = true;
      } else if (modalRoot.__x && modalRoot.__x.$data) {
        modalRoot.__x.$data.modalContent = e.detail;
        modalRoot.__x.$data.showModal = true;
      }
    });
  }

  // Tombol pembayaran
  const btnPembayaran = document.getElementById('btn-pembayaran');
  if (btnPembayaran) {
    btnPembayaran.addEventListener('click', function() {
      const inputKontak = document.querySelector('input[name=kontak]');
      const inputSaldo = document.querySelector('input[name=saldo]');
      const pesanan = JSON.parse(localStorage.getItem(pesananKey) || '[]');
      if(!inputKontak.value || !inputSaldo.value || !pesanan.length) {
        setModalContent(`
          <div class="text-center">
            <p class="text-danger font-semibold mb-2 text-sm">Lengkapi pelanggan, saldo, dan pesanan terlebih dahulu!</p>
          </div>
        `);
        return;
      }
      let routeName = '{{ Route::currentRouteName() }}';
      // form ketika menekan pembayaran
      let modalForm = '';
      if (routeName === 'sale') {
        modalForm = `
          <form id='form-pembayaran' class='flex flex-col gap-4'>
            <div>
              <label class='block text-sm font-medium mb-2 text-gray-700'>Pilih Metode Pembayaran <span class='text-red-500'>*</span></label>
              <select name='pembayaran' class='w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition' required>
                <option value=''>Pilih Metode</option>
                <option value='Cash'>Cash</option>
                <option value='Bank'>Bank</option>
              </select>
            </div>
            <button type='submit' class='w-full bg-primary text-white rounded-xl hover:scale-101 text-sm cursor-pointer p-2 font-semibold hover:bg-primary-700 transition'>Konfirmasi</button>
          </form>
        `;
      } else if (routeName === 'bill') {
        modalForm = `
          <form id='form-pembayaran' class='flex flex-col gap-4'>
            <div>
              <label class='block text-sm font-medium mb-2 text-gray-700'>Status Pembayaran <span class='text-red-500'>*</span></label>
              <select name='status' class='w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition' required>
                <option value='lunas'>Lunas</option>
                <option value='diproses'>Diproses</option>
                <option value='jatuh tempo'>Jatuh Tempo</option>
              </select>
            </div>
            <div>
              <label class='block text-sm font-medium mb-2 text-gray-700'>Tanggal Jatuh Tempo</label>
              <input type='date' name='jatuh_tempo' class='w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition' />
            </div>
            <button type='submit' class='w-full bg-primary text-white rounded-xl hover:scale-101 text-sm cursor-pointer p-2 font-semibold hover:bg-primary-700 transition'>Konfirmasi</button>
          </form>
        `;
      } else if (routeName === 'purchase') {
        modalForm = `
          <form id='form-pembayaran' class='flex flex-col gap-4'>
            <div>
              <label class='block text-sm font-medium mb-2 text-gray-700'>Status Pembayaran <span class='text-red-500'>*</span></label>
              <select name='status' class='w-full rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 py-3 px-3 text-sm bg-white transition' required>
                <option value='lunas'>Lunas</option>
                <option value='diproses'>Diproses</option>
                <option value='jatuh tempo'>Jatuh Tempo</option>
              </select>
            </div>
            <button type='submit' class='w-full bg-primary text-white rounded-xl hover:scale-101 text-sm cursor-pointer p-2 font-semibold hover:bg-primary-700 transition'>Konfirmasi</button>
          </form>
        `;
      }
      setModalContent(modalForm);

      //============ SUBMIT FORM ======================
      setTimeout(() => {
        const form = document.getElementById('form-pembayaran');
        if (form) {
          form.onsubmit = function(e) {
            e.preventDefault();
            // Ambil data dari form modal
            const formData = new FormData(form);
            let pembayaran = formData.get('pembayaran') || null;
            let status = formData.get('status') || null;
            let jatuh_tempo = formData.get('jatuh_tempo') || null;
            // Ambil data utama
            const kontak = inputKontak.value;
            const saldo = inputSaldo.value;
            const total = parseInt((document.getElementById('total-transaksi').textContent || '0').replace(/[^0-9]/g, '')) || 0;
            // Ambil tanggal hari ini (YYYYMMDD)
            const now = new Date();
            const pad = n => n.toString().padStart(2, '0');
            const tanggal = `${now.getFullYear()}${pad(now.getMonth()+1)}${pad(now.getDate())}`;
            // Kirim ke backend
            fetch('/transaction/store', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '')
              },
              body: JSON.stringify({
                tanggal,
                kontak,
                saldo,
                jenis: routeName,
                total,
                status,
                jatuh_tempo,
                pembayaran,
                pesanan
              })
            })
            .then(res => {
              if (!res.ok) throw new Error('HTTP status ' + res.status);
              return res.json();
            })
            .then(data => {
              if(data.success) {
                setModalContent('<div class="text-center text-success font-semibold">Transaksi berhasil disimpan!</div>');
                // Bersihkan localStorage
                localStorage.removeItem(pesananKey);
                localStorage.removeItem(pelangganKey);
                localStorage.removeItem(saldoKey);
                localStorage.removeItem('totalTransaksi');
                listPesanan = [];
                updateListPesanan();
                if(inputKontak) inputKontak.value = '';
                if(inputSaldo) inputSaldo.value = '';
              } else {
                setModalContent('<div class="text-center text-danger font-semibold">Gagal menyimpan transaksi!</div>');
              }
            })
            .catch(err => {
              setModalContent('<div class="text-center text-danger font-semibold">Gagal menyimpan transaksi!<br>' + err.message + '</div>');
              console.error('AJAX error:', err);
            });
          }
        }
      }, 200);
    });
  }

  // ================== LIST PESANAN =====================
  // Deklarasi global listPesanan
  let listPesanan = [];

  // Inisialisasi dari localStorage
  try {
    listPesanan = JSON.parse(localStorage.getItem(pesananKey) || '[]');
  } catch(e) {
    listPesanan = [];
  }

  const listPesananContainer = document.getElementById('list-pesanan-container');

  // Event delegation: klik produk (agar produk baru tetap bisa ditambahkan)
  const produkGrid = document.querySelector('.grid.grid-cols-4');
  if (produkGrid) {
    produkGrid.addEventListener('click', function(e) {
      const card = e.target.closest('.product-card-transaction');
      if (!card) return;
      const id = card.dataset.id;
      const nama = card.dataset.nama;
      const harga = parseInt(card.dataset.harga);
      const satuan = card.dataset.satuan;
      let existing = listPesanan.find(p => p.id === id);
      if (existing) {
        existing.jumlah += 1;
      } else {
        listPesanan.push({ id, nama, harga, satuan, jumlah: 1 });
      }
      updateListPesanan();
    });
  }

  // ================== PESANAN INTERFACE =====================
  function updateListPesanan() {
    if (!listPesananContainer) return;
    listPesananContainer.innerHTML = '';
    let total = 0;
    listPesanan.forEach((pesanan, idx) => {
      total += pesanan.harga * pesanan.jumlah;
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
    // Update total transaksi
    document.getElementById('total-transaksi').textContent = 'Rp ' + total.toLocaleString('id-ID');
    // Simpan ke localStorage
    localStorage.setItem(pesananKey, JSON.stringify(listPesanan));
    localStorage.setItem('totalTransaksi', total);

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

  // Event tombol hapus semua
  const btnDeleteAll = document.querySelector('.delete-all-btn');
  if (btnDeleteAll) {
    btnDeleteAll.addEventListener('click', function() {
      listPesanan = [];
      updateListPesanan();

      localStorage.removeItem(pelangganKey);
      localStorage.removeItem(saldoKey);
      if(inputKontak) inputKontak.value = '';
      if(inputSaldo) inputSaldo.value = '';
    });
  }

  // Render awal
  updateListPesanan();
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

.autocomplete-dropdown {
  border-radius: 0 0 0.5rem 0.5rem;
  font-size: 0.9rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.autocomplete-option {
  transition: background 0.2s;
}
.autocomplete-option:hover {
  background: #e0f2fe;
}
</style>