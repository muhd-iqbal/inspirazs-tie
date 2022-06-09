<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', [
            'products' => Product::with('category')->where('active', 1)->get(),
            'categories' => ProductCategory::where('featured', 1)->get(),
        ]);
    }
    public function select($slug)
    {
        $product = Product::with('prices')->where('slug', '=', $slug)->first();

        return view('product', [
            'product' => Product::with(['prices', 'category'])->where('slug', '=', $slug)->first(),
            'prices' => ProductPrice::where('product_id', $product->id)->orderBy('min', 'ASC')->get(),
        ]);
    }

    public function add(Request $request)
    {
        // recommend image is 1200px x 1485px
        $attr = $request->validate([
            'name' => 'required|unique:products,name|max:255|min:5'
        ]);
    }
}
