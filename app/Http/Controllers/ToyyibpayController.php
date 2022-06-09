<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToyyibpayController extends Controller
{
    protected $toyyibpay_link = 'https://dev.toyyibpay.com/';

    public function create(Order $order)
    {
        if ($order->toyyibpay_billcode) {

            return redirect($this->toyyibpay_link . $order->toyyibpay_billcode);
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

            $url = $this->toyyibpay_link . 'index.php/api/createBill';

            $response = Http::asForm()->post($url, $data);

            $order->update(['toyyibpay_billcode' => $response[0]['BillCode'], 'payment_method' => 'fpx']);

            return redirect($this->toyyibpay_link . $response[0]['BillCode']);
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

    public function status()
    {
        return $response = request()->all(['status_id', 'billcode', 'order_id']);
    }

    public function callback()
    {
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        Order::where('');
    }
}
