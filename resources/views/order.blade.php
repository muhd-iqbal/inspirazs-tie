<x-layout header="header-v4" title="Pesanan #{{ $order->id }}" robot="noindex">
    <style>
        tfoot td:nth-child(2) {
            border-left: 1px solid #e9ecef
        }

        .modal-dialog {
            position: fixed;
            top: auto;
            right: auto;
            left: auto;
            bottom: 0;
        }

        td,
        th {
            border: 1px solid #d1d1d1;
            padding: 0.5em 1em 0.5em 1em;
        }

        th {
            font-size: 80%;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <x-title-page title="Pesanan: #{{ $order->id }}" />
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Utama
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Pesanan
            </span>
        </div>
    </div>

    <div class="container p-t-15 p-b-100">
        @if (session('alert'))
            <div class="alert alert-info text-center">
                {{ session('alert') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row pb-2" style="height: 100px;">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Pesanan #{{ $order->id }}</p>
                                <button class="btn btn-info"
                                    onclick="location.href='/o/{{ $order->hash }}/{{ $order->id }}/pdf'">Muat
                                    Turun Invois</button>
                            </div>
                        </div>

                        <hr />

                        <div class="row pb-5 pt-2">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-2">Kepada:</p>
                                @if ($order->customer_organisation)
                                    <p class="mb-1 h5 font-weight-bold">{{ $order->customer_organisation }}</p>
                                @else
                                    <p class="mb-1">{{ $order->customer_name }}</p>
                                @endif
                                <p>{{ $order->customer_address }}</p>
                                <p class="mb-1">
                                    {{ $order->customer_postcode . ', ' . $order->customer_city }}</p>
                                <p class="mb-1">{{ $order->customer_state }}</p>
                                <p class="mb-1">Emel: {{ $order->customer_email }}</p>
                                <p class="mb-1">Tel: {{ phone_format($order->customer_phone) }}</p>
                                @if ($order->customer_organisation)
                                    <p class="mb-1 font-weight-bold">U/P: {{ $order->customer_name }}</p>
                                @endif
                            </div>

                            <div class="col-md-6 text-md-right mt-5 mt-md-0">
                                @if ($order->method == 'cash')
                                    <p class="font-weight-bold mb-2">Kaedah Pembayaran</p>
                                    @unless($order->payment_method)
                                        <form action="/pay/{{ $order->id }}">
                                            <select name="method" id="method" class="btn btn-light">
                                                <option value="fpx">FPX - ToyyibPay</option>
                                                <option value="transfer">Pemindahan Bank</option>
                                                <option value="hand">Tunai di Kedai</option>
                                            </select>
                                            <button type="submit" class="btn btn-info">Bayar</button>
                                        </form>
                                    @endunless
                                    <form action="/o/{{ $order->hash }}/{{ $order->id }}/change-payment-method"
                                        method="POST" id="change-pay-method">@csrf</form>
                                    @switch($order->payment_method)
                                        @case('fpx')
                                            <p class="mb-2">FPX / Online Transaction: </p>
                                            <div class="d-md-flex justify-content-end">
                                                @if ($order->grand_total != $order->paid)
                                                    <a href="{{ config('tie.toyyibpay-lnk') . $order->toyyibpay_billcode }}"
                                                        class="btn btn-warning">Buat Bayaran</a>
                                                @else
                                                    <a href="{{ config('tie.toyyibpay-lnk') . $order->toyyibpay_billcode }}"
                                                        class="btn btn-warning" target="_blank">Lihat Bayaran</a>
                                                @endif
                                            </div>
                                        @break

                                        @case('transfer')
                                            <p class="mb-2">Pemindahan Bank: </p>
                                            <div class="justify-content-end mb-2">
                                                <p> Sila buat pemindahan ke akaun:</p>
                                                <p>
                                                    {{ $web_var['company_bank_acc'] }}
                                                </p>
                                                <p>
                                                    {{ $web_var['company_name'] }}
                                                </p>
                                                Rujukan: <strong>Tie #{{ $order->id }}</strong>
                                            </div>
                                        @break

                                        @case('hand')
                                            <p class="mb-2">Tunai di Kedai: </p>
                                            <div class="justify-content-end mb-2">
                                                <p> Sila buat pembayaran di kedai kami:</p>
                                                <p>
                                                    {{ $web_var['company_name'] }}
                                                </p>
                                                <p>
                                                    {{ $web_var['company_address'] }}
                                                </p>
                                                <p>
                                                    {{ $web_var['company_address_2'] }}
                                                </p>
                                                <p>
                                                    {{ $web_var['company_postcode'] . ', ' . $web_var['company_city'] . ', ' . $web_var['company_state'] }}
                                                </p>
                                            </div>
                                        @break

                                        @default
                                    @endswitch
                                @endif

                                @if ($order->grand_total != $order->paid && $order->payment_method != null)
                                    <button type="submit" form="change-pay-method" class="btn btn-danger mt-2">Tukar
                                        Kaedah Pembayaran</button>
                                @endif


                                @if ($order->method == 'loan')
                                    <div class="font-weight-bold mb-4">
                                        Bayar Kepada:
                                    </div>
                                    <div class="">
                                        <div class="h4 font-weight-bold text-uppercase">
                                            {{ $web_var['company_name'] }}</div>
                                        <div class="h6">SSM: {{ $web_var['company_ssm'] }}</div>
                                        <div class="h6">{{ $web_var['company_address'] }}</div>
                                        <div class="h6">{{ $web_var['company_address_2'] }}</div>
                                        <div>{{ $web_var['company_postcode'] }},
                                            {{ $web_var['company_city'] }}
                                        </div>
                                        <div>{{ $web_var['company_state'] }}</div>
                                    </div>
                                    <div class="mt-2">

                                        <div class="">
                                            <div><strong>No Akaun:</strong></div>
                                            <div> {{ $web_var['company_bank_acc'] }}</div>
                                            {!! array_key_exists('company_bank_acc_2', $web_var->toArray()) ? '<div>' . $web_var['company_bank_acc_2'] . '</div>' : '' !!}
                                            {!! array_key_exists('company_bank_acc_3', $web_var->toArray()) ? '<div>' . $web_var['company_bank_acc_3'] . '</div>' : '' !!}

                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase">#</th>
                                            <th class="text-uppercase">Produk</th>
                                            <th class="text-uppercase text-center">
                                                Kuantiti</th>
                                            <th class="text-uppercase text-center">Harga
                                                (RM)</th>
                                            <th class="text-uppercase text-right">Jumlah
                                                (RM)</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan=4 class="text-right">Subjumlah :</td>
                                            <td class="text-right border-left">{{ RM($order->total) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan=4 class="text-right">Penghantaran :</td>
                                            <td class="text-right border-left">
                                                {{ $order->shipping ? RM($order->shipping) : 'Percuma' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan=4 class="text-right">Jumlah :</td>
                                            <td class="text-right border-left">{{ RM($order->grand_total) }}</td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($order->item as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! $item->product !!}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">{{ RM($item->price) }}</td>
                                                <td class="text-right">{{ RM($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($order->payment->count())
                            <div class="w-100 text-center">
                                <div class="h5">Senarai Pembayaran</div>
                                <div class="table-responsive">
                                    <table class="w-100 border-collapse">
                                        <thead class="border font-weight-bold">
                                            <tr>
                                                <th class="py-2 text-center">#</th>
                                                <th>Masa</th>
                                                <th>ID Rujukan</th>
                                                <th>Cara Bayaran</th>
                                                <th>Amaun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->payment as $pay)
                                                <tr>
                                                    <td class="text-center">{{ $pay->id }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($pay->time)) }}</td>
                                                    <td>{{ $pay->reference }}</td>
                                                    <td>{{ $pay->method }}</td>
                                                    <td>RM{{ RM($pay->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
