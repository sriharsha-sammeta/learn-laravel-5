<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('about', 'PagesController@about');

Route::get('contact', 'PagesController@contact');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'articles',], function () {

    Route::get('', 'ArticlesController@index');

    Route::get('create', 'ArticlesController@create');

    Route::get('{id}', 'ArticlesController@show')->where(['id' => '[0-9]+'])->name('article_using_id');

    Route::post('', 'ArticlesController@store');

});
