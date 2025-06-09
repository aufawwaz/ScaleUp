@php
  $totalSaldo = 0;
  foreach($data as $d){
    $totalSaldo += $d->saldo;
  }
  $isNoData = $data->isEmpty();
@endphp

<x-layout   
  titlePage="Saldo - ScaleUp"
  title="Saldo"  
>
  <div x-data>
    <main class="main-container p-4 overflow-auto scrollbar-hidden cursor-default">
      
      {{-- total saldonya --}}
      @if(!$isNoData)
        <div
          class="flex flex-col shadow-sm rounded-2xl py-4 px-4 gap-1 cursor-pointer transition-all select-none"
          x-data
          @click="
            $store.saldoActive.set(-1, '', '', {{ $totalSaldo }});
            fetch('/saldo/fetch/-1')
              .then(res => res.json())
              .then(data => $store.transactions.set(data))
              .catch(console.error)
          "
          x-bind:class="$store.saldoActive.id == -1
            ? 'bg-gradient-to-r from-primary-600 via-primary-500 to-success-300'
            : 'bg-white hover:bg-gray-100'"
        >
          <h1
            class="text-sm transition-colors"
            x-bind:class="$store.saldoActive.id == -1
              ? 'text-white/80'
              : 'text-gray-400'"
          >
            Total Saldo
          </h1>
          <h1
            class="text-xl font-semibold transition-colors"
            x-bind:class="$store.saldoActive.id == -1
              ? 'text-white'
              : 'text-primary'"
          >
            Rp {{ number_format($totalSaldo, 0, ',', '.') }}
          </h1>
        </div>
      @endif

      <div class="p-2 mt-4 w-full h-[76%]">
        <div class="flex flex-col gap-2">
          {{-- header --}}
          <x-header-page title="DATA KARTU">
            <div class="flex gap-[0.5rem]">
              {{-- tombol create --}}
              <x-custom-button color="primary" @click.stop="$store.modal.openAdd()"> Tambah Kartu </x-custom-button>
            </div>
          </x-header-page>
          <x-notification :success="session('success')"/>
        </div>

        {{-- main content --}}
        <div class="flex flex-row gap-2 my-4 w-full h-[100%] justify-between">
          {{-- list kartu --}}
          @if(!$isNoData)
            <div id="saldo-container" class="container flex flex-col gap-2 h-full overflow-scroll scrollbar-hidden">
              @foreach ($data as $d)
                <x-saldo-card 
                  :id="$d->id"
                  :nama="$d->nama" 
                  :saldo="$d->saldo" 
                  :jenis="$d->jenis" 
                />
              @endforeach
            </div>

            {{-- details --}}
            <div class="container w-[80%] h-[96%] p-4 bg-white rounded-2xl shadow-sm ">
              <div class="flex items-center justify-between mb-[1rem]">
                <p class="dashboard-card-header">Data Kartu</p>
                <button onclick="" class="border-1 border-gray-400 text-gray text-xs rounded-md px-3 py-1.5 hover:bg-gray-100 hover:text-gray-500 hover:bordrer-500 cursor-pointer">
                  Data
                </button>
              </div>
              {{-- nampilin detail kartunya --}}
              <div class="w-full h-[1px] bg-gray-300 mb-[1rem]"></div>
              <template x-if="$store.saldoActive.id !== -1">
                <div class="mb-4 flex flex-col gap-2">
                  <div class="flex items-center gap-0.5 text-base justify-center text-nowrap font-semibold">
                      <span>Saldo</span>
                      <span x-text="$store.saldoActive.jenis" class="text-primary"></span>
                      <span x-text="$store.saldoActive.nama" class="text-primary"> </span>
                      <span>beberapa hari terakhir</span>
                  </div>
                </div>
              </template>
              <template x-if="$store.saldoActive.id === -1">
                <div class="text-base text-center font-semibold mb-4">
                    Total Saldo beberapa hari terkahir
                </div>
              </template>

              {{-- chart --}}
              <div class="w-full">
                <canvas id="saldoDetailChart" width="400" height="250"></canvas>
              </div>
              {{-- tombol --}}
              <template x-if="$store.saldoActive.id !== -1">
                <div class="flex gap-2 mt-2 justify-around">
                  {{-- tombol edit --}}
                  <x-custom-button
                    @click.stop="$store.modal.openEdit({id: $store.saldoActive.id, jenis: $store.saldoActive.jenis, nama: $store.saldoActive.nama, saldo: $store.saldoActive.saldo})"
                    color="primary" 
                    size="md" 
                    outline="true"
                    icon='<svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160v-97q0-16 6-30.5t17-25.5l505-504q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L313-143q-11 11-25.5 17t-30.5 6h-97Zm544-528 56-56-56-56-56 56 56 56Z"/></svg>'
                  >
                    <div class="w-1"></div>
                    Edit
                    <div class="w-2.5"></div>
                  </x-custom-button>

                  {{-- tombol hapus --}}
                  <x-custom-button
                    color="danger"
                    size="md"
                    outline="true"
                    icon='<svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>'                  
                    @click.stop="$store.modal.openDelete({id: $store.saldoActive.id, jenis: $store.saldoActive.jenis, nama: $store.saldoActive.nama, saldo: $store.saldoActive.saldo})"
                  >
                    Hapus
                  </x-custom-button>
                </div>
              </template>
            </div>

          @else {{-- kalo data kosong --}}
            <div class="w-full h-[375px] flex flex-col items-center justify-center opacity-50">
              <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada kartu</h2>
              <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah kartu pertamamu agar <br> dapat dikelola!</p>
            </div>
          @endif
        </div>
      </div>
    </main>

    {{-- overlay --}}
    <div
      x-show="$store.modal.show"
      class="fixed inset-0 flex items-center justify-center bg-[rgba(0,0,0,0.3)] z-50"
      x-cloak
    >
      <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-lg">

        {{-- mode DELETE --}}
        <template x-if="$store.modal.mode === 'delete'">
          <div>
            <h2 class="text-lg font-semibold mb-2 text-gray-800">Hapus Kontak</h2>
            <p class="text-sm text-gray-600">
              Apakah kamu yakin ingin menghapus kartu <span class="font-semibold" x-text="$store.modal.formData.nama"></span>?
            </p>

            <form
              x-bind:action="`/saldo/${$store.modal.formData.id}`"
              method="POST"
              class="mt-4 flex justify-end gap-2"
            >
              @csrf
              @method('DELETE')
              <x-custom-button
                type="button"
                color="secondary"
                outline="true"
                @click="$store.modal.close()"
              >
                Batal
              </x-custom-button>

              <x-custom-button type="submit" color="danger">
                Hapus
              </x-custom-button>
            </form>
          </div>
        </template>

        {{-- mode ADD atau EDIT --}}
        <template x-if="$store.modal.mode !== 'delete'">
          <form
            x-bind:action="$store.modal.mode === 'add' ? '/saldo' : `/saldo/${$store.modal.formData.id}`"
            method="POST"
          >
            @csrf
            <template x-if="$store.modal.mode === 'edit'">
              @method('PUT')
            </template>

            <h2 class="text-lg font-semibold mb-2 text-gray-800" x-text="$store.modal.mode === 'add' ? 'Tambah Kartu' : 'Edit Kartu'"></h2>
            <x-notification :success="[]" :errors="$errors" />
            <x-custom-input-form
              label="Jenis Kartu"
              name="jenis"
              type="select"
              placeholder="Pilih Jenis Kartu"
              :options="['Cash','Bank']"
              required="true"
              xModel="$store.modal.formData.jenis"
            />
            <x-custom-input-form
              label="Nama Kartu"
              name="nama"
              placeholder="Masukkan Nama Kartu"
              required="true"
              xModel="$store.modal.formData.nama"
            />
            <x-custom-input-form
              label="Saldo Awal"
              name="saldo"
              placeholder="Masukkan Saldo Awal"
              xModel="$store.modal.formData.saldo"
            />

            <div class="flex justify-end gap-3 mt-4">
              <x-custom-button
                type="button"
                color="secondary"
                outline="true"
                @click="$store.modal.close()"
              >
                Batal
              </x-custom-button>
              <x-custom-button type="submit" color="primary">
                <span x-text="$store.modal.mode === 'add' ? 'Tambahkan' : 'Simpan'"></span>
              </x-custom-button>
            </div>
          </form>
        </template>
      </div>
    </div>
  </div>
