# Panduan menjalankan dan screenshot Modul 7

Proyek: `D:\UNI Arc 3\PWI 2\modul7-controller`

Laravel 12.70.2 dibuat melalui Composer. Database MySQL/MariaDB: `belajar_laravel`, host `127.0.0.1`, port `3306`, user `root`, password kosong, sesuai gambar konfigurasi modul.

## 1. Menjalankan proyek

1. Buka XAMPP Control Panel. Pastikan **MySQL** berjalan. Aktifkan **Apache** jika akan membuka phpMyAdmin. Kalau keduanya sudah aktif, tidak perlu menyalakan ulang.
2. Buka PowerShell atau terminal VS Code, lalu jalankan:

```powershell
cd "D:\UNI Arc 3\PWI 2\modul7-controller"
php artisan serve
```

3. Biarkan terminal itu tetap terbuka. Gunakan terminal kedua untuk perintah lain. Jika port 8000 sudah dipakai server proyek ini, langsung buka URL di bawah; jangan menjalankan server kedua. Jika port dipakai aplikasi lain, gunakan `php artisan serve --port=8001` dan ganti `8000` pada URL menjadi `8001`.

Proyek sudah terpasang lengkap. Tidak perlu menjalankan ulang Composer, `make:controller`, `make:model`, atau `make:migration`. Tampilan memakai Bootstrap CDN sehingga perlu internet untuk memuat gaya Bootstrap. Tidak perlu `npm run dev` untuk halaman modul ini.

## 2. Screenshot halaman di browser

Buka URL di Chrome/Edge dalam jendela lebar agar seluruh tabel terlihat. Sertakan address bar saat mengambil screenshot supaya URL terlihat.

| Bagian modul | Buka / lakukan | Yang perlu tampak |
| --- | --- | --- |
| B.1 | `http://127.0.0.1:8000/sapa` | Tulisan **Halo, Sendy Prayogo!** |
| B.3–B.4 | `http://127.0.0.1:8000/product` | Judul Daftar produk kami, informasi toko, empat produk, tombol Tambah Data, Edit, dan Delete |
| B.4 | Klik **Tambah Data** | URL `/product/addProduct`, tulisan Selamat datang!! dan Silahkan tambah data disini |
| Soal 1 | `http://127.0.0.1:8000/mahasiswa` | Judul Daftar Mahasiswa dan tiga nama dalam daftar |
| Pendukung | `http://127.0.0.1:8000/` | Beranda |

Teks **Tulis Nama Kamu** dan nama **Sendy Prayogo** sengaja sama dengan kode contoh modul. Tombol Edit/Delete hanya tampilan. Halaman tambah produk memang hanya berisi teks; modul belum meminta form atau penyimpanan data.

## 3. Screenshot kode di VS Code

Buka folder proyek lewat **File → Open Folder**, kemudian tampilkan file berikut sesuai bagian jawaban. Maksimalkan editor dan pastikan teks terbaca.

| Bagian | File yang ditampilkan |
| --- | --- |
| B.1 | `app/Http/Controllers/SapaController.php`, `resources/views/pages/sapa.blade.php`, route `/sapa` di `routes/web.php` |
| B.2–B.3 | `app/Http/Controllers/ProductController.php` |
| B.3 | `resources/views/pages/product.blade.php`, `resources/views/pages/addProduct.blade.php`, `routes/web.php` |
| B.5 | `app/Models/Product.php` dan file `*_create_products_table.php` di `database/migrations` |
| B.6 | Bagian `DB_...` di `.env` dan kode migration produk |
| Soal 1 | `MahasiswaController.php`, `pages/mahasiswa.blade.php`, import dan route `/mahasiswa` |
| Soal 3 | File `*_create_category_product_table.php` di `database/migrations` |

Nama migration pada proyek ini:

```text
2026_10_29_150050_create_products_table.php
2026_10_29_150203_create_category_product_table.php
```

## 4. Screenshot terminal: yang aman dijalankan sekarang

Jalankan di terminal kedua dari folder proyek:

```powershell
php artisan --version
php artisan route:list --except-vendor
php artisan migrate:status
php artisan migrate
```

- `--version`: bukti menggunakan Laravel 12.
- `route:list`: bukti URL terhubung dengan method controller.
- `migrate:status`: migration produk dan kategori harus bertanda **Ran**.
- `migrate`: sekarang akan menampilkan **Nothing to migrate**, karena semua migration sudah dijalankan. Ini normal.

