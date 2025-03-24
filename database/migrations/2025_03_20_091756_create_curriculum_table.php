<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumTable extends Migration
{
    public function up()
    {
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id(); // ID tự động
            $table->string('curriculum_id')->unique(); // Mã chương trình học tự tạo
            $table->string('major_id');
            $table->integer('semester'); // Học kỳ: 1, 2, 3, ...
            $table->string('course_id');
            $table->boolean('is_mandatory'); // true: bắt buộc, false: tự chọn
            $table->integer('semester_order'); // Thứ tự của môn học trong học kỳ
            $table->timestamps();

            $table->foreign('major_id')->references('major_id')->on('majors')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('curriculum');
    }
}
