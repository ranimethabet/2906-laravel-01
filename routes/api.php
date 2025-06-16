<?php

use App\Http\Controllers\AuthController;
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


// Protected Routes by Sanctum
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('posts')->controller(PostController::class)->group(function () {
        Route::get('/by-user/{user_id}', 'by_user'); // https://website.com/posts/by/4
        Route::get('/by-post-status-id/{post_status_id}', 'ids_by_post_status'); // https://website.com/posts/by/4
        Route::get('/deleted', 'deleted');
        Route::put('/restore/{id}', 'restore_post');
    });

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/contacts', 'contacts');
    });


    Route::prefix('replies')->controller(ReplyController::class)->group(function () {
        Route::get('/by-comment/{comment_id}', 'by_comment');
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
});


// Unprotected Routes
Route::name('auth.')->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::middleware('verified')->group(function () {
        Route::post('/login', 'login')->name('login'); // auth.login
        Route::post('/mobile/login', 'mobile_login');
    });

    Route::post('/register', 'register');
    Route::get('/verify-email', 'verify_email')->name('verify_email'); // auth.verify_email
});