Untuk screenshot pemahaman Soal 2, tampilkan bantuan perintah berikut tanpa membuat atau menghapus file/tabel:

```powershell
php artisan help make:controller
php artisan help make:model
php artisan help migrate
php artisan help migrate:fresh
```

Pada bantuan `make:model`, tunjukkan opsi `-m, --migration`. Penjelasan tiap perintah tersedia di `JAWABAN_MODUL.md`.

## 5. Bukti perintah pembuatan dan migration yang sudah dilakukan

Log asli pelaksanaan disimpan di folder proyek `praktikum/bukti`. Untuk menampilkan log tersebut di terminal dan mengambil screenshot:

```powershell
Get-Content .\praktikum\bukti\01-pembuatan-dan-migrasi-awal.txt
Get-Content .\praktikum\bukti\02-migrasi-produk-dan-kategori.txt
```

Log pertama mencatat pembuatan SapaController, ProductController, MahasiswaController, Product beserta migration, dan migration produk awal dengan kolom `id`, `created_at`, `updated_at`.

Log kedua mencatat `migrate:fresh` setelah struktur produk diisi, pembuatan migration kategori, `migrate`, daftar route, status migration, dan hasil pemeriksaan struktur kedua tabel. Ini adalah **log yang dibaca ulang**, bukan perintah pembuatan yang dijalankan ulang.

Jangan menjalankan ulang `make:... --force` untuk mendapatkan screenshot: opsi tersebut dapat menimpa kode yang sudah selesai. Jangan membuat migration duplikat.

**`php artisan migrate:fresh` menghapus seluruh tabel dan data pada database aktif.** Langkah itu sudah dilakukan pada database baru yang kosong selama pengerjaan modul. Tidak perlu mengulangnya untuk menjalankan website atau memotret hasil akhir. Jika sengaja ingin mengulang di kemudian hari, periksa `.env` dan pastikan `belajar_laravel` hanya berisi data praktikum yang boleh dihapus.

## 6. Screenshot database melalui phpMyAdmin

1. Pastikan Apache dan MySQL XAMPP aktif.
2. Buka `http://localhost/phpmyadmin/`.
3. Pilih database **belajar_laravel**. Screenshot daftar tabel sebagai bukti database dan tabel sudah terbentuk.
4. Pilih tabel **products → Structure / Struktur**. Screenshot delapan kolom: `id_product`, `name_product`, `stock_product`, `price_product`, `desc_product`, `id_category`, `created_at`, `updated_at`.
5. Pilih tabel **category_product → Structure / Struktur**. Screenshot lima kolom: `id_category`, `category_name`, `description`, `created_at`, `updated_at`.

Tabel kosong pada tab Browse adalah wajar. Daftar produk pada browser masih ditulis di Blade, sesuai modul; belum mengambil data dari database. Kolom `id_category` pada products belum diberi foreign key.

Alternatif bukti struktur lewat terminal:

```powershell
& "C:\xampp\mysql\bin\mysql.exe" -h 127.0.0.1 -u root -e "DESCRIBE belajar_laravel.products; DESCRIBE belajar_laravel.category_product;"
```

## 7. Urutan memasukkan bukti ke jawaban

- **Soal 1:** kode controller, view, route dari `JAWABAN_MODUL.md`, lalu screenshot `/mahasiswa`.
- **Soal 2:** penjelasan lima perintah dari `JAWABAN_MODUL.md`, screenshot bantuan Artisan dan log pelaksanaan migration.
- **Soal 3:** perintah `make:migration`, kode kategori dan penjelasannya dari `JAWABAN_MODUL.md`, screenshot log migration kategori, lalu struktur `category_product` di phpMyAdmin.

Kode contoh modul telah dicocokkan secara otomatis terhadap teks asli DOCX. Bukti perbandingan ada di `praktikum/bukti/03-verifikasi-kode.txt`. Layout `layouts.master` dan halaman pendukung dibuat untuk memenuhi prasyarat praktikum sebelumnya; kode latihan mandiri ditulis mengikuti ketentuan soal karena modul tidak memberikan implementasi lengkapnya.

Referensi penjelasan Artisan: [Controller Laravel 12](https://laravel.com/docs/12.x/controllers), [Model Laravel 12](https://laravel.com/docs/12.x/eloquent#generating-model-classes), dan [Migration Laravel 12](https://laravel.com/docs/12.x/migrations).
