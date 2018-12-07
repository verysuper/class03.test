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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::post('category/{category}/restore', 'Admin\CategoryController@restore');
    Route::get('category/{parent_id}/create', 'Admin\CategoryController@create');
    Route::get('category/{parent_id}/show/{display}', 'Admin\CategoryController@show');
    Route::resource('category', 'Admin\CategoryController');
    //
    Route::get('merchandise/{parent_id}/create', 'Admin\MerchandiseController@create');
    Route::get('merchandise/{category_id}', 'Admin\MerchandiseController@show');
    Route::resource('merchandise', 'Admin\MerchandiseController');
});
