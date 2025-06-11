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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('tanggal');
            $table->enum('jenis', ['penjualan', 'pembelian', 'tagihan']);
            $table->foreignId('kontak_id')->constrained('contacts', 'id')->onDelete('cascade');
            $table->foreignId('saldo_id')->constrained('saldos', 'id')->onDelete('cascade');
            $table->decimal('total', 15, 2);
            $table->enum('pembayaran', ['tunai', 'bank'])->nullable();
            $table->enum('status', ['lunas', 'diproses', 'jatuh tempo'])->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
