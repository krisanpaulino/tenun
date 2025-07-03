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
            <h6 class="mb-4 text-uppercase">Data Pelanggan</h6>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Jumlah Transaksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($pelanggan as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->nama_pelanggan }}</td>
                                <td>{{ $row->nama_jalan }}, {{ $row->kelurahan }}, {{ $row->kecamatan }},
                                    {{ $row->city->city }}, {{ $row->province->province }}</td>
                                <td>{{ $row->kontak_pelanggan }}</td>
                                <td>{{ $row->transaksi->count() }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.transaksi', $row->pelanggan_id) }}"
                                        class="badge bg-info">Lihat Transaksi</a>
                                </td>
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
        $('#hapus').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            $(this).find('#kodeitemhapus').attr("value", kode);
        });
        $('#edit').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            var nama = $(event.relatedTarget).data('nama');
            var kontak = $(event.relatedTarget).data('kontak');
            var alamat = $(event.relatedTarget).data('alamat');
            var lokasi = $(event.relatedTarget).data('lokasi');

            console.log(lokasi);

            $(this).find('#kodeitemedit').attr("value", kode);
            $(this).find('#nama_pelanggan').attr("value", nama);
            $(this).find('#kontak').attr("value", kontak);
            $(this).find('#alamat').attr("value", alamat);
            $(this).find('#lokasi').text(lokasi);
            $(this).find('#map').append(lokasi);

        });
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
