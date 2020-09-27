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
Route::get('importUnit','UnitController@insertUnit');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('test_email',function (){
   return 'hello';
})->middleware(['auth','userIsSupport']);
Route::get('tag_test',function (){
  return $aa=\App\Product::with('tags')->find(2000);

});

Route::get('role_test',function (){
    return $aa=\App\User::with('roles')->find(501);

});
