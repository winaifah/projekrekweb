# Manajemen Mahasiswa - CRUD Application

## Deskripsi Proyek

Proyek ini merupakan aplikasi web dinamis untuk manajemen data mahasiswa. Aplikasi ini memungkinkan pengguna untuk menambahkan, mengedit, dan menghapus data mahasiswa dengan mudah. Dibangun menggunakan teknologi modern, proyek ini bertujuan memberikan pengalaman pengguna yang responsif dan efisien.

## Fitur Utama

- **Tambah Mahasiswa**: Tambahkan data mahasiswa baru dengan informasi yang lengkap.
- **Edit Mahasiswa**: Ubah informasi mahasiswa yang sudah ada.
- **Hapus Mahasiswa**: Hapus data mahasiswa yang tidak diperlukan.
- **CRUD yang Responsif**: Performa cepat dan tampilan responsif di berbagai perangkat.

## Teknologi yang Digunakan

- **[Laravel](https://laravel.com/)**: Framework PHP untuk back-end, termasuk pengelolaan logika bisnis dan API.
- **[Vue.js](https://vuejs.org/)**: Framework JavaScript untuk membangun antarmuka pengguna yang interaktif.
- **[Inertia.js](https://inertiajs.com/)**: Library yang menghubungkan front-end Vue.js dengan back-end Laravel tanpa API REST.
- **[Tailwind CSS](https://tailwindcss.com/)**: Framework CSS untuk desain yang cepat dan konsisten.
- **[Redis](https://redis.io/)**: Database in-memory yang digunakan untuk caching.

## Prasyarat

Sebelum menjalankan aplikasi ini, pastikan Anda telah menginstal:

- PHP (versi minimal 8.1)
- Composer
- Node.js dan npm/yarn
- Redis
- Database MySQL atau sejenisnya

## Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/winaifah/projekrekweb.git
   cd projekrekweb
2. Install dependensi Laravel:
   ```bash
   composer install
3. Install dependensi front-end:
   ```bash
   npm install
4. Salin file konfigurasi .env
5. Konfigurasikan file .env dengan kredensial database dan Redis.
6. Jalankan migrasi database:
   ```bash
   php artisan migrate
7. Jalankan server Redis
8. Build front-end assets:
   ```bash
   npm run dev
9. Jalankan Server aplikasi:
    ```bash
    php artisan serve
10. Akses aplikasi di browser melalui http://localhost:8000.

## Struktur Proyek
```bash
project-name/
├── app/                # Direktori aplikasi Laravel
├── resources/
│   ├── views/          # Template Blade untuk back-end
│   ├── js/             # Komponen Vue.js
│   ├── css/            # Gaya yang didefinisikan dengan Tailwind CSS
├── public/             # Folder untuk aset publik
├── routes/             # Definisi rute Laravel
├── database/           # Migrations dan seeders
├── storage/            # Penyimpanan file sementara
└── .env                # File konfigurasi lingkungan
