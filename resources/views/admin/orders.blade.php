@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Brands</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Brands</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <div class="position-relative search-bar d-none d-lg-block">
                    <input type="text" name="search" id="search" placeholder="Search Here...">
                    <i class="fa-solid fa-search"></i>
                </div>
            </div>
            <div class="col-2">
                <a href="" class="btn btn-outline-primary w-100 py-2">+ Add new</a>
            </div>
        </div>
        <div class="wg-table">
            <div class="table-responsive">
                <table class="table table-striped table-bordered details-table">
                    <thead>
                        <tr>
                            <th class="text-start">OrderNo</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Subtotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th>Delivered On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>${{ $order->subtotal }}</td>
                                <td>${{ $order->tax }}</td>
                                <td>${{ $order->total }}</td>
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
                                <td>
                                    <a href="{{ route('admin.order.details', ['id' => $order->id]) }}">
                                        <i class="fa-regular fa-eye text-black"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
