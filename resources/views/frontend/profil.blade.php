@extends('template.frontend')
@section('content')
    <section class="user-dashboard-section section-b-space">
        <div class="dashboard-right-sidebar">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="pills-profile" role="tabpanel">
                    <div class="dashboard-profile">
                        <div class="title">
                            <h2>My Profile</h2>
                            <span class="title-leaf">
                                <svg class="icon-width bg-gray">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                        </div>

                        <div class="profile-detail dashboard-bg-box">
                            <div class="dashboard-title">
                                <h3>Nama Lengkap</h3>
                            </div>
                            <div class="profile-name-detail">
                                <div class="d-sm-flex align-items-center d-block">
                                    <h3>{{ $user->pelanggan->nama_pelanggan }}</h3>
                                </div>

                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editProfil">Edit</a>
                            </div>

                            <div class="location-profile">
                                <ul>
                                    <li>
                                        <div class="location-box">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <h6>{{ $user->pelanggan->nama_jalan }}</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="location-box">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            <h6>{{ $user->email }}</h6>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>

                        <div class="profile-about dashboard-bg-box">
                            <div class="row">
                                <div class="col-xxl-7">
                                    <div class="dashboard-title mb-3">
                                        <h3>Data Diri</h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                {{-- <tr>
                                            <td>Gender :</td>
                                            <td>Female</td>
                                        </tr> --}}
                                                <tr>
                                                    <td>Nama Lengkap :</td>
                                                    <td>{{ $user->pelanggan->nama_pelanggan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Telp. :</td>
                                                    <td>
                                                        <a href="javascript:void(0)">
                                                            {{ $user->pelanggan->kontak_pelanggan }}</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat :</td>
                                                    <td>{{ $user->pelanggan->nama_jalan }},
                                                        {{ $user->pelanggan->kelurahan }},
                                                        {{ $user->pelanggan->kecamatan }},
                                                        {{ $user->pelanggan->city->city }},
                                                        {{ $user->pelanggan->province->province }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="dashboard-title mb-3">
                                        <h3>Login Details</h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Email :</td>
                                                    <td>
                                                        <a href="javascript:void(0)">vicki.pope@gmail.com
                                                            {{-- <span data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</span></a> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Password :</td>
                                                    <td>
                                                        <a href="javascript:void(0)">●●●●●●
                                                            <span data-bs-toggle="modal"
                                                                data-bs-target="#gantiPassword">Ganti</span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="editProfil" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">

                        <div class="right-sidebar-modal">
                            <form action="{{ route('profil.update') }}" class="row g-4" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"" id="email"
                                            placeholder="Email Address" value="{{ $user->email }}">
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="nama_pelanggan"
                                            class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                            id="nama_pelanggan" placeholder="Nama Lengkap"
                                            value="{{ $user->pelanggan->nama_pelanggan }}">
                                        <label for="nama_pelanggan">Nama Lengkap</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kontak_pelanggan"
                                            class="form-control @error('kontak_pelanggan') is-invalid @enderror"
                                            id="kontak_pelanggan" placeholder="Nomor HP"
                                            value="{{ $user->pelanggan->kontak_pelanggan }}">
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
                                                    {{ $row->province_id == old('provinsi', $user->pelanggan->provinsi) ? 'selected' : '' }}>
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
                                                    {{ $row->city_id == old('kota', $user->pelanggan->kota) ? 'selected' : '' }}>
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
                                            placeholder="Kecamatan" value="{{ $user->pelanggan->kecamatan }}">
                                        <label for="kecamatan">Kecamatan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kelurahan"
                                            class="form-control @error('kelurahan') is-invalid @enderror" id="kelurahan"
                                            placeholder="Kelurahan" value="{{ $user->pelanggan->kelurahan }}">
                                        <label for="kelurahan">Kelurahan/Desa</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="nama_jalan"
                                            class="form-control @error('nama_jalan') is-invalid @enderror" id="nama_jalan"
                                            placeholder="Alamat jalan" value="{{ $user->pelanggan->nama_jalan }}">
                                        <label for="nama_jalan">Alamat Jalan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="text" name="kode_pos"
                                            class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos"
                                            placeholder="Kode Pos" value="{{ $user->pelanggan->kode_pos }}">
                                        <label for="kode_pos">Kode POS</label>
                                    </div>
                                </div>
                                <div class="modal-button">
                                    <button class="btn btn-md add-cart-button icon" type="submit">Update Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Box End -->
    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="gantiPassword" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">

                        <div class="right-sidebar-modal">
                            <form action="{{ route('profil.password') }}" class="row g-4" method="post">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" name="current_password" class="form-control"
                                            id="password" placeholder="Password">
                                        <label for="password">Password Sekarang</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" name="user_password" class="form-control" id="password"
                                            placeholder="Password">
                                        <label for="password">Password Baru</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating log-in-form">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password" placeholder="Konfirmasi Password">
                                        <label for="password">Konfirmasi Password Baru</label>
                                    </div>
                                </div>
                                <div class="modal-button">
                                    <button class="btn btn-md add-cart-button icon" type="submit">Update
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Box End -->
@endsection
