-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2021 at 07:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp-pi-revisi-v2`
--
CREATE DATABASE IF NOT EXISTS `spp-pi-revisi-v2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `spp-pi-revisi-v2`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_metode_pembayaran`
--

CREATE TABLE `tb_metode_pembayaran` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `nama_pemilik_rekening` varchar(50) DEFAULT NULL,
  `nomor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_metode_pembayaran`
--

INSERT INTO `tb_metode_pembayaran` (`id`, `nama_bank`, `nama_pemilik_rekening`, `nomor`) VALUES
(1, 'BRI', 'SMK PGRI JOMBANG', '9990001'),
(2, 'Mandiri', 'SMK PGRI JOMBANG', '9990002'),
(3, 'BCA', 'SMK PGRI JOMBANG', '9990003'),
(4, 'Tunai', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL DEFAULT current_timestamp(),
  `bln_bayar` varchar(15) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `id_metode_pembayaran` int(11) NOT NULL,
  `nama_pengirim` varchar(50) DEFAULT NULL,
  `nama_bank_pengirim` varchar(50) DEFAULT NULL,
  `status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `nomor_hp` varchar(13) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_desa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `password`, `nama_lengkap`, `kelas`, `tanggal_lahir`, `jenis_kelamin`, `nomor_hp`, `email`, `id_desa`) VALUES
(1, 1, '356a192b7913b04c54574d18c28d46e6395428ab', 'TKJw', 'TKJ', '2020-01-08', 'L', '03333', 'ASF@GMAIL.COM', '5208020006'),
(2, 2, 'da4b9237bacccdf19c0760cab7aec4a8359010b0', 'TKR', 'TKR', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(3, 3, '77de68daecd823babbb58edb1c8e14d7106e83bb', 'TITL', 'TIT', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(4, 4, '1b6453892473a467d07372d45eb05abc2031647a', 'TPM', 'TPM', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(103, 135, '934385f53d1bd0c1b8493e44d0dfd4c8e88a04bb', 'Yusuf Effendi', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(123, 123, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'tes', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(124, 20, 'f38cfe2e2facbcc742bad63f91ad55637300cb45', 'Aldi', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(125, 125, '0ca9277f91e40054767f69afeb0426711ca0fddd', 'Edit', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(126, 1267, '114d4eefde1dae3983e7a79f04c72feb9a3a7efd', 'Budi', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(127, 1270, '008451a05e1e7aa32c75119df950d405265e0904', 'Rudi', 'XII', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(128, 1280, 'b4182bff4b3cf75f9e54f4990f9bd153c0c2973c', 'Lop', 'XI', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(129, 1290, '8b7471f4ae0bf59f5f0a425068c05d96f4801b9e', 'Soleh', 'X', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(130, 1300, '2a7541babb57434e5631ffa2b5639e24f8ce84fc', 'Retty', 'XII', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(131, 1310, 'e794a80eb109162d579df51db6d52e223bb0e9be', 'Supri', 'XII', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(150, 1500, '13682ac418603aa0966369d46bbf282f562acf47', 'Ismail', 'XI', '2020-01-01', 'L', '08123456789', NULL, '3517040007'),
(444, 444, '9a3e61b6bcc8abec08f195526c3132d5a4a98cc0', '444', 'TKJ', '2020-12-31', 'L', '', '', '3517160012'),
(12000, 12001, 'fb46f8e5019ea01b1c23838fc12704cae467c1a1', 'Sandi', 'XII', '2020-01-01', 'L', '08123456789', NULL, '3517040007');

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
-- Indexes for table `tb_metode_pembayaran`
--
ALTER TABLE `tb_metode_pembayaran`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tb_metode_pembayaran`
--
ALTER TABLE `tb_metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

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
