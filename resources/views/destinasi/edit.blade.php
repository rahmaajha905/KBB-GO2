@extends('layouts.app')

@section('title', 'Edit Destinasi - ' . $destinasi->nama)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #0F9D8A;">Edit Destinasi Wisata</h2>
                    <p class="text-muted mb-0">Perbarui data destinasi <strong>{{ $destinasi->nama }}</strong></p>
                </div>
                <a href="{{ route('destinasi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-sm border-0 p-4" style="border-radius: 16px;">
                <form action="{{ route('destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Wisata -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Destinasi Wisata <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', $destinasi->nama) }}"
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('lokasi') is-invalid @enderror"
                            id="lokasi"
                            name="lokasi"
                            value="{{ old('lokasi', $destinasi->lokasi) }}"
                            required
                        >
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga Tiket -->
                    <div class="mb-3">
                        <label for="harga_tiket" class="form-label fw-semibold">Harga Tiket Masuk (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Rp</span>
                            <input
                                type="number"
                                class="form-control @error('harga_tiket') is-invalid @enderror"
                                id="harga_tiket"
                                name="harga_tiket"
                                value="{{ old('harga_tiket', (int)$destinasi->harga_tiket) }}"
                                min="0"
                                step="1000"
                                required
                            >
                        </div>
                        @error('harga_tiket')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Wisata <span class="text-danger">*</span></label>
                        <textarea
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            required
                        >{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview Gambar Saat Ini -->
                    <div class="mb-3 p-3 bg-light rounded-3 d-flex align-items-center gap-3">
                        <img src="{{ $destinasi->gambar_url }}" alt="{{ $destinasi->nama }}" style="width: 100px; height: 70px; object-fit: cover; border-radius: 8px;">
                        <div>
                            <span class="fw-semibold d-block small">Gambar Saat Ini:</span>
                            <code class="text-secondary small">{{ $destinasi->gambar }}</code>
                        </div>
                    </div>

                    <!-- Ubah Gambar -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="gambar_file" class="form-label fw-semibold">Ganti Gambar (Upload Baru)</label>
                            <input
                                type="file"
                                class="form-control @error('gambar_file') is-invalid @enderror"
                                id="gambar_file"
                                name="gambar_file"
                                accept="image/*"
                            >
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti</small>
                            @error('gambar_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="gambar" class="form-label fw-semibold">Atau Pilih Dari Gambar Aset</label>
                            <select class="form-select @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                                <option value="" {{ empty(old('gambar')) ? 'selected' : '' }}>-- Tetap gunakan gambar saat ini --</option>
                                <option value="curug.jpg" {{ old('gambar') == 'curug.jpg' ? 'selected' : '' }}>Curug Malela (curug.jpg)</option>
                                <option value="tangkuban.jpg" {{ old('gambar') == 'tangkuban.jpg' ? 'selected' : '' }}>Tangkuban Perahu (tangkuban.jpg)</option>
                                <option value="orchid.png" {{ old('gambar') == 'orchid.png' ? 'selected' : '' }}>Orchid Forest (orchid.png)</option>
                                <option value="farmhouse.jpg" {{ old('gambar') == 'farmhouse.jpg' ? 'selected' : '' }}>Farmhouse Lembang (farmhouse.jpg)</option>
                                <option value="dusunbambu.jpg" {{ old('gambar') == 'dusunbambu.jpg' ? 'selected' : '' }}>Dusun Bambu (dusunbambu.jpg)</option>
                                <option value="floating.png" {{ old('gambar') == 'floating.png' ? 'selected' : '' }}>Floating Market (floating.png)</option>
                                <option value="ciremai.jpg" {{ old('gambar') == 'ciremai.jpg' ? 'selected' : '' }}>Gunung Ciremai (ciremai.jpg)</option>
                                <option value="sumbingg.jpg" {{ old('gambar') == 'sumbingg.jpg' ? 'selected' : '' }}>Pemandangan Alam (sumbingg.jpg)</option>
                            </select>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="{{ route('destinasi.index') }}" class="btn btn-light px-4">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-warning px-4 fw-semibold">
                            <i class="bi bi-check2-circle me-1"></i> Perbarui Destinasi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
