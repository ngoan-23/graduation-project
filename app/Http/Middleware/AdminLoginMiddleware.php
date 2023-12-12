<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::check()) {
			$user = User::with('chucvu')->where('id', Auth::user()->id)->first();
			if(!empty($user->chucvu[0])) {
				$chucvu_id = $user->chucvu[0]->id;
			}
			if ($user->level > 0 || $chucvu_id == 3) {
				return $next($request);
			} else {
				return redirect('admin/dangnhap')->with('loi', 'Bạn không có quyền truy cập trang quản trị. Vui lòng liên hệ quản trị viên để được cấp quyền.');
			}
		} else {
			return redirect('admin/dangnhap');
		}

	}

}
