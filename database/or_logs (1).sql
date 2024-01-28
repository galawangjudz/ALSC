-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 08:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
-- Table structure for table `or_logs`
--

CREATE TABLE `or_logs` (
  `or_id` bigint(11) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `pay_date` date NOT NULL DEFAULT current_timestamp(),
  `or_no` varchar(30) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `surcharge` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `remaining_balance` decimal(10,2) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `gen_time` datetime NOT NULL DEFAULT current_timestamp(),
  `check_date` date NOT NULL DEFAULT current_timestamp(),
  `branch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `or_logs`
--

INSERT INTO `or_logs` (`or_id`, `property_id`, `pay_date`, `or_no`, `amount_paid`, `amount_due`, `surcharge`, `interest`, `principal`, `rebate`, `remaining_balance`, `mode_of_payment`, `user`, `gen_time`, `check_date`, `branch`) VALUES
(1, 1214500503201, '2023-05-02', '222111', '8840.00', '5840.00', '0.00', '0.00', '59440.00', '0.00', '2834722.00', 'CASH', 'admin', '2023-05-02 15:25:31', '2023-05-02', ''),
(2, 1214500503201, '2023-05-02', '333333', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', 'CASH', 'admin', '2023-05-02 15:26:04', '2023-05-02', ''),
(3, 1214500503201, '2023-05-02', '2333', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', '1', 'admin', '2023-05-02 15:32:25', '2023-05-02', ''),
(4, 1214500503201, '2023-05-02', '1232', '7840.00', '5840.00', '0.00', '0.00', '58440.00', '0.00', '2834722.00', 'cash', 'admin', '2023-05-02 15:59:26', '2023-05-02', ''),
(5, 1214500503201, '2023-05-02', '222222', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', 'cash', 'admin', '2023-05-02 16:00:12', '2023-05-02', ''),
(6, 1214500503201, '2023-05-02', '543212', '2000.00', '5840.00', '0.00', '0.00', '2000.00', '0.00', '2834722.00', '0', 'admin', '2023-05-02 16:43:37', '2023-05-02', ''),
(7, 1214500503201, '2023-05-02', '212121', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', '1', 'admin', '2023-05-02 16:46:14', '2023-01-01', 'SAN FERNANDO'),
(8, 1214500503201, '2023-05-03', '44444', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 08:38:37', '0000-00-00', ''),
(9, 1214500503201, '2023-05-03', '121212', '0.00', '5840.00', '0.00', '0.00', '0.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 09:15:05', '0000-00-00', ''),
(10, 1214500503201, '2023-05-03', '12323123', '11680.00', '5840.00', '0.00', '0.00', '112880.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:36:31', '0000-00-00', ''),
(11, 1214500503201, '2023-05-03', '453545', '17600.00', '5840.00', '0.00', '0.00', '118800.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:38:59', '0000-00-00', ''),
(12, 1214500503201, '2023-05-03', '121212', '5840.00', '5840.00', '0.00', '0.00', '56440.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:39:12', '0000-00-00', ''),
(13, 1214500503201, '2023-05-03', '5545', '100.00', '5840.00', '0.00', '0.00', '100.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:49:29', '0000-00-00', ''),
(14, 1214500503201, '2023-05-03', '55555', '500.00', '5840.00', '0.00', '0.00', '500.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:50:16', '0000-00-00', ''),
(15, 1214500503201, '2023-05-03', '323232', '2000.00', '5840.00', '0.00', '0.00', '2000.00', '0.00', '2834722.00', '-1', 'admin', '2023-05-03 10:51:00', '0000-00-00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `or_logs`
--
ALTER TABLE `or_logs`
  ADD PRIMARY KEY (`or_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `or_logs`
--
ALTER TABLE `or_logs`
  MODIFY `or_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
