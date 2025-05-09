-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2025 at 06:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servis_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_layanan`
--

CREATE TABLE `detail_layanan` (
  `montir_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `biaya` double NOT NULL,
  `pekerjaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_montir`
--

CREATE TABLE `kategori_montir` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori_montir`
--

INSERT INTO `kategori_montir` (`id`, `nama`) VALUES
(1, 'Kategori A'),
(2, 'Kategori B');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` text NOT NULL,
  `total_biaya` double NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `kode`, `nama`, `deskripsi`, `total_biaya`, `rating`) VALUES
(1, '001', 'Servis Ringan', 'Servis ringan untuk kendaraan', 150000, 5),
(2, '002', 'Servis berkala', 'Servis berkala untuk kendaraan', 300000, 4),
(15, '003', 'Servis Besar', 'wrwrweratew', 200000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id` int(11) NOT NULL,
  `nomor` char(4) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `keahlian` varchar(200) NOT NULL,
  `kategori_montir_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id`, `nomor`, `nama`, `gender`, `tgl_lahir`, `tmp_lahir`, `keahlian`, `kategori_montir_id`) VALUES
(1, '1', 'Jono', 'Laki-laki', '2025-05-19', 'Bogor', 'Servis Besar', 1),
(3, 'M002', 'Supri', 'Laki-laki', '1121-02-21', 'Jakarta', 'Servis Besar', 2),
(4, 'M004', 'Supra', 'Laki-laki', '2133-11-12', 'Bogor', 'Repairing', 2),
(5, 'M005', 'Susi', 'Perempuan', '2000-12-12', 'Bogor', 'Servis Besar', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_layanan`
--
ALTER TABLE `detail_layanan`
  ADD PRIMARY KEY (`montir_id`,`layanan_id`),
  ADD KEY `fk_montir_has_layanan_layanan1_idx` (`layanan_id`),
  ADD KEY `fk_montir_has_layanan_montir1_idx` (`montir_id`);

--
-- Indexes for table `kategori_montir`
--
ALTER TABLE `kategori_montir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_UNIQUE` (`kode`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_UNIQUE` (`nomor`),
  ADD KEY `fk_montir_kategori_montir_idx` (`kategori_montir_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_montir`
--
ALTER TABLE `kategori_montir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_layanan`
--
ALTER TABLE `detail_layanan`
  ADD CONSTRAINT `fk_montir_has_layanan_layanan1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_montir_has_layanan_montir1` FOREIGN KEY (`montir_id`) REFERENCES `montir` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `montir`
--
ALTER TABLE `montir`
  ADD CONSTRAINT `fk_montir_kategori_montir` FOREIGN KEY (`kategori_montir_id`) REFERENCES `kategori_montir` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
