<?php

namespace App\Http\Controllers\Genie\Auth;

use App\Http\Controllers\Controller;
use App\Models\Genie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('genie.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|integer',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:genies',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Genie::create([
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('genie.login');
    }
}