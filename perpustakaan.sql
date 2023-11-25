-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 08:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_admin` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `ID_peminjaman` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_admin`, `nama`, `ID_peminjaman`) VALUES
('ADM11', 'Upin', 'PJM001'),
('ADM12', 'Badrul', 'PJM002'),
('ADM13', 'Ipin', 'PJM003'),
('ADM14', 'Jarjit', 'PJM004'),
('ADM15', 'Susanti', 'PJM005'),
('ADM16', 'Mail', 'PJM006'),
('ADM17', 'Ehsan', 'PJM007'),
('ADM18', 'Fizi', 'PJM008'),
('ADM19', 'Ijat', 'PJM009'),
('ADM20', 'Meimei', 'PJM010');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `no_buku` varchar(10) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `ID_penerbit` varchar(10) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `no_kategori` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`no_buku`, `judul`, `ID_penerbit`, `tahun_terbit`, `no_kategori`) VALUES
('NB001', 'Pemrograman Dasar', 'PB01', 2005, '001'),
('NB002', 'Batavia', 'PB02', 1930, '002'),
('NB003', 'Gadis Kretek', 'PB03', 2014, '003'),
('NB004', 'Bismillah', 'PB04', 2004, '004'),
('NB005', 'IPA Dasar', 'PB05', 2020, '005'),
('NB006', 'Demokrasi', 'PB06', 1999, '006'),
('NB007', 'Raket Naya', 'PB07', 2019, '007'),
('NB008', 'KBBI', 'PB08', 2000, '008'),
('NB009', 'Cipta Syair', 'PB09', 2002, '009'),
('NB010', 'Akuntansi', 'PB10', 2022, '010');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `no_kategori` varchar(10) NOT NULL,
  `Jenis` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`no_kategori`, `Jenis`) VALUES
('001', 'Teknologi'),
('002', 'Sejarah'),
('003', 'Fiksi'),
('004', 'Agama'),
('005', 'Sains'),
('006', 'Politik'),
('007', 'Olahraga'),
('008', 'Bahasa'),
('009', 'Seni'),
('010', 'Ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `ID_peminjaman` varchar(10) NOT NULL,
  `Tanggal_pinjam` varchar(30) DEFAULT NULL,
  `Tanggal_kembali` varchar(30) DEFAULT NULL,
  `Tarif_denda` int(11) DEFAULT NULL,
  `Keterangan_denda` varchar(20) DEFAULT NULL,
  `ID_anggota` varchar(10) DEFAULT NULL,
  `no_buku` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`ID_peminjaman`, `Tanggal_pinjam`, `Tanggal_kembali`, `Tarif_denda`, `Keterangan_denda`, `ID_anggota`, `no_buku`) VALUES
