-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2022 at 02:05 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kua_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_pengantin`
--

CREATE TABLE `calon_pengantin` (
  `id` int(11) NOT NULL,
  `nik_calon_suami` varchar(50) NOT NULL,
  `nama_calon_suami` varchar(225) NOT NULL,
  `no_hp_calon_suami` varchar(50) NOT NULL,
  `email_calon_suami` varchar(100) NOT NULL,
  `alamat_calon_suami` varchar(100) NOT NULL,
  `ttl_calon_suami` varchar(100) NOT NULL,
  `nik_calon_istri` varchar(100) NOT NULL,
  `nama_calon_istri` varchar(225) NOT NULL,
  `no_hp_calon_istri` varchar(50) NOT NULL,
  `email_calon_istri` varchar(100) NOT NULL,
  `alamat_calon_istri` varchar(225) NOT NULL,
  `ttl_calon_istri` varchar(100) NOT NULL,
  `tanggal_rencana_menikah` datetime NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_user_penyuluh` int(11) DEFAULT NULL,
  `id_calon_pengantin` int(11) NOT NULL,
  `id_user_calon_pengantin` int(11) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `jam` time NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `materi_bimbingan`
--

CREATE TABLE `materi_bimbingan` (
  `id` int(11) NOT NULL,
  `nama_materi` varchar(100) NOT NULL,
  `id_user_penyuluh` int(11) DEFAULT NULL,
  `id_calon_pengantin` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penyuluh`
--

CREATE TABLE `penyuluh` (
  `id` int(11) NOT NULL,
  `jenis_penyuluh` varchar(100) NOT NULL,
  `nik_penyuluh` varchar(50) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `gelar_depan` varchar(50) NOT NULL,
  `gelar_belakang` varchar(50) NOT NULL,
  `tempat_tanggal_lahir` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `status_keluarga` varchar(50) NOT NULL,
  `pendidikan_formal` varchar(50) NOT NULL,
  `bidang_keahlian` varchar(50) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL,
  `tempat_tugas` varchar(50) NOT NULL,
  `wilayah_kerja` varchar(50) NOT NULL,
  `diklat_fungsional` varchar(50) NOT NULL,
  `jenjang_jabatan` varchar(50) NOT NULL,
  `tanggal_sk_cpns` datetime NOT NULL,
  `masa_kerja_berdasarkan_skpp` varchar(50) NOT NULL,
  `alamat_rumah` varchar(225) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `alamat_email` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `nomor` varchar(225) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `nama_kepala_kua` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `foto_calon_suami` varchar(225) NOT NULL,
  `foto_calon_istri` varchar(100) NOT NULL,
  `id_calon_pengantin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$sQGoioeR7X/7CBffNnq/huw7w4U.Yq8tCOZ7uY6FrJyC82O5pNuHK', 'admin', NULL, NULL),
(2, 'penyuluh@gmail.com', '$2y$10$sQGoioeR7X/7CBffNnq/huw7w4U.Yq8tCOZ7uY6FrJyC82O5pNuHK', 'penyuluh', NULL, NULL),
(3, 'penyuluh2@gmail.com', '$2y$10$k8nSiJtEzkRj0zkUG7bKeuboaYhoTre/QUhb5dRdHVEsuvzyS9DYm', 'penyuluh', '2022-04-13 02:24:58', '2022-04-13 02:24:58'),
(4, 'catin1@gmail.com', '$2y$10$sQGoioeR7X/7CBffNnq/huw7w4U.Yq8tCOZ7uY6FrJyC82O5pNuHK', 'calon_pengantin', '2022-04-13 07:47:33', '2022-04-13 07:47:33'),
(5, 'kepala_kua@gmail.com', '$2y$10$sQGoioeR7X/7CBffNnq/huw7w4U.Yq8tCOZ7uY6FrJyC82O5pNuHK', 'kepala_kua', NULL, NULL),
(7, 'andyfebri742@gmail.com', '$2y$10$dg0xIul.GxCXvRkfhAfemu9mv3NTrqiLexuFjNKaKoJedUbwYnMPW', 'calon_pengantin', '2022-04-19 03:22:58', '2022-04-19 03:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `wali_nikah`
--

CREATE TABLE `wali_nikah` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `kewarganegaraan` varchar(100) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `id_calon_pengantin` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_pengantin`
--
ALTER TABLE `calon_pengantin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi_bimbingan`
--
ALTER TABLE `materi_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyuluh`
--
ALTER TABLE `penyuluh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wali_nikah`
--
ALTER TABLE `wali_nikah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calon_pengantin`
--
ALTER TABLE `calon_pengantin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materi_bimbingan`
--
ALTER TABLE `materi_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyuluh`
--
ALTER TABLE `penyuluh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wali_nikah`
--
ALTER TABLE `wali_nikah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
