<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshow;

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::all();
        return response()->json($slideshows);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        // Handle file upload if an image is included
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $requestData['image_path'] = 'images/' . $imageName;
        }

        $slideshow = Slideshow::create($requestData);
        return response()->json($slideshow, 201);
    }

    public function show($id)
    {
        $slideshow = Slideshow::findOrFail($id);
        return response()->json($slideshow);
    }

    public function update(Request $request, $id)
    {
        $slideshow = Slideshow::findOrFail($id);
        $requestData = $request->all();

        // Handle file upload if an image is included
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $requestData['image_path'] = 'images/' . $imageName;
        }

        $slideshow->update($requestData);
        return response()->json($slideshow, 200);
    }

    public function destroy($id)
    {
        $slideshow = Slideshow::findOrFail($id);
        $slideshow->delete();
        return response()->json(null, 204);
    }
}
