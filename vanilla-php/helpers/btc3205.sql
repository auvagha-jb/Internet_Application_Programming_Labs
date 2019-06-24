-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2019 at 06:02 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btc3205`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `api_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `api_key`) VALUES
(2, 9, 'aSF3ryHxDnlsvo1YB2cAJpmVGzvgyE0YbcBCMJP5u2oT4CtMk3m6RNgxXhIJsRkd'),
(3, 2, '82UXFfDzjnDC5PnC67dbjV5bwveSn31KjRp9dmK8SMC4GubITu19DhxTqQkINtMX'),
(4, 13, '1Xwscg5A3RMieksxygzujs960rHPCq0Zu42V7whyMX1EBKNKeU2Y0eiGlChgK5zG');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `units` int(11) DEFAULT NULL,
  `unit_price` double(3,2) DEFAULT NULL,
  `order_status` varchar(32) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_name`, `units`, `unit_price`, `order_status`, `time`) VALUES
(1, 9, 'Chicken', 100, 9.99, 'Order Placed', '2019-06-14 13:24:49'),
(2, 9, 'Chicken Tikka', 200, 9.99, 'Order Placed', '2019-06-14 14:40:11'),
(3, 9, 'Peri Peri chicken pizza - Large', 1, 9.99, 'Order Placed', '2019-06-19 08:22:47'),
(4, 9, 'Chicken', 10, 9.99, 'Order Placed', '2019-06-21 14:13:05'),
(5, 2, 'Chicken', 100, 9.99, 'Order Placed', '2019-06-21 14:18:24'),
(6, 9, 'Chicken', 100, 9.99, 'Order Placed', '2019-06-24 14:32:15'),
(7, 9, 'Chicken', 100, 9.99, 'Order Placed', '2019-06-24 14:34:01'),
(8, 13, 'Chicken', 100, 9.99, 'Order Placed', '2019-06-24 14:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `user_city` varchar(32) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `utc_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `utc_offset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_city`, `username`, `password`, `image`, `utc_time_stamp`, `utc_offset`) VALUES
(1, 'Test', 'User', 'Test', 'test', '$2y$10$K0.SCinNsdWBawRQa97ppu9b2TUABnle2.2DXVyO97tuaxBLqVd8m', 'hostel-logo.png', '2019-05-08 10:15:32', -180),
(2, 'Eden', 'Hazard', 'Brussels', 'EHazard_10', '$2y$10$0TNkMym1YAxzbouzxsM2UuQ.1zl2XFfahwDzuzeeGYCxtlJFMq35u', 'skysports-eden-hazard-hazard_4530833.jpg', '2019-05-08 10:15:32', -180),
(3, 'Callum', 'Hudson-Odoi', 'London', 'calteck10', '$2y$10$AaoYH0NQSBghzMeRHlgdPeErLD/QmiAj4qPTPUMyPyLm3mQfVYLS2', 'hostel-logo.png', '2019-05-08 10:15:32', -180),
(4, 'Lionel', 'Messi', 'Buenos Aires', 'LeoMessi', '$2y$10$O1AW4VevjQbV1wkPPFGIZO5YLLNQ.bqrw/sC/e/wwh517YK1L9tAy', 'hostel-logo.png', '2019-05-08 10:15:32', -180),
(5, 'Cristiano ', 'Ronaldo', 'Lisbon', 'cristiano', '$2y$10$1KYxpN.SXdIANlOe.quSAOoq9BpVc.CpTMzEpiKyUH1oPwKaCkJD6', 'untitled.png', '2019-05-08 10:15:32', -180),
(6, 'Virgil ', 'van Dyk', 'Amsterdam', 'VVD', '$2y$10$3XNDSW1fYMFcFw48VMmLhevLBP.pG2izNTuG.sswtSR6kZ0lzeAgG', 'Imagine_Brands_Logo_web.png', '2019-05-08 10:15:32', -180),
(7, 'Mohammed', 'Salah', 'Cairo', 'mosalah', '$2y$10$gDM/E9V93J/vjV8IPBBjCexQ8ciKB6uM6h1ZqThtoxZTr5FGnyub6', 'Imagine_Brands_Logo_web.png', '2019-05-08 10:15:32', -180),
(8, 'Test', 'user', 'Test', 'test2', '$2y$10$CdUULFL7yiC5NL3D0o9/0exCeZZwcSKnN0f0dsQCNnqs6JeqVU0b2', 'th5X624ERK.jpg', '2019-05-08 08:33:42', -180),
(9, 'Alison', 'Becker', 'Novo Hamburgo', 'abecker_13', '$2y$10$7krP6WtjUR5PaTYxfaTUjuiP5c8hxCTSd8uzei6Ahzd3ZhwAg0Ns2', 'th5X624ERK.jpg', '2019-05-08 08:33:42', -180),
(10, 'Test', 'user', 'Test', 'test3', '$2y$10$5Ow.MqqsSrUCyc9ZHszMe.ixjfupmqJiEeKWWHiTUNhchiuVONY9m', 'th5X624ERK.jpg', '2019-05-08 08:33:42', -180),
(11, 'Test', 'user', 'test', 'test4', '$2y$10$Jrj0NqAqYQy9kOPjVZdlneiowT2wvQZdZWuxZxQw3cDPwSM3vBiky', 'th5X624ERK.jpg', '2019-05-08 10:09:42', -180),
(12, 'Test ', 'User', 'test', 'test___', '$2y$10$kApr3if1VtX2sgS1pyJ9futqBGJK7T73skw0QCu32D9BZ1PwGKw8K', 'th5X624ERK.jpg', '2019-05-29 08:15:04', -180),
(13, 'Test', 'user', 'Nairobi', 'test100', '$2y$10$d.ei2w/MbjzqhxeCm8nojuK9kcK8AVTIXfprJiFcNM2Hc5N/gjanC', 'avatar.png', '2019-06-24 14:33:46', -180);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD CONSTRAINT `api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
