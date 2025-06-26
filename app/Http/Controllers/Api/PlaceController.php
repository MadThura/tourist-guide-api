<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = Place::where('name', $request->name)
            ->where('latitude', $request->latitude)
            ->where('longitude', $request->longitude)
            ->first();

        if ($exists) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Place already exists.',
                'place' => $exists->load('images')
            ], 409);
        }

        try {
            $place = Place::create([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'category_id' => $request->category_id
            ]);

            // Handle single image
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('place_images', 'public');
                $place->images()->create(['path' => $path]);
            }

            // Handle multiple images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('place_images', 'public');
                    $place->images()->create(['path' => $path]);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Place stored successfully',
                'place' => $place->load('images')
            ], 201);
        } catch (QueryException $e) {

            return response()->json([
                'status' => 'fail',
                'message' => 'Duplicate place not allowed.'
            ], 409);
        }
    }

    public function update(Request $request, Place $place)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'array', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $place->name = $request->name;
        $place->description = $request->description;
        $place->location = $request->location;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->category_id = $request->category_id;
        $place->save();

        // If new images are uploaded, delete old ones first
        if ($request->hasFile('image') || $request->hasFile('images')) {
            foreach ($place->images as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
        }

        // Handle single image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('place_images', 'public');
            $place->images()->create(['path' => $path]);
        }

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('place_images', 'public');
                $place->images()->create(['path' => $path]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Place updated successfully.',
            'data' => $place->load('images'),
        ]);
    }

    public function destroy(Place $place)
    {

        $place->images()->delete();

        $place->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully',
        ]);
    }
}
