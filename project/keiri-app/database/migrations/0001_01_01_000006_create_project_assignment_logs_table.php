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
        Schema::create('project_assignment_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('project_id');
            $table->foreignId('project_assignment_id')->constrained();
            $table->date('project_join_date')->nullable();
            $table->date('project_exit_date')->nullable();
            $table->unsignedInteger('effort_percentage')->default(100);
            $table->integer('worked_days')->default(0);
            $table->integer('status')->default(1);
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_assignment_logs');
    }
};
