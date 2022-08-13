-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 10:40 AM
-- Server version: 8.0.16
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_agmstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_catalogs`
--

CREATE TABLE `tm_catalogs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` blob NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'active = 1; 0 = inactive',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `slugs` varchar(250) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `quota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_catalogs`
--

INSERT INTO `tm_catalogs` (`id`, `name`, `logo`, `description`, `status`, `deleted`, `slugs`, `price`, `quota`) VALUES
(0, '-', '', '-', 1, 0, '', NULL, 0),
(2, 'Pre-Wedding', 0x6272616e642d6c6f676f2d6b696e676b6f696c2e706e67, 'ewrwerwe', 1, 0, 'pre-wedding', '200000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tm_cover`
--

CREATE TABLE `tm_cover` (
  `id` int(11) NOT NULL,
  `slide` blob NOT NULL,
  `slide_mobile` blob,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cover` char(1) NOT NULL COMMENT '1 = header, 2 = best seller, 3 = special package, 4 = bed linen, 5 = bedding acc	',
  `bannerlink` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_cover`
--

INSERT INTO `tm_cover` (`id`, `slide`, `slide_mobile`, `created_at`, `update_at`, `cover`, `bannerlink`) VALUES
(8, 0x7370656369616c2d7061636b6167652d636f7665722d356436663831643761653639642e6a7067, NULL, '2019-09-04 00:00:00', NULL, '3', NULL),
(20, 0x61676d686f6d6562616e6e6572332e6a7067, 0x61676d686f6d6562616e6e65724d332e6a7067, '2020-02-03 00:00:00', NULL, '1', 'https://www.agmstore.com/home/shop/kingkoil');

-- --------------------------------------------------------

--
-- Table structure for table `tm_forgot_pass`
--

CREATE TABLE `tm_forgot_pass` (
  `id` int(11) NOT NULL,
  `id_userLogin` int(11) NOT NULL,
  `uniqueCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_forgot_pass`
--

INSERT INTO `tm_forgot_pass` (`id`, `id_userLogin`, `uniqueCode`) VALUES
(0, 40, '21199242015ceb65e5dceb13.36312156'),
(0, 73, '9028176175e37f53a70d721.86798432');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `newer` int(11) NOT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `username`, `password`, `email`, `user_type`, `newer`, `created`) VALUES
(2, 'Admin', '$2y$10$qkLcTasok1mpvzBNP8B2YuJ9ULTtSnKM2CZVNyWXnLEiIOC0DZhpC', 'super.admin@keraton.com', 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tm_catalogs`
--
ALTER TABLE `tm_catalogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slugs` (`slugs`);

--
-- Indexes for table `tm_cover`
--
ALTER TABLE `tm_cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_catalogs`
--
ALTER TABLE `tm_catalogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tm_cover`
--
ALTER TABLE `tm_cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
