-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 08:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(37, 'quiletsupra', '21ftt1294@student.pb.edu.bn', '$2y$10$bhUPpbFL3k6XLcVlsFaGhuGbXJMA7rnWTjoCNmYC0DILlIpHub2qW', 'basic', '2023-08-28', '609516', '2023-08-28 22:38:23', ''),
(38, 'sazwi', 'syazwywardyshah@gmail.com', '$2y$10$NcsCsgNVbu/srMV6G9wTy.0GYvDxp3b/iG27ii57.yPBUTvgRbW0e', 'basic', '2023-08-30', '147489', '2023-08-30 22:36:06', ''),
(39, 'moyen', 'abdulmuinudin28@gmail.com', '$2y$10$qW5KCoWfQnxgE07CLtu3DO2kZWLM3Q.JEFTGXvzOdPFV8HjtkB6L6', 'basic', '2023-08-30', '799358', '2023-08-30 23:29:08', NULL),
(40, 'down', '21ftt1750@student.pb.edu.bn', '$2y$10$WrAJkk2tELMsD66y8i/1jedueqFiTZC7wrVMSvRf9vIJXXzCLMUxe', 'basic', '2023-08-30', '224433', '2023-08-31 02:02:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itemslisting`
--

CREATE TABLE `itemslisting` (
  `id` int(100) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemslisting`
--

INSERT INTO `itemslisting` (`id`, `email`, `category`, `name`, `price`, `description`, `location`, `image`) VALUES
(5, '', '', 'Bar', '$10', 'Bar', 'Bar', '64e5f0f16c7fd.jpeg'),
(6, '', '', 'Syazwy', '$50', 'Cibik', 'tanah bajur', '64e5f17d4cb9f.jpg'),
(8, '', 'vehicles', 'dragon', '10', 'cool blue dragon', 'kilanas', '64e61be4657c6.png'),
(9, '', 'vehicles', 'happy dragon ', '20', 'gold color dragon ', 'bandar', '64e61c836f950.png'),
(10, '', 'electronics', 'dragon g', '5', 'small green dragon', 'hua ho tanjong bunut', '64e620f707f0c.png'),
(11, '', 'vehicles', 'sfgh', '123', 'hjhju', 'fyiyg', '64e6c7be1aede.png'),
(12, '', 'property', 'rewre', '123', 'fsadf', 'fdasfs', '64e6c7e93db0e.png');

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
(36, 'lakaka', 'hi my name is lakaka, I am from nigeria. Where im from, we dont have wotah. Pls sedekah some wotah for me and my familyu back in hindustan, banglasdeh. Sekian harap maklum', 4, '2023-08-19 09:59:53.000000', 'quiletsupra'),
(37, 'kirim salam benz', 'hey lakaka, im here to help you. just contact me @lakaka is a fool.com', 1, '2023-08-19 10:01:02.000000', 'sazwi'),
(38, 'af1qaiman', 'hey im afq, i like supra, i like hotwherels,. i lijkle playing futebal, i like awagpko[awpgojanwgpo[awgkpoawngkpwailngpwangkmowjgwakngjnawgkj', 5, '2023-08-20 16:13:16.000000', 'sazwi'),
(39, 'good seller', 'on time', 5, '2023-08-24 05:07:39.000000', 'quiletsupra'),
(40, 'aslcnasknf', 'abcd', 5, '2023-08-24 05:07:51.000000', 'sazwi'),
(87, 'afiq', 'hi piik', 1, '2023-08-30 19:55:41.000000', 'moyen');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
