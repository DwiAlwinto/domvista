<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parking_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_id')->constrained('parking_lots')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('resident_id')->constrained()->onDelete('cascade');
            $table->dateTime('assigned_at');
            $table->dateTime('released_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['parking_id', 'unit_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_assignments');
    }
};
