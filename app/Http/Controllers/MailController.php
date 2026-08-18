<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\History;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $cart = session()->get('cart', []);

        $sum = 0;

        foreach ($cart as $item) {
            $sum += $item['price'] * $item['qty'];
        }

        History::create([
            'email' => $user->email,
            'phone' => $user->phone,
            'name' => $user->name,
            'id_user' => $user->id,
            'price' => $sum,
        ]);

        $data = [
            'subject' => 'Đơn hàng mới',
            'body' => 'Thông tin đơn hàng',
            'user' => $user,
            'cart' => $cart,
            'sum' => $sum,
        ];

        try {
            Mail::to('minhhung.dx1805@gmail.com')
                ->send(new MailNotify($data));

            session()->forget('cart');    
            return redirect('/frontend/home')->with('success', 'Great! Check your mailbox');
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry something went wrong!'
                ]);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
