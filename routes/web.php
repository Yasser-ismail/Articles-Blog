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


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', function () {
        return view('frontend.welcome');
    })->name('welcome');
// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    /*******************
     *    User Routes *
     *******************/

    Route::group(['namespace' => 'FrontEnd', 'middleware' => 'auth:web'], function () {

        //posts

        Route::get('/posts', 'PostsController@home')->name('home');
        Route::resource('post', 'PostsController')->except('create', 'index');
        //comments

        Route::resource('comment', 'CommentsController')->except('create', 'show');

        //rates
        Route::post('/rates', 'PostsController@storeRate')->name('store.rate');
        Route::post('/rates/{id}/edit', 'PostsController@editRate')->name('edit.rate');

    });


});


/*******************
 *    Admin Routes *
 *******************/
Route::group(['prefix' => 'admin', 'namespace' => 'BackEnd', 'middleware' => 'admin'], function () {
    Route::get('/home', function () {
        return view('backend.index');
    })->name('admin.home');
    Route::Resource('/users', 'UsersController')->except('show');
    Route::Resource('/posts', 'PostsController');
    Route::Resource('/comments', 'CommentsController')->except('show');
    Route::get('/notification/{id}', 'UsersController@deleteNotification')->name('delete.notification');
});

