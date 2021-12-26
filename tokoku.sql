-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 07:59 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoku`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `netto` varchar(16) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `hargaKulak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `netto`, `stok`, `harga`, `hargaKulak`) VALUES
(1, 'Pantene', '100 ml', 0, 18000, 0),
(2, 'Pepsodent', '12 gr', 4, 8000, 0),
(4, 'lifebouy', '100 ml', 7, 11000, 0),
(5, 'close up', '100 ml', 80, 10000, 0),
(6, 'tango', '100 gr', 10, 8000, 0),
(13, 'Pepsodent', '12 gr', 0, 0, 0),
(14, 'sinzui', '12 gr', 0, 12000, 0),
(15, 'giv', '12 gr', 4, 4000, 0),
(16, 'daia', '50 gr', 0, 4000, 0),
(17, 'soklin', '100 ml', 8, 12000, 10000),
(18, 'baygon cair', '100 ml', 0, 12000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `idBarang` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `netto` varchar(32) NOT NULL,
  `jmlPenyesuaian` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `user` varchar(32) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `idBarang`, `nama`, `netto`, `jmlPenyesuaian`, `keterangan`, `user`, `tanggal`) VALUES
(22, 4, 'lifebouy', '100 ml', 2, 'ddf', 'moham', '2021-12-21 13:07:31'),
(23, 2, 'Pepsodent', '12 gr', 12, 'kulak brooo', 'moham', '2021-12-21 13:09:31'),
(24, 6, 'tango', '100 gr', 3, 'dahlah', 'moham', '2021-12-21 13:09:51'),
(25, 5, 'close up', '100 ml', 2, 'kntl', 'moham', '2021-12-21 13:10:18'),
(26, 4, 'lifebouy', '100 ml', 2, 'bisaaa', 'moham', '2021-12-21 13:11:21'),
(27, 5, 'close up', '100 ml', 1, 'dohkah', 'moham', '2021-12-21 13:11:56'),
(28, 1, 'Pantene', '100 ml', 10, 'kulak dong', 'moham', '2021-12-21 13:20:10'),
(29, 1, 'Pantene', '100 ml', 3, 'kulak lagi dong broo', 'moham', '2021-12-21 13:20:44'),
(30, 1, 'Pantene', '100 ml', 3, 'ss', 'moham', '2021-12-21 13:23:06'),
(31, 1, 'Pantene', '100 ml', 3, 'kulak dong', 'moham', '2021-12-21 15:03:17'),
(32, 1, 'Pantene', '100 ml', 3, 'taoh', 'moham', '2021-12-21 15:04:26'),
(33, 1, 'Pantene', '100 ml', 3, 'gg', 'moham', '2021-12-21 15:05:30'),
(34, 1, 'Pantene', '100 ml', -10, 'salah brooo', 'moham', '2021-12-21 15:05:59'),
(35, 2, 'Pepsodent', '12 gr', 10, 'tess', 'moham', '2021-12-21 15:09:58'),
(36, 2, 'Pepsodent', '12 gr', -19, 'salah bro', 'moham', '2021-12-21 15:10:32'),
(37, 15, 'giv', '12 gr', 10, 'kulakan', 'moham dong', '2021-12-26 00:49:45'),
(38, 17, 'soklin', '100 ml', 10, 'kulak', 'moham dong', '2021-12-26 00:58:51'),
(39, 4, 'lifebouy', '100 ml', 10, 'kulak', 'Edo (admin)', '2021-12-26 12:05:12'),
(40, 2, 'Pepsodent', '12 gr', 5, 'kulak', 'Edo (admin)', '2021-12-26 12:05:23'),
(41, 5, 'close up', '100 ml', 100, 'KULAKAN', 'Edo (admin)', '2021-12-26 12:08:09'),
(42, 5, 'close up', '100 ml', -150, 'SALAH INPUT', 'Edo (admin)', '2021-12-26 12:08:58'),
(43, 5, 'close up', '100 ml', 50, 'KELIRU', 'Edo (admin)', '2021-12-26 12:09:42'),
(44, 6, 'tango', '100 gr', 10, 'KULAKAN', 'Edo (admin)', '2021-12-26 12:10:41'),
(45, 5, 'close up', '100 ml', 100, 'KULAKAN', 'Edo (admin)', '2021-12-26 12:12:59'),
(46, 5, 'close up', '100 ml', -20, 'SALAH INPUT', 'Edo (admin)', '2021-12-26 12:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `idBarang` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `netto` varchar(32) NOT NULL,
  `harga` int(11) NOT NULL,
  `hargaKulak` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `idBarang`, `nama`, `netto`, `harga`, `hargaKulak`, `jumlah`, `tanggal`, `user`) VALUES
(1, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-24 02:08:20', 'moham'),
(2, 2, 'Pepsodent', '12 gr', 8000, 0, 1, '2021-12-24 02:08:20', 'moham'),
(3, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-24 15:09:25', 'moham'),
(4, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-24 22:23:47', 'moham'),
(5, 2, 'Pepsodent', '12 gr', 8000, 0, 2, '2021-12-24 22:23:48', 'moham'),
(6, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-24 22:26:20', 'moham'),
(7, 2, 'Pepsodent', '12 gr', 8000, 0, 3, '2021-12-24 22:26:20', 'moham'),
(8, 2, 'Pepsodent', '12 gr', 8000, 0, 1, '2021-12-24 23:13:17', 'moham'),
(9, 2, 'Pepsodent', '12 gr', 8000, 0, 1, '2021-12-24 23:13:52', 'moham'),
(10, 2, 'Pepsodent', '12 gr', 8000, 0, 1, '2021-12-25 12:32:48', 'moham'),
(11, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-25 12:33:07', 'moham'),
(12, 15, 'giv', '12 gr', 4000, 0, 5, '2021-12-26 00:50:17', 'moham dong'),
(13, 1, 'Pantene', '100 ml', 18000, 0, 1, '2021-12-26 00:50:17', 'moham dong'),
(14, 2, 'Pepsodent', '12 gr', 8000, 0, 1, '2021-12-26 00:50:17', 'moham dong'),
(15, 15, 'giv', '12 gr', 4000, 0, 1, '2021-12-26 00:52:05', 'moham dong'),
(16, 17, 'soklin', '100 ml', 12000, 10000, 2, '2021-12-26 00:59:04', 'moham dong'),
(17, 2, 'Pepsodent', '12 gr', 8000, 0, 2, '2021-12-26 12:07:14', 'Edo (admin)'),
(18, 4, 'lifebouy', '100 ml', 11000, 0, 3, '2021-12-26 12:07:14', 'Edo (admin)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `rule`) VALUES
(6, 'Edo (admin)', '$2y$10$/lqrqVKWZ5phpou8NBecrOT9uAKDqyDQFJ9R56GnbHazsKBnwp06u', 1),
(7, 'ani (Karyawan)', '$2y$10$Do5c0LzDqnO5z45g2SMAhOG5iwfh8XFNoBdhdPux2A3aVCb.VacG.', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
