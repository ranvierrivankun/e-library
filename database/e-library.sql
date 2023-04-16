-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 05:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang_buku` varchar(255) NOT NULL,
  `isbn_buku` varchar(255) NOT NULL,
  `penerbit_buku` int(11) NOT NULL,
  `kategori_buku` int(11) NOT NULL,
  `buku_baik` int(11) NOT NULL,
  `buku_rusak` int(11) NOT NULL,
  `jumlah_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `judul_buku`, `pengarang_buku`, `isbn_buku`, `penerbit_buku`, `kategori_buku`, `buku_baik`, `buku_rusak`, `jumlah_buku`) VALUES
(2, 'Buku Test', 'Test Pengarang', '1234566789', 1, 1, 5, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `data_kategori`
--

CREATE TABLE `data_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kategori`
--

INSERT INTO `data_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Test Nama Kategori'),
(5, 'Test Nama Kategori 2');

-- --------------------------------------------------------

--
-- Table structure for table `data_penerbit`
--

CREATE TABLE `data_penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `kode_penerbit` varchar(255) NOT NULL,
  `nama_penerbit` varchar(255) NOT NULL,
  `status_penerbit` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_penerbit`
--

INSERT INTO `data_penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `status_penerbit`) VALUES
(1, 'P001', 'Test', 2),
(3, 'P002', 'Test 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `kode_anggota` varchar(255) NOT NULL,
  `nis` int(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `user_kelas` varchar(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `kode_anggota`, `nis`, `password`, `nama`, `alamat`, `user_kelas`, `foto`, `role`, `status`) VALUES
(1, '-', 1, '$2y$10$lcL0aJbBn6SLPh4.8AeFMussUD2cYv0cQ4CqKFNL22gzqfplXC1E6', 'Admin E-Library', '', '-', 'admin.png', 1, 1),
(2, 'AP001', 111, '$2y$10$jEr5ZlOVR4S9xz6Qa4yt4e2H/CTSPQjKcHZA3OReJVNUkPzaZwxQ6', 'Imam A.A', 'Kramat', '3', 'Azhure_Forum.png', 2, 1),
(3, 'AP002', 222, '$2y$10$mU/2uWnQLKtHUXFcFhlRqutyLBSJEnTO4/rUVDlEEE.6a1/YWk/uy', 'Aisha Nadine', 'Cempaka Putih Barat', '9', 'default.png', 2, 1),
(4, 'AP003', 333, '$2y$10$evhPMy62CvAB1fsaVX5N9.ZTkqHIfAnGkhWF3SUwa2HbGIZN1h5jy', 'Arifin Permana', 'Johar Baru', '6', 'default.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas_jurusan`) VALUES
(1, 'X - Teknik Komputer Jaringan'),
(2, 'XI - Teknik Komputer Jaringan'),
(3, 'XII - Teknik Komputer Jaringan'),
(4, 'X - Multimedia'),
(5, 'XI - Multimedia'),
(6, 'XII - Multimedia'),
(7, 'X - Administrasi Perkantoran'),
(8, 'XI - Administrasi Perkantoran'),
(9, 'XII - Administrasi Perkantoran');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id_role`, `nama_role`) VALUES
(1, 'Administration'),
(2, 'Anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `data_kategori`
--
ALTER TABLE `data_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `data_penerbit`
--
ALTER TABLE `data_penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `kelas` (`user_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_kategori`
--
ALTER TABLE `data_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_penerbit`
--
ALTER TABLE `data_penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
