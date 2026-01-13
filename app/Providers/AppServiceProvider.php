<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\App\Models\AboutUs;
use Modules\Dashboard\App\Models\Contact;
use Modules\Dashboard\App\Models\Footer;
use Illuminate\Pagination\Paginator;
use Modules\Dashboard\App\Models\SocailPlatform;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
       Schema::defaultStringLength(191);

       // Share data with multiple views, including the footer partial
        View::composer([
            'frontEnd.layout.includes.footer',
            'frontEnd.layout.includes.header',
            'frontEnd.layout.partials.navbar',

        ], function ($view) {
            $footer = Footer::first();
            $about = AboutUs::first();
            $contact = Contact::all();
            $platforms = SocailPlatform::all();

            $view->with([ 'footers' => $footer, 'about' => $about,'contacts'=>$contact,'platforms'=>$platforms
            ]);
        });
    }
}
