@extends('layouts.admin')

@section('content')
    <div class="container pt-4">

        <!--Section: Sales Performance KPIs-->
        <section class="mb-4">
            <div class="card">
                <div class="card-header text-center py-3">
                    <h5 class="mb-0 text-center">
                        <strong>Latest Orders</strong>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">No Phone</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Bayaran</th>
                                    {{-- <th scope="col">Avg. Price</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr onclick="location.href='/admin/order/{{ $order->id }}'" role="button">
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ phone_format($order->customer_phone) }}</td>
                                        <td>RM{{ RM($order->grand_total) }}</td>
                                        <td>RM{{ RM($order->paid) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="float-end mt-2">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Sales Performance KPIs-->

        <!--Section: Minimal statistics cards-->
        <section>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-shopping-bag text-info fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $order_all->count('id') }}</h3>
                                    <p class="mb-0">Order Counts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill-wave text-warning fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>TBD</h3>
                                    <p class="mb-0">Order this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-filter text-success fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $category_all->count('id') }}</h3>
                                    <p class="mb-0">Categories</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fab fa-black-tie text-danger fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ $product_all->count('id') }}</h3>
                                    <p class="mb-0">Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Minimal statistics cards-->

        <!--Section: Statistics with subtitles-->
        <section>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Entire Productions</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">RM{{ RM($order_all->sum('total'))}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Sales This Month</h4>
                                        <p class="mb-0">Monthly sales</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">TBD</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4">$76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Sales Amount</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-heart text-danger fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4">$36,000.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Cost</h4>
                                        <p class="mb-0">Monthly Cost</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-wallet text-success fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Statistics with subtitles-->
    </div>
@endsection
