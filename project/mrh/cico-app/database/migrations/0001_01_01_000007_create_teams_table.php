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
        Schema::create('teams', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('team_name')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::disableForeignKeyConstraints();
//        Schema::dropIfExists('team_users');
        Schema::dropIfExists('teams');
//        Schema::enableForeignKeyConstraints();
    }
};
