<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Demo',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'profile_photo' => null,
                'nama_usaha' => 'Demo Corp',
                'nomor_handphone' => '08123456789',
                'tipe_usaha' => 'Sepatu',
                'npwp' => '1234567890',
                'provinsi' => 'DIY',
                'kabupaten_kota' => 'Yogyakarta',
                'kecamatan' => 'Umbulharjo',
                'kode_pos' => '55161',
                'desa' => 'Karangasem',
                'dusun' => 'Nangka Kuning',
                'rt_rw' => '20/87',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@example.com',
                'password' => Hash::make('userpass456'),
                'profile_photo' => null,
                'nama_usaha' => null,
                'nomor_handphone' => null,
                'tipe_usaha' => null,
                'npwp' => null,
                'provinsi' => null,
                'kabupaten_kota' => null,
                'kecamatan' => null,
                'kode_pos' => null,
                'desa' => null,
                'dusun' => null,
                'rt_rw' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
