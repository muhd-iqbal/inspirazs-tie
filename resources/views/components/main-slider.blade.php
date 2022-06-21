@props(['sliders', 'trans' => ['fadeInDown', 'fadeInUp', 'zoomIn', 'rollIn', 'lightSpeedIn', 'slideInUp', 'rotateInDownLeft', 'rotateInUpRight', 'rotateIn']])
<section class="section-slide mb-5">
    <div class="wrap-slick1">
        <div class="slick1">
            @foreach ($sliders as $slider)
                @if ($slider->active)
                    <div class="item-slick1"
                        style="background-image: url({{ asset('storage/sliders/' . $slider->image) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false"
                                    data-appear="{{ $trans[array_rand($trans)] }}" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        {{ $slider->subtitle }}
                                    </span>
                                </div>

                                <div class="layer-slick1 animated visible-false"
                                    data-appear="{{ $trans[array_rand($trans)] }}" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{ $slider->product->name }}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false"
                                    data-appear="{{ $trans[array_rand($trans)] }}" data-delay="1600">
                                    <a href="/product/{{ $slider->product->slug }}"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Tempah Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
