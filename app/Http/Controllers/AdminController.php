<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AboutUs;
use App\Models\Documentation;
use App\Models\Slideshow; // 
use App\Models\Team;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\ConferencePaper;
use App\Models\JournalPaper;





use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Assuming your login form view is named 'login.blade.php' and located in 'resources/views/admin/'
    }


    public function dashboard()
    {
        $blogCount = Blog::count();
        $publicationCount = Documentation::count();
        $teamCount = Team::count();
        $conferencePaperCount = ConferencePaper::count();
        $journalPaperCount = JournalPaper::count();
        $contactUsCount = ContactUs::count();

        return view('admin.dashboard')
            ->with('blogCount', $blogCount)
            ->with('publicationCount', $publicationCount)
            ->with('teamCount', $teamCount)
            ->with('conferencePaperCount', $conferencePaperCount)
            ->with('journalPaperCount', $journalPaperCount)
            ->with('contactUsCount', $contactUsCount);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');


        if (Auth::guard('admins')->attempt($credentials)) {
            // Authentication passed
            return redirect()->route('admin.dashboard');
        }


        // Authentication failed
        return redirect()->route('admin.login')->withErrors(['message' => 'Invalid credentials']);
    }




    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();

        return response()->json(['message' => 'Logged out successfully']);
    }







    // admin panel management routes/methods



    public function showAboutUsPage()
    {
        $aboutUsEntries = AboutUs::all();
        return view('admin.about.index', ['aboutUsEntries' => $aboutUsEntries]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new AboutUs instance and save it to the database
        $aboutUs = new AboutUs();
        $aboutUs->content = $request->input('content');
        $aboutUs->save();

        return redirect()->back()->with('success', 'About Us entry created successfully');
    }


    public function update(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->content = $request->input('content');
        $aboutUs->save();

        return redirect()->back()->with('success', 'About Us entry updated successfully');
    }

    public function delete($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return redirect()->back()->with('delete', 'About Us entry deleted successfully');
    }










    public function showDocumentationPage()
    {
        $documentations = Documentation::all();
        return view('admin.publications.index', ['documentations' => $documentations]);
    }

    public function updateD(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $documentation = Documentation::findOrFail($id);
        $documentation->content = $request->input('content');
        $documentation->save();

        return redirect()->back()->with('success', 'publications updated successfully');
    }
    public function storeD(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Documentation::create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'publications created successfully');
    }



    public function destroyD($id)
    {
        $documentation = Documentation::findOrFail($id);
        $documentation->delete();

        return redirect()->back()->with('delete', 'publications deleted successfully');
    }



    // team

    public function indexT()
    {
        $teams = Team::all();
        return view('admin.teams.index', ['teams' => $teams]);
    }

    public function createT()
    {
        return view('admin.teams.create');
    }

    public function storeT(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'member_name' => 'required',
            'member_position' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);
    
        // Handle file upload
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
    
            // Store the uploaded image in the public/images folder
            $image->move(public_path('images'), $imageName);
    
            // Update the database entry with the stored image path
            Team::create([
                'image_path' => 'images/' . $imageName,
                'member_name' => $request->input('member_name'),
                'member_position' => $request->input('member_position'),
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'linkedin' => $request->input('linkedin'),
            ]);
    
            return redirect()->route('admin.teams.index')->with('success', 'Team member added successfully');
        } else {
            return redirect()->back()->with('error', 'Image not provided');
        }
    }
    public function editT($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    public function updateT(Request $request, $id)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'member_name' => 'required',
            'member_position' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);
    
        $team = Team::findOrFail($id);
    
        // Handle file update if a new image is provided
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
    
            // Store the uploaded image in the public/images folder
            $image->move(public_path('images'), $imageName);
    
            // Delete old image if it exists
            if ($team->image_path && file_exists(public_path($team->image_path))) {
                unlink(public_path($team->image_path)); // Delete the old image file
            }
    
            // Update the image path in the database
            $team->image_path = 'images/' . $imageName;
        }
    
        // Update other fields
        $team->member_name = $request->input('member_name');
        $team->member_position = $request->input('member_position');
        $team->facebook = $request->input('facebook');
        $team->twitter = $request->input('twitter');
        $team->instagram = $request->input('instagram');
        $team->linkedin = $request->input('linkedin');
        $team->save();
    
        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully');
    }
    
    public function destroyT($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.teams.index')->with('delete', 'Team member deleted successfully');
    }













    // slideshow

    public function showSlideshowPage()
    {
        $slideshows = Slideshow::all();
        return view('admin.slideshow.index', ['slideshows' => $slideshows]);
    }



    
    public function createSlideshow(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'content' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'action_link' => 'required',
        ]);
    
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('slideshow_images'), $imageName);
    
            Slideshow::create([
                'heading' => $request->input('heading'),
                'content' => $request->input('content'),
                'image_path' => 'slideshow_images/' . $imageName,
                'action_link' => $request->input('action_link'),
            ]);
        }
    
        return redirect()->back()->with('success', 'Slideshow created successfully');
    }
    
    public function updateSlideshow(Request $request, $id)
    {
        $slideshow = Slideshow::findOrFail($id);
    
        $request->validate([
            'heading' => 'required',
            'content' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'action_link' => 'required',
        ]);
    
        $slideshow->heading = $request->input('heading');
        $slideshow->content = $request->input('content');
        $slideshow->action_link = $request->input('action_link');
    
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('slideshow_images'), $imageName);
    
            if ($slideshow->image_path) {
                unlink(public_path($slideshow->image_path));
            }
    
            $slideshow->image_path = 'slideshow_images/' . $imageName;
        }
    
        $slideshow->save();
    
        return redirect()->back()->with('success', 'Slideshow updated successfully');
    }
    
    public function deleteSlideshow($id)
    {
        // Find the slideshow by ID and delete
        $slideshow = Slideshow::findOrFail($id);
        $slideshow->delete();

        return redirect()->back()->with('delete', 'Slideshow deleted successfully');
    }










    // public function showTeamPage()
    // {
    //     return view('admin.team'); // Replace with the view name for Team page
    // }

    public function showTestimonialPage()
    {
        return view('admin.testimonial'); // Replace with the view name for Testimonial page
    }


    // blog news
    public function indexB()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function showB($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    public function createB()
    {
        return view('admin.blogs.create');
    }

    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Handle the image upload
        if ($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            // Store the image in the 'public/images' directory
            $uploadedFile->storeAs('public/images', $fileName);

            // Generate the URL for the stored image
            $imageUrl = asset('storage/images/' . $fileName);

            // Return the URL in a JSON response
            return response()->json(['url' => $imageUrl]);
        }

        // If no file was uploaded, return an error response
        return response()->json(['error' => 'No file uploaded'], 400);
    }



    public function editB($id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blogs'));
    }


    public function storeB(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the uploaded image in the public/images folder
            $image->move(public_path('images'), $imageName);

            // Update the database entry with the stored image path and content HTML
            Blog::create([
                'title' => $request->input('title'),
                'image_path' => 'images/' . $imageName, // Assuming images are stored in the public folder
                'content' => $request->input('content'), // Assuming content is the HTML from Quill
            ]);

            return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
        } else {
            return redirect()->back()->with('error', 'Image not provided');
        }
    }

    public function updateB(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'content' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        // Handle file update if a new image is provided
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store the uploaded image in the public/images folder
            $image->move(public_path('images'), $imageName);

            // Delete old image if exists
            if ($blog->image_path) {
                unlink(public_path($blog->image_path)); // Delete the old image file
            }

            // Update the image path in the database
            $blog->image_path = 'images/' . $imageName; // Assuming images are stored in the public folder
        }

        // Update the content HTML
        $blog->content = $request->input('content');

        // Update other fields if needed
        $blog->title = $request->input('title');
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }


    public function destroyB($id)
    {
        $blog = Blog::findOrFail($id);
        // Delete associated image if exists
        if ($blog->image_path) {
            Storage::delete('public/images/' . basename($blog->image_path));
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('delete', 'Blog deleted successfully');
    }




    //contact us

    public function indexC()
    {
        $contactMessages = ContactUs::all();
        return view('admin.contact.index', compact('contactMessages'));
    }

    public function createC()
    {
        return view('admin.contact.create');
    }

    public function storeC(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        ContactUs::create($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Message sent successfully');
    }

    public function editC($id)
    {
        $contactMessage = ContactUs::findOrFail($id);
        return view('admin.contact.edit', compact('contactMessage'));
    }

    public function updateC(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        $contactMessage = ContactUs::findOrFail($id);
        $contactMessage->update($request->all());

        return redirect()->route('admin.contact.index')->with('success', 'Message updated successfully');
    }

    public function destroyC($id)
    {
        $contactMessage = ContactUs::findOrFail($id);
        $contactMessage->delete();

        return redirect()->route('admin.contact.index')->with('delete', 'Message deleted successfully');
    }
}