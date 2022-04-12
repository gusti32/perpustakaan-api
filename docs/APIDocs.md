## Dokumentasi API

### Daftar Isi

- [Dokumentasi API](#dokumentasi-api)
  - [Daftar Isi](#daftar-isi)
  - [Pendahuluan](#pendahuluan)
  - [API Autentikasi](#api-autentikasi)
- [API Kategori](#api-kategori)
- [API Buku](#api-buku)

### Pendahuluan

Ketika melakukan request API yang membutuhkan token autentikasi (ditandai dengan AUTH), pengguna harus menyertakan token autentikasi didalam header HTTP, sebagai contoh:

`Authorization: Bearer 5|6EVQecQ15GlLuYSXB84VuI4dFHK7jJ77a6HQ91bE`

Untuk me-request API POST, pengguna harus menggunakan data JSON dan mengatur HTTP header field `Content-Type` ke `application/json`.

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

  Token akses harus disertakan didalam request.

## API Kategori

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

  Token akses harus disertakan didalam request.

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

  Token akses harus disertakan didalam request.

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
      "msg": "Kategori berhasil diedit.",
      "updated": {
          "id": 11,
          "name": "Sastra",
          "created_at": 1649770464,
          "updated_at": 1649771063
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan didalam request.

- `api/category/del` (GET/AUTH):
  
  Menghapus kategori buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili kategori yang akan dihapus. | Ya |

  **Response:**

  Akan memberikan pesan berhasil jika kategori berhasil dihapus.

## API Buku

- `api/book/list` (GET/AUTH):
  
  Menampilkan daftar buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `title` | Saring daftar buku berdasarkan judul. | Ya |
  | `writer` | Saring daftar buku berdasarkan penulis. | Ya |
  | `publisher` | Saring daftar buku berdasarkan penerbit. | Ya |
  | `category_id` | Saring daftar buku berdasarkan ID kategori. | Ya |
  | `limit` | Membatasi jumlah buku yang akan ditampilkan (jumlah default: 25). | Ya |
  | `page` | Halaman daftar buku yang akan ditampilkan. | Ya |

  **Response:**
  
  Akan memberikan daftar kategori buku jika berhasil.

  **Contoh:**
  ```
  api/book/list <- Menampilkan semua kategori yang ada pada database.
  api/book/list?title=Agama <- Mencari dan menampilkan kategori yang cocok dengan judul "Agama".
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

  Token akses harus disertakan didalam request.

- `api/book/add` (POST/AUTH):

  Menambahkan buku baru.

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

  Token akses harus disertakan didalam request.

- `api/book/edit` (POST/AUTH):

  Mengubah atribut buku.

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
      "msg": "Kategori berhasil diedit.",
      "updated": {
          "id": 11,
          "name": "Sastra",
          "created_at": 1649770464,
          "updated_at": 1649771063
      }
  }
  ```

  **Catatan:**

  Token akses harus disertakan didalam request.

- `api/book/del` (GET/AUTH):
  
  Menghapus buku.

  **Parameter GET:**
  | Nama | Deskripsi | Opsional |
  |------|-----------|----------|
  | `id` | ID yang mewakili kategori yang akan dihapus. | Ya |

  **Response:**

  Akan memberikan pesan berhasil jika kategori berhasil dihapus.
