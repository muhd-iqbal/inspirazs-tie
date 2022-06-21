<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <div style="text-align: center">
        <h1>Tali Leher Inspirazs</h1>
    </div>

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
                Tel: {{ phone_format($order->customer_phone) }}
                @if ($order->customer_organisation)
                    <br> <strong>U/P: {{ $order->customer_name }}</strong>
                @endif
            </td>
            <td align="right">
                <h3>{{ $web_var['company_name'] }}</h3>
                <pre>
                {{ $web_var['company_address'] }}
                {{ $web_var['company_address_2'] }}
                {{ $web_var['company_postcode'] . ', ' . $web_var['company_city'] }}
                {{ $web_var['company_state'] }}
                Tel: {{ phone_format($web_var['company_phone']) }}
                Email:{{ $web_var['company_email'] }}
            </pre>
            <pre>
                <strong>Bayar Kepada</strong>
                {{ $web_var['company_bank_acc'] }}
        </pre>
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


    <table width="100%">
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
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $pro->product }}</td>
                <td align="center">{{ $pro->quantity }}</td>
                <td align="center">{{ RM($pro->price) }}</td>
                <td align="right">{{ RM($pro->total) }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Subjumlah RM</td>
                <td align="right">{{ RM($order->total) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Penghantaran RM</td>
                <td align="right">{{ RM($order->shipping) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Jumlah RM</td>
                <td align="right" class="gray">{{ RM($order->grand_total) }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
