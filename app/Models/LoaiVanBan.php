<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiVanBan extends Model {
	//
	protected $table = 'loaivanban';
	public $timestamps = false;
	public function congvan() {
		return $this->hasMany('App\Models\CongVan', 'idloaivanban', 'id');
	}
}
