-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 03:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `print-max`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(20) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_access` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_url`, `menu_icon`, `menu_access`) VALUES
(1, 'Dashboard', 'dashboard.php', 'fa-desktop', '1,2,3'),
(2, 'Order', 'order.php', 'fa-shopping-basket', '2,3'),
(3, 'Product', 'product.php', 'fa-archive', '2,3'),
(4, 'User', 'user.php', 'fa-users', '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_thumbnail`, `product_desc`, `product_price`) VALUES
(1, 'Sticker', '30615494943547105.png', 'Sticker', 10000),
(2, 'Banner', '79915494943711940.png', 'Banner', 50000),
(3, 'Tote Bag', '26515494944076369.png', 'Tote Bag', 15000),
(4, 'ID Card', '28415494944266407.png', 'ID Card', 8000),
(5, 'Kartu Nama', '41315494950822787.png', 'Kartu Nama', 800),
(6, 'Kalender', '54815494951062151.png', 'Kalender', 25000),
(7, 'Poster', '19615494952069134.png', 'Poster', 10000),
(8, 'Vertical Banner', '97715494952320568.png', 'Vertical Banner', 50000),
(9, 'Lunch Box', '83715494952801368.png', 'Lunch Box', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `product_size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size_value` varchar(100) NOT NULL,
  `product_size_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_type_value` varchar(255) NOT NULL,
  `product_type_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_desc`) VALUES
(1, 'root', 'root'),
(2, 'Admin', 'Admin'),
(3, 'Staff', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`) VALUES
(1, 'root', 'root@printmax.com', '$2a$12$66HnC3FO/7eyVgXP1Q.Mxe6vte09IGpA267hLbGQv8QuR1MBBCXT2', '1'),
(2, 'Ghina Nur Agsya', 'admin@printmax.com', '$2a$12$pkQXwuulXEGuo4lgp3uFh.99P1GEixLeD8/U44Qi4cmJNl7nfAmKK', '2'),
(3, 'Dejan Soekri Stankovic', 'staff@printmax.com', '$2y$12$Tq2i/tbL.S3MQwKgGRjoNecA5bF991wciI0ag2OQKQPb7kKduyj/K', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`product_size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
