<?php

use App\Http\Controllers\dashboard\Admin_panel_settings_Controller;
use App\Http\Controllers\Dashboard\AdminProfileController;
use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\Dashboard\ThemeController;

// ✅ للمشرف المسجل دخوله
Route::middleware('auth:admin')->group(function () {
    Route::get('/', ThemeController::class)->name('index');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // ✅ الأعدادات العامة
    Route::group(['prefix' => 'settings'], function () {
        Route::get('setting', [Admin_panel_settings_Controller::class, 'index'])->name('setting.index');
        Route::get('Shipping_methods/{type}', [Admin_panel_settings_Controller::class, 'editshipping'])->name('setting.editshipping');
        Route::put('Shipping_methods/{id}', [Admin_panel_settings_Controller::class, 'updateshipping'])->name('setting.updateshipping');
    }); // ← ✅ قفلنا مجموعة settings
    // ✅ start Profile Routes
    Route::group(['prefix' => 'profile'], function () {
        Route::get('edit', [AdminProfileController::class, 'editprofile'])->name('profile.edit');
        Route::put('update', [AdminProfileController::class, 'updateprofile'])->name('profile.update');
        Route::put('updatePassword', [AdminProfileController::class, 'updatepassword'])->name('password.update');
    }); // ← End Profile Routes
    // ✅ start categories Routes
    Route::group(['prefix' => 'categories'], function () {
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);
    }); // ← End categories Routes


        // ✅ start Products Routes
    Route::group(['prefix' => 'products'], function () {
        Route::resource('products', ProductController::class)->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);
    }); // ← End Products Routes

}); // ← ✅ قفلنا مجموعة middleware

// ✅ لصفحة تسجيل الدخول للمشرف (لو مش مسجل)
Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'postlogin'])->name('post.login');
});
