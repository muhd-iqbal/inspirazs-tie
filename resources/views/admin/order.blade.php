@extends('layouts.admin')

@section('content')
    <style>
        .table tfoot th {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    </style>
    <div class="p-5 bg-white">

        <div class="d-flex justify-content-between">
            <h2>Order ID: {{ $order->id }} <a href="/admin/orders" class="btn btn-warning">Kembali</a></h2>
            <h3 class="text-uppercase border border-dark px-2">{{ $order->method }}</h3>
            <button class="btn btn-info" onclick="window.open('/o/{{ $order->hash }}/{{ $order->id }}')">Lihat
                Order</button>
        </div>
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="mb-5">

            <form class="" method="POST" action="/admin/order/{{ $order->id }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row my-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="name" class="form-control" value="{{ $order->customer_name }}"
                                disabled />
                            <label class="form-label" for="name">Customer name </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="orgs" class="form-control"
                                value="{{ $order->customer_organisation }}" disabled />
                            <label class="form-label" for="orgs">Customer Organisation</label>
                        </div>
                    </div>
                </div>

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <input type="text" id="address" class="form-control" value="{{ $order->customer_address }}"
                        disabled />
                    <label class="form-label" for="address">Address</label>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="postcode" class="form-control"
                                value="{{ $order->customer_postcode }}" disabled />
                            <label class="form-label" for="postcode">Postcode</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="city" class="form-control" value="{{ $order->customer_city }}"
                                disabled />
                            <label class="form-label" for="city">City</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="state" class="form-control"
                                value="{{ $order->customer_state }}" disabled />
                            <label class="form-label" for="state">State</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="email" class="form-control"
                                value="{{ $order->customer_email }}" disabled />
                            <label class="form-label" for="email">Email</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input type="text" id="phone" class="form-control"
                                value="{{ phone_format($order->customer_phone) }}" disabled />
                            <label class="form-label" for="phone">Phone</label>
                        </div>
                    </div>
                </div>
                <h4>Items</h4>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end"> Subtotal :</th>
                            <th class="text-end">{{ RM($order->total) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Shipping :</th>
                            <th class="text-end">{{ RM($order->shipping) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Grand Total :</th>
                            <th class="text-end">{{ RM($order->grand_total) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Paid :</th>
                            <th class="text-end">{{ RM($order->paid) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Balance :</th>
                            <th class="text-end">{{ RM($order->grand_total - $order->paid) }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($order->item as $item)
                            <tr>
                                <td>{{ $item->product }}</td>
                                <td class="text-end">{{ $item->quantity }}</td>
                                <td class="text-end">{{ RM($item->price) }}</td>
                                <td class="text-end">{{ RM($item->total) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </form>
        </div>
        @if ($order->grand_total - $order->paid > 0)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                Add Payment
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Bayaran</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/order/{{ $order->id }}/pay" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" id="amount" name="amount" class="form-control"
                                        value="{{ old('amount') ? old('amount') : number_format(($order->grand_total - $order->paid) / 100, 2, '.', '') }}"
                                        required />
                                    <label class="form-label" for="amount">Amount</label>
                                </div>
                                <div class="mb-4">
                                    <select class="form-select" name="method" aria-label="Payment Method Selection"
                                        required>
                                        <option selected disabled>Choose payment method...</option>
                                        <option value="cash">Cash</option>
                                        <option value="bank-transfer">Bank Transfer</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="reference" name="reference" class="form-control"
                                        value="{{ old('reference') }}" required />
                                    <label class="form-label" for="reference">Reference</label>
                                </div>
                                <div class="form-outline mb-2">
                                    <input type="datetime-local" id="time" name="time" class="form-control"
                                        value="{{ old('time') ? old('time') : date('Y-m-d') . 'T' . date('H:i') }}"
                                        required />
                                    <label class="form-label" for="time">Time</label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="attachment">Attachment</label>
                                    <input type="file" class="form-control" id="attachment" name="attachment"
                                        value="{{ old('attachment') }}" />
                                </div>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($order->payment->count())
            <div class="w-100 text-center mb-5">
                <div class="h5">List Payments</div>
                <div class="table-responsive">
                    <table class="w-100 border-collapse">
                        <thead class="border font-weight-bold">
                            <tr>
                                <th class="py-2 text-center">#</th>
                                <th>TIme</th>
                                <th>Reference</th>
                                <th>Method</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->payment as $pay)
                                <tr>
                                    <td class="text-center">{{ $pay->id }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($pay->time)) }}</td>
                                    <td>{{ $pay->reference }}</td>
                                    <td>{{ $pay->method }}</td>
                                    <td>RM{{ RM($pay->amount) }}</td>
                                    <td>
                                        @if ($pay->attachment)
                                            <a href="{{ asset('storage/payments/' . $pay->attachment) }}"
                                                target="_blank"><i class="fas fa-images"></i></a>
                                        @endif
                                    </td>
                                    <td align="right" class="p-0 m-0">
                                        <form action="/admin/order/{{ $order->id }}/{{ $pay->id }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn shadow-none" title="Padam bayaran"
                                                onclick="return confirm('Padam bayaran rujukan {{ $pay->reference }}?')">
                                                <i class="fas fa-trash" role="button"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif


    @endsection
