@component('mail::message')

Hi {{ $order['customer_name'] }},

Bayaran berjumlah RM{{ RM($payment['amount']) }} untuk pesanan #{{ $payment['order_id'] }} telah diterima dan akan dikemaskini oleh pihak {{ env('APP_NAME') }}.

@component('mail::button', ['url' => env('APP_URL') . '/o/' . $order['hash'] . '/' . $order['id']])
Lihat Pesanan
@endcomponent

Klik/salin pautan ini jika butang diatas tidak berfungsi.
<a href="{{ env('APP_URL') . '/o/' . $order['hash'] . '/' . $order['id'] }}" target="_blank">{{ env('APP_URL') . '/o/' . $order['hash'] . '/' . $order['id'] }}</a>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
