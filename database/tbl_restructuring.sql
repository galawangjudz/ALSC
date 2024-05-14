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
-- Table structure for table `tbl_restructuring`
--

CREATE TABLE `tbl_restructuring` (
  `res_id` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_restructuring`
--

INSERT INTO `tbl_restructuring` (`res_id`, `property_id`, `status`) VALUES
(33, 1410300901102, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_restructuring`
--
ALTER TABLE `tbl_restructuring`
  ADD PRIMARY KEY (`res_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_restructuring`
--
ALTER TABLE `tbl_restructuring`
  ADD CONSTRAINT `tbl_restructuring_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `pending_restructuring` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
