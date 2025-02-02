<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class ContactController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function showForm()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data.
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Get Firebase database instance.
        $database = $this->firebase->getDatabase();

        // Create an array of the data.
        $data = [
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'message'   => $request->input('message'),
            'created_at'=> now()->toDateTimeString(),
        ];

        // Save the data to the "contacts" node in Firebase.
        $database->getReference('contacts')->push($data);

        // Redirect back with a success message.
        return redirect()->back()->with('success', 'Thank you for contacting us!');
    }
}
