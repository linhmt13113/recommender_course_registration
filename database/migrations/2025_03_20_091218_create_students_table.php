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
            $table->id(); // ID tự tăng hỗ trợ khóa chính
            $table->string('student_id')->unique(); // Mã sinh viên tự tạo
            $table->string('student_name');
            $table->unsignedBigInteger('major_id');
            $table->string('password'); // Lưu mật khẩu đã băm
            $table->timestamps();

            // Khóa ngoại liên kết đến bảng majors (sẽ tạo sau)
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
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
