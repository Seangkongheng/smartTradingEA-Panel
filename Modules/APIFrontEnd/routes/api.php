<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\APIFrontEnd\App\Http\Controllers\AttachmentController;
use Modules\APIFrontEnd\App\Http\Controllers\MarketplaceController;
use Modules\APIFrontEnd\App\Http\Controllers\OrderController;
use Modules\APIFrontEnd\App\Http\Controllers\RegisterController\RegisterController;
use Modules\APIFrontEnd\App\Http\Controllers\SubcriptionController;
use Modules\Dashboard\App\Models\Attachment;

Route::post('register', [RegisterController::class, 'register']);
Route::post('user/login', [RegisterController::class, 'login']);
Route::post('/verify-login', [RegisterController::class, 'verifyLogin'])->name('verify');
Route::get('/logout', action: [RegisterController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/me', [RegisterController::class, 'username']);

// ------------------------------------marketplace-----------------------------

Route::get('/marketplace', action: [MarketplaceController::class, 'index'])->name('index');
Route::get('/marketplace/{uuid}', [MarketplaceController::class, 'show']);
Route::get('attachment/download/{id}/{fileIndex}', function ($id, $fileIndex) {
    $attachment = Attachment::findOrFail($id);

    $files = json_decode($attachment->file, true);

    if (!isset($files[$fileIndex])) {
        abort(404);
    }

    $file = $files[$fileIndex];

    // Increment download count
    $attachment->total_downloads += 1;
    $attachment->save();

    $path = public_path($file['path']);
    return Response::download($path, $file['name']);
});


// -------------------------------- Attachemnt-------------------------------
Route::get('/attachment', action: [AttachmentController::class, 'index'])->name('index');
// routes/api.php
Route::get('/attachment/download/{id}', [AttachmentController::class, 'download']);


// --------------------------------Order-------------------------------
// Route::post('/order', action: [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->post('order', [OrderController::class, 'store']);
Route::get('/subcription', action: [SubcriptionController::class, 'index']);
Route::get('/order-detail/{uuid}', action: [OrderController::class, 'orderDetail']);
Route::put('/confirm-payment/{uuid}', action: [OrderController::class, 'confirmPayment']);





