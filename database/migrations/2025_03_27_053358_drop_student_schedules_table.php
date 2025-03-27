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
        Schema::dropIfExists('student_schedules');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_schedules', function (Blueprint $table) {
            //
            $table->id();
            // Các cột khác nếu cần
            $table->timestamps();
        });
    }
};
