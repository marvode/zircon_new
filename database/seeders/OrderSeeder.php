<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 3; $i++) {
            Order::create([
                'user_id' => User::where('role_id', 2)->inRandomOrder()->first()->id,
                'name' => Order::generateOrderName(),
                'status' => $faker->randomElement(Order::getOrderStatusList()),
                'price' => $faker->numberBetween(1000, 3000),
                'payment_id' => $i,
            ]);
        }
    }
}
