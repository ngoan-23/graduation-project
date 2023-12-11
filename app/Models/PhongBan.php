<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;

    protected $table = 'phongban'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = [
        'id',
        'name',
    ];

    public function congvan()
    {
        return $this->belongsToMany(CongVan::class, 'congvan_phongban', 'phongban_id', 'congvan_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_phongban_chucvu', 'phongban_id', 'user_id');
    }
}
