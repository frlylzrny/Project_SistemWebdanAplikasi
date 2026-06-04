# API Specification

> Dokumentasikan setiap endpoint yang dikembangkan maupun yang dikonsumsi dari layanan eksternal.

---

## Register User

**Method:** `POST`

**URL:** `/api/v1/register`

**Deskripsi:** Mendaftarkan pengguna baru ke dalam sistem.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:**

```json
{
  "name": "string",
  "email": "string",
  "password": "string"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "User registered successfully"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Email already registered"
}
```

---

## Login User

**Method:** `POST`

**URL:** `/api/v1/login`

**Deskripsi:** Autentikasi pengguna menggunakan email dan password.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Request Headers:**

```
Content-Type: application/json
```

**Request Body:**

```json
{
  "email": "string",
  "password": "string"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "token": "access_token"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Invalid credentials"
}
```

---

## Logout User

**Method:** `POST`

**URL:** `/api/v1/logout`

**Deskripsi:** Mengakhiri sesi login pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Headers:**

```
Authorization: Bearer <token>
```

**Request Body:** `-`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Logged out successfully"
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Unauthorized"
}
```

---

## Search Books

**Method:** `GET`

**URL:** `/api/v1/books/search?q={keyword}`

**Deskripsi:** Mencari novel berdasarkan judul, penulis, atau kata kunci.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Third-Party API — Google Books API`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": [
    {
      "book_id": "abc123",
      "title": "Harry Potter",
      "author": "J.K. Rowling"
    }
  ]
}
```

**Response Gagal:**

```json
{
  "status": "error",
  "message": "Book not found"
}
```

---

## Book Detail

**Method:** `GET`

**URL:** `/api/v1/books/{bookId}`

**Deskripsi:** Menampilkan informasi lengkap novel dan otomatis menyimpan riwayat bacaan.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Third-Party API — Google Books API`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": {
    "book_id": "abc123",
    "title": "Harry Potter",
    "author": "J.K. Rowling",
    "description": "Novel fantasy",
    "category": "Fantasy"
  }
}
```

---

## Add Bookmark

**Method:** `POST`

**URL:** `/api/v1/bookmarks`

**Deskripsi:** Menambahkan novel ke daftar favorit pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Body:**

```json
{
  "book_id": "abc123",
  "title": "Harry Potter"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Book added to bookmark"
}
```

---

## Get Bookmarks

**Method:** `GET`

**URL:** `/api/v1/bookmarks`

**Deskripsi:** Menampilkan seluruh bookmark milik pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": []
}
```

---

## Delete Bookmark

**Method:** `DELETE`

**URL:** `/api/v1/bookmarks/{id}`

**Deskripsi:** Menghapus novel dari daftar bookmark.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Bookmark removed"
}
```

---

## Get Reading History

**Method:** `GET`

**URL:** `/api/v1/history`

**Deskripsi:** Menampilkan riwayat bacaan pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": []
}
```

---

## Get Recommendations

**Method:** `GET`

**URL:** `/api/v1/recommendations`

**Deskripsi:** Menampilkan rekomendasi novel berdasarkan genre yang paling sering dibaca pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System + Google Books API`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "genre": "Fantasy",
  "data": []
}
```

---

## Add Rating

**Method:** `POST`

**URL:** `/api/v1/ratings`

**Deskripsi:** Memberikan rating pada novel.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Body:**

```json
{
  "book_id": "abc123",
  "rating": 5
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Rating submitted"
}
```

---

## Get Ratings

**Method:** `GET`

**URL:** `/api/v1/ratings/{bookId}`

**Deskripsi:** Menampilkan rating sebuah novel.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "average_rating": 4.8
}
```

---

## Add Review

**Method:** `POST`

**URL:** `/api/v1/reviews`

**Deskripsi:** Menambahkan ulasan novel.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Body:**

```json
{
  "book_id": "abc123",
  "review": "Novel sangat menarik"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Review added"
}
```

---

## Update Review

**Method:** `PUT`

**URL:** `/api/v1/reviews/{id}`

**Deskripsi:** Mengubah ulasan yang telah dibuat.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Request Body:**

```json
{
  "review": "Novel sangat menarik dan seru"
}
```

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Review updated"
}
```

---

## Delete Review

**Method:** `DELETE`

**URL:** `/api/v1/reviews/{id}`

**Deskripsi:** Menghapus ulasan milik pengguna.

**Autentikasi Diperlukan:** `Ya`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "message": "Review deleted"
}
```

---

## Get Reviews

**Method:** `GET`

**URL:** `/api/v1/reviews/{bookId}`

**Deskripsi:** Menampilkan seluruh ulasan pada novel tertentu.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Internal System`

**Response Sukses (`200 OK`):**

```json
{
  "status": "success",
  "data": []
}
```

---

# Endpoint Eksternal yang Dikonsumsi

## Google Books Search API

**Method:** `GET`

**URL:** `https://www.googleapis.com/books/v1/volumes?q={keyword}`

**Deskripsi:** Mengambil daftar novel berdasarkan kata kunci pencarian.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Google Books API`

---

## Google Books Detail API

**Method:** `GET`

**URL:** `https://www.googleapis.com/books/v1/volumes/{volumeId}`

**Deskripsi:** Mengambil detail lengkap novel berdasarkan ID buku.

**Autentikasi Diperlukan:** `Tidak`

**Sumber:** `Third-Party API — Google Books API`