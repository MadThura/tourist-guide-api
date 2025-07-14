<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $displayName = ucfirst(auth()->user()->role) . ' ' . auth()->user()->name;
        $numOfUsers = User::all()->count();
        $numOfPlaces = Place::all()->count();
        $numOfCategory = Category::all()->count();
        $numOfPendingReviews = Review::where('status', 'pending')->get()->count();

        $topPlaces = Place::withCount([
            'reviews as good_count' => fn($q) => $q->where('rating', 'good'),
            'reviews as bad_count' => fn($q) => $q->where('rating', 'bad'),
            'reviews as total_count',
        ])
            ->get()
            ->filter(fn($place) => $place->total_count > 0)
            ->sortByDesc(fn($place) => $place->good_count / $place->total_count)
            ->take(3)
            ->values();


        return view('admin.dashboard', [
            'displayName' => $displayName,
            'numOfUsers' => $numOfUsers,
            'numOfPlaces' => $numOfPlaces,
            'numOfCategory' => $numOfCategory,
            'numOfPendingReviews' => $numOfPendingReviews,
            'topPlaces' => $topPlaces
        ]);
    }
}
