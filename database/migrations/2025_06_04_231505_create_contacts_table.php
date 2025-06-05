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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontak');
            $table->string('nomor_handphone')->nullable();
            $table->string('image_kontak')->nullable();
            $table->string('email_kontak')->nullable();
            $table->text('alamat_kontak')->nullable();
            $table->unsignedInteger('jumlah_transaksi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
