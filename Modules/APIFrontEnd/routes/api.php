<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\APIFrontEnd\App\Http\Controllers\AttachmentController;
use Modules\APIFrontEnd\App\Http\Controllers\EASettingController;
use Modules\APIFrontEnd\App\Http\Controllers\MarketplaceController;
use Modules\APIFrontEnd\App\Http\Controllers\MembershipController;
use Modules\APIFrontEnd\App\Http\Controllers\OrderController;
use Modules\APIFrontEnd\App\Http\Controllers\CommunityController;
use Modules\APIFrontEnd\App\Http\Controllers\EducationController;
use Modules\APIFrontEnd\App\Http\Controllers\RegisterController\RegisterController;
use Modules\APIFrontEnd\App\Http\Controllers\ResultCategoryController;
use Modules\APIFrontEnd\App\Http\Controllers\SubcriptionController;
use Modules\Dashboard\App\Models\Attachment;

Route::post('register', [RegisterController::class, 'register']);
// Route::post('user/login', [RegisterController::class, 'login']);

Route::post('user/login', [RegisterController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute

Route::post('/verify-login', [RegisterController::class, 'verifyLogin'])->name('verify');
Route::get('/logout', action: [RegisterController::class, 'logout'])->name(name: 'logout');
Route::middleware('auth:sanctum')->get('/me', [RegisterController::class, 'username']);

// ------------------------------------marketplace-----------------------------

Route::get('/marketplace', action: [MarketplaceController::class, 'index'])->name('index');
Route::get('/marketplace/{uuid}', [MarketplaceController::class, 'show']);
Route::get('attachment/download/{id}/{fileIndex}', function ($id, $fileIndex) {
    $attachment = Attachment::findOrFail($id);

    $files = json_decode($attachment->file, true);

    if (! isset($files[$fileIndex])) {
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
Route::get('/attachment', action: [AttachmentController::class, 'index']);
// routes/api.php
Route::get('/attachment/download/{id}', [AttachmentController::class, 'download']);

// --------------------------------Order-------------------------------
// Route::post('/order', action: [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->post('order', [OrderController::class, 'store']);
Route::middleware('auth:sanctum')->get('/subcription', [SubcriptionController::class, 'index']);

Route::get('/order-detail/{uuid}', action: [OrderController::class, 'orderDetail']);
Route::put('/confirm-payment/{uuid}', action: [OrderController::class, 'confirmPayment']);

// --------------------------ea setting---------------------------------
Route::get('/ea-setting', action: [EASettingController::class, 'index']);
Route::get('/education-categories', action: [EducationController::class, 'getCategory']);
Route::get('/education/videos/{categoryId}', [EducationController::class, 'getVideosByCategory']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/membership/store', action: [MembershipController::class, 'store']);
    Route::get('/membership/get-membership', action: [MembershipController::class, 'getMembership']);
});

Route::get('/result-photo', action: [ResultCategoryController::class, 'index']);
Route::get('/result-photo-categories', action: [ResultCategoryController::class, 'getCategory']);
Route::get('/result-photo/{categoryId}', [ResultCategoryController::class, 'getPhotoByCategory']);
Route::get('/community-photo', action: [CommunityController::class, 'index']);

