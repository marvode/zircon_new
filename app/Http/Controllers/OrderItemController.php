<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;

class OrderItemController extends ApiController
{
    public function store(Request $request, Order $order)
    {
        $this->validate($request, [
            'fooditem_id' => 'required',
            'quantity' => 'required|integer',
            'unit_price' => 'required|numeric',
        ]);

        $prevPrice = $order->price === null ? 0 : $order->price;
        $price = $prevPrice + ($request->unit_price * $request->quantity);

        $orderItem = Orderitem::create([
            'fooditem_id' => $request->fooditem_id,
            'order_id' => $order->id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);

        $order->update([
            'price' => $price,
        ]);

        return $this->showOne($orderItem);
    }
}
