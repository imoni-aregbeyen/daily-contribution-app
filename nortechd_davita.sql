-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2022 at 10:53 AM
-- Server version: 10.3.36-MariaDB-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nortechd_davita`
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
  `email` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'agent',
  `place` varchar(191) NOT NULL,
  `guarantor_name` varchar(191) DEFAULT NULL,
  `guarantor_phone` varchar(191) DEFAULT NULL,
  `logged_in` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `code`, `name`, `phone`, `email`, `address`, `password`, `role`, `place`, `guarantor_name`, `guarantor_phone`, `logged_in`, `created_at`, `updated_at`) VALUES
(1, 'DVT95342', 'Mrs Dt Augustina', '08036135918', 'anitamafi02@gmail.com', 'RSQ 150 kapam village sabon Gida Refinery kaduna', '$2y$10$hfYjhBcJCybryHUKUMvMhOkCLCFM8Sng5VTh6DfE4Ltmd1angnwsS', 'agent', 'Office', 'Mr David', '08071882242', 0, '2022-11-04 20:12:17', '2022-11-04 20:12:17'),
(2, 'DVT37797', 'Lami Joseph Nalian', '07047729238', 'lamijoseph446@yahoo.com', 'address deeper life bible church', '$2y$10$52lhGVyyfeBmSkHjeFMG8uBGV1RXB6x2b8WxLWR5H6lFukF3qS0t6', 'agent', 'Office', 'Joseph', '080284707851', 0, '2022-11-05 18:35:36', '2022-11-05 18:35:36'),
(3, 'DVT70656', 'Adeosun theophilius taiye', '08086706890', 'adeosuntaiye69@gmail.com', 'Sn 16 Ruma Road kabala west kaduna', '$2y$10$uN1EwJSXiNqtObgpjn7woej8auoxmPD4Iwn8JAuLqxihX8/JuXbCq', 'agent', 'Sabo / Kabalar', 'James Dipe', '08036787725', 0, '2022-11-08 09:00:59', '2022-11-08 09:00:59'),
(4, 'DVT99709', 'Babatunde samson', '08146049619', 'ojo82972@gmail.com', '2 dorino street kabala west kaduna', '$2y$10$V0/wxTWabQLhE/m0GM8cNuMeReggMf8Q1qgaM/AfQ.E68RV/9GujW', 'agent', 'Kapam', 'Adeosun taiye', '08066039298', 0, '2022-11-08 09:04:04', '2022-11-08 09:04:04'),
(5, 'DVT60314', 'Oludare Ayomide', '09013181388', 'oludareayomide4454@gmail.com', 'Opposite Rejoice school maraba rido kaduna', '$2y$10$uxdkQ21xKhuwTq1wAseiIeIF5P1ZznATFdsdb4eb3fmtI9xopjPvu', 'agent', 'Karji / Jan Ruwa', 'Favour oludare', '09013181388', 0, '2022-11-08 09:06:52', '2022-11-08 09:06:52'),
(6, 'DVT48136', 'Shekara Tabitha', '08130668360', 'tabithashekara1@gmail.com', 'Mahuta new extension ungwan tasu before indome company kaduna', '$2y$10$Gds.tXFJA/33dooGpgAoH.KJ4PwvInVtq0KQilcRDBBl6RvH4/otq', 'agent', 'Junction / Maraba Rido', 'Priscilla Monday', '07037765349', 0, '2022-11-08 09:09:02', '2022-11-08 09:09:02');

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
  `email` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'customer',
  `place` varchar(191) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `account_number` varchar(191) DEFAULT NULL,
  `account_name` varchar(191) DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `logged_in` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `code`, `agent_id`, `name`, `phone`, `email`, `address`, `password`, `role`, `place`, `amount`, `account_number`, `account_name`, `bank_name`, `logged_in`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'Toyin Ojo', '08065692243', 'toyinojo@yahoo.com', '14 gayan road mission close narayi', '$2y$10$fFGsfzM0XaQM79K3KAD6k.P3MFypWbfJ/LzlVirznDr/IBxhRoT6q', 'customer', 'Office', 5000, '', 'lamijoseph446@yahoo.com', '', 0, '2022-11-05 18:37:46', '2022-11-05 18:37:46'),
(2, NULL, 2, 'Anita Mafi', '08036135918', 'anitamafi02@gmail.com', 'RSQ 150 kapam village sabon Gida Refinery', '$2y$10$gG57e9ry6ON9ZQeMvTmr2OQZAKtQnN9pChmfRV0daWPVSsMiFlC52', 'customer', 'Office', 200, '', '08071882242', '', 0, '2022-11-06 05:54:06', '2022-11-06 05:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `duration` varchar(191) NOT NULL,
  `repayment` int(11) NOT NULL,
  `payments` text DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `remain` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `place` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `place`, `created_at`, `updated_at`) VALUES
(1, 'Kapam', '2022-11-04 15:18:18', '2022-11-04 15:18:18'),
(2, 'Rido', '2022-11-04 15:21:50', '2022-11-04 15:21:50'),
(3, 'Sabo / Kabalar', '2022-11-04 15:22:35', '2022-11-04 15:22:35'),
(4, 'Junction / Maraba Rido', '2022-11-04 15:23:01', '2022-11-04 15:23:01'),
(5, 'Karji / Jan Ruwa', '2022-11-04 15:23:27', '2022-11-04 15:23:27'),
(6, 'Nissi', '2022-11-04 15:23:52', '2022-11-04 15:23:52'),
(7, 'Sabo Zone 1', '2022-11-04 19:00:21', '2022-11-04 19:00:21'),
(8, 'Narayi / Bayan Dutse', '2022-11-04 19:00:50', '2022-11-04 19:00:50'),
(9, 'Barnawa', '2022-11-04 19:01:46', '2022-11-04 19:01:46'),
(10, 'Office', '2022-11-04 20:10:55', '2022-11-04 20:10:55');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `address` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(191) NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `name`, `phone`, `address`, `password`, `role`, `logged_in`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Davita', '08071882242', 'Refinery Villa', '$2y$10$cuKtMWfG82VobZ2Km9lzu.o8RX7LS0tXg9rRr3iXlhW4onE2W4bki', 'administrator', 1, '2022-10-28 05:49:46', '2022-10-28 06:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `loans`
--
ALTER TABLE `loans`
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
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
