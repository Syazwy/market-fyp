-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 07:04 PM
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
  `rating` varchar(1000) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `District` varchar(100) NOT NULL,
  `wishlist_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `password`, `membership`, `date`, `verification_code`, `email_verified_at`, `rating`, `status`, `District`, `wishlist_count`) VALUES
(58, 'Barzun', '21ftt1287@student.pb.edu.bn', '$2y$10$KKerGgOM/mitjc5Iv.mCtOOffP1IVnTVYk0fj0pqlkUJ4TJyd8IIS', ' Basic', '2023-09-27', '293766', '2023-09-27 17:38:47', '', 'Banned', '', 0),
(59, '21FTT1294', '21ftt1294@student.pb.edu.bn', '$2y$10$ByKhU1eNsJ4ZGE9J9SV3Ze84a9txQbTcAIlEXg97MfQXM18Z.h1Mi', 'Premium Annually', '2023-10-01', '509076', '2023-10-01 23:46:11', NULL, 'Active', '', 0),
(60, 'wajid', 'bby-el@hotmail.com', '$2y$10$jl0kdZa2f73C/sOO9wfTW.eusN81dCiFOMAo3dgUeLhib3GQwFv56', ' Basic', '2023-10-01', '192842', '2023-10-02 00:23:46', NULL, 'Active', '', 0),
(61, 'mujlir', '21ftt1750@student.pb.edu.bn', '$2y$10$i73QEWM3So1mOnG/xOki9.rZSuqkZbNaN8XdXV4UdZt.LgSoxqbSu', 'Basic', '2023-10-02', '127716', '2023-10-02 14:21:55', NULL, 'Active', '', 0),
(62, '21FTT1753', '21ftt1753@student.pb.edu.bn', '$2y$10$NndjoggDjzIn4Kk9POMjPeR3UUVCZEMFUiQWJx8HBd.X4duVcypAe', 'Basic', '2023-09-08', '601058', '2023-10-08 15:09:08', NULL, 'Active', '', 0),
(70, 'af1qaiman', '', '', 'Basic', '2023-10-08', '159424', '2023-10-08 20:52:06', NULL, 'Active', '', 0),
(71, 'AFIQ', 'abdafiqaiman.aziz@gmail.com', '$2y$10$XznDGxMDha36tp0M4u21mOEqRxPWESZhEKvrDeGFR6Y/mURAKr9li', 'Basic', '2023-10-13', '176572', '2023-10-14 00:16:10', NULL, 'Active', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appeals`
--

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `appeal` varchar(225) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appeals`
--

INSERT INTO `appeals` (`id`, `username`, `appeal`, `status`) VALUES
(1, 'apik aiman', 'aku nda tau apa2 bro', ''),
(2, 'syazwy', 'aku teupload black pink sonic ku ', ''),
(3, 'mujlir', 'sal aku asmara mewangi no 2', '');

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
(143, 'Fashion', 'Used - Like New', 'Earrings', '18', 'balum pernah pakai', 'Brunei Muara', NULL, 'wajid', '08:50:24.000000', '2023-10-02 08:50:24', 'active', 'bby-el@hotmail.com', NULL),
(144, 'Electronics', 'New', 'iphone 15 pro max', '255', 'Phone with ultraman taro theme\r\nneed money urgent', 'Brunei Muara', NULL, 'wajid', '09:19:46.000000', '2023-10-02 09:19:46', 'completed', 'bby-el@hotmail.com', '21ftt1753@student.pb.edu.bn'),
(145, 'vehicle', 'Used - Like New', 'honda civic', '25256', 'white and shiny\r\nauto gearbox\r\nstock\r\nsrs buyer like muin only', 'Brunei Muara', NULL, 'mujlir', '09:33:53.000000', '2023-10-02 09:33:53', 'sold', '21ftt1750@student.pb.edu.bn', 'bby-el@hotmail.com'),
(150, 'vehicles', 'New', 'fdsaf', '2343', 'fdsfsad', 'Brunei Muara', NULL, '21FTT1753', '05:11:04.000000', '2023-10-12 05:11:04', 'active', '21ftt1753@student.pb.edu.bn', NULL),
(151, 'property', 'New', 'dfasf', '5345', 'fadsf', 'Brunei Muara', NULL, '21FTT1753', '05:11:20.000000', '2023-10-12 05:11:20', 'active', '21ftt1753@student.pb.edu.bn', NULL);

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
(123, 145, '651a7261d3c6c_car.png'),
(124, 147, '652256165bcaa_Screenshot (1427).png'),
(125, 147, '652256165c136_Screenshot (1428).png'),
(126, 147, '652256165c37f_Screenshot (1426).png'),
(127, 148, '6526e29108e49_supra mk4 canvas.png'),
(128, 149, '6527592706a5d_tsm4.png'),
(129, 150, '652763c80fa87_car.png'),
(130, 151, '652763d89d693_perfume.png');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `report` varchar(100) NOT NULL,
  `typeofreport` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `username`, `status`, `item`, `report`, `typeofreport`) VALUES
(5, 'Muin', 'Active', 'Barang', 'balsndoasndoias', 'Misleading');

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
(1, 'ProductQuality', 'something'),
(2, 'Scam', '10');

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
(37, 'apik aiman', 'fast response', 3, '2023-08-19 10:01:02.000000', 'syazwy');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `item_id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `item_condition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`item_id`, `name`, `price`, `description`, `category`, `item_condition`) VALUES
(143, 'Almari Abdul Muin', 4646, 'one of one in brunei srs buyer only harga keras tpi boleh nego ni boss', 'furniture', 'New'),
(144, 'iphone 15 pro max', 255, 'Phone with ultraman taro theme\r\nneed money urgent', 'electronics', 'New'),
(145, 'honda civic', 25256, 'white and shiny\r\nauto gearbox\r\nstock\r\nsrs buyer like muin only', 'vehicles', 'Used - Like New'),
(150, 'sgsdfgsv', 1342, 'xbdfbdb', 'vehicles', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appeals`
--
ALTER TABLE `appeals`
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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `appeals`
--
ALTER TABLE `appeals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemslisting`
--
ALTER TABLE `itemslisting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reportbyusers`
--
ALTER TABLE `reportbyusers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

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
