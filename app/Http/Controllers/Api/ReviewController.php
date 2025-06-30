<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function index(Place $place)
    {
        return response()->json([
            'status' => 'success',
            'data' => $place->reviews()
        ]);
    }

    public function store(Request $request, Place $place)
    {
        $validator = Validator::make($request->all(), [
            'rating' => ['required', Rule::in(['good', 'bad'])],
            'comment' => ['nullable', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = $place->reviews()->create([
            'user_id' => $request->user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $review
        ], 201);
    }


    public function update(Request $request, Review $review)
    {
        $user = $request->user();

        if ($user->id !== $review->user_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'rating'  => ['required', Rule::in(['good', 'bad'])],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validator->errors()
            ]);
        }

        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return response()->json([
            'status' => 'success',
            'data' => $review
        ]);
    }

    public function destroyByUser(Request $request, Review $review)
    {
        $user = $request->user();
        if ($user->id !== $review->user_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Review deleted successfully'
        ]);
    }
}
