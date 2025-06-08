<div
  x-data
  :data-id="{{ $id }}"
  @click="
    $store.saldoActive.set(Number($el.dataset.id), '{{ addslashes($nama) }}', '{{ addslashes($jenis) }}', {{ $saldo }});
    fetch(`/saldo/fetch/${$el.dataset.id}`)
      .then(res => res.json())
      .then(data => $store.transactions.set(data))
      .catch(console.error)
  "
  class="saldo-card w-full shadow-sm bg-white px-4 p-3 rounded-2xl flex flex-row justify-between items-center hover:bg-gray-100 cursor-pointer hover:shadow-md transition-all"
  x-bind:class="Number($store.saldoActive.id) === Number($el.dataset.id) 
    ? 'bg-gradient-to-r from-primary-600 via-primary-500 to-success-300'
    : 'bg-white text-gray-800 hover:bg-gray-100'"
>
  <div class="flex gap-2 items-center">
    {{-- icon container --}}
    <div
      class="rounded-lg w-[44px] h-[44px] flex items-center justify-center transition-colors"
      :class="$store.saldoActive.id == {{ $id }}
        ? 'bg-primary'
        : 'bg-primary-100'"
    >
      {{-- svg icon --}}
      <svg
        xmlns="http://www.w3.org/2000/svg"
        height="32px"
        width="32px"
        viewBox="0 -960 960 960"
        fill="currentColor"
        :class="$store.saldoActive.id == {{ $id }}
          ? 'text-white'
          : 'text-primary'"
      >
        @if ($jenis == 'cash')
          <path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/>
        @else
          <path d="M200-280v-280h80v280h-80Zm240 0v-280h80v280h-80ZM80-120v-80h800v80H80Zm600-160v-280h80v280h-80ZM80-640v-80l400-200 400 200v80H80Zm178-80h444-444Zm0 0h444L480-830 258-720Z"/>
        @endif
      </svg>
    </div>

    {{-- teks --}}
    <div class="flex flex-col justify-center ml-2">
      <span
        class="text-xs transition-colors"
        :class="$store.saldoActive.id == {{ $id }}
          ? 'text-white/80'
          : 'text-gray-600'"
      >{{ $nama }}</span>
      <span
        class="text-base font-semibold transition-colors"
        :class="$store.saldoActive.id == {{ $id }}
          ? 'text-white'
          : 'text-gray-800'"
      >Rp {{ number_format($saldo,0,',','.') }}</span>
    </div>
  </div>

  {{-- panah --}}
  <div
    class="text-xl transition-colors"
    :class="$store.saldoActive.id == {{ $id }}
      ? 'text-white'
      : 'text-gray-400'"
  >&gt;</div>
</div>