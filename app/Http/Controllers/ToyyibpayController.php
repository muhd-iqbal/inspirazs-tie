<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ToyyibpayController extends Controller
{
    protected $toyyibpay_link = 'https://dev.toyyibpay.com/';

    public function create(Order $order)
    {
        if ($order->toyyibpay_billcode) {

            return redirect(config('tie.toyyibpay-lnk') . $order->toyyibpay_billcode);
        } else {

            $data = array(
                'userSecretKey' => config('tie.toyyibpay-key'),
                'categoryCode' => config('tie.toyyibpay-cat'),
                'billName' => 'Pesanan Tali Leher: ' . $order->id,
                'billDescription' => 'Bayaran untuk Pesanan Tali Leher Inspirazs.',
                'billPriceSetting' => 0,
                'billPayorInfo' => 1,
                'billAmount' => $order->grand_total,
                'billReturnUrl' => route('toyyibpay-status'),
                'billCallbackUrl' => route('toyyibpay-callback'),
                'billExternalReferenceNo' => $order->id,
                'billTo' => $order->customer_organisation ? $order->customer_organisation : $order->customer_name,
                'billEmail' => $order->customer_email,
                'billPhone' => $order->customer_phone,
                'billSplitPayment' => 0,
                'billSplitPaymentArgs' => '',
                'billPaymentChannel' => 0,
                'billContentEmail' => 'Terima Kasih dari Pihak Tali Leher Inspirazs!',
                'billChargeToCustomer' => 1,
            );

            $url = config('tie.toyyibpay-lnk') . 'index.php/api/createBill';

            $response = Http::asForm()->post($url, $data);

            $order->update(['toyyibpay_billcode' => $response[0]['BillCode']]);

            return redirect(config('tie.toyyibpay-lnk') . $response[0]['BillCode']);
        }
    }

    public function status(Request $request)
    {
        $order = Order::find($request->order_id);
        $payment = Payment::where('reference', '=', $request->transaction_id)->first();

        switch ($request->status_id) {
            case 1:
                Order::where('id', $order->id)->update(['paid' => $order->grand_total]);
                if ($payment === null) {
                    $payment = Payment::create([
                        'order_id' => $request->order_id,
                        'reference' => $request->transaction_id,
                        'amount' => Order::find($request->order_id)->grand_total,
                        'method' => 'fpx-toyyibpay',
                        'time' => NOW(),
                    ]);
                } else {
                    $payment->update([
                        'order_id' => $request->order_id,
                        'reference' => $request->transaction_id,
                        'amount' => Order::find($request->order_id)->grand_total,
                        'method' => 'fpx-toyyibpay',
                        'time' => NOW(),
                    ]);
                }

                // Mail::to($order->customer_email)->send(new PaymentMail($payment));

                return redirect("/o/$order->hash/$order->id")->with('alert', 'Pembayaran berjaya.');
                break;
            case 2:
                return redirect("/o/$order->hash/$order->id")->with('alert', 'Menunggu pengesahan bank, sila semak semula sebentar lagi.');
                break;
            case 3:
                return redirect("/o/$order->hash/$order->id")->with('alert', 'Pembayaran tidak berjaya. Sila cuba lagi.');
                break;
        }
    }

    public function callback(Request $request)
    {
        $order = Order::find($request->order_id);
        $payment = Payment::where('reference', '=', $request->refno)->first();

        if ($request->status == 1) {
            Order::where('id', $order->id)->update(['paid' => $order->grand_total]);
            if ($payment === null) {
                $payment = Payment::create([
                    'order_id' => $request->order_id,
                    'reference' => $request->refno,
                    'amount' => $request->amount,
                    'method' => 'fpx-toyyibpay',
                    'time' => $request->transaction_time,
                ]);
            } else {
                $payment->update([
                    'order_id' => $request->order_id,
                    'reference' => $request->refno,
                    'amount' => $request->amount,
                    'method' => 'fpx-toyyibpay',
                    'time' => $request->transaction_time,
                ]);
            }
            Mail::to($order->customer_email)->send(new PaymentMail($order, $payment));
            // Mail::to($order->customer_email)->send(new PaymentMail($payment));
        }
    }
}
