<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $list_price =  ProductPrice::select('loan', 'cash')->where('min', '<=', request('quantity'))->where('max', '>=', request('quantity'))->where('product_id', $product->id)->first();

        $min = ProductPrice::where('product_id', $product->id)->orderBy('min', 'ASC')->first()->min;

        $attr = request()->validate([
            'quantity' => 'required|numeric|min:'.$min,
        ]);

        if(session('payment')=="loan"){
            $price = $list_price->loan;
        }
        else{
            $price = $list_price->cash;
        }
        if(Cart::isEmpty()){
            Cart::add($product->id, $product->name, $price, $attr['quantity'], array())->associate('App\\Models\\Product');
        }
        else{
            Cart::remove($product->id);
            Cart::add($product->id, $product->name, $price, $attr['quantity'], array())->associate('App\\Models\\Product');

        }

        return back()->with('success', 'Produk Ditambah dalam troli.');
    }

    public function read()
    {
        // return Cart::getContent();
        // Cart::clear();
        // return Cart::getContent();
        return view('shopping-cart');
    }

    public function checkout()
    {
        if(Cart::getContent()->count()==0){
            return redirect('/products')->with('danger', 'Troli Kosong, sila tambah produk ke dalam troli terlebih dahulu.');
        }
        return view('checkout');
    }
}
