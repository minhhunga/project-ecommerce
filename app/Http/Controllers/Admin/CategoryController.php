<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listcategory()
    {
        $category = Category::all();
        return view('admin.category.list', compact('category'));
    }

    public function index()
    {
        return view('admin.category.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryRequest $request)
    {
        $data = $request->all();
        if(Category::create($data)){
            return redirect('/admin/category/')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if($category->delete()){
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete category.');
        }
   
    }
}