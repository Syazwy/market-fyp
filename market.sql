-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 05:28 PM
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
-- Database: `market2`
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
(60, 'wajid', 'bby-el@hotmail.com', '$2y$10$jl0kdZa2f73C/sOO9wfTW.eusN81dCiFOMAo3dgUeLhib3GQwFv56', ' Basic', '2023-10-01', '192842', '2023-10-02 00:23:46', NULL, 'Active', ''),
(61, 'mujlir', '21ftt1750@student.pb.edu.bn', '$2y$10$i73QEWM3So1mOnG/xOki9.rZSuqkZbNaN8XdXV4UdZt.LgSoxqbSu', 'Basic', '2023-10-02', '127716', '2023-10-02 14:21:55', NULL, 'Active', '');

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
(142, 'vehicles', 'New', 'dxrfhj', '4646', 'drhrdhrd', 'Belait', NULL, 'mujlir', '08:29:28.000000', '2023-10-02 08:29:28', 'sold', '21ftt1750@student.pb.edu.bn', NULL),
(143, 'clothing', 'Used - Like New', 'earrings', '18', 'balum pernah pakai', 'Brunei Muara', NULL, 'wajid', '08:50:24.000000', '2023-10-02 08:50:24', 'active', 'bby-el@hotmail.com', NULL),
(144, 'electronics', 'New', 'awgwag', '255', 'aswtgawtg', 'Brunei Muara', NULL, 'wajid', '09:19:46.000000', '2023-10-02 09:19:46', 'sold', 'bby-el@hotmail.com', '21ftt1750@student.pb.edu.bn'),
(145, 'clothing', 'Used - Like New', 'awfgawg', '25256', 'aswgawgwag', 'Brunei Muara', NULL, 'mujlir', '09:33:53.000000', '2023-10-02 09:33:53', 'sold', '21ftt1750@student.pb.edu.bn', 'bby-el@hotmail.com');

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
(115, 142, '651a6348942b3_cabinet.png'),
(116, 142, '651a63489443e_car.png'),
(117, 142, '651a6348945b9_earrings.png'),
(118, 142, '651a634894716_iphone.png'),
(119, 142, '651a634894837_necklace.png'),
(120, 142, '651a634894924_necklace1.png'),
(121, 143, '651a6830adf10_earrings.png'),
(122, 144, '651a6f1253296_iphone.png'),
(123, 145, '651a7261d3c6c_car.png');

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
(36, 'hakim', 'Great seller', 4, '2023-08-19 09:59:53.000000', 'syazwy'),
(37, 'lapik aiman', 'Amazing seller', 3, '2023-08-19 10:01:02.000000', 'syazwy');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

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
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

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
