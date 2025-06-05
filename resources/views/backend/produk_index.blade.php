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
    <div class="text-white">{{ Session::get('success')}}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('danger'))
<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
    <div class="text-white">{{ Session::get('danger')}}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<hr />
<div class="card">
    <div class="card-body">
        <h6 class="mb-4 text-uppercase">Produk Tenun</h6>
        <div class="d-flex justify-content-end mb-4">
            <a class=" btn btn-primary" href="{{route('produk.tambah')}}">
                <i class="fadeIn animated bx bx-plus"></i> Tambah
            </a>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Gambar</th>
                        <th>Penenun</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($produk as $row)
                       <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $row->nama_produk }}</td>
							<td><img src="{{asset('storage/'.$row->gambar_produk)}}" class="product-img-2" alt="product img"></td>
                            <td>{{ $row->penenun->nama_penenun }}</td>
                            <td>Rp{{ number_format($row->harga_produk) }}</td>
                            <td>{{ $row->stok_produk }}</td>
                            <td>
                                <a href="{{route('produk.edit', $row->produk_id)}}" class="badge bg-primary">Edit</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#hapus" data-id="{{ $row->produk_id }}" class="badge bg-danger">Hapus</a>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('produk.delete')}}" method="post">
                @csrf
                <input type="hidden" name="produk_id" id="kodeitemhapus" value="">
                <div class="modal-body">
                    <h5>Yakin ingin menghapus produk ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
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
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
