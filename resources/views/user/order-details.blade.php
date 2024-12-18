@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endpush
@section('content')
<section class="main mt-5">
    <div class="container">
        <h2>Order Details</h2>
        <div class="row align-item-center">
            <div class="col-lg-4">
                <div class="user-list-section my-5">
                    @include('user.usernav')
                </div>
            </div>
            <div class="col-lg-8">
                <div class="wg-box">
                    <div class=" row  justify-content-between align-items-content mb-3">
                        <div class="col-5">
                            <h4>Order Details</h4>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('user.orders') }}" class="btn btn-outline-primary w-100 py-2">Back</a>
                        </div>
                    </div>
                           <div class="table-responsive">
                            @if(Session::has('status'))
                                <p class="alert alert-success">{{ Session::get('status') }}</p>
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
                                    @foreach ($orderItems as $item )
                                    <tr>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <img src="{{ asset('uploads/products/thumbnails') }}/{{ $item->product->image }}" alt="{{ $item->product->name }}" class="table-image"/>
                                            
                                            <div class="product-name text-black f-14">
                                                <a href="{{ route('shop.product.details',['product_slug'=>$item->product->name]) }}"></a>{{ $item->product->name }}
                                            </div>
                                        </div>
                                        </td>
                                        <td>${{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->product->SKU }}</td>
                                        <td>{{ $item->product->category->name }}</td>
                                        <td>{{ $item->product->brand->name }}</td>
                                        <td>{{ $item->option }}</td>
                                        <td>{{ $item->rstatus == 0 ? "NO":"Yes" }}</td>
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
               @if ($order->status=='ordered')
               <div class="wg-box mt-5">
                <form action="{{ route('user.order.cancel') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <button type="button" class="btn btn-danger cancel-order">Cancled Order</button>
                </form>
            </div>  
               @endif
               
            </div>
        </div>
    </section>
    </div>
@endsection
@push('script')
<!-- Include SweetAlert v1 CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
    $(function(){
        $('.cancel-order').on('click',function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Are you sure?",
                text: "You want to delete this order",
                type: "warning",  // In SweetAlert v1, `type` works
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
            }, function(isConfirm){
                if (isConfirm) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush