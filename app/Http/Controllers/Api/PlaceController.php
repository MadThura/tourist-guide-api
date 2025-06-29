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

    public function getSavedPlaces(Request $request, User $user)
    {
        if ($request->user()->id !== $user->id) {
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
