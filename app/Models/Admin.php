<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Chỉ định rằng khóa chính của bảng là 'admin_id' thay vì 'id'
    protected $primaryKey = 'admin_id';

    // Nếu khóa chính là chuỗi thay vì số (ví dụ: UUID), bạn cần thêm dòng này
    public $incrementing = false;

    // Nếu kiểu dữ liệu của khóa chính là chuỗi (ví dụ UUID), bạn cần chỉ định rõ:
    protected $keyType = 'string';

    protected $fillable = [
        'admin_id',      // Mã admin tự tạo
        'admin_name',
        'email',
        'password'
    ];
}
