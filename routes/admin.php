<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\ThemeController;
use Illuminate\Support\Facades\Auth;

// ✅ أولاً: تحويل من "/" إلى "/admin" أو "/admin/login"
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.index');
    }
    return redirect()->route('admin.login');
});

// ✅ راوتات المشرف المسجل دخوله
Route::middleware('auth:admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', ThemeController::class)->name('index');
});

// ✅ راوتات تسجيل الدخول للمشرف
Route::middleware('guest:admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'postlogin'])->name('post.login');
});
