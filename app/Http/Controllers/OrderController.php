<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Cart;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'add_order' => 'accepted'
        ]);

        $hash = sha1(session('email'));
        $method = session('loan') ? 'loan' : 'cash';
        $order = Order::create([
            'hash' => $hash,
            'method' => $method, //change
            'customer_name' => session('customer_name'),
            'customer_organisation' => session('customer_organisation'),
            'customer_address' => session('customer_address'),
            'customer_postcode' => session('customer_postcode'),
            'customer_city' => session('customer_city'),
            'customer_state' => session('customer_state'),
            'customer_phone' => session('customer_phone'),
            'customer_email' => session('customer_email'),
            'weight' => get_total_weight(),
            'total' => Cart::getTotal(),
            'shipping' => session('shipping_fees'),
            'grand_total' => Cart::getTotal() + session('shipping_fees'),
        ]);

        foreach (Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->getPriceSum(),
            ]);
        }

        return redirect("/o/$hash/$order->id");
    }

    public function view($hash, $order)
    {
        $order = Order::with(['item','payment'])->where('hash', $hash)->where('id', $order)->first();

        if ($order) {
            return view('order', [
                'order' => $order,
            ]);
        } else {
            return redirect('/shopping-cart')->with('forbidden', 'Pesanan tidak dijumpai. Sila semak semula pautan di emel / WhatsApp.');
        }
    }

    public function ch_pay_method(Request $request)
    {
        Cart::clear();

        if (session('loan')) {
            $request->session()->forget('loan');
        } else {
            $request->session()->put('loan', true);
        }

        return back();
    }

    public function payment(Order $order)
    {
        if(request('method')=='fpx'){
            return redirect('/toyyibpay/'.$order->id);
        }
        elseif(request('method')=='transfer'){
            $order->update(['method'=>'transfer']);
            return back();
        }
        else{
            return 404;
        }
    }
}
