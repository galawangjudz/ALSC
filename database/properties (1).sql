-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 08:36 AM
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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` bigint(20) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `project_id` int(11) NOT NULL,
  `c_lot_lid` int(11) NOT NULL,
  `c_type` text NOT NULL,
  `c_date_of_sale` date DEFAULT current_timestamp(),
  `c_account_status` varchar(100) NOT NULL,
  `c_account_type` varchar(20) NOT NULL,
  `c_account_type1` varchar(20) NOT NULL,
  `c_lot_area` double DEFAULT NULL,
  `c_price_sqm` double DEFAULT NULL,
  `c_lot_discount` double DEFAULT NULL,
  `c_lot_discount_amt` double DEFAULT NULL,
  `c_house_model` varchar(100) DEFAULT NULL,
  `c_floor_area` double DEFAULT NULL,
  `c_house_price_sqm` double DEFAULT NULL,
  `c_house_discount` double DEFAULT NULL,
  `c_house_discount_amt` double DEFAULT NULL,
  `c_tcp_discount` double DEFAULT NULL,
  `c_tcp_discount_amt` double DEFAULT NULL,
  `c_tcp` double DEFAULT NULL,
  `c_vat_amount` double DEFAULT NULL,
  `c_net_tcp` double DEFAULT NULL,
  `c_reservation` double DEFAULT NULL,
  `c_payment_type1` text DEFAULT NULL,
  `c_payment_type2` text DEFAULT NULL,
  `c_down_percent` double DEFAULT NULL,
  `c_net_dp` double DEFAULT NULL,
  `c_no_payments` int(11) DEFAULT NULL,
  `c_monthly_down` double DEFAULT NULL,
  `c_first_dp` date DEFAULT NULL,
  `c_full_down` date DEFAULT NULL,
  `c_amt_financed` double DEFAULT NULL,
  `c_terms` int(11) DEFAULT NULL,
  `c_interest_rate` double DEFAULT NULL,
  `c_fixed_factor` double DEFAULT NULL,
  `c_monthly_payment` double DEFAULT NULL,
  `c_start_date` date DEFAULT NULL,
  `c_retention` tinyint(2) NOT NULL,
  `c_change_date` tinyint(2) NOT NULL,
  `c_restructured` tinyint(2) NOT NULL,
  `c_remarks` text NOT NULL,
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive,\r\n1 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `c_csr_no`, `project_id`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_account_status`, `c_account_type`, `c_account_type1`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_retention`, `c_change_date`, `c_restructured`, `c_remarks`, `c_active`) VALUES
(1214500323101, 55, 12, 14500323, '1', '2023-02-17', 'Reservation', 'LOC', 'REG', 76, 4700, 12, 42864, 'None', 0, 0, 0, 0, 2, 6286.72, 308049.28, 36965.91, 345015.19, 20000, 'Partial DownPayment', 'Monthly Amortization', 30, 83504.56, 12, 6958.71, '2023-02-17', '2024-01-17', 241510.63, 120, 14, 0.01552664, 3749.85, '2024-02-17', 0, 0, 0, 'test', 1),
(1214500401301, 52, 12, 14500401, '3', '2023-02-17', 'Reservation', 'LOC', 'REG', 96, 4800, 0, 0, 'ANNIKA', 81, 129999, 0, 0, 12, 1318886.28, 9671832.72, 1160619.93, 10832452.65, 10000, 'Partial DownPayment', 'Monthly Amortization', 20, 2156490.53, 12, 179707.54, '2023-02-17', '2024-02-17', 8665962.12, 120, 15, 0.0161335, 139812.26, '2024-03-17', 0, 0, 0, '', 1),
(1214500405101, 53, 12, 14500405, '1', '2023-02-17', 'Reservation', 'LOC', 'REG', 76, 4600, 12, 41952, 'None', 0, 0, 0, 0, 12, 36917.76, 270730.24, 32487.63, 303217.87, 10000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 293217.87, 0, 0, 0, 0, '2023-02-17', 0, 0, 0, '', 1);

--
-- Triggers `properties`
--
DELIMITER $$
CREATE TRIGGER `tr_generate_property_id` BEFORE INSERT ON `properties` FOR EACH ROW BEGIN
  SET @running_number = (SELECT COALESCE(MAX(SUBSTRING(property_id, -2)), 0) + 1 
                        FROM properties 
                        WHERE project_id = NEW.project_id 
                        AND c_lot_lid = NEW.c_lot_lid 
                        AND c_type = NEW.c_type);
  
  SET NEW.property_id = CONCAT(NEW.project_id, NEW.c_lot_lid, NEW.c_type, LPAD(@running_number, 2, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `fk_c_lot_lid` (`c_lot_lid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
