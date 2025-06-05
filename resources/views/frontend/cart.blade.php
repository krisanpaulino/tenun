@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Keranjang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($keranjang as $item)
                                        <tr class="product-box-contain">
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <a href="product-left-thumbnail.html" class="product-image">
                                                        <img src="{{ asset('storage/' . $item->produk->gambar_produk) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <a href="#">{{ $item->produk->nama_produk }}</a>
                                                            </li>

                                                            <li class="text-content"><span
                                                                    class="text-title">Penenun:</span>
                                                                {{ $item->produk->penenun->nama_penenun }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Harga</h4>
                                                <h5>Rp{{ number_format($item->produk->harga_produk) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Qty</h4>
                                                <div class="quantity-price">
                                                    <div class="cart_qty">
                                                        <span>{{ $item->kuantitas }}</span>
                                                    </div>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Total</h4>
                                                <h5>{{ number_format($item->produk->harga_produk * $item->kuantitas) }}</h5>
                                            </td>

                                            <td class="save-remove">
                                                <h4 class="table-title text-content">Action</h4>
                                                <a class="remove" href="javascript:void(0)"
                                                    data-id="{{ $item->keranjang_id }}" data-bs-toggle="modal"
                                                    data-bs-target="#hapus">Remove</a>
                                            </td>
                                        </tr>
                                        @php
                                            $subtotal += $item->produk->harga_produk * $item->kuantitas;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        <div class="summery-box p-sticky">
                            <div class="summery-header">
                                <h3>Total Keranjang</h3>
                            </div>

                            <div class="summery-contain">
                                {{-- <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div> --}}
                                <ul>
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price">Rp{{ number_format($subtotal) }}</h4>
                                    </li>

                                    {{-- <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-) 0.00</h4>
                                </li> --}}

                                </ul>
                            </div>

                            <ul class="summery-total">
                                <li class="list-total border-top-0">
                                    <h4>Total (IDR)</h4>
                                    <h4 class="price theme-color">Rp{{ number_format($subtotal) }}</h4>
                                </li>
                            </ul>

                            <div class="button-group cart-button">
                                <ul>
                                    <li>
                                        <button type="submit"
                                            class="btn btn-animation proceed-btn fw-bold">Checkout</button>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->

    <!-- Deal Box Modal Start -->
    <div class="modal fade theme-modal deal-modal" id="hapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Hapus keranjang</h5>
                        <p class="mt-1 text-content">Hapus produk dari keranjang?</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cart.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="keranjang_id" value="" id="kodeitemhapus">
                        <div class="modal-button d-flex justify-content-end">
                            <button class="btn btn-md btn-danger icon" type="submit">Hapus dari keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->
@endsection
@section('scripts')
    <script>
        $('#hapus').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            $(this).find('#kodeitemhapus').attr("value", kode);
        });
    </script>
@endsection
