@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="shop-checkout container">
        <h2 class="page-title text-uppercase fw-bold fs-1">Shipping andCheckout</h2>
       
        <div class="checkout_steps d-flex">
          <a href="{{ route('cart.index') }}" class="checkout_steps_item checkout-boder d-flex gap-2">
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
          <a class="checkout_steps_item d-flex gap-2">
            <h2 class="checkout_num f-18">03</h2> 
            <div class="check-out-title">
              <h2 class="check-title text-uppercase f-18">Confirmation</h2>
              <p class="f-14 text-black-50">Review And Submit Your Order</p>
            </div>
          </a>
        </div>
        <form action="{{ route('cart.place.an.order') }}" method="POST">
          @csrf
        <div class="row justify-content-between">
          <div class="col-12 col-lg-7 chekout-proceed-container">
            <h2 class="text-uppercase f-16 fw-medium fs-5 my-5">Shipping details</h2>
             
            @if($address)
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-account_address_list_item">
                            <div class="my_account-address_item_details">
                                <p>{{ $address->name }}</p>
                                <p>{{ $address->address }}</p>
                                <p>{{ $address->landmark }}</p>
                                <p>{{ $address->city }}, {{ $address->state }}, {{ $address->country }}</p>
                                <p>{{ $address->zip }}</p>
                                <br/>
                                <p>{{ $address->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-div my-4 py-1 position-relative">
                        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}">
                        <label for="name" class="label">Full Name *</label>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="number" id="phone" name="phone" class="form-input"  value="{{ old('phone') }}">
                            <label for="phone" class="label">Phone Number *</label>
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="number" id="zip" name="zip" class="form-input"  value="{{ old('zip') }}">
                            <label for="zip" class="label">Pincode *</label>
                            @error('zip') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="text" id="state" name="state" class="form-input"  value="{{ old('state') }}">
                            <label for="state" class="label">State *</label>
                            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="text" id="city" name="city" class="form-input" value="{{ old('city') }}">
                            <label for="city" class="label">Town / City *</label>
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="text" id="address" name="address" class="form-input" value="{{ old('address') }}">
                            <label for="address" class="label">House no, Building Name *</label>
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="text" id="locality" name="locality" class="form-input" value="{{ old('name') }}">
                            <label for="locality" class="label">Road Name, Area, Colony *</label>
                            @error('locality') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-div my-4 py-1 position-relative">
                            <input type="text" id="landmark" name="landmark" class="form-input"  value="{{ old('landmark') }}">
                            <label for="landmark" class="label">Landmark *</label>
                            @error('landmark') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            
          </div>
          @endif
          
          <div class="col-12 col-lg-4">
            <div class="cart-total p-4 mt-5">
                <h2 class="text-uppercase f-16 fw-normal">Your Oder</h2>
                @if(Session::has('discounts'))
                <table class="cart-total-table mt-3 order-table">
                    <tr>
                        <td class="text-uppercase">Subtotal</td>
                        <td>${{ Cart::instance('cart')->subtotal() }}</td>
                      </tr>
                    <tr>
                        <td class="text-uppercase">Discount{{ Session::get('coupon')['code'] }}</td>
                        <td>${{ Session::get('discounts')['discount'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-uppercase">Subtotal After Discount</td>
                        <td>${{ Session::get('discounts')['subtotal'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-uppercase">Vat After Discount</td>
                        <td>${{ Session::get('discounts')['tax'] }}</td>
                    </tr>
                    <tr>
                        <td class="text-uppercase">Total After Discount</td>
                        <td>${{ Session::get('discounts')['total'] }}</td>
                    </tr>
                  </table>
                @else
              <table class="cart-total-table mt-3 order-table">
                <tr>
                    <td class="text-uppercase">Products</td>
                    <td class="text-uppercase">Subtotal</td>
                </tr>
                @foreach (Cart::instance('cart') as $item )
                <tr>
                  <td>
                      {{ $item->name }} x {{ $item->qty }}
                  </td>
                  <td>
                      ${{ $item->subtotal }}
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td class="text-uppercase">Subtotal</td>
                  <td>${{ Cart::instance('cart')->subtotal() }}</td>
                </tr>
                <tr>
                  <td class="text-uppercase">Shipping</td>
                  <td>Free Shipping</td>
                </tr>
                <tr>
                  <td class="text-uppercase">Vat</td>
                  <td>${{ Cart::instance('cart')->tax() }}</td>
                </tr>
                <tr>
                  <td class="text-uppercase">Total</td>
                  <td>${{ Cart::instance('cart')->total() }}</td>
                </tr>
              </table>
              @endif
            </div>
            <div class="checkout-payment-method border mt-5 p-4">
              <ul class="cart-total-table payment-opt">
               
                 <input type="radio" name="mode" id="mode1" value="card"> 
                 <label for="mode">Debit or Credit card</label>
                </li>
                <li>
                 <input type="radio" name="mode" id="mode2" value="cod"> 
                 <label for="mode">Cash on delivery</label>
                </li>
                 <input type="radio" name="mode" id="mode3" value="paypal"> 
                 <label for="mode">Paypal</label>
                </li>
              </ul>
                <p class="policy-text">
                  Your personal data will be used to process your order, support your experience throughout this
                  website, and for other purposes described in our <a href="#">privacy policy.</a></p>
            </div>
            <input type="submit" class="f-14 update-btn bg-dark text-white py-3 my-3" value="PLACE ORDER">

          </div>
        </div>
      </form>
    </div>
  </main>
@endsection