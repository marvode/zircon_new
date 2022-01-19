<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'food'  => "https://images.squarespace-cdn.com/content/v1/53b839afe4b07ea978436183/1608506169128-S6KYNEV61LEP5MS1UIH4/traditional-food-around-the-world-Travlinmad.jpg",
            'drinks' => "https://cdn.punchng.com/wp-content/uploads/2017/03/29201341/soft-drinks.png",
            'side' => "https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/cobb-salad-1620920716.jpg?crop=1.00xw:0.667xh;0,0.115xh&resize=640:*",
            'dessert' => "https://c.ndtvimg.com/2020-04/chd4rs3g_dessert_625x300_07_April_20.jpg",
        ];

        foreach ($categories as $key => $value) {
            Category::create([
                'name' => $key,
                'image' => $value,
            ]);
        }
    }
}
