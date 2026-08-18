<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\Brand;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $category = Category::all();
        $brand = Brand::all();
        return view('frontend.home.home', compact('product', 'category', 'brand'));
    }

    public function detail(string $id)
    {
        
        $product = Product::find($id)->toArray();
        $getArrImage = json_decode($product['image'], true);
        return view('frontend.product.detail', compact('product', 'getArrImage'));
    }

    public function SearchName(Request $request)
    {
        $search = $request->input('search');
        $product = Product::where('name', 'like', '%' . $search . '%')->get();
        return view('frontend.home.home', compact('product'));
    }

    public function SearchPrice(Request $request){
        $min = $request -> price_min;
        $max = $request ->price_max;

        $product = Product::whereBetween('price', [$min, $max])->get();

        if(!empty($product)){
            return response()->json(['product' => $product]);
        }else{
            return 0;
        }

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
