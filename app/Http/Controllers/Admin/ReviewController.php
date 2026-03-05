<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReviewRejectedMail;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function index()
    {
        return view('admin.review.index', [
            'reviews' => Review::with('user', 'place')->filter(request(['search', 'rating', 'status']))->paginate()
        ]);
    }

    public function approve(Review $review)
    {

        $review->status = 'approved';
        $review->save();

        // Recalculate place rating when a review is approved
        if ($review->place) {
            $review->place->recalculateRating();
        }

        return back()->with('success', 'Review approved.');
    }

    public function reject(Review $review)
    {
        $review->status = 'rejected';
        $review->save();

        // When a review is rejected, update the place rating so the
        // rejected review's value is effectively removed.
        if ($review->place) {
            $review->place->recalculateRating();
        }

        Mail::to($review->user->email)->send(new ReviewRejectedMail($review));

        return back()->with('success', 'Review rejected and user notified.');
    }


    public function destroy(Review $review)
    {

        $place = $review->place;
        $review->delete();

        // Soft-deleted reviews no longer count towards rating
        if ($place) {
            $place->recalculateRating();
        }

        return redirect()->back()->with('success', 'Reviews deleted successfully');
    }

    public function trashed()
    {
        return view('admin.review.trash', [
            'reviews' => Review::onlyTrashed()->get()
        ]);
    }

    public function restore($id)
    {

        $review = Review::withTrashed()->findOrFail($id);

        $review->restore();

        return back()->with('success', 'Review restored.');
    }

    public function forceDelete($id)
    {

        $review = Review::withTrashed()->findOrFail($id);

        $review->forceDelete();

        return back()->with('success', 'Review permanently deleted.');
    }
}
