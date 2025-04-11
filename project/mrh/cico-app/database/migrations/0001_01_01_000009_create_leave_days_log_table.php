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
        Schema::create('leave_days_log', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->double('days_off_in_advance')->default(0.0); //phép có thể ứng
            $table->double('days_off')->default(0.0); //ngay nghi phep duoc them moi thang

            ///CỘT C
            $table->double('award_days_off')->default(0.0); //ngay nghi duoc cong them theo nam 5/10/15/...

            ///CỘT A
            $table->double('days_off_to_june')->default(0.0); //ngay nghi den het thang 5

            ///CỘT N
            $table->double('compensatory_day_off')->default(0.0); //ngày nghỉ bù

            ///CỘT B
            $table->double('carried_days_off')->default(0.0); // số ngày chuyển phép
            $table->double('days_off_to_used')->default(0.0); // số ngày phép đã dùng
            $table->double('days_off_in_advance_to_used')->default(0.0); // số ngày phép đã ứng

            ///CỘT E
            $table->double('pl_to_used_m')->default(0.0); // số ngày phép đã dùng trong tháng

            ///CỘT F
            $table->double('plan_pl_to_used_m')->default(0.0); // số ngày nghỉ phép có kế hoạch đã dùng trong tháng

            ///CỘT G
            $table->double('pl_in_advance_to_used_m')->default(0.0); // số ngày phép đã dùng trong tháng

            ///CỘT H
            $table->double('un_pl_to_used_m')->default(0.0); // số ngày nghỉ không phép đã dùng trong tháng

            ///CỘT I
            $table->double('sl_to_used_m')->default(0.0); // nghỉ hưởng lương đã dùng trong tháng

            ///CỘT J
            $table->double('compensatory_day_to_used_m')->default(0.0); // nghỉ bù đã dùng trong tháng

            ///CỘT K
            $table->double('all_pl_available_m')->default(0.0); // phép hưởng tính tới cuối tháng

            ///CỘT L
            $table->double('all_pl_to_used_m')->default(0.0); // phép đã nghỉ tính tới cuối tháng

            ///CỘT M
            $table->double('all_pl_remain_to_use_m')->default(0.0); // phép còn lại tính tới cuối tháng

            $table->date('date')->default(null);
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
        Schema::dropIfExists('leave_days_log');
    }
};
