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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_buku');
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->integer('tahun');
            $table->integer('stok');
            $table->string('kategori');
            $table->string('lokasi_rak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
