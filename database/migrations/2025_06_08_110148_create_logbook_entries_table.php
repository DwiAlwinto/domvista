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
        Schema::create('logbook_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logbook_id')->constrained()->onDelete('cascade');
            $table->string('tower');
            $table->string('unit');
            $table->text('description');
            $table->enum('status', ['On Progress', 'Set Schedule', 'Reschedule', 'Done', 'Cancel'])->default('On Progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_entries');
    }
};
