@extends('template.frontend')
@section('content')
    <!-- Home Section Start -->
    <!-- Poster Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-1 slider-animate product-wrapper no-arrow">
                        <div>
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('front') }}/assets/images/shop/4.jpg"
                                    class="bg-img rounded-3 blur-up lazyload" alt="">
                                <div class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                    <div>
                                        <h2>Hasil Tenun Terbaik </h2>
                                        <h3>Best quality!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('front') }}/assets/images/shop/4.jpg"
                                    class="bg-img rounded-3 blur-up lazyload" alt="">
                                <div
                                    class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                    <div>
                                        <h2>Hasil Tenun Terbaik </h2>
                                        <h3>Best quality!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Poster Section End -->
    <!-- Home Section End -->


    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        @if (Session::has('danger'))
                            <div class="alert alert-danger alert-dismissible">{{ Session::get('danger') }}
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible">{{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-custom-3">
                    <div class="left-box wow fadeInUp">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>

                            <form action="" method="get">
                                <div class="accordion custom-accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne">
                                                <span>Kategori</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="category-list custom-padding custom-height">
                                                    @foreach ($kategori as $cat)
                                                        <li>
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input class="checkbox_animated" name="kategori[]"
                                                                    type="checkbox" id="fruit"
                                                                    value="{{ $cat->kategori_id }}"
                                                                    @if (in_array($cat->kategori_id, $kategoriGet)) checked @endif>
                                                                <label class="form-check-label" for="fruit">
                                                                    <span class="name">{{ $cat->nama_kategori }}</span>
                                                                    <span class="number">{{ $cat->produk->count() }}</span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-animation proceed-btn fw-bold btn-block mt-4"
                                    type="submit">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-custom-">
                    @if ($keyword != '')
                        <div class="mb-4">
                            <h4>Keyword : "{{ $keyword }}"</h4>
                        </div>
                    @endif
                    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 ">
                        @foreach ($produk as $item)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.65s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="product-left-thumbnail.html">
                                                <img src="{{ asset('storage/' . $item->gambar_produk) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="product-option text-center">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view{{ $item->produk_id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $item->kategori->nama_kategori }}</span>
                                            <a href="product-left-thumbnail.html">
                                                <h5 class="name">{{ $item->nama_produk }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">
                                                {{ $item->deskripsi_produk }}
                                            </p>
                                            {{-- <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(2.4)</span>
                                        </div> --}}
                                            <h6 class="unit">Stok : {{ $item->stok_produk }}</h6>
                                            <h5 class="price"><span
                                                    class="theme-color">Rp{{ number_format($item->harga_produk) }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="custom-pagination">
                        <ul class="pagination justify-content-center">
                            {{ $produk->appends(request()->query())->links('vendor.pagination.custom') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    @foreach ($produk as $item)
        <!-- Quick View Modal Box Start -->
        <div class="modal fade theme-modal view-modal" id="view{{ $item->produk_id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-sm-4 g-2">
                            <div class="col-lg-6">
                                <div class="slider-image">
                                    <img src="{{ asset('storage/' . $item->gambar_produk) }}"
                                        class="img-fluid blur-up lazyload" alt="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="right-sidebar-modal">
                                    <form action="{{ route('cart.post') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $item->produk_id }}">
                                        <h4 class="title-name">{{ $item->nama_produk }}</h4>
                                        <h4 class="price">Rp{{ number_format($item->harga_produk) }}</h4>
                                        {{-- <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                </div> --}}

                                        <div class="product-detail">
                                            <h4>Deskripsi produk :</h4>
                                            <p>{{ $item->deskripsi_produk }}</p>
                                        </div>
                                        <div class="product-detail">
                                            <h4>Penenun :</h4>
                                            <p>{{ $item->penenun->nama_penenun }} <br>
                                            </p>
                                        </div>
                                        <div class="product-detail">
                                            <p><a href="/penenun/{{ $item->penenun->penenun_id }}"
                                                    class="text-warning small" target="_blank"><i
                                                        data-feather="map-pin"></i>
                                                    Lokasi</a>
                                            </p>
                                        </div>
                                        <div class="cart_qty qty-box">
                                            <div class="input-group bg-white">
                                                <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                                    data-field="">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                    name="kuantitas" value="0">
                                                <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                                    data-field="">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-button">
                                            <button class="btn btn-md add-cart-button icon" type="submit">Tambahkan ke
                                                keranjang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick View Modal Box End -->
    @endforeach
@endsection
