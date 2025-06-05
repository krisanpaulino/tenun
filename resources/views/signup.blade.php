<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('front') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('front') }}/images/favicon.png" type="image/x-icon">
    <title>Toko Tenun Gerodhere - Sign Up</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/css/style.css">
</head>

<body class="theme-color-4">
    <!-- login section start -->
    <section class="log-in-section section-b-space">
        <div class="container w-100">
            <div class="row">

                <div class="col-xl-5 col-lg-6 me-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Selamat datang di Rumah Tenun Milenial</h3>
                            <h4>Buat akun untuk membeli</h4>
                        </div>

                        <div class="input-box">
                            <form class="row g-4" method="POST" action="{{ route('signup.post') }}">
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"" id="email"
                                            placeholder="Email Address">
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="nama_pelanggan"
                                            class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                            id="nama_pelanggan" placeholder="Email Address">
                                        <label for="nama_pelanggan">Nama Pelangggan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kontak_pelanggan"
                                            class="form-control @error('kontak_pelanggan') is-invalid @enderror"
                                            id="kontak_pelanggan" placeholder="Nomor HP">
                                        <label for="kontak_pelanggan">Nomor HP/WA</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <select name="provinsi"
                                            class="form-select @error('provinsi') is-invalid @enderror" id="provinsi"
                                            placeholder="Provinsi">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach ($provinsi as $row)
                                                <option value="{{ $row->province_id }}"
                                                    {{ $row->province_id == old('provinsi') ? 'selected' : '' }}>
                                                    {{ $row->province }}</option>
                                            @endforeach
                                        </select>
                                        <label for="kontak">Provinsi</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <select name="kota" class="form-select @error('kota') is-invalid @enderror"
                                            id="kota" placeholder="Kota">
                                            <option value="">Pilih Kota</option>
                                            @foreach ($kota as $row)
                                                <option value="{{ $row->city_id }}"
                                                    {{ $row->city_id == old('kota') ? 'selected' : '' }}>
                                                    {{ $row->city }}</option>
                                            @endforeach
                                        </select>
                                        <label for="kontak">Kota</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kecamatan"
                                            class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan"
                                            placeholder="Kecamatan">
                                        <label for="kecamatan">Kecamatan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kelurahan"
                                            class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                                            placeholder="Kelurahan">
                                        <label for="kelurahan">Kelurahan/Desa</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="nama_jalan"
                                            class="form-control @error('nama_jalan') is-invalid @enderror"
                                            id="nama_jalan" placeholder="Alamat jalan">
                                        <label for="nama_jalan">Alamat Jalan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kode_pos"
                                            class="form-control @error('kode_pos') is-invalid @enderror"
                                            id="kode_pos" placeholder="Email Address">
                                        <label for="kode_pos">Kode POS</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" name="user_password" class="form-control"
                                            id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password" placeholder="Konfirmasi Password">
                                        <label for="password">Konfirmasi Password</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-animation w-100 justify-content-center"
                                        type="submit">Log In</button>
                                    <h5 class="new-page mt-3 text-center">Sudah punya akun? <a
                                            href="{{ route('login') }}">Log In</a></h5>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end -->

</body>

</html>
