-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 06, 2020 at 09:02 PM
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
(1, 'gonviegas@gmail.com', '', '', 0, 'active', '$2y$10$BOkSwtKe4KTClIkJhRCJnOkiAVTM9M6buKCSvEY07XJvrwB/jf4wy', 'c1ab507184577038d1415dcd6688060d03bc4e14', 1593994743);

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `date`) VALUES
(1, 'dasffdsop fds;oifs ;slfdifds l;fds ;lksf f', 'fdsfldslkf;sd ;lksfd;lksdf;l ksf ;lks f;lksd f;lksd ', '2020-07-06'),
(2, 'dasdsadasdasdsadsad', 'dsadsadasdsadsada', '2020-07-01');

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
  `image` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `level` tinyint NOT NULL,
  `active` tinyint NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `first_name`, `last_name`, `username`, `email`, `image`, `level`, `active`, `password`, `token`) VALUES
(1, 'John', 'Silva', 'jsilva', 'jsilva@hotmail.com', '', 1, 1, '', '');

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

--
-- Dumping data for table `store_wallet`
--

INSERT INTO `store_wallet` (`id`, `currency`, `balance`, `fee`, `usd`, `eur`) VALUES
(1, 'xrp', '1000000.00000000', '1.50', '0.1777', '0.1565');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `from_address` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `from_currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `from_volume` decimal(20,8) NOT NULL,
  `from_price` decimal(15,4) NOT NULL,
  `to_address` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `to_currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `to_volume` decimal(20,8) NOT NULL,
  `to_price` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `date`, `from_address`, `from_currency`, `from_volume`, `from_price`, `to_address`, `to_currency`, `to_volume`, `to_price`) VALUES
(1, '2020-07-06', '313212312fdsf32dfsgdfg2', 'xrp', '234.00000000', '0.1776', '213665756754cfgdg324fds', 'xlm', '612.00000000', '0.0620');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `balance` decimal(20,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `customer_id`, `currency`, `balance`) VALUES
(1, 1, 'btc', '0.00006560');

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
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_wallet`
--
ALTER TABLE `store_wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
