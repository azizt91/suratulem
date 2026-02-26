# 💌 SuratUlem - Platform Undangan Digital Terlengkap & Modern

**SuratUlem** adalah platform SaaS (Software as a Service) pembuatan Undangan Pernikahan Digital berbasis Laravel 11. Dilengkapi dengan fitur-fitur premium, kustomisasi mandiri oleh pengantin, dan manajemen master data yang komprehensif untuk pemilik bisnis undangan digital.

![SuratUlem Dashboard Preview](public/assets/images/logo_icon.png)

---

## ✨ Fitur Unggulan

### 👰🤵 **Fitur Pengantin (User/Client)**
- **Multi-Tema Premium:** Pilihan tema elegan mulai dari gaya minimalis modern hingga desain mewah.
- **Onboarding Wizard:** Pengisian data terstruktur langkah demi langkah yang memudahkan pengguna baru.
- **Manajemen Tamu & RSVP:** Fitur buku tamu interaktif dengan konfirmasi kehadiran (RSVP) instan.
- **Amplop Digital (Cashless):** Terintegrasi dengan berbagai QRIS, Bank Transfer, maupun E-Wallet.
- **Galeri Foto & Video:** Penambahan unlimited aset foto dan integrasi YouTube.
- **Live Streaming & Maps:** Navigasi lokasi presisi (G-Maps) & tautan Live Streaming interaktif.

### 🛡️ **Fitur Admin/Owner**
- **Dashboard Analitik:** Ringkasan total user, undangan aktif, pendapatan, dan konversi RSVP.
- **Manajemen Tema:** Sistem CRUD dinamis untuk menambah, mengubah, atau menonaktifkan tema undangan.
- **Manajemen Paket:** Mengelola harga, fitur yang didapat, dan masa pendaftaran.
- **Integrasi WhatsApp (Notifikasi):** *(Segera hadir)* - Pengingat tagihan dan penyebaran undangan otomatis.
- **Manajemen Pengguna:** Pengelolaan role & permissions secara granular (Admin, Reseller, Client).

---

## 💻 Tech Stack

- **Framework:** Laravel 11.x
- **Backend Language:** PHP 8.2+
- **Frontend / Styling:** Bootstrap 5, Tailwind CSS, Blade Templates
- **Database:** MySQL / PostgreSQL
- **Pustaka JS:** AOS (Animate on Scroll)
- **Payment Gateway:** Duitku / Midtrans *(disiapkan untuk update plugin)*

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan SuratUlem di komputer lokal Anda (XAMPP / Laragon).

### 1. Kebutuhan Sistem
Pastikan Anda sudah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB

### 2. Kloning Repositori
```bash
git clone https://github.com/azizt91/suratulem.git
cd suratulem
```

### 3. Instalasi Dependensi
Jalankan perintah ini untuk menginstal seluruh pustaka PHP dan JavaScript:
```bash
composer install
npm install
npm run build
```

### 4. Konfigurasi Environment (.env)
Salin file `.env.example` menjadi `.env` dan hasilkan kunci aplikasi:
```bash
cp .env.example .env
php artisan key:generate
```
Buka file `.env` di text editor Anda, lalu sesuaikan koneksi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=suratulem
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database dan Seeding
Buat struktur tabel otomatis dan isi dengan data awal (Role, Admin awal, dan Data Dummy Tema):
```bash
php artisan migrate:fresh --seed
```
*Catatan: Pastikan Anda telah membuat database kosong bernama `suratulem` di MySQL sebelum menjalankan perintah ini.*

### 6. Tautkan Storage Public
Agar gambar/aset statik dari tema terbaca di publik:
```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi kini dapat diakses di browser melalui: `http://127.0.0.1:8000`

---

## 🔐 Info Akses Login Default

Setelah menjalankan seeder, Anda dapat masuk menggunakan akun Admin berikut:

- **Login URL:** `http://127.0.0.1:8000/login`
- **Email:** `admin@suratulem.com`
- **Password:** `password`

---

## 📁 Struktur Direktori Penting

Jika Anda ingin memodifikasi atau memperluas aplikasi pelajari letak direktori utama ini:
- `app/Http/Controllers/Admin` → Logika backend khusus Owner/Superadmin.
- `app/Http/Controllers/User` → Logika backend khusus Pengguna/Pengantin.
- `resources/views/invitation/themes` → Kumpulan master file Blade dari berbagai tema (Dilarang mengubah tanpa pengetahuan HTML/Tailwind).
- `public/assets/templates` → Root folder untuk file stastik (CSS kustom, JS, Images) spesifik milik tema.

---

## 📜 Lisensi & Penggunaan

Source code ini adalah hasil custom web development berhak cipta. Dilarang mendistribusikan ulang atau menjual kembali source code secara bebas tanpa izin tertulis dari Developer Utama.

© 2026 SuratUlem Digital Invitation Platform. All rights reserved.
