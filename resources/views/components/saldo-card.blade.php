<div class="w-full shadow-sm bg-white px-4 p-3 rounded-2xl flex flex-row justify-between items-center hover:bg-gray-100 cursor-pointer">
    <div class="flex gap-2">
        {{-- icon --}}
        
        <div class=" rounded-lg bg-primary-100 w-[50px] h-[50px] text-primary flex items-center justify-center">
            @if ($jenis == 'cash')
                <svg xmlns="http://www.w3.org/2000/svg" height="36px" width="36px" viewBox="0 -960 960 960" fill="currentColor"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>
            @elseif ($jenis == 'bank')
                <svg xmlns="http://www.w3.org/2000/svg" height="36px" width="36px" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-280v-280h80v280h-80Zm240 0v-280h80v280h-80ZM80-120v-80h800v80H80Zm600-160v-280h80v280h-80ZM80-640v-80l400-200 400 200v80H80Zm178-80h444-444Zm0 0h444L480-830 258-720Z"/></svg>
            @endif
        </div>

        {{-- info --}}
        <div class="flex flex-col">
            <nama class="text-xs text-gray">{{ $nama }}</nama>
            <saldo class="text-xl font-semi-bold">Rp {{ number_format(12345000, 0, ',', '.') }}</saldo>
        </div>
    </div>

    {{-- > --}}
    <div class="text-xl text-gray">></div>
</div>