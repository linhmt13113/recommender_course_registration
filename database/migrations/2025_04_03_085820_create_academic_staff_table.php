<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_staff', function (Blueprint $table) {
            $table->string('staff_id')->unique(); // Mã nhân viên giáo vụ tự tạo
            $table->string('staff_name');
            $table->string('email')->unique();
            $table->string('password'); // Lưu mật khẩu đã băm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_staff');
    }
};
