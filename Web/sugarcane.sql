-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 04:38 PM
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
  `role` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admindetail`
--

INSERT INTO `admindetail` (`id_admin`, `fullname`, `no_hp`, `alamat`, `username`, `password`, `role`, `foto`) VALUES
(1, 'Vasyilla Kautsar', '089665566774', 'Jl.Kasuari', 'syilla', 'syilla', 1, 'images/admin/girl.png'),
(2, 'Nanda Arsya', '081251728192', 'Jl.Manggar Gg. Tugu', 'dzikri', 'dzikri', 1, 'images/user.png'),
(3, 'Sofia Ufaira', '088898765676', 'Jl.Anggur', 'sofia', 'sofia', 2, 'images/admin/boy.png'),
(4, 'Dzikri Abyudzaky', '088821345162', 'Jl.Bungur', 'dzikri', 'dzikri', 2, 'images/admin/man.png'),
(6, 'Naila Khansa', '083718371928', 'Jl.Branjangan', 'naila', 'naila', 2, 'images/admin/profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `varian` enum('Chocolate','Strawberry','VanillaOreo','') NOT NULL,
  `ukuran` enum('Mini','Jumbo') NOT NULL,
  `id_detailukuran` varchar(2) NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `varian`, `ukuran`, `id_detailukuran`, `stok`, `gambar`) VALUES
(1, 'Chocolate', 'Mini', 'M1', 100, 'images/product/chocolate-mini.jpg'),
(2, 'Chocolate', 'Mini', 'M2', 75, 'images/product/chocolate-mini.jpg'),
(12, 'Chocolate', 'Mini', 'M3', 21, 'images/product/chocolate-mini.jpg'),
(13, 'Chocolate', 'Jumbo', 'J1', 42, 'images/product/chocolate-jumbo.jpg'),
(14, 'Chocolate', 'Jumbo', 'J2', 82, 'images/product/chocolate-jumbo.jpg'),
(16, 'Chocolate', 'Jumbo', 'J3', 82, 'images/product/chocolate-jumbo.jpg'),
(17, 'Chocolate', 'Jumbo', 'J4', 26, 'images/product/chocolate-jumbo.jpg'),
(18, 'Chocolate', 'Jumbo', 'J5', 21, 'images/product/chocolate-jumbo.jpg'),
(19, 'Strawberry', 'Mini', 'M1', 21, 'images/product/strawberry-mini.jpg'),
(20, 'Strawberry', 'Mini', 'M2', 42, 'images/product/strawberry-mini.jpg'),
(21, 'Strawberry', 'Mini', 'M3', 82, 'images/product/strawberry-mini.jpg'),
(22, 'Strawberry', 'Jumbo', 'J1', 88, 'images/product/strawberry-jumbo.jpg'),
(23, 'Strawberry', 'Jumbo', 'J2', 38, 'images/product/strawberry-jumbo.jpg'),
(24, 'Strawberry', 'Jumbo', 'J3', 82, 'images/product/strawberry-jumbo.jpg'),
(25, 'Strawberry', 'Jumbo', 'J4', 62, 'images/product/strawberry-jumbo.jpg'),
(26, 'Strawberry', 'Jumbo', 'J5', 33, 'images/product/strawberry-jumbo.jpg'),
(27, 'VanillaOreo', 'Mini', 'M1', 44, 'images/product/vanillaoreo-mini.jpg'),
(28, 'VanillaOreo', 'Mini', 'M2', 94, 'images/product/vanillaoreo-mini.jpg'),
(29, 'VanillaOreo', 'Mini', 'M3', 14, 'images/product/vanillaoreo-mini.jpg'),
(30, 'VanillaOreo', 'Jumbo', 'J1', 84, 'images/product/vanillaoreo-jumbo.jpg'),
(31, 'VanillaOreo', 'Jumbo', 'J2', 44, 'images/product/vanillaoreo-jumbo.jpg'),
(32, 'VanillaOreo', 'Jumbo', 'J3', 27, 'images/product/vanillaoreo-jumbo.jpg'),
(33, 'VanillaOreo', 'Jumbo', 'J4', 16, 'images/product/vanillaoreo-jumbo.jpg'),
(34, 'VanillaOreo', 'Jumbo', 'J5', 48, 'images/product/vanillaoreo-jumbo.jpg');

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
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_transaksi`, `id_barang`, `qty`, `subharga`) VALUES
(1, 1, 1, 4, 10000),
(2, 1, 18, 4, 15000),
(3, 2, 12, 4, 70000),
(4, 2, 20, 4, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `totalharga` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgltransaksi`, `totalharga`) VALUES
(1, 7, '2021-11-02', 25000),
(2, 3, '2021-11-03', 88000);

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
  `password` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `alamat`, `no_hp`, `username`, `password`, `foto`) VALUES
(1, 'Nur Allya', 'Bali', '081234567898', 'allya', 'allya', ''),
(3, 'Hani', 'Bali', '081234567812', 'hani', 'hani', ''),
(4, 'Ajeng', 'Bondowoso', '081273819287', 'ajeng', 'ajeng', ''),
(6, 'Dwiki', 'Situbondo', '082638192739', 'dwiki', 'dwiki', ''),
(7, 'Bornin', 'Jember', '0982716273829', 'bornin', 'bornin', '');

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
