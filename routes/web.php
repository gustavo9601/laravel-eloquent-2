<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('has-one', function () {
    $user = User::first();

    return $user->profile;
});


Route::get('filter-query', function () {
    $user = User::first();
    return $user->posts()
        ->where('featured', true)
        ->where('published_at', '<=', now())
        ->get();

});

Route::get('filter-query-with-php', function () {
    $user = User::first();
    return $user->posts()
        ->where('featured', true)
        ->where('published_at', '<=', now());
});
