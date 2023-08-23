-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 05:46 PM
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
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `membership` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `email`, `password`, `membership`, `date`) VALUES
(25, 'muin', 'streck', 'muin@123', '123', '', '2023-08-19'),
(30, 'wajid', 'puffballer', 'wajid@123', '123', '', '2023-08-19'),
(33, 'afiwq', 'af1q', 'afiq@123', '123', 'basic', '2023-08-19'),
(34, 'heh', 'heh', 'heh@123', '123', 'basic', '2023-08-19'),
(35, 'af1q aiman', 'af1qaiman', 'afiq@124', '1753', 'basic', '2023-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `itemslisting`
--

CREATE TABLE `itemslisting` (
  `id` int(100) NOT NULL,
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

INSERT INTO `itemslisting` (`id`, `category`, `name`, `price`, `description`, `location`, `image`) VALUES
(5, '', 'Bar', '$10', 'Bar', 'Bar', '64e5f0f16c7fd.jpeg'),
(6, '', 'Syazwy', '$50', 'Cibik', 'tanah bajur', '64e5f17d4cb9f.jpg'),
(8, 'vehicles', 'dragon', '10', 'cool blue dragon', 'kilanas', '64e61be4657c6.png'),
(9, 'vehicles', 'happy dragon ', '20', 'gold color dragon ', 'bandar', '64e61c836f950.png'),
(10, 'electronics', 'dragon g', '5', 'small green dragon', 'hua ho tanjong bunut', '64e620f707f0c.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `rating` int(6) NOT NULL,
  `time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `content`, `rating`, `time`) VALUES
(36, 'lakaka', 'hi my name is lakaka, I am from nigeria. Where im from, we dont have wotah. Pls sedekah some wotah for me and my familyu back in hindustan, banglasdeh. Sekian harap maklum', 4, '2023-08-19 09:59:53.000000'),
(37, 'kirim salam benz', 'hey lakaka, im here to help you. just contact me @lakaka is a fool.com', 1, '2023-08-19 10:01:02.000000'),
(38, 'af1qaiman', 'hey im afq, i like supra, i like hotwherels,. i lijkle playing futebal, i like ', 5, '2023-08-20 16:13:16.000000');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
