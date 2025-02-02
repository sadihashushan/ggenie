<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    //Get all addresses
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses, 200);
    }

    //Create a new address
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'street_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $address = Address::create([
            'order_id' => $request->order_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'city' => $request->city,
        ]);

        return response()->json($address, 201);
    }

    //Show a specific address
    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address, 200);
    }

    //Update a specific address
    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $request->validate([
            'order_id' => 'sometimes|required|exists:orders,id',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'street_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $address->update([
            'order_id' => $request->order_id ?? $address->order_id,
            'first_name' => $request->first_name ?? $address->first_name,
            'last_name' => $request->last_name ?? $address->last_name,
            'phone' => $request->phone ?? $address->phone,
            'street_address' => $request->street_address ?? $address->street_address,
            'city' => $request->city ?? $address->city,
        ]);

        return response()->json($address, 200);
    }

    //Delete a specific address
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->delete();

        return response()->json(['message' => 'Address deleted successfully'], 200);
    }
}
