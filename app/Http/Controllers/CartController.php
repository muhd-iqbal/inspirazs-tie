<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Variable;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $list_price =  ProductPrice::select('loan', 'cash')->where('min', '<=', request('quantity'))->where('max', '>=', request('quantity'))->where('product_id', $product->id)->first();

        $fr = ProductPrice::where('product_id', $product->id)->orderBy('min', 'ASC')->first();
        $to = ProductPrice::where('product_id', $product->id)->orderBy('max', 'DESC')->first();
        if ($fr && $to) {
            $min = $fr->min;
            $max = $to->max;
        }
        else{
            $min = $max = 0;
        }

        $attr = request()->validate([
            'quantity' => "required|numeric|min:$min|max:$max",
        ]);

        if (session('loan')) {
            $price = $list_price->loan;
        } else {
            $price = $list_price->cash;
        }

        if (Cart::has($product->id)) {
            Cart::update($product->id, array(
                'price' => $price,
                'quantity' => array(
                    'relative' => false,
                    'value' => $attr['quantity']
                ),
                'attributes' => ['weight' => $product->weight * $attr['quantity']],
            ));
        } else {
            Cart::add(array(
                'id' => $product->id, // inique row ID
                'name' => $product->name,
                'price' => $price,
                'quantity' => $attr['quantity'],
                'attributes' => ['weight' => $product->weight * $attr['quantity']],
                'associatedModel' => 'App\\Models\\Product'
            ));
        }

        return redirect('/shopping-cart')->with('success', 'Produk Ditambah dalam troli.');
    }

    public function read()
    {
        return view('shopping-cart');
    }

    public function checkout()
    {
        if (Cart::getContent()->count() == 0) {
            return redirect('/products')->with('danger', 'Troli Kosong, sila tambah produk ke dalam troli terlebih dahulu.');
        }
        return view('checkout');
    }

    public function checkout_address(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'customer_organisation' => 'nullable|max:255',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|numeric|digits_between:7,11',
            'customer_address' => 'required|max:255',
            'customer_postcode' => 'required|numeric|digits:5',
            'customer_city' => 'required|max:100',
            'customer_state' => 'required|max:50',
        ]);

        if (Cart::getTotalQuantity() >= Variable::select('description')->where('name', '=', 'free_shipping')->first()->description) {
            session(['shipping_fees' => 0]);
        } else {
            $shipping = DB::table('shippings')
                ->select('fee')
                ->where('postcode_fr', '<=', $request->customer_postcode)
                ->where('postcode_to', '>=', $request->customer_postcode)
                ->where('weight_fr', '<=', get_total_weight())
                ->where('weight_to', '>=', get_total_weight())
                ->first();

            session(['shipping_fees' => $shipping->fee]);
        }

        session($request->toArray());
        return redirect('/checkout-confirm');
    }

    public function checkout_confirm()
    {
        if (Cart::getContent()->count() == 0) {
            return redirect('/products')->with('danger', 'Troli Kosong, sila tambah produk ke dalam troli terlebih dahulu.');
        }
        return view('checkout-confirm');
    }

    public function destroy()
    {
        Cart::clear();

        return back()->with('success', 'Troli Dikosongkan.');
    }

    public function remove($cart)
    {
        Cart::remove($cart);

        return back()->with('success', 'Troli Dikemaskini');
    }
}
