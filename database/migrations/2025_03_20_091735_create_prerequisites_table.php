<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrerequisitesTable extends Migration
{
    public function up()
    {
        Schema::create('prerequisites', function (Blueprint $table) {
            $table->id(); // ID tự động
            $table->string('course_id'); // Môn học hiện tại
            $table->string('prerequisite_course_id'); // Môn học yêu cầu trước
            $table->string('major_id'); // Chuyên ngành áp dụng
            $table->enum('prerequisite_type', ['Required', 'Optional', 'Previous']);
            $table->timestamps();

            $table->foreign('course_id')
                  ->references('course_id')->on('courses')
                  ->onDelete('cascade');
            $table->foreign('prerequisite_course_id')
                  ->references('course_id')->on('courses')
                  ->onDelete('cascade');
            $table->foreign('major_id')
                  ->references('major_id')->on('majors')
                  ->onDelete('cascade');

            // Nếu sử dụng composite key thay vì id tự động, hãy xóa dòng $table->id();
            // $table->primary(['course_id', 'prerequisite_course_id', 'major_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('prerequisites');
    }
}
