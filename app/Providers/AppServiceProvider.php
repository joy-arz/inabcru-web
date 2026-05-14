<?php

namespace App\Providers;

use App\Models\SiteImage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $siteImages = SiteImage::all()->keyBy('key');
            $view->with('siteImages', $siteImages);
        });
    }
}