<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::all();
        return view('admin.blog.blog', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog();
        $blog->title       = $request->input('title');
        $blog->description = $request->input('description');
        $blog->content     = $request->input('content');
        $file = $request->file('image');

        if(!empty($file)){
            $fileName = $file->getClientOriginalName();
            $blog->image = $fileName;
        }

        if($blog->save()){
             if(!empty($file)){
                $file->move(public_path('uploads/blog'), $fileName);
            }
        }

        return redirect('/admin/blog/')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog, $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.update', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ];

        if($request->hasFile('image')){
            $file = $request->file('image');

            $fileName = time().'_'.$file->getClientOriginalName();     
            $data['image'] = $fileName;   
        }

        if($blog -> update($data)){
            if(!empty($file)){
                $file->move(public_path('uploads/blog'), $fileName);
            }
        }

        return redirect('/admin/blog/')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $blog::destroy($id);
        return redirect('/admin/blog/')->with('success', 'Blog deleted successfully.');
    }
}
