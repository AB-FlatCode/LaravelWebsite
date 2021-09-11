<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');

Route::get('/category/all', [CategoryController::class, 'allCategories'])->name('categories');
Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
Route::put('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
Route::get('/category/softdelete/{id}', [CategoryController::class, 'SoftDeleteCategory',])->name('softdelete.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory'])->name('restore.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
Route::get('/brand/all', [BrandController::class, 'allBrands'])->name('brands');
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('/brand/{id}/edit', [BrandController::class, 'editBrand'])->name('edit.brand');
Route::put('/brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');