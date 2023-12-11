<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CongVan extends Model {
	//
	protected $table = 'congvan';
	public $timestamps = false;
	//Tạo liên kết cho bảng công văn

	protected $fillable = [
        'is_active',
    ];
	public function coquanbanhanh() {
		return $this->belongsTo('App\Models\CoQuanBanHanh', 'idcoquanbanhanh', 'id');
	}

	public function hinhthucvanban() {
		return $this->belongsTo('App\Models\HinhThucVanBan', 'idhinhthucvanban', 'id');
	}

	public function linhvuc() {
		return $this->belongsTo('App\Models\LinhVuc', 'idlinhvuc', 'id');
	}

	public function loaivanban() {
		return $this->belongsTo('App\Models\LoaiVanBan', 'idloaivanban', 'id');
	}

	public function loaihinhcongvan() {
		return $this->belongsTo('App\Models\LoaiHinhCongVan', 'idloaihinhcongvan', 'id');
	}

	public function phongban()
	{
		return $this->belongsToMany(PhongBan::class, 'congvan_phongban', 'congvan_id', 'phongban_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_congvan', 'congvan_id', 'nguoiky_id');
	}
}
