-- database.sql
-- Script untuk membuat database dan tabel-tabel untuk project LSP_HendikaGG
-- Jalankan di phpMyAdmin atau command line MySQL

-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS lsp_hendika;
USE lsp_hendika;

-- Tabel profil sekolah
CREATE TABLE IF NOT EXISTS profil (
    id INT PRIMARY KEY DEFAULT 1,
    nama_sekolah VARCHAR(255) NOT NULL,
    npsn VARCHAR(20) NOT NULL,
    didirikan VARCHAR(10) NOT NULL,
    alamat TEXT NOT NULL,
    visi TEXT,
    misi TEXT,
    jurusan TEXT,
    telpon VARCHAR(20),
    email VARCHAR(100),
    website VARCHAR(255),
    jumlah_siswa INT DEFAULT 0,
    jumlah_guru INT DEFAULT 0
);

-- Tabel berita
CREATE TABLE IF NOT EXISTS berita (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabel ekstrakulikuler
CREATE TABLE IF NOT EXISTS ekstrakulikuler (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabel galeri
CREATE TABLE IF NOT EXISTS galeri (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert data awal untuk profil (opsional, bisa dihapus jika tidak perlu)
INSERT INTO profil (id, nama_sekolah, npsn, didirikan, alamat, visi, misi, jurusan) VALUES
(1, 'SMK STRADA JAKARTA', '20104082', '1995', 'Jl. Pendidikan No. 123, Jakarta Timur',
'Mencetak lulusan yang berkompeten, berkarakter, dan berdaya saing tinggi di era industri 4.0',
'Menyelenggarakan pendidikan berkualitas yang relevan dengan kebutuhan industri. Mengembangkan kompetensi siswa melalui pembelajaran praktik yang intensif. Membentuk karakter siswa yang bertanggung jawab dan berdisiplin. Memfasilitasi siswa untuk belajar lifelong learning dan adaptif terhadap perubahan',
'Teknik Komputer Jaringan, Rekayasa Perangkat Lunak, Teknik Mesin, Teknik Otomotif, Administrasi Perkantoran')
ON DUPLICATE KEY UPDATE
nama_sekolah = VALUES(nama_sekolah),
npsn = VALUES(npsn),
didirikan = VALUES(didirikan),
alamat = VALUES(alamat),
visi = VALUES(visi),
misi = VALUES(misi),
jurusan = VALUES(jurusan);

-- Insert data awal untuk berita (opsional)
INSERT INTO berita (judul, isi, gambar) VALUES
('Juara Lomba Programming', 'Siswa memenangkan lomba coding tingkat nasional', 'media/berita1.jpg'),
('Kegiatan Bakti Sosial', 'Sekolah mengadakan kegiatan sosial untuk masyarakat', 'media/berita2.jpg');

-- Insert data awal untuk ekstrakulikuler (opsional)
INSERT INTO ekstrakulikuler (nama, deskripsi, gambar) VALUES
('Basket', 'Tim basket sekolah yang aktif mengikuti kompetisi', 'media/ekstra1.jpg'),
('Paduan Suara', 'Kelompok paduan suara dengan berbagai prestasi', 'media/ekstra2.jpg');

-- Insert data awal untuk galeri (opsional)
INSERT INTO galeri (judul, deskripsi, gambar) VALUES
('Ruang Kelas', 'Ruang kelas yang nyaman dan modern', 'media/g1.jpg'),
('Perpustakaan', 'Perpustakaan dengan koleksi buku lengkap', 'media/g2.jpg'),
('Laboratorium', 'Laboratorium komputer untuk praktikum', 'media/g3.jpg'),
('Halaman Sekolah', 'Halaman sekolah yang luas dan hijau', 'media/g4.jpg');

-- Selesai
-- Untuk menjalankan: import file ini ke phpMyAdmin atau jalankan dengan mysql -u root -p lsp_hendika < database.sql