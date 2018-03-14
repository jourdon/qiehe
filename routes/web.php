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
    //return redirect()->route('admin');
    return view('welcome');
});

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=> 'admin',
], function(){
    Route::get('/','IndexController@index')->name('admin');
    Route::get('/main','MainController@main')->name('main');
    Route::get('/navs','MainController@navs')->name('navs');

    Route::post('/image_upload','UsersController@imageUpload')->name('users.imageUpload');
    Route::resource('posts','PostsController');
    Route::get('api/posts','PostsController@posts');

    //Route::get('down','ConfigController@down');
    //Route::get('up','ConfigController@up');
    Route::resource('users','UsersController');
    Route::get('api/users','UsersController@users');
    //Route::resource('roles','RolesController');
    //Route::get('api/roles','RolesController@roles');
    //Route::resource('permissions','PermissionController');
    //Route::get('api/permissions','PermissionController@permissions');
});
////////////////////////////////////
//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
///////////////////////////////////////////
///
Route::get('/home', 'HomeController@index')->name('home');
