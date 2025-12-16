# Coffeshop - Aplikasi Kasir (Point of Sale)



Aplikasi kasir (Point of Sale) berbasis web yang modern, cepat, dan mudah digunakan. Dibangun menggunakan framework Laravel 11, aplikasi ini dirancang untuk mempermudah proses manajemen penjualan, produk, dan laporan di toko Anda.

---

## ✨ Fitur Utama

### 👤 Hak Akses & Otentikasi
- **Sistem Login & Registrasi**: Proses otentikasi yang aman menggunakan Laravel Breeze.
- **Dua Peran Pengguna**:
  - **Admin**: Akses penuh untuk mengelola seluruh sistem.
  - **Kasir**: Akses terbatas untuk melakukan transaksi penjualan.
- **Manajemen Profil**: Pengguna dapat mengubah nama, email, dan password.

### 🛒 Fitur Kasir
- **Antarmuka Point of Sale (POS)**: Tampilan daftar produk yang intuitif dan responsif.
- **Pencarian Produk**: Cari produk secara *real-time* berdasarkan nama.
- **Manajemen Keranjang**: Tambah produk ke keranjang, update jumlah, dan batalkan transaksi dengan mudah.
- **Proses Checkout**: Proses pembayaran yang cepat dengan perhitungan total dan kembalian otomatis.
- **Cetak Struk**: Mencetak struk transaksi secara otomatis setelah pembayaran berhasil.

### ⚙️ Fitur Admin
- **Manajemen Produk**: Operasi CRUD (Create, Read, Update, Delete) untuk produk, termasuk upload gambar.
- **Manajemen Kategori**: Operasi CRUD untuk kategori produk.
- **Laporan Penjualan**:
  - Filter laporan berdasarkan rentang tanggal.
  - Lihat ringkasan total transaksi dan total pendapatan.
  - Lihat daftar produk terlaris pada periode yang dipilih.

---

## 🚀 Teknologi yang Digunakan

- **Backend**: PHP 8.2+, Laravel 11
- **Frontend**: Blade, Tailwind CSS, JavaScript (Vanilla)
- **Database**: MySQL / MariaDB
- **Otentikasi & Peran**: Laravel Breeze, Spatie Laravel Permission
- **Development Tooling**: Vite

---

## 📦 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/username/mdmart.git
    cd mdmart
    ```

2.  **Install Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Setup File Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasinya.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Kunci Aplikasi**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database**
    Buka file `.env` dan atur koneksi database Anda.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mdmart
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal (role, user, produk, dan kategori).
    ```bash
    php artisan migrate --seed
    ```

7.  **Buat Symbolic Link untuk Storage**
    Agar gambar produk dapat diakses publik.
    ```bash
    php artisan storage:link
    ```

8.  **Install Dependensi JavaScript**
    ```bash
    npm install
    ```

9.  **Jalankan Aplikasi**
    - Buka terminal pertama dan jalankan Vite dev server:
      ```bash
      npm run dev
      ```
    - Buka terminal kedua dan jalankan server Laravel:
      ```bash
      php artisan serve
      ```

10. **Selesai!**
    Buka aplikasi di browser Anda pada alamat `http://127.0.0.1:8000`.

---

## 🔑 Akun Default

Setelah menjalankan `db:seed`, Anda dapat login menggunakan akun berikut:

- **Role Admin**:
  - **Email**: `admin@pos.com`
  - **Password**: `admin123`

- **Role Kasir**:
  - **Email**: `kasir@pos.com`
  - **Password**: `kasir123`

