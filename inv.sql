-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 02:48 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `addxs`
--

CREATE TABLE `addxs` (
  `id` int(11) NOT NULL,
  `kodepesanan` varchar(11) NOT NULL,
  `namacustomer` varchar(100) NOT NULL,
  `kodecustomer` varchar(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addxs`
--

INSERT INTO `addxs` (`id`, `kodepesanan`, `namacustomer`, `kodecustomer`, `alamat`, `nohp`) VALUES
(1, 'PS0001', '', '', '', ''),
(2, 'PS0002', '', '', '', ''),
(3, 'PS0003', '', '', '', ''),
(4, 'PS0004', '', '', '', ''),
(5, 'PS0005', 'lim', '', '', ''),
(6, 'PS0006', 'Jesica', '', 'memengan', '087716551224'),
(7, 'PS0007', 'Patrick', '', 'ppk', '3393093'),
(8, 'PS0008', 'Jesica', 'CS0002', 'memengan', '087716551224'),
(9, 'PS0009', 'lim', 'CS0003', 'jkt', '0293'),
(10, 'PS0010', 'Patrick', 'CS0004', 'ppk', '3393093');

-- --------------------------------------------------------

--
-- Table structure for table `addxsy`
--

CREATE TABLE `addxsy` (
  `id` int(11) NOT NULL,
  `kodepesanan` varchar(11) NOT NULL,
  `namacustomer` varchar(100) NOT NULL,
  `kodecustomer` varchar(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addxsy`
--

INSERT INTO `addxsy` (`id`, `kodepesanan`, `namacustomer`, `kodecustomer`, `alamat`, `nohp`) VALUES
(1, 'PS0001', '', '', '', ''),
(2, 'PS0002', '', '', '', ''),
(3, 'PS0003', '', '', '', ''),
(4, 'PS0004', '', '', '', ''),
(5, 'PS0005', 'lim', '', '', ''),
(6, 'PS0006', 'Jesica', '', 'memengan', '087716551224'),
(7, 'PS0007', 'Patrick', '', 'ppk', '3393093'),
(8, 'PS0008', 'Jesica', 'CS0002', 'memengan', '087716551224');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_item` varchar(100) DEFAULT NULL,
  `namaitem` varchar(100) DEFAULT NULL,
  `uom` varchar(100) DEFAULT NULL,
  `hargajual` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_item`, `namaitem`, `uom`, `hargajual`, `photo`) VALUES
(7, 'BR0001', 'Cipenk', 'pcs', '300000', '1570947874070.png');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) UNSIGNED NOT NULL,
  `kodecustomer` varchar(100) DEFAULT NULL,
  `namacustomer` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nohp` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `kodecustomer`, `namacustomer`, `alamat`, `nohp`, `email`, `photo`) VALUES
(7, 'CS0002', 'Jesica', 'memengan', '087716551224', 'prayogabagasx@gmail.com', '1570948660860.png'),
(8, 'CS0003', 'lim', 'jkt', '0293', 'prayogabagasx@gmail.com', '1570949772284.png'),
(9, 'CS0004', 'Patrick', 'ppk', '3393093', 'prayogabagasx@gmail.com', '1570950836576.png');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `id_provinsi`, `nama`) VALUES
(1, 1, 'Bandung'),
(2, 1, 'Sumedang'),
(3, 1, 'Kuningan'),
(4, 1, 'Sukabumi'),
(5, 1, 'Garut'),
(6, 1, 'Tasikmalaya'),
(7, 1, 'Cimahi'),
(8, 1, 'Cirebon'),
(9, 2, 'Tegal'),
(10, 2, 'Surakarta'),
(11, 2, 'Semarang'),
(12, 2, 'Salatiga'),
(13, 2, 'Pekalongan'),
(14, 2, 'Magelang'),
(15, 3, 'Surabaya'),
(16, 3, 'Probolinggo'),
(17, 3, 'Pasuruan'),
(18, 3, 'Mojokerto'),
(19, 3, 'Malang'),
(20, 3, 'Madiun'),
(21, 3, 'Kediri'),
(22, 3, 'Blitar'),
(23, 3, 'Batu');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `namauser` varchar(100) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `username`, `namauser`, `level`, `address`, `dob`, `photo`) VALUES
(1, 'Bacil', 'Bagas', 'admin', 'Sleman', '1998-10-31', '1570883634793.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` int(11) UNSIGNED NOT NULL,
  `kodepesanan` varchar(100) DEFAULT NULL,
  `namapelanggan` varchar(100) DEFAULT NULL,
  `tanggalpesanan` date DEFAULT NULL,
  `hargajual` varchar(200) DEFAULT NULL,
  `jumlah` int(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `kodepesanan`, `namapelanggan`, `tanggalpesanan`, `hargajual`, `jumlah`, `photo`) VALUES
(6, 'P-0002', 'lim', '2019-10-09', '40000', 12, '1570941297401.png'),
(8, 'P-0008', 'Patrick', '2019-11-05', '30999', 343, '1570950863111.png'),
(9, '4353', 'Jesica', '2019-10-28', '34324234', 23, '1570973507872.png'),
(10, '2211', 'Jesica', '2019-10-28', '30.0000', 12, '1570977730765.png');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`) VALUES
(1, 'Jawa Barat'),
(2, 'Jawa Tengah'),
(3, 'Jawa Timur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addxs`
--
ALTER TABLE `addxs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addxsy`
--
ALTER TABLE `addxsy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addxs`
--
ALTER TABLE `addxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `addxsy`
--
ALTER TABLE `addxsy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
