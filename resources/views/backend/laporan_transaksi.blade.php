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
    <form class="row row-cols-1 g-3 mb-4 row-cols-lg-auto align-items-center">
        <div class="col">
            <input type="date" class="form-control" id="input51" name="dari" value="{{ $dari }}"
                placeholder="Dari Tanggal">
        </div>
        <div class="col">
            <input type="date" class="form-control" id="input51" name="sampai" value="{{ $sampai }}"
                placeholder="Sampai Tanggal">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary px-4">Filter</button>
        </div>
        <div class="col">
            <a href="<?= url('/admin/laporan/cetak?dari' . $dari . '&sampai=' . $sampai) ?>" target="_blank"
                class="btn btn-warning px-4">Cetak</a>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-uppercase">Laporan Transaksi</h6>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Produk</th>
                            <th>Status Transaksi</th>
                            <th>Status Pembayaran</th>
                            <th>Subotal Produk</th>
                            <th>Ongkir</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($laporan as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->tanggal_transaksi }}</td>
                                <td>{{ $row->pelanggan->nama_pelanggan }}</td>
                                <td>
                                    @foreach ($row->detail as $item)
                                        {{ $item->produk->nama_produk }}; <br>
                                    @endforeach
                                </td>
                                <td>{{ $row->pembayaran->status_pembayaran }}</td>
                                <td>{{ $row->status_transaksi }}</td>
                                <td>Rp{{ number_format($row->total_produk) }}</td>
                                <td>Rp{{ number_format($row->total_ongkir) }}</td>
                                <td>Rp{{ number_format($row->grand_total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('cssplugins')
    <link href="{{ asset('/') }}plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('jsplugins')
    <script src="{{ asset('/') }}plugins/datatable/js/jquery.dataTables.min.js"></script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
