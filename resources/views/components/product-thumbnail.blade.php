@props(['product', 'slug'])
<a href="/product/{{ $product->slug }}">
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $slug }}">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="{{ asset('storage/products/'.$product->picture) }}" alt="Image {{ $product->name }}">
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="product/{{ $product->slug }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        {{ $product->name }}
                    </a>

                    <span class="stext-105 cl3">
                        RM{{ RM($product->price) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</a>
