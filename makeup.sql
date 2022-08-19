-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 11:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makeup`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog_data`
--

CREATE TABLE `catalog_data` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `type` varchar(55) DEFAULT NULL,
  `price` int(15) NOT NULL,
  `picture` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalog_data`
--

INSERT INTO `catalog_data` (`id`, `title`, `cat_id`, `type`, `price`, `picture`, `status`) VALUES
(1, 'Wedding Purple Concept', 2, 'Wedding', 100000, 'catalog-logo-25.JPG', '0'),
(2, 'Wedding White Concept', 2, 'Wedding', 100000, 'catalog-logo-37.JPG', '0'),
(3, 'Engagement', 1, 'Engagement', 200000, 'catalog-logo-99.JPG', '0'),
(4, 'Engagement', 1, 'Engagement', 200000, 'catalog-logo-100.JPG', '0'),
(5, 'Pre-Wedding', 3, 'Pre-Wedding', 3000000, 'catalog-logo-29.JPG', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tm_catalogs`
--

CREATE TABLE `tm_catalogs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `logo` blob NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'active = 1; 0 = inactive',
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `slugs` varchar(250) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `quota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_catalogs`
--

INSERT INTO `tm_catalogs` (`id`, `name`, `logo`, `description`, `status`, `deleted`, `slugs`, `price`, `quota`) VALUES
(0, '-', '', '-', 1, 1, '', NULL, 0),
(1, 'Engagement', 0x6272616e642d6c6f676f2d656e676167656d656e742e706e67, 'Engagement catalog prize onl 200000', 1, 0, 'engagement', '200000', 1),
(2, 'Wedding', 0x6272616e642d6c6f676f2d77656464696e672e706e67, 'Pre-wedding catalog prize only 200000', 1, 0, 'wedding', '100000', 1),
(3, 'Pre-Wedding', 0x6272616e642d6c6f676f2d7072652d77656464696e672e706e67, 'Pre-Wedding Catalog', 1, 0, 'pre-wedding', '3000000', 10),
(4, 'Wisuda', 0x636174616c6f672d6c6f676f2d7769737564612e706e67, 'Wisuda Catalog only 150000', 1, 0, 'wisuda', '150000', 22),
(7, 'Wisuda', '', 'Wisuda Catalog only 150000', 1, 0, 'wisudaq', '150000', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tm_cover`
--

CREATE TABLE `tm_cover` (
  `id` int(11) NOT NULL,
  `slide` blob NOT NULL,
  `slide_mobile` blob DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
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
-- Table structure for table `tm_customer`
--

CREATE TABLE `tm_customer` (
  `id` int(11) NOT NULL,
  `id_userlogin` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_customer`
--

INSERT INTO `tm_customer` (`id`, `id_userlogin`, `first_name`, `last_name`, `gender`, `phone`, `dateofbirth`) VALUES
(1, 78, 'zas', 'zasz', 'm', '088235693239', '2022-08-10'),
(2, 79, 'test', 'maszeh', 'm', '082124507026', '1999-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `tm_customer_detail`
--

CREATE TABLE `tm_customer_detail` (
  `id` int(11) NOT NULL,
  `id_userlogin` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `default_address` int(11) NOT NULL DEFAULT 0 COMMENT 'active = 1; inactive = 0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_customer_detail`
--

INSERT INTO `tm_customer_detail` (`id`, `id_userlogin`, `first_name`, `last_name`, `gender`, `email`, `phone`, `address`, `postcode`, `default_address`) VALUES
(1, 78, 'zainul', 'anwar', 'm', 'asxasasas@gmail.com', '088235693239', 'sasadsad', '', 1),
(2, 79, 'test', 'maszeh', 'm', 'test@gmail.com', '082124507026', 'Tenggilis Utara IX No 8', '', 1);

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
-- Table structure for table `tm_order`
--

CREATE TABLE `tm_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(25) NOT NULL,
  `order_date` date NOT NULL,
  `nama` varchar(55) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `type` varchar(55) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `price` varchar(15) NOT NULL,
  `picture` text DEFAULT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `note` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tm_order`
--

INSERT INTO `tm_order` (`order_id`, `order_number`, `order_date`, `nama`, `cat_id`, `type`, `user_id`, `alamat`, `price`, `picture`, `status`, `note`, `created_at`) VALUES
(1, 'ORD936', '2022-08-18', 'Kontol', 1, 'Engagement', 79, 'Jl Urip Sumoharjo', '200000', 'Screenshot_2021-11-25_120635.png', '1', '', '2022-08-18 20:13:06'),
(2, 'ORD936', '2022-08-18', 'Kontol', 1, 'Engagement', 79, 'Jl Urip Sumoharjo', '200000', 'Screenshot_2021-11-25_120635.png', '2', '', '2022-08-18 20:13:06'),
(3, 'ORD936', '2022-08-18', 'Kontol', 1, 'Engagement', 79, 'Jl Urip Sumoharjo', '200000', 'Screenshot_2021-11-25_120635.png', '0', '', '2022-08-18 20:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `tm_reviews`
--

CREATE TABLE `tm_reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tm_reviews`
--

INSERT INTO `tm_reviews` (`id`, `name`, `email`, `stars`, `comment`, `status`, `created`) VALUES
(1, 'sASas', 'sadasda@gmail.com', 5, 'asdasdasd', '1', '2022-08-18 19:18:27'),
(2, 'saas', 'asxasasas@gmail.com', 5, 'sasasa', '1', '2022-08-18 19:20:25'),
(3, 'sqq', 'zainul@keraton.co.id', 4, 'wqwqq', '1', '2022-08-18 19:24:56');

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
(2, 'Admin', '$2y$10$qkLcTasok1mpvzBNP8B2YuJ9ULTtSnKM2CZVNyWXnLEiIOC0DZhpC', 'super.admin@keraton.com', 1, 0, NULL),
(76, 'Admin', '$2y$10$qkLcTasok1mpvzBNP8B2YuJ9ULTtSnKM2CZVNyWXnLEiIOC0DZhpC', 'zainul@keraton.co.id', 4, 0, NULL),
(77, 'zaza', '$2y$10$O3cl64gaKDr.jwDa5T2Ij.hlmFUqDxYr8RK4dcg6V/8F0D7nwznk.', 'asxas@gmail.com', 4, 0, NULL),
(78, 'zazasadasda', '$2y$10$8YlHVD8fzHvAnd5LzVNeq.CyN9ste6Ls6uASaBdSvJf/LWBYAVVD2', 'mex@gmail.com', 4, 0, NULL),
(79, 'test', '$2y$10$z5HnxOBl34EFEDhEpaBKLuI66YIZUWxia0aP8RPWHsETQ.LHUIsDS', 'test@gmail.com', 4, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog_data`
--
ALTER TABLE `catalog_data`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tm_customer`
--
ALTER TABLE `tm_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tm_customer_detail`
--
ALTER TABLE `tm_customer_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_userlogin` (`id_userlogin`);

--
-- Indexes for table `tm_order`
--
ALTER TABLE `tm_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tm_reviews`
--
ALTER TABLE `tm_reviews`
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
-- AUTO_INCREMENT for table `catalog_data`
--
ALTER TABLE `catalog_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tm_catalogs`
--
ALTER TABLE `tm_catalogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tm_cover`
--
ALTER TABLE `tm_cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tm_customer`
--
ALTER TABLE `tm_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tm_customer_detail`
--
ALTER TABLE `tm_customer_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tm_order`
--
ALTER TABLE `tm_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tm_reviews`
--
ALTER TABLE `tm_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
