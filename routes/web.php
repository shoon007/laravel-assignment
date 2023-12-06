<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//error page
Route::get('404error', [AuthController::class, 'errorPage'])->name('errorPage');
//logout
Route::get('/logout', [AuthController::class, 'logout']);

//auth for login page
Route::middleware([
    'admin_auth',
])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/status/change', [ProductController::class, 'statusChange'])->name('admin#statusChange');
    Route::post('create/item', [ProductController::class, 'createItem'])->name('admin#createItem');
    Route::get('addItem/page', [ProductController::class, 'addItem'])->name('admin#addItemPage');
    Route::get('editItem/page/{id}', [ProductController::class, 'editItem'])->name('admin#editItemPage');

    Route::post('updateItem', [ProductController::class, 'updateItem'])->name('admin#updateItem');
    Route::get('deleteItem/{id}', [ProductController::class, 'deleteItem'])->name('admin#deleteItem');
    Route::get('category/list', [CategoryController::class, 'categoryList'])->name('admin#categoryList');
    Route::get('addCategory/page', [CategoryController::class, 'addCategory'])->name('admin#addCategoryPage');
    Route::post('create/category', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('admin/category/status', [CategoryController::class, 'categoryStatus'])->name('admin#categoryStatus');
    Route::get('editCategory/page/{id}', [CategoryController::class, 'editCategory'])->name('admin#editCategoryPage');
    Route::post('updateCategory', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');
    Route::get('delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name("admin#deleteCategory");

});

