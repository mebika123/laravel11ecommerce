@extends('layouts.app')
@section('content')

<main class="pt-90">
    <div class="shop-checkout container">
        <h2 class="page-title text-uppercase fw-bold fs-1">Order Received</h2>
     
        <div class="checkout_steps d-flex">
          <a  class="checkout_steps_item checkout-boder d-flex gap-2">
            <h2 class="checkout_num f-18">01</h2> 
            <div class="check-out-title">
              <h2 class="check-title text-uppercase f-18">Shopping Bag</h2>
              <p class="f-14 text-black-50">Manage Your Items List</p>
            </div>
          </a>
          <a class="checkout_steps_item checkout-boder d-flex gap-2">
            <h2 class="checkout_num f-18">02</h2> 
            <div class="check-out-title">
              <h2 class="check-title text-uppercase f-18">Shipping and Checkout</h2>
              <p class="f-14 text-black-50">Checkout Your Items List</p>
            </div>
          </a>
          <a class="checkout_steps_item checkout-boder d-flex gap-2">
            <h2 class="checkout_num f-18">03</h2> 
            <div class="check-out-title">
              <h2 class="check-title text-uppercase f-18">Confirmation</h2>
              <p class="f-14 text-black-50">Review And Submit Your Order</p>
            </div>
          </a>
        </div>

        <div class="order-complete-msg mt-3">
          <div class="text-center">
              <div class="circle-section d-flex align-items-center justify-content-center my-3">
                  <i class="fa-solid fa-check fa-2xl text-white"></i>
                </div>
                <h3 class="main-msg">Your order is completed!</h3>
                <p class="sub-msg f-14 text-black-50">Thank you. Your order has been received.</p>
            </div>

            <div class="order-info p-5">
              <div class="row">
                <div class="col-12 col-md-3">
                  <div class="order-info-item mt-3">
                    <p class="f-14 text-black-50 mb-1">Order Number</p>
                    <span>{{ $order->id }}</span>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="order-info-item mt-3">
                    <p class="f-14 text-black-50 mb-1">Date</p>
                    <span>{{ $order->created_at }}</span>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="order-info-item mt-3">
                    <p class="f-14 text-black-50 mb-1">Total</p>
                    <span>${{ $order->total }}</span>
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <div class="order-info-item mt-3">
                    <p class="f-14 text-black-50 mb-1">Payment Method</p>
                    <span>{{ $order->transaction->mode }}</span>
                  </div>
                </div>

              </div>
            </div>

            <div class="cart-total p-4 mt-5">
              <h2 class="text-uppercase f-16 fw-normal">Order Details</h2>
            <table class="cart-total-table mt-3 order-tabl  e details-table">
              <tr>
                  <td class="text-uppercase">Products</td>
                  <td class="text-uppercase text-end">Subtotal</td>
              </tr>
              @foreach ($order->orderItems as $item )
                  
              <tr>
                <td class="text-black-50">
                    {{ $item->product->name }}
                </td>
                <td purchase-service>
                    {{ $item->price }}
                </td>
              </tr>
              @endforeach

              <tr>
                <td class="text-uppercase">Subtotal</td>
                <td>${{ $order->subtotal }}</td>
              </tr>
              <tr>
                <td class="text-uppercase">Shipping</td>
                <td>Free Shipping</td>
              </tr>
              <tr>
                <td class="text-uppercase">Vat</td>
                <td>${{ $order->tax }}</td>
              </tr>
              <tr>
                <td class="text-uppercase">Total</td>
                <td>${{ $order->total }}</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
  </main>

@endsection