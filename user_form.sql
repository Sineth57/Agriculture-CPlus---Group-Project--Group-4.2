-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2023 at 07:01 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(1, 15, 2, NULL),
(2, 28, 2, NULL),
(3, 15, 11, NULL),
(4, 15, 4, NULL),
(5, 15, 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `admin_id`, `message`, `timestamp`, `is_read`) VALUES
(42, 15, NULL, 'last', '2023-11-22 17:50:23', 0),
(43, 32, NULL, 'last', '2023-11-22 17:50:23', 0),
(44, 34, NULL, 'last', '2023-11-22 17:50:23', 0),
(45, 3, NULL, 'specific', '2023-11-22 18:09:42', 0),
(46, 15, NULL, 'specific', '2023-11-22 18:09:42', 0),
(47, 32, NULL, 'specific', '2023-11-22 18:09:42', 0),
(48, 34, NULL, 'specific', '2023-11-22 18:09:42', 0),
(49, 15, NULL, 'specific', '2023-11-22 18:09:42', 0),
(50, 3, NULL, '34', '2023-11-22 18:11:15', 0),
(51, 15, NULL, '34', '2023-11-22 18:11:15', 0),
(52, 32, NULL, '34', '2023-11-22 18:11:15', 0),
(53, 34, NULL, '34', '2023-11-22 18:11:15', 0),
(54, 34, NULL, '34', '2023-11-22 18:11:15', 0),
(55, 3, NULL, '34', '2023-11-22 18:12:52', 0),
(56, 15, NULL, '34', '2023-11-22 18:12:52', 0),
(57, 32, NULL, '34', '2023-11-22 18:12:52', 0),
(58, 34, NULL, '34', '2023-11-22 18:12:52', 0),
(59, 15, NULL, 'trial', '2023-11-22 18:13:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(225) NOT NULL AUTO_INCREMENT,
  `userid` int(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` varchar(225) NOT NULL,
  `image` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `nameAddress` varchar(255) NOT NULL,
  `pnumber` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `userid`, `name`, `price`, `image`, `image2`, `image3`, `description`, `nameAddress`, `pnumber`, `user_id`) VALUES
(2, 15, 'Carrots', '200', 'pcar01-1kg.jpg', '', '', 'Sweet And Delicious Mango 1kg Available. Perfect Addition To Any Fruit Bowl Or Recipe	0', '', '071234567', NULL),
(13, 35, 'test product', '678', 'images (1).jpeg', 'images.jpeg', 'vegetables.png', 'test description', 'test address', '12345677', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`, `cart_id`) VALUES
(3, 'Shashintha s', 'shashin@gmail.com', 'c7f638d94510f501a22dc61a4f15bcfc', 'admin', 'tuxpi.com.1673070642.jpg', NULL),
(15, 'Sineth Shashintha', 'sineth@gmail.com', '3f0fd0b139458151e5985db6ce6ae0cf', 'user', 'Untitled design (1).png', NULL),
(35, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', 'hr.png', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
