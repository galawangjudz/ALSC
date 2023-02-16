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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` bigint(20) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `project_id` int(11) NOT NULL,
  `c_lot_lid` int(11) NOT NULL,
  `c_type` text NOT NULL,
  `c_date_of_sale` date DEFAULT current_timestamp(),
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
  `c_remarks` text NOT NULL,
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive,\r\n1 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `c_csr_no`, `project_id`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_remarks`, `c_active`) VALUES
(14500414401, 30, 0, 14500414, '4', '2023-02-16', 117, 4800, 0, 0, 'FREYA', 100, 20000, 0, 0, 5, 128080, 2433520, 0, 2433520, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 466704, 12, 38892, '2023-01-27', '2024-01-27', 1946816, 120, 15, 0.0161335, 31408.95, '2024-02-27', '', 1),
(14500414402, 30, 0, 14500414, '4', '2023-02-16', 117, 4800, 0, 0, 'FREYA', 100, 20000, 0, 0, 5, 128080, 2433520, 0, 2433520, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 466704, 12, 38892, '2023-01-27', '2024-01-27', 1946816, 120, 15, 0.0161335, 31408.95, '2024-02-27', '', 1),
(1214500323401, 29, 12, 14500323, '4', '2023-02-15', 76, 4700, 0, 0, 'SASHA', 0, 0, 0, 0, 0, 0, 357200, 0, 357200, 10000, 'Full DownPayment', 'Monthly Amortization', 30, 97160, 0, 0, '2023-01-27', '2023-01-27', 250040, 15, 14, 0.07305721, 18267.22, '2023-02-27', '', 1),
(1214500323407, 29, 12, 14500323, '4', '2023-02-15', 76, 4700, 0, 0, 'SASHA', 0, 0, 0, 0, 0, 0, 357200, 0, 357200, 10000, 'Full DownPayment', 'Monthly Amortization', 30, 97160, 0, 0, '2023-01-27', '2023-01-27', 250040, 15, 14, 0.07305721, 18267.22, '2023-02-27', '', 1),
(1214500411401, 35, 12, 14500411, '4', '2023-02-10', 84, 4600, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 386400, 0, 386400, 0, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 386400, 0, 0, 0, 0, '2023-02-16', '4f2ewfg2tw', 1),
(1214500413401, 32, 12, 14500413, '4', '2023-02-16', 112, 4800, 12, 64512, 'None', 0, 0, 0, 0, 0, 0, 473088, 0, 473088, 20000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 453088, 0, 0, 0, 0, '2023-02-16', '', 1),
(1214500414401, 30, 12, 14500414, '4', '2023-02-16', 117, 4800, 0, 0, 'FREYA', 100, 20000, 0, 0, 5, 128080, 2433520, 0, 2433520, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 466704, 12, 38892, '2023-01-27', '2024-01-27', 1946816, 120, 15, 0.0161335, 31408.95, '2024-02-27', '', 1),
(1214500505401, 33, 12, 14500505, '4', '2023-02-16', 87, 4600, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 400200, 0, 400200, 30000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 370200, 0, 0, 0, 0, '2023-02-16', '', 1),
(1214500602401, 31, 12, 14500602, '4', '2023-02-15', 99, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 475200, 0, 475200, 30000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 445200, 0, 0, 0, 0, '2023-02-16', '', 1);

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
