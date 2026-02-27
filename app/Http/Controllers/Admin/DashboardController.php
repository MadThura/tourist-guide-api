<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $displayName = ucfirst(auth()->user()->role) . ' ' . auth()->user()->name;
        $numOfActiveUsers = User::where('is_active', '=', 1)->count();
        $numOfSusUsers = User::where('is_active', '=', 0)->count();
        $numOfPlaces = Place::all()->count();
        $numOfCategory = Category::all()->count();
        $numOfPendingReviews = Review::where('status', 'pending')->get()->count();

        $topPlaces = Place::where('rating', '>', 0) // only rated places
            ->orderByDesc('rating')
            ->take(5)
            ->get();



        return Inertia::render('Admin/Dashboard', [
            'displayName' => $displayName,
            'numOfActiveUsers' => $numOfActiveUsers,
            'numOfSusUsers' => $numOfSusUsers,
            'numOfPlaces' => $numOfPlaces,
            'numOfCategory' => $numOfCategory,
            'numOfPendingReviews' => $numOfPendingReviews,
            'topPlaces' => $topPlaces,
            'globalSetting' => [
                'logo' => $globalSetting->logo ?? null,
            ],
        ]);
    }
}
