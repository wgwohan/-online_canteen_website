-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 01:38 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(15) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'student',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_num` int(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `st_reg_num` varchar(50) DEFAULT NULL,
  `room_num` varchar(4) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `img_dir` varchar(100) NOT NULL DEFAULT 'image/profile/000.png',
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `acc_bal` int(10) NOT NULL DEFAULT 0,
  `otp` int(4) NOT NULL DEFAULT 0,
  `user_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_time` date NOT NULL,
  `seller_id` int(2) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `order_time` varchar(10) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `payment_method` varchar(4) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `availability_1` int(1) NOT NULL DEFAULT 1,
  `availability_2` int(1) NOT NULL DEFAULT 1,
  `price` float NOT NULL,
  `img_dir` varchar(100) NOT NULL DEFAULT 'image/products/000.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `availability_1`, `availability_2`, `price`, `img_dir`) VALUES
(1, 'Rice And Curry - Vegetable', '', 'mainmeal', 1, 1, 50, 'image/product/1627475167.png'),
(2, 'Rice And Curry - Fish', '', 'mainmeal', 1, 1, 60, 'image/product/1627476548.png'),
(3, 'Rice And Curry - Chicken', '', 'mainmeal', 1, 1, 60, 'image/product/1627476585.png'),
(4, 'String Hoppers', '', 'mainmeal', 1, 1, 50, 'image/product/1627476692.png'),
(5, 'Noodles', '', 'mainmeal', 1, 1, 50, 'image/product/1627476727.png'),
(6, 'Kottu 100', '', 'mainmeal', 0, 1, 100, 'image/product/1627477231.png'),
(7, 'Kottu 150', '', 'mainmeal', 0, 1, 150, 'image/product/1627477287.png'),
(8, 'Kottu 200', '', 'mainmeal', 0, 1, 200, 'image/product/1627477310.png'),
(9, 'Roti', '', 'shortmeal', 1, 1, 10, 'image/product/1627477355.png'),
(10, 'Wade', '', 'shortmeal', 1, 1, 10, 'image/product/1627477463.png'),
(11, 'Rolls', '', 'shortmeal', 1, 1, 20, 'image/product/1627477581.png'),
(12, 'Vegetable Roti', '', 'shortmeal', 1, 1, 20, 'image/product/1627477875.png'),
(13, 'cutlet', '', 'shortmeal', 1, 1, 20, 'image/product/1627477974.png'),
(14, 'Parata', '', 'shortmeal', 1, 1, 60, 'image/product/000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(2) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile_num` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `last_login` datetime(6) NOT NULL,
  `acc_bal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `first_name`, `last_name`, `mobile_num`, `email`, `password`, `last_login`, `acc_bal`) VALUES
(1, 'Hardy', 'Canteen', 715921688, 'hardycanteen@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2021-11-18 16:32:28.000000', 60),
(2, 'Girls Hostel', 'Canteen', 770000001, 'ghcanteen@gmail.com', '111', '0000-00-00 00:00:00.000000', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
