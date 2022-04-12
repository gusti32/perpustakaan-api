## API Manajemen Perpustakaan - UTS Pemrograman Web Framework

- Nama: Muhammad Gusti Nurfathin
- Kelas: IF20B
- NIM: 20416255201133

API ini adalah API manajemen perpustakaan sederhana yang dibuat dengan framework Laravel & Sanctum.

Selamat Mencoba!

## Dokumentasi

### Menjalankan Server API

1. Clone repositori ini.
1. Install XAMPP versi terbaru. Pastikan direktori PHP XAMPP sudah ada pada environment variable `PATH`.
2. Buka XAMPP. Nyalakan Apache dan MySQL.
3. Buka Phpmyadmin dan buat database baru yang bernama `perpus`.
4. Buka Command Prompt (CMD) pada direktori project dan jalankan `setup.bat`.
5. Jalankan perintah `php artisan serve` untuk mengaktifkan development server.

### Cara Kerja API

Berikut adalah cara kerja API ini:
- Pengguna API harus melakukan registrasi dan login untuk mengakses dan menggunakan API.
- Ketika pengguna me-request login, API akan memberikan response berupa token akses.
- Pengguna harus menggunakan token akses ini untuk mengakses API `api/category/*` dan `api/book/*` dengan menyertakan token tersebut didalam request.
- `api/category/*` digunakan untuk mengelola kategori-kategori buku. 
- `api/book/*` digunakan untuk mengelola buku. 
- Jika pengguna sudah selesai menggunakan API, pengguna dapat me-request logout untuk menghapus token akses.
- Jika token akses terhapus, maka token akses tersebut tidak dapat digunakan kembali untuk mengakses API.

## Penggunaan API

Tata cara penggunaan API dapat dilihat [disini](docs/APIDocs.md)
