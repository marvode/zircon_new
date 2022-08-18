<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends ApiController
{

    public function index()
    {
        $orders = Auth::user()
            ->orders
            ->latest();

        return $this->showAll($orders);
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     '*.id' => 'required',
        //     '*.quantity' => 'required|integer'
        // ]);

        $cartItems = $request->cartItems;

        $totalPrice = 0;
        foreach ($cartItems as $cartItem)
            // dd($cartItem['price']);
            $totalPrice += $cartItem['price'] * $cartItem['quantity'];

        // dd($cartItems);
        $order  = Order::create([
            'name' => Order::generateOrderName(),
            'user_id' => Auth::user()->id,
            'status' => Order::ORDER_PENDING,
            'price' => $totalPrice,
        ]);

        foreach ($cartItems as $cartItem) {
            Orderitem::create([
                'fooditem_id' => $cartItem['id'],
                'order_id' => $order->id,
                'quantity' => $cartItem['quantity'],
                'unit_price' => $cartItem['price']
            ]);
        }

        $orders = Auth::user()->orders()->latest()->take(20)->get();

        return $this->showAll($orders);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
