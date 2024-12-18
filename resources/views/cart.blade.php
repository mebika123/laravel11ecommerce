@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="shop-checkout container">
            <h2 class="page-title text-uppercase fw-bold fs-1">Cart</h2>
            <div class="checkout_steps d-flex">
                <a href="javascript.void(0)" class="checkout_steps_item checkout-boder d-flex gap-2">
                    <h2 class="checkout_num f-18">01</h2>
                    <div class="check-out-title">
                        <h2 class="check-title text-uppercase f-18">Shopping Bag</h2>
                        <p class="f-14 text-black-50">Manage Your Items List</p>
                    </div>
                </a>
                <a href="javascript.void(0)" class="checkout_steps_item d-flex gap-2">
                    <h2 class="checkout_num f-18">02</h2>
                    <div class="check-out-title">
                        <h2 class="check-title text-uppercase f-18">Shipping and Checkout</h2>
                        <p class="f-14 text-black-50">Checkout Your Items List</p>
                    </div>
                </a>
                <a href="javascript.void(0)" class="checkout_steps_item d-flex gap-2">
                    <h2 class="checkout_num f-18">03</h2>
                    <div class="check-out-title">
                        <h2 class="check-title text-uppercase f-18">Confirmation</h2>
                        <p class="f-14 text-black-50">Review And Submit Your Order</p>
                    </div>
                </a>
            </div>

            <div class="row justify-content-between">
                @if ($items->count() > 0)
                    <div class="col-12 col-lg-7 chekout-proceed-container">
                        <table class="cart-table mt-5">
                            <tr class="cart-head">
                                <th class="text-uppercase fw-medium pb-3 f-14">Products</th>
                                <th class="text-uppercase fw-medium pb-3 f-14">Price</th>
                                <th class="text-uppercase fw-medium pb-3 f-14">Quantity</th>
                                <th class="text-uppercase fw-medium pb-3 f-14">Subtotal</th>
                                <th class="pb-3"></th>
                            </tr>

                            @foreach ($items as $item)
                                <tr>
                                    <td class="table-data">
                                        <div class="table-info d-flex justify-content-between align-items-center">
                                            <img src="{{ asset('uploads/products/thumbnails') }}/{{ $item->model->image }}"
                                                alt=" {{ $item->name }}">
                                            <div class="cart-item-info">
                                                <h4 class="cart-item-title f-16">
                                                    {{ $item->name }}
                                                </h4>
                                                <ul class="cart-item-opt p-0 f-14 text-start text-black-50">
                                                    <li>Color: Yellow</li>
                                                    <li>Size: L</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-black">${{ $item->price }}</td>
                                    <td>
                                        <div
                                            class="quantity-control d-flex align-items-center justify-content-between w-100 py-3 px-2">
                                            <form method="POST"
                                                action="{{ route('cart.qty.decrease', ['rowId' => $item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="quantity-reduce">-</div>
                                            </form>
                                            <input type="number" value="{{ $item->qty }}"
                                                class="quantity-num text-center" name="quantity">
                                            <form method="POST"
                                                action="{{ route('cart.qty.increase', ['rowId' => $item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="quantity-increment">+</div>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-black">
                                        <div class="total-quantity-price">${{ $item->subTotal() }}</div>
                                    </td>
                                    <td class="text-black">
                                        <form action="{{ route('cart.item.remove', ['rowId' => $item->rowId]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="cancle-item"><i class="fa-solid fa-xmark"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        <div class="cart-table-footer mt-5 ">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-10  col-md-6">
                                    <form action="{{ Session::has('coupon') ? route('cart.coupon.remove') : route('cart.coupon.apply') }}" method="POST">
                                        @csrf
                                        @if (Session::has('coupon'))
                                        @method('DELETE')
                                        @endif
                                        <div class="apply-coupon position-relative mb-4">
                                            <input type="text" placeholder="Coupon code"
                                                class="coupon-code py-3 ps-2 f-14" name="coupon_code"
                                                value="@if (Session::has('coupon')) {{ Session::get('coupon')['code'] }} Applied! @endif">
                                            <button class="apply-btn text-uppercase py-2 f-14" type="submit">{{ Session::has('coupon') ? "Remove" : "Apply" }}
                                                Coupons</button>
                                        </div>
                                    </form>
                                </div>

                                <div class=" col-5 col-md-4 col-lg-5 mb-4">
                                    <form action="{{ route('cart.empty') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="update-btn p-3 ">CLEAR CART</button>
                                    </form>
                                </div>
                            </div>
                            <div>
                                @if (Session::has('success'))
                                    <p class="text-danger">{{ Session::get('success') }}</p>
                                @elseif(Session::has('error'))
                                    <p class="text-danger">{{ Session::get('error') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-total p-4 mt-5">
                            <h2 class="text-uppercase f-16 fw-normal">Carts Total</h2>
                            @if (Session::has('discounts'))
                                <table class="cart-total-table mt-3">
                                    <tr>
                                        <td></td>
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
                                <table class="cart-total-table mt-3">
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Subtotal</td>
                                        <td>{{ Cart::instance('cart')->subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">Shipping</td>
                                        <td>Free</td>
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
                        <a href="{{ route('cart.checkout') }}" class=" update-btn bg-dark text-white py-3 my-3 f-14" style="
                        display: inline-block;
                        text-align: center;
                    ">PROCEED TO
                            CHECKOUT</a>

                    </div>
                @else
                    <div class="col-md-12 text-center pt-5 bp-5">
                        <h3>No item found in your cart</h3>
                        <a href="{{ route('shop.index') }}" class="btn  btn-outline-primary">Shop Now</a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $(".quantity-increment").on("click", function() {
                $(this).closest('form').submit();
            })
            $(".quantity-reduce").on("click", function() {
                $(this).closest('form').submit();
            })
            $(".cancle-item").on("click", function() {
                $(this).closest('form').submit();
            })
        })
    </script>
@endpush
