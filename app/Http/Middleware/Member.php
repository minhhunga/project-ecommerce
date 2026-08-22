<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra đã đăng nhập và là member (level == 0)
        if (Auth::check() && Auth::user()->level == 0) {
            return $next($request);
        }
        
        // Nếu đã đăng nhập nhưng là admin (level == 1)
        if (Auth::check() && Auth::user()->level == 1) {
            abort(403, 'Admin không thể truy cập vào khu vực này');
        }
        
        // Chưa đăng nhập -> chuyển về trang login
        return redirect('/frontend/login')->with('pleaseLogin', 'Vui lòng đăng nhập để sử dụng chức năng này');
    }
}
