<x-Layout
    titlePage="Profile - ScaleUp"
    title="Edit Profil"
>
<main class="main-container">
    <div class="p-[1rem]">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow p-8">
            @csrf
            @method('PUT')
            <div class="flex gap-[32px]">
                <!-- Kiri: Foto & Info User -->
                <div class="flex-1 flex-col items-center">
                    <div class="flex w-fit flex-col items-start mb-5">
                    <label for="profile_photo" class="relative w-40 h-40 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-200 overflow-hidden shadow transition-all duration-300">
                        @if(Auth::user()->profile_photo)
                            <img id="profile-photo-preview" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="object-cover w-full h-full">
                        @else
                            <div id="profile-photo-preview" class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        @endif
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewProfilePhoto(event)">
                    </label>
                    <span class="text-sm text-gray-500 mt-2">Klik untuk mengunggah foto</span>
                </div>
                    <div class="w-full pr-20 flex flex-col gap-4">
                        <!-- Informasi Usaha -->
                        <h4 class="font-semibold">Informasi Usaha</h4>
                        <x-custom-input-form label="Nama Usaha" name="nama_usaha" :value="Auth::user()->nama_usaha" placeholder="Masukkan Nama Usaha" />
                        <x-custom-input-form label="Nomor Handphone" name="nomor_handphone" :value="Auth::user()->nomor_handphone" placeholder="Masukkan Nomor Handphone" />
                        <x-custom-input-form label="Tipe Usaha" name="tipe_usaha" :value="Auth::user()->tipe_usaha" placeholder="Masukkan Tipe Usaha" />
                        <x-custom-input-form label="NPWP" name="npwp" :value="Auth::user()->npwp" placeholder="Masukkan NPWP" />
                    </div>
                </div>
                <!-- Kanan: Detail Profil -->
                <div class="flex-1 flex flex-col">
                    <div class="flex flex-col gap-10">
                    <div class="flex justify-end gap-2">
                        <x-custom-button
                            href="{{ route('profile.show') }}"
                            outline="true"
                            color="danger"
                        >Batal</x-custom-button>
                        <x-custom-button
                            type="submit"
                        >Simpan Perubahan</x-custom-button>
                    </div>
                        <!-- Alamat Perusahaan -->
                        <div class="w-full pr-20 flex flex-col gap-4">
                            <h4 class="font-semibold">Alamat Perusahaan</h4>
                            <x-custom-input-form label="Provinsi" name="provinsi" id="provinsi" type="select" :value="Auth::user()->provinsi" placeholder="Pilih Provinsi" />
                            <x-custom-input-form label="Kabupaten/Kota" name="kabupaten_kota" id="kabupaten" type="select" :value="Auth::user()->kabupaten_kota" placeholder="Pilih Kabupaten/Kota" />
                            <x-custom-input-form label="Kecamatan" name="kecamatan" id="kecamatan" type="select" :value="Auth::user()->kecamatan" placeholder="Pilih Kecamatan" />
                            <x-custom-input-form label="Desa" name="desa" id="desa" type="select" :value="Auth::user()->desa" placeholder="Pilih Desa/Kelurahan" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
function previewProfilePhoto(event) {
    const input = event.target;
    const preview = document.getElementById('profile-photo-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                preview.innerHTML = '';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'object-cover w-full h-full';
                preview.appendChild(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kabupaten');
    const kecamatanSelect = document.getElementById('kecamatan');
    const desaSelect = document.getElementById('desa');

    // Helper untuk set option
    function setOptions(select, data, valueKey = 'name', idKey = 'id', selectedValue = null) {
        select.innerHTML = '<option value="">Pilih</option>';
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueKey];
            option.text = item[valueKey];
            if (selectedValue && selectedValue == item[valueKey]) option.selected = true;
            option.dataset.id = item[idKey];
            select.appendChild(option);
        });
    }

    // Fetch provinsi
    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(res => res.json())
        .then(provinces => {
            setOptions(provinsiSelect, provinces, 'name', 'id', "{{ old('provinsi', Auth::user()->provinsi) }}");
            if (provinsiSelect.value) provinsiSelect.dispatchEvent(new Event('change'));
        });

    // Fetch kabupaten saat provinsi berubah
    provinsiSelect.addEventListener('change', function() {
        const selected = Array.from(provinsiSelect.options).find(opt => opt.value === provinsiSelect.value);
        if (!selected || !selected.dataset.id) return;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selected.dataset.id}.json`)
            .then(res => res.json())
            .then(regencies => {
                setOptions(kabupatenSelect, regencies, 'name', 'id', "{{ old('kabupaten_kota', Auth::user()->kabupaten_kota) }}");
                kabupatenSelect.dispatchEvent(new Event('change'));
            });
    });

    // Fetch kecamatan saat kabupaten berubah
    kabupatenSelect.addEventListener('change', function() {
        const selected = Array.from(kabupatenSelect.options).find(opt => opt.value === kabupatenSelect.value);
        if (!selected || !selected.dataset.id) return;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${selected.dataset.id}.json`)
            .then(res => res.json())
            .then(districts => {
                setOptions(kecamatanSelect, districts, 'name', 'id', "{{ old('kecamatan', Auth::user()->kecamatan) }}");
                kecamatanSelect.dispatchEvent(new Event('change'));
            });
    });

    // Fetch desa saat kecamatan berubah
    kecamatanSelect.addEventListener('change', function() {
        const selected = Array.from(kecamatanSelect.options).find(opt => opt.value === kecamatanSelect.value);
        if (!selected || !selected.dataset.id) return;
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${selected.dataset.id}.json`)
            .then(res => res.json())
            .then(villages => {
                setOptions(desaSelect, villages, 'name', 'id', "{{ old('desa', Auth::user()->desa) }}");
            });
    });
});
</script>
</x-Layout>