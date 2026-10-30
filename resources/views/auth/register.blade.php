@extends('layouts.app')

@section('title', 'Register - KBB GO!')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1" style="color: #0F9D8A;">Daftar Akun KBB<span style="color: #F4A300;">GO</span></h2>
                <p class="text-muted mb-0">Buat akun untuk menambah dan mengelola data wisata & UMKM.</p>
            </div>

            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <form action="{{ route('register.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}"
                               placeholder="Contoh: Budi Santoso" autocomplete="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               placeholder="nama@email.com" autocomplete="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Minimal 8 karakter" autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password"
                               class="form-control"
                               id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-kbb-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-person-plus me-1"></i> Daftar
                    </button>
                </form>
            </div>

            <p class="text-center text-muted mt-3 mb-0">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: #0F9D8A;">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
