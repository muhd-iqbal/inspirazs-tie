<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function add(Order $order, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'method' => 'required|max:50',
            'reference' => 'required|max:50',
            'time' => 'required|date',
            'attachment' => 'image'
        ]);

        $attr = $request->toArray();
        $attr['order_id'] = $order->id;
        $attr['amount'] = $request->amount*100;

        if ($request->hasFile('attachment')) {
            // $filenameWithExt    = $request->file('picture')->getClientOriginalName();
            $filename           = $request->name;
            $extension          = $request->file('attachment')->getClientOriginalExtension();
            $fileNameToStore    = $filename . '_' . time() . '.' . $extension;
            $path               = $request->file('attachment')->storeAs('public/payments', $fileNameToStore);
            $attr['attachment'] = $fileNameToStore;
        }

        Payment::create($attr);
        $order->increment('paid', $attr['amount']);

        return back();
    }

    public function delete(Order $order, Payment $payment)
    {
        $order->decrement('paid', $payment->amount);
        $payment->delete();

        return back();
    }
}
