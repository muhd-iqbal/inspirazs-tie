@props(['title', 'categories', 'products'])
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                {{ $title }}
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    Semua
                </button>
                @foreach ($categories as $category)
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                        data-filter=".{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="row isotope-grid">

            @foreach ($products as $product)
                <x-product-thumbnail :product="$product" slug="{{ $product->category->slug }}" />
            @endforeach

        </div>
        <span class="small mark"><span class="mr-2">*</span>Harga untuk bayaran tunai bersama pesanan
            minimum.</span>
    </div>
</section>
