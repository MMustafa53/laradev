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
// Category Route
Route::get('/category/all', 'CategoryController@getAllCategory')->name('all.category');
Route::post('/category/add', 'CategoryController@storeCategory')->name('store.category');
Route::get('/category/edit/{id}', 'CategoryController@editCategory')->name('edit.category');
Route::post('/category/update/{id}', 'CategoryController@updateCategory')->name('update.category');
Route::get('/category/restore/{id}', 'CategoryController@restoreCategory')->name('restore.category');
Route::get('/category/permanent-delete/{id}', 'CategoryController@permanentDeleteCategory')->name('permanent.category');
Route::get('/category/delete/{id}', 'CategoryController@deleteCategory');
// Brand Route
Route::get('/brand/all', 'BrandController@getAllBrand')->name('all.brand');
Route::post('/brand/add', 'BrandController@storeBrand')->name('store.brand');
Route::get('/brand/edit/{id}', 'BrandController@editBrand')->name('edit.brand');
Route::post('/brand/update/{id}', 'BrandController@updateBrand')->name('update.brand');
Route::get('/brand/restore/{id}', 'BrandController@restoreBrand')->name('restore.brand');
Route::get('/brand/permanent-delete/{id}', 'BrandController@permanentDeleteBrand')->name('permanent.brand');
Route::get('/brand/delete/{id}', 'BrandController@deleteBrand');

Route::get('/contact', function () {
    return view('contact');
})->name('con')->middleware('token');

Route::get('about', 'AboutController@index');
//Route::get('contact', 'ContactController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'UserController@getUsers')->name('dashboard');
