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
});*/

Route::pattern('id', '[0-9]+');

Route::group(['prefix'=> 'admin'], function(){
    Route::get('products/{id?}', ['as'=>'products', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('products');

        if($id) {
            //return "Olá $id";
            return Redirect::action('WelcomeController@exemplo');
        }
    }]);

    Route::get('categories/{id?}', ['as'=>'categories', function($id = null){
        // Mostrando a URL completa da Rota:
        //return route('categories');

        if($id) {
            //return "Olá $id";
            return Redirect::action('WelcomeController@exemplo');
        }
    }]);
});

Route::get('user/{id?}', function($id = null){

    if($id)
        return "Olá $id";

    return "Não possui id!";
});

Route::get('category/{category}', function(\CodeCommerce\Category $category){

    return $category->name;

    //dd($category);
});

Route::get('/', 'WelcomeController@exemplo');

Route::get('exemplo', 'WelcomeController@exemplo');

Route::get('home', 'WelcomeController@index');

//Route::get('admin/categories', 'AdminCategoriesController@index');

//Route::get('admin/products', 'AdminProductsController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

