-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2020 at 06:29 AM
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
  `email` varchar(254) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `verified` tinyint NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(128) NOT NULL,
  `timestamp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `first_name`, `last_name`, `verified`, `status`, `password`, `token`, `timestamp`) VALUES
(1, 'user@gonv.pt', 'user', 'user', 1, 'active', '$2y$10$u7xwDEBVULqiBCIodQH9N.7pGkqaewZUW8NAMxRAXrjILuLf0JocO', '213102a63645eda048e307946a476a2f0e4c89dc', 1594528041);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` longtext NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(254) NOT NULL,
  `level` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `username`, `email`, `level`, `active`, `password`, `token`) VALUES
(3, 'admin', 'admin', 'admin', 'admin@staff.gonv.pt', 1, 1, '$2y$10$PMXCkviRqvo/r.uTfHPQrub.8d2o5h32YCgj8SqNDV6oSwgWQJpM2', 'fce1b04cbccf10c4b5296f2361123fca35d66f51'),
(4, 'front', 'front', 'front', 'front@staff.gonv.pt', 0, 1, '$2y$10$l77mWA7FuKXl80omsZe4Pu2YmFewQyyaiDiXQQ6Hw.pVVb/OlvrzW', 'd1311268ecde5015580c3d24b8035359c31119cf');

-- --------------------------------------------------------

--
-- Table structure for table `store_wallet`
--

CREATE TABLE `store_wallet` (
  `id` int NOT NULL,
  `currency` varchar(10) NOT NULL,
  `balance` decimal(20,8) NOT NULL,
  `fee` decimal(5,2) NOT NULL,
  `usd` decimal(15,4) NOT NULL,
  `eur` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `currency` varchar(10) NOT NULL,
  `balance` decimal(20,8) NOT NULL,
  `usd` decimal(15,4) NOT NULL,
  `eur` decimal(15,4) NOT NULL,
  `value` decimal(20,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
