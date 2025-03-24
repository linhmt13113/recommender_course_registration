<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Chạy migration để tạo bảng students.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id')->primary(); // Đánh dấu là khóa chính
            $table->string('student_name');
            $table->string('major_id');
            $table->string('password');
            $table->timestamps();

            // Sửa lại khóa ngoại liên kết đến majors, tham chiếu đến cột 'major_id' (không còn là 'id')
            $table->foreign('major_id')->references('major_id')->on('majors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Hủy migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

