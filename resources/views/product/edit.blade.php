<x-layout
  titlePage="Edit Product - ScaleUp"
  title="Produk"
>
  <main class="main-container">
    <div class="p-[1rem] min-h-[calc(100dvh-60px)] flex flex-col gap-[1.5rem]">
      <x-header-page title="EDIT PRODUK"></x-header-page>
      <form action="{{ route('product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Kolom Kiri: Upload & Info Dasar -->
          <div class="bg-white rounded-2xl shadow p-6 flex flex-col gap-4">
            <label class="font-semibold mb-2">Upload Foto Produk</label>
            <div class="flex items-center w-full mb-4">
              <label for="image" class="flex flex-col items-center justify-center w-40 h-40 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 relative">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4h6v4a1 1 0 01-1 1z" />
                </svg>
                <span class="text-xs text-gray-500 mt-2">Pilih Gambar</span>
                <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
                <img id="image-preview"
                     src="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                     class="absolute top-0 left-0 w-full h-full object-cover rounded transition-opacity duration-200 {{ $product->image ? 'opacity-100' : 'opacity-0' }}" />
              </label>
            </div>
            <span class="text-xs text-gray-400 mt-[-1rem] mb-2 block">
              Maksimal ukuran gambar 5MB. Format: JPG, JPEG, PNG.
            </span>
            <x-custom-input-form label="Nama Produk" name="nama_produk" required="true" placeholder="Masukkan Nama Produk" :value="$product->nama_produk" />
            <x-custom-input-form label="Satuan" name="satuan" type="select" required="true" :options="['Pcs','Box','Kg','Lusin','Lainnya']" placeholder="Pilih Satuan" :value="$product->satuan" />
            <x-custom-input-form label="Harga Jual" name="harga_jual" type="number" required="true" placeholder="Masukkan Harga Produk" :value="$product->harga_jual" />
          </div>

          <!-- Kolom Kanan: Detail Produk -->
          <div class="bg-white rounded-2xl shadow p-6 flex flex-col gap-4">
            <label class="font-semibold mb-2">DETAIL PRODUK</label>
            <x-custom-input-form label="Harga Modal" name="harga_modal" type="number" placeholder="Masukkan Harga Modal" :value="$product->harga_modal" />
            <x-custom-input-form label="Kategori" name="kategori" type="select" :options="['Barang','Jasa','Lainnya']" placeholder="Pilih Kategori" :value="$product->kategori" />
            <x-custom-input-form label="Deskripsi Produk" name="deskripsi" type="textarea" placeholder="Masukkan Deskripsi" :value="$product->deskripsi" />
            <!-- Stok Saat Ini -->
            <div class="mb-2">
                <label class="block text-sm font-normal text-gray-700">Stok Saat Ini</label>
                <div class="py-2 px-3 bg-gray-100 rounded text-gray-700 font-semibold">
                    {{ $product->stok }}
                </div>
            </div>
            <!-- Perubahan Stok -->
            <x-custom-input-form
                label="Perubahan Stok (boleh negatif/positif)"
                name="stok_change"
                type="number"
                placeholder="Contoh: 5 atau -3"
                :value="0"
            />
          </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-4 mt-8">
          <x-custom-button href="{{ route('product.index') }}" color="danger" outline="true">Batalkan</x-custom-button>
          <x-custom-button type="submit" color="primary">Update Produk</x-custom-button>
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