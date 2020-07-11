-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2020 at 07:21 AM
-- Server version: 8.0.20
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crypto-exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `verified` tinyint NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `first_name`, `last_name`, `verified`, `status`, `password`, `token`, `timestamp`) VALUES
(1, 'user@gonv.pt', 'User', 'Zero', 1, 'active', '$2y$10$mpE6YVQ6T4d5rOBlL5HqD.F6xhkiYyMMQOAWignxHg/yjElwo6A4O', '9ca3ab0228e121c5d9a39ae7007d2553c5ee9b8b', 1594444638);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `first_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_general_ci NOT NULL,
  `level` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `username`, `email`, `level`, `active`, `password`, `token`) VALUES
(2, 'Admin', 'Admin', 'admin', 'admin@admin.pt', 1, 1, '$2y$10$d8y6hjIu86G2ZTI2FkyqQe4b.uy7nqI3QYno.p3mvaAyDOq4/oxs2', '49c33f287bd3d93cb9d64b895d06d2d8439e10fa'),
(3, 'Front', 'End', 'front', 'front@end.pt', 0, 1, '$2y$10$Ec7sX8AfdHOsLXg6KsUnhONOOAo98OqsqsPQSrD.5mszTQpKLU2U.', '9fe8eef20547f55eb3853ef6578c0b5aea98e47f');

-- --------------------------------------------------------

--
-- Table structure for table `store_wallet`
--

CREATE TABLE `store_wallet` (
  `id` int NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `balance` decimal(20,8) NOT NULL,
  `fee` decimal(5,2) NOT NULL,
  `usd` decimal(15,4) NOT NULL,
  `eur` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `balance` decimal(20,8) NOT NULL,
  `usd` decimal(15,4) NOT NULL,
  `eur` decimal(15,4) NOT NULL,
  `value` decimal(20,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `store_wallet`
--
ALTER TABLE `store_wallet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_UNIQUE` (`currency`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wallet_customer` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_wallet`
--
ALTER TABLE `store_wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `fk_wallet_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
