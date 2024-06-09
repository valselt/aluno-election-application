-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 04:54 PM
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
-- Database: `pemilu`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_suara`
--

CREATE TABLE `hasil_suara` (
  `record_suara` char(10) NOT NULL,
  `nim` int(15) DEFAULT NULL,
  `id_tps` int(10) DEFAULT NULL,
  `id_kandidat` char(10) DEFAULT NULL,
  `id_pemilu` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_suara`
--

INSERT INTO `hasil_suara` (`record_suara`, `nim`, `id_tps`, `id_kandidat`, `id_pemilu`) VALUES
('02c021b01a', 4611422, 1012, '03', '85283b2b16'),
('1e56181cdf', 4611422, 1011, '01', 'e77c94c87c'),
('55f85d5b6c', 4611422, 1012, '03', 'b204d0ba73'),
('821f802206', 4611422, 1011, '01', 'a5cda4157a'),
('c7382c0634', 4611422, 1011, '02', '44aca20ee8'),
('e0b3812a0f', 4611422, 1011, '01', 'b269ca8dde');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` char(10) NOT NULL,
  `nama_kandidat` varchar(20) NOT NULL,
  `visi` varchar(100) NOT NULL,
  `misi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama_kandidat`, `visi`, `misi`) VALUES
('01', 'Lucius', 'Makan enak', 'Tidur enak'),
('02', 'Julius', 'Hidup sehat', '5 sempurna'),
('03', 'Noro', 'Belajar', 'Yang rajin');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `NIM` int(15) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`NIM`, `nama_mahasiswa`, `tgl_lahir`) VALUES
(4611422, 'Ivan', '2004-12-07'),
(4611423, 'Aksa Hermawan', '2003-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `pemilu`
--

CREATE TABLE `pemilu` (
  `id_pemilu` char(10) NOT NULL,
  `nama_pemilu` varchar(50) NOT NULL,
  `tgl_pemilu` date NOT NULL,
  `id_kandidat` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilu`
--

INSERT INTO `pemilu` (`id_pemilu`, `nama_pemilu`, `tgl_pemilu`, `id_kandidat`) VALUES
('44aca20ee8', 'Pemilu1', '2023-12-06', '02'),
('85283b2b16', 'Pemilu1', '2023-12-29', '03'),
('a5cda4157a', 'Pemilu1', '2023-12-26', '01'),
('b204d0ba73', 'Pemilu1', '2023-12-24', '03'),
('b269ca8dde', 'Pemilu1', '2023-12-01', '01'),
('e77c94c87c', 'Pemilu1', '2023-11-27', '01');

-- --------------------------------------------------------

--
-- Table structure for table `tps`
--

CREATE TABLE `tps` (
  `id_tps` int(10) NOT NULL,
  `pj_tps` varchar(50) NOT NULL,
  `tempat_tps` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tps`
--

INSERT INTO `tps` (`id_tps`, `pj_tps`, `tempat_tps`) VALUES
(1011, 'Djarotina', 'Gang Kenanga'),
(1012, 'Limatika', 'Gang Mangga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_suara`
--
ALTER TABLE `hasil_suara`
  ADD PRIMARY KEY (`record_suara`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_tps` (`id_tps`),
  ADD KEY `id_kandidat` (`id_kandidat`),
  ADD KEY `id_pemilu` (`id_pemilu`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `pemilu`
--
ALTER TABLE `pemilu`
  ADD PRIMARY KEY (`id_pemilu`),
  ADD KEY `id_kandidat_pemilu` (`id_kandidat`);

--
-- Indexes for table `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id_tps`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_suara`
--
ALTER TABLE `hasil_suara`
  ADD CONSTRAINT `hasil_suara_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pemilih` (`NIM`),
  ADD CONSTRAINT `hasil_suara_ibfk_2` FOREIGN KEY (`id_tps`) REFERENCES `tps` (`id_tps`),
  ADD CONSTRAINT `hasil_suara_ibfk_4` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`),
  ADD CONSTRAINT `hasil_suara_ibfk_5` FOREIGN KEY (`id_pemilu`) REFERENCES `pemilu` (`id_pemilu`);

--
-- Constraints for table `pemilu`
--
ALTER TABLE `pemilu`
  ADD CONSTRAINT `pemilu_ibfk_1` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
