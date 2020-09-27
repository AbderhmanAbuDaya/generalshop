<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['middleware'=>['auth','userIsAdmin']],function (){



    Route::get('units','UnitController@index')->name('units');
    Route::post('add-unit','UnitController@store')->name('new-unit');
    Route::delete('delete-unit','UnitController@delete')->name('delete-unit');
        Route::get('search-unit','UnitController@search')->name('search-unit');
    Route::put('update-unit','UnitController@update')->name('update-unit');



    //categories
    Route::get('categories','CategoriesController@index')->name('categories');
    Route::post('add-category','CategoriesController@store')->name('new-category');
    Route::delete('delete-category','CategoriesController@delete')->name('delete-category');
    Route::get('search-category','CategoriesController@search')->name('search-category');
    Route::put('update-category','CategoriesController@update')->name('update-category');


    //products
    Route::get('products','ProductController@index')->name('products');
    Route::get('new-product','ProductController@newProduct')->name('new-product');
    Route::get('edit-product/{id}','ProductController@newProduct')->name('edit-product');
    Route::put('new-product','ProductController@update')->name('new-product');
    Route::post('new-product','ProductController@store')->name('new-product');
    Route::post('delete-image','ProductController@deleteImage')->name('delete-image');

    //tags
    Route::get('tags','TagController@index')->name('tags');
    Route::post('add-tags','TagController@store')->name('new-tags');
    Route::delete('delete-tag','TagController@delete')->name('delete-tag');
    Route::get('search-tag','TagController@search')->name('search-tag');
    Route::put('update-tag','TagController@update')->name('update-tag');


    //countries
    Route::get('countries','CountryController@index')->name('countries');
    Route::post('add-country','CountryController@store')->name('new-country');
    Route::delete('delete-country','CountryController@delete')->name('delete-country');
    Route::get('search-country','CountryController@search')->name('search-country');
    Route::put('update-country','CountryController@update')->name('update-country');
    //cities
    Route::get('cities','CityController@index')->name('cities');
    //states
    Route::get('states','StateController@index')->name('states');
    Route::post('add-state','StateController@store')->name('new-state');
    Route::delete('delete-state','StateController@delete')->name('delete-state');
    Route::get('search-state','StateController@search')->name('search-state');
    Route::put('update-state','StateController@update')->name('update-state');
    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');
    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');
    //roles
    Route::get('roles','RoleController@index')->name('roles');
    Route::post('add-role','RoleController@store')->name('new-role');
    Route::delete('delete-role','RoleController@delete')->name('delete-role');
    Route::get('search-role','RoleController@search')->name('search-role');
    Route::put('update-role','RoleController@update')->name('update-role');






});
