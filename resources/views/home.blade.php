@extends('layouts.app')

@section('title', 'KBB GO! - Pesona Wisata & Produk UMKM Bandung Barat')

@section('content')
<!-- Hero Section (Replicated from React Home.jsx) -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <!-- Hero Text Column -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge px-3 py-2 mb-3" style="background-color: #e6fffa; color: #0d9488; font-weight: 600; border-radius: 20px;">
                    <i class="bi bi-compass me-1"></i> Eksplorasi Bandung Barat
                </span>

                <h1 style="color: #0d9488; font-weight: 700; font-size: 3rem; line-height: 1.2;">
                    Kenapa memilih destinasi Bandung Barat?
                </h1>

                <p style="font-size: 1.1rem; color: #6b7280; line-height: 1.8;" class="my-4">
                    Kunjungi dan nikmati keindahan wisata yang ada di Kabupaten Bandung Barat bersama keluarga dengan keindahan alam yang akan membuat liburan anda berkesan.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('destinasi.index') }}" class="btn btn-kbb-primary px-4 py-2 fs-5">
                        <i class="bi bi-geo-alt-fill me-1"></i> Jelajahi Destinasi
                    </a>
                    <a href="{{ route('umkm.index') }}" class="btn btn-kbb-warning px-4 py-2 fs-5">
                        <i class="bi bi-shop me-1"></i> Produk UMKM Lokal
                    </a>
                </div>

                <!-- Stats summary -->
                <div class="row mt-4 pt-3 border-top g-3">
                    <div class="col-4">
                        <h4 class="fw-bold mb-0" style="color: #0F9D8A;">15+</h4>
                        <small class="text-muted">Destinasi Alam</small>
                    </div>
                    <div class="col-4">
                        <h4 class="fw-bold mb-0" style="color: #F4A300;">50+</h4>
                        <small class="text-muted">Pelaku UMKM</small>
                    </div>
                    <div class="col-4">
                        <h4 class="fw-bold mb-0" style="color: #0F9D8A;">100%</h4>
                        <small class="text-muted">Pesona Sunda</small>
                    </div>
                </div>
            </div>

            <!-- Hero Carousel Column -->
            <div class="col-lg-6">
                <div id="heroCarousel" class="carousel slide shadow-lg" data-bs-ride="carousel" data-bs-interval="3500">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
                    </div>

                    <div class="carousel-inner" style="border-radius: 20px; overflow: hidden;">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/farmhouse.jpg') }}" class="d-block w-100" alt="Farmhouse Lembang" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block text-start p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 20px 20px;">
                                <h4 class="text-white fw-bold">Farmhouse Lembang</h4>
                                <p class="text-white-50 mb-0">Pesona arsitektur bergaya Eropa di dataran tinggi Bandung Barat.</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/kkbgo.webp') }}" class="d-block w-100" alt="KBBGO" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block text-start p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 20px 20px;">
                                <h4 class="text-white fw-bold">KBB GO!</h4>
                                <p class="text-white-50 mb-0">Platform pariwisata dan pemberdayaan UMKM lokal.</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/tangkuban.jpg') }}" class="d-block w-100" alt="Tangkuban Perahu" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block text-start p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 20px 20px;">
                                <h4 class="text-white fw-bold">Tangkuban Perahu</h4>
                                <p class="text-white-50 mb-0">Kawah vulkanik legendaris dengan udara pegunungan segar.</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/sumbingg.jpg') }}" class="d-block w-100" alt="Pemandangan Alam" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block text-start p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 20px 20px;">
                                <h4 class="text-white fw-bold">Keindahan Alam Sunda</h4>
                                <p class="text-white-50 mb-0">Menikmati panorama perbukitan hijau dan hawa sejuk alami.</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/orchid.png') }}" class="d-block w-100" alt="Orchid Forest Cikole" style="height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block text-start p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: 0 0 20px 20px;">
                                <h4 class="text-white fw-bold">Orchid Forest Cikole</h4>
                                <p class="text-white-50 mb-0">Hutan pinus asri dengan koleksi anggrek langka terluas.</p>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Featured Destinasi Section -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: #0F9D8A;">Destinasi Pilihan</h2>
                <p class="text-muted mb-0">Jelajahi objek wisata alam terpopuler di Bandung Barat</p>
            </div>
            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                Lihat Semua ({{ \App\Models\Destinasi::count() }}) <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($featuredDestinasi as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="card-img-top" onerror="this.src='{{ asset('images/curug.jpg') }}'">
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">{{ $item->nama }}</h5>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $item->lokasi }}</p>
                            <p class="text-secondary small flex-grow-1" style="min-height: 40px;">
                                {{ Str::limit($item->deskripsi, 90) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                <div>
                                    <small class="text-muted d-block">Tiket Masuk</small>
                                    <h5 class="fw-bold mb-0" style="color: #0F9D8A;">
                                        Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}
                                    </h5>
                                </div>
                                <a href="{{ route('destinasi.show', $item->id) }}" class="btn btn-sm btn-kbb-warning px-3 py-2">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada data destinasi wisata. Jalankan seeder untuk mengisi data.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured UMKM Section -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: #F4A300;">Produk UMKM Unggulan</h2>
                <p class="text-muted mb-0">Dukung karya dan komoditas pelaku usaha lokal Bandung Barat</p>
            </div>
            <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                Lihat Semua ({{ \App\Models\Umkm::count() }}) <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($featuredUmkm as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 20px;">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="card-img-top" onerror="this.src='{{ asset('images/batik2.png') }}'">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-light text-dark align-self-start mb-2 px-2 py-1 border small">
                                {{ $item->kategori }}
                            </span>
                            <h5 class="fw-bold mb-1 fs-6">{{ $item->nama }}</h5>
                            <p class="text-muted small flex-grow-1" style="min-height: 40px;">
                                {{ Str::limit($item->deskripsi, 75) }}
                            </p>
                            <a href="{{ route('umkm.show', $item->id) }}" class="btn btn-sm btn-kbb-outline w-100 mt-2">
                                Detail UMKM
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada data UMKM. Jalankan seeder untuk mengisi data.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
