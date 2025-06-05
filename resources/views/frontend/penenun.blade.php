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
                                <h3>Nama Penenun</h3>
                            </div>
                            <div class="profile-name-detail">
                                <div class="d-sm-flex align-items-center d-block">
                                    <h3>{{ $penenun->nama_penenun }}</h3>
                                </div>

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
                                            <h6>{{ $penenun->alamat }}</h6>
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
                                            <h6>{{ $penenun->kontak }}</h6>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="profile-about dashboard-bg-box">
                                    <div class="dashboard-title mb-3">
                                        <h3>Lokasi</h3>
                                        <div class="mb-2">
                                            <?= $penenun->lokasi ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
