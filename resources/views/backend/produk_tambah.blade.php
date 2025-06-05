@extends('template.admin')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><?= $title ?></div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= route('admin') ?>"><i class="bx bx-home-alt"></i></a>
                <li class="breadcrumb-item"><a href="<?= route('produk.index') ?>">Produk</a>
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
        <h6 class="mb-4 text-uppercase">Tambah Produk</h6>
        <form class="form" action="{{ route('produk.insert') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group mb-4">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"  name="nama_produk" value="<?= old('nama_produk') ?>">
                <div class="invalid-feedback">
                    @error('nama_produk')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="harga_produk">Harga Produk</label>
                <input type="text" class="form-control @error('harga_produk') is-invalid @enderror"  name="harga_produk" value="<?= old('harga_produk') ?>">
                <div class="invalid-feedback">
                    @error('harga_produk')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="stok_produk">Stok</label>
                <input type="text" class="form-control @error('stok_produk') is-invalid @enderror"  name="stok_produk" value="<?= old('stok_produk') ?>">
                <div class="invalid-feedback">
                    @error('stok_produk')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="kategori">Kategori</label>
                <select type="text" class="form-control @error('kategori_id') is-invalid @enderror"  name="kategori_id">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $row)
                        <option value="{{$row->kategori_id}}" {{ ($row->kategori_id == old('kategori_id')) ? 'selected' : '' }}>{{ $row->nama_kategori }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('kategori_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="penenun">Penenun</label>
                <select type="text" class="form-control @error('penenun_id') is-invalid @enderror"  name="penenun_id">
                    <option value="">Pilih penenun</option>
                    @foreach ($penenun as $row)
                        <option value="{{$row->penenun_id}}" {{ ($row->penenun_id == old('penenun_id')) ? 'selected' : '' }}>{{ $row->nama_penenun }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('penenun_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="deskripsi_produk">Deskripsi</label>
                <textarea type="text" class="form-control @error('deskripsi_produk') is-invalid @enderror"  name="deskripsi_produk">{{ old('deskripsi_produk') }}</textarea>
                <div class="invalid-feedback">
                    @error('deskripsi_produk')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="gambar_produk">Gambar Produk</label>
                <input type="file" class="form-control @error('gambar_produk') is-invalid @enderror"  name="gambar_produk" value="<?= old('gambar_produk') ?>">
                <div class="invalid-feedback">
                    @error('gambar_produk')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-4">
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
