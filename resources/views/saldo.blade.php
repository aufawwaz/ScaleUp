<x-layout   
  titlePage="Saldo - ScaleUp"
  title="Saldo"  
>
  <main class="main-container p-4 cursor-default">
    {{-- total saldonya --}}
    @if($data->isNotEmpty())
      <div class="flex flex-col bg-white shadow-sm rounded-2xl py-4 px-4 gap-2">
        <h1 class="text-gray-400 text-base">Total Saldo</h1>
        <h1 class="text-3xl font-semibold text-primary">Rp {{ number_format(12345000, 0, ',', '.') }}</h1>
      </div>
    @endif

    {{-- main content --}}
    <div class="p-2 mt-4">
      <x-header-page title="DATA SALDO">
        <div class="flex gap-[0.5rem]">
          <x-custom-button href="" color="primary">Tambah Kartu</x-custom-button>
        </div>
      </x-header-page>
      <div id="saldo-container" class="container flex flex-col mt-4 mb-8 gap-2 h-full">
        @if($data->isNotEmpty())
          @foreach ($data as $d)
            <x-saldo-card nama="{{ $d->nama }}" saldo="{{ $d->saldo }}" jenis="{{ $d->jenis }}"/>
          @endforeach
        @else
          <div class="w-full h-[375px] flex flex-col items-center justify-center opacity-50">
            <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada saldo</h2>
            <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah saldo pertamamu agar <br> dapat dikelola!</p>
        @endif
      </div>
    </div>
  </main>
</x-layout>

<script>

</script>