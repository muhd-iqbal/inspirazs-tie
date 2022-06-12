<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories', [
            'categories' => ProductCategory::all(),
        ]);
    }

    public function add(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|max:50|unique:product_categories,name',
        ]);

        $attr['slug'] = Str::slug($request->name);

        ProductCategory::create($attr);

        return back();
    }
}
