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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_harus_kembali');
            $table->unsignedBigInteger('id_buku')->nullable();
            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->integer('total_pinjam');
            $table->unsignedBigInteger('id_anggota');
            $table->foreign('id_anggota')->references('id')->on('anggota')->onDelete('cascade');
            $table->unsignedBigInteger('id_petugas');
            $table->foreign('id_petugas')->references('id')->on('petugas')->onDelete('cascade');

            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
