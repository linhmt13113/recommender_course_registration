<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('admin_id')->unique(); // Mã admin tự tạo
            $table->string('admin_name');
            $table->string('email')->unique();
            $table->string('password'); // Lưu mật khẩu đã băm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
