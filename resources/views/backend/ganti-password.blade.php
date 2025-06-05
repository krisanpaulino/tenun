@extends('template.admin')
@section('content')
    <div class="row">
        <div class="col-xl-6 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Ganti Password</h5>
                    <form class="row g-3" method="POST" action="{{ route('profil.password') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="input5" class="form-label">Password Sekarang</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" id="input5"
                                placeholder="Password Sekarang">
                            <div class="invalid-feedback">
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input5" class="form-label">Password Baru</label>
                            <input type="password" name="user_password"
                                class="form-control @error('user_password') is-invalid @enderror" id="input5"
                                placeholder="Password Baru">
                            <div class="invalid-feedback">
                                @error('user_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input5" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" id="input5"
                                placeholder="Password Baru">
                            <div class="invalid-feedback">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Ganti Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
