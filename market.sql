-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 06:08 PM
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
  `rating` varchar(1000) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `District` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `password`, `membership`, `date`, `verification_code`, `email_verified_at`, `rating`, `status`, `District`) VALUES
(58, 'Barzun', '21ftt1287@student.pb.edu.bn', '$2y$10$KKerGgOM/mitjc5Iv.mCtOOffP1IVnTVYk0fj0pqlkUJ4TJyd8IIS', ' Basic', '2023-09-27', '293766', '2023-09-27 17:38:47', '', 'Active', ''),
(59, '21FTT1294', '21ftt1294@student.pb.edu.bn', '$2y$10$ByKhU1eNsJ4ZGE9J9SV3Ze84a9txQbTcAIlEXg97MfQXM18Z.h1Mi', 'Premium Annually', '2023-10-01', '509076', '2023-10-01 23:46:11', NULL, 'Active', ''),
(60, 'wajid', 'bby-el@hotmail.com', '$2y$10$jl0kdZa2f73C/sOO9wfTW.eusN81dCiFOMAo3dgUeLhib3GQwFv56', 'Premium Monthly', '2023-10-01', '192842', '2023-10-02 00:23:46', NULL, 'Active', ''),
(61, 'mujlir', '21ftt1750@student.pb.edu.bn', '$2y$10$i73QEWM3So1mOnG/xOki9.rZSuqkZbNaN8XdXV4UdZt.LgSoxqbSu', 'Basic', '2022-10-07', '127716', '2023-10-02 14:21:55', NULL, 'Active', ''),
(62, 'moyen', 'abdulmuinudin28@gmail.com', '$2y$10$FIm.kkJFRjSD08Isn3V9jeseEoOWvgRMz4fYfgMHmJPnJ8dqwL6Me', 'Basic', '2023-09-07', '100538', '2023-10-07 12:46:37', NULL, 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ID` int(1) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `time` varchar(15) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`ID`, `Message`, `time`, `sender`, `receiver`) VALUES
(148, 'hi wajid', '10:57 PM', 'mujlir', 'wajid'),
(149, 'hi mulir', '10:58 PM', 'wajid', 'mujlir'),
(150, 'hey ', '11:02 PM', 'mujlir', 'wajid'),
(151, 'oh', '11:02 PM', 'mujlir', 'wajid'),
(152, 'oh hi', '11:04 PM', 'wajid', 'mujlir'),
(153, 'hi', '11:24 PM', 'mujlir', 'wajid'),
(154, 'long time no see hahah', '11:24 PM', 'mujlir', 'wajid'),
(155, 'how are you', '11:24 PM', 'mujlir', 'wajid'),
(156, 'im fine thank you', '11:24 PM', 'wajid', 'mujlir'),
(157, 'great to hear that', '11:24 PM', 'mujlir', 'wajid');

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
  `uploaded_at` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bought` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemslisting`
--

INSERT INTO `itemslisting` (`id`, `category`, `item_condition`, `name`, `price`, `description`, `location`, `item_id`, `username`, `time`, `uploaded_at`, `status`, `email`, `bought`) VALUES
(146, 'property', 'Used - Good', 'cabinet', '80', 'new masih lah', 'Temburong', NULL, 'wajid', '10:09:53.000000', '2023-10-02 10:09:53', 'sold', 'bby-el@hotmail.com', '21ftt1750@student.pb.edu.bn'),
(161, 'electronics', 'Used - Good', 'wafawf', '2525', 'watawtawt', 'Brunei Muara', NULL, 'mujlir', '08:40:07.000000', '2023-10-07 08:40:07', 'active', '21ftt1750@student.pb.edu.bn', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `image_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_images`
--

INSERT INTO `item_images` (`id`, `item_id`, `image_filename`) VALUES
(124, 146, '651a7ad1c213b_cabinet.png'),
(125, 37991, '../image/logo.png'),
(126, 17510, '../image/logo.png'),
(127, 161, '6520fd47bf8d8_0a7ecf24cb08d6e3664b9a3b1e2d9146.jpg');

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
  `reason` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportbyusers`
--

INSERT INTO `reportbyusers` (`id`, `typeReport`, `reason`, `username`, `status`) VALUES
(10, 'Sales of animals', 'awgawgwagwa', 'wajid', 'Active'),
(11, 'Sales of animals', 'awgwagwag', 'wajid', 'Active'),
(12, 'Sales of animals', 'wafgwagaw', 'wajid', 'Active'),
(13, 'Selling of illegal item', 'fdfxchjdxhjdxj', 'wajid', 'Active'),
(14, 'Selling of illegal item', 'sdzxhzxsdhdx', 'wajid', 'Active'),
(15, 'Product quality', 'wagawg', 'wajid', 'Active'),
(16, 'Sales of animals', 'wagwagwagwag', 'wajid', 'Active'),
(17, 'Selling of illegal item', 'awtwat', 'wajid', 'Active'),
(18, 'Sales of animals', 'awgawgwag', 'wajid', 'Active'),
(19, 'Sales of animals', 'wagwag', 'wajid', 'Active'),
(20, 'Selling of illegal item', 'wagwagwa', 'wajid', 'Active'),
(21, 'Selling of illegal item', 'wafwafg', 'wajid', 'Active'),
(22, 'Selling of illegal item', 'awgawg', 'wajid', 'Active'),
(23, 'Product quality', 'awgwagawg', 'wajid', 'Active'),
(24, 'Selling of illegal item', 'awgwagawg', 'wajid', 'Active'),
(25, 'Sales of animals', 'awgwagawgwa', 'wajid', 'Active'),
(26, 'No intent to sell', 'fgjkcfjfcj', 'wajid', 'Active');

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
(36, 'hakim', 'Great seller', 4, '2023-08-19 09:59:53.000000', 'wajid'),
(37, 'lapik aiman', 'Amazing seller', 3, '2023-08-19 10:01:02.000000', 'syazwy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reportbyusers`
--
ALTER TABLE `reportbyusers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
