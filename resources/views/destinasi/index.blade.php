@extends('layouts.app')

@section('title', 'Destinasi Wisata Terpopuler - KBB GO!')

@section('content')
<div class="container py-5" style="min-height: 100vh;">

    <!-- Header Section (Replicated from React Wisata.jsx) -->
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="color: #0F9D8A; font-size: 3rem;">
            Destinasi Wisata Terpopuler
        </h1>
        <p class="text-muted fs-5">
            Jelajahi keindahan alam tersembunyi di Bandung Barat
        </p>

        <!-- Search & Action Bar -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 col-lg-6">
                <form action="{{ route('destinasi.index') }}" method="GET" class="d-flex gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari destinasi, lokasi, atau deskripsi..."
                    >
                    <button type="submit" class="btn btn-kbb-primary px-3">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('destinasi.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
            <div>
                <span class="text-muted small">Menampilkan <strong>{{ $destinasi->total() }}</strong> destinasi wisata</span>
            </div>
            <div class="d-flex gap-2">
                @auth
<a href="{{ route('destinasi.create') }}" class="btn btn-kbb-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Destinasi
                </a>
@endauth
            </div>
        </div>
    </div>

    <!-- Cards Grid (Replicated from React Wisata.jsx) -->
    <div class="row justify-content-center g-4">
        @forelse($destinasi as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden; max-width: 340px; margin: auto;">
                    <img
                        src="{{ $item->gambar_url }}"
                        alt="{{ $item->nama }}"
                        class="card-img-top"
                        style="height: 190px; object-fit: cover;"
                        onerror="this.src='{{ asset('images/curug.jpg') }}'"
                    >
                    <div class="card-body d-flex flex-column" style="padding: 20px;">
                        <h5 class="fw-bold mb-2" style="font-size: 20px;">
                            {{ $item->nama }}
                        </h5>

                        <p class="text-muted mb-2 small">
                            📍 {{ $item->lokasi }}
                        </p>

                        <p class="text-secondary small flex-grow-1" style="font-size: 14px; min-height: 45px;">
                            {{ Str::limit($item->deskripsi, 110) }}
                        </p>

                        <h5 class="my-3" style="color: #0F9D8A; font-weight: 700;">
                            Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}
                        </h5>

                        <!-- Button Actions: Detail, Edit, Hapus -->
                        <div class="d-grid gap-2">
                            <a
                                href="{{ route('destinasi.show', $item->id) }}"
                                class="btn text-white fw-semibold"
                                style="background: #F4A300; border-radius: 10px;"
                            >
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>

                            @auth
<div class="d-flex gap-2">
                                <a
                                    href="{{ route('destinasi.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm w-50 fw-semibold text-dark"
                                    style="border-radius: 8px;"
                                >
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>

                                <form
                                    action="{{ route('destinasi.destroy', $item->id) }}"
                                    method="POST"
                                    class="w-50"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi {{ addslashes($item->nama) }}?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm w-100 fw-semibold"
                                        style="border-radius: 8px;"
                                    >
                                        <i class="bi bi-trash me-1"></i> Hapus
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
                <i class="bi bi-geo-alt text-muted fs-1 d-block mb-3"></i>
                <h4 class="text-muted">Tidak ada destinasi yang ditemukan</h4>
                <p class="text-muted mb-4">Tambahkan data destinasi baru atau jalankan seeder database.</p>
                @auth
<a href="{{ route('destinasi.create') }}" class="btn btn-kbb-primary">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Destinasi Pertama
                </a>
@endauth
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $destinasi->links('pagination::bootstrap-5') }}
    </div>

    <!-- Data Table View (Replicated from React AdminWisata.jsx) -->
    <div class="mt-5 pt-4 border-top">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-table me-2 text-teal"></i> Tabel Kelola Destinasi
            </h4>
            <span class="badge bg-secondary">Total: {{ $destinasi->total() }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th width="60" class="text-center">ID</th>
                        <th width="100">Foto</th>
                        <th>Nama Destinasi</th>
                        <th>Lokasi</th>
                        <th>Harga Tiket</th>
                        <th width="200" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinasi as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->id }}</td>
                            <td>
                                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px;" onerror="this.src='{{ asset('images/curug.jpg') }}'">
                            </td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td class="text-muted small">{{ $item->lokasi }}</td>
                            <td class="fw-bold" style="color: #0F9D8A;">Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('destinasi.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @auth
<a href="{{ route('destinasi.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('destinasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus destinasi ini?');">
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
                            <td colspan="6" class="text-center text-muted py-3">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
