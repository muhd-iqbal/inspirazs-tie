<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'name' => 'required|unique:products,name|max:255|min:5',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $attr['slug'] = Str::slug($request->name);

        Product::create($attr);
    }

    public function list()
    {
        return view('admin.products', [
            'products' => Product::with('category')->where('active', 1)->get(),
            'categories' => ProductCategory::where('featured', 1)->get(),
        ]);
    }

    public function view(Product $product)
    {
        return view('admin.product', [
            'product' => $product,
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'price' => 'required|numeric',
            'keywords' => 'required',
            'weight' => 'required|integer',
            'dimensions' => 'nullable|max:255',
            'materials' => 'nullable|max:255',
            'size' => 'nullable|max:255',
            'active' => 'required|boolean',
            'desc_short' => 'nullable',
            'desc_long' => 'nullable',
            'picture' => 'image',
        ]);

        $attr = $request->toArray();

        if ($request->hasFile('picture')) {
            // $filenameWithExt    = $request->file('picture')->getClientOriginalName();
            $filename           = $request->name;
            $extension          = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore    = $filename . '_' . time() . '.' . $extension;
            $path               = $request->file('picture')->storeAs('public/products', $fileNameToStore);
            $attr['picture'] = $fileNameToStore;
        }


        //  $imageName = time() . '.' . $request->image->extension();

        // $request->image->move(public_path('images'), $imageName);

        $product->update($attr);

        return back()->with('success', 'Product Updated');
    }

    public function add_image(Product $product, Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:10240',
        ]);

        return $product;
    }
}
