-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 02:43 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminId` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`, `Status`) VALUES
(1, 'Anuj Kumar', 'test@gmail.com', 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2018-09-29 12:24:49', '1');

-- --------------------------------------------------------

--
-- Table structure for table `garden`
--

CREATE TABLE `garden` (
  `garden_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `garden_address` text NOT NULL,
  `added_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `garden_status` enum('0','1') NOT NULL DEFAULT '1',
  `garden_name` varchar(255) NOT NULL,
  `garden_map` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `garden`
--

INSERT INTO `garden` (`garden_id`, `location_id`, `garden_address`, `added_at`, `updated_at`, `garden_status`, `garden_name`, `garden_map`) VALUES
(2, 2, 'ABC CHOWK', '2018-12-14', '2018-12-17', '1', 'Nice garden', '1545032669.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gardner`
--

CREATE TABLE `gardner` (
  `gardner_id` int(11) NOT NULL,
  `gardner_fname` varchar(255) NOT NULL,
  `gardner_lname` varchar(255) NOT NULL,
  `gardner_password` varchar(255) NOT NULL,
  `gardner_unique_id` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `gardner_status` enum('0','1') NOT NULL DEFAULT '1',
  `gardner_pnumber` varchar(50) NOT NULL,
  `garden_id` int(11) NOT NULL,
  `gardner_email` varchar(255) NOT NULL,
  `id_proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gardner`
--

INSERT INTO `gardner` (`gardner_id`, `gardner_fname`, `gardner_lname`, `gardner_password`, `gardner_unique_id`, `added_at`, `updated_at`, `gardner_status`, `gardner_pnumber`, `garden_id`, `gardner_email`, `id_proof`) VALUES
(2, 'Wasim', 'Shaikh', 'e807f1fcf82d132f9bb018ca6738a19f', '267', '2018-12-03 12:12:26', '2018-12-05 12:17:08', '1', '1234567890', 1, 'wasim@gmail.com', '1544008628.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `location_status` enum('0','1') NOT NULL DEFAULT '1',
  `location_desc` text NOT NULL,
  `why_we_plant_here` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `added_at`, `updated_at`, `location_status`, `location_desc`, `why_we_plant_here`) VALUES
(1, 'Indore', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', NULL),
(2, 'Pune', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `old_tree_updates`
--

CREATE TABLE `old_tree_updates` (
  `updated _id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `added_at` text NOT NULL,
  `pictures` text NOT NULL,
  `update_status` enum('verifed','resend','unverify') NOT NULL DEFAULT 'unverify',
  `update_seen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `planted_trees`
--

CREATE TABLE `planted_trees` (
  `plant_id` int(11) NOT NULL,
  `tree_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `garden_id` int(11) DEFAULT NULL,
  `added_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `plant_tree_status` enum('0','1') NOT NULL DEFAULT '1',
  `tree_name` varchar(255) DEFAULT NULL,
  `tree_payment` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `number_of_trees` int(11) DEFAULT NULL,
  `tree_status` enum('adopted','gifted','planted') NOT NULL DEFAULT 'planted',
  `tree_code` varchar(50) NOT NULL,
  `tree_planted_at` datetime DEFAULT NULL,
  `tree_qr_code` text NOT NULL,
  `gifted_to` varchar(255) DEFAULT NULL,
  `gifted_email` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `gifted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planted_trees`
--

INSERT INTO `planted_trees` (`plant_id`, `tree_category_id`, `user_id`, `location_id`, `garden_id`, `added_at`, `updated_at`, `plant_tree_status`, `tree_name`, `tree_payment`, `payment_type`, `number_of_trees`, `tree_status`, `tree_code`, `tree_planted_at`, `tree_qr_code`, `gifted_to`, `gifted_email`, `payment_status`, `gifted_at`) VALUES
(1, 1, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 5, 'adopted', 'PTA1086', '2018-11-24 08:24:20', 'test69344907fa92a969d391fa82d2c3af91.png', 'imran', 'smd.786927@hotmail.com', 'Credit', NULL),
(2, 1, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 5, 'adopted', 'PTA824', '2018-11-24 08:24:20', 'test734bce42114c9632d6423ac04e98d780.png', 'imran', 'imransh350@gmail.com', 'Credit', NULL),
(3, 1, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 5, 'adopted', 'PTA870', '2018-11-24 08:24:20', 'testbab5fa098ba5ffeaf2ab18fb9777ef95.png', 'imran', 'imransh350@gmail.com', 'Credit', '2018-12-19 14:43:33'),
(4, 1, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 5, 'adopted', 'PTA332', '2018-11-24 08:24:20', 'test28abf709e95db07bdd3e9337aefc7739.png', 'imran', 'imransh350@gmail.com', 'Credit', '2018-12-06 09:24:50'),
(5, 1, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 5, 'adopted', 'PTA222', '2018-11-24 08:24:20', 'testb53d5158feb76aa56b6074f5dbb8a7a2.png', NULL, NULL, 'Credit', NULL),
(7, 2, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', 'Shahrukh', '999', NULL, 1, 'adopted', 'PTA564', '2018-11-30 08:31:17', 'test119d78a4c989d57aee1111ecc7579253.png', NULL, NULL, 'Credit', NULL),
(8, 2, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', '', '999', NULL, 1, 'adopted', 'PTA539', '2018-11-30 08:35:44', 'test3c8ef60f53f11239210baa7b1d4ed700.png', 'imran', 'imransh350@gmail.com', 'Credit', '2018-12-18 12:23:47'),
(9, 2, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', '', '999', NULL, 2, 'adopted', 'PTA710', '2018-11-30 09:46:06', 'test8091eea17accbf1025372b11f829f103.png', NULL, NULL, 'Credit', NULL),
(10, 2, 23, 2, 1, '0000-00-00 00:00:00', NULL, '1', '', '999', NULL, 2, 'adopted', 'PTA775', '2018-11-30 09:46:06', 'test4c996e10d289006f4bcaf805245aad8c.png', NULL, NULL, 'Credit', NULL),
(11, 2, 23, 2, 2, '0000-00-00 00:00:00', NULL, '1', 'dad', '999', NULL, 1, 'adopted', 'PTA401', '2018-12-19 14:59:17', 'test892d717a4322a208d74dc546d3f7a7e9.png', NULL, NULL, 'Credit', NULL),
(12, 2, 23, 2, 2, '0000-00-00 00:00:00', NULL, '1', 'abhishekh', '999', NULL, 1, 'adopted', 'PTA872', '2018-12-20 08:11:29', 'testeac5bb5fd13b1eaafdd0d482fbd405d2.png', NULL, NULL, 'Credit', NULL),
(13, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA400', '2018-12-14 11:39:33', 'test3af09f630670db10fcef8b119fe2cefd.png', NULL, NULL, '', NULL),
(14, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA1042', '2018-12-14 11:39:33', 'testd8ef46f8370c369b40d1aa668ea514d7.png', NULL, NULL, '', NULL),
(15, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA407', '2018-12-14 11:39:33', 'test322f49d7380b50efcb32494114edd291.png', NULL, NULL, '', NULL),
(16, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA797', '2018-12-14 11:39:33', 'test5ee6373c69ab11ea0feed41adb8d24c5.png', NULL, NULL, '', NULL),
(17, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA818', '2018-12-14 11:39:33', 'testd5797e090477d6138730a42b462ff8ac.png', NULL, NULL, '', NULL),
(18, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA680', '2018-12-14 11:39:33', 'teste941f6522cbd4704e1814b9a3825d0e7.png', NULL, NULL, '', NULL),
(19, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA43', '2018-12-14 11:39:33', 'testd35196defa877a041dc249d0c2f79989.png', NULL, NULL, '', NULL),
(20, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA957', '2018-12-14 11:39:33', 'test5f3cc3e9c627b3c27a1690e16b8bc367.png', NULL, NULL, '', NULL),
(21, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA701', '2018-12-14 11:39:33', 'testa78f2695654fb3fd5fa35eabdbee0769.png', NULL, NULL, '', NULL),
(22, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA628', '2018-12-14 11:39:33', 'testd983844447a954b57b6ac3407b94727c.png', NULL, NULL, '', NULL),
(23, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA616', '2018-12-14 11:39:33', 'testaf3df2b729c05c533650e330b6bb6fec.png', NULL, NULL, '', NULL),
(24, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA510', '2018-12-14 11:39:33', 'test926032eaa17268f504afa0b5da1fa41a.png', NULL, NULL, '', NULL),
(25, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA581', '2018-12-14 11:39:33', 'testf79990d8c38a570ea1b4508cdcfa5a21.png', NULL, NULL, '', NULL),
(26, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA906', '2018-12-14 11:39:33', 'test4713ce88560447c0814c25df471be436.png', NULL, NULL, '', NULL),
(27, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA9', '2018-12-14 11:39:33', 'testfa7ee7fe503bacd3505a6244027b9fff.png', NULL, NULL, '', NULL),
(28, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA499', '2018-12-14 11:39:33', 'test1efb1d8bafb05456ba73b481da1400cd.png', NULL, NULL, '', NULL),
(29, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA96', '2018-12-14 11:39:33', 'test0b61a5e7e2e57f79d55199588153e49d.png', NULL, NULL, '', NULL),
(30, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA828', '2018-12-14 11:39:33', 'test25a302c657276c83ed9810b944ca6130.png', NULL, NULL, '', NULL),
(31, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA671', '2018-12-14 11:39:33', 'test1d07afde0d6cc56bce1258b07fd53fce.png', NULL, NULL, '', NULL),
(32, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA1064', '2018-12-14 11:39:33', 'testd6475e481927f2c27a3bda157a6960b1.png', NULL, NULL, '', NULL),
(33, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA412', '2018-12-14 11:39:33', 'test8680236de13fbee93c9a7c4496b11ec8.png', NULL, NULL, '', NULL),
(34, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA590', '2018-12-14 11:39:33', 'testcf1b9b2c0cb7caec7e038b65b7193576.png', NULL, NULL, '', NULL),
(35, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA276', '2018-12-14 11:39:33', 'testcdc353266efe951dfc31d82a5ef306b2.png', NULL, NULL, '', NULL),
(36, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA237', '2018-12-14 11:39:33', 'testf7608edfa00b085fe6a9de03f75f53dd.png', NULL, NULL, '', NULL),
(37, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA304', '2018-12-14 11:39:33', 'test2953845898401fcb6233a0ae158c1fb7.png', NULL, NULL, '', NULL),
(38, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA678', '2018-12-14 11:39:33', 'test8ff35f9cd090df3b4de83c179e41d3ca.png', NULL, NULL, '', NULL),
(39, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA69', '2018-12-14 11:39:33', 'test96123ad544be93fa1109c23d0f0fdff1.png', NULL, NULL, '', NULL),
(40, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA323', '2018-12-14 11:39:33', 'test4d4b867a09755300a68fc9ba93f5f3b4.png', NULL, NULL, '', NULL),
(41, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA111', '2018-12-14 11:39:33', 'test17404820bb445d818467be1c8670be97.png', NULL, NULL, '', NULL),
(42, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA840', '2018-12-14 11:39:33', 'testeb4f471dd7c214c6208228bfc0efc999.png', NULL, NULL, '', NULL),
(43, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA70', '2018-12-14 11:39:33', 'test296aef57331a178ba53009d353d7e3e9.png', NULL, NULL, '', NULL),
(44, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA769', '2018-12-14 11:39:33', 'test8f5db649bb7fe38170b870946595f877.png', NULL, NULL, '', NULL),
(45, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA667', '2018-12-14 11:39:33', 'test5f700503d9ecc8adf2d9aa68c2ed59df.png', NULL, NULL, '', NULL),
(46, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA1101', '2018-12-14 11:39:33', 'test5863d91be69e6d2b24416f80e12ce156.png', NULL, NULL, '', NULL),
(47, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA434', '2018-12-14 11:39:33', 'test27238db36fb0268d77a1f4129c21866b.png', NULL, NULL, '', NULL),
(48, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA208', '2018-12-14 11:39:33', 'testd060960950ecc1b954b12748b8f17a85.png', NULL, NULL, '', NULL),
(49, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA564', '2018-12-14 11:39:33', 'test7a80a24be4bb5691769e0f46222fec98.png', NULL, NULL, '', NULL),
(50, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA55', '2018-12-14 11:39:33', 'test3c311b041f8c5aa469e92c9d63f31a04.png', NULL, NULL, '', NULL),
(51, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA89', '2018-12-14 11:39:33', 'test866166b3f1e5f944d7e951919a7e6d21.png', NULL, NULL, '', NULL),
(52, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA621', '2018-12-14 11:39:33', 'testb1c382a0da87fefbd823c6baed149b9e.png', NULL, NULL, '', NULL),
(53, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA169', '2018-12-14 11:39:33', 'testbcfaf2e82e39a74659245b0b16bfbdf0.png', NULL, NULL, '', NULL),
(54, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA41', '2018-12-14 11:39:33', 'testc867a034cd19fc643fa43984e5362221.png', NULL, NULL, '', NULL),
(55, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA901', '2018-12-14 11:39:33', 'testa11224b648a6e617738bbf348b7b5915.png', NULL, NULL, '', NULL),
(56, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA47', '2018-12-14 11:39:33', 'testd8da2776a37d396d27fe2ed5f66bae49.png', NULL, NULL, '', NULL),
(57, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA719', '2018-12-14 11:39:33', 'test1951d3d8e01b8e88ef6dafd4c401beef.png', NULL, NULL, '', NULL),
(58, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA188', '2018-12-14 11:39:33', 'test0b8dcc922ca0ca5ab02dad22bf533316.png', NULL, NULL, '', NULL),
(59, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA148', '2018-12-14 11:39:33', 'testb9fff99e8f4b0e757b4f6d47ed27646b.png', NULL, NULL, '', NULL),
(60, 1, 0, NULL, 2, '0000-00-00 00:00:00', NULL, '1', NULL, NULL, NULL, NULL, 'planted', 'PTA998', '2018-12-14 11:39:33', 'test7fa0c2f1b3bda3950cbb3200d432386e.png', NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE `trees` (
  `tree_id` int(11) NOT NULL,
  `tree_category_id` int(11) NOT NULL,
  `tree_added_at` datetime DEFAULT NULL,
  `tree_updated_at` datetime DEFAULT NULL,
  `tree_status` enum('0','1') NOT NULL DEFAULT '1',
  `tree_images` text,
  `garden_id` int(11) NOT NULL,
  `unique_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tree_category`
--

CREATE TABLE `tree_category` (
  `tree_category_id` int(11) NOT NULL,
  `tree_category_name` varchar(255) NOT NULL,
  `tree_category_desc` text NOT NULL,
  `added_at` datetime DEFAULT NULL,
  `Status` enum('0','1') DEFAULT '1',
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_category`
--

INSERT INTO `tree_category` (`tree_category_id`, `tree_category_name`, `tree_category_desc`, `added_at`, `Status`, `category_image`) VALUES
(1, 'Apple', 'This is Apple Category', NULL, '1', '1542964309.svg'),
(2, 'Mango', 'This is MAngo Category', NULL, '1', '1542964459.svg'),
(3, 'Banana', 'This is Banana Category', NULL, '1', '1542964488.svg'),
(4, 'Bamboo', 'This is Baboo  category', NULL, '1', '1542964515.svg'),
(5, 'BAEL', 'this is bhel cat', NULL, '1', '1543043889.svg');

-- --------------------------------------------------------

--
-- Table structure for table `tree_updates`
--

CREATE TABLE `tree_updates` (
  `updated _id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `added_at` date NOT NULL,
  `pictures` varchar(255) NOT NULL,
  `update_status` enum('verifed','resend','unverify') NOT NULL DEFAULT 'unverify',
  `update_seen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_updates`
--

INSERT INTO `tree_updates` (`updated _id`, `plant_id`, `added_at`, `pictures`, `update_status`, `update_seen`) VALUES
(3, 60, '2018-12-18', '1545135974.jpg', 'verifed', '0'),
(4, 59, '2018-12-19', '1545209240.png', 'verifed', '0'),
(5, 58, '2018-12-19', '1545209259.png', 'unverify', '0'),
(6, 56, '2018-12-19', '1545209272.png', 'unverify', '0'),
(9, 55, '2018-12-19', '1545227368.png', 'unverify', '0'),
(10, 49, '2018-12-19', '1545227391.png', 'unverify', '0'),
(11, 11, '2018-12-20', '1545293476.png', 'unverify', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_pnumber` varchar(20) NOT NULL,
  `user_register_on` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_paid` enum('0','1') NOT NULL DEFAULT '0',
  `user_status` enum('0','1') NOT NULL DEFAULT '0',
  `user_addess` text,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_password`, `user_pnumber`, `user_register_on`, `updated_at`, `is_paid`, `user_status`, `user_addess`, `user_image`) VALUES
(1, 'vikas ', 'Gupta', 'vikas@gmail.com', '5c428d8875d2948607f3e3fe134d71b4', '1234567890', '2018-09-29 00:00:00', NULL, '0', '1', NULL, ''),
(23, 'imran', 'shaikh', 'imransh350@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '1234567890', '0000-00-00 00:00:00', NULL, '0', '1', NULL, '1539681027.jpg'),
(24, 'imran', 'shaikh', 'imran12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '7249228801', '0000-00-00 00:00:00', NULL, '0', '1', NULL, '1539960166.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`garden_id`);

--
-- Indexes for table `gardner`
--
ALTER TABLE `gardner`
  ADD PRIMARY KEY (`gardner_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `old_tree_updates`
--
ALTER TABLE `old_tree_updates`
  ADD PRIMARY KEY (`updated _id`);

--
-- Indexes for table `planted_trees`
--
ALTER TABLE `planted_trees`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`tree_id`);

--
-- Indexes for table `tree_category`
--
ALTER TABLE `tree_category`
  ADD PRIMARY KEY (`tree_category_id`);

--
-- Indexes for table `tree_updates`
--
ALTER TABLE `tree_updates`
  ADD PRIMARY KEY (`updated _id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `garden`
--
ALTER TABLE `garden`
  MODIFY `garden_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gardner`
--
ALTER TABLE `gardner`
  MODIFY `gardner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `old_tree_updates`
--
ALTER TABLE `old_tree_updates`
  MODIFY `updated _id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planted_trees`
--
ALTER TABLE `planted_trees`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `trees`
--
ALTER TABLE `trees`
  MODIFY `tree_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tree_category`
--
ALTER TABLE `tree_category`
  MODIFY `tree_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tree_updates`
--
ALTER TABLE `tree_updates`
  MODIFY `updated _id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
