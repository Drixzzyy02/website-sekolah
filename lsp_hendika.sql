-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2026 at 02:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp_hendika`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `created_at`) VALUES
(1, 'Kunjuangan siswa Endfield School', 'Endfield School mengadakan kunjungan resmi ke Wuling University sebagai bagian dari program kolaborasi akademik antar institusi teknologi. Para siswa mempelajari fasilitas riset mutakhir, pusat pengembangan AI, serta sistem engineering yang digunakan untuk mendukung pembangunan infrastruktur koloni.\r\n\r\nProgram ini dirancang untuk memperkenalkan siswa pada standar pendidikan tingkat lanjut serta membuka peluang kolaborasi penelitian di masa depan. Dalam kunjungan tersebut, siswa juga mengikuti sesi presentasi teknologi dan simulasi pengembangan sistem industri modern.\r\n', 'media/1775062309_WhatsAppImage2026-04-01at22.59.36.jpeg', '2026-04-01 19:08:19'),
(2, 'Lab baru siap digunakan', 'Endfield School telah mengaktifkan Technology Research Lab terbaru yang dilengkapi dengan sistem komputasi generasi baru dan perangkat simulasi industri. Laboratorium ini dirancang sebagai pusat pengembangan teknologi tempat siswa dapat melakukan eksperimen, simulasi sistem, serta pengujian prototype digital.\r\n\r\nLab ini dilengkapi dengan AI assisted workstation, tactical computing system, dan environment simulation tools yang memungkinkan siswa mempelajari skenario teknologi dunia nyata secara lebih mendalam. Fasilitas ini juga menjadi pusat pelatihan calon engineer dan operator teknologi masa depan.', 'media/1775062534_WhatsAppImage2026-04-01at14.23.26.jpeg', '2026-04-01 19:08:19'),
(3, 'Tahun Ajaran Baru', 'Endfield School mengumumkan pembukaan rekrutmen siswa baru untuk calon operator dan engineer generasi berikutnya. Program penerimaan ini ditujukan bagi individu yang memiliki potensi dalam bidang teknologi, analisis sistem, serta pengembangan inovasi digital.\r\n\r\nregistrasi resmi academy. Endfield School mengundang para calon inovator untuk bergabung dan menjadi bagian dari generasi yang akan membangun masa depan teknologi.', 'media/1775062707_WhatsAppImage2026-04-01at20.26.342.jpeg', '2026-04-01 23:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakulikuler`
--

CREATE TABLE `ekstrakulikuler` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakulikuler`
--

INSERT INTO `ekstrakulikuler` (`id`, `nama`, `deskripsi`, `gambar`, `created_at`) VALUES
(1, 'Estrakulikuler Memancing', 'Klub Memancing Endfield merupakan kegiatan ekstrakurikuler yang melatih kesabaran, fokus, dan kemampuan observasi siswa melalui aktivitas eksplorasi perairan di wilayah koloni. Selain sebagai kegiatan rekreasi, klub ini juga mengajarkan teknik survival dasar, pengenalan ekosistem, serta manajemen sumber daya alam yang berkelanjutan.', 'media/1775061529_WhatsAppImage2026-04-01at22.59.361.jpeg', '2026-04-01 19:08:19'),
(2, 'Estrakulikuler Lari', 'Klub Lari Endfield adalah kegiatan yang bertujuan meningkatkan ketahanan fisik, kecepatan, dan disiplin siswa. Program latihan dirancang untuk membentuk kondisi fisik operator yang siap menghadapi berbagai situasi lapangan, serta membangun mental pantang menyerah dan kerja sama tim.', 'media/1775061571_WhatsAppImage2026-04-01at22.59.363.jpeg', '2026-04-01 19:08:19'),
(3, 'Estrakulikuler Debat', 'Klub Debat Endfield berfokus pada pengembangan kemampuan berpikir kritis, komunikasi, dan analisis strategi. Siswa dilatih untuk menyusun argumen logis, mempertahankan pendapat berdasarkan data, serta berdiskusi secara profesional dalam berbagai simulasi diskusi akademik dan teknologi.', 'media/1775061607_WhatsAppImage2026-04-01at22.59.362.jpeg', '2026-04-01 23:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `gambar`, `created_at`) VALUES
(4, 'Halaman Sekolah', 'Halaman sekolah yang luas dan hijau', 'media/1775049296_WhatsAppImage2026-04-01at14.23.271.jpeg', '2026-04-01 19:08:19'),
(5, 'Lobby Utama', 'Lobby Utama Gedung Enfield School Industries', 'media/1775060925_WhatsAppImage2026-04-01at20.26.341.jpeg', '2026-04-01 20:43:36'),
(6, 'Lab Penelitian & Pengembangan', 'Lab Penelitian dan Pengembangan Endfield School Industries', 'media/1775061222_WhatsAppImage2026-04-01at14.23.27.jpeg', '2026-04-01 23:33:42'),
(7, 'Gedung Utama', 'Gedung sekaligus jalan utama gedung Endfield School Industries', 'media/1775061341_WhatsAppImage2026-04-01at14.23.272.jpeg', '2026-04-01 23:35:42'),
(8, 'Ruang Perakitan', 'Ruang khusus Perakitan untuk jurusan Teknik Perakitan Komponen Industri', 'media/1775063120_WhatsAppImage2026-04-01at20.26.343.jpeg', '2026-04-02 00:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL DEFAULT 1,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(20) NOT NULL,
  `didirikan` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `jurusan` text DEFAULT NULL,
  `telpon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(255) NOT NULL,
  `jumlah_siswa` varchar(255) NOT NULL,
  `jumlah_guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `nama_sekolah`, `npsn`, `didirikan`, `alamat`, `visi`, `misi`, `jurusan`, `telpon`, `email`, `website`, `jumlah_siswa`, `jumlah_guru`) VALUES
(1, 'Endfield School Industries', '20987456', '2097 ', 'Endfield Nexus Academy   Sector 7 Technology District   Talos-II Colony Planet   Endfield Scientific Territory', 'Membentuk operator dan ilmuwan masa depan yang mampu mengembangkan teknologi, menjaga stabilitas peradaban, dan menjelajahi frontier baru dunia Endfield.', 'Mengembangkan pendidikan berbasis riset teknologi Originium dan sistem industri.\r\nMelatih operator dalam strategi, engineering, dan data analysis.\r\nMembentuk mental disiplin dan adaptif terhadap lingkungan ekstrem.\r\nMenghasilkan inovator yang mampu membangun kembali peradaban.\r\nMendorong kolaborasi antara sains, militer, dan industri.\r\nMenanamkan tanggung jawab terhadap stabilitas dunia Endfield.', 'Teknik Perakitan Komponen Industri, Teknik Pertanian Modern, Oprator dan Administrasi, Geografi dan Logistik', '081289525423', 'endmingacorgg@gmail.com', 'https://endfieldschool.com', '590', '47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `roles`) VALUES
(1, 'endmin', 'endmin@gmail.com', 123, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
