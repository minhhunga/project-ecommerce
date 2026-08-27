<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\ResetPasswordMailNotify;
use App\Models\User;
use App\Models\Country;

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
            $fileName = time().'_'. $file->getClientOriginalName();
            $data['avatar'] = $fileName;        
        }

        $data['password'] = bcrypt($data['password']);
        $data['level'] = 0;

        if(User::create($data)){
            if(!empty($file)){
                $file->move(public_path('upload/user/avatar'), $fileName);
        }   
            return redirect()->back()->with('successfull', 'Đăng ký thành công. Vui lòng đăng nhập để tiếp tục.');
        }else{
            return redirect()->back()->withErrors('Đăng ký thất bại. Vui lòng thử lại.');
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

    public function forgotPassword()
    {
        return view('frontend.member.forgot-password');
    }

    public function sendResetLink(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại.');
        }
        Mail::to($user->email)->send(new ResetPasswordMailNotify($user));

        return back()->with('success', 'Link reset password đã được gửi vào email');
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect()->route('frontend.member.forgot-password')->with('error', 'Người dùng không tồn tại');
        }

        return view('frontend.member.reset-password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('frontend.member.forgot-password')->with('error', 'Người dùng không tồn tại');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/frontend/login')->with('success', 'Mật khẩu đã được cập nhật thành công. Vui lòng đăng nhập.');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/frontend/login');
    }

    /**
     * Display the specified resource.
     */
    public function profile()
    {
        $getuser = Auth::user();
        $country = Country::all();
        return view('frontend.member.account', compact('getuser', 'country'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $data = $request->all();

        $file = $request->file('avatar');
        if(!empty($file)){
            $data['avatar']  = $file->getClientOriginalName(); 
        }

        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if($user->update($data)){
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công.');
        }else{
            return redirect()->back()->with('error', 'Cập nhật hồ sơ thất bại.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
