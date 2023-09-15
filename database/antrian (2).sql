-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2023 at 04:01 AM
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
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_antrian`
--

CREATE TABLE `jenis_antrian` (
  `id` int NOT NULL,
  `nama_antrian` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_loket` int NOT NULL,
  `id_layanan` int NOT NULL,
  `id_nomor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `nama_layanan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_layanan` char(2) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id` int NOT NULL,
  `penjaga` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_loket` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_loket` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nomor_antrian`
--

CREATE TABLE `nomor_antrian` (
  `id` int NOT NULL,
  `nomor_antrian` varchar(50) NOT NULL,
  `kode_antrian` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cs'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `role`) VALUES
('alin', 'arlyne', '$2y$10$2GU8sBNKDJQopfMsyhcjneIeTgd6bzzeZv.7pzKAxLhDPcBJKQFkC', 'Admin'),
('manda', 'amanda', '12345', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_antrian`
--
ALTER TABLE `jenis_antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_loket` (`id_loket`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_nomor` (`id_nomor`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_antrian`
--
ALTER TABLE `jenis_antrian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nomor_antrian`
--
ALTER TABLE `nomor_antrian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jenis_antrian`
--
ALTER TABLE `jenis_antrian`
  ADD CONSTRAINT `jenis_antrian_ibfk_1` FOREIGN KEY (`id_loket`) REFERENCES `loket` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jenis_antrian_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jenis_antrian_ibfk_3` FOREIGN KEY (`id_nomor`) REFERENCES `nomor_antrian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
