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

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => ['auth']], function(){ 

    Route::get('/home', 'DashboardController@index')->name('home');

    Route::get('dashboard', 'DashboardController@index');

    // Module Category
    Route::get('categories', 'CategoryController@index');
    Route::get('category/create', 'CategoryController@create');
    Route::get('category/show/{id}', 'CategoryController@show');
    Route::get('category/{id}/edit', 'CategoryController@edit');
    Route::put('category/update/{id}', 'CategoryController@update');
    Route::post('category/store', 'CategoryController@store');
    Route::get('category/delete/{id}', 'CategoryController@destroy');

    // Module Product
    Route::resource('product', 'ProductController');
    Route::get('product/delete/{id}', 'ProductController@destroy');

    // Module Transaction
    Route::get('transaction/import', 'TransactionController@import');
    Route::post('transaction/store_import', 'TransactionController@store_import');
    Route::post('transaction/update/{id}', 'TransactionController@update');
    Route::get('transaction/download', 'TransactionController@download');
    Route::resource('transaction', 'TransactionController');
    Route::get('transaction/delete/{id}', 'TransactionController@destroy');
});