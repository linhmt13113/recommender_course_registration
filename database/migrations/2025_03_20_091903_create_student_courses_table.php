<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id(); // ID tự động để dễ quản lý và mở rộng
            $table->string('student_id');
            $table->string('course_id');
            // status: 0 = chưa hoàn thành, 1 = đã hoàn thành
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');

            // Nếu dùng composite key:
            // $table->primary(['student_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
