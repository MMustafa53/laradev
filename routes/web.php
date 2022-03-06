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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category/all', 'CategoryController@getAllCategory')->name('all.category');
Route::post('/category/add', 'CategoryController@storeCategory')->name('store.category');
Route::get('/category/edit/{id}', 'CategoryController@editCategory')->name('edit.category');

Route::get('/contact', function () {
    return view('contact');
})->name('con')->middleware('token');

Route::get('about', 'AboutController@index');
//Route::get('contact', 'ContactController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'UserController@getUsers')->name('dashboard');
