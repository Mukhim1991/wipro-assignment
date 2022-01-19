-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 10:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wipro`
--

-- --------------------------------------------------------

--
-- Table structure for table `router_details`
--

CREATE TABLE `router_details` (
  `sapid` int(18) NOT NULL,
  `hostname` varchar(14) NOT NULL,
  `loopback` varchar(30) NOT NULL,
  `mac_address` varchar(17) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active, 1=Deleted',
  `created_dt` datetime NOT NULL,
  `updated_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `router_details`
--

INSERT INTO `router_details` (`sapid`, `hostname`, `loopback`, `mac_address`, `deleted`, `created_dt`, `updated_dt`) VALUES
(10, 'Host 1', '125.123.123.34', '3D:A2:C9:A6:B3:4F', '0', '2022-01-19 15:07:45', '2022-01-19 15:07:45'),
(11, 'Host 2', '145.33.145.165', '3D:F2:C9:A6:B3:4D', '0', '2022-01-19 15:08:59', '2022-01-19 15:08:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `router_details`
--
ALTER TABLE `router_details`
  ADD PRIMARY KEY (`sapid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `router_details`
--
ALTER TABLE `router_details`
  MODIFY `sapid` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
