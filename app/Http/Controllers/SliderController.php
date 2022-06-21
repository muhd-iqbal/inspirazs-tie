<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.sliders', [
            'sliders' => Slider::with(['product'])->get(),
        ]);
    }

    public function view(Slider $slider)
    {
        return view('admin.slider', [
            'slider' => $slider,
            'products' => Product::all(),
        ]);
    }

    public function update(Slider $slider, Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'subtitle' => 'required|max:70',
            'active' => 'required|boolean',
            'image' => 'image',
        ]);

        $attr = $request->toArray();

        if ($request->hasFile('image')) {
            // $filenameWithExt    = $request->file('picture')->getClientOriginalName();
            $filename           = $request->name;
            $extension          = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore    = $filename . '_' . time() . '.' . $extension;
            $path               = $request->file('image')->storeAs('public/sliders', $fileNameToStore);
            $attr['image'] = $fileNameToStore;
        }

        $slider->update($attr);

        return back();
    }
}
