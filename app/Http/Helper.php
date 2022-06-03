<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Cart;

// reformat payment number with prefix zeroes
if (!function_exists('payment_num')) {

    function payment_num($var)
    {
        return str_pad($var, 6, '0', STR_PAD_LEFT);
    }
}

//reformat phone number displays
if (!function_exists('phone_format')) {
    function phone_format($phoneNumber)
    {
        if (strlen($phoneNumber) == 10) { //XXX-XXX XXXX
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);

            $phoneNumber = $areaCode . '-' . $nextThree . ' ' . $lastFour;
        } else if (strlen($phoneNumber) == 9) { // XX-XXX XXXX
            $areaCode = substr($phoneNumber, 0, 2);
            $nextThree = substr($phoneNumber, 2, 3);
            $lastFour = substr($phoneNumber, 5, 4);

            $phoneNumber = $areaCode . '-' . $nextThree . ' ' . $lastFour;
        } else if (strlen($phoneNumber) == 11) { // XXX-XXXX XXXX
            $areaCode = substr($phoneNumber, 0, 3);
            $nextFour = substr($phoneNumber, 3, 4);
            $lastFour = substr($phoneNumber, 7, 4);

            $phoneNumber = $areaCode . '-' . $nextFour . ' ' . $lastFour;
        }
        return $phoneNumber;
    }
}
//reformat IC displays
if (!function_exists('ic_format')) {
    function ic_format($icNumber)
    {
        // XXXXXX-XX-XXXX
        $firstSix = substr($icNumber, 0, 6);
        $nextFour = substr($icNumber, 6, 2);
        $lastFour = substr($icNumber, 8, 4);

        $icNumber = $firstSix . '-' . $nextFour . '-' . $lastFour;

        return $icNumber;
    }
}

// assign order number based on prefix on env file
if (!function_exists('order_num')) {
    function order_num($var)
    {
        return env('ORDER_PREFIX') . str_pad($var, 5, '0', STR_PAD_LEFT);
    }
}
// assign quote number based on prefix on env file
if (!function_exists('quote_num')) {
    function quote_num($var)
    {
        return env('QUOTE_PREFIX') . str_pad($var, 5, '0', STR_PAD_LEFT);
    }
}
if (!function_exists('pay_vo_num')) {
    function pay_vo_num($var)
    {
        return env('PAYMENT_VOUCHER_PREFIX') . str_pad($var, 5, '0', STR_PAD_LEFT);
    }
}

//helper to make grandtotal and due updated on row update

// if (!function_exists('order_adjustment')) {
//     function order_adjustment($id)
//     {
//         DB::table('orders')->where('id', $id)->update([
//             'grand_total' => DB::raw('`total`-`discount`+`shipping`'),
//             'due' => DB::raw('`grand_total`-`paid`')
//         ]);
//     }
// }
// //helper to make grandtotal and due updated on row update

// convert integer to money format from database
if (!function_exists('RM')) {
    function RM($amount)
    {
        return number_format($amount / 100, 2);
    }
}

//calculate order when item change total price
// if (!function_exists('recalculate_order')) {
//     function recalculate_order($order)
//     {
//         $statement = "UPDATE orders od
//         INNER JOIN (
//           SELECT SUM(total) as totals
//           FROM order_items
//           WHERE order_id = $order
//         ) oi ON od.id = $order
//         SET od.total = oi.totals";
//         DB::statement($statement);
//         DB::statement("UPDATE orders SET grand_total = total + shipping - discount, due = grand_total - paid WHERE id = $order");
//     }
// }

if (!function_exists('month_name')) {
    function month_name($int)
    {
        $month = [
            '1' => 'Januari',
            '2' => 'Febuari',
            '3' => 'Mac',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Jun',
            '7' => 'Julai',
            '8' => 'Ogos',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Disember',
        ];
        return $month[$int];
    }
}

// if(!function_exists('web_var')){
//     function web_var()
//     {
//         return DB::table('web_variables')->first();
//     }
// }

if (!function_exists('get_total_weight')) {
    function get_total_weight()
    {
        $total = 0;
        foreach (Cart::getContent() as $row) {
            $total += $row->attributes->weight;
        }
        return $total;
    }
}
