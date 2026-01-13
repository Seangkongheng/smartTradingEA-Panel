<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\App\Http\Controllers\AttachmentController\AttachmentController;
use Modules\Dashboard\App\Http\Controllers\HomeController\HomeController;
use Modules\Dashboard\App\Http\Controllers\LessionController\LessionController;
use Modules\Dashboard\App\Http\Controllers\NewsController\NewsController;
use Modules\Dashboard\App\Http\Controllers\RegisterController\RegisterController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\TeacherController;
use Modules\Dashboard\App\Http\Controllers\SchoolPartner\TeacherPartnerController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SocailPlatformController;
use Modules\Dashboard\App\Http\Controllers\UserController\UserController;
use Modules\Dashboard\App\Http\Controllers\AuthController\AuthController;
use Modules\Dashboard\App\Http\Controllers\LibraryController\LibraryController;
use Modules\Dashboard\App\Http\Controllers\MarketplaceController\MarketplaceController;
use Modules\Dashboard\App\Http\Controllers\MembershipController\MembershipController;
use Modules\Dashboard\App\Http\Controllers\ProductController\ProductController;
use Modules\Dashboard\App\Http\Controllers\ProfessorController\ProfessorController;
use Modules\Dashboard\App\Http\Controllers\ProjectController\ProjectController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\ClassCategoryController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\SchoolController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\ClassController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\MajorsController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\StreamingController;
use Modules\Dashboard\App\Http\Controllers\SchoolController\VideoStreamingController;
use Modules\Dashboard\App\Http\Controllers\SettingController\AboutController;
use Modules\Dashboard\App\Http\Controllers\SettingController\ContactController;
use Modules\Dashboard\App\Http\Controllers\SettingController\FooterController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SectionLivePageController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SectionTtitleController;
use Modules\Dashboard\App\Http\Controllers\SettingController\SettingController;
use Modules\Dashboard\App\Http\Controllers\StudentController\StudentController;
use Modules\Dashboard\App\Http\Controllers\UserController\PermissionController;
use Modules\Dashboard\App\Http\Controllers\UserController\RoleController;
use Modules\Dashboard\App\Http\Controllers\SchoolPartner\ClassLevelController;
use Modules\Dashboard\App\Http\Controllers\SchoolPartner\MajorPartnerController;
use Modules\Dashboard\App\Http\Controllers\SchoolPartner\SchoolPartnerController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login/store', [AuthController::class, 'login'])->name('performLogin');
Route::post('/store', [StudentController::class, 'store'])->name('admin.student.store');
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

        // Lession Routes
        Route::prefix('lession')->name('lession.')->group(function () {
            Route::get('/index', [LessionController::class, 'index'])->name('index');
        });

        // setting Title Routes
        Route::prefix('title')->name('title.')->group(function () {
            Route::get('/edit/{id}', [SectionTtitleController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SectionTtitleController::class, 'update'])->name('update');
        });
        // setting  live pages Routes
        Route::prefix('page-live')->name('pageLive.')->group(function () {
            Route::get('/edit/{id}', [SectionLivePageController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SectionLivePageController::class, 'update'])->name('update');
        });

        // Professor Routes
        Route::prefix('professor')->name('professor.')->group(function () {
            Route::post('/store', [ProfessorController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProfessorController::class, 'edit'])->name('edit');
            Route::get('/search-professor', [ProfessorController::class, 'professorSearch'])->name('search');
        });

        // Teacher Route
        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::post('/store', [TeacherController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit');
            Route::get('/search-teacher', [TeacherController::class, 'teacherSearch'])->name('search');
            Route::get('/get-major/{school_id}', [TeacherController::class, 'getMajors'])->name('getMajors');
        });

        // Teacher partner Route
        Route::prefix('teacher-partner')->name('teacher-partner.')->group(function () {
            Route::post('/store', [TeacherPartnerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TeacherPartnerController::class, 'edit'])->name('edit');
            Route::get('/search-teacher', [TeacherPartnerController::class, 'teacherSearch'])->name('search');
            Route::get('/get-major/{school_id}', [TeacherPartnerController::class, 'getMajors'])->name('getMajors');
        });

        //   Teacher partner Route
        Route::prefix('teacher-partner')->name('teacher-partner.')->group(function () {
            Route::get('/index', [TeacherPartnerController::class, 'index'])->name('index');
            Route::get('/create', [TeacherPartnerController::class, 'create'])->name('create');
            Route::get('/show/{id}', [TeacherPartnerController::class, 'show'])->name('show');
            Route::put('/update/{id}', [TeacherPartnerController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [TeacherPartnerController::class, 'destroy'])->name('destroy');
        });


        // Socail Platform Routes
        Route::prefix('platform')->name('platform.')->group(function () {
            Route::post('/store', [SocailPlatformController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SocailPlatformController::class, 'edit'])->name('edit');
        });


        // Class Routes
        Route::prefix('class')->name('class.')->group(function () {
            Route::post('/store', [ClassController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ClassController::class, 'edit'])->name('edit');
            Route::get('/search-class', [ClassController::class, 'classSearch'])->name('search');
        });

        // Class Category
        Route::prefix('category')->name('category.')->group(function () {
            Route::post('/store', [ClassCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ClassCategoryController::class, 'edit'])->name('edit');
            Route::get('/search-category', [ClassCategoryController::class, 'categorySearch'])->name('search');
        });

        // Major Routes
        Route::prefix('major')->name('major.')->group(function () {
            Route::post('/store', [MajorsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [MajorsController::class, 'edit'])->name('edit');
            Route::get('/search-major', [MajorsController::class, 'majorSearch'])->name('search');
        });

        // Major partner Routes
        Route::prefix('major-partner')->name('major-partner.')->group(function () {
            Route::post('/store', [MajorPartnerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [MajorPartnerController::class, 'edit'])->name('edit');
            Route::get('/search-major', [MajorPartnerController::class, 'majorSearch'])->name('search');
        });

        // Major partner Routes
        Route::prefix('major-partner')->name('major-partner.')->group(function () {
            Route::get('/index', [MajorPartnerController::class, 'index'])->name('index');
            Route::get('/create', [MajorPartnerController::class, 'create'])->name('create');
            Route::get('/show/{id}', [MajorPartnerController::class, 'show'])->name('show');
            Route::put('/update/{id}', [MajorPartnerController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [MajorPartnerController::class, 'destroy'])->name('destroy');
        });

        // school Routes
        Route::prefix('school')->name('school.')->group(function () {
            Route::post('/store', [SchoolController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SchoolController::class, 'edit'])->name('edit');
            Route::get('/search-school', [SchoolController::class, 'schoolSearch'])->name('search');
        });

        // News Routes
        Route::prefix('news')->name('news.')->group(function () {
            Route::post('/store', [NewsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
            Route::get('/search-news', [NewsController::class, 'newsSearch'])->name('search');
        });

        // Library Routes
        Route::prefix('library')->name('library.')->group(function () {
            Route::get('/index', [LibraryController::class, 'index'])->name('index');
            Route::get('/create', [LibraryController::class, 'create'])->name('create');
            Route::get('/show', [LibraryController::class, 'show'])->name('show');
        });

        // Streaming Routes
        Route::prefix('streaming')->name('streaming.')->group(function () {
            Route::get('/show/{id}', [StreamingController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [StreamingController::class, 'edit'])->name('edit');
            Route::post('/store', [StreamingController::class, 'store'])->name('store');
            Route::get('/search-streaming', [StreamingController::class, 'streamingSearch'])->name('search');
        });


        // Setting Route
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/index', [SettingController::class, 'index'])->name('index');
        });

        // Contact Route
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::post('/store', [ContactController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('edit');
        });

        // footer Route
        Route::prefix('footer')->name('footer.')->group(function () {
            Route::post('/store', [FooterController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FooterController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [FooterController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [FooterController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('about')->name('about.')->group(function () {
            Route::post('/store', [AboutController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AboutController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [AboutController::class, 'destroy'])->name('destroy');
        });

        // Ajax Routing of Streaming Controller
        Route::prefix('streaming')->name('streaming.')->group(function () {
            Route::get('{school_id}/class', [StreamingController::class, 'class'])->name('class');
            Route::get('{school_id}/major', [StreamingController::class, 'major'])->name('major');
            Route::get('{class_id}/class_category', [StreamingController::class, 'classCategory'])->name('class_category');
            Route::get('{school_id}/teacher', [StreamingController::class, 'teacher'])->name('teacher');
            Route::delete('/comments/destroy/{id}', [StreamingController::class, 'destroyComment'])->name('comments.destroy');

        });


        Route::prefix(('student'))->name('student.')->group(function () {
            Route::get('index', [StudentController::class, 'index'])->name('index');
            Route::get('/create', [StudentController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [StudentController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
            Route::get('/search', [StudentController::class, 'classLevelSearch'])->name('search');
        });


        Route::prefix('class-level')->name('class-level.')->group(function () {
            Route::get('/index', [ClassLevelController::class, 'index'])->name('index');
            Route::get('/create', [ClassLevelController::class, 'create'])->name('create');
            Route::post('/store', [ClassLevelController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ClassLevelController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ClassLevelController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ClassLevelController::class, 'destroy'])->name('destroy');
            Route::get('/search', [ClassLevelController::class, 'classLevelSearch'])->name('search');
        });

        Route::prefix('school-partner')->name('school-partner.')->group(function () {
            Route::get('/index', [SchoolPartnerController::class, 'index'])->name('index');
            Route::get('/create', [SchoolPartnerController::class, 'create'])->name('create');
            Route::post('/store', [SchoolPartnerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SchoolPartnerController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SchoolPartnerController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SchoolPartnerController::class, 'destroy'])->name('destroy');
            Route::get('/analytice/{id}', [SchoolPartnerController::class, 'analytice'])->name('analytice');

            Route::get('/search', [SchoolPartnerController::class, 'classLevelSearch'])->name('search');
        });

        Route::prefix('project')->name('project.')->group(function () {
            Route::get('/index', [ProjectController::class, 'index'])->name('index');
            Route::get('/create', [ProjectController::class, 'create'])->name('create');
            Route::post('/store', [ProjectController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ProjectController::class, 'destroy'])->name('destroy');
            Route::get('/search', [ProjectController::class, 'classLevelSearch'])->name('search');
        });

        // video Streaming Routes
        Route::prefix('video-streaming')->name('video-streaming.')->group(function () {
            Route::get('/index', [VideoStreamingController::class, 'index'])->name('index');
            Route::get('{province_id}/class', [VideoStreamingController::class, 'getSchoolOfProvince'])->name('get-school');
            Route::get('/teacher-get/{project_id}', [VideoStreamingController::class, 'getTeacherOfProject'])->name('get-teacher');
            Route::get('/major-get/{project_id}', [VideoStreamingController::class, 'getMajorOfProject'])->name('get-major');
            Route::delete('/comments-partner/destroy/{id}', [VideoStreamingController::class, 'destroyComment'])->name('comment-partner.destroy');
            Route::delete('comment/reply/{id}', [VideoStreamingController::class, 'destroyReply'])
                ->name('comment-partner.reply.destroy');


            Route::get('/create', [VideoStreamingController::class, 'create'])->name('create');
            Route::get('/show/{id}', [VideoStreamingController::class, 'show'])->name('show');
            Route::put('/update/{id}', [VideoStreamingController::class, 'update'])->name('update');
            Route::get('/edit/{id}', [VideoStreamingController::class, 'edit'])->name('edit');

            Route::post('/store', [VideoStreamingController::class, 'store'])->name('store');
            Route::delete('/destroy/{id}', [VideoStreamingController::class, 'destroy'])->name('destroy');
            Route::get('/analytice/{id}', [VideoStreamingController::class, 'analytice'])->name('analytice');
            Route::get('/search', [VideoStreamingController::class, 'search'])->name('search');
            Route::get('/data', [VideoStreamingController::class, 'data'])->name('data');
            Route::get('/export-data', [VideoStreamingController::class, 'dataExport'])->name('export-data');
            Route::get('/filter-data', [VideoStreamingController::class, 'dataFilter'])->name('filter-data');


            Route::get('/export-start', [VideoStreamingController::class, 'startExport']);
            Route::get('/export-progress', [VideoStreamingController::class, 'exportProgress']);
            Route::get('{videoId}/search-student', [VideoStreamingController::class, 'studentSearch'])->name('student-search-video');



        });
    });
});


// Routing  need permission

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware(['auth', 'permission.clean'])->group(function () {

            // User Routes
            Route::prefix('user')->name('user.')->group(function () {
                Route::get('/index', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
                Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
            });

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


            // Professor Routes
            Route::prefix('professor')->name('professor.')->group(function () {
                Route::get('/index', [ProfessorController::class, 'index'])->name('index');
                Route::get('/create', [ProfessorController::class, 'create'])->name('create');
                Route::get('/show/{id}', [ProfessorController::class, 'show'])->name('show');
                Route::put('/update/{id}', [ProfessorController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [ProfessorController::class, 'destroy'])->name('destroy');
            });

            // Teacher Route
            Route::prefix('teacher')->name('teacher.')->group(function () {
                Route::get('/index', [TeacherController::class, 'index'])->name('index');
                Route::get('/create', [TeacherController::class, 'create'])->name('create');
                Route::get('/show/{id}', [TeacherController::class, 'show'])->name('show');
                Route::put('/update/{id}', [TeacherController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [TeacherController::class, 'destroy'])->name('destroy');
            });

            // Class Routes
            Route::prefix('class')->name('class.')->group(function () {
                Route::get('/index', [ClassController::class, 'index'])->name('index');
                Route::get('/create', [ClassController::class, 'create'])->name('create');
                Route::get('/show/{id}', [ClassController::class, 'show'])->name('show');
                Route::put('/update/{id}', [ClassController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [ClassController::class, 'destroy'])->name('destroy');
            });

            // Class Category
            Route::prefix('category')->name('category.')->group(function () {
                Route::get('/index', [ClassCategoryController::class, 'index'])->name('index');
                Route::get('/create', [ClassCategoryController::class, 'create'])->name('create');
                Route::get('/show/{id}', [ClassCategoryController::class, 'show'])->name('show');
                Route::put('/update/{id}', [ClassCategoryController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [ClassCategoryController::class, 'destroy'])->name('destroy');
            });


            // Major Routes
            Route::prefix('major')->name('major.')->group(function () {
                Route::get('/index', [MajorsController::class, 'index'])->name('index');
                Route::get('/create', [MajorsController::class, 'create'])->name('create');
                Route::get('/show/{id}', [MajorsController::class, 'show'])->name('show');
                Route::put('/update/{id}', [MajorsController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [MajorsController::class, 'destroy'])->name('destroy');
            });

            // school Routes
            Route::prefix('school')->name('school.')->group(function () {
                Route::get('/index', [SchoolController::class, 'index'])->name('index');

                Route::get('/create', [SchoolController::class, 'create'])->name('create');
                Route::get('/show/{id}', [SchoolController::class, 'show'])->name('show');
                Route::put('/update/{id}', [SchoolController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [SchoolController::class, 'destroy'])->name('destroy');
                Route::get('/get-classes/{school_id}', [SchoolController::class, 'getMajors']);
            });

            // News Routes
            Route::prefix('news')->name('news.')->group(function () {
                Route::get('/index', [NewsController::class, 'index'])->name('index');
                Route::get('/create', [NewsController::class, 'create'])->name('create');
                Route::get('/show/{id}', [NewsController::class, 'show'])->name('show');
                Route::put('/update/{id}', [NewsController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [NewsController::class, 'destroy'])->name('destroy');
            });
            // Contact Route
            Route::prefix('contact')->name('contact.')->group(function () {
                Route::get('/index', [ContactController::class, 'index'])->name('index');
                Route::get('/show/{id}', [ContactController::class, 'show'])->name('show');
                Route::put('/update/{id}', [ContactController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [ContactController::class, 'destroy'])->name('destroy');
            });

            // Socail Platform Routes
            Route::prefix('platform')->name('platform.')->group(function () {
                Route::get('/index', [SocailPlatformController::class, 'index'])->name('index');
                Route::get('/create', [SocailPlatformController::class, 'create'])->name('create');
                Route::get('/show/{id}', [SocailPlatformController::class, 'show'])->name('show');
                Route::put('/update/{id}', [SocailPlatformController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [SocailPlatformController::class, 'destroy'])->name('destroy');
            });

            // Streaming Routes
            Route::prefix('streaming')->name('streaming.')->group(function () {
                Route::get('/index', [StreamingController::class, 'index'])->name('index');
                Route::get('/create', [StreamingController::class, 'create'])->name('create');
                Route::get('/show/{id}', [StreamingController::class, 'show'])->name('show');
                Route::put('/update/{id}', [StreamingController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [StreamingController::class, 'destroy'])->name('destroy');
            });




        });
    });
});

Route::get('/analytices/{id}', action: [SchoolController::class, 'analytices'])->name('admin.school.analytices');
// web.php
Route::get('/get-class-categories/{classId}', [SchoolController::class, 'getClassCategories'])->name('get.class.categories');
Route::post('/school/{id}/analytics/filter', [SchoolController::class, 'analyticsFilter'])->name('school.analytics.filter');
Route::get('/schools/info/{id}', [SchoolController::class, 'getSchoolInfo'])->name('schools.info');

Route::get('/schools/{school}/class/{class}/info', [SchoolController::class, 'getClassInfo']);
Route::get('/schools/{school}/major/{class}/info', [SchoolController::class, 'getMajorInfo']);
Route::get('/schools/{school}/{class}/caregory/{category}/info', [SchoolController::class, 'getCategoryOfClassInfo']);
Route::get('/schools/custome-day/info/{id}', [SchoolController::class, 'getCustomeDayInfo'])->name('custome_day.info');
Route::get('/defaul-info/custome-day/info', [SchoolController::class, 'getCustomeDayInfoForDefault'])->name('custome_day_default.info');
Route::post('/move-up/{id}', [SchoolController::class, 'moveUp'])->name('school.moveUp');
Route::post('/move-down/{id}', [SchoolController::class, 'moveDown'])->name('school.moveDown');




Route::prefix('admin')->name('admin.')->group(function () {
    // User Routes
    Route::prefix('attachment')->name('attachment.')->group(function () {
        Route::get('/index', [AttachmentController::class, 'index'])->name('index');
        Route::get('/create', [AttachmentController::class, 'create'])->name('create');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
    });
    Route::prefix('marketplace')->name('marketplace.')->group(function () {
        Route::get('/index', [MarketplaceController::class, 'index'])->name('index');
        Route::get('/create', [MarketplaceController::class, 'create'])->name('create');
    });
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('/index', [RegisterController::class, 'index'])->name('index');
        Route::get('/create', [RegisterController::class, 'create'])->name('create');
    });
    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/index', [MembershipController::class, 'index'])->name('index');
        Route::get('/create', [MembershipController::class, 'create'])->name('create');
    });
     Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/index', [MembershipController::class, 'index'])->name('index');
        Route::get('/create', [MembershipController::class, 'create'])->name('create');
    });
});
