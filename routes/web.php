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

//logginユーザーのナビゲーション→管理ユーザーなら遷移可能ルート
Route::get('/admin', 'Admin\AdminController')->name('admin');

//管理者用の認証ルート（未実装）
Route::get('admin/login', 'Admin\AuthController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\AuthController@login')->name('admin.login.submit');
Route::post('admin/logout', 'Admin\AuthController@logout')->name('admin.logout');

//トップページ
Route::get('/', 'TopController@index')->name('top');

//プロフィール関連
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}/edit', 'ProfileController@update')->name('profile.update');
Route::get('/profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');
Route::patch('/profile/{user}/edit_image', 'ProfileController@updateImage')->name('profile.update_image');

//出品関連
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');
////新規出品
Route::get('/items/create', 'ItemController@create')->name('items.create');
Route::post('/items', 'ItemController@store')->name('items.store');
////商品編集
Route::get('/items/{item}/edit', 'ItemController@edit')->name('items.edit');
Route::patch('/items/{item}/edit', 'ItemController@update')->name('items.update');
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}/edit_image', 'ItemController@updateImage')->name('items.update_image');
////商品削除
Route::delete('/items/{item}', 'ItemController@destroy')->name('items.destroy');

//購入関連
////商品詳細
Route::get('/items/{item}', 'ItemController@show')->name('items.show');
////購入確認
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
////購入処理
Route::post('/items/{item}', 'ItemController@storeOrder')->name('items.store_order');
////購入確定
Route::get('/items/{item}/finish', 'ItemController@finish')->name('items.finish');

//そのほか
Route::get('/likes', 'LikeController@index')->name('likes.index');
Route::patch('/items/{item}/toggle_like', 'ItemController@toggleLike')->name('items.toggle_like');