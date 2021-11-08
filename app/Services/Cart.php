<?php

namespace App\Services;

use App\Models\Tray;
use App\Models\User;
use App\Models\Order;
use App\Models\Fooditem;
use App\Models\Orderitem;

class Cart
{
    public function add(?User $user, Fooditem $fooditem, $quantity = 1)
    {
        $price = $fooditem->price * $quantity;

        $order = Order::create([
            'user_id' => $user->id,
            'name' => Order::generateOrderName(),
            'status' => Order::ORDER_PENDING,
            'price' => $price,
            'discount' => 1,
        ]);

        $tray = Tray::create([
            'order_id' => $order->id,
            'price' => $price,
        ]);

        $orderItem = Orderitem::create([
            'tray_id' => $tray->id,
            'fooditem_id' => $fooditem->id,
            'unit_price' => $fooditem->price,
            'quantity' => $quantity,
        ]);

        return $orderItem;
    }

    public function update(Fooditem $fooditem, Orderitem $orderitem, $quantity = 1)
    {
        $price = $fooditem->price * $quantity;

        $orderitem->update([
            'unit_price' => $fooditem->price,
            'quantity' => $quantity,
        ]);

        $orderitem->tray()->update([
            'price' => $price,
        ]);

        $orderitem->tray()->order()->update([
            'price' => $price,
        ]);

        return $orderitem;
    }

    public function remove(Orderitem $orderitem)
    {
        return $orderitem->delete();
    }
}