('PJM001', '05 January 2023', '15 January 2023', 0, '-', '1', 'NB001'),
('PJM002', '10 February 2023', '20 February 2023', 0, '-', '2', 'NB002'),
('PJM003', '15 March 2023', '25 March 2023', 20000, 'Rusak', '3', 'NB003'),
('PJM004', '20 April 2023', '30 April 2023', 50000, 'Hilang', '4', 'NB004'),
('PJM005', '25 May 2023', '04 June 2023', 0, '-', '5', 'NB005'),
('PJM006', '30 June 2023', '10 July 2023', 2000, 'Terlambat', '6', 'NB006'),
('PJM007', '05 August 2023', '15 August 2023', 0, '-', '7', 'NB007'),
('PJM008', '10 September 2023', '20 September 2023', 0, '-', '8', 'NB008'),
('PJM009', '15 October 2023', '25 October 2023', 5000, 'Rusak', '9', 'NB009'),
('PJM010', '20 November 2023', '30 November 2023', 0, '-', '10', 'NB010');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `ID_penerbit` varchar(10) NOT NULL,
  `Nama_penerbit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`ID_penerbit`, `Nama_penerbit`) VALUES
('PB01', 'Erlangga'),
('PB02', 'Gramedia'),
('PB03', 'Mizan'),
('PB04', 'Kompas'),
('PB05', 'A3'),
('PB06', 'Naya Jaya'),
('PB07', 'Ertiga'),
('PB08', 'Matahari'),
('PB09', 'Pustaka'),
('PB10', 'Dahwa Jawa');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_anggota` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `NIK` varchar(20) DEFAULT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `Umur` int(11) DEFAULT NULL,
  `jenis_kelamin` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_anggota`, `email`, `password_hash`, `nama`, `NIK`, `Alamat`, `Umur`, `jenis_kelamin`) VALUES
(1, 'andi.setiawan@email.com', '$2y$10$pmbXOjmYnss.z7vp9mrzNu7D2GXE07We2NwJrCw8uCvlt4y5L12/a', 'Andi Setiawan', '123451', 'Jl. Merdeka No. 123', 28, 'L'),
(2, 'rini.sari@email.com', '$2y$10$jD31KG7qz/MkRb.1F/ibrOPsj9OneERUPhD4sNSbKbYcgTRPPYWQu', 'Rini Sari', '123452', 'Jl. Harapan Indah 45', 35, 'P'),
(3, 'budi.pratama@email.com', '$2y$10$j4w.udT3mbZ6rNQpeJPFh.B.tTRqD2fQFIva3CLdxv5GMoaNd2aIe', 'Budi Pratama', '123453', 'Jl. Pahlawan 67', 42, 'L'),
(4, 'maya.indah@email.com', '$2y$10$0Ti2wsQ9IBB23xkcFDC3kuM.paJjeNiWFOcH19XqQKMTSGN9eQ5hy', 'Maya Indah', '123454', 'Jl. Cempaka 89', 25, 'P'),
(5, 'dika.wijaya@email.com', '$2y$10$usvjuitACztFTWTdkHPnXeUSIXAw0gURi985gcOUhXCzX86.8zoZ6', 'Dika Wijaya', '123455', 'Jl. Kencana 34', 30, 'L'),
(6, 'dewi.cahaya@email.com', '$2y$10$ayOaM4h3TrRBY5JSSNmB0ektj0RbNQkUoWAGydXNKZ/nAucq5La52', 'Dewi Cahaya', '123456', 'Jl. Surya 56', 29, 'P'),
(7, 'fajar.prasetyo@email.com', '$2y$10$HyNDtgNkZ0/onJiBREGFhuNr.DC9vdPxc8wA/aGCgeuYu8MX5lhPy', 'Fajar Prasetyo', '123457', 'Jl. Mawar 78', 33, 'L'),
(8, 'siti.nurul@email.com', '$2y$10$sA9h/Xn3zKdE/9FmNBbgEe3DU4JHVIfbn4q5cqWmtxKznH81EssKe', 'Siti Nurul', '123458', 'Jl. Anggrek 90', 40, 'P'),
(9, 'yoga.santoso@email.com', '$2y$10$uFL9vL2YgBBbQD9Mjren.OldND8Iu1ZbbS8efZN6uqXLV9Q39NuxG', 'Yoga Santoso', '123459', 'Jl. Dahlia 12', 27, 'L'),
(10, 'lina.damayanti@email.com', '$2y$10$ZtdBNgAsbvDgfgAAvh5XtO46Y4VPT7ikiG88xjfwfv74Us/xkO/ki', 'Lina Damayanti', '123450', 'Jl. Kenanga 23', 31, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjungperpus`
--

CREATE TABLE `pengunjungperpus` (
  `NIK` varchar(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Umur` int(11) DEFAULT NULL,
  `jenis_Kelamin` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjungperpus`
--

INSERT INTO `pengunjungperpus` (`NIK`, `nama`, `Alamat`, `email`, `Umur`, `jenis_Kelamin`) VALUES
('123450', 'Lina Damayanti', 'Jl. Kenanga 23', 'lina.damayanti@email.com', 31, 'P'),
('123451', 'Andi Setiawan', 'Jl. Merdeka No. 123', 'andi.setiawan@email.com', 28, 'L'),
('123452', 'Rini Sari', 'Jl. Harapan Indah 45', 'rini.sari@email.com', 35, 'P'),
('123453', 'Budi Pratama', 'Jl. Pahlawan 67', 'budi.pratama@email.com', 42, 'L'),
('123454', 'Maya Indah', 'Jl. Cempaka 89', 'maya.indah@email.com', 25, 'P'),
('123455', 'Dika Wijaya', 'Jl. Kencana 34', 'dika.wijaya@email.com', 30, 'L'),
('123456', 'Dewi Cahaya', 'Jl. Surya 56', 'dewi.cahaya@email.com', 29, 'P'),
('123457', 'Fajar Prasetyo', 'Jl. Mawar 78', 'fajar.prasetyo@email.com', 33, 'L'),
('123459', 'Yoga Santoso', 'Jl. Dahlia 12', 'yoga.santoso@email.com', 27, 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`),
  ADD KEY `fkadmin` (`ID_peminjaman`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`no_buku`),
  ADD KEY `fk_buku` (`no_kategori`),
  ADD KEY `fk2_buku` (`ID_penerbit`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`no_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`ID_peminjaman`),
  ADD KEY `fkpeminjaman` (`no_buku`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`ID_penerbit`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pengunjungperpus`
--
ALTER TABLE `pengunjungperpus`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fkadmin` FOREIGN KEY (`ID_peminjaman`) REFERENCES `peminjaman` (`ID_peminjaman`) ON DELETE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk2_buku` FOREIGN KEY (`ID_penerbit`) REFERENCES `penerbit` (`ID_penerbit`),
  ADD CONSTRAINT `fk_buku` FOREIGN KEY (`no_kategori`) REFERENCES `kategori` (`no_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fkpeminjaman` FOREIGN KEY (`no_buku`) REFERENCES `buku` (`no_buku`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
