<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;
use PDF;

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
            'date' => date('Y-m-d'),
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

        Cart::clear();

        Mail::to($order->customer_email)->send(new OrderMail($order));

        return redirect("/o/$hash/$order->id");
    }

    public function view($hash, $order)
    {
        $order = Order::with(['item', 'payment'])->where('hash', $hash)->where('id', $order)->first();

        if ($order) {
            return view('order', [
                'order' => $order,
            ]);
        } else {
            return redirect('/shopping-cart')->with('forbidden', 'Pesanan tidak dijumpai. Sila semak semula pautan di emel / WhatsApp.');
        }
    }

    public function createPDF($hash, Order $order)
    {
        // retreive all records from db
        // $data = Employee::all();
        // share data to view
        view()->share('order', $order);
        $pdf = PDF::loadView('pdf', $order->toArray());
        // download PDF file with download method
        return $pdf->download('PDF');
    }

    // customer's choice
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
        if (request('method') == 'fpx') {
            $order->update(['payment_method' => 'fpx']);
            return redirect('/toyyibpay/' . $order->id);
        } elseif (request('method') == 'transfer') {
            $order->update(['payment_method' => 'transfer']);
            return back();
        } elseif (request('method') == 'hand') {
            $order->update(['payment_method' => 'hand']);
            return back();
        } else {
            return redirect('/');
        }
    }

    public function list_admin()
    {
        return view('admin.orders', [
            'orders' => Order::orderBy('id', 'desc')->paginate(20),
        ]);
    }

    public function view_admin(Order $order)
    {
        return view('admin.order', [
            'order' => $order,
        ]);
    }

    public function changePaymentMethod($hash, Order $order)
    {
        $order->update(['payment_method' => null]);
        return back();
    }
}
