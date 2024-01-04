<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documentation;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = Documentation::all();
        return response()->json($documentations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $documentation = Documentation::create($request->all());
        return response()->json($documentation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Documentation $documentation)
    {
        return response()->json($documentation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documentation $documentation)
    {
        $documentation->update($request->all());
        return response()->json($documentation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documentation $documentation)
    {
        $documentation->delete();
        return response()->json(null, 204);
    }
}
