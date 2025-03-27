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
        Schema::table('schedules', function (Blueprint $table) {
            //
            if (Schema::hasColumn('schedules', 'schedule_id')) {
                $table->dropColumn('schedule_id');
            }
            // Thêm các cột mới nếu chưa có
            if (!Schema::hasColumn('schedules', 'start_time')) {
                $table->time('start_time')->after('day_of_week');
            }
            if (!Schema::hasColumn('schedules', 'end_time')) {
                $table->time('end_time')->after('start_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
            if (Schema::hasColumn('schedules', 'start_time')) {
                $table->dropColumn('start_time');
            }
            if (Schema::hasColumn('schedules', 'end_time')) {
                $table->dropColumn('end_time');
            }
            // Nếu muốn phục hồi lại cột schedule_id, cần định nghĩa lại kiểu cột
            $table->string('schedule_id')->unique()->nullable()->after('id');
        });
    }
};
