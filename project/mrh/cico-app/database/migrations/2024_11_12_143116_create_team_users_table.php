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
        Schema::create('team_users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('user_id')->unique();
            $table->tinyInteger('role')->nullable(); //1: manager, 2:member
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_users');
    }
};
