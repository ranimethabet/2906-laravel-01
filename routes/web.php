<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::get('/init', function () {
//     $models = [
//         'User',
//         'ReactionType',
//         'PostStatus',
//         'Post',
//         'Comment',
//         'Reply',
//         'Reaction',
//     ];

//     foreach ($models as $model) {
//         // php artisan make:model ModelName -a
//         Artisan::call('make:model', ['name' => $model, '-a' => true]);

//         sleep(1);
//     }

//     return 'DONE';
// });