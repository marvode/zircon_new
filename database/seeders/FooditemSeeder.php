<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fooditem;
use Illuminate\Database\Seeder;

class FooditemSeeder extends Seeder
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
            Fooditem::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'availability' => $faker->boolean,
                'price' => $faker->randomFloat(2, 100, 10000),
                'image' => $faker->imageUrl(640, 480, 'food'),
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);
        }
    }
}
