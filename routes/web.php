<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('users', function () {
    return view('users');
});


Route::get('users/{user}', function () {
    return view('user');
});


Route::get('products/{product}', function ($product) {
    return "Product $product page";
});

Route::get('customers/{customer}', function ($customer) {
    return view('customer', ['customer' => $customer]);
});


Route::get('countries/{country}', function ($country) {
    return view('country', compact('country'));
});

Route::get('countries/{country}/{city}', function ($country, $city) {
    return view('city', compact('country', 'city'));
});
