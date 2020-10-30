<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect('products');
})->name('home');

Route::put('product/archive', 'App\Http\Controllers\ProductController@archive')->name('product.archive');
Route::post('product/delete', 'App\Http\Controllers\ProductController@delete')->name('product.delete');
Route::post('product/restore', 'App\Http\Controllers\ProductController@restore')->name('product.restore');

Route::get('products/archived', 'App\Http\Controllers\ProductController@archived')->name('products.archived');
Route::get('products/deleted', 'App\Http\Controllers\ProductController@deleted')->name('products.deleted');
Route::resource('products', 'App\Http\Controllers\ProductController');
