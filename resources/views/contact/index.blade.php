@php
use Illuminate\Support\Str;
@endphp

<x-layout
  titlePage="Contact - ScaleUp"
  title="Kontak"  
>
  <!-- Bungkus modal buat hapus -->
  <div 
  x-data="{ showModal: false, deleteUrl: '', contactName: '' }" 
  x-cloak
  >

  <main class="main-container">
    <div class="p-[1rem] flex flex-col gap-[1rem] h-fit">

      <!-- Header -->
      <x-header-page title="DATA KONTAK">
        <div class="flex gap-[0.5rem] z-10">
          <!-- Tambah kontak -->
          <x-custom-button href="{{ route('contact.create') }}" color="primary">Tambah Kontak</x-custom-button>
        </div>
      </x-header-page>


      <!-- Filter and Search(maybe) -->
      @if($contacts->isEmpty())
      <div></div>
      @else
      <div class="flex w-full justify-end">
        <x-search-bar
          placeholder="Cari kontak..."  name="search" :value="request('search')"
        >
        </x-search-bar>
      </div>
      @endif

      <!-- Tabel Kontak -->
      @if($contacts->isEmpty())
        <div class="flex flex-col items-center justify-center h-[500px] opacity-50">
            <h2 class="text-base text-gray-700 font-semibold mb-2">Belum ada kontak</h2>
            <p class="text-gray-500 mb-4 text-sm text-center">Yuk, tambah kontak pertamamu agar <br> dapat dikelola!</p>
        </div>
      @else
      <div class="p-3 bg-white w-full rounded-2xl shadow">
        <table class="min-w-full rounded-xl overflow-clip">
          <thead>
            <tr class="bg-primary/10 text-primary">  
              <th class="py-4 px-3 font-bold text-xs text-left">No</th>
              <th class="py-4 px-3 font-bold text-xs text-left">Nama</th>
              <th class="py-4 px-3 font-bold text-xs text-left">No. Handphone</th>
              <th class="py-4 px-3 font-bold text-xs text-left">Email</th>
              <th class="py-4 px-3 font-bold text-xs text-left">Alamat</th>
              <th class="py-4 px-3 font-bold text-xs text-left">Transaksi</th>
              <th class="py-4 px-3 font-bold text-xs text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contacts as $contact)
            <tr onclick="window.location='{{ route('contact.show', $contact->id) }}'"
              class="hover:bg-gray-50 transition cursor-pointer border-b border-gray-100 h-16">
              <td class="px-3 font-normal text-xs">
                {{ $loop->iteration + ($contacts->currentPage() - 1) * $contacts->perPage() }}
              </td>       
              <td class="px-3 font-normal items-center h-16 text-xs flex gap-2">
                @if ($contact->image_kontak)
                  <img src="{{ asset('storage/' . $contact->image_kontak) }}"
                      alt="{{ $contact->nama_kontak }}"
                      class="w-8 aspect-square object-cover rounded-full transition duration-300" />
                @else
                  <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full text-xs font-bold text-gray-700">
                    {{ strtoupper(substr($contact->nama_kontak, 0, 1)) }}
                  </span>
                @endif
                
                {{ Str::limit($contact->nama_kontak, 20) }}
              </td>
              <td class="px-3 font-normal text-xs">{{ Str::limit($contact->nomor_handphone, 20) }}</td>
              <td class="px-3 font-normal text-xs">{{ Str::limit($contact->email_kontak, 30) }}</td>
              <td class="px-3 font-normal text-xs">{{ Str::limit($contact->alamat_kontak, 30) }}</td>
              <td class="px-3 font-normal text-xs">{{ $contact->jumlah_transaksi }}</td>
              <td class="px-3 font-normal text-xs flex w-fit gap-1 h-16 items-center">
                <x-custom-button href="{{ route('contact.edit', $contact->id) }}" color="primary" size="sm" outline="true"
                  icon='<svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160v-97q0-16 6-30.5t17-25.5l505-504q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L313-143q-11 11-25.5 17t-30.5 6h-97Zm544-528 56-56-56-56-56 56 56 56Z"/></svg>'
                ></x-custom-button>
                <x-custom-button
                  color="danger"
                  size="sm"
                  outline="true"
                  icon='<svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>'                  
                  @click.stop="showModal = true; deleteUrl = '{{ route('contact.destroy', $contact->id) }}'; contactName = '{{ $contact->nama_kontak }}'"
                >
                </x-custom-button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="">
          {{ $contacts->links() }}
        </div>
      </div>
      @endif
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
          Apakah kamu yakin ingin menghapus kontak <span class="font-semibold" x-text="contactName"></span>?
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
