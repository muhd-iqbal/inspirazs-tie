<x-layout header="header-v4" title="{{ $product->name }}" :keywords="$product->keywords" :description="$product->desc_short">
    <style>
        th {
            text-align: center;
            border: 1px solid #e9ecef;
        }

        td {
            border: 1px solid #e9ecef;
        }

        .form-check-input {
            margin-left: 0;
        }
    </style>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Utama
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->category->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $product->name }}
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fa fa-shopping-cart" style="margin-right:10px; font-size:20px"></i>
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3"
                                    data-thumb="{{ asset('storage/products/' . $product->picture) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('storage/products/' . $product->picture) }}"
                                            alt="Image for {{ $product->name }}">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="{{ asset('storage/products/' . $product->picture) }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($product->images as $img)
                                    <div class="item-slick3"
                                        data-thumb="{{ asset('storage/products/' . $img->path) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/products/' . $img->path) }}"
                                                alt="Image {{ $loop->iteration }} for {{ $product->name }}">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('storage/products/' . $img->path) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg text-center">
                        <h3 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h3>

                        <div class="stext-102 cl3 p-t-23">
                            @if ($prices->count())
                                <table class="w-100 border border-collapsed">
                                    <tr class="bg-secondary text-light">
                                        <th>Kuantiti</th>
                                        <th>Harga Tunai (RM)</th>
                                        <th>Harga LO (RM)</th>
                                    </tr>
                                    @foreach ($prices as $price)
                                        <tr>
                                            <td>{{ "$price->min - $price->max" }}</td>
                                            <td>{{ RM($price->cash) }}</td>
                                            <td>{{ RM($price->loan) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <div class="text-danger mb-2">
                                    Pesanan tidak tersedia, sila hubungi kami melalui pautan dibawah.
                                </div>
                                <a href="/contact" class="btn btn-warning">Hubungi Kami</a>
                            @endif

                        </div>
                        <p class="stext-102 cl3 p-t-23">
                            {!! $product->desc_short !!}
                        </p>

                        <!--  -->
                        <div class="p-t-33">

                            <form action="/add-to-cart/{{ $product->id }}" method="POST">
                                @csrf
                                @if ($product->addon->count())
                                    <div class="text-left"><strong>Tambahan: </strong></div>
                                    @foreach ($product->addon as $addon)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                id="addon-{{ $addon->id }}" name="addon[{{ $addon->id }}]">
                                            <label class="form-check-label text-left"
                                                for="addon-{{ $addon->id }}">{{ $addon->name }}
                                                <small>(RM{{ RM($addon->price) }} seunit)</small></label>
                                        </div>
                                    @endforeach
                                @endif
                                <label for="quantity" class="text-left">Masukkan kuantiti</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="quantity" min="1" class="form-control"
                                        placeholder="Masukkan Kuantiti" aria-label="Masukkan Kuantiti"
                                        aria-describedby="basic-addon2"
                                        value="{{ Cart::get($product->id) ? Cart::get($product->id)->quantity : $prices->min('min') }}"
                                        required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="sumbit">Tambah ke
                                            Troli</button>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @unless($product->desc_long == null)
                            <li class="nav-item p-b-10">
                                <a class="nav-link active" data-toggle="tab" href="#description"
                                    role="tab">Description</a>
                            </li>
                        @endunless
                        <li class="nav-item p-b-10">
                            <a class="nav-link {{ $product->desc_long == null ? 'active' : '' }}" data-toggle="tab"
                                href="#information" role="tab">Additional
                                information</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        @unless($product->desc_long == null)
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="how-pos2 p-lr-15-md">
                                    <p class="stext-102 cl6">
                                        {!! $product->desc_long !!}
                                    </p>
                                </div>
                            </div>
                        @endunless

                        <!-- - -->
                        <div class="tab-pane fade {{ $product->desc_long == null ? 'show active' : '' }}"
                            id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Weight
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->weight }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Dimensions
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->dimensions }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Materials
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->materials }}
                                            </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Size
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ $product->size }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                Kategori: {{ $product->category->name }}
            </span>
        </div>
    </section>
</x-layout>
