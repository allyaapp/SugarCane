-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 02:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `role` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetail`
--

INSERT INTO `admindetail` (`id_admin`, `fullname`, `no_hp`, `alamat`, `username`, `password`, `role`, `foto`) VALUES
(1, 'Vasyilla Kautsar', '089665566774', 'Jember', 'syilla', 'syilla', 1, 'girl.png'),
(3, 'Naila Khansa', '081273819287', 'Bintoro', 'naila', 'naila', 2, 'profile.png'),
(4, 'Dzikri Abyudzaky', '086787975678', 'Jember', 'dzikri', 'asdfghjk', 2, 'man.png'),
(10, 'Ajeng Tias', '083423726272', 'Bondowoso', 'ajeng', 'ajeng', 1, 'boy.png');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `varian` enum('Chocolate','Strawberry','VanillaOreo') NOT NULL,
  `ukuran` enum('Mini','Jumbo') NOT NULL,
  `id_detailukuran` varchar(2) NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `varian`, `ukuran`, `id_detailukuran`, `stok`, `gambar`) VALUES
(1, 'Chocolate', 'Mini', 'M1', 32, 'chocolate-mini.jpg'),
(2, 'Strawberry', 'Mini', 'M3', 19, 'strawberry-mini.jpg');

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
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subharga` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_transaksi`, `id_barang`, `qty`, `subharga`) VALUES
(20, 1, 1, 3, 9000.00),
(21, 2, 2, 1, 5000.00),
(22, 2, 1, 1, 3000.00),
(23, 3, 2, 4, 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `ongkir` double(11,2) NOT NULL,
  `totalharga` int(7) NOT NULL,
  `status` enum('Proses','Diterima') NOT NULL DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgltransaksi`, `ongkir`, `totalharga`, `status`) VALUES
(1, 22, '2021-12-29', 9000.00, 18000, 'Diterima'),
(2, 23, '2021-12-29', 6000.00, 14000, 'Diterima'),
(3, 17, '2021-12-29', 12000.00, 38000, 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `alamat`, `no_hp`, `username`, `password`, `foto`, `longitude`, `latitude`) VALUES
(17, 'Hani', 'Jember', '081273819287', 'hani', 'hani', 'girl-wavy.png', '7.892588', '113.8802083'),
(22, 'Allya', 'Jember', '082937182938', 'allya', 'allya', 'girl-curly.png', '0', '0'),
(23, 'Dwiki', 'Mojokerto', '082937182938', 'dwiki', 'dwiki', 'boy-blue.png', '0', '0'),
(26, 'Oong', 'Bondowoso', '085331053300', 'oong', 'oong', 'boy-green.png', '0', '0'),
(28, 'Nanda Arsya', 'user', '081423716212', 'nanda', 'user', 'girl-green.png', '', ''),
(29, 'Jay', 'Seoul', '081625172819', 'jay', 'jay', 'IMG_20200704_092320.jpg', '', ''),
(30, 'Dzikri Abyudzaky', 'Jember', '0864534567788', 'dzikri', 'dzikri', 'ERD.drawio (1).png', '', '');

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
-- Indexes for table `detailukuran`
--
ALTER TABLE `detailukuran`
  ADD PRIMARY KEY (`id_detailukuran`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_detailukuran`) REFERENCES `detailukuran` (`id_detailukuran`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
