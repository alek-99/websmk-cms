# Education CMS – Content Management System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo">
</p>

<h3 align="center">Modern Content Management System for Educational Institutions</h3>

<p align="center">
  Platform CMS berbasis web untuk membantu lembaga pendidikan mengelola informasi, berita, dokumentasi kegiatan, dan komunikasi dengan pengunjung melalui satu dashboard terintegrasi.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Framework-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/Tailwind_CSS-Styling-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white">
  <img src="https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">
  <img src="https://img.shields.io/badge/Blade-Template-F7523F?style=for-the-badge&logo=laravel&logoColor=white">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Authentication-Laravel_Breeze-FF2D20?style=flat-square&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/Responsive-Mobile_First-22C55E?style=flat-square">
  <img src="https://img.shields.io/badge/Status-Development-orange?style=flat-square">
  <img src="https://img.shields.io/badge/Project-Startup-blue?style=flat-square">
</p>

---

##  About The Project

**Education CMS** merupakan aplikasi Content Management System (CMS) berbasis web yang dirancang untuk memenuhi kebutuhan pengelolaan website lembaga pendidikan, seperti sekolah, madrasah, yayasan, dan institusi pendidikan lainnya.

Platform ini dikembangkan untuk memberikan kemudahan kepada administrator dalam mengelola konten website tanpa harus melakukan perubahan kode secara langsung.

Dengan dashboard admin yang modern dan intuitif, pengelolaan berita, galeri kegiatan, pesan pengunjung, serta monitoring aktivitas pembaca dapat dilakukan secara terpusat.

Proyek ini merupakan bagian dari pengembangan startup di bidang teknologi informasi yang berfokus pada pengembangan website CMS untuk lembaga pendidikan.

##  Key Features

###  Admin Dashboard

Dashboard administrator dirancang dengan tampilan modern, informatif, dan mudah digunakan.

- Ringkasan statistik konten website.
- Total berita yang dipublikasikan.
- Monitoring jumlah pembaca berita.
- Statistik galeri kegiatan.
- Informasi pesan masuk dari pengunjung.
- Tampilan dashboard yang responsif.
- Navigasi admin yang intuitif.

### News Management

Mengelola informasi dan berita yang ditampilkan pada website lembaga pendidikan.

- Menambahkan berita baru.
- Mengedit berita.
- Menghapus berita.
- Mengelola judul dan isi berita.
- Upload gambar thumbnail berita.
- Mengelola kategori berita.
- Mengatur status publikasi berita.
- Mengelola tanggal publikasi.

###  News Reader Monitoring

Fitur monitoring untuk mengetahui aktivitas pembaca terhadap konten berita.

- Melihat jumlah pembaca setiap berita.
- Monitoring berita paling banyak dibaca.
- Menampilkan statistik pembacaan berita.
- Membantu administrator mengetahui konten yang diminati pengunjung.
- Ringkasan aktivitas pembaca melalui dashboard admin.

###  Gallery Management

Mengelola dokumentasi kegiatan dan aktivitas lembaga pendidikan.

- Menambahkan foto kegiatan.
- Mengedit informasi galeri.
- Menghapus dokumentasi kegiatan.
- Mengelola judul dan deskripsi kegiatan.
- Upload beberapa dokumentasi foto.
- Menampilkan galeri kegiatan pada halaman website.

###  Visitor Message Management

Mengelola pesan dan komunikasi dari pengunjung website.

- Menerima pesan dari formulir kontak.
- Melihat detail pesan pengunjung.
- Mengelola daftar pesan masuk.
- Mengubah status pesan.
- Menghapus pesan.
- Mempermudah administrator dalam memantau komunikasi pengunjung.

###  Responsive Website Design

Website dirancang menggunakan pendekatan responsive design agar dapat diakses melalui berbagai perangkat.

- Desktop friendly.
- Tablet friendly.
- Mobile friendly.
- Responsive admin dashboard.
- Navigasi yang menyesuaikan ukuran layar.
- Layout konten yang fleksibel.

---

##  Authentication & Authorization

Menggunakan **Laravel Breeze** sebagai sistem autentikasi administrator.

