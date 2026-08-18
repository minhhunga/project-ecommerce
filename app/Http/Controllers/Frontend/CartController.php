<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $sum = 0;
        foreach ($cart as $item) {
            $sum += $item['price'] * $item['qty'];
        }

        return view('frontend.cart.cart', compact('cart', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddCart(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                "qty" => 1,
            ];
        }

        session()->put('cart', $cart);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['qty'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Add product to your cart successfully.',
            'total' => $total
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateCart(Request $request)
    {
        $itemId = $request->id;
        $qty = $request->qty;
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['qty'] = $qty;
            session()->put('cart', $cart);

            $itemtotal = $cart[$itemId]['price'] * $qty;
            $sum = 0;
            foreach ($cart as $item) {
                $sum += $item['price'] * $item['qty'];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'itemtotal' => $itemtotal,
            'sum' => $sum,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function deleteCart(Cart $cart)
    {
        $id = request()->id;
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            $sum = 0;
            foreach ($cart as $item) {
                $sum += $item['price'] * $item['qty'];
            }
        }

        return response()->json([
            'success' => true,
            'sum' => $sum,
            'message' => 'Product removed from cart successfully.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function checkout(Cart $cart)
    {
        $cart = session()->get('cart', []);
        $sum = 0;
        foreach ($cart as $item) {
            $sum += $item['price'] * $item['qty'];
        }
        return view('frontend.cart.check-out', compact('cart', 'sum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
