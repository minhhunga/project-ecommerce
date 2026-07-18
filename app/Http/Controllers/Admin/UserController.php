<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $country = Country::all();

        return view ('admin.user.user', compact('user', 'country'));
    }

    public function UpdateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $file = $request->file('avatar');
        //dd( $data);
        if(!empty($file)){
            $data['avatar'] = $file ->getClientOriginalName(); 
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

            return redirect()->back()->with('success', 'Profile updated successfully.');
        }else{
            return redirect()->back()->with('error', 'Profile update failed.');
        }

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
