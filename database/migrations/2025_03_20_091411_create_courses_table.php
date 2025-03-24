<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {

            $table->string('course_id')->primary(); // Mã môn học tự tạo
            $table->string('course_name');
            $table->text('course_description')->nullable();
            $table->string('lecturer_id')->nullable(); // Có thể để null nếu chưa gán giảng viên
            $table->timestamps();

            // Khóa ngoại liên kết đến bảng lecturers (sẽ tạo sau)
            $table->foreign('lecturer_id')->references('lecturer_id')->on('lecturers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
