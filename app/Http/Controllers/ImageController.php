<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::orderBy('id', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.images.index', compact('images', 'categories'));
    }

    public function publicIndex(Request $request)
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

        return view('images.index', compact('images', 'tags', 'search',));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image',
            'tags' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['path'] = Storage::put('images', $request->image);
        }

        Image::create($data);

        return redirect()->route('admin.images.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view('admin.images.show', compact('image'));
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
        $data = $request->validate([
            'image' => 'nullable|image',
            'tags' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        if($request->hasFile('image')){

            if($image->path){
                Storage::delete($image->path);
            }
            $data['path'] = Storage::put('images', $request->image);
        }

        $image->update($data);
        return redirect()->route('admin.images.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if($image->path){
            Storage::delete($image->path);
         }
    
        $image->delete();
        return redirect()->route('admin.images.index')->with('success', 'Imagen eliminada con éxito');
    }
}
