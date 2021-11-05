<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = [
            [
                'name' => 'Marv Odemwingie',
                'email' => 'odemwingiemarv@gmail.com',
                'role_id' => 1
            ], [
                'name' => 'Marv Odemwingie',
                'email' => 'marvodemwingie@gmail.com',
                'role_id' => 2
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}
