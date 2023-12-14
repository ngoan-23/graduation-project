<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use App\Models\CongVan;
use App\Models\CoQuanBanHanh;
use App\Models\HinhThucVanBan;
use App\Models\LinhVuc;
use App\Models\LoaiHinhCongVan;
use App\Models\LoaiVanBan;
use App\Models\PhongBan;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller {
	public function __construct() {
		$congvan = CongVan::all();
		$coquanbanhanh = CoQuanBanHanh::all();
		$hinhthucvanban = HinhThucVanBan::all();
		$linhvuc = LinhVuc::all();
		$loaivanban = LoaiVanBan::all();
		$loaihinhcongvan = LoaiHinhCongVan::all();
		$slide = Slide::all();

		view()->share('congvanviewshare', $congvan);
		view()->share('coquanbanhanhviewshare', $coquanbanhanh);
		view()->share('hinhthucvanbanviewshare', $hinhthucvanban);
		view()->share('linhvucviewshare', $linhvuc);
		view()->share('loaivanbanviewshare', $loaivanban);
		view()->share('loaihinhcongvanviewshare', $loaihinhcongvan);
		view()->share('slideviewshare', $slide);

	}
	public function getDangnhap() {
		return view('login');
	}

	public function postDangnhap(Request $request) {
		$this->validate($request,
			[
				'email' => 'required',
				'password' => 'required|min:6|max:20',
			],
			[
				'email.required' => 'Bạn phải nhập email',
				'password.required' => 'Bạn phải nhập mật khẩu',
				'password.min' => 'Bạn phải nhập mật khẩu lớn hơn, từ 6 đến 20 ký tự',
				'password.max' => 'Bạn phải nhập mật khẩu nhỏ hơn, từ 6 đến 20 ký tự',
			]

		);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			return redirect('trangchu');
		} else {
			return redirect('dangnhap')->with('loi', 'Đăng nhập không thành công, mời nhập lại!');
		}
	}

	public function getDangxuat() {
		Auth::logout();
		return redirect('dangnhap')->with('thongbao', 'Đăng xuất thành công');
	}

	public function trangchu() {
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvantrangchu = $congvantrangchu->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvantrangchu = CongVan::orderBy('ngayky', 'desc')->paginate(10);
			}
		} 
		else {
			$congvantrangchu = CongVan::where('is_active' , 1)->where('congkhai' , 1)->orderBy('ngayky', 'desc')->paginate(10);
		}
		return view('pages.trangchu', ['congvantrangchu' => $congvantrangchu]);
	}

	public function coquanbanhanh($id) {
		$coquanbanhanh = CoQuanBanHanh::find($id);
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id,  $id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvan = $congvantrangchu->where('idcoquanbanhanh' , $id)->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvan = CongVan::where('idcoquanbanhanh' , $id)->orderBy('ngayky', 'desc')->paginate(10);
			}
		} 
		else {
			$congvan = CongVan::where('idcoquanbanhanh' , $id)->orderBy('ngayky', 'desc')->paginate(10);
		}
		// if (Auth::user()) {
		// 	$congvan = CongVan::where('idcoquanbanhanh', $id)->orderBy('ngayky', 'desc')->paginate(10);
		// } else {
		// 	$congvan = CongVan::where('idcoquanbanhanh', $id)->where('idloaihinhcongvan', '<>', 2)->orderBy('ngayky', 'desc')->paginate(10);
		// }

		return view('coquanbanhanh.coquanbanhanh', ['coquanbanhanh' => $coquanbanhanh, 'congvan' => $congvan]);
	}

	public function hinhthucvanban($id) {
		$hinhthucvanban = HinhThucVanBan::find($id);
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id,  $id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvan = $congvantrangchu->where('idhinhthucvanban' , $id)->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvan = CongVan::where('idhinhthucvanban' , $id)->orderBy('ngayky', 'desc')->paginate(10);
			}
		} 
		else {
			$congvan = CongVan::where('idhinhthucvanban' , $id)->orderBy('ngayky', 'desc')->paginate(10);
		}
		// if (Auth::user()) {
		// 	$congvan = CongVan::where('idhinhthucvanban', $id)->orderBy('ngayky', 'desc')->paginate(10);
		// } else {
		// 	$congvan = CongVan::where('idhinhthucvanban', $id)->where('idloaihinhcongvan', '<>', 2)->orderBy('ngayky', 'desc')->paginate(10);
		// }

		return view('hinhthucvanban.hinhthucvanban', ['hinhthucvanban' => $hinhthucvanban, 'congvan' => $congvan]);
	}

	public function linhvuc($id) {
		$linhvuc = LinhVuc::find($id);
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id,  $id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvan = $congvantrangchu->where('idlinhvuc' , $id)->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvan = CongVan::where('idlinhvuc' , $id)->orderBy('ngayky', 'desc')->paginate(10);
			}
		} 
		else {
			$congvan = CongVan::where('idlinhvuc' , $id)->orderBy('ngayky', 'desc')->paginate(10);
		}
		// if (Auth::user()) {
		// 	$congvan = CongVan::where('idlinhvuc', $id)->orderBy('ngayky', 'desc')->paginate(10);
		// } else {
		// 	$congvan = CongVan::where('idlinhvuc', $id)->where('idloaihinhcongvan', '<>', 2)->orderBy('ngayky', 'desc')->paginate(10);
		// }

		return view('linhvuc.linhvuc', ['linhvuc' => $linhvuc, 'congvan' => $congvan]);
	}

	public function loaivanban($id) {
		$loaivanban = LoaiVanBan::find($id);
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id,  $id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvan = $congvantrangchu->where('idloaivanban' , $id)->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvan = CongVan::where('idloaivanban' , $id)->orderBy('ngayky', 'desc')->paginate(10);
			}
		} 
		else {
			$congvan = CongVan::where('idloaivanban' , $id)->orderBy('ngayky', 'desc')->paginate(10);
		}
		// if (Auth::user()) {
		// 	$congvan = CongVan::where('idloaivanban', $id)->orderBy('ngayky', 'desc')->paginate(10);
		// } else {
		// 	$congvan = CongVan::where('idloaivanban', $id)->where('idloaihinhcongvan', '<>', 2)->orderBy('ngayky', 'desc')->paginate(10);
		// }

		return view('loaivanban.loaivanban', ['loaivanban' => $loaivanban, 'congvan' => $congvan]);
	}

	public function loaihinhcongvan($id) {
		$loaihinhcongvan = LoaiHinhCongVan::find($id);
		if (Auth::user() && Auth::user()->level != 2) {
			$userId = auth()->id();
			$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
				$query->where('users.id', $userId);
			}, '>', 0)->first();

			if($phongBan) {
				$phongBan_id = $phongBan->id;
				$congvantrangchu = CongVan::where(function ($query) use ($phongBan_id,  $id) {
					$query->whereHas('phongban', function ($query) use ($phongBan_id) {
						$query->where('phongban.id', $phongBan_id)
							->where('is_active', 1);
						})
						->orWhere('congkhai', 1)
						->orWhere('idloaihinhcongvan', 4);
				});
				$congvan = $congvantrangchu->where('idloaihinhcongvan' , $id)->where('is_active', '!=' , 3)->orderBy('ngayky', 'desc')->paginate(10);
			} else {
				$congvan = CongVan::where('idloaihinhcongvan' , $id)->orderBy('ngayky', 'desc')->paginate(10);
			}
		}
		else {
			$congvan = CongVan::where('idloaihinhcongvan' , $id)->orderBy('ngayky', 'desc')->paginate(10);
		}
		// if (Auth::user()) {
		// 	$congvan = CongVan::where('idloaihinhcongvan', $id)->orderBy('ngayky', 'desc')->paginate(10);
		// } else {
		// 	return redirect('dangnhap');
		// }

		return view('loaihinhcongvan.loaihinhcongvan', ['loaihinhcongvan' => $loaihinhcongvan, 'congvan' => $congvan]);
	}

	public function getTimKiem(Request $request) {
		$tukhoa = $request->tukhoa;
		if (Auth::user()) {
			$congvan = CongVan::where('sohieu', 'LIKE', '%' . $tukhoa . '%')
				->orwhere('nguoiky', 'LIKE', '%' . $tukhoa . '%')
				->orwhere('trichyeunoidung', 'LIKE', '%' . $tukhoa . '%')
				->orwhere('idloaihinhcongvan', 'LIKE', '%' . $tukhoa . '%')
				->orwhere('nguoiky', 'LIKE', '%' . $tukhoa . '%')
				->orderBy('ngayky', 'desc')
				->paginate(10);
		} else {
			$congvan = CongVan::where('idloaihinhcongvan', '<>', 2)
				->where('sohieu', 'LIKE', '%' . $tukhoa . '%')
				->orwhere('trichyeunoidung', 'LIKE', '%' . $tukhoa . '%')
				->orderBy('ngayky', 'desc')
				->paginate(10);
		}
		return view('pages.timkiem', ['congvan' => $congvan, 'tukhoa' => $tukhoa]);

	}

	function getGioithieu() {
		return view('pages.gioithieu');
	}

	function getLienHe() {
		return view('pages.lienhe');
	}

	function getChitiet($id) {
		$chitietcongvan = CongVan::find($id);
		return view('pages.chitiet', ['chitietcongvan' => $chitietcongvan]);
	}

	public function showProfile($id) {
		$user = User::find($id);
		$dsphongban = PhongBan::all();
		$dschucvu = ChucVu::all();
		return view('pages.user_info', [
			'user' => $user,
			'dsphongban' => $dsphongban,
			'dschucvu' => $dschucvu
		]);
	}

	public function editInfo(Request $request, $id) {
		$user = User::find($id);
		
		$user->name = $request->name;
		if ($request->changePassword) {
			$this->validate($request,
			[
				'password' =>'confirmed|min:6',
			],
			[
				'name.required' => 'Bạn phải nhập tên người dùng',
			]);

			$user->password = bcrypt($request->password);
		}
		$user->save();
		return redirect('/trangchu')->with('thongbao', 'Sửa thành công');
	}

	public function downloadScannedFile($id)
	{
		$cong_van = CongVan::find($id);
		$fileName = $cong_van->tentaptindinhkem;
		$filePath = storage_path('app/public/' . $fileName);

		// Kiểm tra xem tệp có tồn tại không
		if (file_exists($filePath)) {
			// Trả về file cho người dùng
			return response()->download($filePath);
		} else {
			// Nếu không tìm thấy, có thể xử lý lỗi hoặc chuyển hướng người dùng
			return redirect()->back()->with('error', 'File not found');
		}
	}

}
