-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2021 at 11:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugarcane`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetail`
--

CREATE TABLE `admindetail` (
  `id_admin` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetail`
--

INSERT INTO `admindetail` (`id_admin`, `fullname`, `no_hp`, `alamat`, `username`, `password`, `role`) VALUES
(1, 'Vasyilla Kautsar', '089665566774', 'Jember', 'syilla', 'syilla', 1),
(2, 'Nanda Arsya', '081251728192', 'Jl.Manggar Gg. Tugu', 'dzikri', 'dzikri', 1),
(3, 'Sofia Ufaira', '088898765676', 'dfahgfkjad', 'sofia', 'sofia', 2),
(4, 'Dzikri Abyudzaky', '088821345162', 'jfkjafkfkaj', 'dzikri', 'dzikri', 2),
(6, 'Naila Khansa', '083718371928', 'gldghsdlghsdgl', 'naila', 'naila', 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `varian` enum('Chocolate','Strawberry','VanillaOreo','') NOT NULL,
  `ukuran` enum('Mini','Jumbo') NOT NULL,
  `id_detailukuran` varchar(2) NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `varian`, `ukuran`, `id_detailukuran`, `stok`) VALUES
(1, 'Chocolate', 'Mini', 'M1', 100),
(2, 'Chocolate', 'Mini', 'M2', 75),
(11, 'Chocolate', 'Jumbo', 'J1', 50);

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `id_detailtransaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`id_detailtransaksi`, `id_user`, `id_barang`, `qty`) VALUES
(1, 4, 1, 4),
(2, 3, 11, 5),
(5, 1, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detailukuran`
--

CREATE TABLE `detailukuran` (
  `id_detailukuran` varchar(2) NOT NULL,
  `varianukuran` varchar(5) NOT NULL,
  `harga` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailukuran`
--

INSERT INTO `detailukuran` (`id_detailukuran`, `varianukuran`, `harga`) VALUES
('J1', '8 oz', 8000),
('J2', '12 oz', 10000),
('J3', '16 oz', 18000),
('J4', '26 oz', 28000),
('J5', '30 oz', 30000),
('M1', '2 oz', 3000),
('M2', '4 oz', 4000),
('M3', '5 oz', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `id_detailtransaksi` int(5) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `total` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_detailtransaksi`, `tgltransaksi`, `total`) VALUES
(1, 1, '2021-06-16', '25000'),
(2, 2, '2021-11-28', '30000'),
(3, 5, '2021-11-28', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `alamat`, `no_hp`, `username`, `password`) VALUES
(1, 'Nur Allya', 'Bali', '081234567898', 'allya', 'allya'),
(3, 'Hani', 'Bali', '081234567812', 'hani', 'hani'),
(4, 'Ajeng', 'Bondowoso', '081273819287', 'ajeng', 'ajeng'),
(6, 'Dwiki', 'Situbondo', '082638192739', 'dwiki', 'dwiki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetail`
--
ALTER TABLE `admindetail`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_detailbarang` (`id_detailukuran`),
  ADD KEY `id_detailukuran` (`id_detailukuran`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`id_detailtransaksi`),
  ADD KEY `id_user` (`id_user`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detailukuran`
--
ALTER TABLE `detailukuran`
  ADD PRIMARY KEY (`id_detailukuran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_detailpesanan` (`id_detailtransaksi`),
  ADD KEY `id_detailtransaksi` (`id_detailtransaksi`),
  ADD KEY `id_detailtransaksi_2` (`id_detailtransaksi`),
  ADD KEY `id_detailtransaksi_3` (`id_detailtransaksi`),
  ADD KEY `id_detailtransaksi_4` (`id_detailtransaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetail`
--
ALTER TABLE `admindetail`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_detailukuran`) REFERENCES `detailukuran` (`id_detailukuran`);

--
-- Constraints for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `detailtransaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `detailtransaksi_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_detailtransaksi`) REFERENCES `detailtransaksi` (`id_detailtransaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
