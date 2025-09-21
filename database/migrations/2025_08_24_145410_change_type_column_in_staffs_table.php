<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('staffs', function (Blueprint $table) {
            // Ganti ENUM menjadi VARCHAR(50)
            $table->string('type', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('staffs', function (Blueprint $table) {
            // Kembalikan ke ENUM jika perlu rollback
            $table->enum('type', ['Driver', 'Maid'])->change();
        });
    }
};