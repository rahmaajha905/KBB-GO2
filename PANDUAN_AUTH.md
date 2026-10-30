# Panduan Authentication KBB GO! (Manual)

## A. Membuat database dari nol (XAMPP + phpMyAdmin)
1. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel.
2. Buka http://localhost/phpmyadmin → tab **Databases** → isi nama `kbbgo`, collation `utf8mb4_unicode_ci` → **Create**.
   (Database dibiarkan kosong, tabel dibuat oleh migration.)
3. Pastikan `.env` berisi:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kbbgo
   DB_USERNAME=root
   DB_PASSWORD=
4. Di terminal, di folder project:
   composer install            (atau: php composer.phar install)
   php artisan migrate:fresh --seed
   php artisan serve
5. Buka http://localhost:8000

`migrate:fresh --seed` membuat tabel users, destinasi, umkm, dst., lalu mengisi data lewat
UserSeeder, DestinasiSeeder, UmkmSeeder (sudah didaftarkan di DatabaseSeeder.php).

## B. Akun dummy (password semua: password123)
- admin@kbbgo.test  (akun tetap)
- 5 akun lain dibuat Faker; lihat emailnya di phpMyAdmin → kbbgo → users.

## C. Bukti hash password di phpMyAdmin
phpMyAdmin → database kbbgo → tabel users → tab **Browse**.
Kolom `password` berisi string diawali `$2y$10$...` (bcrypt), bukan teks asli. Screenshot untuk laporan.

## D. Halaman
Publik: / , /destinasi, /destinasi/{id}, /umkm, /umkm/{id}, /login, /register
Wajib login (middleware auth): create, store, edit, update, destroy untuk destinasi dan umkm; /logout

## E. Alasan memilih autentikasi manual (untuk laporan)
1. Project sudah memakai layout Blade + Bootstrap 5 CDN sendiri; Breeze membawa stack Tailwind/Vite
   (butuh Node.js & npm) sehingga tampilan akan bentrok dan perlu disesuaikan ulang.
2. Breeze menambahkan banyak file otomatis (reset password, verifikasi email, profil, dll.) yang tidak
   diminta soal; manual hanya membuat yang dibutuhkan: register, login, logout.
3. Lebih mudah dipahami dan dijelaskan: alur Auth::attempt, Hash::make, session regenerate/invalidate,
   middleware auth/guest terlihat jelas di kode.
4. Tidak perlu `composer require` paket tambahan, sehingga lebih ringan dan minim risiko galat instalasi.

## F. Cara menguji
1. Buka /destinasi/create saat belum login → otomatis diarahkan ke /login.
2. Register dengan email yang sudah ada / password < 8 / konfirmasi beda → muncul pesan galat.
3. Login dengan password salah → "Email atau password salah."
4. Login admin@kbbgo.test / password123 → tombol Tambah/Edit/Hapus muncul; klik Logout dari menu nama.
