<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('lecturer_courses', function (Blueprint $table) {
            $table->id(); // ID tự động
            $table->string('lecturer_id');
            $table->string('course_id');
            $table->timestamps();

            $table->foreign('lecturer_id')
                  ->references('lecturer_id')->on('lecturers')
                  ->onDelete('cascade');
            $table->foreign('course_id')
                  ->references('course_id')->on('courses')
                  ->onDelete('cascade');
            // Nếu dùng composite key:
            // $table->primary(['lecturer_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecturer_courses');
    }
}
