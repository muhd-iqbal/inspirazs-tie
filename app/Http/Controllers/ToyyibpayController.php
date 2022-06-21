<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ToyyibpayController extends Controller
{
    protected $toyyibpay_link = 'https://dev.toyyibpay.com/';

    public function create(Order $order)
    {
        if ($order->toyyibpay_billcode) {

            return redirect(env('TOYYIBPAY_LINK') . $order->toyyibpay_billcode);
        } else {

            $data = array(
                'userSecretKey' => env('TOYYIBPAY_KEY'),
                'categoryCode' => env('TOYYIBPAY_CATEGORY'),
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

            $url = env('TOYYIBPAY_LINK') . 'index.php/api/createBill';

            $response = Http::asForm()->post($url, $data);

            $order->update(['toyyibpay_billcode' => $response[0]['BillCode']]);

            return redirect(env('TOYYIBPAY_LINK') . $response[0]['BillCode']);
        }
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_POST, 1);
        // curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // $result = curl_exec($curl);
        // $info = curl_getinfo($curl);
        // curl_close($curl);
        // $obj = json_decode($result);
        // echo $result;
    }

    public function status(Request $request)
    {
        $order = Order::find($request->order_id);

        switch ($request->status_id) {
            case 1:
                Order::where('id', $order->id)->update(['paid'=>$order->grand_total]);
                Payment::create([
                    'order_id' => $request->order_id,
                    'reference' => $request->transaction_id,
                    'amount' => Order::find($request->order_id)->grand_total,
                    'method' => 'fpx-toyyibpay',
                    'time' => NOW(),
                ]);

                return redirect("/o/$order->hash/$order->id")->with('alert', 'Pembayaran berjaya.');
                break;
            case 2:
                return redirect("/o/$order->hash/$order->id")->with('alert', 'Pembayaran belum selesai. Menunggu pengesahan bank.');
                break;
            case 3:
                return redirect("/o/$order->hash/$order->id")->with('alert', 'Pembayaran tidak berjaya. Sila cuba lagi.');
                break;
        }

        if ($request->status_id == 1) {
        }

        return $response = request()->all(['status_id', 'billcode', 'order_id']);
    }

    public function callback(Request $request)
    {
        //if ($request->status == 1) {
        Payment::create([
            'order_id' => $request->order_id,
            'reference' => $request->refno,
            'amount' => $request->amount,
            'method' => 'fpx-toyyibpay',
            'time' => $request->transaction_time,
        ]);
        //}
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        Log::info($response);
    }
}
