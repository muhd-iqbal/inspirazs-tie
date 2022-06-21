<x-layout header="header-v4">
    <style>
        .card {
            padding: 30px 40px;
            /* margin-top: 60px; */
            margin-bottom: 60px;
            border: none !important;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2)
        }

        .blue-text {
            color: #00BCD4
        }

        .form-control-label {
            margin-bottom: 0
        }

        input,
        textarea,
        button {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            /* font-size: 18px !important; */
            font-weight: 300
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer
        }

        .btn-block:hover {
            color: #fff !important
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <x-title-page title="Pengesahan" />
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                <a href="/shopping-cart" class="stext-109 cl8 hov-cl1 trans-04">
                    Troli <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
            </span>
            <span class="stext-109 cl4">
                <a href="/checkout" class="stext-109 cl8 hov-cl1 trans-04">
                    Maklumat Tempahan <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
            </span>
            <span class="stext-109 cl4">
                Sahkan pesanan
            </span>
        </div>
    </div>

    <!-- Shoping Cart -->
    {{-- <form class="bg0 p-t-30 p-b-85"> --}}
    <div class="container p-t-30">
        <div class="card">
            <div class="card-header">
                Tarikh: <strong>{{ date('d-m-Y') }}</strong>
                <span class="float-right"> <strong>Pembayaran:
                        {{ session('loan') ? 'Pinjaman (LO)' : 'Tunai' }}</strong></span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Maklumat:</h6>

                        <div>
                            @if (session('customer_organisation'))
                                <strong>{{ session('customer_organisation') }}</strong>
                            @else
                                <strong>{{ session('customer_name') }}</strong>
                            @endif
                        </div>
                        <div>{{ session('customer_address') }}</div>
                        <div>{{ session('customer_postcode') }}, {{ session('customer_city') }}</div>
                        <div>{{ session('customer_state') }}</div>
                        <div>Emel: {{ session('customer_email') }}</div>
                        <div>Tel: {{ phone_format(session('customer_phone')) }}</div>
                        @if (session('customer_organisation'))
                            <div><strong>U/P: {{ session('customer_name') }}</strong></div>
                        @endif
                    </div>

                    {{-- <div class="col-sm-6">
                        <h6 class="mb-3">Kepada:</h6>
                        <div>
                            <strong>Bob Mart</strong>
                        </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: marek@daniel.com</div>
                        <div>Phone: +48 123 456 789</div>
                    </div> --}}

                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Produk</th>

                                <th class="text-center">Harga / Unit</th>
                                <th class="text-center">Kuantiti</th>
                                <th class="text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::getContent() as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-left strong">{{ $row->name }}</td>
                                    <td class="text-center">{{ RM($row->price) }}</td>
                                    <td class="text-center">{{ $row->quantity }}</td>
                                    <td class="text-right">{{ RM($row->getPriceSum()) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subjumlah</strong>
                                    </td>
                                    <td class="right">RM{{ RM(Cart::getSubtotal()) }}</td>
                                </tr>
                                {{-- <tr>
                                    <td class="left">
                                        <strong>Discount (20%)</strong>
                                    </td>
                                    <td class="right">$1,699,40</td>
                                </tr> --}}
                                <tr>
                                    <td class="left">
                                        <strong>Penghantaran</strong>
                                    </td>
                                    <td class="right">
                                        {{ session('shipping_fees') > 0 ? 'RM' . RM(session('shipping_fees')) . '(' . get_total_weight() / 1000 . 'kg)' : 'Percuma melebihi ' . $web_var['free_shipping'] . ' unit' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Jumlah</strong>
                                    </td>
                                    <td class="right">
                                        <strong>RM{{ RM(Cart::getSubtotal() + session('shipping_fees')) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="text-center">
                    <small class="text-danger">Pautan untuk pesanan anda akan dihantar ke emel diatas. <br>Sila semak bahagian spam jika tidak menerima emel.</small>
                    <form action="/checkout-confirm" method="POST" id="checkout-confirm" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <div class="form-check">
                                <input class="d-inline" type="checkbox" name="add_order" id="invalidCheck"
                                    required />
                                <label class="d-inline" for="invalidCheck">Tandakan untuk sahkan pesanan.</label>
                                <div class="invalid-feedback">Anda perlu sahkan pesanan tengan menanda ruangan ini.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            {{-- <button class="btn btn-primary" type="submit"> --}}
                            <button type="submit" class="g-recaptchabtn-block btn-dark"
                                data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' data-action='submit'>
                                Sahkan Pesanan Anda</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function onSubmit(token) {
            document.getElementById("checkout-confirm").submit();
        }
    </script>

</x-layout>
