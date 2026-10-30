@extends('layouts.app')

@section('title', 'Tambah Data UMKM - KBB GO!')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #F4A300;">Tambah Data UMKM</h2>
                    <p class="text-muted mb-0">Daftarkan usaha mikro, kecil, dan menengah lokal Kabupaten Bandung Barat.</p>
                </div>
                <a href="{{ route('umkm.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama UMKM -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama UMKM / Usaha <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Contoh: Kopi Java Preanger Gununghalu"
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori Usaha / Produk <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('kategori') is-invalid @enderror"
                            id="kategori"
                            name="kategori"
                            list="kategori-list"
                            value="{{ old('kategori') }}"
                            placeholder="Contoh: Kuliner & Camilan, Kerajinan Tangan, Fashion & Batik"
                            required
                        >
                        <datalist id="kategori-list">
                            <option value="Kuliner & Camilan">
                            <option value="Minuman & Kopi">
                            <option value="Fashion & Kerajinan">
                            <option value="Kerajinan Tangan">
                            <option value="Seni & Budaya">
                            <option value="Pertanian & Olahan">
                        </datalist>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat / Lokasi Usaha <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('alamat') is-invalid @enderror"
                            id="alamat"
                            name="alamat"
                            value="{{ old('alamat') }}"
                            placeholder="Contoh: Jl. Raya Lembang No. 45, Kecamatan Lembang, KBB"
                            required
                        >
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Produk & Profil Usaha <span class="text-danger">*</span></label>
                        <textarea
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            placeholder="Jelaskan produk unggulan, keunikan bahan baku lokal, serta cara pemesanan..."
                            required
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Foto / Pilih Foto Bawaan -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="gambar_file" class="form-label fw-semibold">Upload Gambar (Opsional)</label>
                            <input
                                type="file"
                                class="form-control @error('gambar_file') is-invalid @enderror"
                                id="gambar_file"
                                name="gambar_file"
                                accept="image/*"
                            >
                            <small class="text-muted">Format: JPG, PNG, WEBP (Maks: 5MB)</small>
                            @error('gambar_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="gambar" class="form-label fw-semibold">Atau Pilih Gambar Aset Lama</label>
                            <select class="form-select @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                                <option value="kripik.jpg" {{ old('gambar') == 'kripik.jpg' ? 'selected' : '' }}>Keripik Singkong (kripik.jpg)</option>
                                <option value="kopi.png" {{ old('gambar') == 'kopi.png' ? 'selected' : '' }}>Kopi Gununghalu (kopi.png)</option>
                                <option value="batik2.png" {{ old('gambar') == 'batik2.png' ? 'selected' : '' }}>Batik Khas KBB (batik2.png)</option>
                                <option value="anyaman.jpg" {{ old('gambar') == 'anyaman.jpg' ? 'selected' : '' }}>Anyaman Bambu (anyaman.jpg)</option>
                                <option value="wayang.jpg" {{ old('gambar') == 'wayang.jpg' ? 'selected' : '' }}>Wayang Golek (wayang.jpg)</option>
                                <option value="bakpia.jpg" {{ old('gambar') == 'bakpia.jpg' ? 'selected' : '' }}>Bakpia & Kue (bakpia.jpg)</option>
                                <option value="kuliner.jpg" {{ old('gambar') == 'kuliner.jpg' ? 'selected' : '' }}>Kuliner Sunda (kuliner.jpg)</option>
                            </select>
                            <small class="text-muted">Aset bawaan dari proyek React KBBGO</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('umkm.index') }}" class="btn btn-light px-4">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-kbb-warning px-4">
                            <i class="bi bi-save me-1"></i> Simpan Data UMKM
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
