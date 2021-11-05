<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Tray;
use Illuminate\Database\Seeder;

class TraySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Tray::create([
                'order_id' => Order::inRandomOrder()->first()->id,
                'price' => $faker->randomFloat(2, 100, 1500),
            ]);
        }
    }
}
