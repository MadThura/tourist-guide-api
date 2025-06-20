<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function handleSavingPlaces(Request $request, Place $place)
    {
        $user = $request->user();

        if ($user->isSaved($place)) {
            $user->savedPlaces()->detach($place->id);
            $message = 'Unsaved from place';
        } else {
            $user->savedPlaces()->attach($place->id);
            $message = 'Saved to place';
        }

        return response()->json(['message' => $message]);
    }
}
