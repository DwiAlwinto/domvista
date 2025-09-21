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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('judul_buku');
            $table->string('isbn');
            $table->string('penulis');
            $table->string('tahun_terbit');
            $table->integer('jumlah_halaman');
            $table->string('bahasa');
            $table->integer('jumlah');
            $table->string('cover')->nullable();
            $table->text('sinopsis');

            $table->foreignId('penerbit_id')->default(null);
            $table->foreignId('jenis_id')->default(null);
            $table->foreignId('kategori_id')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
