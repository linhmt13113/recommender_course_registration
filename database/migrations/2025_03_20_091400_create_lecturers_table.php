<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {

            $table->string('lecturer_id')->primary(); // Mã giảng viên tự tạo
            $table->string('lecturer_name');
            $table->string('password'); // Lưu mật khẩu đã băm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecturers');
    }
}
