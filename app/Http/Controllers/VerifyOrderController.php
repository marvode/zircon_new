<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class VerifyOrderController extends Controller
{
    public function call(Request $request, Order $order): bool
    {
        $order->update([
            'status' => Order::ORDER_SUCCESS,
            'reference_id' => $request->ref,
        ]);

        return $this->verify($request->ref);
    }

    private function verify($ref): bool
    {
        return true;
    }
}
