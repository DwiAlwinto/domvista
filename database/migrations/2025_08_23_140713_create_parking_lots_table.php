<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_area_id')->constrained()->onDelete('cascade');
            $table->string('lot_number', 10);
            $table->string('lot_type', 20); // Parking 1, Parking 2, Parking 3
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->unique(['parking_area_id', 'lot_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_lots');
    }
};