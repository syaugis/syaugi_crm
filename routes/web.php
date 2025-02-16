<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*------------------------------------------
--------------------------------------------
All Authentication Routes List
--------------------------------------------
--------------------------------------------*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('login',  'login')->name('login.submit');
    Route::post('logout',  'logout')->name('logout');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(ProductController::class)->middleware('check.permissions')->prefix('product')->group(function () {
        Route::get('', 'index')->name('admin.product.index');
        Route::get('export', 'export')->name('admin.product.export');
        Route::get('download-template', 'template')->name('admin.product.template');
        Route::post('import', 'import')->name('admin.product.import');
        Route::get('create', 'create')->name('admin.product.create');
        Route::post('', 'store')->name('admin.product.store');
        Route::get('{product}/edit', 'edit')->name('admin.product.edit');
        Route::put('{product}', 'update')->name('admin.product.update');
        Route::delete('{product}', 'destroy')->name('admin.product.destroy');
    });
});
