<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->string('status')->default('Draft')->after('logbook_number');
        });
    }

    public function down()
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
