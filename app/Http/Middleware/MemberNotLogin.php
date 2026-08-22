<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MemberNotLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Nếu chưa đăng nhập -> cho phép truy cập (đăng ký, đăng nhập)
        if (!Auth::check()) {
            return $next($request);
        }
        
        // Nếu đã đăng nhập -> chuyển hướng về trang phù hợp
        if (Auth::user()->level == 1) {
            // Admin -> về dashboard
            return redirect('/admin/dashboard')->with('error', 'Bạn đã đăng nhập rồi!');
        } else {
            // Member -> về trang chủ frontend
            return redirect('/frontend/home')->with('error', 'Bạn đã đăng nhập rồi!');
        }
    }
}
