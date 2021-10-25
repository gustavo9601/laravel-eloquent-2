<?php

use Illuminate\Http\Request;
use App\User;
use App\Post;


// Usan el middleware de autenticacion
Route::middleware('auth:api')->group(function () {

    Route::get('/users', function () {
        //return \App\Http\Resources\UserResource::collection(User::all());
        return new \App\Http\Resources\UserCollection(User::all());
    });


});


Route::get('/posts', function () {
    // query() solo sirve para organizar la consulta en el codigo
    return Post::query()
        // Seleecionando las columnas de la tabla del modelo
        ->select([
            'title',
            'content',
            'featured',
            'author_id',
        ])
        // Especificando la relacion eager loading, con solo las columnas que se requieren
        ->with(['author:id,name,email'])
        ->get();

    /*
     * Otra forma de especificar las columnas de la tabla a relacionar
     *
     *
      $products = Product::query()
        ->select(['title', 'slug', 'image', 'category_id'])
        ->with([
            'category' => function ($q) {
                $q->select(['id', 'title', 'slug']);
            }
        ])
        ->get();
     *
     *
     * */

});


Route::get('/posts-paginated', function () {
    /*
     * offset and limit
     *  skip() and limit()
     *
     * simplePaginate($maxRecordsToShow) // No realiza un count sobre los registros, siendo mas rapido
     * */

    // Post::paginate($maxRecordsToShow);
    return Post::simplePaginate(2);
});


Route::get('/posts-by-author-id', function (Request $request) {
    // query() solo sirve para organizar la consulta en el codigo
    return Post::query()
        // Seleecionando las columnas de la tabla del modelo
        ->select([
            'title',
            'content',
            'featured',
            'author_id',
        ])
        // Especificando la relacion eager loading, con solo las columnas que se requieren
        ->with(['author:id,name,email'])
        // Consulta que se ejecuta si se cumple la condicion del primer parametro
        ->when($request->input('author_id'), function ($query, $authorId) {
            $query->where('author_id', $authorId);
        })
        ->get();


});
