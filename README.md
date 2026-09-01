
# 📚 Book Collection

**Sistem Manajemen Koleksi Buku Digital**

Aplikasi web untuk mengelola koleksi buku secara terstruktur. Aplikasi ini menyediakan fitur manajemen data buku, pencarian, filter, pagination, serta penyimpanan cover buku menggunakan Object Storage yang kompatibel dengan S3.

Project ini dibuat sebagai bagian dari **Tes Pemrograman Pengembang Web** pada **Lembaga Rekrutmen Mahasiswa Magang BSTI UMSU**.

---

## 📌 Tentang Project

**Book Collection** merupakan aplikasi berbasis web yang digunakan untuk mengelola informasi koleksi buku digital.

Administrator dapat melakukan:

* Menampilkan daftar buku
* Menambahkan buku
* Melihat detail buku
* Mengubah informasi buku
* Menghapus buku
* Mengunggah cover buku
* Menghapus cover lama ketika cover diganti
* Mencari buku berdasarkan judul atau penulis
* Memfilter buku berdasarkan kategori
* Memfilter buku berdasarkan tahun terbit
* Menampilkan data menggunakan pagination

Cover buku tidak disimpan di folder `public/storage`, tetapi menggunakan Object Storage dengan driver S3.

---

## 🚀 Fitur

### 📖 Book Management

* Create book
* Read book
* Update book
* Delete book
* Detail buku
* Upload cover buku

### 🔎 Search

Pencarian berdasarkan:

* Judul buku
* Nama penulis

### 🏷️ Filter

Filter berdasarkan:

* Kategori
* Tahun terbit

### 📄 Pagination

Data buku ditampilkan menggunakan pagination dengan jumlah data terbatas per halaman.

Parameter pencarian dan filter tetap dipertahankan ketika berpindah halaman.

### ☁️ Object Storage

Cover buku disimpan menggunakan S3-compatible Object Storage.

Ketika cover buku diperbarui:

1. Cover baru diunggah.
2. Cover lama dihapus dari storage.
3. Path cover baru disimpan ke database.

Ketika buku dihapus:

1. File cover dihapus dari storage.
2. Data buku dihapus dari database.

---

# 🛠️ Tech Stack

| Teknologi          | Penggunaan              |
| ------------------ | ----------------------- |
| Laravel 12         | Backend Framework       |
| PHP 8.2+           | Programming Language    |
| MySQL / PostgreSQL | Database                |
| Blade              | Frontend Template       |
| Bootstrap          | User Interface          |
| JavaScript         | Client-side interaction |
| S3 / MinIO         | Object Storage          |
| Git                | Version Control         |
| GitHub             | Repository              |

---

# 📂 Struktur Project

```text
book-collection/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── BookController.php
│   │   │
│   │   └── Requests/
│   │       ├── StoreBookRequest.php
│   │       └── UpdateBookRequest.php
│   │
│   └── Models/
│       ├── Book.php
│       └── Category.php
│
├── bootstrap/
│
├── config/
│   └── filesystems.php
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       └── books/
│           ├── layout.blade.php
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── show.blade.php
│           ├── _form.blade.php
│           └── _card.blade.php
│
├── routes/
│   └── web.php
│
├── storage/
│
├── tests/
│
├── .env
├── artisan
├── composer.json
└── package.json
```

---

# 🗄️ Database

Project menggunakan database relasional dengan dua tabel utama.

## Categories

```text
categories
├── id
├── name
├── slug
├── created_at
└── updated_at
```

Digunakan untuk menyimpan kategori buku.

## Books

```text
books
├── id
├── category_id
├── title
├── author
├── publisher
├── publication_year
├── description
├── cover_image_path
├── created_at
└── updated_at
```

Relasi:

```text
Category
   │
   │ hasMany
   ▼
 Book
```

```text
Book
   │
   │ belongsTo
   ▼
Category
```

---

# 🔄 Data Flow

Alur utama aplikasi:

```text
User
  │
  ▼
Browser
  │
  ▼
Route
  │
  ▼
BookController
  │
  ├──────────────► Validation
  │
  ├──────────────► Database
  │
  └──────────────► S3 Storage
  │
  ▼
Blade View
  │
  ▼
Browser
```

