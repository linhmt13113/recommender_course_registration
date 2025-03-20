<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // ID tự động
            // Nếu bạn muốn sử dụng mã thời khóa biểu tự tạo, thêm cột dưới đây:
            $table->string('schedule_id')->unique()->nullable();
            $table->unsignedBigInteger('course_id');
            // day_of_week: 1 - Thứ 2, 2 - Thứ 3, ...
            $table->tinyInteger('day_of_week');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
