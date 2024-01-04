<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return AboutUs::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return AboutUs::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $aboutUs = AboutUs::first();
        return response()->json($aboutUs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $aboutUs = AboutUs::firstOrCreate();
        $aboutUs->update($request->all());

        return response()->json($aboutUs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $about_us = AboutUs::findOrFail($id);
        $about_us->delete();
        return response()->json(['message' => 'Team member deleted successfully']);
    }
}
