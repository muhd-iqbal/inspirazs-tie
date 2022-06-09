<x-layout header="header-v4">
    <style>
        tfoot td:nth-child(2) {
            border-left: 1px solid #e9ecef
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <x-title-page title="Invois Pesanan: {{ $order->id }}" />
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

    <div class="container p-t-15">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-5 pb-2">
                            <div class="col-md-6">
                                <img class="h-50" src="{{ asset('images/icons/logo-updated.png') }}">
                            </div>

                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Pesanan #{{ $order->id }}</p>
                                {{-- <p class="text-muted">Due to: 4 Dec, 2019</p> --}}
                            </div>
                        </div>

                        <hr />

                        <div class="row pb-5 p-5 pt-2">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-4">Kepada:</p>
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

                            <div class="col-md-6 text-right">
                                @if ($order->method == 'cash')
                                    <p class="font-weight-bold mb-4">Kaedah Pembayaran</p>
                                    <form action="/pay/{{ $order->id }}">
                                        <select name="method" id="method" class="btn btn-light">
                                            <option value="fpx">FPX - ToyyibPay</option>
                                            <option value="transfer">Pemindahan Bank</option>
                                            <option value="cash">Tunai di Kedai</option>
                                        </select>
                                        <button type="submit" class="btn btn-info">Bayar</button>
                                    </form>
                                    <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                                    <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                                    <p class="mb-1"><span class="text-muted">Payment Type: </span> Root
                                    </p>
                                    <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                                @endif
                                @if ($order->method == 'loan')
                                    <div class="font-weight-bold mb-4">
                                        Bayar Kepada:
                                    </div>
                                    <div class="">
                                        <div class="h4 font-weight-bold">{{ $web_var['company_name'] }}</div>
                                        <div class="h6">{{ $web_var['company_ssm'] }}</div>
                                        <div class="h6">{{ $web_var['company_address'] }}</div>
                                        <div>{{ $web_var['company_postcode'] }}, {{ $web_var['company_city'] }}
                                        </div>
                                        <div>{{ $web_var['company_state'] }}</div>
                                    </div>
                                    <div class="mt-2">

                                        <div class="">
                                            <div>No Akaun:</div>
                                            <div> {{ $web_var['company_bank_acc'] }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row p-5">
                            <div class="col-md-12 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">#</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Produk</th>
                                            <th class="border-0 text-uppercase small font-weight-bold text-center">
                                                Kuantiti</th>
                                            <th class="border-0 text-uppercase small font-weight-bold text-center">Harga
                                                (RM)</th>
                                            <th class="border-0 text-uppercase small font-weight-bold text-right">Jumlah
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
                                                <td>{{ $item->product }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">{{ RM($item->price) }}</td>
                                                <td class="text-right">{{ RM($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($order->payment->count())

                                    <div>Senarai Pembayaran</div>
                                    <div class="table-responsive">
                                        <table class="w-100">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Masa</td>
                                                    <td>ID Rujukan</td>
                                                    <td>Cara Bayaran</td>
                                                    <td>Amaun</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->payment as $pay)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pay->time }}</td>
                                                        <td>{{ $pay->reference }}</td>
                                                        <td>{{ $pay->method }}</td>
                                                        <td>{{ $pay->amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="d-flex flex-row-reverse p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Jumlah</div>
                                <div class="h4 font-weight-light">RM{{ RM($order->grand_total) }}</div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Penghantaran</div>
                                <div class="h4 font-weight-light">{{ $order->shipping ? 'RM '. RM($order->shipping) : 'Percuma'}}</div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Subjumlah</div>
                                <div class="h4 font-weight-light">RM{{ RM($order->total) }}</div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank"
                href="http://totoprayogo.com">totoprayogo.com</a></div>

    </div>




</x-layout>
