<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();

        return response()->json([
            'status' => 'success',
            'data' => $places
        ]);
    }

    public function store()
    {
        $validator = Validator::validate(request()->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'location' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            // 'image' => ['required'],
            'category_id' => ['required']
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'fail',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // $place = Place::create($validator->validated());

        // $place = Place::create([
        //     'name' => request('name'),
        //     'description' => request('description'),
        //     'location' => request('location'),
        //     'latitude' => request('latitude'),
        //     'longitude' => request('longitude'),
        //     'category_id' => request('category_id')
        // ]);

        // return response()->json([
        //     'status' => 'success',
        //     'place' => $place
        // ], 201);
    }
}
