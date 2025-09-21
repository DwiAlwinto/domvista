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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('wo_no', 50)->unique();
            $table->foreignId('tower_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('unit_id')->nullable()->constrained()->onDelete('set null');
            $table->date('date_request_wo');
            $table->string('tenant_name', 100);
            $table->text('work_description');
            $table->text('details')->nullable();
            $table->date('schedule_date');
            $table->time('time_schedule')->nullable();
            $table->enum('status', ['On Progress', 'Proses', 'Cancel', 'Reschedule', 'Done'])->default('On Progress');
            $table->boolean('present')->default(false);
            $table->text('cancel_reason')->nullable();
            $table->foreignId('canceled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('engineer_name', 100)->nullable();
            $table->text('engineer_notes')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('wo_done_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('wo_done_at')->nullable();
            $table->text('deskripsi_wo_done')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
