<?php

namespace App\Http\Controllers;

use App\Models\ConferencePaper;
use App\Models\Team;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ConferencePaperController extends Controller
{
    
    public function indexCo()
    {
        $conferencePapers = ConferencePaper::all();
        $teamMembers = Team::all(); // Add this line to get all team members
        return view('admin.conference_papers.index', compact('conferencePapers', 'teamMembers'));
    }
    

    public function createCo()
    {
        $teamMembers = Team::all(); // Fetch all team members for selection
        return view('admin.conference_papers.create', compact('teamMembers'));
    }

    public function editCo(ConferencePaper $conferencePaper)
    {
        $teamMembers = Team::all(); // Fetch all team members for selection
        return view('admin.conference_papers.edit', compact('conferencePaper', 'teamMembers'));
    }


    public function storeCo(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'link' => 'required|string',
            'pdf_path' => 'required|file|mimes:pdf|max:2048',
            'image_path' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'publication_date' => 'required|date',
        ]);
    
        $pdfFile = $request->file('pdf_path');
        $imageFile = $request->file('image_path');
    
        // Store PDF file in public folder
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('conference_papers'), $pdfFileName);
        $pdfPath = 'conference_papers/' . $pdfFileName;
    
        // Store image file in public folder
        $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
        $imageFile->move(public_path('conference_papers'), $imageFileName);
        $imagePath = 'conference_papers/' . $imageFileName;
    
        $conferencePaper = ConferencePaper::create([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'pdf_path' => $pdfPath,
            'image_path' => $imagePath,
            'publication_date' => $validatedData['publication_date'],
        ]);
    
        // Attach selected team members to the journal paper
        $conferencePaper->teams()->attach($request->input('team_members'));
    
        $conferencePapers = ConferencePaper::all();
        $teamMembers = Team::all();
    
        return redirect()->route('admin.conference_papers.index')->with('success', 'Conference paper created successfully!');
    }



    public function updateCo(Request $request, ConferencePaper $conferencePaper)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'link' => 'required|string',
            'publication_date' => 'required|date',
            'team_members' => 'array',
        ]);
    
        // Update fields other than pdf_path and image_path
        $conferencePaper->update([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
            'publication_date' => $validatedData['publication_date'],
        ]);
    
        // Handle pdf_path and image_path updates if provided
        if ($request->hasFile('pdf_path')) {
            $pdfFile = $request->file('pdf_path');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('conference_papers'), $pdfFileName);
            $pdfPath = 'conference_papers/' . $pdfFileName;
    
            // Delete the existing file if it exists
            if ($conferencePaper->pdf_path) {
                unlink(public_path($conferencePaper->pdf_path));
            }
    
            $conferencePaper->pdf_path = $pdfPath;
        }
    
        if ($request->hasFile('image_path')) {
            $imageFile = $request->file('image_path');
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('conference_papers'), $imageFileName);
            $imagePath = 'conference_papers/' . $imageFileName;
    
            // Delete the existing file if it exists
            if ($conferencePaper->image_path) {
                unlink(public_path($conferencePaper->image_path));
            }
    
            $conferencePaper->image_path = $imagePath;
        }
    
        // Sync team members for the conference paper
        $conferencePaper->teams()->sync($validatedData['team_members']);
    
        $conferencePaper->save();
    
        return redirect()->route('admin.conference_papers.index')->with('success', 'Conference paper created successfully!');
    }
    

    public function showCo(ConferencePaper $conferencePaper)
    {
        return view('admin.conference_papers.show', compact('conferencePaper'));
    }

  
   

    public function destroyCo(ConferencePaper $conferencePaper)
    {
        // Delete related records in conference_paper_team_member
        $conferencePaper->teams()->detach();
    
        // Delete the conference paper
        $conferencePaper->delete();
    
        return redirect()->route('admin.conference_papers.index')->with('delete', 'Conference paper deleted successfully!');
    }
    
}