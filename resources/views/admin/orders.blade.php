@extends('layouts.admin')

@section('content')
    <div class="p-4 bg-white">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <td>Pelanggan</td>
                    <th>Total RM</th>
                    <th>Paid RM</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($orders as $order)
                    <tr valign="middle" onclick="location.href='{{ config('tie.admin_prefix') }}/order/{{ $order->id }}'"
                        role="button">
                        <th>{{ $order->id }}</th>
                        <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                        <td>{{ $order->customer_organisation }}<br><small>{{ $order->customer_name }}</small></td>
                        <td>{{ RM($order->grand_total) }}</td>
                        <td>{{ RM($order->paid) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
