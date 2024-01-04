<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JournalPaper;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class JournalPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $journalPapers = JournalPaper::all();
        return response()->json($journalPapers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'pdf_path' => 'required|file|mimes:pdf|max:2048',
            'image_path' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'publication_date' => 'required|date',
            // Add other necessary validations
        ]);

        // Handle file uploads for pdf_path and image_path
        $pdfFile = $request->file('pdf_path');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfPath = $pdfFile->storeAs('public/journal_papers', $pdfFileName);

        $imageFile = $request->file('image_path');
        $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
        $imagePath = $imageFile->storeAs('public/journal_papers', $imageFileName);

        $journalPaper = JournalPaper::create([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'pdf_path' => 'storage/journal_papers/' . $pdfFileName,
            'image_path' => 'storage/journal_papers/' . $imageFileName,
            'publication_date' => $validatedData['publication_date'],
        ]);

        // Attach selected team members to the journal paper
        $journalPaper->teams()->attach($request->input('team_members', []));

        return response()->json($journalPaper, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $journalPaper = JournalPaper::findOrFail($id);
        return response()->json($journalPaper, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'link' => 'required',
            'publication_date' => 'required|date',
            // Add other necessary validations
        ]);

        $journalPaper = JournalPaper::findOrFail($id);
        $journalPaper->update($validatedData);

        // Handle pdf_path and image_path updates if provided
        if ($request->hasFile('pdf_path')) {
            Storage::delete($journalPaper->pdf_path);
            $pdfFile = $request->file('pdf_path');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfPath = $pdfFile->storeAs('public/journal_papers', $pdfFileName);
            $journalPaper->pdf_path = 'storage/journal_papers/' . $pdfFileName;
        }

        if ($request->hasFile('image_path')) {
            Storage::delete($journalPaper->image_path);
            $imageFile = $request->file('image_path');
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = $imageFile->storeAs('public/journal_papers', $imageFileName);
            $journalPaper->image_path = 'storage/journal_papers/' . $imageFileName;
        }

        // Sync team members for the journal paper
        $journalPaper->teams()->sync($request->input('team_members', []));

        return response()->json($journalPaper, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $journalPaper = JournalPaper::findOrFail($id);
        $journalPaper->teams()->detach(); // Delete related records in journal_paper_team_member
        $journalPaper->delete();

        return response()->json(null, 204);
    }
}
