# Jawaban Modul 7: Controller dan Model pada Laravel

Nama: Chrysels Nicha Aime Laoh  
NIM/Kelas: 707082400010 / D4SM-48-01

## Soal 1 — Latihan Mandiri

Controller dibuat menggunakan:

```powershell
php artisan make:controller MahasiswaController
```

Method `index()` menyiapkan array berisi tiga nama, lalu mengirimkannya ke view `pages.mahasiswa` dengan key `mahasiswa`. Key itu tersedia sebagai variabel `$mahasiswa` di Blade. Direktif `@foreach` menampilkan tiap nama sebagai elemen `<li>` di dalam `<ul>`. Route `/mahasiswa` memanggil method `index()` pada MahasiswaController.

### Controller — app/Http/Controllers/MahasiswaController.php

```php
<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = [
            'Chrysels Nicha Aime Laoh',
            'Andi',
            'Budi',
        ];

        return view('pages.mahasiswa', [
            'mahasiswa' => $mahasiswa,
        ]);
    }
}

```

### View — resources/views/pages/mahasiswa.blade.php

```blade
@extends('layouts.master')

@section('content')
<h1>Daftar Mahasiswa</h1>
<ul>
    @foreach ($mahasiswa as $nama)
        <li>{{ $nama }}</li>
    @endforeach
</ul>
@endsection

```

### Route — tambahan pada routes/web.php

```php
use App\Http\Controllers\MahasiswaController;

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
```

Jalankan `php artisan serve`, kemudian buka `http://127.0.0.1:8000/mahasiswa`. Hasilnya menampilkan Chrysels Nicha Aime Laoh, Andi, dan Budi sebagai daftar. Tambahkan screenshot halaman ini pada jawaban.

## Soal 2 — Pemahaman Perintah Artisan

