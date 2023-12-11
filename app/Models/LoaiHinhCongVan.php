<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiHinhCongVan extends Model {
	//
	protected $table = 'loaihinhcongvan';
	public $timestamps = false;
	public function congvan() {
		return $this->hasMany('App\Models\CongVan', 'idloaihinhcongvan', 'id');
	}
}
