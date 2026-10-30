@extends('layouts.app')

@section('title', 'Login - KBB GO!')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color: #0F9D8A;">Masuk ke KBB<span style="color: #F4A300;">GO</span></h2>
                <p class="text-muted mb-0">Login untuk mengelola data destinasi wisata dan UMKM.</p>
            </div>

            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <form action="{{ route('login.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="nama@email.com" autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Masukkan password" autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-kbb-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>
                </form>
            </div>

            <p class="text-center text-muted mt-3 mb-0">
                Belum punya akun?
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: #0F9D8A;">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
