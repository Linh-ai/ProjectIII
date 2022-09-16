<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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
});
