<?php

use App\Models\Author;
use App\Models\Category;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->nullable()->constrained();
            $table->foreignIdFor(Author::class)->nullable()->constrained();

            $table->string('title')->unique();
            $table->text('excerpt')->nullable();
            $table->string('img_thumbnail')->nullable();
            $table->string('img_cover')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_trending')->nullable()->default(false);
            $table->unsignedInteger('view_count')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
