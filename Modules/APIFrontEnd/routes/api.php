<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\APIFrontEnd\App\Http\Controllers\AttachmentController;
use Modules\APIFrontEnd\App\Http\Controllers\MarketplaceController;
use Modules\APIFrontEnd\App\Http\Controllers\RegisterController\RegisterController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('user/login', [RegisterController::class, 'login']);
Route::post('/verify-login', [RegisterController::class, 'verifyLogin'])->name('verify');
Route::get('/logout', action: [RegisterController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/me', [RegisterController::class, 'username']);

// ------------------------------------marketplace-----------------------------

Route::get('/marketplace', action: [MarketplaceController::class, 'index'])->name('index');
Route::get('/marketplace/{id}', [MarketplaceController::class, 'show']);


// -------------------------------- Attachemnt-------------------------------

Route::get('/attachment', action: [AttachmentController::class, 'index'])->name('index');




