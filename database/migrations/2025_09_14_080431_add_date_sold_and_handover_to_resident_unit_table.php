<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('unit_residents', function (Blueprint $table) {
            $table->date('date_sold')->nullable()->comment('Tanggal penjualan properti oleh owner');
            $table->date('date_handover')->nullable()->comment('Tanggal serah terima unit dari developer/pemilik lama');
        });
    }

    public function down()
    {
        Schema::table('unit_residents', function (Blueprint $table) {
            $table->dropColumn(['date_sold', 'date_handover']);
        });
    }
};