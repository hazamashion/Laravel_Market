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

Route::get('/welcom', function () {
    return view('welcome');
});
//ログインに関するルーティング
Auth::routes();

//トップページ
Route::get('/', function () {
    return view('top',[
        'title' => 'Market'
    ]);
})->name('top');

//プロフィール関連
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::get('/profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');

//出品関連
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::get('/items/{item}/edit', 'ItemController@edit')->name('items.edit');
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');

//購入関連
Route::get('/items/{item}', 'ItemController@show')->name('items.show');
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
Route::get('/items/{item}/finish', 'ItemController@finish')->name('items.finish');

//そのほか
Route::get('/likes', 'LikeController@index')->name('likes.index');