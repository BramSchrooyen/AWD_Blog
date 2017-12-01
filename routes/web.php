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
    return view('layouts.master');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', [
    'uses' => 'BlogController@getBlogIndex',
    'as' => 'content.blogindex'
]);

Route::get('blog/{id}', [
    'uses' => 'BlogController@getBlog',
    'as' => 'content.blog'
]);


Route::group(['prefix' => 'admin'], function (){

    Route::get('', [
        'uses' => 'BlogController@getAdminHome',
        'as' => 'admin.home'
    ]);

    Route::get('create', [
        'uses' => 'BlogController@getAdminCreate',
        'as' => 'admin.create'
    ]);


    Route::post('create', [
        'uses' => 'BlogController@postAdminCreate',
        'as' => 'admin.create'
    ]);


    Route::get('edit/{id}', [
        'uses' => 'BlogController@postAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'BlogController@postAdminUpdate',
        'as' => 'admin.update'
    ]);


    Route::post('delete', [
        'uses' => 'BlogController@postAdminDelete',
        'as' => 'admin.delete'
    ]);


});