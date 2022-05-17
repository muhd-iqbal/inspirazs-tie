<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product');
    }

    public function select($slug)
    {
        return view('product', [
            'product' => Product::with(['prices','category'])->where('slug', '=', $slug)->first(),
        ]);
    }
}
