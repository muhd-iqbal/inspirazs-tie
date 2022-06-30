@component('mail::message')

Hi {{ $customer_name }},

# Terima kasih kerana membuat pesanan di {{ config('app.name') }}

No Pesanan anda adalah #{{ $id }}.

Sila klik butang ini untuk mengakses pesanan anda.

@component('mail::button', ['url' => config('app.url') . '/o/' . $hash . '/' . $id])
Lihat Pesanan
@endcomponent

Untuk pembayaran melalui fpx (pemindahan atas talian), boleh dibuat di halaman tersebut.

Klik/salin pautan ini jika butang diatas tidak berfungsi.
<a href="{{ config('app.url') . '/o/' . $hash . '/' . $id }}" target="_blank">{{ config('app.url') . '/o/' . $hash . '/' . $id }}</a>

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
