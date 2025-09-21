<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('unit_parking_lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('parking_lot_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['unit_id', 'parking_lot_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_parking_lots');
    }
};
