<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function view(Product $product)
    {
        $prices = ProductPrice::where('product_id', $product->id)->orderBy('min', 'asc')->get();

        return view('admin.prices', [
            'product' => $product,
            'prices' => $prices,
        ]);
    }

    public function update(ProductPrice $price, Request $request)
    {
        $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'cash' => 'required|numeric',
            'loan' => 'required|numeric',
        ]);

        $attr = $request->toArray();

        $attr['cash'] = $attr['cash'] * 100;
        $attr['loan'] = $attr['loan'] * 100;

        $price->update($attr);

        return back()->with('success', 'Price Updated');
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'cash' => 'required|numeric',
            'loan' => 'required|numeric',
        ]);

        $attr = $request->toArray();

        $attr['product_id'] = $product->id;
        $attr['cash'] = $attr['cash'] * 100;
        $attr['loan'] = $attr['loan'] * 100;
        ProductPrice::create($attr);

        return back()->with('success', 'Price Added');
    }

    public function delete(ProductPrice $price)
    {
        $price->delete();

        return back()->with('success', 'Price Deleted');
    }
}
