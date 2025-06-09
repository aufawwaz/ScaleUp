<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('password');
            $table->string('nama_usaha')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->string('tipe_usaha')->nullable();
            $table->string('npwp')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_photo',
                'nama_usaha',
                'nomor_handphone',
                'tipe_usaha',
                'npwp',
                'provinsi',
                'kabupaten_kota',
                'kecamatan',
                'desa',
            ]);
        });
    }
};
