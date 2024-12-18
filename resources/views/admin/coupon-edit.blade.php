@extends('layouts.admin')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="fs-4 fw-bolder text-black">Brand Information</h5>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.coupons') }}">Coupons</a></li>
            <li class="breadcrumb-item active text-black-50" aria-current="page">Edit Coupon</li>
        </ol>
    </nav>
</div>

<form action="{{ route('admin.coupon.update') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $coupon->id }}"/>
    <div class="wg-box">
        <div class="row">
            <div class="col-md-3  mt-3">
                <label for="couponsCode" class="form-label fw-bolder">Coupons Code <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <input type="text" class="input-field w-100" placeholder="Coupons Code"
                    name="code" id="couponsCode" value="{{ $coupon->code }}">
                </div>
                @error('code')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror

            <div class="col-md-3 mt-3">
                <label for="couponsType" class="form-label fw-bolder"> Coupons Types <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <select id="couponsType" class="input-field w-100" name="type">
                    <option value="">Select</option>
                    <option value="fixed"{{ $coupon->type == "fixed" ? "selected":"" }}>Fixed</option>
                    <option value="percent" {{ $coupon->type == "percent" ? "selected":"" }}>Percent</option>
                </select>
            </div>
            @error('type')<span class="alert alert-danger text-center">{{ $message }}</span>  
            @enderror

            <div class="col-md-3  mt-3">
                <label for="Value" class="form-label fw-bolder">Value <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <input type="text" class="input-field w-100" placeholder="Coupons value"
                    name="value" id="Value" value="{{ $coupon->value }}">
                </div>
                @error('value')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
            <div class="col-md-3  mt-3">
                <label for="cartValue" class="form-label fw-bolder">Cart Value <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <input type="text" class="input-field w-100" placeholder="Cart value"
                    name="cart_value" id="cartValue" value="{{ $coupon->cart_value }}">
                </div>
                @error('cart_value')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror
            <div class="col-md-3  mt-3">
                <label for="expiryDate" class="form-label fw-bolder">Expiry Date <span
                        class="text-danger">*</span></label>
            </div>
            <div class="col-md-9 mt-3">
                <input type="date" class="input-field w-100" placeholder="Expiry Date"
                    name="expiry_date" id="expiryDate" value="{{ $coupon->expiry_date }}">
                </div>
                @error('expiry_date')<span class="alert alert-danger text-center">{{ $message }}</span>  
                @enderror


            <div class="col-md-3 mt-3">
                <div></div>
            </div>
            <div class="col-md-9 mt-3">
                <input class="btn btn-primary f-14 fw-bolder px-5" type="submit" value="Update">
            </div>
        </div>
    </div>
</form>

    
@endsection