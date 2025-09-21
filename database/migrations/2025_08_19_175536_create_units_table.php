<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tower_id')->constrained()->onDelete('cascade');
            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_type_id')->constrained()->onDelete('cascade');
            $table->string('unit_code', 20)->unique();
            $table->enum('unit_status', ['Vacant', 'Unsold', 'Owner Stay', 'Rented'])->default('Unsold');
            $table->date('date_sold')->nullable();
            $table->date('date_handover')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
};
