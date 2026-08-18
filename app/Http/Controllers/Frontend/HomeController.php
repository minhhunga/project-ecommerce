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

        return view('frontend.home.home', compact('product'));
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
        
        $min = $request->minPrice;
        $max = $request->maxPrice;

        $product = Product::whereBetween('price', [$min, $max])->get();

        return response()->json([
            'product' => $product
        ]);

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
