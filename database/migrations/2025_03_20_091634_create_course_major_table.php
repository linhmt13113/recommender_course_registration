<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseMajorTable extends Migration
{
    public function up()
    {
        Schema::create('course_major', function (Blueprint $table) {
            $table->id(); // ID tự động để dễ quản lý và mở rộng
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('major_id');
            $table->boolean('is_elective'); // true: môn tự chọn, false: bắt buộc
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');

            // Nếu không cần id tự động, bạn có thể sử dụng composite key:
            // $table->primary(['course_id', 'major_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_major');
    }
}
