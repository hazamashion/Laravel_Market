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
Route::get('/', 'TopController@index')->name('top');

//プロフィール関連
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::get('/profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');

//出品関連
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');
////新規出品
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items', 'ItemController@store')->name('items.store');
////商品編集
Route::get('/items/{item}/edit', 'ItemController@edit')->name('items.edit');
Route::patch('/items/{item}', 'ItemController@update')->name('items.update');
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
////商品削除
Route::delete('/items/{item}', 'ItemController@destroy')->name('items.destroy');

//購入関連
////商品詳細
Route::get('/items/{item}', 'ItemController@show')->name('items.show');
////購入確認
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
////購入確定
Route::get('/items/{item}/finish', 'ItemController@finish')->name('items.finish');

//そのほか
Route::get('/likes', 'LikeController@index')->name('likes.index');