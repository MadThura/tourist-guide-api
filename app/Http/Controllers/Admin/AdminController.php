<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $numOfUsers = count(User::all());
        $numOfPlaces = count(Place::all());
        $numOfCategory = count(Category::all());
        $numOfReviews = count(Review::all());

        $topPlaces = Place::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get()
            ->map(function ($place) {
                $place->avg_rating = $place->reviews_avg_rating ?? 0;
                return $place;
            });

        return view('admin.dashboard', [
            'numOfUsers' => $numOfUsers,
            'numOfPlaces' => $numOfPlaces,
            'numOfCategory' => $numOfCategory,
            'numOfReviews' => $numOfReviews,
            'topPlaces' => $topPlaces
        ]);
    }
}
