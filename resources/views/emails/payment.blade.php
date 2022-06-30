@component('mail::message')

Hi {{ $order['customer_name'] }},

Bayaran berjumlah RM{{ RM($payment['amount']) }} untuk pesanan #{{ $payment['order_id'] }} telah diterima dan akan dikemaskini oleh pihak {{ config('app.name') }}.

@component('mail::button', ['url' => config('app.url') . '/o/' . $order['hash'] . '/' . $order['id']])
Lihat Pesanan
@endcomponent

Klik/salin pautan ini jika butang diatas tidak berfungsi.
<a href="{{ config('app.url') . '/o/' . $order['hash'] . '/' . $order['id'] }}" target="_blank">{{ config('app.url') . '/o/' . $order['hash'] . '/' . $order['id'] }}</a>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
