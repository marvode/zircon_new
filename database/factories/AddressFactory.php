<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'street' => $this->faker->streetAddress . ', Benin City',
            // 'city' => 'Benin City',
            // 'state' => 'Edo',
        ];
    }
}
