<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('identity_number')->nullable(); // KTP/Passport
            $table->string('citizenship')->default('Indonesia');
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_company')->nullable();
            $table->boolean('is_owner')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
};