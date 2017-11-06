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

//index page
Route::get('/', 'HomeController@index')->name('home');

//Blog FE pages
Route::Group(['namespace'=>'Blog'], function(){
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/show/{id}', 'BlogController@show');
    Route::get('/blog/category/{id}', 'BlogController@category');
});

Route::Group(['namespace'=>'Comment'], function(){
    Route::get('/comments', 'CommentController@comments');
    Route::resource('/comment', 'CommentController');
});

Route::Group(['namespace'=>'Dashboard'], function(){
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/dashboard', 'DashboardController@store');
    Route::get('/dashboard/record', 'DashboardController@getRecord');
    Route::get('/dashboard/list', 'DashboardController@getList');
});


//BackEnd pages routes
Route::Group(['namespace' => 'Admin', 'middleware' => 'auth'], function() {

    //blog
    Route::get('/adm/blog', 'BlogController@index');
    Route::get('/adm/blog/create', 'BlogController@create');
    Route::get('/adm/blog/{id}/edit', 'BlogController@edit');
});



//FrontEnd pages routes
Auth::routes();
