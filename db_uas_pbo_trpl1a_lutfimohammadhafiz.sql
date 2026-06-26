-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 02:44 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1a_lutfimohammadhafiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` decimal(15,2) NOT NULL,
  `jenis_pembiayaan` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_supsidi` decimal(15,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_supsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Fauzi', 'TRPL1A001', 1, 9500000.00, 'mandiri', 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, 'Siti Rahmawati', 'TRPL1A002', 3, 10500000.00, 'mandiri', 'Ahmad Dahlan', NULL, NULL, NULL, NULL),
(3, 'Muhammad Rizky', 'TRPL1A003', 5, 11500000.00, 'mandiri', 'Haryanto', NULL, NULL, NULL, NULL),
(4, 'Dewi Lestari', 'TRPL1A004', 7, 12500000.00, 'mandiri', 'Sutrisno', NULL, NULL, NULL, NULL),
(5, 'Rudi Hartono', 'TRPL1A005', 2, 9800000.00, 'mandiri', 'Slamet Riyadi', NULL, NULL, NULL, NULL),
(6, 'Nina Susanti', 'TRPL1A006', 4, 10800000.00, 'mandiri', 'Agus Salim', NULL, NULL, NULL, NULL),
(7, 'Andi Pratama', 'TRPL1A007', 6, 11800000.00, 'mandiri', 'Darmawan', NULL, NULL, NULL, NULL),
(8, 'Fikri Ramadhan', 'TRPL1A008', 1, 500000.00, 'bidikmisi', 'Samsul Bahri', 'KIP2025001', 850000.00, NULL, 2.75),
(9, 'Rina Anggraini', 'TRPL1A009', 3, 500000.00, 'bidikmisi', 'Mardiono', 'KIP2025002', 850000.00, NULL, 2.80),
(10, 'Irfan Hakim', 'TRPL1A010', 5, 500000.00, 'bidikmisi', 'Sukardi', 'KIP2025003', 850000.00, NULL, 2.85),
(11, 'Dina Melati', 'TRPL1A011', 7, 500000.00, 'bidikmisi', 'Rusdi', 'KIP2025004', 850000.00, NULL, 2.70),
(12, 'Bayu Saputra', 'TRPL1A012', 2, 500000.00, 'bidikmisi', 'Suryanto', 'KIP2025005', 850000.00, NULL, 2.75),
(13, 'Intan Permata', 'TRPL1A013', 4, 500000.00, 'bidikmisi', 'Suparman', 'KIP2025006', 850000.00, NULL, 2.80),
(14, 'Hendra Kusuma', 'TRPL1A014', 6, 500000.00, 'bidikmisi', 'Mustofa', 'KIP2025007', 850000.00, NULL, 2.85),
(15, 'Tiara Puspita', 'TRPL1A015', 1, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.50),
(16, 'Gilang Ramadhan', 'TRPL1A016', 3, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.25),
(17, 'Maya Sari', 'TRPL1A017', 5, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Bank Indonesia', 3.40),
(18, 'Aditya Nugroho', 'TRPL1A018', 7, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Bank Indonesia', 3.30),
(19, 'Lisa Permata', 'TRPL1A019', 2, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.45),
(20, 'Rio Febrian', 'TRPL1A020', 4, 1500000.00, 'prestasi', NULL, NULL, NULL, 'Kemendikbud', 3.35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
