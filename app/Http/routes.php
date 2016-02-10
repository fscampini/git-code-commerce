<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


Route::get('/', function () {
    return view('welcome');
});

Para exibir detalhes dos valores de uma variável, simplesmente digite o código a seguir.
dd($category);
*/

Route::pattern('id', '[0-9]+');

Route::group(['prefix'=> 'admin'], function(){

    // Rotas do Crud para Produtos
    Route::get('products/{id?}', ['as'=>'products', 'uses'=>'AdminProductsController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('products');

        if($id)
            return "Olá $id";

        return "URL não encontrada.";
    }]);

    Route::post('products/{id?}', ['as'=>'products', 'uses'=>'AdminProductsController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('products');

        if($id)
            return "Olá $id";

        return "URL não encontrada.";
    }]);

    Route::delete('products/{id?}', ['as'=>'products', 'uses'=>'AdminProductsController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('products');

        if($id)
            return "Olá $id";

        return "URL não encontrada.";
    }]);

    Route::put('products/{id?}', ['as'=>'products', 'uses'=>'AdminProductsController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('products');

        if($id)
            return "Olá $id";

        return "URL não encontrada.";
    }]);


    // Rotas do Crud para Categoria
    Route::get('categories/{id?}', ['as'=>'categories', 'uses'=>'AdminCategoriesController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('categories');

        if($id) {
            //return "Olá $id";
        } else {
            return "URL não encontrada.";
        }
    }]);

    Route::post('categories/{id?}', ['as'=>'categories', 'uses'=>'AdminCategoriesController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('categories');

        if($id)
            //return "Olá $id";

            return "URL não encontrada.";
    }]);

    Route::delete('categories/{id?}', ['as'=>'categories', 'uses'=>'AdminCategoriesController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('categories');

        if($id)
            //return "Olá $id";

            return "URL não encontrada.";
    }]);

    Route::put('categories/{id?}', ['as'=>'categories', 'uses'=>'AdminCategoriesController@index', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('categories');

        if($id)
            //return "Olá $id";

            return "URL não encontrada.";
    }]);
});

Route::get('user/{id?}', function($id = null){

    if($id)
        return "Olá $id";

    return "Não possui id!";
});
// ***************************************
// crud categories

Route::get('categories',['as'=>'categories', 'uses'=>'CategoriesController@index']);
Route::post('categories',['as'=> 'categories.store', 'uses'=>'CategoriesController@store']);
Route::get('categories/create',['as'=> 'categories.create', 'uses'=>'CategoriesController@create']);
Route::get('categories/{id}/destroy',['as'=> 'categories.destroy', 'uses'=> 'CategoriesController@destroy']);
Route::get('categories/{id}/edit',['as'=> 'categories.edit', 'uses'=> 'CategoriesController@edit']);
Route::put('categories/{id}/update',['as'=> 'categories.update', 'uses'=> 'CategoriesController@update']);

// ***************************************
// crud products

Route::get('products',['as'=>'products', 'uses'=>'ProductsController@index']);
Route::post('products',['as'=> 'products.store', 'uses'=>'ProductsController@store']);
Route::get('products/create',['as'=> 'products.create', 'uses'=>'ProductsController@create']);
Route::get('products/{id}/destroy',['as'=> 'products.destroy', 'uses'=> 'ProductsController@destroy']);
Route::get('products/{id}/edit',['as'=> 'products.edit', 'uses'=> 'ProductsController@edit']);
Route::put('products/{id}/update',['as'=> 'products.update', 'uses'=> 'ProductsController@update']);

// ***************************************
// Exemplos

Route::get('/', 'WelcomeController@exemplo');
Route::put('exemplo', 'WelcomeController@exemplo');
Route::get('home', 'WelcomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

