<x-layout header="header-v4" title="Troli">
    <x-title-page title="Troli" />
    <!-- breadcrumb -->
    <div class="container mb-3">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Utama
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Troli
            </span>
        </div>
    </div>
    <!-- Shoping Cart -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="text-center">Produk</th>
                                <th class="text-center"></th>
                                <th class="text-center">Harga (RM)</th>
                                <th class="text-center">Kuantiti</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                            @if (Cart::getContent()->count() > 0)

                                @foreach (Cart::getContent() as $row)
                                    <tr class="">
                                        <td class="py-3 pl-1 d-flex align-items-center justify-content-between">
                                            <form action="/shopping-cart/{{ $row->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">X</button>
                                            </form>
                                            <a href="/product/{{ $row->model->slug }}">
                                                <div class="how-itemcart1">
                                                    <img src="{{ asset('storage/products/'.$row->model->picture) }}"
                                                        alt="{{ $row->model->name }}">
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="/product/{{ $row->model->slug }}">{{ $row->name }}</a>
                                        </td>
                                        <td class="text-center">{{ RM($row->price) }}</td>
                                        <td class="text-center">{{ $row->quantity }}</td>
                                        <td class="text-center">{{ RM($row->getPriceSum()) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-row">
                                    <td class="text-center p-5" colspan="5">
                                        <div>Tiada produk</div>
                                        <div class="">
                                            <a href="/products">Klik di sini</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    @if (Cart::getContent()->count() > 0)
                        <div class="mt-3">
                            <a href="/products" class="btn btn-warning">Klik sini untuk tambah produk.</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Jumlah
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subjumlah:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2 m-2">
                                RM{{ RM(Cart::getSubTotal()) }}
                            </span>
                        </div>
                    </div>

                    <div class="bor12 p-t-15 p-b-30">
                        <div>
                            Berat keseluruhan: {{ get_total_weight() / 1000 /* convert to kilogram*/ }} kg
                        </div>
                        <div class="text-danger small">
                            * Caj penghantaran akan dikira selepas pelanggan mengisi maklumat. Percuma untuk tempahan
                            melebihi {{ $web_var['free_shipping'] }} unit.
                        </div>
                        {{-- <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Penghantaran:
                                </span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                <div class="flex-w">
                                    <input type="radio" class="" name="shipping_type" id="postage">
                                    <label for="postage" class="p-l-10">GDEX</label>
                                </div>
                                <div class="flex-w">
                                    <input type="radio" name="shipping_type" id="self-pickup">
                                    <label for="self-pickup" class="p-l-10">Self Pickup</label>
                                </div>
                                </p>

                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Masukkan Poskod
                                    </span>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                                            placeholder="Poskod">
                                    </div>

                                    <div class="flex-w">
                                        <div
                                            class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                            Kemaskini
                                        </div>
                                    </div>

                                </div>
                            </div> --}}
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Jumlah:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                {{ RM(Cart::getTotal()) }}
                            </span>
                        </div>
                    </div>

                    <button onclick="location.href='/checkout'"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Sahkan Tempahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
