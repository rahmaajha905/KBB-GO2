<footer style="background: #f8f9fa; margin-top: 80px; padding: 60px 0 30px 0; border-top: 1px solid #e5e7eb;">
    <div class="container">
        <div class="row gy-4">
            <!-- Brand & Info -->
            <div class="col-lg-3 col-md-6">
                <h3 class="fw-bold">
                    <span style="color: #f39c12;">KBBGO</span>{" "}
                    <span style="color: #0f766e;">BANDUNG BARAT</span>
                </h3>
                <p class="mt-3 text-muted" style="line-height: 1.6;">
                    Pusat informasi pariwisata resmi Kabupaten Bandung Barat.
                    Menghubungkan Anda dengan pesona dan keasrian alam Jawa Barat.
                </p>
            </div>

            <!-- Tautan Cepat -->
            <div class="col-lg-3 col-md-6 ps-lg-4">
                <h5 class="fw-bold mb-3" style="color: #1f2937;">TAUTAN CEPAT</h5>
                <ul class="list-unstyled text-muted" style="line-height: 2;">
                    <li><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 small"></i> Beranda</a></li>
                    <li><a href="{{ route('destinasi.index') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 small"></i> Destinasi Wisata</a></li>
                    <li><a href="{{ route('umkm.index') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 small"></i> Produk UMKM Lokal</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3" style="color: #1f2937;">LEGAL</h5>
                <ul class="list-unstyled text-muted" style="line-height: 2;">
                    <li><a href="#" class="text-decoration-none text-muted"><i class="bi bi-shield-check me-1 small"></i> Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-decoration-none text-muted"><i class="bi bi-file-earmark-text me-1 small"></i> Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-decoration-none text-muted"><i class="bi bi-envelope me-1 small"></i> Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold mb-3" style="color: #1f2937;">NEWSLETTER</h5>
                <p class="text-muted" style="line-height: 1.6;">
                    Berlangganan info destinasi dan promo produk UMKM terbaru.
                </p>
                <form onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan newsletter KBBGO!');">
                    <div class="input-group">
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Email Anda"
                            required
                        />
                        <button class="btn btn-success" type="submit" style="background-color: #0F9D8A; border-color: #0F9D8A;">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="mt-5 mb-4" style="border-color: #d1d5db;">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start text-muted small">
                &copy; {{ date('Y') }} <strong>KBB GO!</strong>. All rights reserved. Pariwisata & UMKM Kabupaten Bandung Barat.
            </div>
            <div class="col-md-6 text-center text-md-end text-muted small mt-2 mt-md-0">
                Praktikum Pemrograman Web - Laravel Blade
            </div>
        </div>
    </div>
</footer>
