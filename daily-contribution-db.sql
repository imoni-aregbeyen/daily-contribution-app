-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 09:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daily-contribution-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` text,
  `password` text,
  `role` varchar(191) NOT NULL DEFAULT 'agent',
  `place` varchar(191) NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `code`, `name`, `phone`, `address`, `password`, `role`, `place`, `logged_in`, `created_at`, `updated_at`) VALUES
(1, NULL, 'John Doe', '09099999999', NULL, '$2y$10$4253uOKl8UOwC5ljihygl.JTqarzalog6LhxquZBX9/3LWG6M5ui.', 'agent', 'Karji', 1, '2022-10-18 06:53:41', '2022-10-20 15:20:16'),
(2, NULL, 'Jane Doe', '08088888888', NULL, '$2y$10$lGoX2.VilukXwFPyVOFrTO2FaZfjF0dIgO1O17xeHYHinyD9Rt2k2', 'agent', 'Maigero', 0, '2022-10-18 07:10:57', '2022-10-18 07:10:57'),
(3, NULL, 'Ahmed Musa', '08088888080', NULL, '$2y$10$bOLVM7CKOaRDj13ms5QXo.4v/e0nkU1Od8.Gjw2/8y2ImrG7AKy3.', 'agent', 'Barnawa', 1, '2022-10-18 08:55:32', '2022-10-20 12:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `agent_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` text,
  `password` text,
  `role` varchar(191) NOT NULL DEFAULT 'customer',
  `place` varchar(191) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `agent_id`, `name`, `phone`, `address`, `password`, `role`, `place`, `amount`, `logged_in`, `created_at`, `updated_at`) VALUES
(1, '', 1, 'Peter Parker', '09090909090', NULL, '$2y$10$z1BYKtSKaT0kTQOHCHiATeKY9L8v73wAotHZSRlm0MBTRoxk5J2fS', 'customer', 'Karji', 100, 1, '2022-10-18 08:25:25', '2022-10-21 13:33:37'),
(2, '', 3, 'Abdullahi Nafiu Musa', '07077777070', NULL, '$2y$10$Fn9BrHK.PG7ZpsclDnlGTuifizBOkMhFOp1yhfWnqelydvGTQPyoy', 'customer', 'Barnawa', 300, 0, '2022-10-18 08:56:40', '2022-10-18 08:56:40'),
(3, '', 3, 'Hashim Aliyu', '07089098070', NULL, '$2y$10$iBeE00y962jlRU2OYHV88uU43YGCNqKZ0DtKHGFN7MdntbBInCnP2', 'customer', 'Barnawa', 500, 1, '2022-10-20 12:42:03', '2022-10-20 12:45:30'),
(4, '', 3, 'Rosemary Joseph Nwodo', '09091234545', 'Barnawa Lowcost', '$2y$10$r1YeK19WXgAlPaG0UWKa6uXHl3Gy7kSxPA8uDlxpxlqi.d9CTupfy', 'customer', 'Barnawa', 300, 1, '2022-10-20 15:07:30', '2022-10-21 11:46:35'),
(5, NULL, 1, 'Bimpe Yinusa', '09096666666', 'Behind primary school, karji', '$2y$10$nB1A.xSPtdxWpEn0ep0seeR6Dc3iGukVleyO8BbePZ5rxpp6Kk1Ia', 'customer', 'Karji', 200, 1, '2022-10-21 13:28:23', '2022-10-21 13:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `place` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `place`, `created_at`, `updated_at`) VALUES
(1, 'Karji', '2022-10-17 19:36:27', '2022-10-17 19:36:27'),
(2, 'Maigero', '2022-10-17 19:36:37', '2022-10-17 19:36:37'),
(3, 'Narayi', '2022-10-17 19:39:01', '2022-10-17 19:39:01'),
(4, 'Barnawa', '2022-10-18 08:55:02', '2022-10-18 08:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `dates` text NOT NULL,
  `post_month` varchar(191) NOT NULL,
  `month_int` int(11) NOT NULL,
  `post_year` year(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `customer_id`, `agent_id`, `amount`, `post_date`, `dates`, `post_month`, `month_int`, `post_year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 700, '2022-10-22', '{\"2022-10-20\":200,\"2022-10-21\":200,\"2022-10-22\":200,\"2022-10-19\":100}', '2022-10', 10, 2022, '2022-10-21 02:53:08', '2022-10-21 13:26:57'),
(2, 4, 3, 600, '2022-10-22', '{\"2022-10-21\":300,\"2022-10-22\":300}', '2022-10', 10, 2022, '2022-10-21 12:20:45', '2022-10-21 12:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company` varchar(191) DEFAULT NULL,
  `abbr` varchar(191) DEFAULT NULL,
  `logo` varchar(191) NOT NULL DEFAULT 'logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company`, `abbr`, `logo`) VALUES
(1, 'Davita Global', 'DVT', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `address` text,
  `password` text,
  `role` varchar(191) NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `phone`, `address`, `password`, `role`, `logged_in`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Amina Salihu', '09091234545', 'Barnawa, Kaduna', '$2y$10$G4sLCgPg.A.NagRZXIKYgO7PZElvWAFJDqcyPZvxA1g8iCwWCkfba', 'administrator', 1, '2022-10-19 17:09:26', '2022-10-20 08:23:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
