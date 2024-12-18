@extends('layouts.admin')
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="fs-4 fw-bolder text-black">Order Details</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active text-black-50" aria-current="page">Order Item</li>
            </ol>
        </nav>
    </div>

    <div class="wg-box">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <h4>Order Details</h4>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary w-100 py-2">Back</a>
            </div>
        </div>
        <div class="table-responsive">
            @if (Session::has('status'))
            <p class="alert alert-success">{{ Session::get('status')}}</p>
            
        @endif

            <table class="table table-striped table-bordered details-table">
                <tr>
                    <th>Order No</th>
                    <td>{{ $order->id }}</td>
                    <th>Mobile</th>
                    <td>{{ $order->phone }}</td>
                    <th>Zip Code</th>
                    <td>{{ $order->zip }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->created_at }}</td>
                    <th>Deliverd Date</th>
                    <td>{{ $order->delivered_date }}</td>
                    <th>Cancle Date</th>
                    <td>{{ $order->cancled_date }}</td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td colspan="5" class=" text-start">
                        @if ($order->status == 'delivered')
                            <span class="badge bg-success">Delivered</span>
                        @elseif($order->status == 'canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @else
                            <span class="badge bg-success">Ordered</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="wg-box mt-5">
        <div class=" row  justify-content-between align-items-content mb-3">
            <div class="col-5">
                <h4>Order Items</h4>
            </div>

        </div>
        <div class="wg-table">
            <div class="table-responsive">
                <table class="table table-striped table-bordered details-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Options</th>
                            <th>Return Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($orderItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex gap-2">
                                        <img src="{{ asset('uploads/products/thumbnails') }}/{{ $item->product->image }}"
                                            alt="{{ $item->product->name }}" class="table-image" />

                                        <div class="product-name text-black f-14">
                                            <a
                                                href="{{ route('shop.product.details', ['product_slug' => $item->product->name]) }}"></a>{{ $item->product->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>${{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->product->SKU }}</td>
                                <td>{{ $item->product->category->name }}</td>
                                <td>{{ $item->product->brand->name }}</td>
                                <td>{{ $item->option }}</td>
                                <td>{{ $item->rstatus == 0 ? 'NO' : 'Yes' }}</td>
                                <td><i class="fa-regular fa-eye text-black"></i></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap3 wgp-pagnation">
                {{ $orderItems->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Shipping Address</h5>
        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail mt-4">
                <p>{{ $order->name }}</p>
                <p>F{{ $order->address }}</p>
                <p>{{ $order->locality }}</p>
                <p>{{ $order->city }},{{ $order->country }}</p>
                <p>{{ $order->landmark }}</p>
                <p>{{ $order->zip }}</p>
                <br>
                <p>Mobile : {{ $order->phone }}</p>
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <table class="table table-striped table-bordered table-transaction">
            <tbody>
                <tr>
                    <th>Subtotal</th>
                    <td>${{ $order->subtotal }}</td>
                    <th>Tax</th>
                    <td>${{ $order->tax }}</td>
                    <th>Discount</th>
                    <td>${{ $order->discount }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>${{ $order->total }}</td>
                    <th>Payment Mode</th>
                    <td>{{ $transaction->mode }}</td>
                    <th>Status</th>
                    <td>
                        @if ($transaction->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif ($transaction->status == 'declined')
                            <span class="badge bg-danger">Declined</span>
                        @elseif ($transaction->status == 'refunded')
                            <span class="badge bg-secondary">Refunded</span>
                        @else
                            <span class="badge bg-danger">Pending</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="wg-box mt-5">
        <h5>update Status</h5>
        <form action="{{ route('admin.order.status.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <select name="order_status" id="order_status" class="w-100 py-2 ">
                        <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : '' }}>Ordered</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="submit" class="btn btn-outline-primary w-100 py-2 ">Update Status</button>
                </div>
            </div>
        </form>
    </div>

    </div>
    </div>
@endsection
