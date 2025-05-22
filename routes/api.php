<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostStatusController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ReactionTypeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::apiResource('posts', PostController::class);
// Route::apiResource('comments', CommentController::class);
// Route::apiResource('replies', ReplyController::class);
// Route::apiResource('post-statuses', PostStatusController::class);
// Route::apiResource('reaction-types', ReactionTypeController::class);
// Route::apiResource('users', UserController::class);
// Route::apiResource('reactions', ReactionController::class);

Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::get('/by-user/{user_id}', 'by_user'); // https://website.com/posts/by/4
    Route::get('/by-post-status-id/{post_status_id}', 'ids_by_post_status'); // https://website.com/posts/by/4
});

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/contacts', 'contacts');
});

Route::apiResources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'replies' => ReplyController::class,
    'post-statuses' => PostStatusController::class,
    'reaction-types' => ReactionTypeController::class,
    'users' => UserController::class,
    'reactions' => ReactionController::class,
]);


Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
    Route::get('statistics', 'statistics');
});

Route::get('/init', function () {
    $models = [
        'User',
        'ReactionType',
        'PostStatus',
        'Post',
        'Comment',
        'Reply',
        'Reaction',
    ];

    foreach ($models as $model) {

        // SAME AS : php artisan make:model ModelName -a
        // Artisan::call('make:model', ['name' => $model, '-a' => true]);


        // SAME AS : php artisan make:resource NameResource
        // Artisan::call('make:resource', ['name' => "{$model}Resource"]);

        // SAME AS : php artisan make:resource NameCollection
        // Artisan::call('make:resource', ['name' => "{$model}Resource", '--collection' => true]);
        // OR
        Artisan::call('make:resource', ['name' => "{$model}Collection"]);

        // sleep(1);
    }

    return 'DONE';
});