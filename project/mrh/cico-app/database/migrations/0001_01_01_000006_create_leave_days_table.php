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
        Schema::create('leave_days', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->double('days_off_in_advance')->default(0.0); //phép có thể ứng
            $table->double('days_off')->default(0.0); //ngay nghi phep duoc them moi thang
            $table->double('award_days_off')->default(0.0); //ngay nghi duoc cong them theo nam 5/10/15/...
            $table->double('days_off_to_june')->default(0.0); //ngay nghi den het thang 5
            $table->double('compensatory_day_off')->default(0.0); //ngày nghỉ bù
            $table->double('carried_days_off')->default(0.0); // số ngày chuyển phép
            $table->double('days_off_to_used')->default(0.0); // số ngày phép đã dùng
            $table->double('days_off_in_advance_to_used')->default(0.0); // số ngày phép đã ứng
            $table->year('year')->default(null);
            $table->timestampTz('created_at')->nullable();
            $table->timestampTz('updated_at')->nullable();

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
        Schema::dropIfExists('leave_days');
    }
};
