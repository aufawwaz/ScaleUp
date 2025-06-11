<x-layout
  titlePage="Profile - ScaleUp"
  title="Profil"  
>
    <main class="main-container">
        <div class="p-[1rem]">
            <div class="bg-white rounded-xl shadow p-[32px]">
                <div class="flex flex-col md:flex-row gap-[32px]">
                    
                    <!-- Kiri: Foto & Info User -->
                    <div class="flex flex-col items-center border-r border-gray-300 pr-[32px]">
                        <div class="w-[240px] aspect-square rounded overflow-hidden mb-4 border-4 border-gray-200">
                            @if($user->profile_photo)
                                @if(Str::startsWith($user->profile_photo, 'http'))
                                    <img src="{{ $user->profile_photo }}" alt="Foto Profil" class="object-cover w-full h-full">
                                @else
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Profil" class="object-cover w-full h-full">
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-5xl font-bold text-gray-400">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold text-center">{{ $user->name }}</h2>
                        <p class="text-gray-500 text-center mb-2">{{ $user->email }}</p>
                        <span class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-xs font-semibold">Basic Member</span>
                    </div>
                    
                    <!-- Kanan: Detail Profil -->
                    <div class="w-full flex flex-col gap-6">
                        <div class="flex w-full justify-between items-center">
                            <h3 class="text-lg font-bold">Detail Profil</h3>
                            <x-custom-button
                                href="{{ route('profile.edit') }}"
                                color="primary"
                            >Ubah Profil</x-custom-button>
                        </div>
                        <div class="h-[1px] w-full bg-gray-300"></div>
                        <div class="flex w-full h-full gap-6">
                            <!-- Informasi Usaha -->
                            <div class="flex-1">
                                <h4 class="font-bold text-base mb-5">Informasi Usaha</h4>
                                <div class="mb-5 flex text-sm"><span class="w-full">Nama Usaha</span>      <span class="font-semibold w-full">{{ $user->nama_usaha ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">Nomor Handphone</span> <span class="font-semibold w-full">{{ $user->nomor_handphone ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">Tipe Usaha</span>      <span class="font-semibold w-full">{{ $user->tipe_usaha ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">NPWP</span>            <span class="font-semibold w-full">{{ $user->npwp ?? '-' }}</span></div>
                            </div>
                            <div class="w-[0.5px] h-full bg-gray-300"></div>
                            <!-- Alamat Perusahaan -->
                            <div class="flex-1">
                                <h4 class="font-bold text-base mb-5">Alamat Perusahaan</h4>
                                <div class="mb-5 flex text-sm"><span class="w-full">Provinsi</span>         <span class="font-semibold w-full">{{ $user->provinsi ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">Kabupaten/Kota</span>   <span class="font-semibold w-full">{{ $user->kabupaten_kota ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">Kecamatan</span>        <span class="font-semibold w-full">{{ $user->kecamatan ?? '-' }}</span></div>
                                <div class="mb-5 flex text-sm"><span class="w-full">Desa</span>             <span class="font-semibold w-full">{{ $user->desa ?? '-' }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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

</x-Layout>
