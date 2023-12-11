<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoQuanBanHanhController;
use App\Http\Controllers\HinhThucVanBanController;
use App\Http\Controllers\LinhVucController;
use App\Http\Controllers\LoaiVanBanController;
use App\Http\Controllers\LoaiHinhCongVanController;
use App\Http\Controllers\CongVanController;
use App\Http\Controllers\SlideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class, 'trangchu']);
Route::get('dangnhap', [PagesController::class, 'getDangnhap']);
Route::post('dangnhap', [PagesController::class, 'postDangnhap']);
Route::get('dangxuat', [PagesController::class, 'getDangxuat']);

Route::get('/thongtinnguoidung/{id}', [PagesController::class, 'showProfile'])->name('thongtinnguoidung');
Route::post('/thongtinnguoidung/{id}', [PagesController::class, 'editInfo']);

Route::get('/password', [UserController::class, 'updatePassword'])->name('user.update.password');
Route::get('/info', [UserController::class, 'saveUpdatePassword']);

//tìm kiếm
Route::get('timkiem', [PagesController::class, 'getTimkiem']);

//giới thiệu và liên hệ
Route::get('gioithieu', [PagesController::class, 'getGioithieu']);
Route::get('lienhe', [PagesController::class, 'getLienHe']);

//chi tiết công văn
Route::get('chitiet/{id}', [PagesController::class, 'getChiTiet']);

//route login and logout
Route::get('admin', [UserController::class, 'getDangnhapAdmin']);
Route::get('admin/dangnhap', [UserController::class, 'getDangnhapAdmin']);
Route::post('admin/dangnhap', [UserController::class, 'postDangnhapAdmin']);

Route::get('admin/dangxuat', [UserController::class, 'getDangxuat']);

//route admin
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
	Route::group(['prefix' => 'coquanbanhanh'], function () {
		Route::get('danhsach', [CoQuanBanHanhController::class, 'getDanhSach']);

		Route::get('sua/{id}', [CoQuanBanHanhController::class, 'getSua']);
		Route::post('sua/{id}', [CoQuanBanHanhController::class, 'postSua']);

		Route::get('them', [CoQuanBanHanhController::class, 'getThem']);
		Route::post('them', [CoQuanBanHanhController::class, 'postThem']);

		Route::get('xoa/{id}', [CoQuanBanHanhController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'hinhthucvanban'], function () {
		Route::get('danhsach', [HinhThucVanBanController::class, 'getDanhSach']);

		Route::get('sua/{id}', [HinhThucVanBanController::class, 'getSua']);
		Route::post('sua/{id}', [HinhThucVanBanController::class, 'postSua']);

		Route::get('them', [HinhThucVanBanController::class, 'getThem']);
		Route::post('them', [HinhThucVanBanController::class, 'postThem']);

		Route::get('xoa/{id}', [HinhThucVanBanController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'linhvuc'], function () {
		Route::get('danhsach', [LinhVucController::class, 'getDanhSach']);

		Route::get('sua/{id}', [LinhVucController::class, 'getSua']);
		Route::post('sua/{id}', [LinhVucController::class, 'postSua']);

		Route::get('them', [LinhVucController::class, 'getThem']);
		Route::post('them', [LinhVucController::class, 'postThem']);

		Route::get('xoa/{id}', [LinhVucController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'loaivanban'], function () {
		Route::get('danhsach', [LoaiVanBanController::class, 'getDanhSach']);

		Route::get('sua/{id}', [LoaiVanBanController::class, 'getSua']);
		Route::post('sua/{id}', [LoaiVanBanController::class, 'postSua']);

		Route::get('them', [LoaiVanBanController::class, 'getThem']);
		Route::post('them', [LoaiVanBanController::class, 'postThem']);

		Route::get('xoa/{id}', [LoaiVanBanController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'loaihinhcongvan'], function () {
		Route::get('danhsach', [LoaiHinhCongVanController::class, 'getDanhSach']);

		Route::get('sua/{id}', [LoaiHinhCongVanController::class, 'getSua']);
		Route::post('sua/{id}', [LoaiHinhCongVanController::class, 'postSua']);

		Route::get('them', [LoaiHinhCongVanController::class, 'getThem']);
		Route::post('them', [LoaiHinhCongVanController::class, 'postThem']);

		Route::get('xoa/{id}', [LoaiHinhCongVanController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'congvan'], function () {
		Route::get('danhsach', [CongVanController::class, 'getDanhSach']);
		Route::get('thongke', [CongVanController::class, 'getThongKe']);

		Route::get('sua/{id}', [CongVanController::class, 'getSua']);
		Route::post('sua/{id}', [CongVanController::class, 'postSua']);

		Route::get('them', [CongVanController::class, 'getThem']);
		Route::post('them', [CongVanController::class, 'postThem']);

		Route::get('xoa/{id}', [CongVanController::class, 'getXoa']);

		Route::get('phe-duyet/{id}', [CongVanController::class, 'postPheDuyet'])->name('phe-duyet-cong-van');
		Route::get('khong-phe-duyet/{id}', [CongVanController::class, 'postKhongPheDuyet'])->name('khong-phe-duyet-cong-van');
	});

	Route::group(['prefix' => 'user'], function () {
		Route::get('danhsach', [UserController::class, 'getDanhSach']);

		Route::get('sua/{id}', [UserController::class, 'getSua']);
		Route::post('sua/{id}', [UserController::class, 'postSua']);

		Route::get('them', [UserController::class, 'getThem']);
		Route::post('them', [UserController::class, 'postThem']);

		Route::get('xoa/{id}', [UserController::class, 'getXoa']);
	});

	Route::group(['prefix' => 'slide'], function () {
		Route::get('danhsach', [SlideController::class, 'getDanhSach']);

		Route::get('sua/{id}', [SlideController::class, 'getSua']);
		Route::post('sua/{id}', [SlideController::class, 'postSua']);

		Route::get('them', [SlideController::class, 'getThem']);
		Route::post('them', [SlideController::class, 'postThem']);

		Route::get('xoa/{id}', [SlideController::class, 'getXoa']);
	});
});

Route::get('trangchu', [PagesController::class, 'trangchu']);

Route::get('coquanbanhanh/{id}/{TenKhongDau}.html', [PagesController::class, 'coquanbanhanh']);

Route::get('hinhthucvanban/{id}/{TenKhongDau}.html', [PagesController::class, 'hinhthucvanban']);

Route::get('linhvuc/{id}/{TenKhongDau}.html', [PagesController::class, 'linhvuc']);

Route::get('loaivanban/{id}/{TenKhongDau}.html', [PagesController::class, 'loaivanban']);

Route::get('loaihinhcongvan/{id}/{TenKhongDau}.html', [PagesController::class, 'loaihinhcongvan']);

Route::get('/download/{id}', [PagesController::class, 'downloadScannedFile'])->name('download.scanned_file');
