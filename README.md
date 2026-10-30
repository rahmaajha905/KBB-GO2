# KBB GO! - Platform Informasi Pariwisata & UMKM Kabupaten Bandung Barat
## Konversi Proyek React ke Laravel 10 (Blade + XAMPP + MySQL)

Selamat datang di proyek **KBB GO! (KBBGO)** versi Laravel Blade. Proyek ini merupakan hasil konversi dari proyek semester sebelumnya (React JS, CSS, Axios, PHP API) menjadi arsitektur MVC modern dengan Laravel Framework sesuai ketentuan asisten praktikum (asprak).

---

## 📌 Ketentuan Asprak yang Dipenuhi

1. **Framework Laravel**: Menggunakan struktur MVC Laravel standar dengan routing, controller, model, migration, dan seeder.
2. **Tampilan Menggunakan Blade**: Seluruh tampilan menggunakan template engine Blade dengan sintaks bersih, bebas dari JSX.
3. **Layout Utama yang Dapat Digunakan Ulang**: File [`resources/views/layouts/app.blade.php`](file:///Users/gsdget/Documents/kbbgo/resources/views/layouts/app.blade.php) memuat Bootstrap 5 CDN, Bootstrap Icons CDN, flash message, navbar, dan footer.
4. **Komponen Blade**:
   - [`resources/views/components/navbar.blade.php`](file:///Users/gsdget/Documents/kbbgo/resources/views/components/navbar.blade.php) (Identitas KBBGO, Beranda, Destinasi Wisata, UMKM, dan tombol aksi).
   - [`resources/views/components/footer.blade.php`](file:///Users/gsdget/Documents/kbbgo/resources/views/components/footer.blade.php) (Identitas visual KBBGO Bandung Barat, tautan cepat, newsletter).
5. **Dua Migration Wajib**:
   - `destinasi`: Tabel untuk objek wisata dengan field `id`, `nama`, `deskripsi`, `lokasi`, `harga_tiket`, `gambar`, `timestamps`.
   - `umkm`: Tabel untuk produk/usaha UMKM dengan field `id`, `nama`, `kategori`, `deskripsi`, `alamat`, `gambar`, `timestamps`.
6. **Seeder & Faker**:
   - Data realistis Kabupaten Bandung Barat (Curug Malela, Tangkuban Perahu, Orchid Forest, Kopi Gununghalu, Batik Karst Padalarang, dll.).
   - Generator dinamis menggunakan Faker (`id_ID`) untuk memenuhi syarat minimal 5 data per tabel.
7. **CRUD Penuh**:
   - Destinasi Wisata: List (Card & Table), Create, Store, Show, Edit, Update, Delete.
   - UMKM Lokal: List (Card & Table), Create, Store, Show, Edit, Update, Delete.
8. **Keamanan & Validasi**:
   - Form menggunakan `@csrf`.
   - Method spoofing `@method('PUT')` untuk update dan `@method('DELETE')` untuk hapus.
   - Validasi input controller lengkap dengan pesan error berbahasa Indonesia.
9. **Desain Asli Dipertahankan**:
   - Menggunakan warna identitas KBBGO (Teal `#0F9D8A`, Kuning/Oranye `#F4A300`, dan Dark `#212529`).
   - Seluruh aset gambar (foto wisata dan logo KBBGO) dipertahankan dan diletakkan di `public/images/`.

---

## 💻 1. Persyaratan Perangkat Lunak (Mac Intel)

Untuk menjalankan proyek ini pada Mac Intel (x86_64), Anda memerlukan:
- **macOS** 10.15 (Catalina) atau lebih baru.
- **PHP** versi 8.1 atau 8.2 (dilengkapi ekstensi `pdo_mysql`, `mbstring`, `openssl`, `curl`).
- **Composer** versi 2.x (Dependency manager PHP).
- **XAMPP for Mac (Intel x64)** atau MySQL server lokal (port 3306).
- **Web Browser** (Brave, Chrome, Safari, dll.).

---

## 🛠️ 2. Cara Menyiapkan PHP dan Composer pada Mac Intel

Jika lingkungan Mac Anda belum memiliki PHP atau Composer, ikuti langkah berikut:

### Opsi A: Menggunakan Homebrew (Sangat Direkomendasikan)
1. Buka Terminal Mac.
2. Pasang Homebrew jika belum ada:
   ```bash
   /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
   ```
3. Pasang PHP dan Composer:
   ```bash
   brew install php composer
   ```
4. Verifikasi instalasi:
   ```bash
   php -v
   composer -V
   ```

### Opsi B: Menggunakan PHP Bawaan XAMPP
Jika Anda memasang XAMPP di `/Applications/XAMPP`, Anda dapat menambahkan binary PHP XAMPP ke PATH terminal:
```bash
echo 'export PATH="/Applications/XAMPP/xamppfiles/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```
Kemudian pasang Composer secara manual:
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
```

---

## 🐘 3. Memasang & Menggunakan XAMPP untuk Mac Intel

1. Unduh installer XAMPP for Mac (pilih versi PHP 8.1 atau 8.2 versi Intel):
   - Situs resmi: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
2. Buka file `.dmg` dan seret aplikasi ke folder `/Applications/XAMPP`.
3. Buka **XAMPP Control Panel** (atau **manager-osx**), lalu jalankan:
   - **MySQL Database**: Klik **Start** (lampu hijau menandakan aktif di port 3306).
   - **Apache Web Server**: Klik **Start** (opsional jika menggunakan `php artisan serve`).

---

## 🗄️ 4. Membuat Database `kbbgo` melalui phpMyAdmin

1. Pastikan modul MySQL di XAMPP berstatus **Running**.
2. Buka browser dan akses alamat:
   ```
   http://localhost/phpmyadmin
   ```
3. Klik menu **Databases** (atau **Basis Data**).
4. Pada kolom *Create database*, masukkan nama:
   ```sql
   kbbgo
   ```
   Pilih collation `utf8mb4_unicode_ci` atau biarkan default.
5. Klik tombol **Create**.

> Alternatif melalui SQL query tab di phpMyAdmin:
> ```sql
> CREATE DATABASE kbbgo;
> ```

---

## ⚙️ 5. Konfigurasi `.env`

File `.env` telah disiapkan di root proyek dengan konfigurasi standar XAMPP:

```env
APP_NAME="KBB GO!"
APP_ENV=local
APP_KEY=base64:7KqM+q0sL2NqD5O9vF1sZ8wU4eR3tY6aP0oI9uY8tXw=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kbbgo
DB_USERNAME=root
DB_PASSWORD=
```

*Catatan:* Jika MySQL XAMPP Anda menggunakan password root, isi pada `DB_PASSWORD=password_anda`.

---

## 📦 6. Memasang Dependensi Laravel

Buka Terminal pada direktori proyek (`/Users/gsdget/Documents/kbbgo`):

```bash
cd /Users/gsdget/Documents/kbbgo
composer install
```

---

## 🗂️ 7. Menjalankan Migration

Setelah database `kbbgo` dibuat dan `composer install` selesai, jalankan migration untuk membuat tabel `destinasi` dan `umkm`:

```bash
php artisan migrate
```

Untuk memeriksa status migration:
```bash
php artisan migrate:status
```

---

## 🌱 8. Menjalankan Seeder (Faker)

Isi tabel dengan data contoh otentik Bandung Barat menggunakan seeder:

```bash
php artisan db:seed
```

Atau gabungkan migration dan seed sekaligus:
```bash
php artisan migrate:fresh --seed
```

Data yang otomatis terisi meliputi:
- **Destinasi Wisata**: Curug Malela, Tangkuban Perahu, Orchid Forest Cikole, Farmhouse Lembang, Dusun Bambu, Floating Market Lembang, dan data acak ter-generate Faker.
- **UMKM Lokal**: Keripik Singkong & Tempe Lembang, Kopi Java Preanger Gununghalu, Batik Tulis Karst Padalarang, Anyaman Bambu Cisarua, Wayang Golek Parongpong, Bakpia Cihampelas, dan data acak ter-generate Faker.

---

## 🚀 9. Menjalankan Aplikasi Laravel

Jalankan built-in development server Laravel:

```bash
php artisan serve
```

Aplikasi akan berjalan di:
```
http://127.0.0.1:8000
```

---

## 🌐 10. Akses Halaman & Fitur

| Halaman | URL | Keterangan |
| :--- | :--- | :--- |
| **Beranda** | `http://127.0.0.1:8000/` | Hero banner & carousel persis React, statistik, destinasi pilihan, dan produk unggulan. |
| **Daftar Destinasi** | `http://127.0.0.1:8000/destinasi` | Menampilkan grid kartu wisata & tabel kelola data wisata. |
| **Tambah Destinasi** | `http://127.0.0.1:8000/destinasi/create` | Formulir tambah destinasi dengan upload foto atau pilih aset. |
| **Detail Destinasi** | `http://127.0.0.1:8000/destinasi/{id}` | Halaman rincian destinasi wisata. |
| **Edit Destinasi** | `http://127.0.0.1:8000/destinasi/{id}/edit` | Formulir edit data destinasi wisata (`PUT`). |
| **Daftar UMKM** | `http://127.0.0.1:8000/umkm` | Menampilkan katalog produk UMKM, filter kategori, dan tabel data. |
| **Tambah UMKM** | `http://127.0.0.1:8000/umkm/create` | Formulir pendaftaran usaha/produk UMKM baru. |
| **Detail UMKM** | `http://127.0.0.1:8000/umkm/{id}` | Halaman profil dan produk UMKM. |
| **Edit UMKM** | `http://127.0.0.1:8000/umkm/{id}/edit` | Formulir edit data UMKM (`PUT`). |

---

## 🧪 11. Pengujian CRUD

1. **Create (Tambah)**:
   - Buka menu **Tambah Destinasi** atau **Tambah UMKM**.
   - Coba simpan form kosong untuk menguji pesan validasi.
   - Masukkan data valid lalu simpan; periksa munculnya banner notifikasi sukses dan data bertambah di daftar.
2. **Read (Tampil)**:
   - Buka daftar destinasi dan UMKM.
   - Uji fitur pencarian (search) dan filter kategori.
   - Klik **Lihat Detail** untuk memeriksa halaman detail.
3. **Update (Edit)**:
   - Klik tombol **Edit** pada salah satu baris/kartu data.
   - Ubah nama atau harga tiket, lalu klik **Perbarui**.
   - Pastikan data terupdate di database MySQL dan halaman menampilkan nilai baru.
4. **Delete (Hapus)**:
   - Klik tombol **Hapus** pada salah satu data.
   - Konfirmasi popup peringatan.
   - Pastikan data terhapus dari tabel MySQL dan banner konfirmasi muncul.

---

## 📁 Struktur Direktori Laravel Hasil Konversi

```
kbbgo/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       ├── HomeController.php
│   │       ├── DestinasiController.php
│   │       └── UmkmController.php
│   └── Models/
│       ├── Destinasi.php
│       └── Umkm.php
├── config/
│   ├── app.php
│   ├── database.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_destinasi_table.php
│   │   └── 2024_01_01_000002_create_umkm_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── DestinasiSeeder.php
│       └── UmkmSeeder.php
├── public/
│   ├── css/
│   │   └── style.css            # Replikasi CSS React
│   ├── images/                  # Aset gambar asli React
│   ├── uploads/                 # Folder upload gambar dinamis
│   └── index.php
├── resources/
│   └── views/
│       ├── components/
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       ├── destinasi/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── umkm/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── home.blade.php
├── routes/
│   └── web.php
├── .env
├── .env.example
├── composer.json
└── README.md
```

---

## ⚠️ Status Dependensi & Pengujian di Lingkungan Saat Ini

Pada saat pemeriksaan sistem Mac Intel:
- Binary `php`, `composer`, dan aplikasi `XAMPP` belum terpasang di sistem utama (PATH terminal).
- Seluruh kode sumber Laravel, migration, seeder, controller, model, Blade template, CSS, dan gambar telah selesai dibuat secara lengkap dan valid.
- Untuk menguji secara live, silakan pasang XAMPP dan Homebrew (PHP + Composer) sesuai petunjuk di atas, lalu jalankan `composer install` dan `php artisan migrate --seed`.
