<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::with('category')
            ->filter(request(['search', 'category', 'sortBy_rating']))->get();

        return response()->json([
            'status' => 'success',
            'data' => $places
        ]);
    }

    public function show(Place $place)
    {
        $category = $place->category->id;
        $relatedPlaces = Place::where('category_id', $category)->limit(3)->get();

        return response()->json([
            'status' => 'success',
            'data' => $place,
            'relatedPlaces' => $relatedPlaces
        ]);
    }

    public function getSavedPlaces(Request $request, User $user)
    {
        if ($request->user->id !== $user->id) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $user->savedPlaces
        ]);
    }
}
