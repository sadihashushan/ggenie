<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //Get all reviews
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews, 200);
    }

    //Create a new review
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'review' => 'required|string',
            'star_count' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'user_id' => $request->user_id,
            'name' => $request->name ?? 'Anonymous',
            'review' => $request->review,
            'star_count' => $request->star_count,
        ]);

        return response()->json($review, 201);
    }

    //Show a specific review
    public function show($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        return response()->json($review, 200);
    }

    //Update a specific review
    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'review' => 'required|string',
            'star_count' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'name' => $request->name ?? $review->name,
            'review' => $request->review,
            'star_count' => $request->star_count,
        ]);

        return response()->json($review, 200);
    }

    // Delete a specific review
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}
