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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::get('/', function () {
    return view('layouts.master');
})->name('layouts.master');

Route::get('/blogs', [
    'uses' => 'BlogController@getBlogIndex',
    'as' => 'content.blogindex'
]);

Route::get('blog/{id}', [
    'uses' => 'BlogController@getBlog',
    'as' => 'content.blog'
]);

Route::get('/',[
    'uses' => 'MapController@getBlogMap',
    'as' => 'content.blogmap'
]);

Route::group(['prefix' => 'admin'], function (){

    Route::get('', [
        'uses' => 'AdminController@getAdminHome',
        'as' => 'admin.home'
    ]);
    //ERROR ^ veranderen /home naar /admin

    Route::get('create', [
        'uses' => 'AdminController@getAdminCreate',
        'as' => 'admin.create'
    ]);


    Route::post('create', [
        'uses' => 'AdminController@postAdminCreate',
        'as' => 'admin.create'
    ]);


    Route::get('edit/{id}', [
        'uses' => 'AdminController@postAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'AdminController@postAdminUpdate',
        'as' => 'admin.update'
    ]);


    Route::post('delete', [
        'uses' => 'AdminController@postAdminDelete',
        'as' => 'admin.delete'
    ]);


});
