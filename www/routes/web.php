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


//BackEnd pages routes
Route::Group(['namespace' => 'Admin'], function() {

    //blog
    Route::get('/adm/blog', 'BlogController@index');
    Route::get('/adm/blog/create', 'BlogController@create');
    Route::get('/adm/blog/{id}/edit', 'BlogController@edit');

});



//FrontEnd pages routes
