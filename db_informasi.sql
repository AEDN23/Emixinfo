-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2025 at 03:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_informasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_coa` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `nama_coa`, `departemen`, `keterangan`, `approved`, `status`, `file`, `active`, `video`) VALUES
('COA-001', 'HONEYWELL 20250730165441416_0001', 'Quality & Planning', '20250730165441416_0001', '', '2025', 'pdfCOA-001.pdf', 'Aktif', 'video-COA-001.');

-- --------------------------------------------------------

--
-- Table structure for table `msds`
--

CREATE TABLE `msds` (
  `id_msds` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_msds` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `std`
--

CREATE TABLE `std` (
  `id_dokumen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `std`
--

INSERT INTO `std` (`id_dokumen`, `nama`, `departemen`, `keterangan`, `approved`, `status`, `file`, `active`, `video`) VALUES
('SD-TEC-24-01 ', 'SD-TEC-24-01 Treatment of Expired Raw Material', 'Quality & Planning', 'SD-TEC-24-01 Treatment of Expired Raw Material', '', '2021', 'pdfSD-TEC-24-01 .pdf', 'Aktif', 'video-SD-TEC-24-01 .'),
('SD-TEC-29-00 ', 'Judgment Criteria for Mixing Chart ', 'Quality & Planning', 'Mixing Chart ', '', '2018', 'pdfSD-TEC-29-00 .pdf', 'Aktif', 'video-SD-TEC-29-00 .');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `wi`
--

CREATE TABLE `wi` (
  `id_dokumen` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `departemen` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approved` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `active` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `video` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `wi`
--

INSERT INTO `wi` (`id_dokumen`, `nama`, `departemen`, `keterangan`, `approved`, `status`, `file`, `active`, `video`) VALUES
('A1', 'PETUNUK PENGGUNAAN SISTEM DIGITAL DOKUMEN', 'PGA IT', 'SISTEM DIGITAL DOKUMEN', '', '2025', 'pdfA1.pdf', 'Aktif', 'video-A1.'),
('WI-HSE-05-00 ', 'Tools Handling Mengangkat) Compound Di atas BOM', 'HSE', 'HSE ', '', '2025', 'pdfWI-HSE-05-00 .pdf', 'Aktif', 'video-WI-HSE-05-00 .'),
('WI-ITE-11', 'WI-ITE-11 PERGANTIAN TONER MESIN FOTO COPY', 'PGA IT', 'PERGANTIAN TONER & PENANGANAN CECERAN', '', '2024', 'pdfWI-ITE-11.pdf', 'Aktif', 'video-WI-ITE-11.'),
('WI-ITE-13-00 ', 'PETUNJUK MENYAMBUNGKAN PERANGKAT KE INFOCUS RUANG TRAINING', 'PGA IT', 'WI MENYAMBUNGKAN PERANGKAT KE INFOCUS RUANG TRAINING', '', '2025', 'pdfWI-ITE-13-00 .pdf', 'Aktif', 'video-WI-ITE-13-00 .mp4'),
('WI-PGA-48-01 ', 'PENGOPERASIAN MESIN AIR LIMBAH', 'PGA IT', 'WWTP', '', '2021', 'pdfWI-PGA-48-01 .pdf', 'Aktif', 'video-WI-PGA-48-01 .'),
('WI-PRD-08-04 ', 'Petunjuk Kerja Process Under Roll', 'Production', 'Petunjuk Kerja Process Under Roll', '', '2025', 'pdfWI-PRD-08-04 .pdf', 'Aktif', 'video-WI-PRD-08-04 .'),
('WI-PUR-24-07 ', 'Petunjuk Kerja Proses Penggabungan Finish Good untuk Delivery', 'Purchasing Logistic', 'Proses Penggabungan Finish Good untuk Delivery', '', '2025', 'pdfWI-PUR-24-07 .pdf', 'Aktif', 'video-WI-PUR-24-07 .'),
('WI-TEC', 'Mooney', 'Quality & Planning', 'Mooney', '', '2021', 'pdfWI-TEC.', 'Aktif', 'video-WI-TEC.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id_coa`) USING BTREE;

--
-- Indexes for table `msds`
--
ALTER TABLE `msds`
  ADD PRIMARY KEY (`id_msds`) USING BTREE;

--
-- Indexes for table `std`
--
ALTER TABLE `std`
  ADD PRIMARY KEY (`id_dokumen`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `wi`
--
ALTER TABLE `wi`
  ADD PRIMARY KEY (`id_dokumen`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
