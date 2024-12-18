@extends('layouts.app')
@section('content')
<section class="main mt-5 position-relative ">
    <div class="container">
      <div class="row">
        <div class=" col-lg-4">
          <aside id="aside">
            <div class="aside-header d-flex d-lg-none justify-content-between align-items-center pt-3">
              <h3 class="text-uppercase fs-6">Filter By</h3>
              <i class="fa-solid fa-xmark" id="filterClose"></i>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button filter-title" type="button" data-bs-toggle="collapse"
                    data-bs-target="#product-filter" aria-expanded="true" aria-controls="product-filter">
                    Product Categories
                  </button>
                </h2>
                <div id="product-filter" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <ul class="filter-product-list p-0">
                      @foreach ($categories as $category )
                      <li class="product-list">
                        <span class="menu-link py-1">
                          <input type="checkbox" name="categories" value="{{ $category->id }}"
                          @if (in_array($category->id,explode(',',$f_categories))) checked ="checked"
                          @endif/>
                          {{ $category->name }}
                        </span>
                        <span class="text-right float-end">{{ $category->products->count() }}</span>
                      </li>
                      @endforeach
                     
                    </ul>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button filter-title" type="button" data-bs-toggle="collapse"
                    data-bs-target="#color-filter" aria-expanded="true" aria-controls="color-filter">
                    Color
                  </button>
                </h2>
                <div id="color-filter" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <div class="color-filter my-3 d-flex gap-3 flex-wrap">
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                      <a href="#" class="product-color" style="background-color: #000;"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button filter-title" type="button" data-bs-toggle="collapse"
                    data-bs-target="#size-filter" aria-expanded="false" aria-controls="size-filter">
                    Sizes
                  </button>
                </h2>
                <div id="size-filter" class="accordion-collapse collapse show">
                  <div class="accordion-body">

                    <div class="size-filter my-3 d-flex gap-3 flex-wrap">
                      <a href="#" class="size-box btn">XS</a>
                      <a href="#" class="size-box btn">S</a>
                      <a href="#" class="size-box btn">M</a>
                      <a href="#" class="size-box btn">L</a>
                      <a href="#" class="size-box btn">XL</a>
                      <a href="#" class="size-box btn">XXL</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button filter-title" type="button" data-bs-toggle="collapse"
                    data-bs-target="#band-filter" aria-expanded="false" aria-controls="band-filter">
                    Bands
                  </button>
                </h2>
                <div id="band-filter" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <div class="brand-filter">
                      <div class="position-relative my-1">
                        <input type="text" name="search" placeholder="Search Products" class="search-brand p-2 w-100">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <ul class="filter-product-list p-0 mt-3">
                          @foreach ($brands as $brand )
                          <li class="product-list d-flex justify-content-between align-items-center">
                            <label class="checkbox">
                              {{ $brand->name }} 
                              <input type="checkbox" value="{{ $brand->id }}" name="brands" @if (in_array($brand->id,explode(',',$f_brands))) checked="checked"
                              @endif/>
                              <span class="checkmark"></span>
                            </label>
                            <span class="text-secondary">{{ $brand->products->count() }}</span>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button filter-title" type="button" data-bs-toggle="collapse"
                    data-bs-target="#price-filters" aria-expanded="false" aria-controls="price-filters">
                    Price
                  </button>
                </h2>
                <div id="price-filters" class="accordion-collapse collapse show">
                  <div class="accordion-body">
                    <div class="size-filter my-3 d-flex gap-3">
                      <div class="price-range">
                        <input type="number" class="price-input" name="price_min" value = {{ $min_price }}>
                        <h6 class="price-range-title">Min Price: $1</h6>
                      </div>
                      <div class="price-range">
                        <input type="number" class="price-input" name="price_max" value = {{ $max_price }}>
                        <h6 class="price-range-title">Min Price: $500</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
        <div class="col-lg-8 col-12">
          <div class="shop-slide">
            <div class="row">
              <div class="col-12 col-md-6 p-0">
                <div class="bg-pink slide-text d-flex align-content-center flex-wrap">
                  <div class="p-4">
                    <h2>Women's </h2>
                    <h2 class="fw-bold">ACCESSORIES</h2>
                    <p class="mt-3">Accessories are the best way to
                      update your look. Add a title edge with new styles and new colors, or go for timeless pieces.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 p-0">
                <div class="shop-slide-image">
                  <img
                    src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/shop/shop_banner3.jpg"
                    alt="">
                </div>

              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center my-5">
            <div class="breadcrumb mb-0">
              <a href="{{ route('home.index') }}" class="nav-link text-uppercase bar-before">Home</a> <span class="px-2">/</span>
              <a href="#" class="nav-link text-uppercase bar-before">Shop</a>
            </div>
            <div class="shop-acs d-flex justify-content-center-align-items-center ">
              <select name="pagesize" id="page-size" class="shop-acs-select  text-uppercase" style="margin-right: 20px">
                <option value="12"{{ $size==12 ? 'selected' : '' }}>Show</option>
                <option value="24" {{ $size==24 ? 'selected' : '' }}>24</option>
                <option value="48" {{ $size==48 ? 'selected' : '' }}>48</option>
                <option value="102" {{ $size==102 ? 'selected' : '' }}>102</option>
              </select>

              <select name="orderby" id="orderby" class="shop-acs-select text-uppercase">
                <option value="-1" {{ $order ==-1 ? 'selected' : '' }}>Default</option>
                <option value="1" {{ $order ==1 ? 'selected' : '' }}>Date, New To Old</option>
                <option value="2" {{ $order ==2 ? 'selected' : '' }}>Date, Old To New</option>
                <option value="3" {{ $order ==3 ? 'selected' : '' }}>Price, Low To High</option>
                <option value="4" {{ $order ==4 ? 'selected' : '' }}>Price, High To Low</option>
              </select>

              <span class="px-2 text-black-50">|</span>
              <span class="nav-link text-uppercase d-lg-none" id="filterOpen">Filter</span>

            </div>

          </div>
          <div class="my-5">
            <div class="row">
                @foreach ($products as $product )
              <div class="col-6 col-lg-4">
                <div class="product-card">
                  <div class="position-relative product-img">
                      <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <a href="{{ route('shop.product.details',['product_slug'=>$product->slug]) }}">
                              <img
                              src="{{ asset('uploads/products') }}/{{ $product->image }}"
                              alt="{{ $product->name }}">
                            </a>
                          </div>
                          @foreach ( explode(",",$product->images) as $gimg )
                          <div class="swiper-slide">
                                <a href="{{ route('shop.product.details',['product_slug'=>$product->slug]) }}">
                                    <img
                                      src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                      alt="{{ $product->name }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                      </div>
                      @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                      <a href="{{ route('cart.index') }}" class="add-cart-div text-uppercase">Go to Cart</a>
                      @else
                      <form action="{{ route('cart.add')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}"/>
                        <input type="hidden" name="quantity" value="1"/>
                                <input type="hidden" name="name" value="{{ $product->name }}"/>
                                <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"/>
                    <button type="submit" class="add-cart-div text-uppercase">Add To Cart</button>
                      </form>
                    @endif
                  </div>
                  <div class="product-card-info">
                    <p class="product-subtitle f-14 text-black-50">{{ $product->category->name }}</p>
                    <h6 class="product-card-title my-3">
                      <a href="#">
                        {{ $product->name }}
                      </a>
                    </h6>
                    <p class="price">
                        @if ($product->sale_price)
                            <s>{{ $product->regular_price }}</s> ${{$product->sale_price }}
                        @else
                        ${{ $product->regular_price }}
                        @endif
                    </p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="divider"></div>
            <div class="d-flex align-items-center justify-content-center flex-wrap gap wpg-pagination">
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <form id="frmfilter" method="GET" action="{{ route('shop.index') }}">
    <input type="hidden" name="page" value="{{ $products->currentPage() }}">
    <input type="hidden" id="size" name="size" value="{{ $size}}">
    <input type="hidden" id="order" name="order" value="{{ $order}}">
    <input type="hidden" id="hdnbrands" name="brands">
    <input type="hidden" id="hdnCategories" name="categories">
    <input type="hidden" id="hdnMinPrice" name="min" value="{{ $min_price }}">
    <input type="hidden" id="hdnMaxPrice" name="max" value="{{ $max_price }}">
  </form>
