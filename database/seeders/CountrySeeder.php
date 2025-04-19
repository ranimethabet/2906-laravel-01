<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
