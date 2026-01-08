<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Api\ReviewResource;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    use ApiResponse;

    public function index(Place $place)
    {
        return $this->successresponse(ReviewResource::collection($place->reviews));
    }

    public function store(Request $request, Place $place)
    {
        $user = $request->user('sanctum');



        // Check for existing review
        $existingReview = $place->reviews()
            ->where('user_id', $user->id)
            ->first();

        if ($existingReview) {
            return $this->errorresponse("You have already reviewed this place.", 409);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => ['unique:id'],
            'place_id' => ['unique:id'],
            'rating' => ['required', Rule::in(['good', 'bad', 'excellent'])],
            'comment' => ['nullable', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return $this->errorresponse($validator->errors(), 422);
        }

        $review = $place->reviews()->create([
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $ratingValues = [
            'bad' => 1,
            'good' => 3,
            'excellent' => 5,
        ];

        $reviews = $place->reviews;
        $totalReviews = $reviews->count();

        $averageRating = $totalReviews
            ? round($reviews->sum(fn($r) => $ratingValues[$r->rating]) / $totalReviews, 1)
            : 0;

        $place->rating = $averageRating;
        $place->save();

        return $this->successresponse('Reviews created successfully', new ReviewResource($review), 201);
    }


    public function update(Request $request, Review $review)
    {
        $user = $request->user('sanctum');

        if ($user->id !== $review->user_id) {
            return $this->errorresponse("Unauthorized.", 403);
        }

        $validator = Validator::make($request->all(), [
            'rating'  => ['required', Rule::in(['good', 'bad'])],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return $this->errorresponse($validator->errors(), 422);
        }

        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return $this->successresponse('Review updated successfully', new ReviewResource($review));
    }

    public function destroy(Request $request, Review $review)
    {
        $user = $request->user('sanctum');
        if ($user->id !== $review->user_id) {
            return $this->errorresponse("Unauthorized.", 403);
        }

        $review->forceDelete();
        return $this->successresponse("Review deleted successfully.");
    }
}
