-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2023 at 02:16 PM
-- Server version: 5.7.41-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-63+ubuntu18.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class`
--

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_admin`
--

CREATE TABLE `classifieds_admin` (
  `id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `email_id` text NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifieds_admin`
--

INSERT INTO `classifieds_admin` (`id`, `admin_name`, `email_id`, `password`, `status`, `created_date`) VALUES
(1, 'Admin', 'francisarun@gmail.com', 'Admin@123', 1, '2023-05-05 07:09:58am');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_attribute`
--

CREATE TABLE `classifieds_attribute` (
  `id` int(11) NOT NULL,
  `attribute` varchar(200) NOT NULL,
  `menu` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `required_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_attribute_value`
--

CREATE TABLE `classifieds_attribute_value` (
  `id` int(11) NOT NULL,
  `attribute` int(11) NOT NULL,
  `attribute_value` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_category`
--

CREATE TABLE `classifieds_category` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `arabic_title` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approve_status` tinyint(4) NOT NULL,
  `created_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifieds_category`
--

INSERT INTO `classifieds_category` (`id`, `title`, `arabic_title`, `image`, `status`, `approve_status`, `created_on`) VALUES
(1, 'test', 'test', 'https://res.cloudinary.com/dxgmtixhj/image/upload/v1683272354/uploads/admin/yyim4nuk8esjxrqsoy9l.jpg', 1, 0, '2023-05-05 09:52:27am');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_city`
--

CREATE TABLE `classifieds_city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `arabic_title` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_company_registration`
--

CREATE TABLE `classifieds_company_registration` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `arabic_title` text NOT NULL,
  `logo` text NOT NULL,
  `contract` text NOT NULL,
  `feature` text NOT NULL,
  `address` text NOT NULL,
  `map` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `website` text NOT NULL,
  `password` text NOT NULL,
  `email_verification` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approve_status` tinyint(4) NOT NULL,
  `created_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifieds_company_registration`
--

INSERT INTO `classifieds_company_registration` (`id`, `category`, `title`, `arabic_title`, `logo`, `contract`, `feature`, `address`, `map`, `phone`, `email`, `facebook`, `instagram`, `website`, `password`, `email_verification`, `status`, `approve_status`, `created_on`) VALUES
(1, 'test1', 'test1', 'test1', 'https://res.cloudinary.com/dxgmtixhj/image/upload/v1683221121/uploads/admin/jcjzbvxcx4i7xzwupvuf.jpg', 'test', 'test', 'test', 'test', '12345', 'test@gmail.com', 'test', 'test1', 'test1', 'test1', '0', 1, 1, '2023-05-05 08:21:45am');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_menu`
--

CREATE TABLE `classifieds_menu` (
  `id` int(11) NOT NULL,
  `cat_menu` varchar(200) NOT NULL,
  `menu` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifieds_menu`
--

INSERT INTO `classifieds_menu` (`id`, `cat_menu`, `menu`, `image`, `status`, `created_at`) VALUES
(1, 'ElE', 'Motor', 'http:localhostal3onal3onuploadsadmincat.png', 1, '2023-05-07 18:24:34'),
(2, 'TT', 'RRU', '', 0, '2023-05-07 18:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_sub_category`
--

CREATE TABLE `classifieds_sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `arabic_title` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `approve_status` tinyint(4) NOT NULL,
  `created_on` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classifieds_sub_category`
--

INSERT INTO `classifieds_sub_category` (`id`, `category_id`, `title`, `arabic_title`, `image`, `status`, `approve_status`, `created_on`) VALUES
(1, 1, 'test3', 'test2', 'https://res.cloudinary.com/dxgmtixhj/image/upload/v1683307529/uploads/admin/pkwpztauiyboim7hhgh2.jpg', 1, 1, '2023-05-05 07:55:55pm');

-- --------------------------------------------------------

--
-- Table structure for table `classifieds_sub_menu`
--

CREATE TABLE `classifieds_sub_menu` (
  `id` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `sub_menu` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classifieds_admin`
--
ALTER TABLE `classifieds_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_attribute`
--
ALTER TABLE `classifieds_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_attribute_value`
--
ALTER TABLE `classifieds_attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_category`
--
ALTER TABLE `classifieds_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_city`
--
ALTER TABLE `classifieds_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_company_registration`
--
ALTER TABLE `classifieds_company_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_menu`
--
ALTER TABLE `classifieds_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_sub_category`
--
ALTER TABLE `classifieds_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifieds_sub_menu`
--
ALTER TABLE `classifieds_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classifieds_admin`
--
ALTER TABLE `classifieds_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classifieds_attribute`
--
ALTER TABLE `classifieds_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classifieds_attribute_value`
--
ALTER TABLE `classifieds_attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classifieds_category`
--
ALTER TABLE `classifieds_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classifieds_city`
--
ALTER TABLE `classifieds_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classifieds_company_registration`
--
ALTER TABLE `classifieds_company_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classifieds_menu`
--
ALTER TABLE `classifieds_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `classifieds_sub_category`
--
ALTER TABLE `classifieds_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classifieds_sub_menu`
--
ALTER TABLE `classifieds_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
