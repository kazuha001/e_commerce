-- phpMyAdmin SQL Dump
-- version 5.2.1deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2024 at 04:36 PM
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
  `username` varchar(30) NOT NULL,
  `passwd_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `acc_lv` varchar(50) NOT NULL,
  `request_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `fname`, `gender`, `mnumber`, `birthdate`, `email`, `address`, `username`, `passwd_hash`, `created_at`, `acc_lv`, `request_code`) VALUES
(1, 'Marc Giestin Louis Cordova', 'male', '09926645985', '2003-11-24', 'mglgain@gmail.com', 'Prk. Bayanihan Brgy. Banago Bacolod City', 'Kazuha01', '$2y$10$C/zihGBjYHzEFdvwWDrxLOGj1SBfXws.EPZefzktx4tGb5hMR.RGm', '2024-12-07 08:44:12', 'Minor', '475010'),
(2, 'Marc Giestin Louis Cordova', 'N/A', '09926645985', '2024-12-07', 'marcgiestinlouis.cordova@lccbonline.edu.ph', 'Prk. Bayanihan Brgy. Banago Bacolod City', 'Kazuha02', '$2y$10$LearPkWrlRuc5DVIBJ1jIeequClt2/95FYWrAf/NK8WyxF33LVOla', '2024-12-07 15:59:28', 'Minor', '264147');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
