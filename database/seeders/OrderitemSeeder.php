<?php

namespace Database\Seeders;

use App\Models\Fooditem;
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

        $trays = Tray::all();
        foreach ($trays as $tray) {
            Orderitem::create([
                'fooditem_id' => Fooditem::inRandomOrder()->first()->id,
                'tray_id' => $tray->id,
                'quantity' => $faker->numberBetween(1, 3),
                'unit_price' => $tray->price,
            ]);
        }
    }
}
