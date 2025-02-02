<?php

namespace App\Http\Controllers\Genie\Auth;

use App\Http\Controllers\Controller;
use App\Models\Genie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('genie.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $genie = Genie::where('email', $credentials['email'])->first();

        if ($genie && Hash::check($credentials['password'], $genie->password)) {
            Session::put('genie_id', $genie->id);

            $token = $genie->createToken('genie-token')->plainTextToken;

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'genie_id' => $genie->id,
                ], 200);
            }

            session(['auth_token' => $token]);

            return redirect()->route('genie.home');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Invalid credentials provided.',
            ], 401);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials provided.']);
    }

    public function logout(Request $request)
    {
        Session::forget('genie_id');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return redirect()->route('genie.login');
    }
}