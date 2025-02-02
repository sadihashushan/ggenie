<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genie;

class GenieController extends Controller
{
    //Get all genies
    public function index()
    {
        $genies = Genie::all();
        return response()->json($genies, 200);
    }

    //Create a new genie
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|array',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:genies',
        ]);

        $genie = Genie::create([
            'name' => $request->name,
            'image' => $request->image,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return response()->json($genie, 201);
    }

    //Show a specific genie
    public function show($id)
    {
        $genie = Genie::find($id);

        if (!$genie) {
            return response()->json(['message' => 'Genie not found'], 404);
        }

        return response()->json($genie, 200);
    }

    //Update a specific genie
    public function update(Request $request, $id)
    {
        $genie = Genie::find($id);

        if (!$genie) {
            return response()->json(['message' => 'Genie not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|array',
            'street_address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer',
            'phone_number' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|string|email|max:255|unique:genies,email,' . $id,
        ]);

        $genie->update([
            'name' => $request->name ?? $genie->name,
            'image' => $request->image ?? $genie->image,
            'street_address' => $request->street_address ?? $genie->street_address,
            'city' => $request->city ?? $genie->city,
            'age' => $request->age ?? $genie->age,
            'phone_number' => $request->phone_number ?? $genie->phone_number,
            'email' => $request->email ?? $genie->email,
        ]);

        return response()->json($genie, 200);
    }

    // Delete a genie
    public function destroy($id)
    {
        $genie = Genie::find($id);

        if (!$genie) {
            return response()->json(['message' => 'Genie not found'], 404);
        }

        $genie->delete();

        return response()->json(['message' => 'Genie deleted successfully'], 200);
    }
}
