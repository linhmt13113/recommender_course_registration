<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id(); // ID tự động
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');

            // Nếu dùng composite key:
            // $table->primary(['student_id', 'schedule_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_schedules');
    }
}
