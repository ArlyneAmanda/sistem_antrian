-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2023 at 06:56 AM
-- Server version: 8.0.30
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int NOT NULL,
  `id_layanan` int NOT NULL,
  `nomor_antrian` int NOT NULL,
  `called` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `id_layanan`, `nomor_antrian`, `called`) VALUES
(1, 50, 1, '1'),
(2, 50, 2, '1'),
(3, 50, 3, '1'),
(4, 50, 4, '1'),
(5, 50, 5, '1'),
(6, 50, 6, '1'),
(7, 54, 1, '1'),
(8, 54, 2, '1'),
(9, 54, 3, '1'),
(10, 54, 4, '1'),
(11, 54, 5, '1'),
(12, 50, 7, '0');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `nama_layanan` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_layanan` char(2) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `kode_layanan`) VALUES
(50, 'Catatan Sipil', 'A'),
(53, 'IKAN BILIS', 'T'),
(54, 'Bodol', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id` int NOT NULL,
  `nama_loket` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `id_layanan` int NOT NULL,
  `petugas` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id`, `nama_loket`, `id_layanan`, `petugas`) VALUES
(13, 'Loket 1', 50, '123'),
(14, 'Loket 2', 54, 'Bai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CS,Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `role`) VALUES
('123', 'Rendi Hermansyah', '$2y$10$2rRdyZ.PnxLBxcs3F9t3QO5infnzZQcOLeqDqbUjqYqEO3JvZid.K', 'Admin'),
('admin', 'admin', '$2y$10$vSoujZ60hQJhSy/YbfYK3.ULReZJOJPDbh1BjpqhabovPd0fsIad.', 'Admin'),
('Bai', 'baim', '$2y$10$gnW0OYOCkYeoueWR/2/WQucs3nEe972b4ewnP6l3n81.ynC5Lwlxa', 'CS'),
('Udin', 'udin cukin', '$2y$10$3FkK6s8cyVa61UM.B4O2p.qnOJT8QFklXHUeTiH1b4C1Ip/xBWCaO', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas` (`petugas`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loket`
--
ALTER TABLE `loket`
  ADD CONSTRAINT `loket_ibfk_1` FOREIGN KEY (`petugas`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `loket_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
