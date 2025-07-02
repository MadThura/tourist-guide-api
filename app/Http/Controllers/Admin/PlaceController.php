<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        return view('admin.places.index', [
            'places' => Place::with('category', 'images')->filter(request(['search', 'category', 'sort']))->paginate(),
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.places.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100',],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ]);

        $duplicate = Place::where('name', $validated['name'])
            ->where('location', $validated['location'])
            ->first();

        if ($duplicate) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'A place with this name and location already exists.']);
        }

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('places', 'public');
            $validated['image'] = $path;
        }

        // If not duplicate, create new place
        $place = Place::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('places', 'public');
                $place->images()->create(['path' => $path]);
            }
        }

        return redirect()->back()
            ->with('success', 'Place created successfully.');
    }

    public function edit(Place $place)
    {
        return view('admin.places.create', [
            'place' => $place,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100',],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ]);

        $place->name = $request->name;
        $place->description = $request->description;
        $place->location = $request->location;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->category_id = $request->category_id;
        $place->update();

        return redirect()->route('admin.places')->with('success', 'Place updated successfully.');
    }

    public function destroy(Place $place)
    {

        $place->delete();

        return redirect()->back()->with('success', 'Place deleted successfully.');
    }
}
