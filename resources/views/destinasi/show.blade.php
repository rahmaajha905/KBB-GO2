@extends('layouts.app')

@section('title', $destinasi->nama . ' - KBB GO!')

@section('content')
<div class="container mt-5 py-4">

    <!-- Breadcrumb & Back -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('destinasi.index') }}" class="text-decoration-none">Destinasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $destinasi->nama }}</li>
            </ol>
        </nav>
        @auth
<div class="d-flex gap-2">
            <a href="{{ route('destinasi.edit', $destinasi->id) }}" class="btn btn-warning btn-sm fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Edit Destinasi
            </a>
            <form action="{{ route('destinasi.destroy', $destinasi->id) }}" method="POST" onsubmit="return confirm('Hapus destinasi ini?');" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </form>
        </div>
@endauth
    </div>

    <!-- Title (Replicated from React DetailWisata.jsx) -->
    <h1 class="mb-4 fw-bold" style="color: #0F9D8A;">
        {{ $destinasi->nama }}
    </h1>

    <!-- Image Banner (Replicated from React DetailWisata.jsx) -->
    <div class="shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
        <img
            src="{{ $destinasi->gambar_url }}"
            alt="{{ $destinasi->nama }}"
            class="d-block w-100"
            style="height: 480px; object-fit: cover;"
            onerror="this.src='{{ asset('images/curug.jpg') }}'"
        >
    </div>

    <!-- Details Content (Replicated from React DetailWisata.jsx) -->
    <div class="row g-4 mt-2">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 16px;">
                <h4 class="fw-bold mb-3" style="color: #1f2937;">Deskripsi Wisata</h4>
                <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">
                    {{ $destinasi->deskripsi }}
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 16px;">
                <h5 class="fw-bold mb-3" style="color: #1f2937;">Informasi Tiket & Lokasi</h5>

                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Harga Tiket Masuk</small>
                    <h3 class="fw-bold mb-0" style="color: #0F9D8A;">
                        Rp {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}
                    </h3>
                </div>

                <hr>

                <div class="mb-3">
                    <small class="text-muted d-block mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Lokasi</small>
                    <p class="fw-semibold mb-0 text-dark">
                        {{ $destinasi->lokasi }}
                    </p>
                </div>

                <hr>

                <div class="mb-4">
                    <small class="text-muted d-block mb-1"><i class="bi bi-clock-history me-1"></i> Terakhir Diperbarui</small>
                    <p class="small text-muted mb-0">
                        {{ $destinasi->updated_at ? $destinasi->updated_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                    </p>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('destinasi.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
