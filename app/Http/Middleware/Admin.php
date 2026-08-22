<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra đã đăng nhập và là admin (level == 1)
        if (Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        }
        
        // Nếu đã đăng nhập nhưng không phải admin
        if (Auth::check()) {
            abort(403, 'Bạn không có quyền truy cập vào khu vực quản trị');
        }
        
        // Chưa đăng nhập -> chuyển về trang login
        Auth::logout();
        return redirect('/login')->with('error', 'Vui lòng đăng nhập với tài khoản admin');
    }
}
