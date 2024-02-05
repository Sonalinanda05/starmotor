<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function submitReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:255',
        ]);

        $user_id = Auth::id(); // Get the authenticated user's ID
        $car_id = Car::find($id);
        $review = new Review();
        $review->user_id = $user_id;
        $review->car_id = $car_id->id;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    // public function showReviews()
    // {
    //     $reviews = Review::all();
    //     return view('review.reviews', compact('reviews'));
    // }
}
