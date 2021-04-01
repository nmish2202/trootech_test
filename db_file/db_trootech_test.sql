-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 09:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_trootech_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tt_categories`
--

CREATE TABLE `tt_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=enabled, 2 = disabled , 3 =Soft deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt_categories`
--

INSERT INTO `tt_categories` (`id`, `category_name`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Parent Category Updated', 0, 1, '2021-04-01 22:46:51', '2021-04-02 00:41:11'),
(2, 'Parent Category 2', 0, 1, '2021-04-01 22:47:21', NULL),
(3, 'First Child Cat 1', 1, 1, '2021-04-01 22:47:58', NULL),
(4, 'Second Child Cat 1', 3, 1, '2021-04-01 22:48:27', NULL),
(5, 'Third Child Cat 1', 4, 1, '2021-04-01 22:48:48', NULL),
(6, 'Forth Child Cat 1', 5, 1, '2021-04-01 23:14:38', NULL),
(7, 'Third Child Cat 2', 4, 1, '2021-04-01 23:15:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tt_products`
--

CREATE TABLE `tt_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `parent_cat_id` int(11) DEFAULT 0,
  `sub_cat_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - enabled , 2 = disabled , 3 = soft deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt_products`
--

INSERT INTO `tt_products` (`product_id`, `product_name`, `price`, `parent_cat_id`, `sub_cat_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test Product Update', 5000, 1, 4, 1, '2021-04-02 00:26:19', '2021-04-02 01:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tt_categories`
--
ALTER TABLE `tt_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tt_products`
--
ALTER TABLE `tt_products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tt_categories`
--
ALTER TABLE `tt_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tt_products`
--
ALTER TABLE `tt_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