@endsection
@push('script')
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
$(function(){
  $("#page-size").on("change",function(){
    $("#size").val($("#page-size option:selected").val());
    $("#frmfilter").submit();
  })
  $("#orderby").on("change", function(){
    $("#order").val($("#orderby option:selected").val());
    $("#frmfilter").submit();
  })
  $("input[name='brands']").on("change", function(){
    var brands ="";
    $("input[name='brands']:checked").each(function(){
      if(brands == ""){
        brands += $(this).val();
      }
      else{
        brands += "," + $(this).val();
      }
      console.log(brands);
    });
    $("#hdnbrands").val(brands);
    $("#frmfilter").submit();
  });
  $("input[name='categories']").on("change", function(){
    var categories ="";
    $("input[name='categories']:checked").each(function(){
      if(categories == ""){
        categories += $(this).val();
      }
      else{
        categories += "," + $(this).val();
      }
      console.log(categories);
    });
    $("#hdnCategories").val(categories);
    $("#frmfilter").submit();
  });
  $("input[name = 'price_min']").keyup(function(e){
    var min = $(this).val();
    $('#hdnMinPrice').val(min);
    if(e.key == "Enter"){
      $("#frmfilter").submit();
    }
  });
  $("input[name = 'price_max']").keyup(function(e){
    var max = $(this).val();
  $('#hdnMaxPrice').val(max);
    if(e.key == "Enter"){
    $("#frmfilter").submit();    }
  });
});
</script>
@endpush