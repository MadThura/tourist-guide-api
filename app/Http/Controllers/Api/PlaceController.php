<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Api\PlaceResource;
use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $places = Place::filter(request(['search', 'category', 'sortBy_rating']))->get();

        // dd($places);
        return $this->successresponse('Places retrieved successfully', PlaceResource::collection($places));
    }

    public function show(Place $place)
    {
        $category = $place->category->id;
        // $relatedPlaces = Place::where('category_id', $category)->limit(3)->get();

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $place,
        //     'relatedPlaces' => $relatedPlaces
        // ]);

        return $this->successresponse('Place fetched successfully', $place);
    }

    public function getSavedPlaces(Request $request)
    {
        $user = $request->user('sanctum');

        $savedPlaces = $user->savedPlaces();

        return $this->successresponse('Saved places reterived successfully', $savedPlaces);
    }
}
