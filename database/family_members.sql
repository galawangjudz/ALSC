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
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `member_id` int(11) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
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
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`member_id`, `client_id`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`) VALUES
(7, 2388013150242, 2, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', '  ', '1995-02-02', 27, '  ', 'F', 'Single', 'Filipino', '', '', 'donitarose09@gmail.com', '0934512142434', '', 0),
(8, 2388013150242, 3, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', '  ', '1978-07-12', 44, '  ', 'F', 'Single', 'Filipino', '', '', 'cutiepiesol@yahoo.com', '012121313131', '', 0),
(9, 2394122555552, 2, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '  ', '1995-01-01', 28, '  ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 0),
(10, 2394122555552, 3, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', '  ', '1988-01-31', 34, '  ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 0),
(11, 2394122514926, 2, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '   ', '1995-01-01', 28, '   ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 4),
(12, 2394122519997, 2, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '   ', '1995-01-01', 28, '   ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 4),
(13, 2394122562124, 2, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '   ', '1995-01-01', 28, '   ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 4),
(14, 2396081026185, 2, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', '  ', '1995-02-02', 27, '  ', 'F', 'Single', 'Filipino', '', '', 'donitarose09@gmail.com', '0934512142434', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `property_clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
