<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AcademicStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('academic_staff')->insert([
            'staff_id'   => 'STAFF01',
            'staff_name' => 'Academic Staff 1',
            'email'      => 'staff@example.com',
            'password'   => Hash::make('staff123')
        ]);
    }
}
