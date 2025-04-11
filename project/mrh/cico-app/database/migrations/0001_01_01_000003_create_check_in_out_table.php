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
        Schema::create('check_in_out', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out')->nullable();
            $table->Integer('in_lack_time')->nullable()->default(0);
            $table->Integer('out_lack_time')->nullable()->default(0);
            $table->double('working_time')->nullable()->default(0); //tong so gio lam viec trong 1 ngay
            $table->double('over_time')->nullable()->default(0); //tong so thoi gian lam viec them gio trong 1 ngay
            $table->double('official_working_hours')->nullable()->default(0); //tong so thoi gian lam viec trong gio lam viec 8 ~ 17h
            $table->double('paid_leave')->nullable()->default(0); //tong so gio nghi phep trong 1 ngay
            $table->double('unpaid_leave')->nullable()->default(0); //tong so gio nghi tru luong trong 1 ngay
            $table->boolean('status')->default(true);
            $table->timestampTz('created_at');
            $table->timestampTz('updated_at');

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
        Schema::dropIfExists('check_in_out');
    }
};
