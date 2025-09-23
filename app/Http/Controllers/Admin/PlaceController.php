<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Place;
use App\Models\User;
use App\Notifications\NewPlaceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function index()
    {
        return view('admin.places.index', [
            'places' => Place::with('category', 'images')->filter(request(['search', 'category', 'sort']))->paginate(),
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        return view('admin.places.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
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
            $path = $request->file('image')->store('images/places/main_images', 'public');
            $validated['image'] = $path;
        }

        // If not duplicate, create new place
        $place = Place::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/places/add_images', 'public');
                $place->images()->create(['path' => $path]);
            }
        }

        $users = User::where('role', 'user')->get();

        Notification::send($users, new NewPlaceNotification($place));

        return redirect()->back()
            ->with('success', 'Place created successfully.');
    }

    public function edit(Place $place)
    {
        return view('admin.places.create', [
            'place' => $place,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:100'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:5120'],
            'images.*' => ['nullable', 'image', 'max:5120'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        $place->name = $request->name;
        $place->description = $request->description;
        $place->location = $request->location;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $newHash = md5_file($newImage->getRealPath());

            $currentHash = null;
            if ($place->image && Storage::disk('public')->exists($place->image)) {
                $currentHash = md5(Storage::disk('public')->get($place->image));
            }

            if ($newHash !== $currentHash) {
                if ($place->image) {
                    Storage::disk('public')->delete($place->image);
                }

                $path = $newImage->store('images/places/main_images', 'public');
                $place->image = $path;
            } else {
                return back()->with('fail', 'This image is already uploaded.');
            }
        }

        if ($request->hasFile('images')) {
            $uploaded = $request->file('images');

            $uploadedHashes = [];
            foreach ($uploaded as $file) {
                $uploadedHashes[] = md5_file($file->getRealPath());
            }

            foreach ($place->images as $img) {
                $fullPath = storage_path('app/public/'.$img->path);
                if (file_exists($fullPath)) {
                    $oldHash = md5_file($fullPath);
                    if (! in_array($oldHash, $uploadedHashes)) {
                        Storage::disk('public')->delete($img->path);
                        $img->delete();
                    }
                }
            }

            foreach ($uploaded as $file) {
                $hash = md5_file($file->getRealPath());
                $exists = false;

                foreach ($place->images as $img) {
                    $storedPath = storage_path('app/public/'.$img->path);
                    if (file_exists($storedPath) && md5_file($storedPath) === $hash) {
                        $exists = true;
                        break;
                    }
                }

                if (! $exists) {
                    $path = $file->store('images/places/add_images', 'public');
                    $place->images()->create(['path' => $path]);
                } else {
                    // If the image already exists, return the fail message
                    return back()->with('fail', 'This image is already uploaded.');
                }
            }
        }

        $place->update();

        return back()->with('success', 'Place updated successfully.');
    }

    public function destroyMainImage(Place $place)
    {

        if ($place->image && Storage::disk('public')->exists($place->image)) {
            Storage::disk('public')->delete($place->image);
        }

        $place->image = null;
        $place->save();

        return back()->with('success', 'Main image deleted.');
    }

    public function destroyImage(Place $place, Image $image)
    {
        // Make sure the image belongs to the place
        if ($image->place_id !== $place->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete the database record
        $image->delete();

        return back()->with('success', 'Image deleted.');
    }

    public function destroy(Place $place)
    {

        $place->delete();
        $place->reviews()->delete();

        return redirect()->back()->with('success', 'Place deleted successfully.');
    }

    public function trashed()
    {
        return view('admin.places.trash', [
            'places' => Place::onlyTrashed()->get(),
        ]);
    }

    public function restore($id)
    {

        $place = Place::withTrashed()->findOrFail($id);

        $place->restore();

        $place->reviews()->restore();

        return back()->with('success', 'Place restored.');
    }

    public function forceDelete($id)
    {

        $place = Place::withTrashed()->findOrFail($id);

        $place->forceDelete();
        $place->reviews()->forceDelete();

        if ($place->image) {
            Storage::disk('public')->delete($place->image);
        }

        if ($place->images()) {
            foreach ($place->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete(); // remove record from DB
            }
        }

        return back()->with('success', 'Place permanently deleted.');
    }
}
