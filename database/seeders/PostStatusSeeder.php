<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postStatuses = [
            'Pending',
            'Puplished',
            'Reviewed',
            'Postponed',
            'Canceled',
        ];

        foreach ($postStatuses as $postStatus) {
            PostStatus::create([
                'type' => $postStatus,
            ]);
        }
    }
}
