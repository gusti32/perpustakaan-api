## Dokumentasi API

### Daftar Isi

- [Dokumentasi API](#dokumentasi-api)
  - [Daftar Isi](#daftar-isi)
  - [Pendahuluan](#pendahuluan)
  - [API Autentikasi](#api-autentikasi)
  - [API Kategori](#api-kategori)
  - [API Buku](#api-buku)

### Pendahuluan

Ketika melakukan request API yang membutuhkan token autentikasi (ditandai dengan AUTH), pengguna harus menyertakan token autentikasi di dalam header HTTP, sebagai contoh:

`Authorization: Bearer 5|6EVQecQ15GlLuYSXB84VuI4dFHK7jJ77a6HQ91bE`

Untuk me-request API POST, pengguna harus menggunakan data JSON dan mengatur field HTTP header `Content-Type` ke `application/json`.

### API Autentikasi

- `api/register` (POST):

  Mendaftarkan/membuat akun baru.
  
  **Parameter JSON:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `name` | Nama panjang pengguna | Tidak |
  | `email` | E-mail pengguna | Tidak |
  | `password` | Kata sandi | Tidak |

  **Response:**
  
  Akan memberikan pesan berhasil jika pengguna berhasil didaftarkan.

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
      "msg": "Berhasil! Silahkan login untuk mendapatkan token API."
  }
  ```

- `api/login` (POST):

  Melakukan login untuk mendapatkan token akses.
  
  **Parameter JSON:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `name` | Nama panjang pengguna | Tidak
  | `email` | E-mail pengguna | Tidak
  | `password` | Kata sandi | Tidak

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

- `api/logout` (GET/AUTH):

  Melakukan logout untuk menghapus token akses.

  **Parameter GET:**
  
  *Tidak ada*

  **Response:**
  
  Akan memberikan pesan berhasil jika token akses berhasil dihapus.

  **Catatan:**

  Token akses harus disertakan di dalam request.

### API Kategori

- `api/category/list` (GET/AUTH):
  
  Menampilkan daftar kategori buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | Menampilkan kategori dengan ID kategori. | Ya |
  | `keyword` | Cari kategori berdasarkan keyword pencarian. | Ya |

  **Response:**
  
  Akan memberikan daftar kategori buku jika berhasil.

  **Contoh:**
  ```
  api/category/list <- Menampilkan semua kategori yang ada pada database.
  api/category/list?id=2 <- Menampilkan kategori dengan ID.
  api/category/list?keyword=Agama <- Mencari dan menampilkan kategori yang cocok dengan keyword "Agama".
  ```

  ```json
  // Response dari: api/category/list
  {
      "msg": "Berhasil",
      "list": [
          {
              "id": 1,
              "name": "Agama",
              "created_at": 1649733611,
              "updated_at": 1649733611
          },
          {
              "id": 2,
              "name": "Bahasa",
              "created_at": 1649733611,
              "updated_at": 1649733611
          },
          {
              "id": 3,
              "name": "Biografi",
              "created_at": 1649733611,
              "updated_at": 1649733611
          },
          ......
      ]
  }

  // Response dari: api/category/list?id=2
  {
      "msg": "Berhasil",
      "list": [
          {
              "id": 2,
              "name": "Bahasa",
              "created_at": 1649733611,
              "updated_at": 1649733611
          }
      ]
  }

  // Response dari: api/category/list?keyword=Agama
  {
      "msg": "Berhasil",
      "list": [
          {
              "id": 1,
              "name": "Agama",
              "created_at": 1649733611,
              "updated_at": 1649733611
          }
      ]
  }
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/category/add` (POST/AUTH):

  Menambahkan kategori baru.

  **Parameter JSON:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `name` | Nama kategori (harus unik) | Tidak |

  **Response:**

  Akan memberikan pesan berhasil dan menampilkan data yang ditambahkan.

  **Contoh:**
  ```json
  // Request
  {
      "name": "Matematika"
  }

  // Response
  {
      "msg": "Kategori berhasil ditambahkan.",
      "added": {
          "name": "Matematika",
          "updated_at": 1649770464,
          "created_at": 1649770464,
          "id": 11
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/category/edit` (POST/AUTH):

  Mengubah nama kategori.

  **Parameter JSON:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili kategori yang akan diedit. | Tidak |
  | `name` | Nama kategori (harus unik) | Ya |

  **Response:**

  Akan memberikan pesan berhasil dan menampilkan hasil kategori yang diedit.

  **Contoh:**

  Data kategori sebelum diedit:

  ```json
  {
      "name": "Matematika",
      "updated_at": 1649770464,
      "created_at": 1649770464,
      "id": 11
  } 
  ```

  Melakukan pengeditan kategori:

  ```json
  // Request
  {
      "id": 11,
      "name": "Sastra"
  }

  // Response
  {
      "msg": "Kategori berhasil diubah.",
      "updated": {
          "id": 11,
          "name": "Sastra",
          "created_at": 1649770464,
          "updated_at": 1649771063
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/category/del` (GET/AUTH):
  
  Menghapus kategori buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili kategori yang akan dihapus. | Ya |

  **Response:**

  Akan memberikan pesan berhasil jika kategori berhasil dihapus.

### API Buku

- `api/book/list` (GET/AUTH):
  
  Menampilkan daftar buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `title` | Menyaring daftar buku berdasarkan judul. | Ya |
  | `writer` | Menyaring daftar buku berdasarkan penulis. | Ya |
  | `publisher` | Menyaring daftar buku berdasarkan penerbit. | Ya |
  | `category_id` | Menyaring daftar buku berdasarkan ID kategori. | Ya |
  | `limit` | Membatasi jumlah buku yang akan ditampilkan (jumlah default: 25). | Ya |
  | `page` | Halaman daftar buku yang akan ditampilkan. | Ya |

  **Response:**
  
  Akan memberikan daftar buku jika berhasil.

  **Contoh:**
  ```
  api/book/list :
  Menampilkan semua buku yang ada pada database.
  
  api/book/list?title=Libero ut nam voluptas :
  Menyaring dan menampilkan daftar buku yang cocok dengan judul "Libero ut nam voluptas".
  
  api/book/list?title=Libero ut nam voluptas&publisher=Art Extensions : 
  Menyaring dan menampilkan daftar buku yang cocok dengan kombinasi judul dan penerbit.
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/book/add` (POST/AUTH):

  Menambah buku baru.

  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `title` | Judul buku. | Ya |
  | `writer` | Nama lengkap penulis buku. | Ya |
  | `publisher` | Nama perusahaan yang menerbitkan buku. | Ya |
  | `publication_year` | Tahun terbit buku. | Ya |
  | `category_id` | ID kategori buku. | Ya |

  **Response:**

  Akan memberikan pesan berhasil dan menampilkan data buku yang ditambahkan.

  **Contoh:**
  ```json
  // Request
  {
      "title": "Buku saya",
      "writer": "Muhammad Gusti Nurfathin",
      "publisher": "PT Shaderboi",
      "publication_year": "2010",
      "category_id": "4"
  }

  // Response
  {
      "msg": "Buku berhasil ditambahkan.",
      "added": {
          "title": "Buku saya",
          "writer": "Muhammad Gusti Nurfathin",
          "publisher": "PT Shaderboi",
          "publication_year": "2010",
          "category_id": "4",
          "updated_at": "2022-04-13T15:12:45.000000Z",
          "created_at": "2022-04-13T15:12:45.000000Z",
          "id": 51
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/book/edit` (POST/AUTH):

  Mengubah atribut buku.

  **Parameter JSON:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili buku yang akan diedit. | Tidak |

  **Response:**

  Akan memberikan pesan berhasil dan menampilkan hasil data buku yang diedit.

  **Contoh:**

  Data buku sebelum diedit:

  ```json
  {
      "title": "Buku saya",
      "writer": "Muhammad Gusti Nurfathin",
      "publisher": "PT Shaderboi",
      "publication_year": "2010",
      "category_id": "4",
      "updated_at": "2022-04-13T15:12:45.000000Z",
      "created_at": "2022-04-13T15:12:45.000000Z",
      "id": 51
  }
  ```

  Melakukan pengubahan buku:

  ```json
  // Request (Mengganti judul buku)
  {
      "id": 51,
      "title": "Sastra Indonesia"
  }

  // Response
  {
      "msg": "Buku berhasil diubah.",
      "updated": {
          "id": 51,
          "title": "Sastra Indonesia",
          "writer": "Muhammad Gusti Nurfathin",
          "publisher": "PT Shaderboi",
          "publication_year": "2010",
          "category_id": 4,
          "created_at": "2022-04-13T15:12:45.000000Z",
          "updated_at": "2022-04-13T15:15:35.000000Z"
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan di dalam request.

- `api/book/del` (GET/AUTH):
  
  Menghapus buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili buku yang akan dihapus. | Ya |

  **Response:**

  Akan memberikan pesan berhasil jika buku berhasil dihapus.

  **Catatan:**

  Token akses harus disertakan di dalam request.
