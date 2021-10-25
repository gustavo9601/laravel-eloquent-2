<?php

use Illuminate\Http\Request;
use App\User;


// Usan el middleware de autenticacion
Route::middleware('auth:api')->group(function () {

    Route::get('/users', function () {
        //return \App\Http\Resources\UserResource::collection(User::all());
        return new \App\Http\Resources\UserCollection(User::all());
    });


});
