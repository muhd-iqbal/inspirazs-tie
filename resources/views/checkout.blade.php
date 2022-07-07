<x-layout header="header-v4" title="Tempahan: Maklumat Peribadi">
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

    <x-title-page title="Maklumat Tempahan" />
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
                Maklumat Tempahan
            </span>
        </div>
    </div>

    <!-- Shoping Cart -->
    <div class="container p-t-30">
        <div class="row">

            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="card">
                        <h5 class="text-center mb-4">Masukkan Maklumat Anda</h5>
                        <form class="form-card" action="/checkout" method="POST" id="checkout">
                            @csrf
                            <div class="row justify-content-between text-left">
                                <x-forms.textbox nm="customer_name" lb="Nama Penuh" req="true" col="6" />
                                <x-forms.textbox nm="customer_organisation" lb="Nama Organisasi / Syarikat / Sekolah"
                                    col="6" />
                            </div>
                            <div class="row justify-content-between text-left">
                                <x-forms.textbox nm="customer_email" lb="Alamat Emel" req="true" col="6" type="email" />
                                <x-forms.textbox nm="customer_phone" lb="No Telefon / WhatsApp" req="true" col="6" />
                            </div>
                            <div class="row justify-content-between text-left">
                                <x-forms.textbox nm="customer_address" lb="Alamat Penuh" col="12" req="true" />
                            </div>
                            <div class="row justify-content-between text-left">
                                <x-forms.textbox nm="customer_postcode" lb="Poskod" col="4" req="true" />
                                <x-forms.textbox nm="customer_city" lb="Bandar" col="4" req="true" />
                                <x-forms.textbox nm="customer_state" lb="Negeri" col="4" req="true" />
                            </div>
                            <div class="row justify-content-between text-left">
                                <div class="form-group col-sm-12 flex-column d-flex">
                                    <span class="text-danger">
                                        Sahkan bahawa maklumat yang dimasukkan adalah benar. Masukkan emel yang
                                        aktif, invois akan dihantar melalui emel.
                                    </span>
                                </div>
                            </div>
                            <div class="row justify-content-end text-right">
                                <div class="form-group col-sm-6">
                                    <button type="submit" class="g-recaptchabtn-block btn-dark"
                                        data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' data-action='submit'>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-15">
                        Ringkasan
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        @foreach (Cart::getContent() as $row)
                            <div>
                                {!! $row->name . '<br>RM' .RM($row->price) .' x ' . $row->quantity . ': RM' . RM($row->getPriceSum()) .'<hr>' !!}
                            </div>
                        @endforeach
                    </div>
                     <div class="flex-w flex-t p-t-27">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Jumlah:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                RM{{ RM(Cart::getSubTotal()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function onSubmit(token) {
            document.getElementById("checkout").submit();
        }
    </script>

</x-layout>
