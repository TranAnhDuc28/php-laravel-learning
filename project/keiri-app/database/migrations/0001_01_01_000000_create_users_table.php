<?php

use App\Enums\UserRole;
use App\Enums\UserStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /* Info at work. */
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->string('job_position')->nullable();
//            $table->decimal('monthly_cost')->nullable();

            /* General information. */
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();

            /* Contact information. */
            $table->date('phone_number')->nullable();
            $table->string('email')->unique();

            /* Other. */
            $table->string('address')->nullable();
            $table->string('password');
            $table->integer('role')->default(UserRole::Employee);
            $table->date('join_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('status')->default(UserStatus::ACTIVE);
            $table->text('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

//        Schema::create('sessions', function (Blueprint $table) {
//            $table->string('id')->primary();
//            $table->foreignId('user_id')->nullable()->index();
//            $table->string('ip_address', 45)->nullable();
//            $table->text('user_agent')->nullable();
//            $table->longText('payload');
//            $table->integer('last_activity')->index();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
//        Schema::dropIfExists('sessions');
    }
};
