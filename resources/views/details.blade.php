@extends('layouts.app')
@section('content')
    <main class="pt-90 container">
        <section class="product-single-main">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12 col-lg-9 order-lg-1">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper productDetailSwiper2 mb-2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="detail-img">
                                            <img src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                                alt="{{ $product->name }}" />
                                        </div>
                                    </div>
                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide">
                                            <div class="detail-img">
                                                <img src="{{ asset('uploads/products') }}/{{ $gimg }}" />
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 ">
                            <div thumbsSlider="" class="swiper productDetailSwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="detail-thumb-img">
                                            <img src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}" />
                                        </div>
                                    </div>
                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide">
                                            <div class="detail-thumb-img">
                                                <img src="{{ asset('uploads/products/thumbnails') }}/{{ $gimg }}" />
                                            </div>
                                        </div>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="breadcrumb mt-4 mt-lg-0">
                        <a href="{{ route('home.index') }}" class="nav-link text-uppercase bar-before f-14">Home</a> <span
                            class="px-2">/</span>
                        <a href="#" class="nav-link text-uppercase bar-before f-14">Shop</a>
                    </div>
                    <section class="mt-4">
                        <h1 class="section-title">{{ $product->name }}</h1>
                        <div class="ratting-reviews">
                            <div class="d-flex align-items-center">
                                <div class="star-group d-flex align-items-center me-3">
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                </div>
                                <span>8K+ reviews</span>
                            </div>
                        </div>
                        <p class="fw-medium f-22">
                            @if ($product->sale_price)
                                <s>{{ $product->regular_price }}</s> ${{ $product->sale_price }}
                            @else
                                ${{ $product->regular_price }}
                            @endif
                        </p>
                        <p class="f-14 my-5">
                            {{ $product->short_description }}
                        </p>

                        @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                        <a href="{{ route('cart.index') }}" class="btn btn-warning mb-3">Go to Cart</a>
                        @else
                        <form action="{{ route('cart.add')}}" method="post">
                            @csrf
                        <div class="row align-items-center justify-content-between">
                            <div class="col-4">
                                <div
                                    class="quantity-control d-flex align-items-center justify-content-between w-100 py-3 px-2">
                                    <div class="quantity-reduce">-</div>
                                    <input type="number" value="1" class="quantity-num text-center" name="quantity">
                                    <div class="quantity-increment">+</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="id" value="{{ $product->id }}"/>
                                <input type="hidden" name="name" value="{{ $product->name }}"/>
                                <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}"/>
                                <button type="submit" class=" update-btn bg-dark text-white py-3 my-3 f-14">ADD TO
                                    CART</button>
                            </div>
                        </div>
                    </form>
                    @endif


                        <div class="item_add-to-list d-flex align-items-center gap-5 mb-4">
                            <a class="f-14 fw-medium add-list" href="#">
                                <i class="fa-regular fa-heart nav-icon"></i>
                                <span>Add to wish list</span>
                            </a>
                            <a href="#" class="f-14 fw-medium add-list"><i class="fa-solid fa-share"></i> VIEW ALL</a>
                        </div>

                        <ul class="p-0 mb-5">
                            <li class="mt-1">
                                <span>SKU: </span>{{ $product->SKU }}
                            </li>
                            <li class="mt-1">
                                <span>Categories: </span>{{ $product->category->name }}
                            </li>
                            <li class="mt-1">
                                <span>Tags: </span>NA
                            </li>
                        </ul>
                    </section>

                </div>
        </section>
        <section class="tabs-section text-center mt-5">
            <div class="d-flex justify-content-center align-items-center">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-uppercase tabs-under" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description-tab-pane" type="button" role="tab"
                            aria-controls="description-tab-pane" aria-selected="true">description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link  text-uppercase tabs-under" id="additional-info-tab" data-bs-toggle="tab"
                            data-bs-target="#additional-info-tab-pane" type="button" role="tab"
                            aria-controls="additional-info-tab-pane" aria-selected="false">Additional Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link  text-uppercase tabs-under" id="review-tab" data-bs-toggle="tab"
                            data-bs-target="#review-tab-pane" type="button" role="tab"
                            aria-controls="review-tab-pane" aria-selected="false">review</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active f-14" id="description-tab-pane" role="tabpanel"
                    aria-labelledby="description-tab" tabindex="0">
                    {{ $product->description }}
                </div>

                <div class="tab-pane fade" id="additional-info-tab-pane" role="tabpanel"
                    aria-labelledby="additional-info-tab" tabindex="0">
                    <table class="addition-info-table w-100 my-3">
                        <tr class="info-row">
                            <td class="info-data">Weight</td>
                            <td class="info-data">1.25</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-data">Dimension</td>
                            <td class="info-data">90 * 60 * 60 cm</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-data">Size</td>
                            <td class="info-data">XS, S, M, L, XL, XXl</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-data">Color</td>
                            <td class="info-data">Orange, Black, Green</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-data">Storage</td>
                            <td class="info-data">Relaxed fit shirt-style dress with a rugged</td>
                        </tr>
                    </table>
                </div>

                <div class="tab-pane fade p-4" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab"
                    tabindex="0">
                    <h2 class="fw-medium f-18 text-start mb-3">Reviews</h2>

                    <div class="border-bottom d-flex align-items-start gap-4 mt-3">
                        <div class="profile"></div>
                        <div class="review-section">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="profile-info text-start">
                                    <h2 class="f-14">Janice Miller</h2>
                                    <p class="date-review">2023/12/4</p>
                                </div>
                                <div class="star-group d-flex align-items-center me-3">
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                </div>
                            </div>
                            <p class="review-msg text-start">Nam libero tempore, cum soluta nobis est eligendi optio cumque
                                nihil
                                impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                        </div>
                    </div>
                    <div class="border-bottom d-flex align-items-start gap-4 mt-3">

                        <div class="profile"></div>
                        <div class="review-section">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="profile-info text-start">
                                    <h2 class="f-14">Janice Miller</h2>
                                    <p class="date-review">2023/12/4</p>
                                </div>
                                <div class="star-group d-flex align-items-center me-3">
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                    <i class="fa-solid fa-star fa-2xs"></i>
                                </div>
                            </div>
                            <p class="review-msg text-start">Nam libero tempore, cum soluta nobis est eligendi optio cumque
                                nihil
                                impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                        </div>
                    </div>
                    <div class="review-form-section">
                        <h5 class="mt-4">Be the first to review “Message Cotton T-Shirt</h5>
                        <p class="f-14 text-black-50">Your email address will not be published. Required fields are marked
                            *</p>
                    </div>
                        <form action="">
                            <div class="d-flex align-items-center my-4">
                                <span class="f-14 text-black-50">Your Rating *</span>
                                <div class="star-group d-flex align-items-center"></div>
                                <i class="fa-solid fa-star fa-2xs"></i>
                                <i class="fa-solid fa-star fa-2xs"></i>
                                <i class="fa-solid fa-star fa-2xs"></i>
                                <i class="fa-solid fa-star fa-2xs"></i>
                                <i class="fa-solid fa-star fa-2xs"></i>
                            </div>
                    
                    <textarea name="review" id="review" rows="5" class="w-100 mb-3 form-input" placeholder="Your review"></textarea>
                    <div class="input-div my-4 position-relative">
                        <input type="text" id="name" name="name" class="form-input">
                        <label for="name" class="label">Name *</label>
                    </div>
                    <div class="input-div my-4 position-relative">
                        <input type="email" id="email" name="email" class="form-input">
                        <label for="email" class="label">Email *</label>
                    </div>
                    <div class="input-div my-4 text-start">
                        <input type="checkbox" name="policy" id="policy">
                        <label for="policy">Save my name, email, and website in this browser for the next time I comment.
                        </label>
                    </div>
                    <input type="submit" class="btn btn-dark text-start" name="submit">

                    </form>

                </div>
            </div>
            </div>


        </section>

        <section class="related-product-section">
            <div class="container">
                <h2 class="text-uppercase my-4">Related <strong>Products</strong></h2>
                <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        @foreach ($rproducts as $rproduct)
                            <div class="swiper-slide">
                                <div class="product-card">
                                    <div class="position-relative product-img">
                                        <a href="{{ route('shop.product.details', ['product_slug' => $rproduct->slug]) }}">
                                            <img src="{{ asset('uploads/products') }}/{{ $rproduct->image }}"
                                                alt="{{ $rproduct->name }}" class="first-img">
                                            @foreach (explode(',', $rproduct->images) as $gimg)
                                                <img src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                    alt="{{ $rproduct->name }}" class="second-img">
                                                    @break
                                            @endforeach
                                        </a>
                                        @if (Cart::instance('cart')->content()->where('id',$rproduct->id)->count()>0)
                                        <a href="{{ route('cart.index') }}" class="add-cart-div text-uppercase">Go to Cart</a>
                                        @else
                                        <form action="{{ route('cart.add')}}" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{ $rproduct->id }}"/>
                                          <input type="hidden" name="quantity" value="1"/>
                                                  <input type="hidden" name="name" value="{{ $rproduct->name }}"/>
                                                  <input type="hidden" name="price" value="{{ $rproduct->sale_price == '' ? $rproduct->regular_price : $rproduct->sale_price }}"/>
                                      <button type="submit" class="add-cart-div text-uppercase">Add To Cart</button>
                                        </form>
                                      @endif
                                    </div>
                                    <div class="product-card-info">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="product-subtitle f-14 text-black-50">{{ $rproduct->category->name }}
                                            </p>
                                            <i class="fa-regular fa-heart fa-xs product-heart"></i>

                                        </div>
                                        <h6 class="product-card-title my-1">
                                            <a href="#">
                                                {{ $rproduct->name }}
                                            </a>
                                        </h6>
                                        <p class="price">
                                            @if ($product->sale_price)
                                                <s>{{ $product->regular_price }}</s> ${{ $product->sale_price }}
                                            @else
                                                ${{ $product->regular_price }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('script')
    <script>
        var swiper = new Swiper(".productDetailSwiper", {
            loop: true,
            direction: "horizontal",
            spaceBetween: 10,
            // slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                992: {
                    direction: "vertical"
                }
            },
        });
        var swiper2 = new Swiper(".productDetailSwiper2", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        var swiper = new Swiper(".product-slider", {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }
            },
        });
    </script>
@endpush
