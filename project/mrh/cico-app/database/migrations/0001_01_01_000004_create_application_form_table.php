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
        Schema::create('application_form', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->Integer('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->double('total_hours');
            $table->string('leave_reason');
            $table->boolean('verify_status')->default(false);
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
        Schema::dropIfExists('application_form');
    }
};
