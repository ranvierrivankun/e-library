-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 08:49 PM
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
  `tahun_buku` int(11) NOT NULL,
  `penerbit_buku` int(11) NOT NULL,
  `kategori_buku` int(11) NOT NULL,
  `buku_baik` int(11) NOT NULL,
  `buku_rusak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `judul_buku`, `pengarang_buku`, `isbn_buku`, `tahun_buku`, `penerbit_buku`, `kategori_buku`, `buku_baik`, `buku_rusak`) VALUES
(5, 'Buku 1', 'Pengarang 1', '111-111-1111-11-1', 2001, 4, 6, 5, 5),
(6, 'Buku 2', 'Pengarang 2', '222-222-2222-22-2', 2002, 5, 7, 5, 5),
(8, 'Buku 3', 'Pengarang 3', '333-333-3333-33-3', 2003, 6, 8, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `data_denda`
--

CREATE TABLE `data_denda` (
  `id_denda` int(11) NOT NULL,
  `nama_denda` varchar(255) NOT NULL,
  `tarif_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_denda`
--

INSERT INTO `data_denda` (`id_denda`, `nama_denda`, `tarif_denda`) VALUES
(1, 'Normal', 0),
(2, 'Buku Rusak', 20000),
(3, 'Buku Hilang', 50000),
(4, 'Lain-lain', 0);

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
(6, 'K1'),
(7, 'K2'),
(8, 'K3');

-- --------------------------------------------------------

--
-- Table structure for table `data_kunjungan`
--

CREATE TABLE `data_kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_kunjungan` varchar(50) NOT NULL,
  `jam_kunjungan` varchar(20) NOT NULL,
  `tujuan_kunjungan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kunjungan`
--

INSERT INTO `data_kunjungan` (`id_kunjungan`, `user_id`, `tanggal_kunjungan`, `jam_kunjungan`, `tujuan_kunjungan`) VALUES
(1, 3, '2023-04-21', '20:09:11', 'Ingin mencari Refrensi untuk skripsi saya, terimakasih'),
(2, 4, '2023-04-22', '17:59:20', 'Test Kunjungan Aja');

-- --------------------------------------------------------

--
-- Table structure for table `data_peminjaman`
--

CREATE TABLE `data_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `status_peminjaman` int(11) NOT NULL,
  `status_pengembalian` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `tanggal_peminjaman` varchar(50) NOT NULL,
  `jam_peminjaman` varchar(20) NOT NULL,
  `kondisi_buku_pinjam` int(11) NOT NULL,
  `tanggal_diterima_peminjaman` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_peminjaman`
--

INSERT INTO `data_peminjaman` (`id_peminjaman`, `status_peminjaman`, `status_pengembalian`, `user_id`, `buku_id`, `tanggal_peminjaman`, `jam_peminjaman`, `kondisi_buku_pinjam`, `tanggal_diterima_peminjaman`, `admin_id`) VALUES
(56, 3, 2, 3, 5, '2023-04-15', '09:21:59', 1, '2023-04-15', 1),
(57, 3, 2, 3, 6, '2023-04-21', '13:48:07', 2, '2023-04-21', 1),
(59, 3, 2, 4, 8, '2023-04-21', '14:20:42', 1, '2023-04-21', 1),
(62, 3, 2, 4, 8, '2023-04-21', '14:41:46', 2, '2023-04-21', 2),
(63, 3, 2, 4, 8, '2023-04-21', '14:44:57', 1, '2023-04-21', 2),
(64, 3, 2, 3, 6, '2023-04-22', '20:33:50', 1, '2023-04-22', 1);

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
(4, 'P001', 'Nama Penerbit 1', 1),
(5, 'P002', 'Nama Penerbit 2', 1),
(6, 'P003', 'Nama Penerbit 3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_pengembalian`
--

CREATE TABLE `data_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `tanggal_pengembalian` varchar(50) DEFAULT NULL,
  `jam_pengembalian` varchar(20) NOT NULL,
  `denda_id` int(11) NOT NULL,
  `tanggal_diterima_pengembalian` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pengembalian`
--

INSERT INTO `data_pengembalian` (`id_pengembalian`, `user_id`, `buku_id`, `peminjaman_id`, `tanggal_pengembalian`, `jam_pengembalian`, `denda_id`, `tanggal_diterima_pengembalian`, `admin_id`) VALUES
(11, 3, 5, 56, '2023-04-21', '13:59:02', 1, '2023-04-21', 2),
(12, 3, 6, 57, '2023-04-21', '14:00:56', 2, '2023-04-21', 2),
(14, 4, 8, 59, '2023-04-21', '14:21:26', 1, '2023-04-21', 1),
(17, 4, 8, 62, '2023-04-21', '14:43:13', 3, '2023-04-21', 2),
(18, 4, 8, 63, '2023-04-21', '14:45:09', 3, '2023-04-21', 2),
(19, 3, 6, 64, '2023-04-22', '20:34:23', 1, '2023-04-22', 1);

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
(2, '-', 2, '$2y$10$jEr5ZlOVR4S9xz6Qa4yt4e2H/CTSPQjKcHZA3OReJVNUkPzaZwxQ6', 'Staff E-Library', '', '-', 'admin2.png', 1, 1),
(3, 'AP001', 111, '$2y$10$mU/2uWnQLKtHUXFcFhlRqutyLBSJEnTO4/rUVDlEEE.6a1/YWk/uy', 'Aisha Nadine', 'Cempaka Putih Barat', '9', 'default.png', 2, 1),
(4, 'AP002', 222, '$2y$10$evhPMy62CvAB1fsaVX5N9.ZTkqHIfAnGkhWF3SUwa2HbGIZN1h5jy', 'Arifin Permana', 'Johar Baru', '6', 'default.png', 2, 1);

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
-- Indexes for table `data_denda`
--
ALTER TABLE `data_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `data_kategori`
--
ALTER TABLE `data_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `data_kunjungan`
--
ALTER TABLE `data_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indexes for table `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `data_penerbit`
--
ALTER TABLE `data_penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `data_pengembalian`
--
ALTER TABLE `data_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

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
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_denda`
--
ALTER TABLE `data_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_kategori`
--
ALTER TABLE `data_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_kunjungan`
--
ALTER TABLE `data_kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `data_penerbit`
--
ALTER TABLE `data_penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_pengembalian`
--
ALTER TABLE `data_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