### Upload Cover

```text
User
  │
  ▼
Upload Cover
  │
  ▼
Laravel Storage
  │
  ▼
S3 Object Storage
  │
  ▼
cover_image_path
  │
  ▼
Database
```

Database hanya menyimpan lokasi/path file. File gambar tersimpan di Object Storage.

---

# ⚙️ Requirements

Sebelum menjalankan project, pastikan perangkat sudah memiliki:

* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL atau PostgreSQL
* Git

Cek versi PHP:

```bash
php -v
```

Cek Composer:

```bash
composer -V
```

Cek Node.js:

```bash
node -v
```

---

# 📥 Installation

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/book-collection.git
```

Masuk ke project:

```bash
cd book-collection
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Frontend Dependencies

```bash
npm install
```

---

## 4. Buat File Environment

Copy file `.env.example` menjadi `.env`.

```bash
cp .env.example .env
```

Pada Windows, file `.env` juga dapat dibuat dengan menyalin `.env.example` secara manual.

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

# 🗄️ Database Configuration

Edit konfigurasi database pada `.env`.

Contoh MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_collection
DB_USERNAME=root
DB_PASSWORD=
```

Buat database terlebih dahulu:

```sql
CREATE DATABASE book_collection;
```

---

# ☁️ S3 Object Storage Configuration

Konfigurasi Object Storage harus disimpan di `.env`.

Contoh:

```env
FILESYSTEM_DISK=s3

AWS_ACCESS_KEY_ID=your_access_key
AWS_SECRET_ACCESS_KEY=your_secret_key
AWS_DEFAULT_REGION=ap-southeast-3
AWS_BUCKET=your_bucket
AWS_USE_PATH_STYLE_ENDPOINT=true

AWS_ENDPOINT=your_endpoint
AWS_URL=your_storage_url
```

**Jangan commit access key atau secret key ke GitHub.**

Pastikan `.env` terdapat dalam `.gitignore`.

---

# 🔄 Migration & Seeder

Jalankan migration:

```bash
php artisan migrate
```

Jalankan seeder:

```bash
php artisan db:seed
```

Atau jalankan migration dan seeder sekaligus:

```bash
php artisan migrate --seed
```

Seeder menyediakan:

* Data kategori
* Minimal 20 data buku fiktif

---

# ▶️ Running Application

Jalankan server Laravel:

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

Untuk menjalankan frontend Vite:

```bash
npm run dev
```

---

# 🧹 Clear Cache

Jika terjadi masalah konfigurasi atau cache:

```bash
php artisan optimize:clear
```

---

# 🧪 Testing

Untuk menjalankan test:

```bash
php artisan test
```

---

# 🔐 Security

Informasi sensitif tidak boleh disimpan di repository.

Contoh data yang **tidak boleh di-commit**:

```text
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
Database password
API credentials
Application secret
```

Gunakan `.env` untuk konfigurasi environment.

---

# 📌 Git Workflow

Project dikembangkan menggunakan Git dengan commit yang terstruktur.

Contoh commit:

```bash
git add .
git commit -m "Initialize Laravel project"

git add .
git commit -m "Create category and book migrations"

git add .
git commit -m "Add book CRUD"

git add .
git commit -m "Implement book search and filtering"

git add .
git commit -m "Add S3 object storage integration"

git add .
git commit -m "Improve book collection interface"
```

---

# 🎯 Project Objective

Project ini dibuat untuk mendemonstrasikan kemampuan dalam:

* Laravel 12
* PHP
* Database relational design
* Laravel Migration
* Eloquent ORM
* Model Relationship
* CRUD
* Form Validation
* Search & Filtering
* Pagination
* Object Storage S3
* Git & GitHub
* Responsive Web Interface

---

# 👨‍💻 Developer

**Saifu Badawi**

S1 Sistem Informasi
Universitas Muhammadiyah Sumatera Utara

---

## 📄 License

Project ini dibuat untuk keperluan **Tes Pemrograman Pengembang Web - Lembaga Rekrutmen Mahasiswa Magang BSTI UMSU**.







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
