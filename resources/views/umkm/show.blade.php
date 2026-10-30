@extends('layouts.app')

@section('title', $umkm->nama . ' - Produk UMKM KBB GO!')

@section('content')
<div class="container mt-5 py-4">

    <!-- Breadcrumb & Back -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}" class="text-decoration-none">UMKM</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $umkm->nama }}</li>
            </ol>
        </nav>
        @auth
<div class="d-flex gap-2">
            <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-warning btn-sm fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Edit UMKM
            </a>
            <form action="{{ route('umkm.destroy', $umkm->id) }}" method="POST" onsubmit="return confirm('Hapus data UMKM ini?');" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
@endauth
    </div>

    <!-- Title & Badge -->
    <div class="mb-4">
        <span class="badge bg-teal text-white mb-2 px-3 py-2 fs-6" style="background-color: #0F9D8A; border-radius: 20px;">
            <i class="bi bi-tag-fill me-1"></i> {{ $umkm->kategori }}
        </span>
        <h1 class="fw-bold mt-1" style="color: #212529;">
            {{ $umkm->nama }}
        </h1>
    </div>

    <!-- Image Banner -->
    <div class="shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
        <img
            src="{{ $umkm->gambar_url }}"
            alt="{{ $umkm->nama }}"
            class="d-block w-100"
            style="height: 450px; object-fit: cover;"
            onerror="this.src='{{ asset('images/batik2.png') }}'"
        >
    </div>

    <!-- Details Content -->
    <div class="row g-4 mt-2">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 16px;">
                <h4 class="fw-bold mb-3" style="color: #1f2937;">Profil & Deskripsi Usaha</h4>
                <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">
                    {{ $umkm->deskripsi }}
                </p>

                <div class="p-3 bg-light rounded-3 mt-4">
                    <p class="mb-0 text-muted small">
                        <i class="bi bi-info-circle-fill text-teal me-1" style="color: #0F9D8A;"></i>
                        Produk asli buatan pelaku usaha mikro, kecil, dan menengah Kabupaten Bandung Barat.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 16px;">
                <h5 class="fw-bold mb-3" style="color: #1f2937;">Informasi Lokasi & Kontak</h5>

                <div class="mb-3">
                    <small class="text-muted d-block mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Alamat</small>
                    <p class="fw-semibold mb-0 text-dark">
                        {{ $umkm->alamat }}
                    </p>
                </div>

                <hr>

                <div class="mb-3">
                    <small class="text-muted d-block mb-1"><i class="bi bi-tag me-1"></i> Kategori Produk</small>
                    <p class="fw-semibold mb-0 text-dark">
                        {{ $umkm->kategori }}
                    </p>
                </div>

                <hr>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1"><i class="bi bi-clock-history me-1"></i> Terdaftar Sejak</small>
                    <p class="small text-muted mb-0">
                        {{ $umkm->created_at ? $umkm->created_at->translatedFormat('d F Y') : '-' }}
                    </p>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
