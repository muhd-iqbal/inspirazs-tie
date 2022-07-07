<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="noindex,nofollow">
    <title>Admin ~ {{ config('app.name') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ config('tie.admin_prefix') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ request()->path() == 'admin' ? 'active' : '' }}"
                        aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ config('tie.admin_prefix') }}/categories"
                        class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->path(), 'categories') ? 'active' : '' }}"><i
                            class="fas fa-list fa-fw me-3"></i><span>Category</span></a>
                    <a href="{{ config('tie.admin_prefix') }}/products"
                        class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->path(), 'product') ? 'active' : '' }}"><i
                            class="fas fa-tshirt fa-fw me-3"></i><span>Product</span></a>
                    <a href="{{ config('tie.admin_prefix') }}/orders"
                        class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->path(), 'order') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>Orders</span>
                    </a>
                    <a href="{{ config('tie.admin_prefix') }}/sliders"
                        class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->path(), 'slider') ? 'active' : '' }}">
                        <i class="fab fa-slideshare fa-fw me-3"></i><span>Sliders</span>
                    </a>
                    <a href="{{ config('tie.admin_prefix') }}/variables"
                        class="list-group-item list-group-item-action py-2 ripple {{ str_contains(request()->path(), 'var') ? 'active' : '' }}"><i
                            class="fas fa-pen-fancy fa-fw me-3"></i><span>Web Variables</span></a>
                    <a href="/" target="_blank" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-eye fa-fw me-3"></i><span>View Website</span></a>
                    <form action="/logout" method="post" class="mt-5 list-group-item py-2">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i
                                class="fas fa-sign-out-alt fa-fw me-3"></i><span>Logout</span></button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="{{ config('tie.admin_prefix') }}">
                    <img src="{{ asset('images/logo-2.png') }}" height="25" alt="" loading="lazy" />
                </a>

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->
    <!--Main layout-->
    <main style="margin-top: 58px">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @yield('content')

    </main>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    {{-- <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script> --}}

</body>

</html>
