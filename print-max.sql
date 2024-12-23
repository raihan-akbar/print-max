-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
<<<<<<< Updated upstream
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 11:19 AM
-- Server version: 10.4.27-MariaDB
=======
-- Host: mysql
-- Generation Time: Dec 23, 2024 at 09:17 AM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004-log
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
(1, 'Ghina Nur Agsya', 'Sticker Kromo', '21', 'White', 20000, 4, 1, '2024-09-28'),
(2, 'Raihan Akbar', 'Name Tag Acrylic', '12', '22', 20000, 25, 1, '2024-09-15'),
(7, 'Raihan Akbar', 'Sticker', 'A4', 'Vinyl', 15000, 1, 2, '2024-09-13'),
(14, 'Dejan Soekri', 'Sticker', 'A4', 'Vinyl', 60000, 4, 1, '2024-09-02'),
(15, 'Obim', 'Sticker', 'A4', 'Vinyl', 30000, 2, 2, '2024-09-01'),
(16, 'Obim', 'Sticker', 'A4', 'Vinyl', 30000, 2, 3, '2024-10-01'),
(17, 'Ghina Nur Agsya', 'Sticker', 'A4', 'Doff', 85000, 5, 3, '2024-10-26'),
(18, 'Ghina Nur Agsya', 'Sticker', 'A3', 'Vinyl', 60000, 3, 3, '2024-11-08'),
(19, 'Raihan Muhammad Akbar', 'Sticker', 'A4', 'Vinyl', 15000, 1, 4, '2024-11-12'),
(20, 'Sticker', 'Sticker', 'A3', 'Vinyl', 20000, 1, 1, '2024-11-12');
=======
(5, 'Renan', 'Sticker Kromo', 'A4', 'Kromo', 12000, 19, 1, '2024-12-20'),
(6, 'Test', 'Test', 'Test', 'Test', 12, 12, 1, '2024-12-20'),
(7, 'Testttt', 'Medali', '12', '12', 12, 12, 2, '2024-12-20'),
(8, 'Variant Test', 'Sticker', 'A4', 'Vinyl', 1485000, 99, 4, '2024-12-20'),
(9, 'Ghino', 'Sticker', 'A3', 'Doff', 110000, 5, 4, '2024-12-20'),
(10, 'Ghino', 'Sticker', 'A4', 'Vinyl', 30000, 2, 4, '2024-12-20'),
(11, 'Huha', 'Sticker', '123', '123123', 123, 5, 1, '2024-12-20'),
(12, 'Hino', 'Sticker', '12', '12', 12, 1, 1, '2024-12-20'),
(13, 'Ghino', 'Sticker', 'A4', 'Vinyl', 30000, 2, 4, '2024-12-20'),
(14, 'Ghino', 'Sticker', 'A4', 'Vinyl', 30000, 2, 4, '2024-12-20'),
(15, 'Test 1', 'Tessss', '12', '12', 12, 1, 2, '2024-12-20');

--
-- Triggers `book`
--
DELIMITER $$
CREATE TRIGGER `Sold Counter` AFTER INSERT ON `book` FOR EACH ROW UPDATE book,product SET product.product_sold = book.qty + product.product_sold WHERE product.product_name = book.product_name
$$
DELIMITER ;
>>>>>>> Stashed changes

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
(4, 'User', 'user.php', 'fa-users', '1,2'),
(5, 'Summary', 'summary.php', 'fa-clipboard-list', '2');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_sold` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_thumbnail`, `product_desc`, `product_price`, `product_sold`) VALUES
(1, 'Sticker', '25115510919351937.jpg', 'Sticker', 15000, 793),
(2, 'Medali', '58815510920545613.jpg', 'Medali', 25000, 109),
(3, 'Name Tag Acrylic', '13615510921005517.jpg', 'Name Tag Acrylic', 30000, 1),
(4, 'Sticker Transparent', '49715510921229345.jpg', 'Sticker Transparent', 25000, 1),
(5, 'Sticker Kromo', '68215510921558349.jpg', 'Sticker Kromo', 20000, 210),
(6, 'Test', 'default.jpg', 'Test', 20000, 121),
(7, 'Tessss', 'default.jpg', '10', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 1, 'A3', 5000),
<<<<<<< Updated upstream
(3, 5, '12', 12);
=======
(3, 5, '10x10cm', 10000);
>>>>>>> Stashed changes

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
(1, 'root', 'root@printmax.com', '$2y$12$/jRa.GsGg.oAd0hO6JyvG.1X.87pL0zf9BNaiAb7DgxUK5QYaYzjq', '1', 'Active'),
(2, 'Ghina Nur Agsya', 'admin@printmax.com', '$2y$12$/jRa.GsGg.oAd0hO6JyvG.1X.87pL0zf9BNaiAb7DgxUK5QYaYzjq', '2', 'Active'),
(3, 'Dejan Soekri Stankovic', 'staff@printmax.com', '$2y$12$/jRa.GsGg.oAd0hO6JyvG.1X.87pL0zf9BNaiAb7DgxUK5QYaYzjq', '3', 'Active'),
(4, 'Raihan Akbar', 'raihan@printmax.id', '$2y$12$/jRa.GsGg.oAd0hO6JyvG.1X.87pL0zf9BNaiAb7DgxUK5QYaYzjq', '3', 'Active');

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
<<<<<<< Updated upstream
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
=======
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
