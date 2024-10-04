-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Oct 04, 2024 at 07:56 AM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004-log
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
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_by` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `book_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_by`, `product_name`, `size`, `type`, `total`, `qty`, `status`, `book_date`) VALUES
(1, 'Ghina Nur Agsya', 'Sticker Kromo', '21', 'White', 20000, 4, 4, '2024-08-19'),
(2, 'Raihan Akbar', 'Name Tag Acrylic', '12', '22', 20000, 25, 2, '2024-08-19'),
(7, 'Raihan Akbar', 'Sticker', 'A4', 'Vinyl', 15000, 1, 2, '2024-08-19'),
(14, 'Dejan Soekri', 'Sticker', 'A4', 'Vinyl', 60000, 4, 1, '2024-08-19'),
(15, 'Obim', 'Sticker', 'A4', 'Vinyl', 30000, 2, 4, '2024-09-01'),
(16, 'Obim', 'Sticker', 'A4', 'Vinyl', 30000, 2, 3, '2024-09-01'),
(17, 'Ghina Nur Agsya', 'Sticker', 'A4', 'Doff', 85000, 5, 4, '2024-09-26');

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
(1, 'Dashboard', 'dashboard.php', 'fa-desktop', '2,3'),
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
(1, 'Sticker', '25115510919351937.jpg', 'Sticker', 15000),
(2, 'Medali', '58815510920545613.jpg', 'Medali', 25000),
(3, 'Name Tag Acrylic', '13615510921005517.jpg', 'Name Tag Acrylic', 30000),
(4, 'Sticker Transparent', '49715510921229345.jpg', 'Sticker Transparent', 25000),
(5, 'Sticker Kromo', '68215510921558349.jpg', 'Sticker Kromo', 20000);

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

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `product_id`, `product_size_value`, `product_size_price`) VALUES
(1, 1, 'A4', 0),
(2, 1, 'A3', 5000);

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

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `product_id`, `product_type_value`, `product_type_price`) VALUES
(1, 1, 'Vinyl', 0),
(2, 1, 'Doff', 2000);

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
  `role_id` varchar(2) NOT NULL,
  `user_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `user_status`) VALUES
(1, 'root', 'root@printmax.com', '$2a$12$66HnC3FO/7eyVgXP1Q.Mxe6vte09IGpA267hLbGQv8QuR1MBBCXT2', '1', 'Active'),
(2, 'Ghina Nur Agsya', 'admin@printmax.com', '$2a$12$pkQXwuulXEGuo4lgp3uFh.99P1GEixLeD8/U44Qi4cmJNl7nfAmKK', '2', 'Active'),
(3, 'Dejan Soekri Stankovic', 'staff@printmax.com', '$2y$12$Tq2i/tbL.S3MQwKgGRjoNecA5bF991wciI0ag2OQKQPb7kKduyj/K', '3', 'Active'),
(4, 'Raihan Akbar', 'raihan@printmax.id', '$2a$12$66HnC3FO/7eyVgXP1Q.Mxe6vte09IGpA267hLbGQv8QuR1MBBCXT2', '2', 'Active'),
(7, 'Jhon Doe', 'jhon@printmax.id', '$2y$12$vY3bzGeIlB71Vf7BRP9ahe6Mv09r.SMFuL2jJhUHbr/44UePjd3qG', '3', 'Active'),
(8, 's', 's', '$2y$12$uEsrrZ1DVcb8txnYMAVaTusl7ji.8xkTvbw4KiXNGubA13SX6McXW', '', 'Active'),
(9, 'a', 'a', '$2y$12$0VD6fLz5/XOMI2X8hhVUZucJMKMmw5Mp6rVzXyCyQoR5xRgABAeAm', '', 'Active'),
(10, 'J', 'aos', '$2y$12$PMAacD64na/lZ.da1VeGyuPeOiKPTaONu/4DMq1E.AnDjQ1B2JjnG', '', 'Active'),
(11, 'J', 'aos', '$2y$12$KEt/5zMRzQiL/Ymm6IiPieWF.vLSvidyPE0y6ylO/ZIoYTS2wQnta', '', 'Active'),
(12, 's', 's', '$2y$12$dkKtZNT7.YxSX9tsqSqt/.gDz1irlmK1U7TnAzn/73ycsw6gTxCH6', '3', 'Active'),
(13, 'ss', 'ss', '$2y$12$mj291YF69hYpeia1gRTYQO5T.6CkrTnNCeBehGMRrCdrBYUraxenu', '', 'Active'),
(14, 'ss', 'ss', '$2y$12$cqWCkpl71tYO33rXTzMDf.9zRvYBRxgKz5FDsB4fVZREysdci6YbK', '', 'Active'),
(15, 'ss', 'ss', '$2y$12$9wwEXUEEY4sDGyVkm3Pc1epyvF8ze6.saOnwm2XYsH0BRJ.0XDXuG', '', 'Active'),
(16, 'ss', 'ss', '$2y$12$6gjUMIh6kueTE/HfiDjJ3u8Q3cqxBT0J2FweDr5F1AEtX5xqZ8zx6', '', 'Active'),
(17, 'a', 'a', '$2y$12$9JY7JDIguLfr22Y0z8lHq.9bXirRqxYFl.rmUSL2KJKdqKjwLMhy.', '', 'Active'),
(18, 'Renan', 'renan@printmax.id', '$2y$12$goRwEJHybLqU4Zgc40hpk.5Xhe0F8Osq6Ky/fhksJVVOnrX1AgQLm', '2', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
