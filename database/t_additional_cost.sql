-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 09:10 AM
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
-- Table structure for table `t_additional_cost`
--

CREATE TABLE `t_additional_cost` (
  `id` int(11) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `floor_elevation` int(11) NOT NULL,
  `aircon_outlets` int(11) NOT NULL,
  `aircon_grill` int(11) NOT NULL,
  `service_area` int(11) NOT NULL,
  `others` int(11) NOT NULL,
  `conv_outlet` float NOT NULL,
  `aircon_outlet_price` float NOT NULL,
  `aircon_grill_price` float NOT NULL,
  `conv_oulet_price` float NOT NULL,
  `service_area_price` float NOT NULL,
  `others_price` float NOT NULL,
  `floor_elev_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_additional_cost`
--

INSERT INTO `t_additional_cost` (`id`, `c_csr_no`, `floor_elevation`, `aircon_outlets`, `aircon_grill`, `service_area`, `others`, `conv_outlet`, `aircon_outlet_price`, `aircon_grill_price`, `conv_oulet_price`, `service_area_price`, `others_price`, `floor_elev_price`) VALUES
(1, 74, 0, 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 29, 0, 2, 2, 2, 2, 0, 2500, 3500, 50000, 60000, 50000, 25000),
(30, 111, 0, 2, 2, 2, 1, 0, 25000, 20000, 0, 30000, 0, 0),
(31, 112, 0, 5, 5, 4, 5, 0, 25, 50, 0, 20, 0, 0),
(32, 113, 0, 5, 5, 4, 5, 0, 25, 50, 0, 20, 0, 0),
(33, 114, 0, 5, 2, 5, 10, 3, 2500, 10000, 0, 20000, 0, 0),
(34, 115, 0, 5, 2, 5, 10, 3, 2500, 10000, 0, 20000, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_additional_cost` (`c_csr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  ADD CONSTRAINT `fk_additional_cost` FOREIGN KEY (`c_csr_no`) REFERENCES `t_csr` (`c_csr_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
