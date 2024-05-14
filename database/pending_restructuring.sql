-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 09:48 AM
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
-- Table structure for table `pending_restructuring`
--

CREATE TABLE `pending_restructuring` (
  `id` bigint(20) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `c_balance` double NOT NULL,
  `c_account_status` varchar(100) NOT NULL,
  `c_payment_type1` text DEFAULT NULL,
  `c_payment_type2` text DEFAULT NULL,
  `c_net_dp` double DEFAULT NULL,
  `less_dp` double NOT NULL,
  `acc_surcharge1` double NOT NULL,
  `c_no_payments` int(11) DEFAULT NULL,
  `c_monthly_down` double DEFAULT NULL,
  `c_first_dp` date DEFAULT NULL,
  `c_full_down` date DEFAULT NULL,
  `c_amt_financed` double DEFAULT NULL,
  `acc_surcharge2` double NOT NULL,
  `acc_interest` double NOT NULL,
  `c_adj_prin_bal` double NOT NULL,
  `c_terms` int(11) DEFAULT NULL,
  `c_interest_rate` double DEFAULT NULL,
  `c_fixed_factor` double DEFAULT NULL,
  `c_monthly_payment` double DEFAULT NULL,
  `c_start_date` date DEFAULT NULL,
  `c_restructured_date` date DEFAULT NULL,
  `pending_status` int(11) NOT NULL,
  `lvl1` int(11) NOT NULL COMMENT 'BS',
  `lvl2` int(11) NOT NULL COMMENT 'Ghie',
  `lvl3` int(11) NOT NULL COMMENT 'CFO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_restructuring`
--

INSERT INTO `pending_restructuring` (`id`, `property_id`, `c_balance`, `c_account_status`, `c_payment_type1`, `c_payment_type2`, `c_net_dp`, `less_dp`, `acc_surcharge1`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `acc_surcharge2`, `acc_interest`, `c_adj_prin_bal`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_restructured_date`, `pending_status`, `lvl1`, `lvl2`, `lvl3`) VALUES
(19, 1410300901101, 378661.34, 'Partial DownPayment', 'Full DownPayment', 'Monthly Amortization', 61792, 1000, 2000, 1, 62792, '2023-07-05', '2023-07-05', 378661.34, 150000, 400000, 928661.3400000001, 30, 17, 0.04114897, 38213.45, '2023-08-05', '2023-07-05', 0, 1, 1, 1),
(21, 1410300901101, 930661.34, 'Partial DownPayment', 'Full DownPayment', 'Monthly Amortization', 62792, 0, 0, 1, 62792, '2023-07-05', '2023-07-05', 930661.34, 0, 0, 930661.34, 30, 17, 0.04114897, 38213.45, '2023-08-05', '2023-07-05', 1, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pending_restructuring`
--
ALTER TABLE `pending_restructuring`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pending_restructuring`
--
ALTER TABLE `pending_restructuring`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
