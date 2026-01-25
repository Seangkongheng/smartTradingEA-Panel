<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\App\Http\Controllers\AttachmentController\AttachmentController;
use Modules\Dashboard\App\Http\Controllers\HomeController\HomeController;
use Modules\Dashboard\App\Http\Controllers\RegisterController\RegisterController;
use Modules\Dashboard\App\Http\Controllers\SubscribeController\SubscribeController;
use Modules\Dashboard\App\Http\Controllers\UserController\UserController;
use Modules\Dashboard\App\Http\Controllers\AuthController\AuthController;
use Modules\Dashboard\App\Http\Controllers\MarketplaceController\MarketplaceController;
use Modules\Dashboard\App\Http\Controllers\MeetingController\MeetingController;
use Modules\Dashboard\App\Http\Controllers\MembershipController\MembershipController;
use Modules\Dashboard\App\Http\Controllers\PlanController;
use Modules\Dashboard\App\Http\Controllers\ProductController\ProductController;
use Modules\Dashboard\App\Http\Controllers\RewardController\RewardController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SettingController;
use Modules\Dashboard\App\Http\Controllers\UserController\PermissionController;
use Modules\Dashboard\App\Http\Controllers\UserController\RoleController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login/store', [AuthController::class, 'login'])->name('performLogin');
// Routing don't need permission
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('admin')->name('admin.')->group(function () {
        // Home Route
        Route::get('/', [HomeController::class, 'index'])->name('index');

        // User Routes
        Route::prefix('user')->name('user.')->group(function () {
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('/block/{id}', [UserController::class, 'block'])->name('block');
            Route::post('/unblock/{id}', [UserController::class, 'unblock'])->name('unblock');
            Route::get('/search', [UserController::class, 'searchUser'])->name('search');
        });

        // Role Routes
        Route::prefix('role')->name('role.')->group(function () {
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        });

        // permission Routes
        Route::prefix('permission')->name('permission.')->group(function () {
            Route::post('/store', [PermissionController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
        });

        // Setting Route
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/index', [SettingController::class, 'index'])->name('index');
        });
    });
});


// Routing  need permission

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware(['auth', 'permission.clean'])->group(function () {
            // Role Routes
            Route::prefix('role')->name('role.')->group(function () {
                Route::get('/index', [RoleController::class, 'index'])->name('index');
                Route::get('/create', [RoleController::class, 'create'])->name('create');
                Route::get('/show/{id}', [RoleController::class, 'show'])->name('show');
                Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
            });

            // permission Routes
            Route::prefix('permission')->name('permission.')->group(function () {
                Route::get('/index', [PermissionController::class, 'index'])->name('index');
                Route::get('/create', [PermissionController::class, 'create'])->name('create');
                Route::get('/show/{id}', [PermissionController::class, 'show'])->name('show');
                Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
            });
        });
    });
});


Route::prefix('admin')->name('admin.')->group(function () {
    // User Routes
    Route::prefix('attachment')->name('attachment.')->group(function () {
        Route::get('/index', [AttachmentController::class, 'index'])->name('index');
        Route::post('/store', [AttachmentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AttachmentController::class, 'edit'])->name('edit');
        Route::get('/create', [AttachmentController::class, 'create'])->name('create');
        Route::get('/search', [AttachmentController::class, 'search'])->name('search');
        Route::delete('/destroy/{id}', [AttachmentController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [AttachmentController::class, 'update'])->name('update');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
    });
    Route::prefix('marketplace')->name('marketplace.')->group(function () {
        Route::get('/index', [MarketplaceController::class, 'index'])->name('index');
        Route::get('/show/{id}', [MarketplaceController::class, 'show'])->name('show');
        Route::post('/store', [MarketplaceController::class, 'store'])->name('store');
        Route::get('/create', [MarketplaceController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [MarketplaceController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [MarketplaceController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [MarketplaceController::class, 'edit'])->name('edit');

    });
    Route::prefix('plan')->name('plan.')->group(function () {
        Route::get('/index', [PlanController::class, 'index'])->name('index');
        Route::post('/store', [PlanController::class, 'store'])->name('store');
        Route::get('/create', [PlanController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('edit');
        Route::delete('/destroy/{id}', [PlanController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [PlanController::class, 'update'])->name('update');
    });
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/index', [RegisterController::class, 'index'])->name('index');
        Route::get('/create', [RegisterController::class, 'create'])->name('create');
        Route::get('/show/{id}', [RegisterController::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [RegisterController::class, 'destroy'])->name('destroy');

    });
    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/index', [MembershipController::class, 'index'])->name('index');
        Route::get('/create', [MembershipController::class, 'create'])->name('create');
    });

    Route::prefix('meeting')->name('meeting.')->group(function () {
        Route::get('/index', [MeetingController::class, 'index'])->name('index');
        Route::get('/create', [MeetingController::class, 'create'])->name('create');
    });
    Route::prefix('subscribe')->name('subscribes.')->group(function () {
        Route::get('/index', [SubscribeController::class, 'index'])->name('index');
        Route::get('/show/{id}', [SubscribeController::class, 'show'])->name('show');
    });

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // User Routes
    Route::prefix('reward')->name('reward.')->group(function () {
        Route::get('/index', [RewardController::class, 'index'])->name('index');
        Route::get('/create', [RewardController::class, 'create'])->name('create');
        Route::get('/show/{id}', [RewardController::class, 'show'])->name('show');
        Route::put('/update/{id}', [RewardController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [RewardController::class, 'destroy'])->name('destroy');
    });
});
