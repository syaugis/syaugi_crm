<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
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

    Route::controller(NotificationController::class)->prefix('notification')->group(function () {
        Route::get('marks-read-all', 'marksAllRead')->name('admin.notification.marks-all-read');
        Route::delete('clear-all', 'clearAll')->name('admin.notification.clear-all');
        Route::get('{id}', 'show')->name('admin.notification.show');
        Route::delete('{id}', 'destroy')->name('admin.notification.destroy');
    });

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

    Route::controller(LeadController::class)->middleware('check.permissions')->prefix('lead')->group(function () {
        Route::get('', 'index')->name('admin.lead.index');
        Route::get('export', 'export')->name('admin.lead.export');
        Route::get('download-template', 'template')->name('admin.lead.template');
        Route::post('import', 'import')->name('admin.lead.import');
        Route::get('create', 'create')->name('admin.lead.create');
        Route::post('', 'store')->name('admin.lead.store');
        Route::get('{lead}/edit', 'edit')->name('admin.lead.edit');
        Route::put('{lead}', 'update')->name('admin.lead.update');
        Route::delete('{lead}', 'destroy')->name('admin.lead.destroy');
    });

    Route::controller(ProjectController::class)->middleware('check.permissions')->prefix('project')->group(function () {
        Route::get('', 'index')->name('admin.project.index');
        Route::get('export', 'export')->name('admin.project.export');
        Route::get('create', 'create')->name('admin.project.create');
        Route::post('', 'store')->name('admin.project.store');
        Route::get('{project}/edit', 'edit')->name('admin.project.edit');
        Route::put('{project}', 'update')->name('admin.project.update');
        Route::delete('{project}', 'destroy')->name('admin.project.destroy');
    });

    Route::controller(CustomerController::class)->middleware('check.permissions')->prefix('customer')->group(function () {
        Route::get('', 'index')->name('admin.customer.index');
        Route::get('export', 'export')->name('admin.customer.export');
        Route::get('show/{customer}', 'show')->name('admin.customer.show');
        Route::delete('{customer}', 'destroy')->name('admin.customer.destroy');
    });
});
