<x-layout titlePage="Detail Kontak - ScaleUp" title="Detail Kontak">
    <!-- Bungkus modal hapus -->
    <div x-data="{ showModal: false }" x-cloak>

      <main class="main-container">
        <div class="p-[1rem] flex flex-col gap-[1rem] h-fit">
            <x-header-page back="{{ route('contact.index') }}" title="{{ strtoupper($contact->nama_kontak) }}">
                <div class="flex gap-[0.5rem]">
                    <x-custom-button
                      color="danger"
                      outline="true"
                      block="true"
                      type="button"
                      @click="showModal = true"
                    >
                      Hapus Kontak
                    </x-custom-button>
                    <x-custom-button :href="route('contact.edit', $contact->id)" color="primary" block="true">
                        Edit Kontak
                    </x-custom-button>
                </div>
            </x-header-page>
            <div class="flex gap-[1rem] max-h-[720px]">
                
                <div class="w-1/4 flex flex-col gap-[1rem]">
                    <!-- Gambar & Detail Kontak -->
                    <div class="w-full flex items-center bg-white rounded-2xl shadow h-fit overflow-clip">
                        <div class="relative w-full aspect-square flex items-center justify-center overflow-hidden">
                            @if ($contact->image_kontak)                            
                              <img src="{{ $contact->image_kontak ? asset('storage/' . $contact->image_kontak) : '' }}"
                                  alt="{{ $contact->image_kontak }}"
                                  class="object-cover w-full h-full" />
                            @else
                              <span class="inline-flex items-center justify-center w-full h-full bg-gray-200 text-3xl font-bold text-gray-700">
                                {{ strtoupper(substr($contact->nama_kontak, 0, 1)) }}
                              </span>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Detail Kontak -->
                    <div class="w-full flex flex-col items-center bg-white rounded-2xl p-3 shadow h-fit text-sm">
                        <div class="flex flex-col gap-1.5 w-full"><span class="font-semibold">Nomor Handphone</span>{{ $contact->nomor_handphone }}</div>
                    </div>
                    <div class="w-full flex flex-col items-center bg-white rounded-2xl p-3 shadow h-fit text-sm">
                        <div class="flex flex-col gap-1.5 w-full"><span class="font-semibold">Email</span>{{ $contact->email_kontak }}</div>
                    </div>
                    <div class="w-full flex flex-col items-center bg-white rounded-2xl p-3 shadow h-fit text-sm">
                        <div class="flex flex-col gap-1.5 w-full"><span class="font-semibold">Alamat</span>{{ $contact->alamat_kontak }}</div>
                    </div>
                </div>  

                <!-- Riwayat Transaksi (Statis) -->
                <div class="rounded-2xl w-3/4 max-h-full">
                    <div class="bg-white p-6 shadow w-full h-full rounded-2xl">
                        <h3 class="font-bold text-lg mb-4">Riwayat Transaksi</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-xs rounded-xl overflow-clip">
                                <thead>
                                    <tr class="bg-primary/10 text-primary font-bold">
                                        <th class="py-4 px-3 text-left">Tanggal</th>
                                        <th class="py-4 px-3 text-left">Kode Transaksi</th>
                                        <th class="py-4 px-3 text-left">Status</th>
                                        <th class="py-4 px-3 text-left">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <!-- Baris data di sini -->
                                  @for($i = 0; $i < 10; $i++)
                                  <tr class="border-b border-gray-100">
                                    <td class="py-4 px-3">22/03/2025</td>
                                    <td class="py-4 px-3">TRSPJL22032025001</td>
                                    <td class="py-4 px-3"><span class="bg-success/10 text-success font-medium px-2 rounded-xl py-0.5">Lunas</span></td>
                                    <td class="py-4 px-3">Rp 90.000</td>
                                  </tr>
                                  @endfor
                                </tbody>
                            </table>
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
        <h2 class="text-lg font-semibold mb-2 text-gray-800">Hapus Kontak</h2>
        <p class="text-sm text-gray-600">
          Apakah kamu yakin ingin menghapus kontak <span class="font-semibold">{{ $contact->nama_kontak }}</span>?
        </p>
    
        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="mt-4 flex justify-end gap-2">
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
    
</x-layout>
