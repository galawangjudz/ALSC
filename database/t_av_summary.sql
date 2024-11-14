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
-- Table structure for table `t_av_summary`
--

CREATE TABLE `t_av_summary` (
  `av_id` int(11) NOT NULL,
  `property_id` text NOT NULL,
  `c_av_no` text NOT NULL,
  `c_av_date` date NOT NULL DEFAULT current_timestamp(),
  `c_av_amount` double DEFAULT 0,
  `c_surcharge` double NOT NULL,
  `c_principal` double NOT NULL,
  `c_interest` double NOT NULL,
  `c_rebate` double NOT NULL,
  `c_deductions` double NOT NULL,
  `c_remarks` text NOT NULL,
  `c_av_type` tinyint(2) NOT NULL COMMENT '1- Relocation / 2- Transfer of Location / 3-Change of Model House / 4 -Downgrade',
  `lvl1` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Pending / 1 = Approved / 2 = Disapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_av_summary`
--

INSERT INTO `t_av_summary` (`av_id`, `property_id`, `c_av_no`, `c_av_date`, `c_av_amount`, `c_surcharge`, `c_principal`, `c_interest`, `c_rebate`, `c_deductions`, `c_remarks`, `c_av_type`, `lvl1`) VALUES
(8, '1410300901102', '12345', '2023-07-06', 81792, 1000, 81792, 1000, 0, 0, 'sample', 0, 0),
(9, '1410300901102', '314155', '2023-07-06', 77237, 0, 81792, 0, 0, 4555, 'sample', 0, 0),
(10, '1410300901102', '13141414', '2023-07-06', 81659, 0, 81792, 0, 0, 133, '1414', 0, 0),
(11, '1410300901102', '131451', '2023-07-06', 81669, 0, 81792, 0, 0, 123, 'sample', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_av_summary`
--
ALTER TABLE `t_av_summary`
  ADD PRIMARY KEY (`av_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_av_summary`
--
ALTER TABLE `t_av_summary`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
