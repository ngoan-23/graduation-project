<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HinhThucVanBan extends Model {
	//
	protected $table = 'hinhthucvanban';
	public $timestamps = false;
	public function congvan() {
		return $this->hasMany('App\Models\CongVan', 'idhinhthucvanban', 'id');
	}
}
