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
        Schema::create('days_off_by_schedule', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date('start_date');
            $table->date('end_date');
            $table->Integer('leave_type');
            $table->timestampTz('created_at')->nullable();
            $table->timestampTz('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_off_by_schedule');
    }
};
