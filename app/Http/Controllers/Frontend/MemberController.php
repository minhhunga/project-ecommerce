<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\MemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('frontend.member.register');
    }

    public function PostRegister(MemberRequest $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('frontend.member.login');
    }

    /**
     * Store a newly created resource in storage.
     */
  

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
