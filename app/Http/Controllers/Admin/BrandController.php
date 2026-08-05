<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listbrand()
    {
        $brand = Brand::all();
        return view('admin.brand.list', compact('brand'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function index()
    {
        return view('admin.brand.create');
    }

    public function create(BrandRequest $request)
    {
        $data = $request->all();
        if(Brand::create($data)){
            return redirect('/admin/brand/')->with('success', 'Brand created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create brand.');
        }
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        if($brand->delete()){
            return redirect()->back()->with('success', 'Brand deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete brand.');
        }
    }
}
