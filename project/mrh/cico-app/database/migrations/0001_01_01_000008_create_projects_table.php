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
//        Schema::dropIfExists('teams');
        Schema::create('projects', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('project_name')->unique()->nullable();
            $table->unsignedBigInteger('user_id');

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
//        Schema::disableForeignKeyConstraints();
//        Schema::dropIfExists('team_users');
        Schema::dropIfExists('projects');
//        Schema::enableForeignKeyConstraints();
    }
};
