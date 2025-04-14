<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
 

Route::view('/', 'home');

// Route::get('products', 'App\Http\Controllers\products@all' );

// Route::get('products', [ProductController::class, 'index'] );
// Route::get('products/create', [ProductController::class, 'create'] );
// Route::post('products', [ProductController::class, 'store'] );
// Route::get('products/{product}', [ProductController::class, 'show'] );
// Route::get('products/{product}/edit', [ProductController::class, 'edit'] );
// Route::put('products', [ProductController::class, 'update'] );
// Route::delete('products', [ProductController::class, 'destroy'] );

Route::resource('products', ProductController::class);
