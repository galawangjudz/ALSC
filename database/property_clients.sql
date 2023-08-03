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
-- Table structure for table `property_clients`
--

CREATE TABLE `property_clients` (
  `client_id` bigint(20) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `c_buyer_count` tinyint(4) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `address_abroad` text NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `viber` varchar(25) NOT NULL,
  `gender` text NOT NULL,
  `civil_status` text NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `id_presented` varchar(255) NOT NULL,
  `tin_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `contact_abroad` varchar(100) NOT NULL,
  `relationship` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_clients`
--

INSERT INTO `property_clients` (`client_id`, `property_id`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`) VALUES
(2388013150242, 1214500411401, 1, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', '   ', '1988-01-31', 34, '   ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 0),
(2394120103644, 1214500323401, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', 'SANTOL, BALAGTAS, BULACAN', '3016', '     ', '1994-12-01', 28, '     ', 'F', 'Divorced', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 1),
(2394122514926, 14500414401, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '   ', '1994-12-25', 55, '   ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(2394122519997, 14500414401, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '   ', '1994-12-25', 55, '   ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(2394122555552, 1214500505401, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '    ', '1994-12-25', 28, '    ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(2394122562124, 14500414401, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '   ', '1994-12-25', 55, '   ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(2395010148344, 1214500602401, 1, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '   ', '1995-01-01', 28, '   ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 0),
(2396081026185, 1214500413401, 1, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', '  ', '1996-08-10', 26, '  ', 'M', 'Single', 'Filipino', '', '', 'kimsalibay@gmail.com', '1211455666', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_clients`
--
ALTER TABLE `property_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_clients`
--
ALTER TABLE `property_clients`
  ADD CONSTRAINT `property_clients_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
