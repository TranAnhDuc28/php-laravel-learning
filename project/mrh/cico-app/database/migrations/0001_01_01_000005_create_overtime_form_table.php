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
        Schema::create('overtime_form', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->double('over_time')->nullable()->default(0);
            $table->double('official_working_hours')->nullable()->default(0);
            $table->double('paid_leave')->nullable()->default(0);
            $table->double('total_time');
            $table->boolean('verify_status');
            $table->bigInteger('approved_by')->nullable();
            $table->bigInteger('created_by');
            $table->timestampTz('created_at');
            $table->bigInteger('updated_by')->nullable();
            $table->timestampTz('updated_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_form');
    }
};
