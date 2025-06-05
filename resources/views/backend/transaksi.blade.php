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
            <h6 class="mb-4 text-uppercase">Data Transaksi</h6>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Status Transaksi</th>
                            <th>Status Pembayaran</th>
                            <th>Pengiriman</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($transaksi as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->tanggal_transaksi }}</td>
                                <td>{{ $row->pelanggan->nama_pelanggan }}</td>
                                <td>{{ $row->status_transaksi }}</td>
                                <td>{{ $row->pembayaran->status_pembayaran }}</td>
                                @if ($row->pengiriman->status_pengiriman == 'dikirim')
                                    <td>Resi : {{ $row->pengiriman->resi }}</td>
                                @else
                                    <td>Status : {{ $row->pengiriman->status_pengiriman }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('transaksi.detail', $row->transaksi_id) }}"
                                        class="badge bg-primary">Detail</a>
                                    @if (Route::currentRouteName() == 'transaksi.verify')
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#verifikasi"
                                            data-id="{{ $row->transaksi_id }}"
                                            data-bukti="{{ asset('storage/' . $row->pembayaran->bukti_pembayaran) }}"
                                            class="badge bg-warning">Verifikasi Bukti</a>
                                    @endif
                                    @if (Route::currentRouteName() == 'transaksi.shipping')
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#finish"
                                            data-id="{{ $row->transaksi_id }}" class="badge bg-success">Selesaikan</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (Route::currentRouteName() == 'transaksi.verify')
        <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form" action="{{ route('verifikasi.post') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaksi_id" id="kodeitem" value="">
                        <div class="modal-body">
                            <h5>Bukti Pembayaran</h5>
                            <img src="" id="bukti_pembayaran" alt="" class="img img-thumbnail">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if (Route::currentRouteName() == 'transaksi.shipping')
        <div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form" action="{{ route('transaksi.finish') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaksi_id" id="kodeitem" value="">
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

@section('cssplugins')
    <link href="{{ asset('/') }}plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('jsplugins')
    <script src="{{ asset('/') }}plugins/datatable/js/jquery.dataTables.min.js"></script>
@endsection

@section('scripts')
    <script>
        $('#verifikasi').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            var bukti = $(event.relatedTarget).data('bukti');
            $(this).find('#kodeitem').attr("value", kode);
            $(this).find('#bukti_pembayaran').attr("src", bukti);
        });
        $('#finish').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            var bukti = $(event.relatedTarget).data('bukti');
            $(this).find('#kodeitem').attr("value", kode);
            $(this).find('#bukti_pembayaran').attr("src", bukti);
        });
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
