-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 08:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `membership` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `verification_code` varchar(1000) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `rating` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `password`, `membership`, `date`, `verification_code`, `email_verified_at`, `rating`) VALUES
(40, 'syazwy', 'syazwywardyshah@gmail.com', '$2y$10$/o2kyoK1r8hiv7gSokdM2eqW4886n4aTdHS9EXNXBhGIHU6IiOyCC', 'Premium Monthly', '2023-09-02', '231472', '2023-09-02 21:52:54', NULL),
(45, 'barzun', '21ftt1287@student.pb.edu.bn', '$2y$10$W/HLAx3HEnd3PYd3Bn7pSuU61NhEO23l.wS/9nNGn23hZMHmUpm1C', ' Basic', '2023-09-03', '283252', '2023-09-04 04:24:10', NULL),
(48, 'wajid', '21ftt1294@student.pb.edu.bn', '$2y$10$QDlQxpEg6WisIKJAlhaKf.isfM3xO5X5PfDGDDNfmmkyRoDrwe8mm', 'Basic', '2023-09-04', '347801', '2023-09-04 22:32:40', NULL),
(51, '21FTT1292', '21FTT1292@student.pb.edu.bn', '$2y$10$4.TPT3W8TIRzHnGgCLgAOODeEfAURveGkUzRzIL.PkTN5yZPmlIs.', ' Basic', '2023-09-04', '233387', '2023-09-05 01:24:14', NULL),
(52, 'mujlir', '21FTT1750@student.pb.edu.bn', '$2y$10$tzth6Xz/3qk1jQq3g8BSouqAJx3fS8.rxyXd1naornFyFH9U7ii5y', ' Basic', '2023-09-04', '237661', '2023-09-05 02:05:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemslisting`
--

CREATE TABLE `itemslisting` (
  `id` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `item_condition` varchar(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `time` time(6) NOT NULL,
  `uploaded_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `image_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `report` varchar(100) NOT NULL,
  `typeofreport` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reportbyusers`
--

CREATE TABLE `reportbyusers` (
  `id` int(100) NOT NULL,
  `typeReport` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportbyusers`
--

INSERT INTO `reportbyusers` (`id`, `typeReport`, `reason`) VALUES
(1, 'ProductQuality', 'something');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `rating` int(6) NOT NULL,
  `time` datetime(6) NOT NULL,
  `users` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `content`, `rating`, `time`, `users`) VALUES
(36, 'lakaka', 'hi my name is lakaka, I am from nigeria. Where im from, we dont have wotah. Pls sedekah some wotah for me and my familyu back in hindustan, banglasdeh. Sekian harap maklum', 4, '2023-08-19 09:59:53.000000', 'syazwy'),
(37, 'kirim salam benz', 'hey lakaka, im here to help you. just contact me @lakaka is a fool.com', 1, '2023-08-19 10:01:02.000000', NULL),
(38, 'af1qaiman', 'hey im afq, i like supra, i like hotwherels,. i lijkle playing futebal, i like ', 5, '2023-08-20 16:13:16.000000', NULL),
(39, 'good seller', 'on time', 5, '2023-08-24 05:07:39.000000', NULL),
(40, 'aslcnasknf', 'abcd', 5, '2023-08-24 05:07:51.000000', NULL),
(41, 'svsb', 'dfdsb', 1, '2023-08-24 05:08:21.000000', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemslisting`
--
ALTER TABLE `itemslisting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_images_item_id` (`item_id`);

--
-- Indexes for table `item_images`
--
ALTER TABLE `item_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reportbyusers`
--
ALTER TABLE `reportbyusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reportbyusers`
--
ALTER TABLE `reportbyusers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemslisting`
--
ALTER TABLE `itemslisting`
  ADD CONSTRAINT `fk_item_images_item_id` FOREIGN KEY (`item_id`) REFERENCES `item_images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
