<x-layout
  titlePage="Add Product - ScaleUp"
  title="Produk"  
>
  <main class="main-container">
    <div class="p-[1rem] min-h-[calc(100dvh-60px)] flex flex-col gap-[1.5rem]">
     <x-header-page title="EDIT KONTAK"></x-header-page>
       <form action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Kolom Kiri: Upload & Info Dasar -->
          <div class="bg-white rounded-2xl shadow p-6 flex flex-col gap-4">
            <label class="font-semibold mb-2">Upload Foto Kontak</label>
            <div class="flex items-center w-full mb-4">
                <label for="image" class="flex flex-col items-center justify-center w-40 h-40 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 relative">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4h6v4a1 1 0 01-1 1z" />
                    </svg>
                    <span class="text-xs text-gray-500 mt-2">Pilih Gambar</span>
                    <input id="image" name="image_kontak" type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
                    <img id="image-preview" 
                      src="{{ $contact->image_kontak ? asset('storage/' . $contact->image_kontak) : '' }}"
                      class="absolute top-0 left-0 w-full h-full object-cover rounded opacity-0 transition-opacity duration-200 {{ $contact->image_kontak ? 'opacity-100' : 'opacity-0' }}" />
                </label>
              </div>
              <span class="text-xs text-gray-400 mt-[-1rem] mb-2 block">
                  Maksimal ukuran gambar 5MB. Format: JPG, JPEG, PNG dan WEBP.
              </span>
            <x-custom-input-form label="Nama Kontak" name="nama_kontak" required="true" placeholder="Masukkan Nama Kontak" :value="$contact->nama_kontak" />
          </div>
          
          <!-- Kolom Kanan: Detail Kontak (Opsional) -->
          <div class="bg-white rounded-2xl shadow p-6 flex flex-col gap-4">
            <label class="font-semibold mb-2">DETAIL KONTAK</label>
            <x-custom-input-form label="Nomor Handphone" name="nomor_handphone" placeholder="Masukkan Nomor Handphone" :value="$contact->nomor_handphone" />
            <x-custom-input-form label="Email" name="email_kontak" placeholder="Masukkan Email Kontak" :value="$contact->email_kontak" />
            <x-custom-input-form label="Alamat" name="alamat_kontak" type="textarea" placeholder="Masukkan Alamat Kontak" :value="$contact->alamat_kontak" />
          </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-4 mt-8">
            <x-custom-button href="{{ route('contact.index') }}" color="danger" outline="true">Batalkan</x-custom-button>
            <x-custom-button type="submit" color="primary">Simpan Kontak</x-custom-button>
        </div>
      </form>
    </div>
  </main>
</x-layout>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('opacity-0');
            preview.classList.add('opacity-100');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('opacity-0');
        preview.classList.remove('opacity-100');
    }
}
</script>