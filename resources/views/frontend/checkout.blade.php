@extends('template.frontend')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
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
        <form action="{{ route('order.place') }}" method="post">
            @csrf
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
                                            <div class="form-group">
                                                <select id="mySelect2" style="width: 100%" name="lokasi_id">
                                                    <option value="">Cari Kota / Kecamatan</option>
                                                </select>
                                            </div>
                                            <div class="checkout-detail">
                                                <div class="row g-4">
                                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                                        <div class="delivery-address-box" id="address">
                                                            <div>

                                                                {{-- <div class="label">
                                                                    <label>Alamat saya</label>
                                                                </div> --}}

                                                                <input type="hidden" name="alamat_region"
                                                                    id="stringLokasi">
                                                                <ul class="delivery-address-detail">

                                                                    <li>
                                                                        <div class="form-group mb-2">
                                                                            <label for="">Alamat Jalan</label>
                                                                            <textarea name="alamat_transaksi" class="form-control" id="" cols="50" rows="10" required></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <h6 class="text-content mb-0"><span
                                                                                class="text-title">Telp.
                                                                                :</span> {{ $pelanggan->kontak_pelanggan }}
                                                                        </h6>
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
                                                <h4>Pengiriman</h4>
                                            </div>

                                            <div class="checkout-detail">
                                                <div class="row g-4">
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box">
                                                                        <div class="form-group">
                                                                            <label class="form-check-label"
                                                                                for="standard">Pilih pengiriman</label>
                                                                            <select name="ongkir" id="ongkir"
                                                                                class="form-select">
                                                                                <option value="">Pilih pengiriman
                                                                                </option>
                                                                                {{-- @foreach ($ongkir['costs'] as $cost)
                                                                                    <option
                                                                                        value="{{ $cost['cost'][0]['value'] }}">
                                                                                        {{ $cost['description'] }} -
                                                                                        Rp{{ number_format($cost['cost'][0]['value']) }}
                                                                                    </option>
                                                                                @endforeach --}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box">
                                                                        <div class="form-group">
                                                                            <label class="form-check-label"
                                                                                for="standard">Pilih Pembayaran</label>
                                                                            <select name="metode_id" id="metode_id"
                                                                                class="form-select">
                                                                                <option value="">Pilih Metode</option>
                                                                                @foreach ($metode as $item)
                                                                                    <option
                                                                                        value="{{ $item->metodepembayaran_id }}">
                                                                                        {{ $item->nama_metode }} -
                                                                                        {{ $item->deskripsi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                    <h3>Order Summary</h3>
                                </div>

                                <ul class="summery-contain">
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($keranjang as $item)
                                        <li>
                                            <img src="{{ asset('storage/' . $item->produk->gambar_produk) }}"
                                                class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                            <h4>{{ $item->produk->nama_produk }} <span>X {{ $item->kuantitas }}</span>
                                            </h4>
                                            <h4 class="price">
                                                Rp{{ number_format($item->produk->harga_produk * $item->kuantitas) }}</h4>
                                        </li>
                                        @php
                                            $subtotal += $item->produk->harga_produk * $item->kuantitas;
                                        @endphp
                                    @endforeach
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                </ul>

                                <ul class="summery-total">
                                    <li>
                                        <h4>Subtotal</h4>
                                        <h4 class="price">Rp{{ number_format($subtotal) }}</h4>
                                    </li>

                                    <li>
                                        <h4>Shipping</h4>
                                        <h4 class="price" id="shipping"></h4>
                                    </li>


                                    {{-- <li>
                                    <h4>Coupon/Code</h4>
                                    <h4 class="price">$-23.10</h4>
                                </li> --}}

                                    <li class="list-total">
                                        <h4>Total (IDR)</h4>
                                        <h4 class="price" id="Total"></h4>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" type="submit">Buat
                                Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Checkout section End -->
@endsection
@section('cssplugins')
    <link href="{{ asset('front') }}/css/select2.min.css" rel="stylesheet" />
@endsection
@section('jsplugins')
    <script src="{{ asset('front') }}/js/select2.min.js"></script>
@endsection
@section('scripts')
    <script>
        $('#mySelect2').on('change', function(e) {
            var lokasi = $('#mySelect2').val()
            $('#stringLokasi').val($('#mySelect2 option:selected').text());
            $('#ongkir').empty();

            $.ajax({
                url: "{{ route('ajax.getCost') }}",
                type: 'GET',
                data: {
                    destination: lokasi
                },
                success: function(data) {
                    console.log(data);

                    $('#ongkir').append($('<option>', {
                        text: 'Pilih Pengiriman'
                    }));
                    $.each(data, function(i, item) {
                        $('#ongkir').append($('<option>', {
                            value: item.cost,
                            text: item.description + ' (' + item.etd + ') - Rp' +
                                item.cost.toLocaleString('en-US')
                        }));
                    });
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        })

        $('body').on('change', '#ongkir', function(e) {
            var ongkir = $('body #ongkir').map(function() {
                return $(this).val();
            }).get();
            console.log(ongkir);

            var totalongkir = 0;
            $.each(ongkir, function(key, val) {

                if (val != '') {
                    var subtotal = parseFloat(val)
                    totalongkir += subtotal
                }

            });
            $('#shipping').text('Rp' + totalongkir.toLocaleString('en-US'))
            var total = totalongkir + {{ $total }}
            $('#Total').text('Rp' + total.toLocaleString('en-Us'))
        })
    </script>
@endsection
