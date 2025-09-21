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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku', 50);
            $table->string('nisn', 20);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_harus_kembali');
            $table->date('tanggal_kembali')->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->enum('status_kembali', ['Dipinjam', 'Dikembalikan', 'Hilang', 'Terlambat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
