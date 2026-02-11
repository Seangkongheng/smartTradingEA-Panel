<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\App\Http\Controllers\AlbumPhotoController\ResulCategoryController;
use Modules\Dashboard\App\Http\Controllers\AlbumPhotoController\ResulController;
use Modules\Dashboard\App\Http\Controllers\AttachmentController\AttachmentController;
use Modules\Dashboard\App\Http\Controllers\AuthController\AuthController;
use Modules\Dashboard\App\Http\Controllers\CommunityController;
use Modules\Dashboard\App\Http\Controllers\EASettingController\EASettingController;
use Modules\Dashboard\App\Http\Controllers\EducationCategoryController;
use Modules\Dashboard\App\Http\Controllers\EducationController\EducationController;
use Modules\Dashboard\App\Http\Controllers\HomeController\HomeController;
use Modules\Dashboard\App\Http\Controllers\MarketplaceController\MarketplaceController;
use Modules\Dashboard\App\Http\Controllers\MeetingController\MeetingController;
use Modules\Dashboard\App\Http\Controllers\MembershipController\MembershipController;
use Modules\Dashboard\App\Http\Controllers\PlanController;
use Modules\Dashboard\App\Http\Controllers\ProductController\ProductController;
use Modules\Dashboard\App\Http\Controllers\RegisterController\RegisterController;
use Modules\Dashboard\App\Http\Controllers\RewardController\RewardController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SettingController;
use Modules\Dashboard\App\Http\Controllers\SubscribeController\SubscribeController;
use Modules\Dashboard\App\Http\Controllers\UserController\PermissionController;
use Modules\Dashboard\App\Http\Controllers\UserController\RoleController;
use Modules\Dashboard\App\Http\Controllers\UserController\UserController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login/store', [AuthController::class, 'login'])->name('performLogin');
// Routing don't need permission
Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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

    Route::prefix('educations')->name('educations.')->group(function () {
        Route::get('/index', [EducationController::class, 'index'])->name('index');
        Route::get('/show/{id}', [EducationController::class, 'show'])->name('show');
        Route::post('/store', [EducationController::class, 'store'])->name('store');
        Route::get('/create', [EducationController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [EducationController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [EducationController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [EducationController::class, 'edit'])->name('edit');

    });

    Route::prefix('education-categories')->name('education-categories.')->group(function () {
        Route::get('/index', [EducationCategoryController::class, 'index'])->name('index');
        Route::get('/show/{id}', [EducationCategoryController::class, 'show'])->name('show');
        Route::post('/store', [EducationCategoryController::class, 'store'])->name('store');
        Route::get('/create', [EducationCategoryController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [EducationCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [EducationCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [EducationCategoryController::class, 'edit'])->name('edit');

    });
    Route::prefix('ea-setting')->name('eaSettings.')->group(function () {
        Route::get('/index', [EASettingController::class, 'index'])->name('index');
        Route::post('/store', [EASettingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EASettingController::class, 'edit'])->name('edit');
        Route::get('/create', [EASettingController::class, 'create'])->name('create');
        Route::get('/search', [EASettingController::class, 'search'])->name('search');
        Route::delete('/destroy/{id}', [EASettingController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [EASettingController::class, 'update'])->name('update');

    });

    Route::prefix('community')->name('community.')->group(function () {
        Route::get('/index', [CommunityController::class, 'index'])->name('index');
        Route::get('/show/{id}', [CommunityController::class, 'show'])->name('show');
        Route::post('/store', [CommunityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CommunityController::class, 'edit'])->name('edit');
        Route::get('/create', [CommunityController::class, 'create'])->name('create');
        Route::get('/search', [CommunityController::class, 'search'])->name('search');
        Route::delete('/destroy/{id}', [CommunityController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [CommunityController::class, 'update'])->name('update');

    });

    Route::prefix('result-category')->name('result-categories.')->group(function () {
        Route::get('/index', [ResulCategoryController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ResulCategoryController::class, 'show'])->name('show');
        Route::post('/store', [ResulCategoryController::class, 'store'])->name('store');
        Route::get('/create', [ResulCategoryController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [ResulCategoryController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [ResulCategoryController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [ResulCategoryController::class, 'edit'])->name('edit');

    });

    Route::prefix('result-photo')->name('result-photos.')->group(function () {
        Route::get('/index', [ResulController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ResulController::class, 'show'])->name('show');
        Route::post('/store', [ResulController::class, 'store'])->name('store');
        Route::get('/create', [ResulController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [ResulController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [ResulController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [ResulController::class, 'edit'])->name('edit');

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
        Route::get('/show/{id}', [MembershipController::class, 'show'])->name('show');
        Route::get('/create', [MembershipController::class, 'create'])->name('create');
        Route::put('/update/{id}', [MembershipController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [MembershipController::class, 'destroy'])->name('destroy');
        Route::put('/update-account-status/{id}', [MembershipController::class, 'updateAcountStatus'])->name('update-account-status');

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

    // ------------------------------Subscription Update-----------------------------
    Route::put('/update/{id}', [SubscribeController::class, 'update'])->name('update');
});
