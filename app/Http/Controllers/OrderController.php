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

        $order = Order::create([
            'hash' => $hash,
            'method' => 'cash',//change
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
}
