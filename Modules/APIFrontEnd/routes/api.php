<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\APIFrontEnd\App\Http\Controllers\RegisterController\RegisterController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('user/login', [RegisterController::class, 'login']);
Route::get('/verify-login', [RegisterController::class, 'verifyLogin'])->name('verify');





