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
        <h6 class="mb-4 text-uppercase">Data Kategori</h6>
        <div class="d-flex justify-content-end mb-4">
            <button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fadeIn animated bx bx-plus"></i> Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($kategori as $row)
                       <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $row->nama_kategori }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $row->kategori_id }}" data-nama="{{ $row->nama_kategori }}" class="badge bg-primary">Edit</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#hapus" data-id="{{ $row->kategori_id }}" class="badge bg-danger">Hapus</a>
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
            <form class="form" action="{{route('kategori.delete')}}" method="post">
                @csrf
                <input type="hidden" name="kategori_id" id="kodeitemhapus" value="">
                <div class="modal-body">
                    <h5>Yakin ingin mengapus kategori ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Kategori</h5>
            </div>
            <form class="form" action="{{ route('kategori.insert') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"  name="nama_kategori" value="<?= old('nama_kategori') ?>">
                        <div class="invalid-feedback">
                            @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{ route('kategori.update') }}" method="post">
                @csrf
                <input type="hidden" name="kategori_id" id="kodeitemedit" value="">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="<?= old('nama_kategori') ?>">
                        <div class="invalid-feedback">
                            @error('nama_kategori')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
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
    $('#edit').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('nama');
        $(this).find('#kodeitemedit').attr("value", kode);
        $(this).find('#nama_kategori').attr("value", nama);
    });
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
