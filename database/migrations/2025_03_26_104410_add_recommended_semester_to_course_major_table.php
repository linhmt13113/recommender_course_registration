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
        Schema::table('course_major', function (Blueprint $table) {
            //
            $table->string('recommended_semester')->nullable()->after('is_elective');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_major', function (Blueprint $table) {
            //
            $table->dropColumn('recommended_semester');
        });
    }
};
