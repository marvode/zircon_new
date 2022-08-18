<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            FooditemSeeder::class,
            OrderSeeder::class,
            // TraySeeder::class,
            OrderitemSeeder::class,
            AddressSeeder::class,
        ]);

        DB::unprepared("INSERT INTO personal_access_tokens (tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES (\"App\\\Models\\\User\", 2, 'windows_pc', '5593866c96ea007615debdce1bffcc49abc7bc93bfddf1bbf68dd59fca2f03d4', '[\"*\"]', '2021-10-09 11:26:13', '2021-10-09 11:26:13', '2021-10-09 11:26:13')");

        DB::unprepared("INSERT INTO personal_access_tokens (tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES (\"App\\\Models\\\User\", 1, 'windows_pc', 'af1cec6c0bd85685dd8498bb58ebffcafa79ddb399ff80125acd2d54cb51a13f', '[\"*\"]', '2021-10-09 11:26:13', '2021-10-09 11:26:13', '2021-10-09 11:26:13')");
    }
}
