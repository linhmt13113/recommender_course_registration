<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',      // Mã admin tự tạo
        'admin_name',
        'email',
        'password'
    ];
}
