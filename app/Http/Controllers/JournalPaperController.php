<?php

namespace App\Http\Controllers;

use App\Models\JournalPaper;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class JournalPaperController extends Controller
{
    public function indexJo()
    {
        $journalPapers = JournalPaper::all();
        $teamMembers = Team::all();
        return view('admin.journal_papers.index', compact('journalPapers', 'teamMembers'));
    }

    

    public function createJo()
    {
        $teamMembers = Team::all();
        return view('admin.journal_papers.create', compact('teamMembers'));
    }

    public function editJo(JournalPaper $journalPaper)
    {
        $teamMembers = Team::all();
        return view('admin.journal_papers.edit', compact('journalPaper', 'teamMembers'));
    }

    // public function storeJo(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string',
    //         'link' => 'required|string',
    //         'pdf_path' => 'required|file|mimes:pdf|max:2048',
    //         'image_path' => 'required|file|mimes:jpeg,png,jpg|max:2048',
    //         'publication_date' => 'required|date',
    //     ]);
    
    //     $pdfFile = $request->file('pdf_path');
    //     $imageFile = $request->file('image_path');
    
    //     // Store PDF file in public folder
    //     $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
    //     $pdfFile->move(public_path('journal_papers'), $pdfFileName);
    //     $pdfPath = 'journal_papers/' . $pdfFileName;
    
    //     // Store image file in public folder
    //     $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
    //     $imageFile->move(public_path('journal_papers'), $imageFileName);
    //     $imagePath = 'journal_papers/' . $imageFileName;
    
    //     $journalPaper = JournalPaper::create([
    //         'title' => $validatedData['title'],
    //         'link' => $validatedData['link'],
    //         'pdf_path' => $pdfPath,
    //         'image_path' => $imagePath,
    //         'publication_date' => $validatedData['publication_date'],
    //     ]);
    
    //     // Attach selected team members to the journal paper
    //     $journalPaper->teams()->attach($request->input('team_members'));
    
    //     $journalPapers = JournalPaper::all();
    //     $teamMembers = Team::all();
    
    //     return redirect()->route('admin.journal_papers.index')->with('success', 'Journal paper created successfully!');
    // }
    public function storeJo(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'link' => 'required|string',
            'pdf_path' => 'required|file|mimes:pdf|max:2048',
            'image_path' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'publication_date' => 'required|date',
        ]);
    
        try {
            $pdfFile = $request->file('pdf_path');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('journal_papers'), $pdfFileName);
            $pdfPath = 'journal_papers/' . $pdfFileName;
    
            // Process image if it exists
            $imagePath = null;
            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                $imageFile->move(public_path('journal_papers'), $imageFileName);
                $imagePath = 'journal_papers/' . $imageFileName;
            }
    
            $journalPaper = JournalPaper::create([
                'title' => $validatedData['title'],
                'link' => $validatedData['link'],
                'pdf_path' => $pdfPath,
                'image_path' => $imagePath,
                'publication_date' => $validatedData['publication_date'],
            ]);
    
            $journalPaper->teams()->attach($request->input('team_members'));
    
            return redirect()->route('admin.journal_papers.index')->with('success', 'Journal paper created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create journal paper. Please try again.']);
        }
    }
    

   
    
       
   
    public function updateJo(Request $request, JournalPaper $journalPaper)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'link' => 'required|string',
            'publication_date' => 'required|date',
            'team_members' => 'array',
        ]);
    
        // Update fields other than pdf_path and image_path
        $journalPaper->update([
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
            if ($journalPaper->pdf_path) {
                unlink(public_path($journalPaper->pdf_path));
            }
    
            $journalPaper->pdf_path = $pdfPath;
        }
    
        if ($request->hasFile('image_path')) {
            $imageFile = $request->file('image_path');
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('journal_papers'), $imageFileName);
            $imagePath = 'journal_papers/' . $imageFileName;
    
            // Delete the existing file if it exists
            if ($journalPaper->image_path) {
                unlink(public_path($journalPaper->image_path));
            }
    
            $journalPaper->image_path = $imagePath;
        }
    
        // Sync team members for the conference paper
        $journalPaper->teams()->sync($validatedData['team_members']);
    
        $journalPaper->save();
    
        return redirect()->route('admin.journal_papers.index')->with('success', 'Journal paper created successfully!');
    }
    

   

    public function showJo(JournalPaper $journalPaper)
    {
        return view('admin.journal_papers.show', compact('journalPaper'));
    }
    public function destroyJo(JournalPaper $journalPaper)
    {
        // Delete related records in journal_paper_team_member
        $journalPaper->teams()->detach();
    
        // Delete the journal paper
        $journalPaper->delete();
    
        return redirect()->route('admin.journal_papers.index')->with('delete', 'Journal paper deleted successfully!');
    }
    
}
