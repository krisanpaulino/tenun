@extends('template.admin')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Butuh Verifikasi</p>
                            <h4 class="my-1 text-info">{{ $masuk }}</h4>
                            <p class="mb-0 font-13"><a href="{{ route('transaksi.verify') }}" class="text-success">Lihat
                                    Selengkapnya</a></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class="bx bxs-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Butuh Dikirim</p>
                            <h4 class="my-1 text-info">{{ $kirim }}</h4>
                            <p class="mb-0 font-13"><a href="{{ route('transaksi.ship') }}" class="text-success">Lihat
                                    Selengkapnya</a></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                class="bx bxs-package"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Dalam Pengiriman</p>
                            <h4 class="my-1 text-info">{{ $proses }}</h4>
                            <p class="mb-0 font-13"><a href="{{ route('transaksi.shipping') }}" class="text-success">Lihat
                                    Selengkapnya</a></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class="lni lni-docker"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Transaksi Selesai</p>
                            <h4 class="my-1 text-info">{{ $selesai }}</h4>
                            <p class="mb-0 font-13"><a href="{{ route('transaksi.finished') }}" class="text-success">Lihat
                                    Selengkapnya</a></p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                class="bx bxs-award"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Jumlah Produk Per Kategori</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Jumlah Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kategori as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_kategori }}</td>
                                <td>{{ $row->produk->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
