-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 09:20 AM
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
-- Table structure for table `property_payments`
--

CREATE TABLE `property_payments` (
  `payment_id` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `or_no` varchar(30) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `rebate` decimal(10,2) DEFAULT NULL,
  `surcharge` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `principal` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `payment_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_payments`
--

INSERT INTO `property_payments` (`payment_id`, `property_id`, `payment_amount`, `payment_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `payment_count`) VALUES
(1, NULL, '10000.00', '2023-02-15', '2023-02-15', '12345', '0.00', '0.00', '0.00', '0.00', '10000.00', '347200.00', 'RES', 1),
(4, 1214500602401, '15000.00', '2023-02-15', '2023-02-15', '13421313', '0.00', '0.00', '0.00', '0.00', '15000.00', '460200.00', 'RES', 1),
(5, 1214500602401, '15000.00', '2023-02-15', '2023-02-15', '1453434', '0.00', '0.00', '0.00', '0.00', '15000.00', '445200.00', 'RES', 2),
(6, 1214500505401, '10000.00', '2023-02-16', '2023-02-16', '1234', '0.00', '0.00', '0.00', '0.00', '10000.00', '390200.00', 'RES', 1),
(7, 1214500505401, '10000.00', '2023-02-16', '2023-02-16', '34445', '0.00', '0.00', '0.00', '0.00', '10000.00', '380200.00', 'RES', 2),
(8, 1214500505401, '10000.00', '2023-02-16', '2023-02-16', '343431', '0.00', '0.00', '0.00', '0.00', '10000.00', '370200.00', 'RES', 3),
(9, 14500414401, '20000.00', '2023-02-16', '2023-02-16', '2131414', '0.00', '0.00', '0.00', '0.00', '20000.00', '2413520.00', 'RES', 1),
(10, 14500414401, '20000.00', '2023-02-16', '2023-02-16', '2131414', '0.00', '0.00', '0.00', '0.00', '20000.00', '2413520.00', 'RES', 1),
(11, 14500414401, '20000.00', '2023-02-16', '2023-02-16', '2131414', '0.00', '0.00', '0.00', '0.00', '20000.00', '2413520.00', 'RES', 1),
(12, 1214500413401, '20000.00', '2023-02-16', '2023-02-16', '121212', '0.00', '0.00', '0.00', '0.00', '20000.00', '453088.00', 'RES', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_payments`
--
ALTER TABLE `property_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_payments`
--
ALTER TABLE `property_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_payments`
--
ALTER TABLE `property_payments`
  ADD CONSTRAINT `property_payments_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
