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
        Schema::create('logbook_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logbook_id');
            $table->foreign('logbook_id')->references('id')->on('logbooks')->onDelete('cascade');

            // Kolom utama
            $table->string('mod')->nullable();
            $table->string('chief_tr')->nullable();
            $table->string('chief_enginer')->nullable(); // typo: enginer
            $table->string('chief_security')->nullable();
            $table->string('chief_hk')->nullable();

            //conierge 
            $table->string('c_morning')->nullable();
            $table->string('c_afternoon')->nullable();
            $table->string('c_evening')->nullable();

            // Health Club (HC)
            $table->string('hc_morning')->nullable();
            $table->string('hc_afternoon')->nullable();

            // Engineer
            $table->string('enginer_morning')->nullable();
            $table->string('enginer_afternoon')->nullable();
            $table->string('enginer_night')->nullable();

            // Housekeeping (HK)
            $table->string('hk_morning')->nullable();
            $table->string('hk_afternoon')->nullable();
            $table->string('hk_night')->nullable();

            // Security
            $table->string('sec_morning')->nullable();
            $table->string('sec_afternoon')->nullable();
            $table->string('sec_night')->nullable();

            // HSE
            $table->string('hse_morning')->nullable();
            $table->string('hse_afternoon')->nullable();
            $table->string('hse_night')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_staff');
    }
};