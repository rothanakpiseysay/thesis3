<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
// Route::get('/staff/dashboard',[StaffController::class,'dashboard'])->name('staff.dashboard');

//admin routes
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
});
//agent routes
Route::middleware(['auth','role:staff'])->group(function () {
    Route::get('/staff/dashboard',[StaffController::class,'dashboard'])->name('staff.dashboard');
});

Route::get('/admin/brand', [BrandsController::class, 'index'])->name("brand.list");
Route::get('/admin/brand/create', [BrandsController::class, 'create'])->name("brand.create");
Route::post('/admin/brand', [BrandsController::class, 'store'])->name("brand.store");
Route::get("/admin/brand/{brandId}/edit", [BrandsController::class, 'edit'])->name('brand.edit');
Route::put("/admin/brand/{brandId}", [BrandsController::class, 'update'])->name('brand.update');
Route::delete("/admin/brand/{brandId}", [BrandsController::class, 'destroy'])->name('brand.delete');
Route::get('/admin/brand/{brandId}', [BrandsController::class, 'show'])->name("brand.show");
Route::get('/admin/brand', [BrandsController::class, 'search'])->name('brands.search');

Route::get('/admin/category', [CategoryController::class, 'index'])->name("category.list");
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name("category.create");
Route::post('/admin/category', [CategoryController::class, 'store'])->name("category.store");
Route::get("/admin/category/{categoryId}/edit", [CategoryController::class, 'edit'])->name('category.edit');
Route::put("/admin/category/{categoryId}", [CategoryController::class, 'update'])->name('category.update');
Route::delete("/admin/category/{categoryId}", [CategoryController::class, 'destroy'])->name('category.delete');
Route::get('/admin/category/{cateId}', [CategoryController::class, 'show'])->name("category.show");
// Route::get('/admin/category', [CategoryController::class, 'search'])->name('category.search');

require __DIR__.'/auth.php';
