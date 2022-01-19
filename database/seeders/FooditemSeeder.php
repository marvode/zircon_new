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

        $food = [
            'jollof rice' => ["https://www.organichaive.com.ng/wp-content/uploads/2018/08/Jollof-Rice-Nigeria-350x350.jpg", 'food', 800],
            'eba and egusi' => ["https://as2.ftcdn.net/v2/jpg/02/70/11/61/1000_F_270116119_e0TERAIm8kM6uychr9bd3J3TrEnuT3Sx.jpg", "food", 500],
            'chi exotic' => ["https://www-konga-com-res.cloudinary.com/w_auto,f_auto,fl_lossy,dpr_auto,q_auto/media/catalog/product/E/H/171695_1627426202.jpg", "drinks", 700],
            'salad' => ["https://breadboozebacon.com/wp-content/uploads/2017/12/Fresh-Vegetable-Salad-SQUARE-500x500.jpg", 'side', 300],
            'parfait' => ["https://therecipecritic.com/wp-content/uploads/2020/01/yogurtparfaits-500x375.jpg", 'dessert', 1000],
            'coke' => ["https://as2.ftcdn.net/v2/jpg/02/86/74/75/1000_F_286747506_YDkNhjqXwcwSGmLGEqiTVSDN6hXkPhvo.jpg", 'drinks', 200],
        ];

        foreach ($food as $key => $value) {
            Fooditem::create([
                'name' => $key,
                'description' => $faker->text,
                'availability' => true,
                'price' => $value[2],
                'image' => $value[0],
                'category_id' => Category::where("name", $value[1])->first()->id,
            ]);
        }
    }
}

// class Food {
//     public string $name;
//     public string $image;
//     public
// }
