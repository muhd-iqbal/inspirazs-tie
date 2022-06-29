<script>
    function changePayment() {
        document.getElementById("change-payment").submit();
    }
</script>


<!-- Modal -->
<div class="modal fade" id="changePayMethodModal" tabindex="-1" role="dialog"
    aria-labelledby="changePayMethodModalTitle" aria-hidden="true" style="z-index: 1111">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tukar Kaedah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/ch-method" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input m-l-0" type="checkbox" name="check-change-payment"
                            id="checkChangePayment" required>
                        <label class="form-check-label" for="checkChangePayment">
                            Sahkan penukaran, item di dalam troli akan terpadam, anda harus memasukkan semula.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">
                        @if (session('loan'))
                            Tukar Ke Pembayaran Tunai
                        @else
                            Tukar Ke Pinjaman (LO)
                        @endif
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Header desktop -->
<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
            Penghantaran percuma untuk pesanan melebihi {{ $web_var['free_shipping'] }} unit*
            </div>

            <div class="right-top-bar flex-w h-full">
                <a href="/how-to-order" class="flex-c-m trans-04 p-lr-25">
                    Cara Pesanan
                </a>

               <!-- Button trigger modal -->
                <a href="#" class="flex-c-m trans-04 p-lr-25" data-toggle="modal" data-target="#changePayMethodModal">
                    {{ session('loan') ? 'Pinjaman (LO)' : 'Tunai' }}
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    MYR
                </a>
            </div>
        </div>
    </div>

    <div class="wrap-menu-desktop">
        <nav class="limiter-menu-desktop container">

            <!-- Logo desktop -->
            <a href="/" class="logo">
                <img src="{{ asset('images/logo-2.png') }}" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li class="{{ Request::path() == '/' ? 'active-menu':''}}">
                        <a href="/">Utama</a>
                    </li>

                    <li class="label1 {{ Request::path() == 'products' ? 'active-menu':''}}" data-label1="hot">
                        <a href="/products">Produk</a>
                    </li>

                    <li class="{{ Request::path() == 'shopping-cart' ? 'active-menu':''}}">
                        <a href="/shopping-cart">Troli</a>
                    </li>

                    <li class="{{ Request::path() == 'about' ? 'active-menu':''}}">
                        <a href="/about">Kenali</a>
                    </li>

                    <li class="{{ Request::path() == 'contact' ? 'active-menu':''}}">
                        <a href="/contact">Hubungi</a>
                    </li>
                </ul>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m">
                <div class="icon-header-item cl2 hov-cl1 trans-04 m-l-22 m-r-11 p-2 bor2 icon-header-noti js-show-cart bg-white"
                    data-notify="{{ Cart::getContent()->count() }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Header Mobile -->
<div class="wrap-header-mobile">
    <!-- Logo moblie -->
    <div class="logo-mobile">
        <a href="/"><img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
    </div>

    <!-- Icon header -->
    <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
            data-notify="{{ Cart::getContent()->count() }}">
            <i class="zmdi zmdi-shopping-cart"></i>
        </div>
    </div>

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </div>
</div>


<!-- Menu Mobile -->
<div class="menu-mobile">
    <ul class="topbar-mobile">
        <li>
            <div class="left-top-bar">
                Penghantaran percuma untuk pesanan melebihi {{ $web_var['free_shipping'] }} unit*
            </div>
        </li>

        <li>
            <div class="right-top-bar flex-w h-full">
                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    Cara Pesanan
                </a>

                <a href="#" class="flex-c-m p-lr-10 trans-04" data-toggle="modal" data-target="#changePayMethodModal">
                    {{ session('loan') ? 'Pinjaman (LO)' : 'Tunai' }}
                </a>

                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    MYR
                </a>
            </div>
        </li>
    </ul>

    <ul class="main-menu-m">
        <li>
            <a href="/">Utama</a>
        </li>

        <li>
            <a href="/products">Produk</a>
        </li>

        <li>
            <a href="/shopping-cart" class="label1 rs1" data-label1="hot">Troli</a>
        </li>

        <li>
            <a href="/about">Kenali</a>
        </li>

        <li>
            <a href="/contact">Hubungi</a>
        </li>
    </ul>
</div>
