<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('/') }}images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('/') }}plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('/') }}plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('/') }}plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('/') }}css/pace.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @yield('cssplugins')
    <link href="{{ asset('/') }}css/app.css" rel="stylesheet">
    <link href="{{ asset('/') }}css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('/') }}css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('/') }}css/header-colors.css" />
    <title>Rumah Tenun Milenial</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                </div>
                <div>
                    <h4 class="logo-text">Rumah Tenun <br>Milenial</h4>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="<?= url('admin') ?>">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/kategori') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-cog"></i>
                        </div>
                        <div class="menu-title">Data Kategori</div>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/penenun') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
                        </div>
                        <div class="menu-title">Data Penenun</div>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/produk') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-cart-alt"></i>
                        </div>
                        <div class="menu-title">Data Produk</div>
                    </a>
                </li>
                <li class="menu-label">Transaksi</li>

                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-cart"></i>
                        </div>
                        <div class="menu-title">Transaksi</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('transaksi.verify') }}"><i class='bx bx-radio-circle'></i>Butuh
                                Verifikasi</a>
                        </li>
                        <li> <a href="{{ route('transaksi.ship') }}"><i class='bx bx-radio-circle'></i>Butuh
                                Dikirim</a>
                        <li> <a href="{{ route('transaksi.shipping') }}"><i class='bx bx-radio-circle'></i>Dalam
                                Pengiriman</a>
                        <li> <a href="{{ route('transaksi.finished') }}"><i class='bx bx-radio-circle'></i>Selesai</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= url('admin/laporan') ?>">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-paperclip"></i>
                        </div>
                        <div class="menu-title">Laporan</div>
                    </a>
                </li>

            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" data-bs-toggle="dropdown"><span
                                        class="alert-count">{{ \App\Models\Transaksi::where('status_transaksi', '=', 'verifikasi')->count('transaksi.transaksi_id') }}</span>
                                    <i class="bx bx-bell"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Pesanan Masuk</p>
                                            <p class="msg-header-badge">
                                                {{ \App\Models\Transaksi::where('status_transaksi', '=', 'verifikasi')->count('transaksi.transaksi_id') }}
                                                New</p>
                                        </div>
                                    </a>
                                    <div class=" ps">
                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-danger text-danger"><i
                                                        class="bx bxs-cart"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Pesanan masuk </h6>
                                                    <p class="msg-info">Anda memiliki
                                                        {{ \App\Models\Transaksi::where('status_transaksi', '=', 'checkout')->count('transaksi.transaksi_id') }}
                                                        pesanan masuk</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= asset('admin.png') ?>" class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">Admin</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center"
                                    href="<?= url('admin/ganti-password') ?>"><i
                                        class="bx bx-user fs-5"></i><span>Ganti
                                        Password</span></a>
                            <li><a class="dropdown-item d-flex align-items-center" href="<?= url('logout') ?>"><i
                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <!--end overlay-->
        <!--Start Back To Top Button-->
    </div>
    <!--end wrapper-->


    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <script src="{{ asset('/') }}plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('/') }}plugins/metismenu/js/metisMenu.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @yield('jsplugins')
    <!--app JS-->
    <script src="{{ asset('/') }}js/app.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            console.log('{{ url()->current() }}');
            $(".nav-menu").find("[href='{{ url()->current() }}']").addClass('active')
        });

        function dangerToast(message) {
            Toastify({
                'text': message,
                style: {
                    background: '#fd2e64',
                }
            }).showToast()
        }

        function successToast(message) {
            Toastify({
                'text': message,
            }).showToast()
        }
    </script>
    <script>
        <?= session('message') ?>
    </script>
    <script>
        @if ($errors->any())
            dangerToast('Gagal!')
        @endif
    </script>
</body>

</html>
