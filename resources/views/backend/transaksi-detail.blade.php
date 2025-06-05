@extends('template.admin')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $title ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= route('admin') ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    @if (Session::has('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ Session::get('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('danger'))
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ Session::get('danger') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <hr />
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-uppercase">Pelanggan</h6>
            <div class="row">
                <div class="col-6">
                    <b>Nama :</b>{{ $pelanggan->nama_pelanggan }}<br>
                    <b>Email : </b>{{ $pelanggan->user->email }}<br>
                    <b>Telp : {{ $pelanggan->kontak_pelanggan }}</b><br>
                </div>
                <div class="col-6">
                    <b>Alamat Jalan :</b>{{ $pelanggan->nama_jalan }}<br>
                    <b>Kelurahan/Desa : </b>{{ $pelanggan->kelurahan }}<br>
                    <b>Kecamatan : </b>{{ $pelanggan->kecamatan }}<br>
                    <b>Kota</b> : {{ $pelanggan->city->city }}<br>
                    <b>Provinsi : </b> {{ $pelanggan->province->province }}<br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-uppercase">Detail Transaksi</h6>
                    <div class="row contacts d-flex justify-content-between">
                        <div class="col-4 invoice-details">
                            <div class="date">Tanggal Transaksi: {{ $transaksi->tanggal_transaksi }}</div>
                            <div class="date">Tanggal Pembayaran: {{ $transaksi->pembayaran->tanggal_bayar }}</div>
                            <div class="date">Status Transaksi: <b
                                    class="text-primary font-weight-bold">{{ $transaksi->status_transaksi }}</b></div>
                            <div class="date">Alamat Pengiriman: <b
                                    class="text-primary font-weight-2">{{ $transaksi->alamat_pengiriman }}</b>
                            </div>
                            <div class="date">Status Pengiriman: <b
                                    class="text-primary font-weight-2">{{ $transaksi->pengiriman->status_pengiriman }}</b>
                            </div>
                        </div>
                        <div class="col-4">
                            @if ($transaksi->pengiriman->status_pengiriman == 'dikemas')
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kirim"><i
                                            class="bx bx-package"></i> Proses
                                        Pengiriman</button>
                                </div>
                            @endif
                            @if ($transaksi->pengiriman->status_pengiriman == 'dikirim')
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#finish"><i
                                            class="bx bx-badge-check"></i> Selesaikan</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Gambar</th>
                                    <th>Penenun</th>
                                    <th>Harga Satuan</th>
                                    <th>Kuantitas</th>
                                    <th>Total Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($transaksi->detail as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->produk->nama_produk }}</td>
                                        <td><img src="{{ asset('storage/' . $row->produk->gambar_produk) }}"
                                                class="product-img-2" alt="product img"></td>
                                        <td>{{ $row->produk->penenun->nama_penenun }}</td>
                                        <td>Rp{{ number_format($row->produk->harga_produk) }}</td>
                                        <td>{{ $row->kuantitas }}</td>
                                        <td>Rp{{ number_format($row->kuantitas * $row->produk->harga_produk) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row d-flex justify-content-end">
                            <div class="col-6 invoice small">
                                <table>
                                    <tfoot>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>Rp{{ number_format($transaksi->total_produk) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ongkir</td>
                                            <td>Rp{{ number_format($transaksi->total_ongkir) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td>Rp{{ number_format($transaksi->grand_total) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card ">
                <div class="card-header">
                    <h5>Log Pengiriman</h5>
                    <strong class="text-primary text-bold">Resi : {{ $transaksi->pengiriman->resi }}</strong>
                </div>
                <div class="card-body">
                    <table class="table-borderless">
                        @foreach ($transaksi->pengiriman->log as $log)
                            <tr>
                                <th>{{ $log->waktu_update }}</th>
                                <td>{{ $log->status_pengiriman }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($transaksi->pengiriman->status_pengiriman == 'dikemas')
        <div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form" action="{{ route('transaksi.kirim') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaksi_id" id="kodeitem" value="{{ $transaksi->transaksi_id }}">
                        <div class="modal-body">
                            <h5>Proses Pengiriman</h5>
                            <div class="form-group mb-4">
                                <label for="resi">Resi</label>
                                <input type="text" class="form-control @error('resi') is-invalid @enderror"
                                    id="resi" name="resi" value="{{ old('resi') }}">
                                <div class="invalid-feedback">
                                    @error('resi')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Proses Pengiriman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if ($transaksi->pengiriman->status_pengiriman == 'dikirim')
        <div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form" action="{{ route('transaksi.finish') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}">
                        <div class="modal-body">
                            <h5>Yakin ingin menyelesaikan transaksi ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Selesaikan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
