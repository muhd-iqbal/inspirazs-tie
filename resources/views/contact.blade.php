<x-layout header="header-v4" title="Hubungi Kami"
    keywords="Hubungi Inspirazs, online, pesanan, tie murah, tie kedah, tali leher kedah, tali leher malaysia"
    description="Hubungi Inspirazs Sdn Bhd, pemilik Tali Leher Inspirazs, dilokasi Gurun atau Guar, Kedah. Pesanan Atas Talian. Penghantaran Seluruh Malaysia." >

<!-- Title page -->
<x-title-page title="Hubungi Kami" />

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-fullmd">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Alamat
                        </span>

                        <p class="h6 stext-115 cl6 size-213 p-t-18">
                            {{ $web_var['company_name'] }}
                        </p>
                        <p class="stext-115 cl6 size-213">
                            {{ $web_var['company_address'] }},
                            {{ $web_var['company_address_2'] }},
                            {{ $web_var['company_postcode'] . ' ' . $web_var['company_city'] }},
                            {{ $web_var['company_state'] }}
                        </p>
                        <a href="https://goo.gl/maps/vSZQXpmbTsw8LUJi8">Klik Untuk Dapatkan Lokasi</a>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Telefon / WhatsApp
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            {{ phone_format($web_var['company_phone']) }}
                            <a href="https://wa.me/6{{$web_var['company_phone']}}" class="btn btn-success"><i class="fa fa-whatsapp"></i> WhatsApp</a>
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Alamat Emel
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            <a href="mailto:{{ $web_var['company_email'] }}">{{ $web_var['company_email'] }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15877.936115901242!2d100.4830072!3d5.7870897!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b1c1cdb322fca46!2sInspirazs%20Sdn.%20Bhd.!5e0!3m2!1sen!2smy!4v1656494467183!5m2!1sen!2smy" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>


<!-- Map -->
<div class="map">
    <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png"
        data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
</div>

</x-layout>
