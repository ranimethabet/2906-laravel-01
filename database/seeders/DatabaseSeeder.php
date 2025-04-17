<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Maged Yaseen',
            'email' => 'magedyaseengroups@gmail.com',
            // 'mobile' => '01024750245',
            // 'roles' => '["moderatoe", "add_posts"]',
            'password' => 'password',
        ]);

        Country::create([
            'name' => 'Egypt',
        ]);
        Country::create([
            'name' => 'USA',
        ]);
        Country::create([
            'name' => 'India',
        ]);
        Country::create([
            'name' => 'Italy',
        ]);
        Country::create([
            'name' => 'China',
        ]);

        City::create([
            'ar_name' => 'القاهرة',
            'en_name' => 'Cairo',
            'country_id' => '1',
        ]);

        City::create([
            'ar_name' => 'الاسكندرية',
            'en_name' => 'Alex',
            'country_id' => '1',
        ]);
    }
}
