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
        Schema::create('semester_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semester_id');
            $table->string('course_id');
            $table->timestamps();

            // Thiết lập khóa ngoại:
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');

            // Thêm unique constraint để tránh ghi đè môn học trùng cho cùng 1 học kỳ:
            $table->unique(['semester_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_courses');
    }
};
