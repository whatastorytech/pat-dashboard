-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 01:59 PM
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
-- Database: `plantatree`
--

-- --------------------------------------------------------

--
-- Table structure for table `planted_trees`
--

CREATE TABLE `planted_trees` (
  `plant_id` int(11) NOT NULL,
  `tree_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `garden_id` int(11) DEFAULT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `plant_tree_status` enum('0','1') NOT NULL DEFAULT '1',
  `tree_name` varchar(255) NOT NULL,
  `tree_payment` varchar(255) NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `number_of_trees` int(11) DEFAULT NULL,
  `tree_status` enum('adopted','gifted','planted') NOT NULL DEFAULT 'planted',
  `tree_code` varchar(50) NOT NULL,
  `tree_planted_at` datetime DEFAULT NULL,
  `tree_qr_code` text NOT NULL,
  `gifted_to` varchar(255) DEFAULT NULL,
  `gifted_email` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planted_trees`
--

INSERT INTO `planted_trees` (`plant_id`, `tree_category_id`, `user_id`, `location_id`, `garden_id`, `added_at`, `updated_at`, `plant_tree_status`, `tree_name`, `tree_payment`, `payment_type`, `number_of_trees`, `tree_status`, `tree_code`, `tree_planted_at`, `tree_qr_code`, `gifted_to`, `gifted_email`, `payment_status`) VALUES
(30, 2, 23, 1, 1, '0000-00-00 00:00:00', NULL, '1', 'Sachin', '999', NULL, 1, 'adopted', 'PTA299', '2017-11-20 09:38:34', 'test25a302c657276c83ed9810b944ca6130.png', 'imran', 'imransh350@gmail.com', 'Credit'),
(31, 2, 23, 2, 5, '0000-00-00 00:00:00', NULL, '1', 'Sachin', '999', NULL, 1, 'adopted', 'PTA309', '2017-11-20 10:14:51', 'test1d07afde0d6cc56bce1258b07fd53fce.png', 'imran', 'imransh350@gmail.com', 'Credit'),
(32, 2, 23, 1, 5, '0000-00-00 00:00:00', NULL, '1', 'Shahrukh', '999', NULL, 1, 'adopted', 'PTA133', '2018-11-22 08:19:41', 'testd6475e481927f2c27a3bda157a6960b1.png', 'imran', 'imransh350@gmail.com', 'Credit'),
(33, 2, 0, 0, 5, '0000-00-00 00:00:00', NULL, '1', '', '', NULL, NULL, 'planted', 'PTA512', '2018-11-20 09:14:52', 'test8680236de13fbee93c9a7c4496b11ec8.png', NULL, NULL, ''),
(34, 2, 0, 0, 5, '0000-00-00 00:00:00', NULL, '1', '', '', NULL, NULL, 'planted', 'PTA1003', '2018-11-20 09:14:52', 'testcf1b9b2c0cb7caec7e038b65b7193576.png', NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `planted_trees`
--
ALTER TABLE `planted_trees`
  ADD PRIMARY KEY (`plant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `planted_trees`
--
ALTER TABLE `planted_trees`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
