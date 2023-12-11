<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    use HasFactory;
    protected $table = 'chucvu';

    public function users()
	{
		return $this->belongsToMany(User::class, 'user_phongban_chucvu', 'chucvu_id', 'user_id');
	}
    
}
