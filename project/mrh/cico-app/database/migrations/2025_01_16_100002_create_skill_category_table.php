<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skill_category', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->integer('display_order')->default(0);

            $table->boolean('is_featured')->default(false);
            $table->string('text_color')->nullable();
            $table->string('bg_color')->nullable();

            $table->string('description', 500)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_category');
    }
};
