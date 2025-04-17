<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
