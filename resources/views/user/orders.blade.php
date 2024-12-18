@extends('layouts.app')

@section('content')
    <section class="main mt-5">
        <div class="container">
            <h2>My Account</h2>
            <div class="row align-item-center">
                <div class="col-lg-4">
                    <div class="user-list-section my-5">
                        @include('user.usernav')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="page-text-content my-5">
                        <div class="table-responsive">
                            <table class=" table w-100 table-bordered">
                                <tr>
                                    <th class="text-center">Order No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">SubTotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Delivered On</th>
                                    <th class="text-center"></th>
                                </tr>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->name }}</td>
                                        <td class="text-center">{{ $order->phone }}</td>
                                        <td class="text-center">${{ $order->subtotal }}</td>
                                        <td class="text-center">${{ $order->tax }}</td>
                                        <td class="text-center">${{ $order->total }}</td>
                                        <td>
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="badge bg-danger">Canceled</span>
                                            @else
                                                <span class="badge bg-success">Ordered</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->orderItems->count() }}</td>
                                        <td>{{ $order->delivered_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.order.details', ['order_id' => $order->id]) }}">
                                                <i class="fa-regular fa-eye text-black"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
