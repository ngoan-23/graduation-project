<?php

namespace App\Http\Controllers;
use App\Models\CongVan;
use App\Models\CongVanPhongBan;
use App\Models\CoQuanBanHanh;
use App\Models\HinhThucVanBan;
use App\Models\LinhVuc;
use App\Models\LoaiHinhCongVan;
use App\Models\LoaiVanBan;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\User_CongVan;
use App\Models\User_PhongBan_ChucVu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CongVanController extends Controller {
	public function getDanhSach(Request $request) {

		$phongBan = PhongBan::whereHas('users', function ($query) {
			$query->where('users.id', auth()->id());
		}, '>', 0)->first();

		if($phongBan) {
			$phongBan_id = $phongBan->id;
			$dscongvan = CongVan::where(function ($query) use ($phongBan_id) {
				$query->whereHas('phongban', function ($query) use ($phongBan_id) {
					$query->where('phongban.id', $phongBan_id);
					})
					->where('id', '!=', null);
					// ->orWhere('idloaihinhcongvan', 4);
			});
		} else {
			$dscongvan = CongVan::with(['phongban', 'users']);
		}

		$dsphongban = PhongBan::all();
		$dsloaihinhcongvan = LoaiHinhCongVan::all();
		$phongban = User_PhongBan_ChucVu::where('user_id', auth()->user()->id)->first();
		if(!empty($phongban)) {
			$chucvu = $phongban->chucvu_id;
		}
		//Chức năng filter
		if (!empty($request->department)) {
			$dscongvan->whereHas('phongban', function ($query) use ($request) {
				$query->where('phongban.id', $request->department);
			});
		}
		if(!empty($request->dispatch)) {
			$dscongvan->where('idloaihinhcongvan', $request->dispatch);
		}
	
		$dscongvan = $dscongvan->orderBy('id', 'desc')->paginate(8);

		foreach ($dscongvan as $congVan) {
			if (!empty($congVan->phongban[0])) {
				$congVan->tenPhongBan = $congVan->phongban[0]->name;
			}
			if (!empty($congVan->users[0])) {
				$congVan->tenNguoiKy = $congVan->users[0]->name;
			}
		}
		return view('admin.congvan.danhsach', [
			'congvan' => $dscongvan,
			'dsphongban' => $dsphongban,
			'dsloaihinhcongvan' => $dsloaihinhcongvan,
			'chucvu' => $chucvu ?? '',
		]);

	}

	public function getThongKe() {
		$year = date('Y');
		$months = range(1, 12);

			if (Auth::user() && Auth::user()->level != 2) {
				$userId = auth()->id();
				$phongBan = PhongBan::whereHas('users', function ($query) use ($userId) {
					$query->where('users.id', $userId);
				}, '>', 0)->first();
				$phongBan_id = $phongBan->id;
				foreach ($months as $month) {
					$dsCongVan = CongVan::where(function ($query) use ($phongBan_id, $year, $month) {
						$query->whereHas('phongban', function ($query) use ($phongBan_id) {
							$query->where('phongban.id', $phongBan_id);
						})
						->whereYear('ngaylap', $year)
						->whereMonth('ngaylap', $month)
						->get();
					});
					$results = $dsCongVan->groupBy('idloaihinhcongvan')
						->select('idloaihinhcongvan', DB::raw('COUNT(id) as totalCongVan'))
						->get();
				}
			} else {
				foreach ($months as $month) {
					$results = CongVan::select(
							'idloaihinhcongvan',
							DB::raw('COUNT(id) as totalCongVan')
						)
						->whereYear('ngaylap', $year)
						->whereMonth('ngaylap', $month)
						->groupBy('idloaihinhcongvan')
						->get();
				}
			}

		$thongKeCongVan[$month] = [];

		foreach ($results as $result) {
			$thongKeCongVan[$month][$result->idloaihinhcongvan] = [
				'totalCongVan' => $result->totalCongVan,
			];
		}

		return view('admin.congvan.thongke', [
			'year' => $year,
			'thongKeCongVan' => $thongKeCongVan
		]);
	}

	public function getThem() {
		//lấy phòng ban của user đang login
		$phongban = User_PhongBan_ChucVu::where('user_id', auth()->user()->id)->first();
		// từ id phòng ban đó lấy ra ds id admin của phòng ban đó
		$ds_admin = User_PhongBan_ChucVu::where('phongban_id', $phongban->phongban_id)
			->whereIn('chucvu_id', [1, 2])->get();
		$ds_id_admin = [];
		foreach($ds_admin as $item) {
			$ds_id_admin[] = $item->user_id;
		}
		//lấy thông tin của các admin - người ký cv
		$lists_admin = User::whereIn('id', $ds_id_admin)->get();

		$congvan = CongVan::all();
		$coquanbanhanh = CoQuanBanHanh::all();
		$hinhthucvanban = HinhThucVanBan::all();
		$linhvuc = LinhVuc::all();
		$loaihinhcongvan = LoaiHinhCongVan::all();
		$loaivanban = LoaiVanBan::all();
		$dsphongban = PhongBan::all();
		return view('admin.congvan.them', [
			'congvan' => $congvan, 
			'coquanbanhanh' => $coquanbanhanh, 
			'hinhthucvanban' => $hinhthucvanban, 
			'linhvuc' => $linhvuc, 
			'loaihinhcongvan' => $loaihinhcongvan, 
			'loaivanban' => $loaivanban,
			'dsphongban' => $dsphongban,
			'ds_admin' => $lists_admin
		]);
	}

	public function postThem(Request $request) {
		DB::transaction(function () use ($request) {
			$this->validate($request,
				[
					'sohieu' => 'required|min:3|max:15',

					'trichyeunoidung' => 'required|min:5|max:100',

					'taptindinhkem' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048', 

					'ngaylap' => 'after_or_equal:today',

					'ngayky' => [
						
						function ($attribute, $value, $fail) use ($request) {
							if (!(strtotime($request->ngaylap) <= strtotime($value))) {
								$fail('Ngày ký phải lớn hơn hoặc bằng ngày lập');
							}
						},
					],
					'ngayhieuluc' => [
						
						function ($attribute, $value, $fail) use ($request) {
							if (!(strtotime($request->ngayky) <= strtotime($value))) {
								$fail('Ngày hiệu lực phải lớn hơn hoặc bằng ngày ký');
							}
						},
					],
					'ngaychuyen' => 
					function ($attribute, $value, $fail) use ($request) {
						if (!(strtotime($request->ngayhieuluc) <= strtotime($value))) {
							$fail('Ngày chuyển phải lớn hơn hoặc bằng ngày hiệu lực');
						}
					},
				],
				[
					'sohieu.required' => 'Bạn phải nhập số hiệu',
					'sohieu.min' => 'Bạn phải nhập số hiệu lớn từ 3 đến 15 ký tự',
					'sohieu.max' => 'Bạn phải nhập số hiệu lớn từ 3 đến 15 ký tự',

					'trichyeunoidung.required' => 'Bạn phải nhập trích yếu nội dung',
					'trichyeunoidung.min' => 'Bạn phải nhập trích yếu nội dung lớn từ 5 đến 100 ký tự',
					'trichyeunoidung.max' => 'Bạn phải nhập trích yếu nội dung lớn từ 5 đến 100 ký tự',

					'taptindinhkem.required' => 'Bạn phải chọn tập tin đính kèm',
					'taptindinhkem.mimes' => 'Tiệp đính kèm định dạng phải là jpeg, png, jpg, pdf.',

					'ngaylap.after_or_equal' => 'Ngày lập phải lớn hơn hoặc bằng hiện tại',
					// 'ngayky.date_format' => 'Bạn phải nhập ngày ký đúng định dạng ngày-tháng-năm',
					// 'ngayhieuluc.date_format' => 'Bạn phải nhập ngày hiệu lực đúng định dạng ngày-tháng-năm',
					// 'ngaychuyen.date_format' => 'Bạn phải nhập ngày chuyển đúng định dạng ngày-tháng-năm',

				]);
			
			$congvan = new CongVan;
			$congvan->sohieu = $request->sohieu;
			$congvan->trichyeunoidung = $request->trichyeunoidung;
			$congvan->nguoiky = $request->nguoiky;

			$congvan->idcoquanbanhanh = intval($request->CoQuanBanHanh);
			$congvan->idhinhthucvanban = intval($request->HinhThucVanBan);
			$congvan->idlinhvuc = intval($request->LinhVuc);
			$congvan->idloaihinhcongvan = intval($request->LoaiHinhCongVan);
			$congvan->idloaivanban = intval($request->LoaiVanBan);

			$congvan->ngaylap = $request->ngaylap;
			$congvan->ngayky = $request->ngayky;
			$congvan->ngayhieuluc = $request->ngayhieuluc;
			$congvan->ngaychuyen = $request->ngaychuyen;
			$congvan->congkhai = $request->congkhai ?? null;

			//Lưu bản scan
			if ($request->hasFile('taptindinhkem')) {
				$file = $request->file('taptindinhkem');
				$fileName = time() . '_' . $file->getClientOriginalName();
				$file->storeAs('scanned_documents', $fileName, 'public');
		
				// Save the file name or path in your database, associate it with the form data
				$congvan->tentaptindinhkem = 'scanned_documents/' . $fileName;
			}


			$congvan->TenKhongDau = changeTitle($request->trichyeunoidung);

			$congvan->save();

			//thêm dữ liệu vào bảng trung gian users - công văn
			if($request->nguoiky) {
				$user_congvan = new User_CongVan;
				$user_congvan->user_id = auth()->user()->id;
				$user_congvan->congvan_id = $congvan->id;
				$user_congvan->nguoiky_id = $request->nguoiky;
				$user_congvan->save();
			}

			$phongBan = PhongBan::whereHas('users', function ($query) {
				$query->where('users.id', auth()->id());
			}, '>', 0)->first();

			//thêm dữ liệu vào bảng trung gian công văn - phòng ban
			if($request->PhongBan) {
				$congvan_phongban = new CongVanPhongBan;
				$congvan_phongban->congvan_id = $congvan->id;
				$congvan_phongban->phongban_id = $request->PhongBan;
			} else {
				$congvan_phongban = new CongVanPhongBan;
				$congvan_phongban->congvan_id = $congvan->id;
				$congvan_phongban->phongban_id = $phongBan->id;
			}
			$congvan_phongban->save();
		});
		return redirect('admin/congvan/them')->with('thongbao', 'Thêm thành công');

	}

	public function getSua($id) {
		$congvan = CongVan::find($id);
		$coquanbanhanh = CoQuanBanHanh::all();
		$hinhthucvanban = HinhThucVanBan::all();
		$linhvuc = LinhVuc::all();
		$loaihinhcongvan = LoaiHinhCongVan::all();
		$loaivanban = LoaiVanBan::all();
		$dsphongban = PhongBan::all();
		return view('admin.congvan.sua', [
			'congvan' => $congvan, 
			'coquanbanhanh' => $coquanbanhanh, 
			'hinhthucvanban' => $hinhthucvanban, 
			'linhvuc' => $linhvuc, 
			'loaihinhcongvan' => $loaihinhcongvan, 
			'loaivanban' => $loaivanban,
			'dsphongban' => $dsphongban
		]);
	}

	public function postSua(Request $request, $id) {
		DB::transaction(function () use ($id, $request) {
			$congvan = CongVan::find($id);
			$this->validate($request,
				[
					'sohieu' => 'required|min:3|max:15',

					'trichyeunoidung' => 'required|min:5|max:100',

					'taptindinhkem' => 'image|mimes:jpeg,png,jpg,pdf|max:2048', 
				],
				[
					'sohieu.required' => 'Bạn phải nhập số hiệu',
					'sohieu.min' => 'Bạn phải nhập số hiệu lớn từ 3 đến 15 ký tự',
					'sohieu.max' => 'Bạn phải nhập số hiệu lớn từ 3 đến 15 ký tự',

					'trichyeunoidung.required' => 'Bạn phải nhập trích yếu nội dung',
					'trichyeunoidung.min' => 'Bạn phải nhập trích yếu nội dung lớn từ 5 đến 100 ký tự',
					'trichyeunoidung.max' => 'Bạn phải nhập trích yếu nội dung lớn từ 5 đến 100 ký tự',

					'taptindinhkem.mimes' => 'Tiệp đính kèm định dạng phải là jpeg, png, jpg, pdf.',
				]);

			$congvan->sohieu = $request->sohieu;
			$congvan->trichyeunoidung = $request->trichyeunoidung;
			$congvan->nguoiky = $request->nguoiky;

			$congvan->idcoquanbanhanh = intval($request->CoQuanBanHanh);
			$congvan->idhinhthucvanban = intval($request->HinhThucVanBan);
			$congvan->idlinhvuc = intval($request->LinhVuc);
			$congvan->idloaihinhcongvan = intval($request->LoaiHinhCongVan);
			$congvan->idloaivanban = intval($request->LoaiVanBan);

			$congvan->ngaylap = $request->ngaylap;
			$congvan->ngayky = $request->ngayky;
			$congvan->ngayhieuluc = $request->ngayhieuluc;
			$congvan->ngaychuyen = $request->ngaychuyen;
			$congvan->congkhai = $request->congkhai ?? null;
			$congvan->is_active = false;

			if ($request->hasFile('taptindinhkem')) {
				$file = $request->file('taptindinhkem');
				$fileName = time() . '_' . $file->getClientOriginalName();
				$file->storeAs('scanned_documents', $fileName, 'public');
		
				// Save the file name or path in your database, associate it with the form data
				$congvan->tentaptindinhkem = 'scanned_documents/' . $fileName;
			}

			$congvan->TenKhongDau = changeTitle($request->trichyeunoidung);

			$congvan->save();

			//thêm dữ liệu vào bảng trung gian users - công văn
			if($request->nguoiky) {
				$user_congvan = new User_CongVan;
				$user_congvan->user_id = auth()->user()->id;
				$user_congvan->congvan_id = $congvan->id;
				$user_congvan->nguoiky_id = $request->nguoiky;
				$user_congvan->save();
			}

			$phongBan = PhongBan::whereHas('users', function ($query) {
				$query->where('users.id', auth()->id());
			}, '>', 0)->first();

			//thêm dữ liệu vào bảng trung gian công văn - phòng ban
			if($request->PhongBan) {
				$congvan_phongban = new CongVanPhongBan;
				$congvan_phongban->congvan_id = $congvan->id;
				$congvan_phongban->phongban_id = $request->PhongBan;
			} else {
				$congvan_phongban = new CongVanPhongBan;
				$congvan_phongban->congvan_id = $congvan->id;
				$congvan_phongban->phongban_id = $phongBan->id;
			}
			$congvan_phongban->save();
		});
		return redirect('admin/congvan/sua/' . $id)->with('thongbao', 'Sửa thành công');

	}

	public function getXoa($id) {
		DB::transaction(function () use ($id) {
			$congvan = CongVan::find($id);
			$congvan->delete();

			$congvan_phongban = CongVanPhongBan::where('congvan_id', $id)->first();
			$congvan_phongban->delete();

			$user_congvan = CongVanPhongBan::where('congvan_id', $id)->first();
			$user_congvan->delete();
		});
		return redirect('admin/congvan/danhsach')->with('thongbao', 'Xoá thành công');
	}

	public function postPheDuyet($id) {
		$congvan = CongVan::find($id);
		$congvan->update([
			$congvan->is_active = true,
		]);

		return redirect('admin/congvan/danhsach')->with('thongbao', 'Phê duyệt thành công');
	}

	public function postKhongPheDuyet($id) {
		$congvan = CongVan::find($id);
		$congvan->update([
			$congvan->is_active = 3,
		]);

		return redirect('admin/congvan/danhsach')->with('thongbao', 'Từ chối phê duyệt thành công');
	}
}
