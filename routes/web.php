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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/users', 'UserController@index')->name('users.all');
Route::resource('users', 'UserController')->middleware(['auth','auth.admin'])->names([
    'index' => 'users.index',
    'create' => 'users.create',
    'store' => 'users.store',
    'edit' => 'users.edit',
    'update' => 'users.update',
    'destroy' => 'users.destroy'
]);
Route::get('products/search', function(){
    return response()->json([['title'=> 'Mojarra', 'url' => '', 'id'=>1]]);
});
Route::resource('products', 'ProductController')->names([
    'index' => 'products.index',
    'create' => 'products.create',
    'store' => 'products.store',
    'edit' => 'products.edit',
    'update' => 'products.update',
    'destroy' => 'products.destroy',
    'show' => 'products.show'
]);

Route::resource('stock', 'StockEntryController')->names([
    'index' => 'stock.index',
    'store' => 'stock.store',
    'destroy' => 'stock.destroy'
]);

Route::get('sale', 'SaleController@index')->name('sales.sale');

