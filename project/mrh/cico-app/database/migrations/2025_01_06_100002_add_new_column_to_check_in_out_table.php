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
        Schema::table('check_in_out', function (Blueprint $table) {
            $table->boolean('auto_add')->default(false)->before('status');
            $table->integer('leave_type')->default(0)->before('auto_add');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('check_in_out', function (Blueprint $table) {
            if (Schema::hasColumn('check_in_out', 'auto_add')) {
                $table->dropColumn('auto_add');
            }
            if (Schema::hasColumn('check_in_out', 'leave_type')) {
                $table->dropColumn('leave_type');
            }
//            $table->dropColumn('auto_add');
//            $table->dropColumn('leave_type');
        });
    }
};
