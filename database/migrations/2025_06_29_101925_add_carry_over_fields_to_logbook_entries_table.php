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
        Schema::table('logbook_entries', function (Blueprint $table) {
            $table->date('original_date')->nullable()->after('status');
            $table->foreignId('carried_from')->nullable()->constrained('logbook_entries')->after('original_date');
            $table->boolean('is_carried_over')->default(false)->after('carried_from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logbook_entries', function (Blueprint $table) {
            //
        });
    }
};
