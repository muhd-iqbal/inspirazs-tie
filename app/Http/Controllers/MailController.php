<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function order_view()
    {
        $order = Order::find(1005);

        return new OrderMail($order);
    }
    public function order(Order $order)
    {
        Mail::to($order->customer_email)->send(new OrderMail($order));

        return redirect("/o/$order->hash/$order->id");
    }
}
