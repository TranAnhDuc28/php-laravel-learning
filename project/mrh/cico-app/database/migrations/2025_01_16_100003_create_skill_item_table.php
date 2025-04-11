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
        Schema::create('skill_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->integer('display_order')->default(0);

            $table->boolean('is_featured')->default(false);
            $table->string('text_color')->nullable();
            $table->string('bg_color')->nullable();

            $table->string('description', 500)->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('skill_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_item');
    }
};
