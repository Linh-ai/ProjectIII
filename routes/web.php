<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
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


Route::prefix('admin')->group(function() {
    //Route::get('all-users', [UserController::class, 'list'])->name('all_users');

    //category
    Route::get('list-categories', [CategoryController::class, 'list'])->name('all_categories');
    Route::get('add-new-category', [CategoryController::class, 'viewAdd'])->name('add_category');
    Route::post('add-new-category', [CategoryController::class, 'create']);
    Route::get('edit-category/{id}', [CategoryController::class, 'show'])->name('show_category');
    Route::post('edit-category/{id}', [CategoryController::class, 'update']);
    Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete_category');

    //brand
    Route::get('list-brands', [BrandController::class, 'list'])->name('all_brands');
    Route::get('add-new-brand', [BrandController::class, 'viewAdd'])->name('add_brand');
    Route::post('add-new-brand', [BrandController::class, 'create']);
    Route::get('edit-brand/{id}', [BrandController::class, 'show'])->name('show_brand');
    Route::post('edit-brand/{id}', [BrandController::class, 'update']);
    Route::get('delete-brand/{id}', [BrandController::class, 'destroy'])->name('delete_brand');

    //product
    Route::get('list-products', [ProductController::class, 'list'])->name('all_products');
    Route::get('add-new-product', [ProductController::class, 'viewAdd'])->name('add_product');
    Route::post('add-new-product', [ProductController::class, 'create']);
    Route::get('edit-product/{id}', [ProductController::class, 'show'])->name('show_product');
    Route::post('edit-product/{id}', [ProductController::class, 'update']);
    Route::get('delete-product/{id}', [ProductController::class, 'destroy'])->name('delete_product');
});