</x-layout>




<script>
  // inisialisasi id yang aktif dan data transaksi
  document.addEventListener('alpine:init', () => {
    // simpan open modal
    Alpine.store('modal', {
      show: false,
      mode: 'add',
      formData: { id: null, jenis: '', nama: '', saldo: '' },
      openAdd() {
        this.mode = 'add';
        this.formData = { id: null, jenis: '', nama: '', saldo: '' };
        this.show = true;
      },
      openEdit(data) {
        this.mode = 'edit';

        //besarin bank atau cash jadi Bank atau Cash
        const clonedData = { ...data };
        if (clonedData.jenis) {
          clonedData.jenis = clonedData.jenis.charAt(0).toUpperCase() + clonedData.jenis.slice(1).toLowerCase();
        }
        this.formData = clonedData;
        this.show = true;
      },
      openDelete(data) {
        this.mode = 'delete';
        this.formData = { ...data };
        this.show = true;
      },
      close() {
        this.show = false;
      }
    });

    // simpan kartu yang aktif
    Alpine.store('saldoActive', {
      id: -1,
      nama: '', jenis: '', saldo: 0,
      set(newId, newNama = '', newJenis = '', newSaldo = 0) {
        this.id = newId;
        this.nama = newNama;
        this.jenis = newJenis;
        this.saldo = newSaldo;
      }
    });

    Alpine.store('transactions', {
      data: [],
      set(newData) { this.data = newData }
    });
    
    // initial fetch setelah store siap
    fetch('/saldo/fetch/-1')
      .then(res => res.json())
      .then(data => { Alpine.store('transactions').data = data })
      .catch(console.error)

    // buka modal otomatis jika ada error
    if ({{ $errors->any() ? 'true' : 'false' }}) {
      Alpine.store('modal').show = true;
    }
  });

  // buat chart
  window.addEventListener('DOMContentLoaded', () => {
    // initial data untul saldoActive
    Alpine.store('saldoActive').set(-1, '', '', {{ $totalSaldo }});

    const ctx = document.getElementById('saldoDetailChart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'Saldo',
          data: [],
          borderColor: '#80f0b5',
          backgroundColor: 'rgba(128, 240, 181, 0.3)',
          fill: true,
          tension: 0
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true }},
        plugins: {legend: { display: false }},
        scales: {
          x: {
            grid: { color: '#fff', borderDash: [5,5] }
          }
        }
      }
    });

    // fungsi update chart saldo harian
    function updateSaldoChart(transactions, saldoAwal) {
      if (Array.isArray(transactions) && transactions.length) {
        let sorted = [...transactions].sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));
        let saldoHarian = [];
        let labels = [];
        let saldo = saldoAwal;
        sorted.forEach(item => {
          let jenis = (item.jenis || '').toLowerCase();
          let jumlah = Number(item.jumlah);
          if (['penjualan'].includes(jenis))
            saldo += jumlah;
          else if (['pembelian', 'tagihan'].includes(jenis))
            saldo -= jumlah;
          labels.push(item.tanggal);
          saldoHarian.push(saldo);
        });
        chart.data.labels = labels;
        chart.data.datasets[0].data = saldoHarian;
        chart.update();
      } else {
        chart.data.labels = [];
        chart.data.datasets[0].data = [];
        chart.update();
      }
    }

    // update kalo ada data baru
    Alpine.effect(() => {
      let newData = Alpine.store('transactions').data;
      let saldoAwal = Number(Alpine.store('saldoActive').saldo) || 0;
      updateSaldoChart(newData, saldoAwal);
    });

    // initial fetch juga update chart
    fetch('/saldo/fetch/-1')
      .then(res => res.json())
      .then(data => {
        Alpine.store('transactions').data = data;
        let saldoAwal = Number(Alpine.store('saldoActive').saldo) || 0;
        updateSaldoChart(data, saldoAwal);
      })
      .catch(console.error);
  });
</script>