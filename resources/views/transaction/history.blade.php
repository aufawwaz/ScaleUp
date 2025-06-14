<x-layout
  titlePage="Riwayat Transaksi - ScaleUp"
  title="Riwayat Transaksi"  
>
  <div x-data="{ showModal: false, transaksiId: null }">
  <main class="main-container pb-0 grid grid-cols-3 h-full overflow-hidden">
    {{-- Tabel --}}
    <div class="col-span-2 h-full overflow-auto scrollbar-hidden">
        <div class="flex flex-col gap-[1rem] p-[1rem] h-fit">
        <!-- Header -->
            <x-header-page title="DATA TRANSAKSI" back="{{ route($backRoute) }}"/>
            
            <!-- Filter -->
            <!-- Filter Switch 3 State -->
            <div class="flex items-center gap-2 mb-4 select-none">
              <div id="filter-switch" class="relative flex border-1 border-gray-200 rounded-xl overflow-hidden w-[100%] h-10">
                <button type="button" class="switch-btn flex-1 z-10 relative text-xs font-semibold transition-colors" data-value="penjualan">Penjualan</button>
                <button type="button" class="switch-btn flex-1 z-10 relative text-xs font-semibold transition-colors" data-value="pembelian">Pembelian</button>
                <button type="button" class="switch-btn flex-1 z-10 relative text-xs font-semibold transition-colors" data-value="tagihan">Tagihan</button>
                <span id="switch-indicator" class="absolute top-0 left-0 w-1/3 h-full bg-primary rounded-lg transition-all duration-300 z-0"></span>
              </div>
            </div>

            {{-- tabel --}}
            <div>
              <table id="trx-table" class="w-full text-[11px] border border-gray-200 rounded-t-xl overflow-hidden">
                <thead class="bg-primary-100 text-primary">
                  <tr>
                    <th class="py-4 pb-5 px-1 text-center">Tanggal</th>
                    <th class="py-4 pb-5 px-1 text-left th-jatuh-tempo">Jatuh Tempo</th>
                    <th class="py-4 pb-5 px-1 text-left th-nama">Pelanggan</th>
                    <th class="py-4 pb-5 px-1 text-left">Nomor Transaksi</th>
                    <th class="py-4 pb-5 px-1 text-left th-pembayaran">Pembayaran</th>
                    <th class="py-4 pb-5 px-1 text-left th-status">Status</th>
                    <th class="py-4 pb-5 px-1 text-left">Nominal</th>
                    <th class="py-4 pb-5 px-1 text-left">Saldo</th>
                  </tr>
                </thead>
                <tbody id="trx-tbody">
                  @foreach($transactions as $trx)
                  <tr class="border-b border-gray-100 hover:bg-primary/5 cursor-pointer" data-jenis="{{ $trx->jenis }}">
                    <td class="py-2 px-1 text-center">{{ $trx->tanggal }}</td>
                    <td class="py-2 px-1 td-jatuh-tempo">{{ $trx->jatuh_tempo ?? '-' }}</td>
                    <td class="py-2 px-1"><span class="kontak-nama" data-id="{{ $trx->kontak_id }}"><p class="text-xs text-gray-500">Memuat...</p></span></td>
                    <td class="py-2 px-1">{{ $trx->id }}</td>
                    <td class="py-2 px-1 text-center capitalize td-pembayaran">
                      @php
                        $colorMap = [
                          'tunai' => 'bg-primary-100 text-primary',
                          'bank transfer' => 'bg-blue-500 text-white',
                          'qris' => 'bg-danger-300 text-white',
                          'kartu kredit' => 'bg-yellow-100 text-yellow-600',
                          'lainnya' => 'bg-gray-300 text-black',
                        ];
                        $pembayaran = strtolower($trx->pembayaran ?? '-');
                        $colorClass = $colorMap[$pembayaran] ?? 'text-gray-700';
                      @endphp
                      <span class="px-2 py-0.5 rounded-full {{ $colorClass }}">
                        {{ $trx->pembayaran ?? '-' }}
                      </span>
                    </td>
                    <td class="py-2 px-1 text-center capitalize td-status">
                      @php
                        $statusMap = [
                          'lunas' => 'bg-success/20 text-success',
                          'diproses' => 'bg-yellow-100 text-yellow-700',
                          'jatuh tempo' => 'bg-danger/20 text-danger',
                        ];
                        $status = strtolower($trx->status ?? '-');
                        $statusClass = $statusMap[$status] ?? 'text-gray-700';
                      @endphp
                      <span class="px-2 py-1 rounded-full {{ $statusClass }}">
                        {{ $trx->status ?? '-' }}
                      </span>
                    </td>
                    <td class="py-2 px-1 text-right">{{ number_format($trx->nominal,0,',','.') }}</td>
                    <td class="py-2 px-1 text-center"><span class="saldo-nama" data-id="{{ $trx->saldo_id }}">Memuat...</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            
            <!-- Produk Grid / Empty State -->
            @if($transactions->isEmpty())
                <div class="flex flex-col items-center justify-center h-[500px] opacity-50">
                    <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada transaksi</h2>
                    <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah Transaksi pertamamu agar <br> dapat dikelola!</p>
                </div>
            @else
                <div class="overflow-auto scrollbar-hidden pb-5 mb-10">
                </div>
            @endif
        </div>
    </div>
    {{-- STRUK --}}
    <div class="bg-white h-screen p-4 pb-[22%] shadow-xl flex flex-col gap-[1rem]">
        <x-header-page title="STRUK PENJUALAN"/>
        <div class=" h-full w-full flex items-center justify-center">
          {{-- struk container --}}
          <div class="w-[300px] flex flex-col gap-[12px] text-[8px] px-4 py-10 shadow-lg bg-white" id="struk-detail">
            <div class="flex flex-col gap-[4px]">
              <h1 class="font-bold text-base text-center">ScaleUp</h1>
              <div>
                <p id="struk-alamat" class="text-gray-400 text-center">kabupaten, provinsi, Indonesia, kode_pos</p>
                <p class="text-gray-400 text-center" id="struk-tanggal">-</p>
              </div>
            </div>
            <div class="border-t-1 border-dashed border-gray-300"></div>
            <div class="flex justify-between">
              <p>ID Transaksi</p>
              <p id="struk-id">-</p>
            </div>
            <div class="flex justify-between">
              <p>Pelanggan</p>
              <p id="struk-pelanggan">-
            </p></div>
            <div class="border-t-1 border-dashed border-gray-300"></div>
            <div class="flex justify-between text-[10px] font-bold">
              <p>Deskripsi</p>
              <p>Harga</p>
            </div>
            <div id="struk-items" class="flex flex-col gap-[12px]"></div>
            <div class="border-t-1 border-dashed border-gray-300"></div>
            <div class="flex justify-between text-[10px] font-bold">
              <p>Total Pembayaran</p>
              <p id="struk-total">-</p>
            </div>
            <div class="flex justify-between">
              <p>Metode Pembayaran</p>
              <p id="struk-pembayaran" class="capitalize">-</p>
            </div>
            <div class="flex justify-between">
              <p>Status</p>
              <p id="struk-status">-</p>
            </div>
            <div class="flex justify-between">
              <p>Dibayar</p>
              <p id="struk-dibayar">-</p>
            </div>
            <div class="flex justify-between">
              <p>Kembalian</p>
              <p id="struk-kembalian">-</p>
            </div>
            <div class="border-t-1 border-dashed border-gray-300"></div>
            <div>
              <p class="text-gray font-bold">Supported By</p>
              <div class="flex gap-x-0.5">
                  <!-- logo ... -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 500 500" class="mr-[-6px]">
                    <path fill="#007AFF" d="M176 112c3.225 2.709 6.177 5.644 9.135 8.64l2.611 2.597c2.368 2.358 4.726 4.725 7.081 7.096 2.55 2.564 5.112 5.116 7.672 7.669 5.005 4.995 9.999 10 14.99 15.009a13101.85 13101.85 0 0 0 17.475 17.495 29616.608 29616.608 0 0 1 31.182 31.229 28755.761 28755.761 0 0 0 30.229 30.269l1.883 1.883 1.879 1.879a56065.038 56065.038 0 0 1 34.472 34.501c4.056 4.061 8.113 8.121 12.171 12.179 4.947 4.949 9.891 9.902 14.83 14.859 2.518 2.527 5.037 5.052 7.561 7.573 2.739 2.737 5.471 5.482 8.202 8.228l2.403 2.393c6.18 6.234 11.776 12.434 15.036 20.689l1.208 2.98c3.893 11.247 2.651 23.021-2.02 33.832-2.042 3.613-4.351 6.81-7 10l-1.586 1.961c-7.117 7.95-17.88 12.498-28.406 13.254-14.172.417-25.221-3.533-35.559-13.178l-1.687-1.568c-8.722-8.171-17.125-16.676-25.578-25.124l-5.912-5.897c-5.319-5.305-10.633-10.614-15.947-15.923l-9.974-9.963a72152.909 72152.909 0 0 1-27.677-27.651l-1.782-1.78-1.785-1.785-3.58-3.578-1.793-1.793a39150.464 39150.464 0 0 0-28.841-28.796 36081.995 36081.995 0 0 1-29.687-29.651 16288.45 16288.45 0 0 0-16.639-16.613 8196.02 8196.02 0 0 1-14.146-14.134 3057.677 3057.677 0 0 0-7.209-7.198 2512.175 2512.175 0 0 1-7.827-7.83l-2.281-2.257c-10.691-10.791-17.113-21.581-17.604-37.058.426-13.798 6.169-25.005 16.02-34.512C136.01 97.57 157.409 99.3 176 112Zm-2 158c9.169 7.902 17.673 16.535 26.214 25.1l4.143 4.143c3.712 3.712 7.421 7.427 11.13 11.142 3.89 3.897 7.782 7.79 11.675 11.684 7.354 7.357 14.705 14.716 22.056 22.077 8.375 8.386 16.753 16.77 25.132 25.154A209799.1 209799.1 0 0 1 326 421c-1.654 4.509-3.923 7.466-7.312 10.812l-1.606 1.589c-14.951 14.299-34.844 21.143-55.325 20.952-27.642-.824-45.75-15.21-64.518-33.953l-2.783-2.768a5803.053 5803.053 0 0 1-7.456-7.431l-4.672-4.662c-4.891-4.877-9.78-9.756-14.667-14.639a11121.16 11121.16 0 0 0-16.851-16.8 8486.91 8486.91 0 0 1-13.094-13.061 3358.493 3358.493 0 0 0-7.794-7.769c-2.901-2.882-5.79-5.776-8.679-8.67a8595.57 8595.57 0 0 0-2.579-2.551c-10.568-10.643-16.694-21.299-17.164-36.612.429-13.895 6.221-25.053 16.168-34.582C134.27 257.646 157.04 257.577 174 270ZM282.167 60.64c6.333 4.975 12.094 10.33 17.777 16.03l2.843 2.826c2.543 2.53 5.081 5.068 7.616 7.606 2.128 2.129 4.259 4.255 6.39 6.38 5.03 5.02 10.054 10.043 15.075 15.07 5.16 5.167 10.33 10.324 15.504 15.477a8017.32 8017.32 0 0 1 13.374 13.353c2.65 2.653 5.303 5.303 7.961 7.947 2.964 2.949 5.916 5.91 8.866 8.872l2.636 2.612c6.279 6.334 11.928 12.987 15.103 21.437l.926 2.391c3.602 11.156 2.367 22.701-2.238 33.359-2.042 3.613-4.351 6.81-7 10l-1.586 1.961c-7.117 7.95-17.88 12.498-28.406 13.254-14.444.425-25.405-3.701-35.902-13.518l-1.713-1.594c-6.721-6.29-13.222-12.799-19.72-19.317l-4.144-4.143c-3.708-3.708-7.413-7.419-11.117-11.13-3.887-3.893-7.778-7.784-11.667-11.675a65462.91 65462.91 0 0 1-22.035-22.056 99162.27 99162.27 0 0 0-25.11-25.132C208.397 113.437 191.197 96.22 174 79c4.662-12.56 18.637-20.787 30.102-26.563 25.708-11.395 55.536-8.847 78.065 8.203Z"/>
                  </svg>
                  <p class="text-base font-medium text-primary">cale<span class="font-bold">Up</span></p>
              </div>
            </div>
          </div>
        </div>
        <div id="lunas-btn-container" class="w-full flex justify-center mt-1 mb-2"></div>
    </div>
  </main>

    <!-- Overlay & Modal dalam satu parent Alpine -->
    <template x-if="showModal">
      <div>
        <!-- Overlay -->
        <div
          class="fixed inset-0 bg-[rgba(0,0,0,0.3)] z-40"
          @click="showModal = false"
        ></div>
        <!-- Modal -->
        <div
          class="fixed inset-0 flex items-center justify-center z-50"
        >
          <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg">
            <h2 class="text-lg font-semibold mb-2 text-gray-800">Konfirmasi Pelunasan</h2>
            <p class="text-sm text-gray-600">
              Apakah kamu yakin ingin menandai transaksi <span class="font-semibold" x-text="transaksiId"></span> sebagai lunas?
            </p>
            <form :action="`/transaction/markAsLunas/${transaksiId}`" method="POST" class="mt-4 flex justify-end gap-2">
              @csrf
              <x-custom-button
                  type="button"
                  color="secondary"
                  outline="true"
                  @click.prevent="showModal = false"
              >
                  Batal
              </x-custom-button>
              <x-custom-button
                  type="submit"
                  color="primary"
              >
                  Konfirmasi
              </x-custom-button>
            </form>
          </div>
        </div>
      </div>
    </template>
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
    // FILTER SWITCH
    const switchBtns = document.querySelectorAll('#filter-switch .switch-btn');
    const indicator = document.getElementById('switch-indicator');
    let state = 0; // 0: penjualan, 1: pembelian, 2: tagihan
    const routeToIdx = {
      'sale': 0,
      'purchase': 1,
      'bill': 2
    };

    // Tentukan defaultIdx sekali saja
    let defaultIdx = 0;
    try {
      defaultIdx = routeToIdx['{{ $backRoute }}'] ?? 0;
    } catch(e) {}

    function updateSwitch(idx) {
      state = idx;
      indicator.style.left = (idx * 33.3333) + '%';
      switchBtns.forEach((btn, i) => {
        if(i === idx) {
          btn.classList.add('text-white');
        } else {
          btn.classList.remove('text-white');
        }
      });
    }

    switchBtns.forEach((btn, idx) => {
      btn.addEventListener('click', function() {
        updateSwitch(idx);
        applyFilter(idx);
      });
    });
    updateSwitch(defaultIdx); // set tampilan awal

    // ID to STRING for KONTAK & SALDO
    document.querySelectorAll('.kontak-nama').forEach(function(el) {
      const id = el.dataset.id;
      fetch('/contact/getById/' + id)
        .then(res => res.json())
        .then(data => {
          el.innerHTML = data.image_kontak
            ? `<img src="/storage/${data.image_kontak}" class="inline w-4 h-4 rounded-full align-middle" onerror="this.style.display='none'"> ${data.nama_kontak || '-'}`
            : `<span class="inline-flex items-center justify-center w-4 h-4 rounded-full bg-gray-300 text-gray-800 font-semibold text-[10px]">${data.nama_kontak ? data.nama_kontak.charAt(0).toUpperCase() : '-'}</span> ${data.nama_kontak || '-'}`;
        })
        .catch(() => { el.textContent = '-'; });
    });
    document.querySelectorAll('.saldo-nama').forEach(function(el) {
      const id = el.dataset.id;
      fetch('/saldo/getById/' + id)
        .then(res => res.json())
        .then(data => {
          el.textContent = data.nama || '-';
        })
        .catch(() => { el.textContent = '-'; });
    });

    // Filter switch logic
    const tbody = document.getElementById('trx-tbody');
    const thNama = document.querySelector('.th-nama');
    const thPembayaran = document.querySelector('.th-pembayaran');
    const thStatus = document.querySelector('.th-status');
    const thJatuhTempo = document.querySelector('.th-jatuh-tempo');

    // Tampilkan semua baris di awal (optional)
    tbody.querySelectorAll('tr').forEach(tr => tr.style.display = '');

    function applyFilter(idx) {
      tbody.querySelectorAll('tr').forEach(tr => {
        const jenis = tr.getAttribute('data-jenis');
        // Hide all first
        tr.style.display = 'none';

        // Penjualan
        if(idx === 0 && jenis === 'penjualan') {
          tr.style.display = '';
          const payEl = tr.querySelector('.td-pembayaran');
          if(payEl) payEl.style.display = '';
          const statusEl = tr.querySelector('.td-status');
          if(statusEl) statusEl.style.display = 'none';
          // untuk jatuh tempo, class td-jatuh-tempo di <td>, jadi:
          const jatuhEl = tr.querySelector('.td-jatuh-tempo');
          if(jatuhEl) jatuhEl.style.display = 'none';
        }
        // Pembelian
        if(idx === 1 && jenis === 'pembelian') {
          tr.style.display = '';
          const payEl = tr.querySelector('.td-pembayaran');
          if(payEl) payEl.style.display = 'none';
          const statusEl = tr.querySelector('.td-status');
          if(statusEl) statusEl.style.display = '';
          const jatuhEl = tr.querySelector('.td-jatuh-tempo');
          if(jatuhEl) jatuhEl.style.display = 'none';
        }
        // Tagihan
        if(idx === 2 && jenis === 'tagihan') {
          tr.style.display = '';
          const payEl = tr.querySelector('.td-pembayaran');
          if(payEl) payEl.style.display = 'none';
          const statusEl = tr.querySelector('.td-status');
          if(statusEl) statusEl.style.display = '';
          const jatuhEl = tr.querySelector('.td-jatuh-tempo');
          if(jatuhEl) jatuhEl.style.display = '';
        }
      });
      // Ubah judul kolom nama
      if(idx === 1) thNama.textContent = 'Supplier';
      else thNama.textContent = 'Nama';
      // Kolom pembayaran
      thPembayaran.style.display = (idx === 0) ? '' : 'none';
      // Kolom status
      thStatus.style.display = (idx === 0) ? 'none' : '';
      // Kolom jatuh tempo
      thJatuhTempo.style.display = (idx === 2) ? '' : 'none';
    }

    // Inisialisasi default sesuai backRoute
    applyFilter(defaultIdx);
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const table = document.getElementById('trx-table');
  const tbody = document.getElementById('trx-tbody');
  let activeRow = null;
  // Ambil data transaksi dari blade ke JS
  const transaksiData = @json($transactions);
  // Event click row
  tbody.querySelectorAll('tr').forEach((row, idx) => {
    row.addEventListener('click', function() {
      tbody.querySelectorAll('tr').forEach(r => r.classList.remove('bg-primary/5', 'active-row'));
      this.classList.add('bg-primary/5', 'active-row');
      showStruk(transaksiData[idx]);
    });
  });
  // Fungsi render struk
  function showStruk(trx) {
    document.getElementById('struk-tanggal').innerText = trx.tanggal || '-';
    document.getElementById('struk-id').innerText = trx.id || '-';
    document.getElementById('struk-pelanggan').innerText = trx.kontak ? (trx.kontak.nama_kontak || '-') : '-';
    // Render items
    const itemsDiv = document.getElementById('struk-items');
    itemsDiv.innerHTML = '';
    if(trx.items && trx.items.length > 0) {
      trx.items.forEach(item => {
        const nama = item.product ? item.product.nama_produk : '-';
        const jumlah = item.jumlah || 1;  
        const harga = item.product ? Number(trx.jenis == 'pembelian' ? item.product.harga_modal * jumlah : item.product.harga_jual * jumlah).toLocaleString('id-ID') : '-';
        const row = document.createElement('div');
        row.className = 'flex justify-between';
        row.innerHTML = `<p>${jumlah}x ${nama}</p><p>Rp ${harga}</p>`;
        itemsDiv.appendChild(row);
      });
    } else {
      itemsDiv.innerHTML = '<div class="text-center">-</div>';
    }
    document.getElementById('struk-total').innerText = 'Rp ' + Number(trx.nominal).toLocaleString('id-ID');
    document.getElementById('struk-pembayaran').innerText = trx.pembayaran || '-';
    document.getElementById('struk-status').innerText = trx.status || trx.jenis == 'penjualan' ? 'Lunas' : '-';
    document.getElementById('struk-dibayar').innerText = trx.dibayar ? 'Rp ' + Number(trx.dibayar).toLocaleString('id-ID') : '-';
    let kembalian = (trx.dibayar && trx.nominal) ? (Number(trx.dibayar) - Number(trx.nominal)) : 0;
    document.getElementById('struk-kembalian').innerText = 'Rp ' + kembalian.toLocaleString('id-ID');

    let elAlamat = document.getElementById('struk-alamat');
    fetch('/profile/get')
      .then(res => res.json())
      .then(data => {
        const alamat = `Kec. ${data.kecamatan}, Kab. ${data.kabupaten_kota}, ${data.provinsi}, Indonesia`;
        elAlamat.innerText = alamat;
      })
      .catch(() => { elAlamat.innerText = 'Indonesia'; });

    // Tampilkan tombol "Tandai sebagai Lunas" jika tagihan dan status bukan lunas
    const lunasBtnContainer = document.getElementById('lunas-btn-container');
    lunasBtnContainer.innerHTML = '';
    if(trx.jenis === 'tagihan' && trx.status !== 'lunas') {
      lunasBtnContainer.innerHTML = `<button 
        class='bg-primary text-white rounded-lg w-full py-2 text-xs font-semibold shadow hover:bg-primary-800 cursor-pointer transition'
        x-data
        @click=\"showModal = true; transaksiId = '${trx.id}'\"
      >Tandai sebagai Lunas</button>`;
    }
  }
  // Render struk pertama kali jika ada data
  if(transaksiData.length > 0) {
    tbody.querySelectorAll('tr')[0].classList.add('bg-primary/5', 'active-row');
    showStruk(transaksiData[0]);
  }
});
</script>

<style>
  #filter-switch .switch-btn { 
    background: transparent; border: none; outline: none; cursor: pointer; 
  }
  #filter-switch .switch-btn.text-white { 
    color: #fff !important; 
  }
  #switch-indicator { 
    box-shadow: 0 2px 8px rgba(37,99,235,0.08); 
  }
  
  .active-row {
    background-color: ;
}
</style>