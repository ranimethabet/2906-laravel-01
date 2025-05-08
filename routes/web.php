<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostStatusController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReactionTypeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::resource('posts', PostController::class);
// Route::resource('comments', CommentController::class);
// Route::resource('replies', ReplyController::class);
// Route::resource('post-statuses', PostStatusController::class);
// Route::resource('reaction-types', ReactionTypeController::class);
// Route::resource('users', UserController::class);
// Route::resource('reactions', ReactionController::class);

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'replies' => ReplyController::class,
    'post-statuses' => PostStatusController::class,
    'reaction-types' => ReactionTypeController::class,
    'users' => UserController::class,
    'reactions' => ReactionController::class,
]);


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