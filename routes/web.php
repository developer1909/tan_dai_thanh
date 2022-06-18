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

Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'categories'], function () {
    Route::get('', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('categories.index');
    Route::post('', [\App\Http\Controllers\Admin\CategoriesController::class, 'save'])->name('categories.save');
    Route::post('delete-price', [\App\Http\Controllers\Admin\CategoriesController::class, 'delete'])->name('categories.delete');
});
Route::group(['prefix' => 'products'], function () {
    Route::get('', [\App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('products.index');
    Route::get('ajax-list-product', [\App\Http\Controllers\Admin\ProductsController::class, 'ajaxListProduct'])->name('products.by.category');
    Route::post('', [\App\Http\Controllers\Admin\ProductsController::class, 'save'])->name('products.save');
    Route::post('delete-product', [\App\Http\Controllers\Admin\ProductsController::class, 'delete'])->name('products.delete');
});
Route::group(['prefix' => 'orders'], function () {
    Route::get('', [\App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('orders.index');
    Route::get('create', [\App\Http\Controllers\Admin\OrdersController::class, 'formOrder'])->name('orders.create');

    Route::get('edit/{id}', [\App\Http\Controllers\Admin\OrdersController::class, 'formOrder'])->name('orders.edit');
    Route::post('save', [\App\Http\Controllers\Admin\OrdersController::class, 'saveFormOrder'])->name('orders.save');

    Route::post('add-product-order', [\App\Http\Controllers\Admin\OrdersController::class, 'addProductToOrder'])->name('orders.add.product');
    Route::post('add-product-edit-order', [\App\Http\Controllers\Admin\OrdersController::class, 'addProductToEditOrder'])->name('orders.add.edit.product');
    Route::get('remove-product-order', [\App\Http\Controllers\Admin\OrdersController::class, 'removeProductOrder'])->name('orders.remove.product');
//    Route::post('', [\App\Http\Controllers\Admin\ProductsController::class, 'save'])->name('products.save');
//    Route::post('delete-product', [\App\Http\Controllers\Admin\ProductsController::class, 'delete'])->name('products.delete');
});
