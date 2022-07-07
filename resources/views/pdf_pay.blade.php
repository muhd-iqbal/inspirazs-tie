<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invois TaliLeher Inspirazs #{{ $payment }}</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
            border-collapse: collapse;
        }

        .list tr td,
        .list tr th {
            border: 1px solid black;
            padding: .2rem;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            text-align: center;
            font-size: 0.5rem;
            color: darkgray;
        }

        p {
            font-weight: bold;
        }
    </style>

</head>

<body>
    <span style="float: right; color: lightslategray; font-weight: bold;">
        RESIT
    </span>
    <div style="text-align: center; margin-bottom: 1.5rem;">
        <img src="{{ base_path() }}/public/images/logo-letterhead-2.png" width="60%" />
    </div>
    <hr>
    <table width="100%">
        <tr>
            <td valign="top" align="left">
                <p>Kepada:</p>

                <strong>{{ $order->customer_organisation ? $order->customer_organisation : $order->customer_name }}</strong>
                <br>
                {{ $order->customer_address }}
                <br>
                {{ $order->customer_postcode . ', ' . $order->customer_city }}
                <br>
                {{ $order->customer_state }}
                <br>
                Emel: {{ $order->customer_email }}
                <br>
                Telefon: {{ phone_format($order->customer_phone) }}
                @if ($order->customer_organisation)
                    <br> <strong>U/P: {{ $order->customer_name }}</strong>
                @endif
            </td>
            <td align="right" valign="top">
                <p>Bayar Kepada:</p>
                {{ $web_var['company_bank_acc'] }}
                {!! array_key_exists('company_bank_acc_2', $web_var->toArray()) ? '<br>' . $web_var['company_bank_acc_2'] : '' !!}
                {!! array_key_exists('company_bank_acc_3', $web_var->toArray()) ? '<br>' . $web_var['company_bank_acc_3'] : '' !!}

            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td><strong>
                    <strong>No Pesanan: #{{ $order->id }}</strong>
            </td>
            <td align="right">
                <pre>
                        <strong>Tarikh: </strong>{{ date('d-m-Y', strtotime($order->date)) }}
                </pre>
            </td>
        </tr>
    </table>

    <table width="100%" class="list">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Kuantiti</th>
                <th>Harga Seunit</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->item as $pro)
                <tr>
                    <td scope="row" align="center">{{ $loop->iteration }}</td>
                    <td>{!! $pro->product !!}</td>
                    <td align="center">{{ $pro->quantity }}</td>
                    <td align="center">{{ RM($pro->price) }}</td>
                    <td align="right">{{ RM($pro->total) }}</td>
                </tr>
            @endforeach
            @for ($i = 1; $i <= 6 - $order->item->count(); $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endfor
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" align="right">Subjumlah: RM</th>
                <td align="right">{{ RM($order->total) }}</td>
            </tr>
            <tr>
                <th colspan="4" align="right">Penghantaran: RM</th>
                <td align="right">{{ RM($order->shipping) }}</td>
            </tr>
            <tr>
                <th colspan="4" align="right">Jumlah: RM</th>
                <td align="right">{{ RM($order->grand_total) }}</td>
            </tr>
        </tfoot>
    </table>
    <div style="padding: 2rem; font-size:.7rem; text-align:center;">
        Untuk sebarang pertanyaan sila hubungi nombor diatas atau En. Zamri (0174033135)
    </div>
    <h2 align="center">Terima Kasih!</h2>
    <footer>CETAKAN KOMPUTER. TANDATANGAN TIDAK DIPERLUKAN</footer>
</body>

</html>