Fitur autentikasi meliputi:

- Login administrator.
- Register akun (sesuai konfigurasi aplikasi).
- Logout.
- Password reset.
- Email verification (jika diaktifkan).
- Session management.
- Proteksi halaman dashboard.
- Pembatasan akses halaman administrator.

### User Roles

| Role | Permissions |
|---|---|
| **Admin** | Mengelola berita, galeri, pesan pengunjung, dan monitoring pembaca. |
| **Visitor** | Mengakses informasi website, membaca berita, melihat galeri, dan mengirim pesan. |

---

## Tech Stack

Teknologi yang digunakan dalam pengembangan Education CMS:

| Technology | Description |
|---|---|
| **Laravel** | Backend framework |
| **PHP** | Server-side programming |
| **Blade** | Template engine |
| **Tailwind CSS** | Modern UI styling |
| **JavaScript** | Client-side interactivity |
| **Laravel Breeze** | Authentication system |

---

##  Installation & Setup

Ikuti langkah berikut untuk menjalankan proyek di lingkungan lokal.

### 1. Clone Repository

```bash
git clone https://github.com/alek-99/websmk-cms.git

cd education-cms
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Environment Configuration

Salin file `.env.example` menjadi `.env`.

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env`.

```env
APP_NAME="Education CMS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=education_cms
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migration

```bash
php artisan migrate
```

### 7. Build Frontend Assets

Untuk development:

```bash
npm run dev
```

Untuk production build:

```bash
npm run build
```

### 8. Run Application

```bash
php artisan serve
```

Buka browser dan akses:

```text
http://127.0.0.1:8000
```

---

## Project Structure

Gambaran struktur direktori utama aplikasi:

```text
webcms/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   └── images/
│
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── dashboard/
│   │   │   ├── berita/
│   │   │   ├── galeri/
│   │   │   └── pesan/
│   │   │
│   │   ├── auth/
│   │   ├── layouts/
│   │   └── frontend/
│   │
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php
│   └── auth.php
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

##  Project Goals

Education CMS dikembangkan dengan beberapa tujuan utama:

1. **Digitalisasi Informasi Pendidikan** – Mempermudah lembaga pendidikan dalam menyampaikan informasi kepada masyarakat.
2. **Efisiensi Pengelolaan Konten** – Mengelola berita dan dokumentasi kegiatan melalui satu dashboard.
3. **Monitoring Pengunjung** – Memberikan informasi mengenai aktivitas pembaca berita.
4. **Komunikasi Digital** – Mempermudah pengunjung menghubungi pihak lembaga melalui formulir pesan.
5. **Responsive Experience** – Memberikan pengalaman akses website yang nyaman di berbagai perangkat.
6. **Startup Development** – Menjadi fondasi pengembangan layanan pembuatan website CMS untuk berbagai lembaga pendidikan.

---

## Future Development

Rencana pengembangan fitur pada versi selanjutnya:

- [ ] SEO management.
- [ ] Pengaturan identitas dan profil lembaga.
- [ ] Manajemen halaman statis.
- [ ] Manajemen menu navigasi website.
- [ ] Manajemen kategori dan tag berita.
- [ ] Statistik pengunjung website.
- [ ] Export laporan statistik.
- [ ] Multi-user administrator.
- [ ] Role dan permission management.
- [ ] Integrasi WhatsApp Gateway.
- [ ] Pengaturan tema dan tampilan website.
- [ ] Multi-institution CMS.

---

## Project Notes

> **Startup Development Project – Not for Production**

Education CMS merupakan proyek pengembangan startup yang berfokus pada penyediaan solusi website Content Management System untuk lembaga pendidikan.

Aplikasi ini masih berada dalam tahap pengembangan dan pengujian. Oleh karena itu, diperlukan pengembangan lebih lanjut pada aspek keamanan, optimasi performa, pengelolaan hak akses, serta skalabilitas sebelum digunakan dalam lingkungan produksi.

---

## Developer

Developed with  using Laravel.

**Education CMS** – Empowering Educational Institutions Through Digital Solutions.

<p align="center">
  <b>Build Better Websites. Empower Education. 🚀</b>
</p>
