<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SlideController extends Controller {
	//
	public function getDanhsach() {
		$slide = Slide::all();
		return view('admin.slide.danhsach', ['slide' => $slide]);
	}

	public function getThem() {
		return view('admin.slide.them');
	}

	public function postThem(Request $request) {
		$this->validate($request,
			[
				'name' => 'required',
				'link' => 'required',
				'hinhanh' => 'required'
			],
			[
				'name.required' => 'Bạn chưa nhập tên ',
				'link.required' => 'Bạn chưa nhập link',
				'hinhanh' => 'Bạn chưa chọn slide',

			]);
		$slide = new Slide;
		$slide->name = $request->name;
		if ($request->has('link')) {
			$slide->link = $request->link;
		}
		if ($request->hasFile('hinhanh')) {
			$file = $request->file('hinhanh');
			$duoi = $file->getClientOriginalExtension();
			$duoichophep = array("png", "jpg", "gif");
			if (!in_array($duoi, $duoichophep)) {
				return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn ảnh có đuôi file png, jpg, gif.');
			}
			$name = $file->getClientOriginalName();
			$hinhanh = Str::random(3) . "_" . $name;
			while (file_exists("upload/" . $hinhanh)) {
				$hinhanh = Str::random(3) . "_" . $name;
			}
			if (strlen($hinhanh) < 35) {
				$file->move("image/", $hinhanh);
				$slide->hinhanh = $hinhanh;
			} else {
				return redirect('admin/slide/them')->with('loi', 'Tên file hình ảnh phải nhỏ hơn 30 ký tự');
			}

		}

		$slide->save();

		return redirect('admin/slide/danhsach')->with('thongbao', 'Thêm thành công');

	}

	public function getSua($id) {
		$slide = Slide::find($id);

		return view('admin.slide.sua', ['slide' => $slide]);
	}

	public function postSua(Request $request, $id) {
		$this->validate($request,
			[
				'name' => 'required',
				'link' => 'required',
			],
			[
				'name.required' => 'Bạn chưa nhập tên ',
				'link.required' => 'Bạn chưa nhập link',

			]);
		$slide = Slide::find($id);
		$slide->name = $request->name;
		if ($request->has('link')) {
			$slide->link = $request->link;
		}
		if ($request->hasFile('hinhanh')) {
			$file = $request->file('hinhanh');
			$duoi = $file->getClientOriginalExtension();
			$duoichophep = array("png", "jpg", "gif");
			if (!in_array($duoi, $duoichophep)) {
				return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn ảnh có đuôi file png, jpg, gif.');
			}
			$name = $file->getClientOriginalName();
			$hinhanh = Str::random(3) . "_" . $name;
			while (file_exists("upload/" . $hinhanh)) {
				$hinhanh = Str::random(3) . "_" . $name;
			}
			if (strlen($hinhanh) < 35) {
				$file->move("image/", $hinhanh);
				$slide->hinhanh = $hinhanh;
			} else {
				return redirect('admin/slide/them')->with('loi', 'Tên file hình ảnh phải nhỏ hơn 30 ký tự');
			}

		}

		$slide->save();

		return redirect('admin/slide/danhsach')->with('thongbao', 'Sửa thành công');
	}

	public function getXoa($id) {
		$slide = Slide::find($id);
		$slide->delete();
		return redirect('admin/slide/danhsach')->with('thongbao', 'Xoá thành công');
	}
}
