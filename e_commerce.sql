-- phpMyAdmin SQL Dump
-- version 5.2.1deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2024 at 10:39 PM
-- Server version: 11.4.3-MariaDB-1
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `fname`, `username`, `password`) VALUES
(1, 'Marc Giestin Louis Cordova', 'admin', 'uvp65200');

-- --------------------------------------------------------

--
-- Table structure for table `api_code`
--

CREATE TABLE `api_code` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `code` int(6) NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_view`
--

CREATE TABLE `products_view` (
  `id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `prize` text NOT NULL,
  `current_time/date` timestamp NULL DEFAULT current_timestamp(),
  `img` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_shop`
--

CREATE TABLE `seller_shop` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `img` longblob DEFAULT NULL,
  `time` timestamp NULL DEFAULT current_timestamp(),
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `tax` varchar(50) NOT NULL,
  `prize` varchar(10) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `process` varchar(50) NOT NULL,
  `admin_conf` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upgrade_request`
--

CREATE TABLE `upgrade_request` (
  `id` int(10) NOT NULL,
  `user_id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `code` varchar(6) NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(15) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mnumber` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `acc_lv` varchar(50) DEFAULT NULL,
  `img` longblob DEFAULT NULL,
  `access_key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_code`
--
ALTER TABLE `api_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user4_id` (`user_id`);

--
-- Indexes for table `products_view`
--
ALTER TABLE `products_view`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_view` (`seller_id`),
  ADD KEY `product_name` (`product_name`);

--
-- Indexes for table `seller_shop`
--
ALTER TABLE `seller_shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user3_id` (`user_id`),
  ADD KEY `fk_change_this` (`username`),
  ADD KEY `fk_address_user` (`address`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_seller_id` (`seller_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_product_name` (`product_name`);

--
-- Indexes for table `upgrade_request`
--
ALTER TABLE `upgrade_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user2_id` (`user_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `address` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_code`
--
ALTER TABLE `api_code`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `products_view`
--
ALTER TABLE `products_view`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `seller_shop`
--
ALTER TABLE `seller_shop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `upgrade_request`
--
ALTER TABLE `upgrade_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_code`
--
ALTER TABLE `api_code`
  ADD CONSTRAINT `fk_user4_id` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`);

--
-- Constraints for table `products_view`
--
ALTER TABLE `products_view`
  ADD CONSTRAINT `fk_products_view` FOREIGN KEY (`seller_id`) REFERENCES `seller_shop` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `seller_shop`
--
ALTER TABLE `seller_shop`
  ADD CONSTRAINT `fk_address_user` FOREIGN KEY (`address`) REFERENCES `user_accounts` (`address`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_change_this` FOREIGN KEY (`username`) REFERENCES `user_accounts` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user3_id` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`);

--
-- Constraints for table `trans`
--
ALTER TABLE `trans`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products_view` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_name` FOREIGN KEY (`product_name`) REFERENCES `products_view` (`product_name`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `seller_shop` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seller_shop` FOREIGN KEY (`seller_id`) REFERENCES `seller_shop` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `upgrade_request`
--
ALTER TABLE `upgrade_request`
  ADD CONSTRAINT `fk_user2_id` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
