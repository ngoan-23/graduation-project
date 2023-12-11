<?php

namespace App\Http\Controllers;
use App\Models\ChucVu;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\User_PhongBan_ChucVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
	//
	public function getDanhSach() {
		$users = User::with(['phongban','chucvu'])->get();
		//lấy ra name phòng ban và chức vụ của user
		foreach ($users as $user) {
			if (!empty($user->phongban[0])) {
				$user->tenPhongBan = $user->phongban[0]->name;
			}
			if (!empty($user->chucvu[0])) {
				$user->tenChucVu = $user->chucvu[0]->name;
			}
		}
		return view('admin.user.danhsach', [
			'user' => $users,
		]);
	}

	public function getThem() {
		$dsphongban = PhongBan::all();
		$dschucvu = ChucVu::all();
		return view('admin.user.them', [
			'dsphongban' => $dsphongban,
			'dschucvu' => $dschucvu
		]);
	}

	public function postThem(Request $request) {
		$this->validate($request,
			[
				'name' => 'required|min:3|max:30',
				'email' => 'required|unique:users,email',
				'password' => 'required|min:6|max:20',
				'passwordAgain' => 'same:password',
			],
			[
				'name.required' => 'Bạn phải nhập tên người dùng',
				'email.required' => 'Bạn phải email',
				'email.unique' => 'Email đã tồn tại',
				'passsword.min' => 'Bạn phải nhập mật khẩu lớn hơn, từ 6 đến 20 ký tự',
				'passsword.max' => 'Bạn phải nhập mật khẩu nhỏ hơn, từ 6 đến 20 ký tự',
				'passwordAgain.min' => 'Bạn phải nhập mật khẩu lớn hơn, từ 6 đến 20 ký tự',
				'passwordAgain.max' => 'Bạn phải nhập mật khẩu nhỏ hơn, từ 6 đến 20 ký tự',
			]);
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->level = $request->level;
		$user->save();

		//thêm dữ liệu vào bảng trung gian user - phòng ban - chức vụ
		if($request->phongban || $request->chucvu) {
			$phongban_chucvu = new User_PhongBan_ChucVu;
			$phongban_chucvu->user_id = $user->id;
			$phongban_chucvu->phongban_id = $request->phongban;
			$phongban_chucvu->chucvu_id = $request->chucvu;
			$phongban_chucvu->save();
		}

		return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');

	}

	public function getSua($id) {
		$user = User::with(['phongban', 'chucvu'])->find($id);
		$dsphongban = PhongBan::all();
		$dschucvu = ChucVu::all();
		return view('admin.user.sua', [
			'user' => $user,
			'dsphongban' => $dsphongban,
			'dschucvu' => $dschucvu
		]);
	}

	public function postSua(Request $request, $id) {
		$user = User::find($id);

		$this->validate($request,
			[
				'name' => 'required|min:3|max:30',
				'password' =>'confirmed|min:6',
			],
			[
				'name.required' => 'Bạn phải nhập tên người dùng',
			]);

		$user->name = $request->name;
		if ($request->changePassword) {
			$user->password = bcrypt($request->password);
		}
		if($request->level) {
			$user->level = $request->level;
		}

		$user->save();

		if($request->phongban || $request->chucvu) {
			$phongban_chucvu = User_PhongBan_ChucVu::where('user_id', $user->id)->first();
			$phongban_chucvu->phongban_id = $request->phongban;
			$phongban_chucvu->chucvu_id = $request->chucvu;
			$phongban_chucvu->save();
		}

		return redirect('admin/user/sua/' . $id)->with('thongbao', 'Sửa thành công');
	}

	public function getXoa($id) {
		$coquanbanhanh = User::find($id);
		$coquanbanhanh->delete();

		return redirect('admin/user/danhsach')->with('thongbao', 'Xoá thành công');
	}

	public function getDangnhapAdmin() {
		return view('admin.login');
	}

	public function postDangnhapAdmin(Request $request) {
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
			return redirect('admin/congvan/danhsach');
		} else {
			return redirect('admin/dangnhap')->with('loi', 'Đăng nhập không thành công, mời nhập lại!');
		}
	}

	public function getDangxuat() {
		Auth::logout();
		return redirect('admin/dangnhap')->with('thongbao', 'Đăng xuất thành công');
	}
	public function  updatePassword()
    {
        return view('user.password');
    }
}
