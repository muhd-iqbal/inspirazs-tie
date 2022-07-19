<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery', [
            'gallery' => Gallery::latest()->get(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'img' => 'image',
        ]);

        if ($request->hasFile('img')) {
            $filename           = 'img';
            $extension          = $request->file('img')->getClientOriginalExtension();
            $fileNameToStore    = $filename . '_' . time() . '.' . $extension;
            $path               = $request->file('img')->storeAs('public/photos', $fileNameToStore);
            $attr['img_path'] = $fileNameToStore;
        }
        $attr['created_at'] = NOW();
        Gallery::create($attr);

        return back();
    }
}
