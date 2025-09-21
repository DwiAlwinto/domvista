<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('logbook_entries', function (Blueprint $table) {
            $table->timestamp('time_done')->nullable()->after('result');
            $table->foreignId('user_done')->nullable()->after('time_done')
                  ->constrained('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('logbook_entries', function (Blueprint $table) {
            $table->dropForeign(['user_done']);
            $table->dropColumn(['time_done', 'user_done']);
        });
    }
};