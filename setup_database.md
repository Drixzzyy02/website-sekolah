# Setup Database untuk LSP_HendikaGG

## Langkah-langkah Setup Database

### 1. Jalankan XAMPP
- Start Apache dan MySQL di XAMPP Control Panel

### 2. Buat Database
- Buka browser dan akses `http://localhost/phpmyadmin`
- Klik "New" di sidebar kiri
- Database name: `lsp_hendika`
- Collation: `utf8_general_ci`
- Klik "Create"

### 3. Import Struktur Database
- Pilih database `lsp_hendika` yang baru dibuat
- Klik tab "Import"
- Klik "Choose File" dan pilih file `database.sql` dari folder project
- Klik "Go" untuk menjalankan import

### 4. Verifikasi
- Setelah import selesai, Anda akan melihat 4 tabel:
  - `profil` (1 record awal)
  - `berita` (2 records awal)
  - `ekstrakulikuler` (2 records awal)
  - `galeri` (4 records awal)

## Struktur Tabel

### profil
- `id` (INT, Primary Key, Default: 1)
- `nama_sekolah` (VARCHAR 255)
- `npsn` (VARCHAR 20)
- `didirikan` (VARCHAR 10)
- `alamat` (TEXT)
- `visi` (TEXT)
- `misi` (TEXT)
- `jurusan` (TEXT)

### berita
- `id` (INT, Auto Increment, Primary Key)
- `judul` (VARCHAR 255)
- `isi` (TEXT)
- `gambar` (VARCHAR 255)
- `created_at` (DATETIME, Default: CURRENT_TIMESTAMP)

### ekstrakulikuler
- `id` (INT, Auto Increment, Primary Key)
- `nama` (VARCHAR 255)
- `deskripsi` (TEXT)
- `gambar` (VARCHAR 255)
- `created_at` (DATETIME, Default: CURRENT_TIMESTAMP)

### galeri
- `id` (INT, Auto Increment, Primary Key)
- `judul` (VARCHAR 255)
- `deskripsi` (TEXT)
- `gambar` (VARCHAR 255)
- `created_at` (DATETIME, Default: CURRENT_TIMESTAMP)

## Testing

Setelah setup database, akses halaman-halaman berikut untuk memastikan koneksi berfungsi:

1. `http://localhost/LSP_HendikaGG/dashboard.php` - Berita dan galeri dari database
2. `http://localhost/LSP_HendikaGG/profil.php` - Profil sekolah dari database
3. `http://localhost/LSP_HendikaGG/galeri.php` - Galeri lengkap dari database
4. `http://localhost/LSP_HendikaGG/ekstrakulikuler.php` - Ekstrakurikuler dari database
5. `http://localhost/LSP_HendikaGG/login.php` - Login sebagai admin
6. `http://localhost/LSP_HendikaGG/adminpanel.php` - Panel admin untuk manage data

## Catatan

- Jika ada error koneksi database, pastikan XAMPP MySQL sudah running
- Username default MySQL di XAMPP adalah `root` tanpa password
- Jika menggunakan password MySQL, edit file `koneksi.php`