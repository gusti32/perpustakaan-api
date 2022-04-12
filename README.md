## API Manajemen Perpustakaan - UTS Pemrograman Web Framework

- Nama: Muhammad Gusti Nurfathin
- Kelas: IF20B
- NIM: 20416255201133

API ini adalah API manajemen perpustakaan sederhana yang dibuat dengan framework Laravel & Sanctum.

Selamat Mencoba!

## Dokumentasi

### Menjalankan Server API

1. Clone repositori ini.
1. Install XAMPP. Pastikan direktori PHP XAMPP sudah ada pada environment variable `PATH`.
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

### API Autentikasi

- `api/register` (POST):

  Mendaftarkan/membuat akun baru.
  
  **Parameter JSON:**
  | Nama | Deskripsi |
  |------|-----------|
  | `name` | Nama panjang pengguna |
  | `email` | E-mail pengguna |
  | `password` | Kata sandi |

  **Response:**
  
  Akan memberikan pesan berhasil jika pengguna berhasil didaftarkan.

  **Contoh:**
  ```json
  {
      "name": "Aldi Faris",
      "email": "aldi@gmail.com",
      "password": "12341234"
  }
  ```

- `api/login` (POST):

  Melakukan login untuk mendapatkan token akses.
  
  **Parameter JSON:**
  | Nama | Deskripsi |
  |------|-----------|
  | `name` | Nama panjang pengguna |
  | `email` | E-mail pengguna |
  | `password` | Kata sandi |

  **Response:**

  Token akses API.

  **Contoh:**
  ```json
  // Request
  {
      "name": "Aldi Faris",
      "email": "aldi@gmail.com",
      "password": "12341234"
  }

  // Response
  {
      "token": "5|6EVQecQ15GlLuYSXB84VuI4dFHK7jJ77a6HQ91bE"
  }
  ```

- `api/logout` (GET):

  Melakukan logout untuk menghapus token akses.

  **Parameter GET:**
  
  *Tidak ada*

  **Response:**
  
  Akan memberikan pesan berhasil jika token akses berhasil dihapus.

  **Catatan:**

  Token akses harus disertakan didalam request.
  
