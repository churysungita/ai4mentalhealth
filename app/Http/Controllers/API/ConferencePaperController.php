<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ConferencePaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConferencePaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $conferencePapers = ConferencePaper::all();
        return response()->json($conferencePapers, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConferencePaper  $conferencePaper
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ConferencePaper $conferencePaper)
    {
        return response()->json($conferencePaper, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation logic
        $validatedData = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'pdf_path' => 'required|file|mimes:pdf|max:2048',
            'image_path' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'publication_date' => 'required|date',
            // Include other necessary validations
        ]);

        // Storage logic
        $pdfFile = $request->file('pdf_path');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfPath = $pdfFile->storeAs('public/conference_papers', $pdfFileName);

        $imageFile = $request->file('image_path');
        $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
        $imagePath = $imageFile->storeAs('public/conference_papers', $imageFileName);

        $conferencePaper = ConferencePaper::create([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'pdf_path' => 'storage/conference_papers/' . $pdfFileName,
            'image_path' => 'storage/conference_papers/' . $imageFileName,
            'publication_date' => $validatedData['publication_date'],
        ]);

        return response()->json($conferencePaper, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConferencePaper  $conferencePaper
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ConferencePaper $conferencePaper)
    {
        // Validation logic
        $validatedData = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'publication_date' => 'required|date',
            // Include other necessary validations
        ]);

        // Update logic
        $conferencePaper->update($validatedData);

        // Handle pdf_path and image_path updates if provided
        if ($request->hasFile('pdf_path')) {
            Storage::delete($conferencePaper->pdf_path);
            $pdfFile = $request->file('pdf_path');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfPath = $pdfFile->storeAs('public/conference_papers', $pdfFileName);
            $conferencePaper->pdf_path = 'storage/conference_papers/' . $pdfFileName;
        }

        if ($request->hasFile('image_path')) {
            Storage::delete($conferencePaper->image_path);
            $imageFile = $request->file('image_path');
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = $imageFile->storeAs('public/conference_papers', $imageFileName);
            $conferencePaper->image_path = 'storage/conference_papers/' . $imageFileName;
        }

        $conferencePaper->save();

        return response()->json($conferencePaper, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConferencePaper  $conferencePaper
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ConferencePaper $conferencePaper)
    {
        // Deletion logic
        $conferencePaper->delete();

        return response()->json(null, 204);
    }
}
