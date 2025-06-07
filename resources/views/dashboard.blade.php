<x-layout 
  titlePage="Dashboard - ScaleUp"
  title="Dashboard"  
>
  <main class="main-container">
    <div class="p-[1rem] min-h-[calc(100dvh-60px)] flex flex-col gap-[1.5rem]">
    <!-- Card Dashboard -->
    <div class="flex gap-[1rem]">
      <!-- Card -->
      <x-card-dashboard
        title="Saldo"
        value="Rp {{ number_format($saldo, 0, ',', '.') }}"
        icon='<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M200-240v40-560 520Zm12.31 100q-29.92 0-51.12-21.19Q140-182.39 140-212.31v-535.38q0-29.92 21.19-51.12Q182.39-820 212.31-820h535.38q29.92 0 51.12 21.19Q820-777.61 820-747.69v108.85h-60v-108.85q0-5.39-3.46-8.85t-8.85-3.46H212.31q-5.39 0-8.85 3.46t-3.46 8.85v535.38q0 5.39 3.46 8.85t8.85 3.46h535.38q5.39 0 8.85-3.46t3.46-8.85v-108.85h60v108.85q0 29.92-21.19 51.12Q777.61-140 747.69-140H212.31Zm320-160q-29.92 0-51.12-21.19Q460-342.39 460-372.31v-215.38q0-29.92 21.19-51.12Q502.39-660 532.31-660h255.38q29.92 0 51.12 21.19Q860-617.61 860-587.69v215.38q0 29.92-21.19 51.12Q817.61-300 787.69-300H532.31Zm255.38-60q5.39 0 8.85-3.46t3.46-8.85v-215.38q0-5.39-3.46-8.85t-8.85-3.46H532.31q-5.39 0-8.85 3.46t-3.46 8.85v215.38q0 5.39 3.46 8.85t8.85 3.46h255.38ZM640-420q25 0 42.5-17.5T700-480q0-25-17.5-42.5T640-540q-25 0-42.5 17.5T580-480q0 25 17.5 42.5T640-420Z"/></svg>'
        button-label="Semua Rekening"
        button-url="{{ route('saldo') }}"
      />
      <x-card-dashboard
        title="Transaksi"
        value="{{ $transaksi }}"
        icon='<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M322.33-289.23q15.05 0 25.21-10.18 10.15-10.18 10.15-25.23t-10.18-25.21Q337.33-360 322.28-360t-25.2 10.18q-10.16 10.18-10.16 25.23t10.18 25.2q10.19 10.16 25.23 10.16Zm0-155.39q15.05 0 25.21-10.18 10.15-10.18 10.15-25.23t-10.18-25.2q-10.18-10.15-25.23-10.15t-25.2 10.18q-10.16 10.18-10.16 25.23t10.18 25.2q10.19 10.15 25.23 10.15Zm0-155.38q15.05 0 25.21-10.18 10.15-10.18 10.15-25.23t-10.18-25.2q-10.18-10.16-25.23-10.16t-25.2 10.18q-10.16 10.18-10.16 25.23t10.18 25.21Q307.29-600 322.33-600Zm151.52 305.38h167.69q12.75 0 21.37-8.63 8.63-8.62 8.63-21.38 0-12.75-8.63-21.37-8.62-8.61-21.37-8.61H473.85q-12.75 0-21.38 8.62-8.62 8.63-8.62 21.39 0 12.75 8.62 21.37 8.63 8.61 21.38 8.61Zm0-155.38h167.69q12.75 0 21.37-8.63 8.63-8.63 8.63-21.38 0-12.76-8.63-21.37-8.62-8.62-21.37-8.62H473.85q-12.75 0-21.38 8.63-8.62 8.63-8.62 21.38 0 12.76 8.62 21.37 8.63 8.62 21.38 8.62Zm0-155.39h167.69q12.75 0 21.37-8.62 8.63-8.63 8.63-21.39 0-12.75-8.63-21.37-8.62-8.61-21.37-8.61H473.85q-12.75 0-21.38 8.63-8.62 8.62-8.62 21.38 0 12.75 8.62 21.37 8.63 8.61 21.38 8.61ZM212.31-140Q182-140 161-161q-21-21-21-51.31v-535.38Q140-778 161-799q21-21 51.31-21h535.38Q778-820 799-799q21 21 21 51.31v535.38Q820-182 799-161q-21 21-51.31 21H212.31Zm0-60h535.38q4.62 0 8.46-3.85 3.85-3.84 3.85-8.46v-535.38q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H212.31q-4.62 0-8.46 3.85-3.85 3.84-3.85 8.46v535.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85ZM200-760v560-560Z"/></svg>'
        button-label="Tambah Transaksi"
        button-url="{{ route('transaction') }}"
      />
      <x-card-dashboard
        title="Kontak"
        value="{{ $kontak }}"
        icon='<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M71.93-276.62q0-30.92 15.96-55.19 15.96-24.27 42.63-37.76 57.02-27.89 114.67-43.01 57.66-15.11 126.73-15.11 69.08 0 126.73 15.11 57.66 15.12 114.68 43.01 26.67 13.49 42.63 37.76 15.96 24.27 15.96 55.19v28.16q0 24.15-17.73 42.46-17.73 18.31-43.04 18.31H132.69q-25.3 0-43.03-17.73-17.73-17.74-17.73-43.04v-28.16Zm755.38 88.93h-90.85q7.54-13.77 11.5-29.31t3.96-31.46v-33.08q0-39.38-19.28-75.07-19.29-35.68-54.72-61.23 40.23 6 76.39 18.57 36.15 12.58 69 29.73 31 16.54 47.88 38.99 16.88 22.44 16.88 49.01v33.08q0 25.3-17.73 43.04-17.73 17.73-43.03 17.73ZM371.92-492.31q-57.75 0-98.87-41.12-41.12-41.13-41.12-98.88 0-57.75 41.12-98.87 41.12-41.13 98.87-41.13 57.75 0 98.88 41.13 41.12 41.12 41.12 98.87 0 57.75-41.12 98.88-41.13 41.12-98.88 41.12Zm345.38-140q0 57.75-41.12 98.88-41.12 41.12-98.87 41.12-6.77 0-17.23-1.54-10.47-1.54-17.23-3.38 23.66-28.45 36.37-63.12 12.7-34.67 12.7-72 0-37.34-12.96-71.73-12.96-34.38-36.11-63.3 8.61-3.08 17.23-4 8.61-.93 17.23-.93 57.75 0 98.87 41.13 41.12 41.12 41.12 98.87ZM131.92-247.69h480v-28.93q0-12.53-6.27-22.3-6.26-9.77-19.88-17.08-49.38-25.46-101.69-38.58-52.31-13.11-112.16-13.11-59.84 0-112.15 13.11-52.31 13.12-101.69 38.58-13.62 7.31-19.89 17.08-6.27 9.77-6.27 22.3v28.93Zm240-304.62q33 0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0 304.62Zm0-384.62Z"/></svg>'
        button-label="Daftar Kontak"
        button-url="{{ route('contact.index') }}"
      />
      <x-card-dashboard
        title="Produk"
        value="{{ $produk }}"
        icon='<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M200-643.85v431.54q0 5.39 3.46 8.85t8.85 3.46h535.38q5.39 0 8.85-3.46t3.46-8.85v-431.54H620v236.93q0 20.69-17.08 31.23-17.08 10.53-35.15 1.3L480-418.08l-87.77 43.69q-18.07 9.23-35.15-1.3Q340-386.23 340-406.92v-236.93H200ZM212.31-140q-29.92 0-51.12-21.19Q140-182.39 140-212.31v-467.46q0-12.84 4.12-24.5 4.11-11.65 12.34-21.5l56.16-67.92q9.84-12.85 24.61-19.58Q252-820 268.46-820h422.31q16.46 0 31.42 6.73T747-793.69L803.54-725q8.23 9.85 12.34 21.69 4.12 11.85 4.12 24.7v466.3q0 29.92-21.19 51.12Q777.61-140 747.69-140H212.31Zm3.31-563.84H744l-43.62-51.93q-1.92-1.92-4.42-3.08-2.5-1.15-5.19-1.15H268.85q-2.69 0-5.2 1.15-2.5 1.16-4.42 3.08l-43.61 51.93ZM400-643.85v198.08l80-40 80 40v-198.08H400Zm-200 0h560-560Z"/></svg>'
        button-label="Kelola Produk"
        button-url="{{ route('product.index') }}"
      />
    </div>

    <!-- Filter -->
    <div class="flex gap-[0.5rem] h-[40px] mt-[0.5rem]">
      <x-filter-button  
        value="custom"
        icon='<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-40q0-17 11.5-28.5T280-880q17 0 28.5 11.5T320-840v40h320v-40q0-17 11.5-28.5T680-880q17 0 28.5 11.5T720-840v40h40q33 0 56.5 23.5T840-720v161q0 17-11.5 28.5T800-519q-17 0-28.5-11.5T760-559v-1H200v400h240q17 0 28.5 11.5T480-120q0 17-11.5 28.5T440-80H200Zm0-560h560v-80H200v80Zm0 0v-80 80Zm360 520v-66q0-8 3-15.5t9-13.5l209-208q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L695-92q-6 6-13.5 9T666-80h-66q-17 0-28.5-11.5T560-120Zm300-223-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/></svg>'
        :active="request('filter')"
      />
      <x-filter-button label="Hari Ini" value="today"   :active="request('filter')" />
      <x-filter-button label="Minggu Ini" value="week"  :active="request('filter')" />
      <x-filter-button label="Bulan Ini" value="month"  :active="request('filter')" />
      <x-filter-button label="Tahun Ini" value="year"   :active="request('filter')" />
    </div>

    <!-- Main Flex -->
    <div class="flex gap-[1rem]">

      <!-- Kolom 1: Doughnut Chart -->
      <div class="bg-white rounded-2xl shadow p-4 flex flex-col w-[320px]">
        <p class="dashboard-card-header">Total Pendapatan Kotor</p>
        <div class="mb-2 w-full h-[1px] bg-gray-300 mt-[1rem]"></div>
        <div class="w-full flex flex-col items-center justify-between h-full mt-5">
          <div class="relative w-[220px] h-[220px]">
            <canvas id="incomeDoughnut" class="w-full h-full"></canvas>
          </div>
          <div class="flex justify-center gap-4 mt-4 mb-2 flex-wrap">
            @foreach($labels as $i => $label)
              <div class="flex items-center gap-1">
                <span class="inline-block w-4 h-4 rounded-full" style="background: {{ $colors[$i] }}"></span>
                <span class="text-xs">{{ $label }}</span>
              </div>
            @endforeach
          </div>
          <div class="flex items-end justify-between w-full mt-2">
            <div>
              <p class="text-2xl font-bold">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <div class="flex flex-col items-end">
              <span class="flex items-center text-green-500 font-bold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $percent }}%
              </span>
              <span class="text-[10px] text-gray-500">Dari bulan lalu</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Kolom 2: Laba Rugi & Pesanan Terbaru -->
      <div class="flex flex-col flex-auto gap-[1rem]">
        <!-- Laba Rugi -->
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
          <p class="dashboard-card-header mb-[1rem]">Laba Rugi</p>
          <div class=" w-full h-[1px] bg-gray-300 mb-[1rem]"></div>
          <div class="flex items-center justify-between">
            <div>
              <span class="text-xs text-gray-500">Keuntungan</span>
              <p class="text-2xl font-bold">Rp {{ number_format($profit, 0, ',', '.') }}</p>
            </div>
            <div class="flex flex-col items-end">
              <span class="flex items-center text-green-500 font-bold text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $profitPercent }}%
              </span>
              <span class="text-[10px] text-gray-500">Dari bulan lalu</span>
            </div>
          </div>
        </div>
        <!-- Pesanan Terbaru -->
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
          <div class="flex items-center justify-between mb-[1rem]">
            <p class="dashboard-card-header">Pesanan Terbaru</p>
            <a href="#" class="text-primary text-xs w-full flex justify-end font-medium">Lihat semua &gt;</a>
          </div>
          <div class="w-full h-[1px] bg-gray-300 mb-[1rem]"></div>
          <div class="overflow-x-auto">
            <table class="min-w-full text-xs">
              <thead>
                <tr class="text-left text-gray-500">
                  <th class="py-2 px-2">PELANGGAN</th>
                  <th class="py-2 px-2">PRODUK</th>
                  <th class="py-2 px-2">HARGA</th>
                  <th class="py-2 px-2">PEMBAYARAN</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                  <tr>
                    <td class="py-2 px-2">{{ $order['customer'] }}</td>
                    <td class="py-2 px-2">{{ $order['product'] }}</td>
                    <td class="py-2 px-2">Rp {{ number_format($order['price'], 0, ',', '.') }}</td>
                    <td class="py-2 px-2">
                      <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs">{{ $order['pembayaran'] }}</span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Kolom 3: Pelanggan Teratas & Produk Terlaris -->
      <div class="flex flex-col gap-[1rem] w-[360px] justify-between">
        <!-- Pelanggan Teratas -->
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col h-full justify-between">
          <div class="flex items-center justify-between mb-[1rem]">
            <p class="dashboard-card-header">Pelanggan Teratas</p>
            <a href="#" class="text-primary text-xs font-medium w-fit whitespace-nowrap">Lihat semua &gt;</a>
          </div>
          <div class="w-full h-[1px] bg-gray-300 mb-[1rem]"></div>
          <ul class="space-y-3 flex flex-col h-full">
            @foreach($topCustomers as $customer)
              <li class="flex items-center gap-2">
                <img src="{{ $customer['avatar'] }}" class="w-5 h-5 rounded-full" alt="{{ $customer['name'] }}">
                <span class="font-semibold text-xs">{{ $customer['name'] }}</span>
                <span class="ml-auto text-xs text-gray-500">{{ $customer['count'] }} pembelian</span>
              </li>
            @endforeach
          </ul>
        </div>
        <!-- Produk Terlaris -->
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col h-full justify-between">
          <div class="flex items-center justify-between mb-[1rem]">
            <p class="dashboard-card-header">Produk Terlaris</p>
            <a href="#" class="text-primary text-xs font-medium w-full flex justify-end">Lihat semua &gt;</a>
          </div>
          <div class="w-full h-[1px] bg-gray-300 mb-[1rem]"></div>
          <ul class="space-y-3 flex flex-col h-full">
            @foreach($topProducts as $product)
              <li class="flex items-center gap-2">
                <img src="{{ $product['avatar'] }}" class="w-5 h-5 rounded-full" alt="{{ $product['name'] }}">
                <span class="font-semibold text-xs">{{ $product['name'] }}</span>
                <span class="ml-auto text-xs text-gray-500">{{ $product['sold'] }} terjual</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    </div>

    <script>
      new Chart(document.getElementById('incomeDoughnut'), {
        type: 'doughnut',
        data: {
          labels: @json($labels),
          datasets: [{
            data: @json($data),
            backgroundColor: @json($colors),
            hoverOffset: 4
          }]
        },
        options: {
          cutout: '65%',
          plugins: { legend: { display: false } },
          maintainAspectRatio: false
        }
      });
    </script>
  </main>
</x-layout>