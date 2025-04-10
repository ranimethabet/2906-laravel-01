<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('products/{product}', function ($product) {
    return "Product $product page";
});


Route::get('countries/{country}', function ($country) {
    return view('country', compact('country'));
});

Route::get('countries/{country}/{city}', function ($country, $city) {
    return view('city', compact('country', 'city'));
});

Route::get('materials/{id?}', function ($id = null) {

    if (!$id)
        return "Materials Page";

    return "Material $id Page";
});


// Customers
Route::prefix('customers')->group(function () {
    Route::get('', function () {
        return view('customers.index');
    });

    Route::get('create', function () {
        return view('customers.create');
    });

    Route::get('{customer}', function ($customer) {
        // return view('customers/show', ['customer' => $customer]);
        return view('customers.show', compact('customer'));
    })->whereNumber('customer');
});


// Reports
Route::prefix('reports')->group(function () {
    Route::get('{month}/{year}/sales', function ($month, $year) {
        return $month;
    })->whereIn('month', ['jan', 'feb', 'mar'])->where('year', "(19|20)\d{2}");
});


// users

Route::get('users', function () {
    return view('users');
});


Route::get('users/{user}', function () {
    return view('user');
});


// Route::get('about', function () {
//     return view('static.about');
// });

// Route::get('contact', function () {
//     return view('static.contact');
// });

// Route::get('faq', function () {
//     return view('static.faq');
// });

Route::view('about', 'static.about');
Route::view('contact', 'static.contact');
Route::view('faq', 'static.faq');
