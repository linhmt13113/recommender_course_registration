<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicStaff extends Model
{
    //

    use HasFactory;

    protected $table = 'academic_staff';

    protected $primaryKey = 'staff_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'staff_id',
        'staff_name',
        'email',
        'password'
    ];
}
