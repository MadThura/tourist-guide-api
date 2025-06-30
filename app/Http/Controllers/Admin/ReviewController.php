<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReviewRemovedMail;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function index()
    {
        return view('admin.review.index', [
            'reviews' => Review::with('user', 'place')->paginate()
        ]);
    }

    public function destroy(Review $review)
    {

        Mail::to($review->user->email)->send(new ReviewRemovedMail($review));

        $review->delete();

        return redirect()->back()->with('success', 'Reviews deleted successfully');
    }
}
