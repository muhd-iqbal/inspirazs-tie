@component('mail::message')

Hi {{ $customer_name }},

# Terima kasih kerana membuat pesanan di {{ env('APP_NAME') }}

No Pesanan anda adalah #{{ $id }}.

Sila klik butang ini untuk mengakses pesanan anda.

@component('mail::button', ['url' => env('APP_URL') . '/o/' . $hash . '/' . $id])
Lihat Pesanan
@endcomponent

Untuk pembayaran tunai, anda boleh membuat bayaran di halaman tersebut.

Klik/salin pautan ini jika butang diatas tidak berfungsi.
<a href="{{ env('APP_URL') . '/o/' . $hash . '/' . $id }}" target="_blank">{{ env('APP_URL') . '/o/' . $hash . '/' . $id }}</a>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
