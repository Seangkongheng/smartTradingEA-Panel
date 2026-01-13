<?php
use App\Http\Controllers\HomeController\HomeController;
use Illuminate\Support\Facades\Route;
use Modules\Dashboard\App\Http\Controllers\AuthController\AuthController;
use Modules\Dashboard\App\Http\Controllers\HomeController\HomeController as ControllersHomeController;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login/store', [AuthController::class, 'login'])->name('performLogin');

// Routing don't need permission
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [ControllersHomeController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('admin')->name('admin.')->group(function () {
    });
});



Route::fallback(function () {
    return view('dashboard::components.404');
});


