-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 08:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp-pi-revisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bln_bayar` varchar(15) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `nisn`, `tgl_bayar`, `bln_bayar`, `id_spp`, `id_petugas`) VALUES
(4, 124, '2020-10-14', 'Maret', 1, 5),
(5, 124, '2020-10-14', 'Mei', 1, 5),
(7, 124, '2020-10-14', 'Februari', 1, 5),
(10, 124, '2020-10-14', 'Januari', 5, 5),
(11, 124, '2020-10-14', 'April', 5, 5),
(12, 103, '2020-10-14', 'Januari', 1, 5),
(13, 103, '2020-10-14', 'Februari', 1, 5),
(14, 103, '2020-10-14', 'Maret', 1, 5),
(15, 103, '2020-10-14', 'April', 1, 5),
(16, 103, '2020-10-14', 'Januari', 5, 5),
(17, 103, '2020-10-14', 'Februari', 5, 5),
(18, 103, '2020-10-14', 'Maret', 5, 5),
(19, 124, '2020-10-14', 'Januari', 1, 5),
(20, 124, '2020-10-14', 'Februari', 5, 5),
(21, 124, '2020-10-14', 'Maret', 5, 5),
(22, 124, '2020-10-20', 'April', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(3, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin Test', 'Admin'),
(4, 'yusuf1', '9f30881193820f8bc77a8832ccf059175c038193', 'Yusuf', 'Petugas'),
(5, 'edit', '9ead47a82a0d25985f22f10651d1f93b3abba317', 'Edit', 'Petugas'),
(6, 'tes', 'd1c056a983786a38ca76a05cda240c7b86d77136', 'Test', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama_lengkap`, `kelas`) VALUES
(103, 13, 'Yusuf Effendi', 'X'),
(124, 20, 'Aldi', 'X'),
(125, 125, 'Edit', 'X');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2019, 160000),
(5, 2020, 150000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_spp`
--
ALTER TABLE `tb_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
