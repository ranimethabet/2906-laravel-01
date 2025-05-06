<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Maged Yaseen',
            'email' => 'magedyaseengroups@gmail.com',
            'mobile' => '01024750245',
            'password' => 'password',
            'roles' => 'admin',
        ]);

        User::factory(50)->create();
    }
}
