-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 09:18 AM
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
-- Table structure for table `t_projects`
--

CREATE TABLE `t_projects` (
  `c_code` smallint(6) NOT NULL,
  `c_project_code` smallint(6) NOT NULL,
  `c_name` text DEFAULT NULL,
  `c_acronym` text DEFAULT NULL,
  `c_address` text DEFAULT NULL,
  `c_province` text DEFAULT NULL,
  `c_status` smallint(6) DEFAULT NULL,
  `c_zip` smallint(6) DEFAULT NULL,
  `c_rate` double DEFAULT NULL,
  `c_reservation` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_projects`
--

INSERT INTO `t_projects` (`c_code`, `c_project_code`, `c_name`, `c_acronym`, `c_address`, `c_province`, `c_status`, `c_zip`, `c_rate`, `c_reservation`) VALUES
(101, 16, 'ROYALE ESTATE', 'RE', 'Bulihan', 'Malolos City', 1, 3000, 1, 10000),
(102, 11, 'CASA ROYALE', 'CR', 'Sapang Putol', 'San Ildefonso, Bulacan', 1, 3010, 20, 5000),
(103, 14, 'GRAND ROYALE 1', 'GR-1', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(104, 12, 'DREAMCREST HOMES 1', 'DCH-1', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(105, 14, 'GRAND ROYALE 2', 'GR-2', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(106, 13, 'GRAND INDUSTRIAL ESTATE', 'GIE', 'Div. Rd, Parulan', 'Plaridel, Bulacan', 1, 3004, 0, 100000),
(107, 12, 'DREAMCREST HOMES 2-A', 'DCH-2A', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(108, 14, 'GRAND ROYALE 2-A', 'GR-2A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(109, 12, 'DREAMCREST HOMES 2-B', 'DCH-2B', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(110, 14, 'GRAND ROYALE 1-A', 'GR-1A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(111, 14, 'GRAND ROYALE 3', 'GR-3', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(112, 12, 'DREAMCREST HOMES 3', 'DCH-3', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(113, 14, 'GRAND ROYALE 4', 'GR-4', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(114, 12, 'DREAMCREST HOMES 1-A', 'DCH-1A', 'Bulihan', 'Malolos City', 1, 3000, 21, 5000),
(115, 14, 'GRAND ROYALE 5', 'GR-5', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(116, 12, 'DREAMCREST HOMES 4', 'DCH-4', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(117, 12, 'DREAMCREST HOMES 5', 'DCH-5', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(118, 14, 'GRAND ROYALE 5-A', 'GR-5A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(119, 14, 'GRAND ROYALE 6', 'GR-6', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(120, 14, 'GRAND ROYALE 7', 'GR-7', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(121, 14, 'GRAND ROYALE 8', 'GR-8', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(122, 14, 'GRAND ROYALE 9', 'GR-9', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(123, 15, 'THE MEADOWS', 'MEADOWS', 'San Jose Patag', 'Sta. Maria, Bulacan', 1, 3022, 0, 20000),
(124, 14, 'GRAND ROYALE 8-A', 'GR-8A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(125, 14, 'GRAND ROYALE 8-B', 'GR-8B', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(126, 14, 'GRAND ROYALE 8-C', 'GR-8C', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(127, 14, 'GRAND ROYALE 9-A', 'GR-9A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(128, 14, 'GRAND ROYALE 10', 'GR-10', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(129, 14, 'GRAND ROYALE 8-D', 'GR-8D', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(130, 14, 'GRAND ROYALE 7-A', 'GR-7A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(131, 14, 'GRAND ROYALE 8-E', 'GR-8E', 'Longos', 'Malolos City', 1, 3000, 0, 10000),
(132, 14, 'GRAND ROYALE 7-B', 'GR-7B', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(133, 14, 'GRAND ROYALE 1-B', 'GR-1B', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(134, 14, 'GRAND ROYALE 1-C', 'GR-1C', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(135, 14, 'GRAND ROYALE 7-C', 'GR-7C', 'Longos', 'Malolos City', 1, 3000, 0, 10000),
(136, 14, 'GRAND ROYALE 4-A', 'GR-4A', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(137, 12, 'DREAMCREST HOMES 2-C', 'DCH-2C', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(138, 12, 'DREAMCREST HOMES 5-A', 'DCH-5A', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(139, 14, 'GRAND ROYALE 3-A', 'GR-3A', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(140, 14, 'GRAND ROYALE 7-D', 'GR-7D', 'Look 1st', 'Malolos City', 1, 3000, 0, 10000),
(141, 14, 'GRAND ROYALE 7-E', 'GR-7E', 'Lugam', 'Malolos City', 1, 3000, 0, 10000),
(142, 14, 'GRAND ROYALE 5-B', 'GR-5B', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(143, 14, 'GRAND ROYALE 6-A', 'GR-6A', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(144, 14, 'GRAND ROYALE 5-C', 'GR-5C', 'Mojon', 'Malolos City', 1, 3000, 0, 10000),
(145, 12, 'DREAMCREST HOMES 5-B', 'DCH-5B', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(146, 14, 'GRAND ROYALE 7-F', 'GR-7F', 'Longos', 'Malolos City', 1, 3000, 0, 10000),
(147, 12, 'DREAMCREST HOMES 5-C', 'DCH-5C', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(148, 14, 'GRAND ROYALE 6-B', 'GR-6B', 'Pinagbakahan', 'Malolos City', 1, 3000, 0, 10000),
(149, 17, 'WOODLANDS OF GRAND ROYALE', 'WGR', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(150, 16, 'ROYALE ESTATE 2', 'RE-2', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(151, 14, 'GRAND ROYALE 5-D', 'GR-5D', 'Mojon', 'Malolos City', 1, 3000, 0, 10000),
(152, 10, 'CASABUENA DE PULILAN', 'CBP', 'Cutcot', 'Pulilan, Bulacan', 1, 3005, 0, 10000),
(153, 14, 'GRAND ROYALE 1-D', 'GR-1D', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(154, 14, 'GRAND ROYALE 1-E', 'GR-1E', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(155, 14, 'GRAND ROYALE 7-G', 'GR-7G', 'Look 1st', 'Malolos City', 1, 3000, 0, 10000),
(156, 17, 'WOODLANDS OF GRAND ROYALE 2', 'WGR-2', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(157, 10, 'CASABUENA DE PULILAN 2', 'CBP-2', 'Cutcut', 'Pulilan, Bulacan', 1, 3005, 0, 10000),
(158, 12, 'DREAMCREST HOMES 2-D', 'DCH-2D', 'Longos', 'Malolos City', 1, 3000, 21, 5000),
(159, 14, 'GRAND ROYALE 7-H', 'GR-7H', 'Longos', 'Malolos City', 0, 3000, 0, 10000),
(160, 14, 'GRAND ROYALE 1-F', 'GR-1F', 'Mojon', 'Malolos City', 0, 3000, 0, 10000),
(161, 10, 'CASABUENA DE PULILAN 1-A', 'CBP-1A', 'Cutcut', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(162, 12, 'DREAMCREST HOMES 5-D', 'DCH-5D', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(163, 17, 'WOODLANDS OF GRAND ROYALE 3', 'WGR-3', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(164, 15, 'THE MEADOWS 2', 'MEADOWS-2', 'San Jose Patag', 'Sta. Maria, Bulacan', 0, 3022, 0, 20000),
(165, 14, 'GRAND ROYALE 3-B', 'GR-3B', 'Pinagbakahan', 'Malolos City', 0, 3000, 0, 10000),
(166, 10, 'CASABUENA DE PULILAN 2A', 'CBP-2A', 'Cutcut', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(167, 17, 'WOODLANDS OF GRAND ROYALE 1-A', 'WGR-1A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(168, 10, 'CASABUENA DE PULILAN 3', 'CBP-3', 'Cutcot', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(169, 10, 'CASABUENA DE PULILAN 4', 'CBP-4', 'Cutcut', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(170, 10, 'CASABUENA DE PULILAN 2B', 'CBP-2B', 'Cutcot', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(171, 14, 'GRAND ROYALE 7-I', 'GR-7I', 'Longos', 'Malolos City', 0, 3000, 0, 10000),
(172, 10, 'CASABUENA DE PULILAN 5', 'CBP-5', 'Cutcut', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(173, 14, 'GRAND ROYALE 6-C', 'GR-6C', 'Pinagbakahan', 'Malolos City', 0, 3000, 0, 10000),
(174, 17, 'WOODLANDS OF GRAND ROYALE 4', 'WGR-4', 'Anilao', 'Malolos City', 0, 3000, 0, 10000),
(175, 14, 'GRAND ROYALE 9-B', 'GR-9B', 'Lugam', 'Malolos City', 0, 3000, 0, 10000),
(176, 17, 'WOODLANDS OF GRAND ROYALE 2-A', 'WGR-2A', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(177, 17, 'WOODLANDS OF GRAND ROYALE 1-B', 'WGR-1B', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(178, 14, 'GRAND ROYALE 8-F', 'GR-8F', 'Longos', 'Malolos City', 0, 3000, 0, 10000),
(179, 14, 'GRAND ROYALE 6-E', 'GR-6E', 'Pinagbakahan', 'Malolos City', 0, 3000, 0, 10000),
(180, 10, 'CASABUENA DE PULILAN 1B', 'CBP-1B', 'Cutcot', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(181, 17, 'WOODLANDS OF GRAND ROYALE 2-B', 'WGR-2B', 'Bulihan', 'Malolos City', 0, 3000, 0, 10000),
(182, 10, 'CASABUENA DE PULILAN 3A', 'CBP-3A', 'Cutcot', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(183, 10, 'CASABUENA DE PULILAN 5-A', 'CBP-5A', 'Cutcut', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(184, 14, 'GRAND ROYALE 6-D', 'GR-6D', 'Pinagbakahan', 'Malolos City', 0, 3000, 0, 10000),
(185, 12, 'DREAMCREST HOMES 5-E', 'DCH-5E', 'Longos', 'Malolos City', 0, 3000, 21, 5000),
(186, 10, 'CASABUENA DE PULILAN 3-B', 'CBP-3B', 'Paltao', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(187, 10, 'CASABUENA DE PULILAN 5-B', 'CBP-5B', 'Cutcot', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(188, 14, 'GRAND ROYALE 7-J', 'GR-7J', 'Looc 1st', 'Malolos City', 0, 3000, 0, 10000),
(189, 10, 'CASABUENA DE PULILAN 3-C', 'CBP-3C', 'Paltao', 'Pulilan, Bulacan', 0, 3005, 0, 10000),
(190, 16, 'ROYALE ESTATE - HOUSE', 'RE-AH', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(191, 11, 'CASA ROYALE - HOUSE', 'CR-AH', 'Sapang Putol', 'San Ildefonso, Bulacan', 1, 3010, 20, 5000),
(192, 12, 'DREAMCREST HOMES - HOUSE', 'DCH-AH', 'Longos', 'Malolos City', 1, 3000, 21, 5000),
(193, 14, 'GRAND ROYALE - HOUSE', 'GR-AH', 'Bulihan', 'Malolos City', 1, 3000, 0, 10000),
(194, 15, 'THE MEADOWS - HOUSE', 'MEAD-AH', 'San Jose Patag', 'Sta. Maria, Bulacan', 1, 3022, 0, 10000),
(195, 10, 'CASABUENA DE PULILAN', 'CBP-2C', '', 'Pulilan, Bulacan', 1, 3005, 0, 0),
(196, 10, 'CASABUENA DE PULILAN', 'CBP-3D', '', 'Pulilan, Bulacan', 1, 3005, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_projects`
--
ALTER TABLE `t_projects`
  ADD PRIMARY KEY (`c_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
