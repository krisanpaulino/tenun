@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Transaksi Saya</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Daftar Transaksi</li>
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
                                    @foreach ($transaksi as $item)
                                        <tr class="product-box-contain">
                                            <td class="product-detail">
                                                <h4 class="table-title text-content">Tanggal Transaksi</h4>
                                                <h5 class="name">{{ $item->tanggal_transaksi }}</h5>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Total Produk</h4>
                                                <h5>Rp{{ number_format($item->total_produk) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Total Ongkir</h4>
                                                <h5>Rp{{ number_format($item->total_ongkir) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>
                                            <td class="price">
                                                <h4 class="table-title text-content">Total Bayar</h4>
                                                <h5>Rp{{ number_format($item->grand_total) }}</h5>
                                                {{-- <h6 class="theme-color">You Save : $20.68</h6> --}}
                                            </td>

                                            <td class="save-remove">
                                                <h4 class="table-title text-content">Action</h4>
                                                <a class="save"
                                                    href="{{ route('order.detail', $item->transaksi_id) }}">Lihat detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection
