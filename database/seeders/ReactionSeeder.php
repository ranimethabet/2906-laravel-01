<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\ReactionType;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 0;

        while ($i < 400) {

            $random_user_id = User::get()->random()->id;

            // $reactionable_type = fake()->randomElement(['post', 'comment', 'reply']);


            // If we use this, no need to use AppServiceProvider/boot -> Realation::forceMorphMap
            $reactionable_type = fake()->randomElement(['App\Models\Post', 'App\Models\Comment', 'App\Models\Reply']);

            $reactionable_id = match ($reactionable_type) {
                'post' => Post::inRandomOrder()->first()->id,
                'comment' => Comment::inRandomOrder()->first()->id,
                'reply' => Reply::inRandomOrder()->first()->id,
            };

            $exists = Reaction::
                where('user_id', '=', $random_user_id)
                ->where('reactionable_type', '=', $reactionable_type)
                ->where('reactionable_id', '=', $reactionable_id)->first();

            // if the record exists continue
            if ($exists)
                continue;

            if (
                Reaction::create([
                    'user_id' => $random_user_id,
                    'reaction_type_id' => ReactionType::inRandomOrder()->first()->id,
                    'reactionable_type' => $reactionable_type,
                    'reactionable_id' => $reactionable_id,
                ])
            )
                $i++;
        }


    }
}
