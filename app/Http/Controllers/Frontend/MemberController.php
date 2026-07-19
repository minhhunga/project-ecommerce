<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('frontend.member.register');
    }

    public function PostRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $file = $request->file('avatar');
        
        if(!empty($file)){
            $fileName = $file->getClientOriginalName();
            $data['avatar'] = $fileName;
        }

        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0;
        if(User::create($data)){

            if(!empty($file)){
                $file->move(public_path('upload/user/avatar'), $fileName);
            }
            return redirect()->back()->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
            
        } else {
            return redirect()->back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại.');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('frontend.member.login');
    }

    public function PostLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'level' => 0
        ];

        $remember = false;

        if($request->remember_me){
            $remember = true;
        }

        if(Auth::attempt($login, $remember)){
            return redirect('frontend/home')->with('successfull', 'Đăng nhập thành công.');
        }else{
            return redirect()->back()->withErrors('Email hoặc mật khẩu không đúng');
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.post');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
