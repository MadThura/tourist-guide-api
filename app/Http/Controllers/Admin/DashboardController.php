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
        $numOfUsers = count(User::all());
        $numOfPlaces = count(Place::all());
        $numOfCategory = count(Category::all());
        $numOfPendingReviews = count(Review::where('status', 'pending')->get());

        $topPlaces = Place::whereHas('reviews', function ($query) {
            $query->where('rating', 'good');
        })
            ->withAvg(['reviews as avg_rating' => function ($query) {
                $query->where('rating', 'good');
            }], 'rating')
            ->orderByDesc('avg_rating')
            ->take(5)
            ->get();


        return view('admin.dashboard', [
            'numOfUsers' => $numOfUsers,
            'numOfPlaces' => $numOfPlaces,
            'numOfCategory' => $numOfCategory,
            'numOfPendingReviews' => $numOfPendingReviews,
            'topPlaces' => $topPlaces
        ]);
    }
}
