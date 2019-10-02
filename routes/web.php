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

Route::get('/', 'HomeController@index')->name('home');
Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('/posts', 'PostController@index')->name('all_post');
Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');
Route::post('comment/{id}', 'CommentController@store')->name('comment.store');
Route::get('category/{slug}', 'PostController@postByCategory')->name('category.post');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.post');
Route::get('/search', 'SearchController@search')->name('search');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
});
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');

    Route::get('authors','AuthorController@index')->name('authors.index');
    Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');


    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::put('profile_update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password_update', 'SettingsController@updatePassword')->name('password.update');

    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

});
Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostController');
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::put('profile_update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password_update', 'SettingsController@updatePassword')->name('password.update');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');

    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');


});

View::composer('layouts.frontend.partial.footer', function ($view) {

    $categories = \App\Category::all();

    $view->with('categories', $categories);
});