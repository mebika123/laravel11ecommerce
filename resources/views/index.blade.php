@extends('layouts.app')
@section('content')
    <section class="banner">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @foreach ($slides as $slide)
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="banner-content align-content-center position-relative">
                                <div class="text-section">
                                    <h6 class="banner-subtitle text-uppercase f-14 position-relative">{{ $slide->tagline }}
                                    </h6>
                                    <h1 class=" h1 banner-title fw-normal">{{ $slide->title }} <span
                                            class="d-block fw-bold">{{ $slide->subtitle }}</span></h1>
                                    <a href="{{ $slide->link }}" class="function-btn f-14 position-relative">Shop Now</a>
                                </div>
                                <div class="banner-img">
                                    <img class="position-absolute" src="{{ asset('uploads/slides') }}/{{ $slide->image }}"
                                        alt="" width="542" height="733">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="categories mt-5">
        <div class="container">
            <h4 class="section-title text-center fw-medium mb-4">You Might Like</h4>
            <div class="swiper mySwiperCatagories">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="slider-img text-center">
                                <img src="{{ asset('uploads/categories') }}/{{ $category->image }}" alt="">
                                <div class="slider-text">
                                    <a href="{{ route('shop.index', ['categories' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section class="deal-section mt-5">
        <div class="container">
            <h5 class="section-title text-center fw-medium mb-4">Hot Deals</h5>
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-4 col-xl-3 text-center sale-info">
                    <h2>Summer Sale</h2>
                    <h2 class="fw-bold mb-5">Up to 60% Off</h2>
                    <a href="{{ route('shop.index') }}" class="function-btn f-14 position-relative">VIEW ALL</a>
                </div>
                <div class="col-md-6 col-lg-8 col-xl-9 mt-3 mt-md-0">
                    <div class="swiper mySwiperCard">
                        <div class="swiper-wrapper">
                            @foreach ($sproducts as $sproduct)
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <a href="{{ route('shop.product.details', ['product_slug' => $sproduct->slug]) }}">
                                            <div class="position-relative product-img">
                                                <img src="{{ asset('uploads/products') }}/{{ $sproduct->image }}"
                                                    alt="{{ $sproduct->name }}" class="first-img">
                                                @foreach (explode(',', $sproduct->images) as $gimg)
                                                    <img src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                        alt="{{ $sproduct->name }}" class="second-img">
                                                @break
                                            @endforeach
                                        </div>
                                    </a>
                                    <div class="product-card-info position-relative">
                                        <h6 class="product-card-title my-3">
                                            <a
                                                href="{{ route('shop.product.details', ['product_slug' => $sproduct->slug]) }}">
                                                {{ $sproduct->name }}
                                            </a>
                                        </h6>
                                        <p class="price">
                                            @if ($sproduct->sale_price)
                                                <s>{{ $sproduct->regular_price }}</s> ${{ $sproduct->sale_price }}
                                            @else
                                                ${{ $sproduct->regular_price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="categories-banner mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <div class="category-banner-item position-relative">
                    <div class="category-banner-img">
                        <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/home/demo3/category_9.jpg"
                            alt="">
                    </div>
                    <div
                        class="category-banner-item-mark d-flex justify-content-center align-items-center fw-semibold text-center">
                        Starting at $19</div>
                    <div class="category-banner-item-content">
                        <h3 class="fw-medium">Blazers</h3>
                        <a href="#" class="function-btn f-14 position-relative text-uppercase">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5 mb-md-0">
                <div class="category-banner-item position-relative">
                    <div class="category-banner-img">
                        <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/home/demo3/category_10.jpg"
                            alt="">
                    </div>
                    <div
                        class="category-banner-item-mark d-flex justify-content-center align-items-center fw-semibold text-center">
                        Starting at $19</div>
                    <div class="category-banner-item-content">
                        <h3 class="fw-medium">Blazers</h3>
                        <a href="#" class="function-btn f-14 position-relative text-uppercase">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products-Section ">
    <div class="container">
        <h5 class="section-title text-center fw-medium mb-4">Features Products</h5>
        <div class="row">
            @foreach ($fproducts as $fproduct)
                <div class="col-6 col-lg-4 col-xl-3">
                    <div class="product-card">
                        <a href="{{ route('shop.product.details',['product_slug'=>$fproduct->slug]) }}">
                            <div class="position-relative product-img">
                                <img src="{{asset('uploads/products') }}/{{ $fproduct->image }}"
                                    class="second-img" alt="">
                            </div>
                        </a>
                        <div class="product-card-info position-relative">
                            <h6 class="product-card-title my-3">
                                <a href="{{ route('shop.product.details',['product_slug'=>$fproduct->slug]) }}">
                                    {{ $fproduct->name }}
                                </a>
                            </h6>
                            <p class="price">
                                @if ($fproduct->sale_price)
                                    <s>{{ $fproduct->regular_price }}</s> ${{ $fproduct->sale_price }}
                                @else
                                    ${{ $fproduct->regular_price }}
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center product-actions">
                              <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $fproduct->id }}" name="id">
                                <input type="hidden" value="1" name="quantity">
                                <input type="hidden" value="{{ $fproduct->name }}" name="name">
                                <input type="hidden" value="{{$fproduct->sale_price==''|| $fproduct->sale_price=='0' ? $fproduct->regular_price:$fproduct->sale_price }}" name="price">
                                <input type="submit" class="text-uppercase" value="add to cart">
                              </form>
                                {{-- <a href="#" class="text-uppercase">quick view</a>
                                <i class="fa-regular fa-heart"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    var swiperCatagories = new Swiper(".mySwiperCatagories", {
        slidesPerView: 2,
        spaceBetween: 20,
        breakpoints: {
            768: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 8,
                spaceBetween: 30,
            },
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    var swiperCard = new Swiper(".mySwiperCard", {
        slidesPerView: 2,
        spaceBetween: 20,
        breakpoints: {
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });
</script>
@endpush
