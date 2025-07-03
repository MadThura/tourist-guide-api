<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
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
        View::composer('components.sidebar', function ($view) {
            $trashedPlacesCount = Place::onlyTrashed()->count();
            $trashedCategoriesCount = Category::onlyTrashed()->count();
            $trashedReviewsCount = Review::onlyTrashed()->count();

            $view->with([
                'appName' => config('app.name'),
                'adminName' => auth()->user()?->name,
                'trashedPlacesCount' => $trashedPlacesCount,
                'trashedCategoriesCount' => $trashedCategoriesCount,
                'trashedReviewsCount' => $trashedReviewsCount,
            ]);
        });
    }
}
