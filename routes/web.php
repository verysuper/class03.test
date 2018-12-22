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
    return redirect('shop/');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::post('category/{category}/restore', 'Admin\CategoryController@restore');
    Route::get('category/{parent_id}/create', 'Admin\CategoryController@create');
    Route::get('category/{parent_id}/show/{display}', 'Admin\CategoryController@show');
    Route::resource('category', 'Admin\CategoryController');
    //
    Route::post('merchandise/{merchandise}/restore', 'Admin\MerchandiseController@restore');
    Route::get('merchandise/{parent_id}/create', 'Admin\MerchandiseController@create');
    Route::get('merchandise/{parent_id}/show/{display}', 'Admin\MerchandiseController@show');
    Route::resource('merchandise', 'Admin\MerchandiseController');
});

Route::get('shop/{category?}', 'ShopController@index');
Route::get('shop/{merchandise}/show', 'ShopController@show');

Route::post('language/{language}', function ($language) {
    session()->put('language', $language);
    return redirect()->back();
});
