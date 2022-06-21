<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            // $filenameWithExt    = $request->file('picture')->getClientOriginalName();
            $filename           = $product->name;
            $extension          = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore    = $filename . '_' . time() . '.' . $extension;
            $path               = $request->file('photo')->storeAs('public/products', $fileNameToStore);
            $attr['path'] = $fileNameToStore;
        }
        $attr['product_id'] = $product->id;
        ProductImage::create($attr);

        return back();
    }

    public function delete(Product $product, ProductImage $image)
    {
        $image->delete();

        return back()->with('success', 'Image Deleted');
    }

}
