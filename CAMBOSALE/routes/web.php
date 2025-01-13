<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\ProductController; 
use App\Exports\CategoriesExport; 

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

require __DIR__.'/auth.php';

Route::middleware('admin')->group(function () { 
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard']) ->name('admin.dashboard'); 
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile']) ->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore']) ->name ('admin.profile.store'); 
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword']) ->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate']) ->name ('admin.profile.update'); 
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin']) -> name('admin.login'); 
Route::post('/admin/login_submit', [AdminController::class, 'AdminLoginSubmit']) -> name('admin.login_submit'); 
Route::get('/admin/logout', [AdminController::class, 'AdminLogout']) -> name('admin.logout'); 
Route::get('/admin/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('admin.forget_password');
Route::post('/admin/password_submit', [AdminController::class, 'AdminPasswordSubmit']) -> name ('admin.password_submit'); 
Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword']);
Route::post('/admin/reset_password_submit', [AdminController::class, 'AdminResetPasswordSubmit']) -> name ('admin.reset_password_submit'); 

// All about admin Category 

Route::middleware('admin')->group(function () { 
    Route::controller(CategoryController::class) -> group(function() {
        Route::get('/all/category', 'AllCategory') -> name ('all.category'); 
        Route::get('/add/category', 'AddCategory') -> name ('add.category'); 
        Route::post('/store/category', 'StoreCategory') -> name ('category.store'); 
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        Route::get('/filter', [CategoryController::class, 'filter']); 
        Route::get('/export',[App\Http\Controllers\CategoryController::class, 'export']) -> name('export.category'); 
    }); 
});

Route::middleware('admin')->group(function () { 
    Route::controller(ProductController::class) -> group(function() {
        Route::get('/all/product', 'AllProduct') -> name ('all.product'); 
        Route::get('/add/product', 'AddProduct') -> name ('add.product'); 
        // Route::post('/store/category', 'StoreCategory') -> name ('category.store'); 
        // Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        // Route::post('/update/category', 'UpdateCategory')->name('category.update');
        // Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        // Route::get('/filter', [CategoryController::class, 'filter']); 
        // Route::get('/export',[App\Http\Controllers\CategoryController::class, 'export']) -> name('export.category'); 
    }); 
});