# Sistem Pengadaan Barang & Jasa

Aplikasi web untuk manajemen dan monitoring pengajuan pengadaan barang dan jasa secara digital. Dibangun di atas framework **Laravel 12** dengan tampilan modern menggunakan **Tailwind CSS** dan **Alpine.js**.

---

## Fitur Utama

- Autentikasi pengguna dengan sistem **role** (Manager & Staff)
- Pengajuan pengadaan barang/jasa oleh Staff
- Persetujuan atau penolakan pengajuan oleh Manager
- Dashboard statistik real-time (total, menunggu, disetujui, ditolak, nilai pengadaan)
- Manajemen profil pengguna
- Tampilan responsif (mobile-friendly)

---

## Tech Stack

**Backend**
- PHP 8.2
- Laravel 12
- MySQL

**Frontend**
- Blade (template engine Laravel)
- Tailwind CSS
- Alpine.js
- Vite
- Lucide Icons

**Driver Laravel**
- Session → Database
- Cache → Database
- Queue → Database

---

## Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/lupienn/pengadaan-barang-jasa-system.git
cd pengadaan-barang-jasa-system
```

### 2. Setup Awal

Jalankan perintah berikut untuk instalasi dependensi, generate key, migrasi database, dan build asset:

```bash
composer setup
```

### 3. Jalankan Seeder (Akun Default)

```bash
php artisan db:seed
```

### 4. Jalankan Aplikasi

```bash
composer run dev
```

Aplikasi akan berjalan di **http://127.0.0.1:8000**

---

## Akun Default

| Role | Username | Password |
|---|---|---|
| Manager | `manager` | `password` |
| Staff | `staff` | `password` |

> Ganti password setelah login pertama kali di halaman **Edit Profil**.

---

## Hak Akses per Role

**Manager**
- Melihat seluruh pengajuan dari semua staff
- Menyetujui atau menolak pengajuan
- Melihat statistik keseluruhan di dashboard

**Staff**
- Membuat pengajuan pengadaan baru
- Melihat riwayat pengajuan milik sendiri
- Melihat detail status pengajuan

---

## Struktur Direktori Penting

```
app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── RequestController.php
│   └── ProfileController.php
├── Models/
│   ├── User.php
│   └── ProcurementRequest.php
resources/views/
├── auth/
│   └── login.blade.php
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
└── requests/
    ├── index.blade.php
    ├── create.blade.php
    └── show.blade.php
database/
├── migrations/
└── seeders/
    └── DatabaseSeeder.php
```

---

## Menjalankan Test

```bash
composer test
```

---

## Lisensi

Project ini dikembangkan untuk keperluan **Kerja Praktik (KP)**. Seluruh hak cipta milik pengembang.
