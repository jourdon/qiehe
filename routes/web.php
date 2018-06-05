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

//Route::get('/', 'PagesController@root')->name('root');
Route::get('/', 'PostsController@index')->name('root');

//Auth::routes();
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//本地启用
if (app()->isLocal()) {
    //用户名或邮箱登录
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');


    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
}else{
    //登录跳转到QQ 登录
    Route::get('login', function(){
        return redirect('socials/qq/authorizations');
    })->name('login');
    Route::get('register', function(){
        return redirect('socials/qq/authorizations');
    })->name('register');
}

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::get('users_json','UsersController@usersJson')->name('users.json');

Route::put('cache_at','UsersController@cacheAt')->name('users.cache.at');

Route::resource('posts', 'PostsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('posts/{post}/{slug?}', 'PostsController@show')->name('posts.show');

Route::post('posts/upload', 'PostsController@upload')->name('posts.upload');

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::get('tags/{slug}', 'TagsController@show')->name('tags.show');

Route::resource('replies', 'RepliesController', ['only' => [ 'store',  'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

// 第三方登录
Route::get('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
    ->name('socials.authorizations.store');
Route::get('socials/{social_type}/callback', 'AuthorizationsController@callback')
    ->name('socials.authorizations.back');
