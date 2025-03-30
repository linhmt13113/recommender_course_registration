<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentPreference extends Model
{
    //
    use HasFactory;

    protected $table = 'student_preferences';

    protected $fillable = [
        'student_id',
        'preferences',
    ];
}
