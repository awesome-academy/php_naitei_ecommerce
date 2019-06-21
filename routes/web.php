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

Route::get('/', 'StaticPagesController@home')->name('root');
Route::get('/contact', 'StaticPagesController@contact');

Auth::routes(['verify' => true]);

Route::get('users/{user}',  ['as' => 'users.show', 'uses' => 'UserController@show']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);

Route::resource('order', 'OrdersController');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth',
    ], function(){
        Route::group([
            'prefix' => 'users'
        ], function(){
            Route::get('/', 'UsersController@view')
                ->name('manage_users')
                ->middleware('can:users.view');
            Route::get('/getdata', 'UsersController@getdata');
            Route::get('/create', 'UsersController@create')
                ->name('users.create')
                ->middleware('can:users.create');
            Route::post('/create', 'UsersController@store')
                ->name('users.create')
                ->middleware('can:users.create');
            Route::get('/edit/{users}', 'UsersController@edit')
                ->name('admin.edit_users')
                ->middleware('can:users.update');
            Route::post('/edit/{users}', 'UsersController@update')
                ->name('edit_users')
                ->middleware('can:users.update');
            Route::get('/delete', 'UsersController@delete')
                ->name('delete_users')
                ->middleware('can:users.delete');
        });
        Route::group([
            'prefix' => 'orders'
        ], function(){
            Route::get('/', 'OrdersController@index')
                ->name('manage_orders')
                ->middleware('can:orders.view');
            Route::get('/getdata', 'OrdersController@getdata');
            Route::get('/show/{order}', 'OrdersController@show')
                ->middleware('can:orders.view');
            Route::post('/handle', 'OrdersController@handle')
                ->name('edit_users')
                ->middleware('can:orders.update');
        });
    });

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Route for Product
 */
Route::resource('products', 'ProductsController', ['parameters' => [
    'show' => 'slug',
    'edit' => 'slug',
]]);

/**
 * Route for Cart
 */
Route::resource('cart','CartsController')->only([
    'store',
    'index',
    'update',
    'destroy'
]);

/**
 * Route for shop page
 */
Route::get('/shop', 'ShopController@index')->name('shop');

/**
 * Route for search
 */
Route::get('/search', 'ShopController@search')->name('search');
