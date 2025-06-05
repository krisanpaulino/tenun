<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="{{ asset('front') }}/assets/images/favicon/2.png" type="image/x-icon">
    <title>Teko Tenun</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('front') }}/assets/css/vendors/bootstrap.css">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('front') }}/assets/css/animate.min.css">
    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/assets/css/bulk-style.css">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('front') }}/assets/css/style.css">
    @yield('cssplugins')
    <style>
        .nav-item {
            .nav-linko {
                border: none;
                color: $title-color;
                font-weight: 500;
                transition: all 0.3s ease-in-out;
                font-size: calc(14px + (16 - 14) * ((100vw - 320px) / (1920 - 320)));
                white-space: nowrap;
                background-color: $white;
                line-height: 1;
                border: 1px solid var(--theme-color);
                padding: calc(9px + (14 - 9) * ((100vw - 320px) / (1920 - 320))) calc(14px + (30 - 14) * ((100vw - 320px) / (1920 - 320)));
                margin: 0;

                &.active,
                &:hover {
                    background-color: var(--theme-color);
                    color: $white;
                }

            }
        }
    </style>
</head>

<body class="theme-color-4">

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="pb-md-4 pb-0">

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="{{ url('/') }}" class="web-logo nav-logo">
                                <h1>Rumah Tenun Milenial</h1>
                            </a>

                            <div class="middle-box">
                                <form action="{{ url('/') }}" method="get">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <input type="search" name="keyword" class="form-control"
                                                placeholder="Cari..." value="{{ isset($keyword) ? $keyword : '' }}">
                                            <button class="btn search-button-2" type="submit" id="button-addon2">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                                            </li>
                                            @if (Session::get('login_pelanggan'))
                                                <li class="nav-item">

                                                    <a class="nav-link" href="{{ route('cart') }}">Keranjang
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge bg-danger">{{ \App\Models\Keranjang::where('pelanggan_id', '=', \App\Models\Pelanggan::where('user_id', Session::get('user_id'))->first()->pelanggan_id)->where('checkout', '0')->count() }}
                                                        </span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('order.list') }}">My Order</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('/profil') }}">My Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                                                </li>
                                            @endif
                                            {{-- <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Shop</a>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="shop-category-slider.html">Shop
                                                            Category Slider</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-category.html">Shop
                                                            Category Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-banner.html">Shop
                                                            Banner</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-left-sidebar.html">Shop
                                                            Left
                                                            Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-right-sidebar.html">Shop
                                                            Right Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-top-filter.html">Shop
                                                            Top
                                                            Filter</a>
                                                    </li>
                                                </ul>
                                            </li> --}}

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->


    @yield('content')


    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{ asset('front') }}/assets/js/jquery-3.6.0.min.js"></script>

    <!-- jquery ui-->
    <script src="{{ asset('front') }}/assets/js/jquery-ui.min.js"></script>

    <!-- sidebar open js -->
    <script src="{{ asset('front') }}/assets/js/filter-sidebar.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('front') }}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/assets/js/bootstrap/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="{{ asset('front') }}/assets/js/feather/feather.min.js"></script>
    <script src="{{ asset('front') }}/assets/js/feather/feather-icon.js"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('front') }}/assets/js/lazysizes.min.js"></script>

    <!-- Slick js-->
    <script src="{{ asset('front') }}/assets/js/slick/slick.js"></script>
    <script src="{{ asset('front') }}/assets/js/slick/custom_slick.js"></script>
    <script src="{{ asset('front') }}/assets/js/bootstrap/bootstrap-notify.min.js"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('front') }}/assets/js/auto-height.js"></script>

    <!-- Timer Js -->
    <script src="{{ asset('front') }}/assets/js/timer1.js"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('front') }}/assets/js/fly-cart.js"></script>

    <!-- Quantity js -->
    <script src="{{ asset('front') }}/assets/js/quantity-2.js"></script>

    <!-- WOW js -->
    <script src="{{ asset('front') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('front') }}/assets/js/custom-wow.js"></script>
    @yield('jsplugins')
    <!-- script js -->
    <script src="{{ asset('front') }}/assets/js/script.js"></script>

    <!-- theme setting js -->
    <script src="{{ asset('front') }}/assets/js/theme-setting.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            $('#mySelect2').select2({
                ajax: {
                    url: "{{ route('ajax.getLokasi') }}",
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data) {
                        var res = jQuery.parseJSON(data)
                        console.log(res.results);

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: res.results
                        };
                    }

                }
            });
            // $('.form-select').select2();
        });
    </script>
</body>

</html>
