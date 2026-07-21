<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB; 

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $blog=Blog::orderBy('created_at', 'DESC')->paginate(3);
        return view ('frontend.blog.blog-list', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showblog($id)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
