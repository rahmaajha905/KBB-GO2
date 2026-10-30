@extends('layouts.app')

@section('title', 'Katalog Produk Lokal UMKM - KBB GO!')

@section('content')
<div class="container py-5" style="min-height: 100vh;">

    <!-- Header Section (Replicated from React Umkm.jsx) -->
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="color: #0F9D8A; font-size: 3rem;">
            Katalog Produk Lokal
        </h1>
        <p class="text-muted fs-5">
            Jelajahi produk unggulan dari pelaku usaha mikro, kecil, dan menengah di wilayah Bandung Barat.
        </p>

        <!-- Search & Filter Bar -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 col-lg-8">
                <form action="{{ route('umkm.index') }}" method="GET" class="row g-2">
                    <div class="col-md-6">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari nama UMKM, produk, atau alamat..."
                        >
                    </div>
                    <div class="col-md-4">
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList as $cat)
                                <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-1">
                        <button type="submit" class="btn btn-kbb-primary w-100">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search') || request('kategori'))
                            <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
            <div>
                <span class="text-muted small">Menampilkan <strong>{{ $umkm->total() }}</strong> UMKM terdaftar</span>
            </div>
            <div class="d-flex gap-2">
                @auth
<a href="{{ route('umkm.create') }}" class="btn btn-kbb-warning">
                    <i class="bi bi-plus-circle me-1"></i> Tambah UMKM
                </a>
@endauth
            </div>
        </div>
    </div>

    <!-- Cards Grid (Replicated from React Umkm.jsx) -->
    <div class="row justify-content-center g-4">
        @forelse($umkm as $item)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                    <img
                        src="{{ $item->gambar_url }}"
                        alt="{{ $item->nama }}"
                        class="card-img-top"
                        style="height: 180px; object-fit: cover;"
                        onerror="this.src='{{ asset('images/batik2.png') }}'"
                    >
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-light text-dark align-self-start mb-2 px-2 py-1 border small">
                            {{ $item->kategori }}
                        </span>

                        <h5 class="fw-bold mb-1" style="font-size: 1.1rem;">
                            {{ $item->nama }}
                        </h5>

                        <p class="text-muted small mb-2">
                            📍 {{ Str::limit($item->alamat, 45) }}
                        </p>

                        <p class="text-secondary small flex-grow-1" style="font-size: 13px; color: #777; min-height: 40px;">
                            {{ Str::limit($item->deskripsi, 80) }}
                        </p>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 mt-3">
                            <a
                                href="{{ route('umkm.show', $item->id) }}"
                                class="btn btn-kbb-outline btn-sm"
                            >
                                Lihat Detail
                            </a>

                            @auth
<div class="d-flex gap-1">
                                <a
                                    href="{{ route('umkm.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm w-50 fw-semibold text-dark"
                                    style="border-radius: 8px;"
                                >
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form
                                    action="{{ route('umkm.destroy', $item->id) }}"
                                    method="POST"
                                    class="w-50"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM {{ addslashes($item->nama) }}?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm w-100 fw-semibold"
                                        style="border-radius: 8px;"
                                    >
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
@endauth
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-shop text-muted fs-1 d-block mb-3"></i>
                <h4 class="text-muted">Tidak ada data UMKM yang ditemukan</h4>
                <p class="text-muted mb-4">Tambahkan data UMKM baru atau jalankan seeder database.</p>
                @auth
<a href="{{ route('umkm.create') }}" class="btn btn-kbb-warning">
                    <i class="bi bi-plus-circle me-1"></i> Tambah UMKM Baru
                </a>
@endauth
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $umkm->links('pagination::bootstrap-5') }}
    </div>

    <!-- Banner (Replicated from React Umkm.jsx) -->
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div
                class="shadow-sm text-center text-md-start"
                style="background: linear-gradient(rgba(15,157,138,.85), rgba(15,157,138,.85)), url('{{ asset('images/kkbgo.webp') }}'); background-size: cover; background-position: center; border-radius: 20px; padding: 50px; color: white;"
            >
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-2">Dukung UMKM Lokal Bandung Barat</h3>
                        <p class="mb-0 fs-5" style="opacity: 0.95;">
                            Setiap pembelian produk UMKM membantu pertumbuhan ekonomi masyarakat dan melestarikan kearifan lokal Bandung Barat.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        @auth
<a href="{{ route('umkm.create') }}" class="btn btn-kbb-warning px-4 py-2 fs-6">
                            <i class="bi bi-plus-circle me-1"></i> Daftarkan Usaha Anda
                        </a>
@endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table View (Replicated from React AdminUmkm.jsx) -->
    <div class="mt-5 pt-4 border-top">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-table me-2 text-warning"></i> Tabel Kelola Data UMKM
            </h4>
            <span class="badge bg-secondary">Total: {{ $umkm->total() }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th width="60" class="text-center">ID</th>
                        <th width="90">Foto</th>
                        <th>Nama UMKM</th>
                        <th>Kategori</th>
                        <th>Alamat</th>
                        <th width="190" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umkm as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->id }}</td>
                            <td>
                                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;" onerror="this.src='{{ asset('images/batik2.png') }}'">
                            </td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $item->kategori }}</span></td>
                            <td class="text-muted small">{{ $item->alamat }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('umkm.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @auth
<a href="{{ route('umkm.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('umkm.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus UMKM ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
@endauth
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Tidak ada data UMKM.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
