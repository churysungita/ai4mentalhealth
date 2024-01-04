<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs; // Replace with your Contact model

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::all();
        return response()->json($contacts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required',
            // Add other necessary validations
        ]);

        $contact = ContactUs::create($validatedData);
        return response()->json($contact, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        return response()->json($contact, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required',
            // Add other necessary validations
        ]);

        $contact = ContactUs::findOrFail($id);
        $contact->update($validatedData);

        return response()->json($contact, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();

        return response()->json(null, 204);
    }
}
