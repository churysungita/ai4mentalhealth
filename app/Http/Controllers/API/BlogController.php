<?php



namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog; // Replace with your Blog model
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs, 200);
    }
    /**
     * Display the 5 latest blogs.
     */
   
     public function latestBlogs()
     {
         $latestBlogs = Blog::latest()->limit(5)->get();
         return response()->json($latestBlogs, 200);
     }
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image_path' => 'required',
            'content' => 'required',
            // Add other necessary validations
        ]);

        $blog = Blog::create($validatedData);
        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json($blog, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image_path' => 'required',
            'content' => 'required',
            // Add other necessary validations
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update($validatedData);

        return response()->json($blog, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
