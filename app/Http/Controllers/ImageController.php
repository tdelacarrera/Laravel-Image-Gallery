<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index() {
        $images = Image::paginate(9);
    
        $tags = [];
        foreach ($images as $image) {
            $tags = array_merge($tags, explode(',', $image->tags));
        }

        $tags = array_map('trim', $tags);
        $tags = array_unique($tags);
        return view('images.index', compact('images', 'tags'));
    }
    public function search(Request $request){
        {
            $search = $request->get('search');
            $imagesQuery = Image::query();
            if ($search) {
                $imagesQuery->where('tags', 'LIKE', '%'.$search.'%');
            }
            $images = $imagesQuery->paginate(9);

            $tags = [];
            foreach ($images as $image) {
                $tagsArray = explode(',', $image->tags);
                foreach ($tagsArray as $tag) {
                    $tags[] = trim($tag);
                }
            }
            $tags = array_unique($tags);
            sort($tags);

            return view('images.index',compact('images','tags'));
        }
    }
    public function create(){
        return view('images.form');
    }
    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif',
            'tags' => 'nullable|string',
        ]);

        $image = new Image();
        $image->path = basename($request->file('file')->store('images', 'public'));
        $image->tags = $request->tags;
    

        $image->save();

        return redirect()->route('images.index');
    }

    public function show($image) {
        $image = Image::where('path', $image)->first();
        return view('images.show', compact('image'));
    }
    
}
