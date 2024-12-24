-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 03:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banjar_buah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$DmvSLAqgGtiD98PTwPGx0.Y854l4Wcp22jGLjlKFtG63wVfBO1wBK');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah_beli` decimal(10,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `product_id`, `jumlah_beli`, `total_harga`, `tanggal`) VALUES
(1, 4, 2.00, 24000.00, '2024-12-11'),
(2, 2, 2.00, 50000.00, '2024-12-11'),
(3, 3, 1.00, 15000.00, '2024-12-11'),
(4, 3, 1.00, 15000.00, '2024-12-11'),
(5, 3, 1.50, 15000.00, '2024-12-12'),
(6, 3, 1.50, 15000.00, '2024-12-12'),
(7, 4, 1.50, 18000.00, '2024-12-12'),
(8, 3, 1.50, 15000.00, '2024-12-12'),
(9, 27, 1.50, 150000.00, '2024-12-12'),
(10, 28, 1.50, 90000.00, '2024-12-12'),
(11, 29, 1.50, 60000.00, '2024-12-12'),
(12, 12, 1.00, 30000.00, '2024-12-12'),
(14, 27, 2.00, 200000.00, '2024-12-16'),
(15, 20, 2.00, 140000.00, '2024-12-16'),
(16, 2, 1.75, 35000.00, '2024-12-18'),
(17, 8, 10.00, 400000.00, '2024-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `produk_buah`
--

CREATE TABLE `produk_buah` (
  `id` int(11) NOT NULL,
  `nama_buah` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` decimal(10,2) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_buah`
--

INSERT INTO `produk_buah` (`id`, `nama_buah`, `harga`, `stok`, `gambar`) VALUES
(2, 'Melon', 20000.00, 13.25, 'melon.jpg'),
(3, 'Semangka', 10000.00, 15.00, 'semangka.jpg'),
(4, 'Pepaya', 12000.00, 16.50, 'pepaya.jpg'),
(5, 'Salak', 13000.00, 20.00, 'salak.jpg'),
(6, 'Pisang Sunpride', 20000.00, 15.50, 'pisang.jpg'),
(7, 'Pisang Medan', 25000.00, 30.00, 'pisang medan.jpg'),
(8, 'Klengkeng', 40000.00, 30.50, 'klengkeng.jpg'),
(9, 'Naga Merah', 18000.00, 17.00, 'naga merah.jpg'),
(10, 'Alpukat', 40000.00, 23.00, 'alpukat.jpg'),
(11, 'Nanas', 25000.00, 13.50, 'nanas.jpg'),
(12, 'Jeruk Medan', 30000.00, 20.00, 'jeruk medan.jpg'),
(13, 'Jeruk Shantang Daun', 40000.00, 20.00, 'jeruk shantang daun.jpg'),
(14, 'Jeruk Shantang Madu', 45000.00, 15.00, 'jeruk shantang madu.jpg'),
(15, 'Jeruk Sunkist', 40000.00, 12.00, 'jeruk sunkist.jpg'),
(16, 'Lemon', 30000.00, 17.00, 'lemon.jpg'),
(17, 'Apel Fuji Biasa', 45000.00, 13.00, 'apel fuji.jpg'),
(18, 'Apel Fuji Whangsan', 65000.00, 21.50, 'apel whangsan.jpg'),
(19, 'Apel Merah', 60000.00, 16.00, 'apel merah.jpg'),
(20, 'Apel Envy New Zealand ', 70000.00, 4.00, 'apel envy new zealand.jpg'),
(21, 'Pear Madu', 35000.00, 25.00, 'pir madu.jpg'),
(22, 'Pear Century ', 28000.00, 20.00, 'pir century.jpg'),
(23, 'Pear Golden', 45000.00, 13.00, 'pir golden.jpg'),
(24, 'Pear Korea', 65000.00, 7.00, 'pir korea.jpg'),
(25, 'Pear Jambu', 45000.00, 18.00, 'pir jambu.jpg'),
(26, 'Pear Xianglie', 55000.00, 12.00, 'pir xianglae.jpg'),
(27, 'Anggur Hitam USA', 100000.00, 6.50, 'anggur hitam usa.jpg'),
(28, 'Anggur Merah Redglobe', 60000.00, 9.50, 'anggur merah redglobe.jpg'),
(29, 'Anggur Muscat', 40000.00, 14.50, 'anggur muscat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `produk_buah`
--
ALTER TABLE `produk_buah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk_buah`
--
ALTER TABLE `produk_buah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `produk_buah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