1. **`php artisan make:controller`**: generator class controller di `app/Http/Controllers`. Perintah lengkap membutuhkan nama controller, misalnya `php artisan make:controller ProductController`. Controller menampung method yang dapat dipanggil oleh route untuk memproses permintaan dan mengembalikan respons/view. [Referensi controller](https://laravel.com/docs/12.x/controllers#basic-controllers).

2. **`php artisan make:model`**: generator class model Eloquent di `app/Models`. Nama model perlu diberikan, contohnya `php artisan make:model Product`. Secara bawaan perintah ini hanya membuat model, belum membuat file migration atau tabel database. [Referensi model](https://laravel.com/docs/12.x/eloquent#generating-model-classes).

3. **`php artisan make:model -m`**: generator model sekaligus file migration. Bentuk lengkapnya, `php artisan make:model Product -m`, menghasilkan `app/Models/Product.php` dan file migration `create_products_table` di `database/migrations`. Opsi `-m` merupakan singkatan `--migration`. Perbedaannya dengan nomor 2 adalah adanya file migration tambahan; tabel belum dibuat sampai migration dijalankan. [Referensi opsi migration pada model](https://laravel.com/docs/12.x/eloquent#generating-model-classes).

4. **`php artisan migrate`**: menjalankan migration yang belum tercatat pernah dijalankan pada database aktif. Migration yang sudah berstatus Ran tidak dijalankan ulang, sehingga mengedit file migration lama lalu memanggil `migrate` tidak otomatis menerapkan perubahan file tersebut. Perintah ini tidak mereset semua tabel; dampak pada data mengikuti isi migration baru yang dijalankan. [Referensi menjalankan migration](https://laravel.com/docs/12.x/migrations#running-migrations).

5. **`php artisan migrate:fresh`**: menghapus seluruh tabel pada koneksi database yang dipakai, lalu menjalankan semua migration kembali. Perbedaannya dengan `migrate` adalah database dibangun ulang dari awal. Semua data di tabel yang dihapus hilang, termasuk data yang tidak dibuat melalui migration proyek ini. Karena itu, periksa `.env` dan gunakan hanya database praktikum yang datanya boleh dihapus. Pada pengerjaan ini digunakan database `belajar_laravel` yang baru dibuat dan diperiksa kosong. [Referensi migrate:fresh](https://laravel.com/docs/12.x/migrations#drop-all-tables-migrate).

Perintah pada soal ditulis sebagai bentuk umum. Dalam praktik, `make:controller` dan `make:model` membutuhkan argumen nama seperti contoh di atas. Menjalankan bantuan `php artisan help make:model` memperlihatkan argumen nama dan opsi `-m` tanpa membuat file baru.

Screenshot yang digunakan: bantuan Artisan, log pembuatan model/controller dan migration, serta `php artisan migrate:status`. Rincian urutannya tersedia pada `PANDUAN_SCREENSHOT.md`.

## Soal 3 — Penerapan Migration

Migration dibuat menggunakan Artisan:

```powershell
php artisan make:migration create_category_product_table
```

File yang dihasilkan pada proyek ini: `database/migrations/2026_10_29_150203_create_category_product_table.php`.

### Kode migration

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('category_name');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};

```

### Penjelasan

- `Schema::create('category_product', ...)` membuat tabel kategori dengan nama yang sama seperti soal.
- `$table->id('id_category')` membuat primary key BIGINT UNSIGNED yang bertambah otomatis.
- `$table->string('category_name')` membuat kolom VARCHAR(255) untuk nama kategori.
- `$table->text('description')` membuat kolom TEXT untuk deskripsi yang lebih panjang.
- `$table->timestamps()` menambahkan `created_at` dan `updated_at`.
- Method `down()` menghapus tabel saat migration ini di-rollback.

Setelah kode diisi, jalankan:

```powershell
php artisan migrate
```

Perintah ini sudah dijalankan dan migration kategori berstatus Ran. Tabel `category_product` memiliki lima kolom sesuai soal. Bukti hasil dapat diambil dari **phpMyAdmin → belajar_laravel → category_product → Structure**, lalu sertakan screenshot kode migration dan log eksekusinya.

Referensi: [Membuat migration](https://laravel.com/docs/12.x/migrations#generating-migrations) dan [Membuat tabel](https://laravel.com/docs/12.x/migrations#creating-tables).

## Hasil pengerjaan contoh B.1–B.6

- SapaController dan halaman `/sapa` menampilkan nama yang dikirim controller ke view.
- ProductController menyediakan `getProduct()` dan `addProduct()`; route `/product` dan `/product/addProduct` telah didaftarkan.
- View produk tetap berisi empat baris manual: Mark, Jacob, Larry the Bird, dan Nitro. Data toko mengikuti kode modul persis.
- Model Product dibuat menggunakan `php artisan make:model Product -m` dan dibiarkan seperti hasil generator, sesuai pengenalan model pada modul.
- Migration awal produk dijalankan terlebih dahulu; sesudah kode struktur produk disalin, `migrate:fresh` dijalankan pada database baru yang kosong, lalu migration kategori ditambahkan menggunakan `migrate`.
- Tabel products berisi `id_product`, `name_product`, `stock_product`, `price_product`, `desc_product`, `id_category`, `created_at`, dan `updated_at`. Kolom `id_category` belum diberi foreign key, sesuai modul.

## Kesesuaian kode dan pengujian

Kode SapaController, ProductController, sapa.blade.php, product.blade.php, addProduct.blade.php, migration produk, serta blok route contoh diperiksa identik terhadap teks asli modul. Route `/sapa` dipertahankan dan route `/mahasiswa` ditambahkan untuk Soal 1. Layout master beserta beranda/about/contact disediakan sebagai prasyarat yang dirujuk dari praktikum sebelumnya. Implementasi mahasiswa dan kategori dibuat mengikuti instruksi soal karena kode jawabannya tidak disediakan di modul.

Tujuh halaman diuji melalui HTTP dan menghasilkan status 200 dengan isi yang benar. Kompilasi Blade berhasil dan dua tes bawaan Laravel lulus. Log hasil tersedia pada folder `praktikum/bukti`.
