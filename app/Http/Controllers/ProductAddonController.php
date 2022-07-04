<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAddon;
use Illuminate\Http\Request;

class ProductAddonController extends Controller
{
    public function view(Product $product)
    {
        return view('admin.product-addon', [
            'product' => $product,
        ]);
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        $attr = $request->toArray();
        $attr['product_id'] = $product->id;
        $attr['price'] = $attr['price']*100;

        ProductAddon::create($attr);

        return back();
    }

    public function patch(Product $product, ProductAddon $addon, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric',
        ]);

        $attr = $request->toArray();
        $attr['price'] = $attr['price']*100;

        $addon->update($attr);

        return back();
    }
}
