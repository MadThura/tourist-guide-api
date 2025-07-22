<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Global setting available in all views
        $setting = Setting::first();
        View::composer('*', function ($view) use ($setting) {
            $view->with('globalSetting', $setting);
        });

        // Sidebar-specific data
        View::composer('components.sidebar', function ($view) {
            $view->with([
                'trashedPlacesCount' => Place::onlyTrashed()->count(),
                'trashedCategoriesCount' => Category::onlyTrashed()->count(),
                'trashedReviewsCount' => Review::onlyTrashed()->count(),
            ]);
        });
    }
}
