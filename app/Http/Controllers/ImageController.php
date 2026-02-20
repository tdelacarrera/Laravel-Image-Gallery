<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $search = $request->input('search');
        $imagesQuery = Image::query();

        if ($search) {
            $imagesQuery->where('tags', 'LIKE', '%' . $search . '%');
        }

        $images = $imagesQuery->paginate(9);

        $tags = [];
        foreach ($images as $image) {
            $tags = array_merge($tags, array_map('trim', explode(',', $image->tags)));
        }

        $tags = array_unique($tags);
        sort($tags);

        return view('images.index', compact('images', 'tags', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif',
            'tags' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $image = new Image();
        $image->path = basename($request->file('file')->store('images', 'public'));
        $image->tags = $request->tags;
    

        $image->save();

        return redirect()->route('images.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
