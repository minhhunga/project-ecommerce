<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('frontend.product.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.create', compact('categories', 'brands'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function addProduct(ProductRequest $request)
    {
        $data = [];
        if($request->hasFile('image')){

            foreach($request->file('image') as $xx){

                $image = Image::read($xx);

                $name = time() . '_' . uniqid() . '.' . $xx->getClientOriginalExtension();
                $name2 = "hinh50_" . $name;
                $name3 = "hinh200_" . $name;

                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name2);
                $path3 = public_path('upload/product/' . $name3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $data[] = $name;
            }
        }

        $product = $request->all();
        $product['image'] = json_encode($data);
        $product['id_user'] = Auth::User()->id;

        if(Product::create($product)) {
            return redirect()->route('product.create')->with('success', 'Product created successfully.');
        } else {
            return redirect()->route('product.create')->with('error', 'Failed to create product.');
        }
    }

    public function edit(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product['image'], true);
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.edit', compact('product', 'categories', 'brands', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();

        if($data['status']==1){
            if(empty($data['sale'])){
                return back()->withErrors(['sale' => 'Please enter the sale rate of product']);
            }
        } else{
            $data['sale'] = 0;
        }
        
        // Lấy hình cũ
        $oldImage = json_decode($product->image, true) ?? [];

         //xóa ảnh cũ
        if(!empty($data['image_delete'])) {
            if (count($data['image_delete']) == count($oldImage)) {
                return back()->withErrors(['image' => 'At least 1 image is required for product.']);
            }
            foreach($data['image_delete'] as $key => $value) {
                if((in_array($value, $oldImage))) {
                   
                    @unlink(public_path('upload/product/' . $value));
                    @unlink(public_path('upload/product/hinh50_' . $value));
                    @unlink(public_path('upload/product/hinh200_' . $value));

                    $delete = array_search($value, $oldImage);
                    unset($oldImage[$delete]);
                }
            }
            $oldImage = array_values($oldImage);
        } 

        // Kiểm tra số lượng hình ảnh mới và hình ảnh cũ
        if($request->hasFile('image')) {
            if(count($oldImage) + count($request->file('image')) > 3) {
                return back()->withErrors(['image' => 'You can only upload a maximum of 3 images.']);
            }

            foreach($request->file('image') as $file){

                $image = Image::read($file);

                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $name2 = "hinh50_" . $name;
                $name3 = "hinh200_" . $name;

                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name2);
                $path3 = public_path('upload/product/' . $name3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $oldImage[] = $name;
            }
        }

        $data['image'] = json_encode($oldImage);
        if($product->update($data)) {
            return redirect()->back()->with('success', 'Product updated successfully.');
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->image, true);

        if ($images) {
            foreach ($images as $image) {
                @unlink(public_path('upload/product/' . $image));
                @unlink(public_path('upload/product/hinh50_' . $image));
                @unlink(public_path('upload/product/hinh200_' . $image));
            }
        }

        $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        
    }
}
