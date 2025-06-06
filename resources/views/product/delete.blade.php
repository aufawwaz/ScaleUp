<!-- <div x-if="showDelete">
    <div class="fixed inset-0 bg-[rgba(0,0,0,0.3)] flex items-center justify-center z-50 text-xs">
        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-xs">
            <div class="font-bold text-lg mb-2 text-gray-800">Konfirmasi Hapus</div>
            <div class="mb-6 text-gray-600">Apakah anda yakin ingin menghapus produk ini?</div>
            <div class="flex justify-end gap-2">
                <x-custom-button type="button"
                    @click="showDelete = false"
                    color="primary">
                    Batal
                </x-custom-button>
                <form :action="deleteUrl" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-custom-button type="submit"
                        color="danger"
                        outline="true">
                        Hapus
                    </x-custom-button>
                </form>
            </div>
        </div>
    </div>
</div> -->