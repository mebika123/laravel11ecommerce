<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('assets/image/favion.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    @stack('style')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <i class="fa-solid fa-bars navbar-toggler  col-icon border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"></i>
                <a class="navbar-brand" href="{{ route('home.index') }}"><img class="logo-img"
                        src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/logo.png"
                        alt=""></a>
                <a class="nav-link d-lg-none position-relative" href="{{ route('cart.index') }}">
                    <i class="fa-solid fa-bag-shopping nav-icon"></i>
                    @if (Cart::instance('cart')->content()->count() > 0)
                        <span
                            class="cart-amt position-absolute d-flex justify-content-center align-items-center text-white">{{ Cart::instance('cart')->content()->count() }}</span>
                    @endif
                </a>

                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 nav-list">
                        <li class="nav-item position-relative d-lg-none">
                            <input type="text" class="search-box border-box" name="search"
                                placeholder="Search Products">
                            <i class="fa-solid fa-magnifying-glass nav-icon search-icon"></i>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bar-before" aria-current="page" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bar-before" href="{{ route('shop.index') }}">SHOP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bar-before" href="{{ route('cart.index') }}">CART</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bar-before" href="#">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bar-before" href="{{ route('home.contact') }}">CONTACT</a>
                        </li>
                    </ul>


                    <ul class="navbar-nav mb-2 mb-lg-0 nav-list">
                        <li class="nav-item">
                            <a class="nav-link d-none d-lg-block " id="searchBtn" href="#">
                                <i class="fa-solid fa-magnifying-glass nav-icon"></i>
                            </a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa-regular fa-user nav-icon"></i>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ Auth::user()->utype === 'ADM' ? route('admin.index') : route('user.index') }}">
                                    <span class="pr-6px">{{ Auth::user()->name }}</span>
                                    <i class="fa-regular fa-user nav-icon"></i>
                                </a>
                            </li>
                        @endguest

                        <li class="nav-item">
                            <a class="nav-link d-none d-lg-block" href="#">
                                <i class="fa-regular fa-heart nav-icon"></i>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link d-none d-lg-block position-relative" href="{{ route('cart.index') }}">
                                <i class="fa-solid fa-bag-shopping nav-icon"></i>
                                @if (Cart::instance('cart')->content()->count() > 0)
                                    <span
                                        class="cart-amt position-absolute d-flex justify-content-center align-items-center text-white">{{ Cart::instance('cart')->content()->count() }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>

        <div id="searchContent" class="search-content d-none">
            <div class="container">
                <h4>What are you looking for?</h4>
                <form>
                    <div class="position-relative search-div">
                        <input type="text" class=" search-box" name="query" placeholder="Search Products"
                            id="search-input">
                        <i class="fa-solid fa-magnifying-glass nav-icon search-icon"></i>
                    </div>
                </form>
                <h6 class="list-title">Quicklinks</h6>
                <ul class="quick-link-list p-0" id="box-content-search">
                    {{-- <li class="quick-link-item">
                            <a class="quick-link bar-before" href="#">New Arrivals</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link bar-before" href="#">Dresses</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link bar-before" href="#">Accessories</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link bar-before" href="#">Footwear</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link bar-before" href="#">Sweatshirt</a>
                        </li> --}}

                </ul>
            </div>
    </header>

    @yield('content')
    <footer class="mt-5 pt-5">
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5">
                <div class="footer-store-info col-12 ">
                    <a class="navbar-brand" href="#"><img class="logo-img w-100"
                            src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/logo.png"
                            alt=""></a>
                    <p class="footer-adress font-color mt-4">123 Beach Avenue, Surfside City, CA 00000</p>
                    <p class="footer-contact font-color my-3">contact@surfsidemedia.in</p>
                    <ul class="social-link d-flex gap-3 ps-0">
                        <li class="social-item">
                            <a href="#">
                                <i class="fa-brands font-color fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="#">
                                <i class="fa-brands font-color fa-twitter"></i>
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="#">
                                <i class="fa-brands font-color fa-instagram"></i>
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="#">
                                <i class="fa-brands font-color fa-youtube"></i>
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="#">
                                <i class="fa-brands font-color fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu mt-3 mt-lg-0">
                    <h5 class="footer-menu-title fw-medium mb-4 text-uppercase">Company</h5>
                    <ul class="ps-0">
                        <li class="mb-3">
                            <a href="#" class="bar-before">About Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Careers</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Affiliated</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Blog</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu mt-3 mt-lg-0">
                    <h5 class="footer-menu-title fw-medium mb-4 text-uppercase">Company</h5>
                    <ul class="ps-0">
                        <li class="mb-3">
                            <a href="#" class="bar-before">About Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Careers</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Affiliated</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Blog</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu mt-3 mt-lg-0">
                    <h5 class="footer-menu-title fw-medium mb-4 text-uppercase">Company</h5>
                    <ul class="ps-0">
                        <li class="mb-3">
                            <a href="#" class="bar-before">About Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Careers</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Affiliated</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Blog</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu mt-3 mt-lg-0">
                    <h5 class="footer-menu-title fw-medium mb-4 text-uppercase">Company</h5>
                    <ul class="ps-0">
                        <li class="mb-3">
                            <a href="#" class="bar-before">About Us</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Careers</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Affiliated</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Blog</a>
                        </li>
                        <li class="mb-3">
                            <a href="#" class="bar-before">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        $(function() {
            $("#search-input").on("keyup", function() {
                var searchQuery = $(this).val();
                if (searchQuery.length > 2) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('home.search') }}",
                        data: {
                            query: searchQuery
                        },
                        dataType: 'json',
                        success: function(data) {
                            $("#box-content-search").html('');
                            $.each(data, function(index,item){
                                var url =
                                    "{{ route('shop.product.details', ['product_slug' => 'product_slug_pls']) }}";
                                var link = url.replace('product_slug_pls', item.slug);
                                $("#box-content-search").append(
                                    `<li>
                                        <ul>
                                            <li class="product-item gap-4 mb-10">
                                                <div class="image no-bg">
                                                    <img src="{{ asset('uploads/products/thumbnails') }}/${item.image}" alt="${item.name}">
                                                </div>
                                                <div class="d-flex align-items-center justify-between gap-5 flex-grow">
                                                    <div class="name">
                                                        <a href="${link}" class="body-text">${item.name}</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-10">
                                                <div class="divider"></div>
                                            </li>
                                        </ul>
                                    </li>`
                                );

                            });

                        }
                    });
                }
            });
        });
    </script>
    @stack('script')

</body>

</html>
