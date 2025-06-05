@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Detail Transaksi</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Detail Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Alamat Penerima</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>

                                                            {{-- <div class="label">
                                                                <label>Alamat saya</label>
                                                            </div> --}}

                                                            <ul class="delivery-address-detail">
                                                                <li>
                                                                    <h4 class="fw-500">{{ $pelanggan->nama_pelanggan }}</h4>
                                                                </li>

                                                                <li>
                                                                    <p class="text-content"><span class="text-title">Alamat
                                                                            : </span>{{ $transaksi->alamat_transaksi }},
                                                                        {{ $transaksi->alamat_region }}</p>
                                                                </li>


                                                                <li>
                                                                    <h6 class="text-content mb-0"><span
                                                                            class="text-title">Telp.
                                                                            :</span> {{ $pelanggan->kontak_pelanggan }}</h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Pembayaran</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-9">

                                                    <div class="delivery-option">
                                                        <div class="delivery-category">
                                                            <div class="shipment-detail">
                                                                <div class="form-check custom-form-check hide-check-box">
                                                                    @if ($transaksi->pembayaran->metode_id = 1 && $transaksi->pembayaran->status_pembayaran == 'menunggu pembayaran')
                                                                        <form action="{{ route('order.payment') }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="transaksi_id"
                                                                                    value="{{ $transaksi->transaksi_id }}">
                                                                                <div class="form-group">
                                                                                    <label class="form-check-label"
                                                                                        for="standard">Upload bukti</label>

                                                                                    <input type="file"
                                                                                        name="bukti_pembayaran"
                                                                                        id="" class="form-control"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button
                                                                                    class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold"
                                                                                    type="submit">Upload Bukti</button>
                                                                            </div>
                                                                        </form>
                                                                    @else
                                                                        <div class="form-group col-12">
                                                                            <p class="font-weigth-bold">Metode Pembayaran
                                                                                :
                                                                                {{ $pembayaran->metode->nama_metode }}</p>
                                                                        </div>
                                                                        @if ($pembayaran->status_pembayaran != 'menunggu pembayaran' && $pembayaran->metode_id == 1)
                                                                            <div class="form-group col-12">
                                                                                <p class="font-weigth-bold">Bukti
                                                                                    Pembayaran
                                                                                    :
                                                                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                                                                        target="_blank">Lihat
                                                                                        Bukti</a>
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xxl-12">
                                                    @if ($pembayaran->status_pembayaran != 'menunggu pembayaran' && $pembayaran->metode_id == 1)
                                                        <span class="font-weigth-bold">Bukti
                                                            Pembayaran
                                                            :
                                                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                                                target="_blank">Lihat
                                                                Bukti</a></span>
                                                    @endif
                                                </div> --}}
                                                <div class="col-xxl-12">
                                                    <b>Status Pembayaran :
                                                        {{ $transaksi->pembayaran->status_pembayaran }}</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Rincian Pesanan</h3>
                            </div>

                            <ul class="summery-contain">
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($transaksi->detail as $item)
                                    <li>
                                        <img src="{{ asset('storage/' . $item->produk->gambar_produk) }}"
                                            class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>{{ $item->produk->nama_produk }} <span>X {{ $item->kuantitas }}</span></h4>
                                        <h4 class="price">
                                            Rp{{ number_format($item->produk->harga_produk * $item->kuantitas) }}</h4>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="summery-total">
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">Rp{{ number_format($transaksi->total_produk) }}</h4>
                                </li>

                                <li>
                                    <h4>Shipping</h4>
                                    <h4 class="price" id="ongkir">Rp{{ number_format($transaksi->total_ongkir) }}</h4>
                                </li>


                                {{-- <li>
                                    <h4>Coupon/Code</h4>
                                    <h4 class="price">$-23.10</h4>
                                </li> --}}

                                <li class="list-total">
                                    <h4>Total (IDR)</h4>
                                    <h4 class="price" id="grand_total">Rp{{ number_format($transaksi->grand_total) }}</h4>
                                </li>
                            </ul>
                        </div>

                        {{-- <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">Buat --}}
                        {{-- Pesanan</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection
