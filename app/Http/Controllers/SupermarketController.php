<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supermarket;

class SupermarketController extends Controller
{
    //Get all supermarkets
    public function index()
    {
        $supermarkets = Supermarket::all();
        return response()->json($supermarkets, 200);
    }

    //Create a new supermarket
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'available_times' => 'required|array',
            'location' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:supermarkets',
        ]);

        $supermarket = Supermarket::create([
            'name' => $request->name,
            'description' => $request->description,
            'images' => $request->images,
            'available_times' => $request->available_times,
            'location' => $request->location,
            'slug' => $request->slug,
        ]);

        return response()->json($supermarket, 201);
    }

    //Show a specific supermarket
    public function show($id)
    {
        $supermarket = Supermarket::find($id);

        if (!$supermarket) {
            return response()->json(['message' => 'Supermarket not found'], 404);
        }

        return response()->json($supermarket, 200);
    }

    //Update a specific supermarket
    public function update(Request $request, $id)
    {
        $supermarket = Supermarket::find($id);

        if (!$supermarket) {
            return response()->json(['message' => 'Supermarket not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'available_times' => 'sometimes|required|array',
            'location' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:supermarkets,slug,' . $id,
        ]);

        $supermarket->update([
            'name' => $request->name ?? $supermarket->name,
            'description' => $request->description ?? $supermarket->description,
            'images' => $request->images ?? $supermarket->images,
            'available_times' => $request->available_times ?? $supermarket->available_times,
            'location' => $request->location ?? $supermarket->location,
            'slug' => $request->slug ?? $supermarket->slug,
        ]);

        return response()->json($supermarket, 200);
    }

    //Delete a supermarket
    public function destroy($id)
    {
        $supermarket = Supermarket::find($id);

        if (!$supermarket) {
            return response()->json(['message' => 'Supermarket not found'], 404);
        }

        $supermarket->delete();

        return response()->json(['message' => 'Supermarket deleted successfully'], 200);
    }

    //Show supermarket by slug
    public function showBySlug($slug)
    {
        $supermarket = Supermarket::where('slug', $slug)->first();

        if (!$supermarket) {
            return response()->json(['message' => 'Supermarket not found'], 404);
        }

        return response()->json($supermarket, 200);
    }
}
