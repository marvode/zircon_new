<?php

namespace Database\Seeders;

use App\Models\Fooditem;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Tray;
use Illuminate\Database\Seeder;

class OrderitemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $foodItem = Fooditem::inRandomOrder()->first();

        $orders = Order::all();
        foreach ($orders as $order) {
            Orderitem::create([
                'fooditem_id' => $foodItem->id,
                'order_id' => $order->id,
                'quantity' => $faker->numberBetween(1, 3),
                'unit_price' => $foodItem->price,
            ]);
        }
    }
}
