<?php

namespace Database\Seeders;

use App\Models\ReactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reactionTypes = [
            'Like',
            'Love',
            'Laugh',
            'Angry',
            'Care',
            'Sad',
        ];

        foreach ($reactionTypes as $reactionType) {
            ReactionType::create([
                'type' => $reactionType
            ]);
        }
    }
}
