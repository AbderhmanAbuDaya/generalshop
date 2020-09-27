<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>'auth:api'],function (){

});
    //Gat categories
Route::get('categories','api\CategoryController@index');
Route::get('categories/{id}','api\CategoryController@show');
    //Get Tags
Route::get('tags','api\TagController@index');
Route::get('tags/{id}','api\TagController@show');
   //Get products
Route::get('products','api\ProductController@index');
Route::get('products/{id}','api\ProductController@show');
   //general routs
Route::get('countries','api\CountriesController@index');
Route::get('countries/{id}','api\CountriesController@show');
Route::get('countries/{id}/cities','api\CountriesController@showCities');
Route::get('countries/{id}/states','api\CountriesController@showStates');

Route::post('auth/register','api\AuthController@register');
Route::post('auth/login','api\AuthController@login');

Route::get('/users',function (){
    return \App\Http\Resources\UserFullResource::collection(\App\User::paginate());
});
