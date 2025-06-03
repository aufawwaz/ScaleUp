@props([
    'action', // route untuk form hapus
    'title' => 'Konfirmasi Hapus',
    'message' => 'Yakin ingin menghapus data ini?',
    'button' => 'Hapus',
    'method' => 'DELETE',
    'buttonClass' => 'bg-danger hover:bg-red-700 text-white p-3 rounded-full shadow transition cursor-pointer'
])

<div x-data="{ open: false }" class="relative">
    <!-- Trigger -->
    <button type="button" @click="open = true" {{ $attributes->merge(['class' => $buttonClass]) }}>
        {{ $slot }}
    </button>
    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40" x-cloak>
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm">
            <h2 class="text-lg font-bold mb-2">{{ $title }}</h2>
            <p class="mb-6 text-gray-600">{{ $message }}</p>
            <div class="flex justify-end gap-2">
                <button type="button" @click="open = false" class="cursor-pointer px-4 py-2 rounded-xl text-sm bg-gray-200 hover:bg-gray-300 text-gray-700">Batal</button>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if(strtoupper($method) !== 'POST')
                        @method($method)
                    @endif
                    <button type="submit" class="px-4 py-2 rounded-xl bg-danger cursor-pointer hover:bg-red-700 text-sm text-white">{{ $button }}</button>
                </form>
            </div>
        </div>
    </div>
</div>