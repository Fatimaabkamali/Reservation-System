-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2025 at 12:27 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` bigint UNSIGNED DEFAULT NULL,
  `hour_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('reserved','canceled') COLLATE utf8mb4_general_ci DEFAULT 'reserved',
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consultantID` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hour_id` (`hour_id`),
  KEY `user_id` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `userID`, `hour_id`, `date`, `status`, `description`, `created_at`, `updated_at`, `consultantID`) VALUES
(1, 10, 2, '2025-08-22', 'canceled', 'wd', '2025-08-08 16:56:18', '2025-08-09 10:47:22', 4),
(2, 10, 2, '2025-08-08', 'reserved', 'rgy', '2025-08-08 17:11:54', NULL, 4),
(3, 10, 3, '2025-08-22', 'reserved', 'ada', '2025-08-08 21:06:15', NULL, 4),
(5, 10, 2, '2025-08-20', 'reserved', '474', '2025-08-08 21:07:44', NULL, 3),
(6, 10, 3, '2025-08-21', 'reserved', '', '2025-08-08 21:08:50', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

DROP TABLE IF EXISTS `hours`;
CREATE TABLE IF NOT EXISTS `hours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `time` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `time`, `created_at`, `updated_at`) VALUES
(1, '9:00-10:30', '2025-08-06 10:04:02', '2025-08-08 10:47:08'),
(2, '10:30-12:00', '2025-08-06 10:04:02', '2025-08-08 10:47:08'),
(3, '12:00-13:30', '2025-08-06 10:04:02', '2025-08-08 10:47:08'),
(4, '13:30-15:00', '2025-08-06 10:04:02', '2025-08-08 10:47:08'),
(5, '15:00-16:30', '2025-08-06 10:04:02', '2025-08-08 10:47:08'),
(6, '16:30-18:00', '2025-08-06 10:04:02', '2025-08-08 10:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','consultant') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `img`) VALUES
(1, 'سارا بیاتی', 'sara@gamil.com', '1234', 'consultant', NULL, NULL, 'public/app/images/c.png'),
(2, 'بیتا محمدی', 'bita@gmail.com', '1234', 'consultant', NULL, NULL, 'public/app/images/b.png'),
(3, 'امیر اسدی', 'amir@gmail.com', '1234', 'consultant', NULL, NULL, 'public/app/images/d.png'),
(4, 'علی منصوری', 'ali@gmail.com', '1234', 'consultant', NULL, NULL, 'public/app/images/experts_01.png'),
(11, 'رعنا', 'f666wefw6iot@gamil.com', '7979', 'user', '2025-08-07 11:45:26', NULL, ''),
(10, 'فاطمه', 'fatiw4545kamali@gmail.com', '321', 'user', '2025-08-07 11:44:31', NULL, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`hour_id`) REFERENCES `hours` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
