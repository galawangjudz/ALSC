-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 02:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alscdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_av_breakdown`
--

CREATE TABLE `t_av_breakdown` (
  `av_id` int(11) NOT NULL,
  `av_no` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `or_no` varchar(30) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `rebate` decimal(10,2) DEFAULT NULL,
  `surcharge` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `principal` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `status_count` smallint(6) NOT NULL,
  `payment_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_av_breakdown`
--

INSERT INTO `t_av_breakdown` (`av_id`, `av_no`, `property_id`, `payment_amount`, `pay_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `status_count`, `payment_count`) VALUES
(37, 12345, 1410300901102, '30000.00', '2023-07-06', '2023-07-06', '432134', '0.00', '0.00', '0.00', '0.00', '30000.00', '378960.00', 'RES', 0, 1),
(38, 12345, 1410300901102, '51792.00', '2023-07-06', '2023-07-06', '1212134', '51792.00', '0.00', '0.00', '0.00', '51792.00', '327168.00', 'FD', 1, 2),
(39, 12345, 1410300901102, '0.00', '2023-07-06', '2023-07-06', 'RSTR-33', '2000.00', '0.00', '1000.00', '1000.00', '0.00', '329168.00', 'RESTRUCTURED', 0, 5),
(40, 314155, 1410300901102, '30000.00', '2023-07-06', '2023-07-06', '432134', '0.00', '0.00', '0.00', '0.00', '30000.00', '378960.00', 'RES', 0, 1),
(41, 314155, 1410300901102, '51792.00', '2023-07-06', '2023-07-06', '1212134', '51792.00', '0.00', '0.00', '0.00', '51792.00', '327168.00', 'FD', 1, 2),
(42, 314155, 1410300901102, '0.00', '2023-07-06', '2023-07-06', 'RSTR-33', '2000.00', '0.00', '1000.00', '1000.00', '0.00', '329168.00', 'RESTRUCTURED', 0, 5),
(43, 13141414, 1410300901102, '30000.00', '2023-07-06', '2023-07-06', '432134', '0.00', '0.00', '0.00', '0.00', '30000.00', '378960.00', 'RES', 0, 1),
(44, 13141414, 1410300901102, '51792.00', '2023-07-06', '2023-07-06', '1212134', '51792.00', '0.00', '0.00', '0.00', '51792.00', '327168.00', 'FD', 1, 2),
(45, 13141414, 1410300901102, '0.00', '2023-07-06', '2023-07-06', 'RSTR-33', '2000.00', '0.00', '1000.00', '1000.00', '0.00', '329168.00', 'RESTRUCTURED', 0, 5),
(46, 131451, 1410300901102, '30000.00', '2023-07-06', '2023-07-06', '432134', '0.00', '0.00', '0.00', '0.00', '30000.00', '378960.00', 'RES', 0, 1),
(47, 131451, 1410300901102, '51792.00', '2023-07-06', '2023-07-06', '1212134', '51792.00', '0.00', '0.00', '0.00', '51792.00', '327168.00', 'FD', 1, 2),
(48, 131451, 1410300901102, '0.00', '2023-07-06', '2023-07-06', 'RSTR-33', '2000.00', '0.00', '1000.00', '1000.00', '0.00', '329168.00', 'RESTRUCTURED', 0, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_av_breakdown`
--
ALTER TABLE `t_av_breakdown`
  ADD PRIMARY KEY (`av_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_av_breakdown`
--
ALTER TABLE `t_av_breakdown`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
