-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 09:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(30) NOT NULL,
  `code` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `code`, `group_id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 11001, 1, 'Cash on Hand', '', 1, 0, '2023-10-27 08:24:01', NULL),
(2, 11002, 1, 'Petty Cash Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(3, 11003, 1, 'Cash in Bank - AllBank - Plaridel - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(4, 11004, 1, 'Cash in Bank - SBC-Malolos -CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(5, 11005, 1, 'Cash in Bank - Maybank - CA – Hagonoy', '', 1, 0, '2023-10-27 08:24:01', NULL),
(6, 11006, 1, 'Cash in Bank - PNB - Malolos - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(7, 11007, 1, 'Cash in Bank - BPI - BAL- CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(8, 11008, 1, 'Cash in Bank - BDO - Manila - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(9, 11009, 1, 'Cash in Bank - RBSR - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(10, 11010, 1, 'Cash in Bank - PDB Makati', '', 1, 0, '2023-10-27 08:24:01', NULL),
(11, 11011, 1, 'Cash in Bank -PDB-CA-Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(12, 11012, 1, 'Cash in Bank - PSB-Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(13, 11013, 1, 'Cash in Bank -Landbank-Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(14, 11014, 1, 'Cash in Bank -BDO-Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(15, 11015, 1, 'Cash in Bank -Union Bank - Baliuag -CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(16, 11016, 1, 'Cash in Bank -MAYBANK-CA-BALIUAG', '', 1, 0, '2023-10-27 08:24:01', NULL),
(17, 11017, 1, 'Cash in Bank -UCPB-Balagtas-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(18, 11018, 1, 'Cash in Bank - Landbank - Pulilan - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(19, 11019, 1, 'Cash in Bank - SBC - ALSC Security Services', '', 1, 0, '2023-10-27 08:24:01', NULL),
(20, 11020, 1, 'Cash in Bank - Landbank - Pulilan - SA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(21, 11021, 1, 'Cash in Bank - Philippines Business Bank - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(22, 11022, 1, 'Cash in Bank - Metrobank - Plaridel-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(23, 11023, 1, 'Cash in Bank - PSBank - TD', '', 1, 0, '2023-10-27 08:24:01', NULL),
(24, 11024, 1, 'Cash in Bank - PNB$', '', 1, 0, '2023-10-27 08:24:01', NULL),
(25, 11025, 1, 'Cash in Bank - SBC$', '', 1, 0, '2023-10-27 08:24:01', NULL),
(26, 11026, 1, 'Cash in Bank - CBS - CA-Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(27, 11027, 1, 'Cash in Bank - AUB - Caloocan -SA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(28, 11028, 1, 'Cash in Bank - Bank of Makati - Malolos - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(29, 11029, 1, 'Installment Contract Receivable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(30, 11030, 1, 'Accounts Receivable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(31, 11031, 1, 'Cash in Bank - Metrobank-Malolos-SA-UITF', '', 1, 0, '2023-10-27 08:24:01', NULL),
(32, 11032, 1, 'Cash in Bank - PBCOM-Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(33, 11033, 1, 'Cash in Bank - BOC CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(34, 11034, 1, 'Cash in Bank - Metrobank - Malolos SA$ UITF', '', 1, 0, '2023-10-27 08:24:01', NULL),
(35, 11035, 1, 'TBA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(36, 11036, 1, 'Cash in Bank - CBS-CA-Buendia', '', 1, 0, '2023-10-27 08:24:01', NULL),
(37, 11037, 1, 'Cash in Bank -UCPB-Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(38, 11038, 1, 'Cash in Bank - Philippine Veterans Bank - Malolos-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(39, 11039, 1, 'Time Deposit - BOC$-Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(40, 11040, 1, 'Time Deposit - Phil Business', '', 1, 0, '2023-10-27 08:24:01', NULL),
(41, 11041, 1, 'Time Deposit - MBTC - Balagtas', '', 1, 0, '2023-10-27 08:24:01', NULL),
(42, 11042, 1, 'Time Deposit - PDB Main', '', 1, 0, '2023-10-27 08:24:01', NULL),
(43, 11043, 1, 'Time Deposit - PDB Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(44, 11044, 1, 'Time Deposit- BOC$- Baliuag', '', 1, 0, '2023-10-27 08:24:01', NULL),
(45, 11045, 1, 'Cash in Bank - RCBC-Plaridel-CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(46, 11046, 1, 'Cash in Bank - Metrobank Malolos (Investment)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(47, 11047, 1, 'Cash in Bank - Robinsons Bank - Mal - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(48, 11048, 1, 'AR Telephone', '', 1, 0, '2023-10-27 08:24:01', NULL),
(49, 11049, 1, 'A/R - Toll Fees', '', 1, 0, '2023-10-27 08:24:01', NULL),
(50, 11050, 1, 'A/R - Gasoline', '', 1, 0, '2023-10-27 08:24:01', NULL),
(51, 11051, 1, 'Time Deposit - MBTC-Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(52, 11052, 1, 'Account Receivable Others', '', 1, 0, '2023-10-27 08:24:01', NULL),
(53, 11053, 1, 'Advances to Officers & Employees', '', 1, 0, '2023-10-27 08:24:01', NULL),
(54, 11054, 1, 'Advances to Agents', '', 1, 0, '2023-10-27 08:24:01', NULL),
(55, 11055, 1, 'Advances to Supplier', '', 1, 0, '2023-10-27 08:24:01', NULL),
(56, 11056, 1, 'A/R-SSS', '', 1, 0, '2023-10-27 08:24:01', NULL),
(57, 11057, 1, 'A/R-Philhealth', '', 1, 0, '2023-10-27 08:24:01', NULL),
(58, 11058, 1, 'Due from Manila Water', '', 1, 0, '2023-10-27 08:24:01', NULL),
(59, 11059, 1, 'A/R - Meralco (Extension of Facilities)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(60, 11060, 1, 'Prepaid Expenses', '', 1, 0, '2023-10-27 08:24:01', NULL),
(61, 11061, 1, 'Advances to Affiliates', '', 1, 0, '2023-10-27 08:24:01', NULL),
(62, 11062, 1, 'Time Deposit - RCBC-Plaridel', '', 1, 0, '2023-10-27 08:24:01', NULL),
(63, 11063, 1, 'Cash in Bank - UBP - Baliwag - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(64, 11064, 1, 'Time Deposit - CBS - Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(65, 11065, 1, 'Time Deposit - UCPB - Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(66, 11066, 1, 'FWD Life Insurance Corp. - Peso Account', '', 1, 0, '2023-10-27 08:24:01', NULL),
(67, 11067, 1, 'FWD Life Insurance Corp. - Dollar Account', '', 1, 0, '2023-10-27 08:24:01', NULL),
(68, 11068, 1, 'Cash in Bank -BOC SA$ - Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(69, 11069, 1, 'Cash in Bank - SBC - FWD Dollar -Plaridel', '', 1, 0, '2023-10-27 08:24:01', NULL),
(70, 11070, 1, 'Cash in Bank - Metrobank $SA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(71, 11071, 1, 'Cash in Bank - SBC FWD Dollar Investment -Mal', '', 1, 0, '2023-10-27 08:24:01', NULL),
(72, 11072, 1, 'Time Deposit - Metrobank - Malolos', '', 1, 0, '2023-10-27 08:24:01', NULL),
(73, 11073, 1, 'Cash in Bank - Metrobank - Malolos - CA', '', 1, 0, '2023-10-27 08:24:01', NULL),
(74, 11074, 1, 'Receivable from GHP Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(75, 11075, 1, 'Inventory', '', 1, 0, '2023-10-27 08:24:01', NULL),
(76, 11076, 1, 'Input VAT', '', 1, 0, '2023-10-27 08:24:01', NULL),
(77, 11077, 1, 'Creditable Withholding Tax (1606 & 2307)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(78, 11078, 1, 'Prepaid Income Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(79, 11079, 1, 'Prior Years Excess Credits', '', 1, 0, '2023-10-27 08:24:01', NULL),
(80, 11080, 1, 'Final Tax on Interest Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(81, 11081, 1, 'Deferred Input VAT', '', 1, 0, '2023-10-27 08:24:01', NULL),
(82, 11082, 1, 'TBA (To Be Accounted)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(83, 11083, 1, 'Land', '', 1, 0, '2023-10-27 08:24:01', NULL),
(84, 11084, 1, 'Office Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(85, 11085, 1, 'Furniture & Fixtures', '', 1, 0, '2023-10-27 08:24:01', NULL),
(86, 11086, 1, 'Transportation Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(87, 11087, 1, 'Computer Software', '', 1, 0, '2023-10-27 08:24:01', NULL),
(88, 11088, 1, 'Office Building & Improvements', '', 1, 0, '2023-10-27 08:24:01', NULL),
(89, 11089, 1, 'Construction in Progress', '', 1, 0, '2023-10-27 08:24:01', NULL),
(90, 11090, 1, 'Deferred Charges', '', 1, 0, '2023-10-27 08:24:01', NULL),
(91, 11091, 1, 'Investment Property', '', 1, 0, '2023-10-27 08:24:01', NULL),
(92, 11092, 1, 'Office Equipment Accessories', '', 1, 0, '2023-10-27 08:24:01', NULL),
(93, 11093, 1, 'Communication Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(94, 11094, 1, 'Security Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(95, 11095, 1, 'Land Improvement', '', 1, 0, '2023-10-27 08:24:01', NULL),
(96, 11096, 1, 'Ground Maintenance Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(97, 11097, 1, 'Equipment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(98, 11098, 1, 'Development Cost - Land Acquisition', '', 1, 0, '2023-10-27 08:24:01', NULL),
(99, 11099, 1, 'Development Cost-house', '', 1, 0, '2023-10-27 08:24:01', NULL),
(100, 11100, 1, 'Development Cost Land', '', 1, 0, '2023-10-27 08:24:01', NULL),
(101, 11101, 1, 'Due from Jam Asia', '', 1, 0, '2023-10-27 08:24:01', NULL),
(102, 11102, 1, 'Due from PSMI', '', 1, 0, '2023-10-27 08:24:01', NULL),
(103, 11103, 1, 'Due from ALSC Village Security Services', '', 1, 0, '2023-10-27 08:24:01', NULL),
(104, 11104, 1, 'Accumulated Depreciation', '', 1, 0, '2023-10-27 08:24:01', NULL),
(105, 21001, 4, 'Accounts Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(106, 21002, 4, 'Accounts Payable Trade', '', 1, 0, '2023-10-27 08:24:01', NULL),
(107, 21003, 4, 'GHP Settlement Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(108, 21004, 4, 'Payable to Officers', '', 1, 0, '2023-10-27 08:24:01', NULL),
(109, 21005, 4, 'Payable to GHP Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(110, 21006, 4, 'SSS Premium Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(111, 21007, 4, 'SSS Loans Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(112, 21008, 4, 'Medicare Premium Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(113, 21009, 4, 'Pag-Ibig Premium Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(114, 21010, 4, 'Pag-Ibig Multi Loan Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(115, 21011, 4, 'Pag-Ibig Calamity Loan Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(116, 21012, 4, 'Expanded Withholding Tax Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(117, 21013, 4, 'Withholding Tax Payable - Compensation', '', 1, 0, '2023-10-27 08:24:01', NULL),
(118, 21014, 4, 'Unearned Interest Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(119, 21015, 4, 'Vat Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(120, 21016, 4, 'Income Tax payables', '', 1, 0, '2023-10-27 08:24:01', NULL),
(121, 21017, 4, 'Processing Fee Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(122, 21018, 4, 'Electric/Water Billing Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(123, 21019, 4, 'Other Payables', '', 1, 0, '2023-10-27 08:24:01', NULL),
(124, 21020, 4, 'Pag-Ibig Loan Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(125, 21021, 4, 'GHP Contribution Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(126, 21022, 4, 'Output VAT', '', 1, 0, '2023-10-27 08:24:01', NULL),
(127, 21023, 4, 'Contract Payables', '', 1, 0, '2023-10-27 08:24:01', NULL),
(128, 21024, 4, 'SSS Calamity Loan Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(129, 21025, 4, 'Pag-ibig Savings Contribution', '', 1, 0, '2023-10-27 08:24:01', NULL),
(130, 21026, 4, 'Employees Share-GHP', '', 1, 0, '2023-10-27 08:24:01', NULL),
(131, 21027, 4, 'Garbage Fee Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(132, 21028, 4, 'Laborers SSS Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(133, 21029, 4, 'Laborers Philhealth Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(134, 21030, 4, 'Advances from Manila Water', '', 1, 0, '2023-10-27 08:24:01', NULL),
(135, 21031, 4, 'Advances from Officers', '', 1, 0, '2023-10-27 08:24:01', NULL),
(136, 21032, 4, 'Deferred Expanded Withholding Tax Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(137, 21033, 4, 'Unearned Rental Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(138, 21034, 4, 'PBB Loan - Personal', '', 1, 0, '2023-10-27 08:24:01', NULL),
(139, 21035, 4, 'SSS WISP', '', 1, 0, '2023-10-27 08:24:01', NULL),
(140, 21036, 4, 'Deferred Gross Profit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(141, 21037, 4, 'Retention Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(142, 21038, 4, 'Car Loan Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(143, 21039, 4, 'Loans Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(144, 21040, 4, 'Construction Bond Payable', '', 1, 0, '2023-10-27 08:24:01', NULL),
(145, 21041, 4, 'Electric Sub Meter Deposit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(146, 21042, 4, 'Security Bond Deposit - Current', '', 1, 0, '2023-10-27 08:24:01', NULL),
(147, 21043, 4, 'Customer Deposit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(148, 21044, 4, 'Accrued Pension', '', 1, 0, '2023-10-27 08:24:01', NULL),
(149, 21045, 4, 'Accrued Gratuity', '', 1, 0, '2023-10-27 08:24:01', NULL),
(150, 21046, 4, 'Titling Bond', '', 1, 0, '2023-10-27 08:24:01', NULL),
(151, 20147, 4, 'Goods Receipt', '', 1, 0, '2023-10-27 08:24:01', NULL),
(152, 31001, 5, 'Share Capital', '', 1, 0, '2023-10-27 08:24:01', NULL),
(153, 31002, 5, 'Reserves', '', 1, 0, '2023-10-27 08:24:01', NULL),
(154, 31003, 5, 'Retained Earnings', '', 1, 0, '2023-10-27 08:24:01', NULL),
(155, 31004, 5, 'Retained Earnings Adjustments', '', 1, 0, '2023-10-27 08:24:01', NULL),
(156, 31005, 5, 'Dividend', '', 1, 0, '2023-10-27 08:24:01', NULL),
(157, 31006, 5, 'Prior Period Adjustment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(158, 41001, 2, 'Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(159, 41002, 2, 'Installment Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(160, 41003, 2, 'Realized Gross Profit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(161, 41004, 2, 'Reservation Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(162, 41005, 2, 'Interest Income on Bank Deposit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(163, 41006, 2, 'Penalties & Surcharge Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(164, 41007, 2, 'Dividend Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(165, 41008, 2, 'Insurance Claims', '', 1, 0, '2023-10-27 08:24:01', NULL),
(166, 41009, 2, 'Other Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(167, 41010, 2, 'Downpayment', '', 1, 0, '2023-10-27 08:24:01', NULL),
(168, 41011, 2, 'Processing Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(169, 41012, 2, 'Interest Income on Salary Loan', '', 1, 0, '2023-10-27 08:24:01', NULL),
(170, 41013, 2, 'Water Bill', '', 1, 0, '2023-10-27 08:24:01', NULL),
(171, 41014, 2, 'Electric Bill', '', 1, 0, '2023-10-27 08:24:01', NULL),
(172, 41015, 2, 'Interest Income on Installment Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(173, 41016, 2, 'Maintenance Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(174, 41017, 2, 'Processing Fee from Refund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(175, 41018, 2, 'Rental Fee from Refund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(176, 41019, 2, 'Cancellation Fee from Refund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(177, 41020, 2, 'Processing Fee - Title', '', 1, 0, '2023-10-27 08:24:01', NULL),
(178, 41021, 2, 'Processing Fee - Miscellaneous', '', 1, 0, '2023-10-27 08:24:01', NULL),
(179, 41022, 2, 'Closing Fee - Government Taxes', '', 1, 0, '2023-10-27 08:24:01', NULL),
(180, 41023, 2, 'Closing Fee - Administrative', '', 1, 0, '2023-10-27 08:24:01', NULL),
(181, 41024, 2, 'Processing Fee - ATC', '', 1, 0, '2023-10-27 08:24:01', NULL),
(182, 41025, 2, 'Contingent', '', 1, 0, '2023-10-27 08:24:01', NULL),
(183, 41026, 2, 'Closing fee - Miscellaneous', '', 1, 0, '2023-10-27 08:24:01', NULL),
(184, 41027, 2, 'Restoration Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(185, 41028, 2, 'Closing Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(186, 41029, 2, 'Legal Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(187, 41030, 2, 'Discount', '', 1, 0, '2023-10-27 08:24:01', NULL),
(188, 41031, 2, 'Rental Income', '', 1, 0, '2023-10-27 08:24:01', NULL),
(189, 41032, 2, 'Direct Materials', '', 1, 0, '2023-10-27 08:24:01', NULL),
(190, 41033, 2, 'Direct Labor', '', 1, 0, '2023-10-27 08:24:01', NULL),
(191, 41034, 2, 'Overhead', '', 1, 0, '2023-10-27 08:24:01', NULL),
(192, 41035, 2, 'Cost of Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(193, 41036, 2, 'Cost of Installment Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(194, 41037, 2, 'Discount of Installment Sales', '', 1, 0, '2023-10-27 08:24:01', NULL),
(195, 41038, 2, 'Streetlights', '', 1, 0, '2023-10-27 08:24:01', NULL),
(196, 41039, 2, 'Security Service Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(197, 41040, 2, 'Innove Current Bill Adjustments', '', 1, 0, '2023-10-27 08:24:01', NULL),
(198, 41041, 2, 'Check Replacement Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(199, 41042, 2, 'Purchase Rebates', '', 1, 0, '2023-10-27 08:24:01', NULL),
(200, 51001, 3, 'Bank Charges', '', 1, 0, '2023-10-27 08:24:01', NULL),
(201, 51002, 3, 'Bonuses', '', 1, 0, '2023-10-27 08:24:01', NULL),
(202, 51003, 3, 'Capital Gains Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(203, 51004, 3, 'Directors Benefit', '', 1, 0, '2023-10-27 08:24:01', NULL),
(204, 51005, 3, 'Documentary Stamp Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(205, 51006, 3, 'Donations', '', 1, 0, '2023-10-27 08:24:01', NULL),
(206, 51007, 3, 'Education and Training', '', 1, 0, '2023-10-27 08:24:01', NULL),
(207, 51008, 3, 'Employee Benefits & Incentives', '', 1, 0, '2023-10-27 08:24:01', NULL),
(208, 51009, 3, 'Employers Share-GHP', '', 1, 0, '2023-10-27 08:24:01', NULL),
(209, 51010, 3, 'Estate Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(210, 51011, 3, 'Gasoline', '', 1, 0, '2023-10-27 08:24:01', NULL),
(211, 51012, 3, 'Income Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(212, 51013, 3, 'Insurance Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(213, 51014, 3, 'Interest Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(214, 51015, 3, 'Light, Power & Water', '', 1, 0, '2023-10-27 08:24:01', NULL),
(215, 51016, 3, 'Membership Fee Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(216, 51017, 3, 'Miscellaneous', '', 1, 0, '2023-10-27 08:24:01', NULL),
(217, 51018, 3, 'Office Equipment Supplies', '', 1, 0, '2023-10-27 08:24:01', NULL),
(218, 51019, 3, 'Office Kitchen Supplies', '', 1, 0, '2023-10-27 08:24:01', NULL),
(219, 51020, 3, 'Office Supplies', '', 1, 0, '2023-10-27 08:24:01', NULL),
(220, 51021, 3, 'Other Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(221, 51022, 3, 'Other Supplies', '', 1, 0, '2023-10-27 08:24:01', NULL),
(222, 51023, 3, 'Penalties', '', 1, 0, '2023-10-27 08:24:01', NULL),
(223, 51024, 3, 'Pension Plan/Trust Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(224, 51025, 3, 'Postage & Telephone', '', 1, 0, '2023-10-27 08:24:01', NULL),
(225, 51026, 3, 'Processing Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(226, 51027, 3, 'Professional Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(227, 51028, 3, 'Promotion & Advertisement', '', 1, 0, '2023-10-27 08:24:01', NULL),
(228, 51029, 3, 'Real Property Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(229, 51030, 3, 'Rental Expense - Photocopier', '', 1, 0, '2023-10-27 08:24:01', NULL),
(230, 51031, 3, 'Repairs & Maintenance', '', 1, 0, '2023-10-27 08:24:01', NULL),
(231, 51032, 3, 'Representation', '', 1, 0, '2023-10-27 08:24:01', NULL),
(232, 51033, 3, 'Retirement And Gratuities', '', 1, 0, '2023-10-27 08:24:01', NULL),
(233, 51034, 3, 'Salaries & Wages', '', 1, 0, '2023-10-27 08:24:01', NULL),
(234, 51035, 3, 'Sales Incentives', '', 1, 0, '2023-10-27 08:24:01', NULL),
(235, 51036, 3, 'Sales Allowances', '', 1, 0, '2023-10-27 08:24:01', NULL),
(236, 51037, 3, 'Sales Commissions', '', 1, 0, '2023-10-27 08:24:01', NULL),
(237, 51038, 3, 'Security Expenses', '', 1, 0, '2023-10-27 08:24:01', NULL),
(238, 51039, 3, 'Separation Benefits', '', 1, 0, '2023-10-27 08:24:01', NULL),
(239, 51040, 3, 'SSS/PHIC/HDMF ER Share', '', 1, 0, '2023-10-27 08:24:01', NULL),
(240, 51041, 3, 'Subscription & Publication', '', 1, 0, '2023-10-27 08:24:01', NULL),
(241, 51042, 3, 'Loans Incentive', '', 1, 0, '2023-10-27 08:24:01', NULL),
(242, 51043, 3, 'Taxes, Licenses & Permits', '', 1, 0, '2023-10-27 08:24:01', NULL),
(243, 51044, 3, 'Thirteen Month Pay', '', 1, 0, '2023-10-27 08:24:01', NULL),
(244, 51045, 3, 'Transfer Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(245, 51046, 3, 'Transportation', '', 1, 0, '2023-10-27 08:24:01', NULL),
(246, 51047, 3, 'Building Permit Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(247, 51048, 3, 'Cancellation Fee-RD', '', 1, 0, '2023-10-27 08:24:01', NULL),
(248, 51049, 3, 'Car Sticker Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(249, 51050, 3, 'CEI & OCC Permit Expenses', '', 1, 0, '2023-10-27 08:24:01', NULL),
(250, 51051, 3, 'Landscaping', '', 1, 0, '2023-10-27 08:24:01', NULL),
(251, 51052, 3, 'Market Value Loss', '', 1, 0, '2023-10-27 08:24:01', NULL),
(252, 51053, 3, 'Meralco Meter Deposit Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(253, 51054, 3, 'Registration Fee-RD', '', 1, 0, '2023-10-27 08:24:01', NULL),
(254, 51055, 3, 'Temporary Electric Supply', '', 1, 0, '2023-10-27 08:24:01', NULL),
(255, 51056, 3, 'Signages', '', 1, 0, '2023-10-27 08:24:01', NULL),
(256, 51057, 3, 'Donor`s Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(257, 51058, 3, 'Survey', '', 1, 0, '2023-10-27 08:24:01', NULL),
(258, 51059, 3, 'Payment Center Charges', '', 1, 0, '2023-10-27 08:24:01', NULL),
(259, 51060, 3, 'Salaries and Wages - Security (Outsourced)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(260, 51061, 3, 'Salaries and Wages - Contractual Employees', '', 1, 0, '2023-10-27 08:24:01', NULL),
(261, 51062, 3, 'Salaries and Wages - Laborers', '', 1, 0, '2023-10-27 08:24:01', NULL),
(262, 51063, 3, 'Printing Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(263, 51064, 3, 'Payoff Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(264, 51065, 3, 'SSS/PHIC/HDMF ER Share - Laborers', '', 1, 0, '2023-10-27 08:24:01', NULL),
(265, 51066, 3, 'Miscellaneous Tax (Surcharge)', '', 1, 0, '2023-10-27 08:24:01', NULL),
(266, 51067, 3, 'Agency Fee', '', 1, 0, '2023-10-27 08:24:01', NULL),
(267, 51068, 3, 'Deficiency Tax', '', 1, 0, '2023-10-27 08:24:01', NULL),
(268, 51069, 3, 'Fire Prevention Expense', '', 1, 0, '2023-10-27 08:24:01', NULL),
(269, 51070, 3, 'Escrow Fund', '', 1, 0, '2023-10-27 08:24:01', NULL),
(270, 51071, 3, 'Legal Expenses', '', 1, 0, '2023-10-27 08:24:01', NULL),
(271, 51072, 3, 'Documentary Stamp Tax - Deficiency', '', 1, 0, '2023-10-27 08:24:01', NULL),
(272, 51073, 3, 'Miscellaneous Tax - Deficiency', '', 1, 0, '2023-10-27 08:24:01', NULL),
(273, 51074, 3, 'Income Tax - Deficiency', '', 1, 0, '2023-10-27 08:24:01', NULL),
(274, 51075, 3, 'Expanded Withholding Tax - Deficiency', '', 1, 0, '2023-10-27 08:24:01', NULL),
(275, 51076, 3, 'Vat - Deficiency', '', 1, 0, '2023-10-27 08:24:01', NULL),
(276, 51077, 3, 'Suspense Account', '', 1, 0, '2023-10-27 08:24:01', NULL),
(279, 20132, 1, 'TEST', '', 1, 1, '2024-03-04 13:18:23', '2024-03-04 13:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `approved_order_items`
--

CREATE TABLE `approved_order_items` (
  `id` int(11) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `po_id` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` float NOT NULL,
  `received` float NOT NULL DEFAULT 0,
  `outstanding` float NOT NULL DEFAULT 0,
  `del_items` int(11) NOT NULL,
  `date_purchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_order_items`
--

INSERT INTO `approved_order_items` (`id`, `gr_id`, `po_id`, `item_id`, `default_unit`, `unit_price`, `quantity`, `received`, `outstanding`, `del_items`, `date_purchased`) VALUES
(2659, 0, '661', 142, 'piece', 320.00, 6, 0, 6, 0, '2024-03-26 14:17:57'),
(2660, 0, '661', 143, 'set', 26.00, 20, 0, 20, 0, '2024-03-26 14:17:57'),
(2661, 0, '661', 144, 'piece', 375.00, 3, 0, 3, 0, '2024-03-26 14:17:57'),
(2662, 0, '661', 145, 'piece', 270.00, 3, 0, 3, 0, '2024-03-26 14:17:57'),
(2663, 0, '661', 146, 'piece', 575.00, 5, 0, 5, 0, '2024-03-26 14:17:57'),
(2664, 0, '661', 147, 'piece', 575.00, 5, 0, 5, 0, '2024-03-26 14:17:57'),
(2665, 0, '661', 148, 'piece', 1660.00, 1, 0, 1, 0, '2024-03-26 14:17:57'),
(2666, 0, '661', 149, 'piece', 575.00, 10, 0, 10, 0, '2024-03-26 14:17:57'),
(2667, 0, '661', 150, 'piece', 575.00, 10, 0, 10, 0, '2024-03-26 14:17:57'),
(2668, 2438, '661', 142, 'piece', 320.00, 6, 6, 0, 6, '2024-03-26 14:18:40'),
(2669, 2438, '661', 143, 'set', 26.00, 20, 20, 0, 20, '2024-03-26 14:18:40'),
(2670, 2438, '661', 144, 'piece', 375.00, 3, 3, 0, 3, '2024-03-26 14:18:40'),
(2671, 2438, '661', 145, 'piece', 270.00, 3, 3, 0, 3, '2024-03-26 14:18:40'),
(2672, 2438, '661', 146, 'piece', 575.00, 5, 5, 0, 5, '2024-03-26 14:18:40'),
(2673, 2438, '661', 147, 'piece', 575.00, 5, 5, 0, 5, '2024-03-26 14:18:40'),
(2674, 2438, '661', 148, 'piece', 1660.00, 1, 1, 0, 1, '2024-03-26 14:18:40'),
(2675, 2438, '661', 149, 'piece', 575.00, 10, 10, 0, 10, '2024-03-26 14:18:40'),
(2676, 2438, '661', 150, 'piece', 575.00, 10, 10, 0, 10, '2024-03-26 14:18:40'),
(2677, 0, '662', 166, 'pair', 110.00, 19, 0, 19, 0, '2024-03-26 14:33:53'),
(2678, 2439, '662', 166, 'pair', 110.00, 19, 19, 0, 19, '2024-03-26 14:36:00'),
(2679, 0, '664', 167, 'ML', 250.00, 20, 0, 20, 0, '2024-04-01 11:51:05'),
(2680, 0, '663', 165, 'piece', 650.00, 3, 0, 3, 0, '2024-04-01 13:22:58'),
(2681, 0, '665', 154, 'piece', 120.00, 10, 0, 10, 0, '2024-04-01 13:47:33'),
(2682, 0, '665', 162, 'piece', 150.00, 5, 0, 5, 0, '2024-04-01 13:47:33'),
(2683, 0, '665', 144, 'piece', 375.00, 3, 0, 3, 0, '2024-04-01 13:47:33'),
(2684, 0, '666', 151, 'ream', 110.00, 25, 0, 25, 0, '2024-04-01 14:52:50'),
(2685, 0, '666', 145, 'piece', 270.00, 5, 0, 5, 0, '2024-04-01 14:52:50'),
(2686, 2448, '666', 151, 'ream', 110.00, 25, 25, 0, 25, '2024-04-01 16:55:02'),
(2687, 2448, '666', 145, 'piece', 270.00, 5, 5, 0, 5, '2024-04-01 16:55:02'),
(2688, 2483, '665', 154, 'piece', 120.00, 10, 10, 0, 10, '2024-04-11 11:24:26'),
(2689, 2483, '665', 162, 'piece', 150.00, 5, 5, 0, 5, '2024-04-11 11:24:26'),
(2690, 2483, '665', 144, 'piece', 375.00, 3, 3, 0, 3, '2024-04-11 11:24:26'),
(2691, 0, '667', 164, 'gal', 250.00, 20, 0, 20, 0, '2024-04-11 11:42:53'),
(2692, 2485, '667', 164, 'gal', 250.00, 20, 20, 0, 20, '2024-04-11 11:44:09'),
(2693, 0, '668', 151, 'ream', 2000.00, 212, 0, 212, 0, '2024-04-11 14:39:45'),
(2694, 0, '668', 162, 'piece', 250.00, 122, 0, 122, 0, '2024-04-11 14:39:45'),
(2695, 0, '668', 159, 'box', 1230.00, 112, 0, 112, 0, '2024-04-11 14:39:45'),
(2696, 2493, '668', 151, 'ream', 2000.00, 212, 212, 0, 212, '2024-04-11 14:42:08'),
(2697, 2493, '668', 162, 'piece', 250.00, 122, 122, 0, 122, '2024-04-11 14:42:08'),
(2698, 2493, '668', 159, 'box', 1230.00, 112, 112, 0, 112, '2024-04-11 14:42:08'),
(2699, 0, '669', 161, 'piece', 1220.00, 5, 0, 5, 0, '2024-04-12 14:06:40'),
(2700, 0, '669', 144, 'piece', 375.00, 5, 0, 5, 0, '2024-04-12 14:06:40'),
(2701, 2526, '669', 161, 'piece', 1220.00, 5, 5, 0, 5, '2024-04-12 14:10:12'),
(2702, 2526, '669', 144, 'piece', 375.00, 5, 5, 0, 5, '2024-04-12 14:10:12'),
(2703, 0, '670', 145, 'piece', 270.00, 121, 0, 121, 0, '2024-04-12 14:20:41'),
(2704, 0, '670', 143, 'set', 126.00, 124, 0, 124, 0, '2024-04-12 14:20:41'),
(2705, 2527, '670', 145, 'piece', 270.00, 121, 121, 0, 121, '2024-04-12 14:31:31'),
(2706, 2527, '670', 143, 'set', 126.00, 124, 124, 0, 124, '2024-04-12 14:31:31'),
(2707, 0, '671', 148, 'piece', 1660.00, 122, 0, 122, 0, '2024-04-12 14:40:09'),
(2708, 0, '671', 155, 'piece', 130.00, 150, 0, 150, 0, '2024-04-12 14:40:09'),
(2709, 2528, '671', 148, 'piece', 1660.00, 122, 10, 112, 10, '2024-04-12 14:44:49'),
(2710, 2528, '671', 155, 'piece', 130.00, 150, 10, 140, 10, '2024-04-12 14:44:49'),
(2711, 2529, '671', 148, 'piece', 1660.00, 122, 15, 107, 5, '2024-04-12 14:45:53'),
(2712, 2529, '671', 155, 'piece', 130.00, 150, 15, 135, 5, '2024-04-12 14:45:53'),
(2713, 2530, '671', 148, 'piece', 1660.00, 122, 22, 100, 7, '2024-04-12 14:47:24'),
(2714, 2530, '671', 155, 'piece', 130.00, 150, 50, 100, 35, '2024-04-12 14:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_order_items`
--

CREATE TABLE `cancelled_order_items` (
  `id` int(11) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `po_id` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` float NOT NULL,
  `received` float NOT NULL DEFAULT 0,
  `outstanding` float NOT NULL DEFAULT 0,
  `del_items` int(11) NOT NULL,
  `date_cancelled` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_details`
--

CREATE TABLE `check_details` (
  `check_id` int(11) NOT NULL,
  `c_num` int(11) NOT NULL,
  `check_num` text NOT NULL,
  `check_name` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `check_date` date NOT NULL,
  `c_status` tinytext NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `check_details`
--

INSERT INTO `check_details` (`check_id`, `c_num`, `check_num`, `check_name`, `amount`, `check_date`, `c_status`, `date_created`, `date_updated`) VALUES
(50, 1, '3546745', 'Alonzo, Imelda D', 50000.00, '2024-04-19', '0', '2024-04-12 11:54:54', '2024-04-12 11:54:54'),
(51, 2, '67876', 'ESTRELLA, NADINE', 456666.00, '2024-04-19', '0', '2024-04-12 13:19:43', '2024-04-12 13:19:43'),
(52, 3, '1232132', 'AMLN CONSTRUCTION', 11110.00, '2024-04-19', '0', '2024-04-12 13:25:03', '2024-04-12 13:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `cv_entries`
--

CREATE TABLE `cv_entries` (
  `c_num` int(11) NOT NULL,
  `v_num` int(11) NOT NULL,
  `po_no` text NOT NULL,
  `paid_to` int(11) NOT NULL,
  `supplier_id` varchar(30) NOT NULL,
  `check_name` text NOT NULL,
  `cv_date` date NOT NULL,
  `check_date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `ref_no` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `c_status` int(11) NOT NULL,
  `c_status2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv_entries`
--

INSERT INTO `cv_entries` (`c_num`, `v_num`, `po_no`, `paid_to`, `supplier_id`, `check_name`, `cv_date`, `check_date`, `description`, `ref_no`, `date_created`, `date_updated`, `c_status`, `c_status2`) VALUES
(1, 5, '671', 0, '39', 'DONITA ROSE TANTOCO', '2024-04-12', '0000-00-00 00:00:00', 'TEST', '5353666', '2024-04-12 14:57:57', '2024-04-12 14:57:57', 0, 0),
(2, 1, '', 0, '112140', 'Alsaihati, Alice A', '2024-04-12', '2024-04-19 00:00:00', 'TEST AGENT', '3213123', '2024-04-12 15:02:23', '2024-04-12 15:02:23', 0, 0),
(3, 2, '', 0, '20069', 'DE GUZMAN, RICHIE', '2024-04-12', '2024-04-19 00:00:00', 'TEST EMP', '', '2024-04-12 15:08:37', '2024-04-12 15:08:37', 0, 0),
(4, 3, '', 0, '2493031335953', 'Flores, Spouses Prince William MOSQUEDA', '2024-04-12', '2024-04-19 00:00:00', 'TEST', '', '2024-04-12 15:09:21', '2024-04-12 15:09:21', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cv_items`
--

CREATE TABLE `cv_items` (
  `id` int(11) NOT NULL,
  `journal_id` int(30) NOT NULL,
  `account_id` int(30) NOT NULL,
  `group_id` int(30) NOT NULL,
  `phase` varchar(30) NOT NULL,
  `block` varchar(30) NOT NULL,
  `lot` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv_items`
--

INSERT INTO `cv_items` (`id`, `journal_id`, `account_id`, `group_id`, `phase`, `block`, `lot`, `amount`, `date_created`) VALUES
(2105, 1, 21002, 0, '', '', '', 16025.62, '2024-04-12 14:57:57'),
(2106, 1, 11017, 0, '', '', '', -16025.62, '2024-04-12 14:57:57'),
(2107, 2, 21002, 0, '', '', '', 25000.00, '2024-04-12 15:02:23'),
(2108, 2, 11005, 0, '', '', '', -25000.00, '2024-04-12 15:02:23'),
(2109, 3, 21002, 0, '', '', '', 56000.00, '2024-04-12 15:08:37'),
(2110, 3, 11019, 0, '', '', '', -56000.00, '2024-04-12 15:08:37'),
(2111, 4, 21002, 0, '', '', '', 23340.00, '2024-04-12 15:09:21'),
(2112, 4, 11004, 0, '', '', '', -23340.00, '2024-04-12 15:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `dept_id` int(11) NOT NULL,
  `department` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`dept_id`, `department`) VALUES
(1, 'Technical Planning'),
(2, 'Contracts and Doc.'),
(3, 'IT'),
(4, 'General Services'),
(5, 'Engineering'),
(6, 'Documentation and Loan'),
(7, 'Electrical'),
(8, 'Treasury'),
(9, 'Const. and Impln.'),
(10, 'Permits and Licenses'),
(11, 'Executive'),
(12, 'Repair and Maintenance'),
(14, 'Marketing'),
(16, 'Design and Devt.'),
(17, 'Project Admin'),
(18, 'Billing'),
(19, 'Accounting'),
(20, 'Personnel'),
(21, 'Purchasing'),
(22, 'Security Admin'),
(25, 'Legal'),
(29, 'Corporate Communications'),
(30, 'Inventory Control'),
(31, 'CALS'),
(32, 'Audit');

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
  `relationship` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Pending\r\n1 = Active\r\n2 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_list`
--

CREATE TABLE `group_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Debit, 2= Credit',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1= Active',
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes ',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_list`
--

INSERT INTO `group_list` (`id`, `name`, `description`, `type`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Assets', 'The cash, inventory, and other resources you owned.', 1, 1, 0, '2022-02-01 09:56:35', '2022-02-01 09:56:58'),
(2, 'Revenue', 'Cash coming into your business through sales and other types of payments', 2, 1, 0, '2022-02-01 09:57:45', '2024-02-12 15:57:58'),
(3, 'Expenses', 'The amount you’re spending on services and other items, like payroll, utility bills, and fees for contractors.', 1, 1, 0, '2022-02-01 09:58:09', '2022-02-01 09:59:13'),
(4, 'Liabilities', 'The money you still owe on loans, debts, and other obligations.', 2, 1, 0, '2022-02-01 09:58:34', NULL),
(5, 'Equity', 'How much is remaining after you subtract liabilities from assets.', 2, 1, 0, '2022-02-01 09:59:05', NULL),
(6, 'Dividend', 'Form of income that shareholders of corporations receive for each share of stock that they hold.', 1, 1, 0, '2022-02-01 10:00:13', NULL),
(19, 'Income', '', 2, 1, 0, '2023-11-21 16:09:00', NULL),
(20, 'Asset', '', 1, 1, 1, '2023-12-11 20:51:23', '2023-12-11 20:51:29'),
(21, 'TEST', '', 1, 1, 1, '2024-03-04 13:18:09', '2024-03-04 13:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL,
  `supplier_id` varchar(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `item_code` text NOT NULL,
  `account_code` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-Goods/2-Service',
  `description` text NOT NULL,
  `default_unit` text NOT NULL,
  `unit_price` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT ' 1 = Active, 0 = Inactive',
  `last_date_canvassed` date DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `supplier_id`, `name`, `item_code`, `account_code`, `type`, `description`, `default_unit`, `unit_price`, `status`, `last_date_canvassed`, `date_created`) VALUES
(142, '39', 'EPSON T003', '39-1', 51018, 1, 'C/Y/M', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:44:39'),
(143, '39', 'VELLUM BOARD', '39-2', 51020, 1, 'Short White', 'set', 0, 1, '2024-03-26', '2024-03-26 11:45:10'),
(144, '39', 'STAPLER', '39-3', 51020, 1, '#35 MAX', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:45:32'),
(145, '39', 'DATEX', '39-4', 51020, 1, 'SELF INKING', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:45:53'),
(146, '39', 'HP 704', '39-5', 51018, 1, 'BLACK', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:46:12'),
(147, '39', 'HP 704', '39-6', 51018, 1, 'COLORED', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:46:29'),
(148, '39', 'LAMINATION ROLL', '39-7', 51020, 1, '9x250m', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:46:50'),
(149, '39', 'HP 678', '39-8', 51018, 1, 'BLACK', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:47:04'),
(150, '39', 'HP 678', '39-9', 51018, 1, 'COLORED', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:47:28'),
(151, '39', 'BOND PAPER', '39-10', 51020, 1, 'LONG', 'ream', 0, 1, '2024-03-26', '2024-03-26 11:49:57'),
(152, '39', 'BOND PAPER', '39-11', 51020, 1, 'SHORT', 'ream', 0, 1, '2024-03-26', '2024-03-26 11:50:13'),
(153, '39', 'NEWS PRINT', '39-12', 51020, 1, 'LONG', 'ream', 0, 1, '2024-03-26', '2024-03-26 11:50:31'),
(154, '39', 'BALLPEN', '39-13', 11092, 1, 'BLACK PANDA', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:50:50'),
(155, '39', 'SCOTCH TAPE', '39-14', 51020, 1, 'SMALL', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:51:07'),
(156, '39', 'STICKY NOTE', '39-15', 51020, 1, '2x3', 'pad', 0, 1, '2024-03-26', '2024-03-26 11:51:25'),
(157, '39', 'FILEX', '39-16', 51020, 1, 'BLACK', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:51:38'),
(158, '39', 'RECORD BOOK', '39-17', 51020, 1, '300 pages', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:51:51'),
(159, '39', 'PAPER CUP', '39-18', 51020, 1, 'SMALL', 'box', 0, 1, '2024-03-26', '2024-03-26 11:52:09'),
(160, '39', 'PAPER CUP', '39-19', 51020, 1, 'BIG', 'box', 0, 1, '2024-03-26', '2024-03-26 11:52:28'),
(161, '39', 'EXPANDED FOLDER', '39-20', 51020, 1, 'GREEN LONG', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:52:41'),
(162, '39', 'CORRECTION TAPE', '39-21', 51020, 1, 'SMALL', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:52:56'),
(163, '39', 'EPSON 003', '39-22', 51018, 1, 'INK BLACK', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:53:10'),
(164, '31', 'NO GRASS', '31-1', 11075, 1, '48SL', 'gal', 0, 1, '2024-03-26', '2024-03-26 11:56:55'),
(165, '42', 'POWER SUPPLY', '42-1', 51018, 1, '700W', 'piece', 0, 1, '2024-03-26', '2024-03-26 11:59:10'),
(166, '13', 'CONCEALED HINGES', '13-1', 11075, 1, '#1', 'pair', 0, 1, '2024-03-26', '2024-03-26 12:00:59'),
(167, '59', '2T OIL', '59-1', 0, 1, 'Petron', 'ML', 0, 1, '2024-04-01', '2024-04-01 11:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `jv_entries`
--

CREATE TABLE `jv_entries` (
  `jv_num` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `user_id` text NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `ref_no` text NOT NULL,
  `c_status` int(11) NOT NULL DEFAULT 0,
  `posting_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jv_items`
--

CREATE TABLE `jv_items` (
  `id` int(11) NOT NULL,
  `journal_id` int(30) NOT NULL,
  `doc_no` text NOT NULL,
  `account_id` int(11) NOT NULL,
  `phase` varchar(30) NOT NULL,
  `block` varchar(30) NOT NULL,
  `lot` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_tbl`
--

CREATE TABLE `message_tbl` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_to_be_notified` text NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `date_time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_tbl`
--

INSERT INTO `message_tbl` (`id`, `message`, `user_to_be_notified`, `seen`, `date_time_created`) VALUES
(299, '10012 updated the evaluation for CSR #280.', 'IT Admin', 1, '2024-03-26 00:37:33'),
(300, '10055 booked CSR #280.', 'IT Admin', 1, '2024-03-26 00:42:44'),
(301, '20074 created a reservation for CSR # 284.', 'IT Admin', 1, '2024-03-26 01:45:03'),
(302, '20074 created a reservation for CSR # 284.', 'CA', 0, '2024-03-26 01:45:03'),
(303, '10055 booked CSR #284.', 'IT Admin', 1, '2024-03-26 01:49:26'),
(304, '10147 added an AV to client with property ID #1216203804301.', 'IT Admin', 1, '2024-03-26 01:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` float NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - Approved (Default) / 1 - Disapproved',
  `item_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `po_id`, `item_id`, `default_unit`, `unit_price`, `quantity`, `item_status`, `item_notes`) VALUES
(3851, 661, 142, 'piece', 320.00, 6, 0, ''),
(3852, 661, 143, 'set', 26.00, 20, 0, ''),
(3853, 661, 144, 'piece', 375.00, 3, 0, ''),
(3854, 661, 145, 'piece', 270.00, 3, 0, ''),
(3855, 661, 146, 'piece', 575.00, 5, 0, ''),
(3856, 661, 147, 'piece', 575.00, 5, 0, ''),
(3857, 661, 148, 'piece', 1660.00, 1, 0, ''),
(3858, 661, 149, 'piece', 575.00, 10, 0, ''),
(3859, 661, 150, 'piece', 575.00, 10, 0, ''),
(3862, 662, 166, 'pair', 110.00, 19, 0, ''),
(3866, 664, 167, 'ML', 250.00, 20, 0, ''),
(3868, 663, 165, 'piece', 650.00, 3, 0, ''),
(3875, 665, 154, 'piece', 120.00, 10, 0, ''),
(3876, 665, 162, 'piece', 150.00, 5, 0, ''),
(3877, 665, 144, 'piece', 375.00, 3, 0, ''),
(3882, 666, 151, 'ream', 110.00, 25, 0, ''),
(3883, 666, 145, 'piece', 270.00, 5, 0, ''),
(3886, 667, 164, 'gal', 250.00, 20, 0, ''),
(3893, 668, 151, 'ream', 2000.00, 212, 0, ''),
(3894, 668, 162, 'piece', 250.00, 122, 0, ''),
(3895, 668, 159, 'box', 1230.00, 112, 0, ''),
(3900, 669, 161, 'piece', 1220.00, 5, 0, ''),
(3901, 669, 144, 'piece', 375.00, 5, 0, ''),
(3906, 670, 145, 'piece', 270.00, 121, 0, ''),
(3907, 670, 143, 'set', 126.00, 124, 0, ''),
(3912, 671, 148, 'piece', 1660.00, 122, 0, ''),
(3913, 671, 155, 'piece', 130.00, 150, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `or_logs`
--

CREATE TABLE `or_logs` (
  `or_id` bigint(11) NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `pay_date` date NOT NULL DEFAULT current_timestamp(),
  `or_no` varchar(30) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `surcharge` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `principal` decimal(10,2) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `remaining_balance` decimal(10,2) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `gen_time` datetime NOT NULL DEFAULT current_timestamp(),
  `check_date` date NOT NULL DEFAULT current_timestamp(),
  `branch` text NOT NULL,
  `particulars` text NOT NULL,
  `check_number` text NOT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `or_logs`
--

INSERT INTO `or_logs` (`or_id`, `property_id`, `pay_date`, `or_no`, `amount_paid`, `amount_due`, `surcharge`, `interest`, `principal`, `rebate`, `remaining_balance`, `mode_of_payment`, `user`, `gen_time`, `check_date`, `branch`, `particulars`, `check_number`, `status`) VALUES
(120, 1216203804301, '2024-03-26', '543211', 18268.50, 17093.33, 1175.17, 0.00, 17093.33, 0.00, 2626906.67, '-1', '10147', '2024-03-26 09:51:49', '0000-00-00', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_terms`
--

CREATE TABLE `payment_terms` (
  `terms_indicator` int(11) NOT NULL,
  `terms` text NOT NULL,
  `days_before_due` smallint(6) NOT NULL,
  `days_in_following_month` smallint(6) NOT NULL,
  `inactive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_terms`
--

INSERT INTO `payment_terms` (`terms_indicator`, `terms`, `days_before_due`, `days_in_following_month`, `inactive`) VALUES
(1, 'Due 15th Of the Following Month', 0, 15, 0),
(2, 'Due By End Of The Following Month\r\n', 0, 30, 0),
(3, 'Payment due within 10 days', 10, 0, 0),
(4, 'Cash Only', 0, 0, 0),
(5, 'Prepaid', -1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pending_restructuring`
--

CREATE TABLE `pending_restructuring` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `po_approved_list`
--

CREATE TABLE `po_approved_list` (
  `id` int(30) NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `discount_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vatable` int(11) NOT NULL COMMENT '4 - NonVat / 3 - Zero-Rated / 2 - Inclusive / 1 - Exclusive',
  `vatType` int(25) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `department` text NOT NULL,
  `notes` text NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `terms` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL DEFAULT 0,
  `receiver2_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 - Open/0 - Closed',
  `status2` int(11) NOT NULL DEFAULT 1,
  `status3` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `fpo_status` int(11) NOT NULL DEFAULT 1,
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_approved_list`
--

INSERT INTO `po_approved_list` (`id`, `po_no`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `vatable`, `vatType`, `tax_amount`, `department`, `notes`, `delivery_date`, `terms`, `receiver_id`, `receiver2_id`, `status`, `status2`, `status3`, `date_created`, `fpo_status`, `date_updated`) VALUES
(661, '661', 39, 0.00, 0.00, 0.00, 1, 0, 2494.82, 'IT', 'OFFICE SUPPLIES', '2024-04-02', 0, 20087, 20029, 0, 1, 1, '2024-03-26 14:17:57', 1, '2024-03-26 14:18:40'),
(662, '662', 13, 0.00, 0.00, 0.00, 1, 0, 223.93, 'Repair and Maintenance', 'FOR CABINET REPAIR @ BACK OFFICE', '2024-04-02', 0, 20198, 10030, 0, 1, 1, '2024-03-26 14:33:53', 1, '2024-04-02 08:34:32'),
(663, '663', 42, 0.00, 0.00, 0.00, 1, 0, 208.93, 'IT', 'REPLACEMENT MS.NINA, RUBY, ZALYN', '2024-04-08', 0, 20064, 10178, 1, 1, 1, '2024-04-01 13:22:58', 1, NULL),
(664, '664', 59, 0.00, 0.00, 0.00, 3, 0, 0.00, 'General Services', 'FOR MAINTENANCE USE @ ALL PROJECT SITES', '2024-04-08', 0, 10143, 10181, 1, 1, 1, '2024-04-01 11:51:05', 1, NULL),
(665, '665', 39, 0.00, 0.00, 0.00, 1, 0, 329.46, 'Accounting', 'TEST', '2024-04-08', 0, 20175, 10030, 0, 1, 1, '2024-04-01 13:47:33', 1, '2024-04-11 11:24:26'),
(666, '666', 39, 0.00, 0.00, 0.00, 1, 0, 439.29, 'Documentation and Loan', 'TEST', '2024-04-08', 0, 10100, 10184, 0, 1, 1, '2024-04-01 14:52:50', 1, '2024-04-02 08:35:36'),
(667, '667', 31, 0.00, 0.00, 0.00, 3, 0, 0.00, 'IT', 'TEST', '2024-04-18', 0, 20029, 20087, 0, 1, 1, '2024-04-11 11:42:53', 1, '2024-04-11 11:44:09'),
(668, '668', 39, 0.00, 0.00, 0.00, 1, 0, 63456.43, 'CALS', 'TEST', '2024-04-18', 0, 20151, 20123, 0, 1, 1, '2024-04-11 14:39:45', 1, '2024-04-11 14:42:08'),
(669, '669', 39, 0.00, 0.00, 0.00, 1, 0, 854.46, 'IT', 'TEST', '2024-04-19', 0, 20087, 20029, 0, 1, 1, '2024-04-12 14:06:40', 1, '2024-04-12 14:10:12'),
(670, '670', 39, 0.00, 0.00, 0.00, 1, 0, 5174.36, 'Treasury', 'TESTTT', '2024-04-19', 0, 20123, 20205, 0, 1, 1, '2024-04-12 14:20:41', 1, '2024-04-12 14:31:31'),
(671, '671', 39, 0.00, 0.00, 0.00, 1, 0, 23787.86, 'Const. and Impln.', 'TEST', '2024-04-19', 0, 20029, 10160, 1, 1, 1, '2024-04-12 14:40:09', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `po_list`
--

CREATE TABLE `po_list` (
  `id` int(30) NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `discount_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vatable` int(11) DEFAULT NULL,
  `vatType` int(25) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `department` text NOT NULL,
  `notes` text NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `terms` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver2_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `status2` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - Approved / 2 - Disapproved / 3 - For Review',
  `status3` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - Approved / 2 - Disapproved / 3 - For Review',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `fpo_status` int(11) NOT NULL DEFAULT 1,
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_list`
--

INSERT INTO `po_list` (`id`, `po_no`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `vatable`, `vatType`, `tax_amount`, `department`, `notes`, `delivery_date`, `terms`, `receiver_id`, `receiver2_id`, `status`, `status2`, `status3`, `date_created`, `fpo_status`, `date_updated`) VALUES
(661, '661', 39, 0.00, 0.00, 0.00, 1, 0, 2494.82, 'IT', 'OFFICE SUPPLIES', '2024-04-02', 0, 20087, 20029, 1, 1, 1, '2024-03-26 14:16:36', 1, '2024-03-26 14:17:57'),
(662, '662', 13, 0.00, 0.00, 0.00, 1, 0, 223.93, 'Repair and Maintenance', 'FOR CABINET REPAIR @ BACK OFFICE', '2024-04-02', 0, 20198, 10030, 1, 1, 1, '2024-03-26 14:31:56', 1, '2024-04-02 08:34:16'),
(663, '663', 42, 0.00, 0.00, 0.00, 1, 0, 208.93, 'IT', 'REPLACEMENT MS.NINA, RUBY, ZALYN', '2024-04-08', 0, 20064, 10178, 1, 1, 1, '2024-04-01 11:18:03', 1, '2024-04-01 13:22:58'),
(664, '664', 59, 0.00, 0.00, 0.00, 3, 0, 0.00, 'General Services', 'FOR MAINTENANCE USE @ ALL PROJECT SITES', '2024-04-08', 0, 10143, 10181, 1, 1, 1, '2024-04-01 11:28:10', 1, '2024-04-01 11:51:05'),
(665, '665', 39, 0.00, 0.00, 0.00, 1, 0, 329.46, 'Accounting', 'TEST', '2024-04-08', 0, 20175, 10030, 1, 1, 1, '2024-04-01 13:45:14', 1, '2024-04-02 08:35:24'),
(666, '666', 39, 0.00, 0.00, 0.00, 1, 0, 439.29, 'Documentation and Loan', 'TEST', '2024-04-08', 0, 10100, 10184, 1, 1, 1, '2024-04-01 14:45:12', 1, '2024-04-01 16:34:52'),
(667, '667', 31, 0.00, 0.00, 0.00, 3, 0, 0.00, 'IT', 'TEST', '2024-04-18', 0, 20029, 20087, 1, 1, 1, '2024-04-11 11:41:40', 1, '2024-04-11 11:42:53'),
(668, '668', 39, 0.00, 0.00, 0.00, 1, 0, 63456.43, 'CALS', 'TEST', '2024-04-18', 0, 20151, 20123, 1, 1, 1, '2024-04-11 14:38:42', 1, '2024-04-11 14:39:45'),
(669, '669', 39, 0.00, 0.00, 0.00, 1, 0, 854.46, 'IT', 'TEST', '2024-04-19', 0, 20087, 20029, 1, 1, 1, '2024-04-12 14:04:52', 1, '2024-04-12 14:06:40'),
(670, '670', 39, 0.00, 0.00, 0.00, 1, 0, 5174.36, 'Treasury', 'TESTTT', '2024-04-19', 0, 20123, 20205, 1, 1, 1, '2024-04-12 14:19:30', 1, '2024-04-12 14:20:41'),
(671, '671', 39, 0.00, 0.00, 0.00, 1, 0, 23787.86, 'Const. and Impln.', 'TEST', '2024-04-19', 0, 20029, 10160, 1, 1, 1, '2024-04-12 14:39:23', 1, '2024-04-12 14:40:09');

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
  `c_balance` double NOT NULL,
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
  `c_reopen` int(11) NOT NULL DEFAULT 0,
  `c_change_date` tinyint(2) NOT NULL,
  `c_restructured` tinyint(2) NOT NULL,
  `c_remarks` text NOT NULL,
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Backout,\r\n1 = Active,\r\n2 = Transferred',
  `c_backout_date` date DEFAULT NULL,
  `old_property_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `c_csr_no`, `project_id`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_balance`, `c_account_status`, `c_account_type`, `c_account_type1`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_retention`, `c_reopen`, `c_change_date`, `c_restructured`, `c_remarks`, `c_active`, `c_backout_date`, `old_property_id`) VALUES
(1216203804301, 284, 12, 16203804, '3', '2024-03-26', 2626906.67, 'Partial DownPayment', 'LOC', 'REG', 72, 7000, 0, 0, 'ANNIKA', 40, 54000, 0, 0, 0, 0, 2664000, 0, 2664000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 512800, 30, 17093.33, '2024-01-31', '2026-07-01', 2131200, 120, 16, 0.01675131, 35700.4, '2026-07-31', 0, 0, 0, 0, '1. WITH RA#13620 WITH APPROVAL OF PBM DTD. 12/18/23', 1, NULL, NULL);

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
  `relationship` tinyint(4) DEFAULT NULL,
  `c_reopen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_clients`
--

INSERT INTO `property_clients` (`client_id`, `property_id`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`, `c_reopen`) VALUES
(2493031335953, 1216203804301, 1, 'Flores', 'Spouses Prince William', 'MOSQUEDA', '', '0156 DAANG BAKA 1, MAYSANTOL', '3017', '  ', '1993-03-13', 31, '09190934956  ', 'M', 'Single', 'Filipino', '', '', 'ivymaemae@gmail.com', '09190934956', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `property_payments`
--

CREATE TABLE `property_payments` (
  `payment_id` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `or_no` varchar(30) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `rebate` decimal(10,2) DEFAULT NULL,
  `surcharge` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `principal` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `status_count` smallint(6) NOT NULL,
  `payment_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_payments`
--

INSERT INTO `property_payments` (`payment_id`, `property_id`, `payment_amount`, `pay_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `status_count`, `payment_count`) VALUES
(31, 1216203804301, 20000.00, '2024-03-26', '2024-03-26', '543223', 0.00, 0.00, 0.00, 0.00, 20000.00, 2644000.00, 'RES', 0, 1),
(32, 1216203804301, 18268.50, '2024-03-26', '2024-01-31', '543211', 18268.50, 0.00, 1175.17, 0.00, 17093.33, 2626906.67, 'PD - 1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subsidiary_accounts`
--

CREATE TABLE `subsidiary_accounts` (
  `sub_id` int(11) NOT NULL,
  `sub_code` text NOT NULL,
  `sub_name` text NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0-inactive/1-active',
  `delete_flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subsidiary_accounts`
--

INSERT INTO `subsidiary_accounts` (`sub_id`, `sub_code`, `sub_name`, `status`, `delete_flag`) VALUES
(1, 'R020', 'Registry of Deeds', 1, 0),
(2, 'C030', 'Cleaning Materials', 1, 0),
(4, 'S99', 'Salary Loan', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `short_name` text NOT NULL,
  `tin` text NOT NULL,
  `atc_code` text NOT NULL,
  `address` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `vatable` int(11) NOT NULL,
  `mop` tinyint(11) NOT NULL,
  `terms` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `short_name`, `tin`, `atc_code`, `address`, `contact_person`, `contact`, `email`, `status`, `vatable`, `mop`, `terms`, `date_created`) VALUES
(1, '101 PILLARS CONSTRUCTION OPC', '101 PILLARS CONSTRUCTION OPC', '625-819-793-0000', 'WC160 ', '2560 MOONSTONE ST. ROCKA VILLAGE 2, TABANG, PLARIDEL,BULACAN', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(2, '3M PEST CONTROL', '3M PEST CONTROL', '355-743-263-000', 'WI160 ', 'B5 L8 PH6B GRAND ROYALE SUBD., PINAGBAKAHAN, CITY OF MALOLOS', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(3, 'ACE HARDWARE PHILIPPINES INC', 'ACE HARDWARE PHILIPPINES INC', '200-035-311-178', '', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(4, 'AMLN CONSTRUCTION', 'AMLN CONSTRUCTION', '191-993-309-00', 'WI160 ', '0445 LEONARDO ST., PARULAN, PLARIDEL, BULACAN', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(5, 'BAGUIO COUNTRY CLUB CORPORATION', 'BAGUIO COUNTRY CLUB CORPORATION', '001-479-996-0000', 'WC160 ', 'COUNTRY CLUB RD. CITY OF BAGUIO, BENGUET 2600', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(6, 'BUHAIN, CECILIA', 'BUHAIN, CECILIA', '107-684-734-000', 'WI091 ', 'TABANG, PLARIDEL, BULACAN 3004', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(7, 'CHEVRON PHILIPPINES', 'CHEVRON PHILIPPINES', '000-349-759-0000', 'WC158 ', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(8, 'CITY AIRE COMMERCIAL SALE', 'CITY AIRE COMMERCIAL SALE', '106-158-020-000', 'WI160 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(9, 'CONVERGE INFORMATION', 'CONVERGE INFORMATION', '006-895-049-044', '', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(10, 'CORPORATE GUARANTEE', 'CORPORATE GUARANTEE', '005-309-023-0002', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(11, 'CVM  CONSTRUCTION', 'CVM  CONSTRUCTION', '123-468-098-000', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(12, 'ELECKYON ELECTRICAL SUPPLIES', 'ELECKYON ELECTRICAL SUPPLIES', '161-183-177-001', 'WI158 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(13, 'FERONA HARDWARE', 'FERONA HARDWARE', '132-411-532-0000', 'WC158 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(14, 'FLORENTINO ROQUE TORRES CONST.', 'FLORENTINO ROQUE TORRES CONST.', '009-077-411-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(15, 'FQG CONSTRUCTION', 'FQG CONSTRUCTION', '193-052-765-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(16, 'GLOBE TELECOM, INC.', 'GLOBE TELECOM, INC.', '000-768-480-000', '', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(17, 'GONZALES, CAROLYN', 'GONZALES, CAROLYN', '107-684-809-000', 'WI091 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(18, 'GONZALES, FELYNE ANGELI ', 'GONZALES, FELYNE ANGELI ', '448-362-312-000 ', 'WI140 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(19, 'GRJ CONSTRUCTION', 'GRJ CONSTRUCTION', '169-403-579-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(20, 'HJR ENGINEERING CONTRACTOR', 'HJR ENGINEERING CONTRACTOR', '148-084-331-000', 'WI160 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(21, 'IDESIGN AND DIGITAL PRINT', 'IDESIGN AND DIGITAL PRINT', '158-054-502-001', 'WI158 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(22, 'INNOVE COMMUNICATIONS, INC.', 'INNOVE COMMUNICATIONS, INC.', '000-360-916-000', '', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(23, 'J.E. PABLO CONSTRUCTION', 'J.E. PABLO CONSTRUCTION', '257-504-314-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(24, 'JECAMS, INC.', 'JECAMS, INC.', '009-233-018-000', 'WC158 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(25, 'JMD INTERNATIONAL CORP.', 'JMD INTERNATIONAL CORP.', '004-837-170-000', 'WC158 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(26, 'JOHN CARLO CONSTRUCTION', 'JOHN CARLO CONSTRUCTION', '223-964-969-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(27, 'KAERUS ENTERPRISES', 'KAERUS ENTERPRISES', '225-633-668-0000', 'WI158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(28, 'KAPEEPRINT PHOTOCOPIER TRADING', 'KAPEEPRINT PHOTOCOPIER TRADING', '286-561-591-000', 'WI158 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(29, 'KOLLAB GURU GROUP INC.', 'KOLLAB GURU GROUP INC.', '008-813-082-000', 'WC160 ', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(30, 'LANDMARK DEPT STORE CITYSUPER INC.', 'LANDMARK DEPT STORE CITYSUPER INC.', '205-412-358-000', '', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(31, 'LEB LEGACY AGRI CORP.', 'LEB LEGACY AGRI CORP.', '010-356-849-000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(32, 'LEE INTERIOR BUSINESS VENTURES', 'LEE INTERIOR BUSINESS VENTURES', '008-834-680-000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(33, 'LG RIVERA BUILDERS', 'LG RIVERA BUILDERS', '426-833-209-000', 'WI160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(34, 'MAJOR SHOPPING MANAGEMENT CORPORATION', 'MAJOR SHOPPING MANAGEMENT CORPORATION', '000-057-799-000', '', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(35, 'MERALCO', 'MERALCO', '000-101-528-00026', '', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(36, 'METRO JOBS', 'METRO JOBS', '006-865-532-004', 'WC160 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(37, 'MIARA FIRE FIGHTING EQUIPMENT TRADING', 'MIARA FIRE FIGHTING EQUIPMENT TRADING', '704-156-971-000', 'WI158 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(38, 'NINA ASIANA SALON', 'NINA ASIANA SALON', '313-631-127-000', 'WI158 ', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(39, 'PAMCO STATIONERY', 'PAMCO STATIONERY', '000-332-670-0000', 'WC158 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(40, 'PETRON CORPORATION', 'PETRON CORPORATION', '000-168-801-000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(41, 'PLDT INC.', 'PLDT INC.', '000-488-793-00000', '', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(42, 'POWER TECH ENTERPRISE', 'POWER TECH ENTERPRISE', '264-983-096-0000', 'WI160 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(43, 'PRUDENTIAL GUARANTEE', 'PRUDENTIAL GUARANTEE', '000-491-813-0042', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(44, 'PUNDAR POWER TOOLS  TRADING', 'PUNDAR POWER TOOLS  TRADING', '273-364-433-000', 'WI158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(45, 'RBP COMPASS SECURITY', 'RBP COMPASS SECURITY', '178-445-600-000', 'WI160 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(46, 'RHEMARIE REFRIGERATION', 'RHEMARIE REFRIGERATION', '179-846-734-0000', 'WI160 ', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(47, 'ROBARCH CONSTRUCTION', 'ROBARCH CONSTRUCTION', '117-971-056-0001', 'WI160 ', '', '', '', '', 1, 0, 0, '4', '2024-03-08 16:51:10'),
(48, 'SANCTA PHILOMENA CONST. WC158', 'SANCTA PHILOMENA CONST. WC158', '007-105-244-0000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(49, 'SANCTA PHILOMENA CONST. WC160', 'SANCTA PHILOMENA CONST. WC160', '007-105-244-0000', 'WC160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(50, 'SLICKS TIRE SUPPLY', 'SLICKS TIRE SUPPLY', '903-183-787-000', 'WI158 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(51, 'SMART', 'SMART', '001-901-673', '', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(52, 'SOFISTIKADA GLASSWORKS', 'SOFISTIKADA GLASSWORKS', '273-079-237-001', 'WI160 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(53, 'ST. HELENA PRIME MOVERS CORP. WC158 ', 'ST. HELENA PRIME MOVERS CORP. WC158', '009-221-302-000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(54, 'ST. HELENA PRIME MOVERS CORP. WC160 ', 'ST. HELENA PRIME MOVERS CORP. WC160 ', '009-221-302-000', 'WC160 ', '', '', '', '', 1, 1, 2, '3', '2024-03-08 16:51:10'),
(55, 'VILLMAN COMPUTER SYSTEMS WEST INC.', 'VILLMAN COMPUTER SYSTEMS WEST INC.', '005-249-453-0023', '', '', '', '', '', 1, 0, 0, '5', '2024-03-08 16:51:10'),
(56, 'WILCON DEPOT INC.', 'WILCON DEPOT INC.', '009-192-878-002', '', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(57, 'TOYOTA PLARIDEL BULACAN', 'TOYOTA PLARIDEL BULACAN', '', 'WC158 ', '', '', '', '', 1, 0, 0, '2', '2024-03-08 16:51:10'),
(58, 'BOB CAR AIRCON', 'BOB CAR AIRCON', '215-434-798-0000', 'WI160 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(59, 'PICARAH AUTO SUPPLY', 'PICARAH AUTO SUPPLY', '140-434-387-0000', 'WI158 ', '', '', '', '', 1, 0, 0, '1', '2024-03-08 16:51:10'),
(60, 'POWER TREAD', 'POWER TREAD', '005-317-360-000', 'WC158 ', '', '', '', '', 1, 0, 0, '3', '2024-03-08 16:51:10'),
(96, 'MANILA WATER', 'MANILA WATER', '', '', '', '', '', '', 1, 0, 0, '4', '2024-03-15 13:42:50'),
(97, 'LPG', 'LPG', '', '', '', '', '', '', 1, 0, 0, '5', '2024-03-21 10:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'ALSC Web Application'),
(6, 'short_name', 'ALSC Web App'),
(11, 'logo', 'uploads/1674192240_logo2.jpg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1624240440_banner1.jpg'),
(15, 'tax_rate', '12'),
(16, 'company_email', 'contact@asianland.ph'),
(19, 'company_address', 'Grand Royale Subdivision, Bulihan, Malolos City, Bulacan, Philippines'),
(20, 'company_name', 'Asian Land Strategies Corporation');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `hotel_name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `hotel_name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Hotel Management System', 'info@sample.com', '+6948 8542 623', '1600478940_hotel-cover.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attachments`
--

CREATE TABLE `tbl_attachments` (
  `id` int(11) NOT NULL,
  `c_csr_no` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT current_timestamp(),
  `approval_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gl_items`
--

CREATE TABLE `tbl_gl_items` (
  `id` int(11) NOT NULL,
  `gl_id` int(11) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `po_id` varchar(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` float NOT NULL,
  `received` float NOT NULL DEFAULT 0,
  `outstanding` float NOT NULL DEFAULT 0,
  `del_items` int(11) NOT NULL,
  `amount` double NOT NULL,
  `journal_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gl_list`
--

CREATE TABLE `tbl_gl_list` (
  `gr_id` int(11) NOT NULL,
  `gl_id` int(11) NOT NULL,
  `po_id` varchar(100) NOT NULL,
  `gr_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gl_trans`
--

CREATE TABLE `tbl_gl_trans` (
  `id` int(11) NOT NULL,
  `doc_no` text NOT NULL,
  `gtype` int(11) NOT NULL,
  `vs_num` text NOT NULL,
  `cv_num` text NOT NULL,
  `jv_num` text NOT NULL,
  `doc_type` text NOT NULL,
  `po_id` text NOT NULL,
  `gr_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_code` text NOT NULL,
  `account` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `journal_date` datetime NOT NULL,
  `c_status` int(11) DEFAULT 1 COMMENT '3 - For Revision / 2- Disapproved / 1- Approved / 0 - Pending',
  `c_status2` int(11) NOT NULL,
  `preparer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gl_trans`
--

INSERT INTO `tbl_gl_trans` (`id`, `doc_no`, `gtype`, `vs_num`, `cv_num`, `jv_num`, `doc_type`, `po_id`, `gr_id`, `item_id`, `item_code`, `account`, `amount`, `journal_date`, `c_status`, `c_status2`, `preparer`) VALUES
(8177, '200001', 1, '1', '', '', 'AP', '', 0, 0, '', 21044, 25000.00, '2024-04-12 13:52:14', 1, 1, '20175'),
(8178, '200001', 2, '1', '', '', 'AP', '', 0, 0, '', 21002, -25000.00, '2024-04-12 13:52:14', 1, 1, '20175'),
(8179, '200002', 1, '2', '', '', 'AP', '', 0, 0, '', 11093, 56000.00, '2024-04-12 13:54:58', 1, 1, '20175'),
(8180, '200002', 2, '2', '', '', 'AP', '', 0, 0, '', 21002, -56000.00, '2024-04-12 13:54:58', 1, 1, '20175'),
(8181, '200003', 1, '3', '', '', 'AP', '', 0, 0, '', 11017, 23340.00, '2024-04-12 13:56:37', 1, 1, '20175'),
(8182, '200003', 2, '3', '', '', 'AP', '', 0, 0, '', 21002, -23340.00, '2024-04-12 13:56:37', 1, 1, '20175'),
(8183, '200004', 1, '4', '', '', 'AP', '', 0, 0, '', 11012, 12440.00, '2024-04-12 13:57:43', 1, 1, '20175'),
(8184, '200004', 2, '4', '', '', 'AP', '', 0, 0, '', 21002, -12440.00, '2024-04-12 13:57:43', 1, 1, '20175'),
(8185, '100001', 0, '0', '', '', 'GR', '669', 2526, 0, '0', 11081, 854.46, '2024-04-12 14:10:12', 1, 0, ''),
(8186, '100001', 0, '0', '', '', 'GR', '669', 2526, 0, '0', 21032, -71.20, '2024-04-12 14:10:12', 1, 0, ''),
(8187, '100001', 0, '0', '', '', 'GR', '669', 2526, 0, '0', 20147, -7903.80, '2024-04-12 14:10:12', 1, 0, ''),
(8188, '100001', 0, '0', '', '', 'GR', '669', 2526, 161, '39-20', 51020, 5446.43, '2024-04-12 14:10:12', 1, 0, ''),
(8189, '100001', 0, '0', '', '', 'GR', '669', 2526, 144, '39-3', 51020, 1674.11, '2024-04-12 14:10:12', 1, 0, ''),
(8190, '100002', 0, '0', '', '', 'GR', '670', 2527, 0, '0', 11081, 5174.36, '2024-04-12 14:31:31', 1, 0, ''),
(8191, '100002', 0, '0', '', '', 'GR', '670', 2527, 0, '0', 21032, -431.20, '2024-04-12 14:31:31', 1, 0, ''),
(8192, '100002', 0, '0', '', '', 'GR', '670', 2527, 0, '0', 20147, -47862.80, '2024-04-12 14:31:31', 1, 0, ''),
(8193, '100002', 0, '0', '', '', 'GR', '670', 2527, 145, '39-4', 51020, 29169.64, '2024-04-12 14:31:31', 1, 0, ''),
(8194, '100002', 0, '0', '', '', 'GR', '670', 2527, 143, '39-2', 51020, 13950.00, '2024-04-12 14:31:31', 1, 0, ''),
(8195, '100003', 0, '0', '', '', 'GR', '671', 2528, 0, '0', 11081, 1917.86, '2024-04-12 14:44:49', 1, 1, ''),
(8196, '100003', 0, '0', '', '', 'GR', '671', 2528, 0, '0', 21032, -159.82, '2024-04-12 14:44:49', 1, 1, ''),
(8197, '100003', 0, '0', '', '', 'GR', '671', 2528, 0, '0', 20147, -17740.18, '2024-04-12 14:44:49', 1, 1, ''),
(8198, '100003', 0, '0', '', '', 'GR', '671', 2528, 148, '39-7', 51020, 14821.43, '2024-04-12 14:44:49', 1, 1, ''),
(8199, '100003', 0, '0', '', '', 'GR', '671', 2528, 155, '39-14', 51020, 1160.71, '2024-04-12 14:44:49', 1, 1, ''),
(8200, '100004', 0, '0', '', '', 'GR', '671', 2529, 0, '0', 11081, 958.93, '2024-04-12 14:45:53', 1, 1, ''),
(8201, '100004', 0, '0', '', '', 'GR', '671', 2529, 0, '0', 21032, -79.91, '2024-04-12 14:45:53', 1, 1, ''),
(8202, '100004', 0, '0', '', '', 'GR', '671', 2529, 0, '0', 20147, -8870.09, '2024-04-12 14:45:53', 1, 1, ''),
(8203, '100004', 0, '0', '', '', 'GR', '671', 2529, 148, '39-7', 51020, 7410.71, '2024-04-12 14:45:53', 1, 1, ''),
(8204, '100004', 0, '0', '', '', 'GR', '671', 2529, 155, '39-14', 51020, 580.36, '2024-04-12 14:45:53', 1, 1, ''),
(8205, '100005', 0, '0', '', '', 'GR', '671', 2530, 0, '0', 11081, 1732.50, '2024-04-12 14:47:24', 1, 1, ''),
(8206, '100005', 0, '0', '', '', 'GR', '671', 2530, 0, '0', 21032, -144.38, '2024-04-12 14:47:24', 1, 1, ''),
(8207, '100005', 0, '0', '', '', 'GR', '671', 2530, 0, '0', 20147, -16025.62, '2024-04-12 14:47:24', 1, 1, ''),
(8208, '100005', 0, '0', '', '', 'GR', '671', 2530, 148, '39-7', 51020, 10375.00, '2024-04-12 14:47:24', 1, 1, ''),
(8209, '100005', 0, '0', '', '', 'GR', '671', 2530, 155, '39-14', 51020, 4062.50, '2024-04-12 14:47:24', 1, 1, ''),
(8210, '200005', 1, '5', '', '', 'AP', '671', 2530, 0, '', 20147, 16025.62, '2024-04-12 14:49:27', 1, 1, '20175'),
(8211, '200005', 1, '5', '', '', 'AP', '671', 2530, 0, '', 21032, 144.38, '2024-04-12 14:49:27', 1, 1, '20175'),
(8212, '200005', 1, '5', '', '', 'AP', '671', 2530, 0, '', 11076, 1732.50, '2024-04-12 14:49:27', 1, 1, '20175'),
(8213, '200005', 2, '5', '', '', 'AP', '671', 2530, 0, '', 21002, -16025.62, '2024-04-12 14:49:27', 1, 1, '20175'),
(8214, '200005', 2, '5', '', '', 'AP', '671', 2530, 0, '', 11081, -1732.50, '2024-04-12 14:49:27', 1, 1, '20175'),
(8215, '200005', 2, '5', '', '', 'AP', '671', 2530, 0, '', 21012, -144.38, '2024-04-12 14:49:27', 1, 1, '20175'),
(8216, '300001', 1, '5', '1', '', 'CV', '', 0, 0, '', 21002, 16025.62, '2024-04-12 14:57:57', 0, 0, '20205'),
(8217, '300001', 2, '5', '1', '', 'CV', '', 0, 0, '', 11017, -16025.62, '2024-04-12 14:57:57', 0, 0, '20205'),
(8218, '300002', 1, '1', '2', '', 'CV', '', 0, 0, '', 21002, 25000.00, '2024-04-12 15:02:23', 0, 0, '20205'),
(8219, '300002', 2, '1', '2', '', 'CV', '', 0, 0, '', 11005, -25000.00, '2024-04-12 15:02:23', 0, 0, '20205'),
(8220, '300003', 1, '2', '3', '', 'CV', '', 0, 0, '', 21002, 56000.00, '2024-04-12 15:08:37', 0, 0, '20205'),
(8221, '300003', 2, '2', '3', '', 'CV', '', 0, 0, '', 11019, -56000.00, '2024-04-12 15:08:37', 0, 0, '20205'),
(8222, '300004', 1, '3', '4', '', 'CV', '', 0, 0, '', 21002, 23340.00, '2024-04-12 15:09:21', 0, 0, '20205'),
(8223, '300004', 2, '3', '4', '', 'CV', '', 0, 0, '', 11004, -23340.00, '2024-04-12 15:09:21', 0, 0, '20205');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_batch`
--

CREATE TABLE `tbl_grn_batch` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `po_no` int(11) NOT NULL,
  `reference` varchar(60) NOT NULL,
  `delivery_date` date NOT NULL,
  `loc_code` varchar(5) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn_items`
--

CREATE TABLE `tbl_grn_items` (
  `id` int(11) NOT NULL,
  `grn_batch_id` int(11) NOT NULL,
  `po_detail_item` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `qty_recd` double NOT NULL,
  `quantity_inv` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gr_list`
--

CREATE TABLE `tbl_gr_list` (
  `gr_id` int(11) NOT NULL,
  `po_id` varchar(100) NOT NULL,
  `gr_status` int(11) NOT NULL,
  `vs_status` int(11) NOT NULL,
  `doc_no` text NOT NULL,
  `vs_num` int(11) NOT NULL,
  `cv_num` text NOT NULL,
  `jv_num` int(11) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `tran_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gr_list`
--

INSERT INTO `tbl_gr_list` (`gr_id`, `po_id`, `gr_status`, `vs_status`, `doc_no`, `vs_num`, `cv_num`, `jv_num`, `supplier_id`, `tran_date`) VALUES
(2522, '', 0, 0, '200001', 1, '', 0, 112140, '2024-04-12'),
(2523, '', 0, 0, '200002', 2, '', 0, 20069, '2024-04-12'),
(2524, '', 0, 0, '200003', 3, '', 0, 2493031335953, '2024-04-12'),
(2525, '', 0, 0, '200004', 4, '', 0, 35, '2024-04-12'),
(2526, '669', 0, 0, '100001', 0, '', 0, 39, '2024-04-12'),
(2527, '670', 0, 0, '100002', 0, '', 0, 39, '2024-04-12'),
(2528, '671', 0, 0, '100003', 0, '', 0, 39, '2024-04-12'),
(2529, '671', 0, 0, '100004', 0, '', 0, 39, '2024-04-12'),
(2530, '671', 1, 0, '100005', 0, '', 0, 39, '2024-04-12'),
(2531, '671', 1, 1, '200005', 5, '', 0, 39, '2024-04-12'),
(2532, '', 0, 0, '300001', 5, '1', 0, 39, '2024-04-12'),
(2533, '', 0, 0, '300002', 1, '2', 0, 112140, '2024-04-12'),
(2534, '', 0, 0, '300003', 2, '3', 0, 20069, '2024-04-12'),
(2535, '', 0, 0, '300004', 3, '4', 0, 2493031335953, '2024-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restructuring`
--

CREATE TABLE `tbl_restructuring` (
  `res_id` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rfp`
--

CREATE TABLE `tbl_rfp` (
  `id` int(11) NOT NULL,
  `rfp_no` text NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `name` text NOT NULL,
  `req_dept` text NOT NULL,
  `address` text NOT NULL,
  `payment_form` int(11) NOT NULL COMMENT '0 - Cash / 1 - Check',
  `release_date` date NOT NULL,
  `check_date` date NOT NULL,
  `check_name` text NOT NULL,
  `transaction_date` datetime NOT NULL,
  `pr_no` text NOT NULL,
  `bank_name` text NOT NULL,
  `po_no` text NOT NULL,
  `cdv_no` text NOT NULL,
  `ofv_no` text NOT NULL,
  `remarks` text NOT NULL,
  `preparer` text NOT NULL,
  `rfp_for` int(11) NOT NULL COMMENT '1-Agent/2-Emp/3-Clients/4-Supp/5-Others',
  `status1` text NOT NULL,
  `status2` text NOT NULL,
  `status3` text NOT NULL,
  `status4` text NOT NULL,
  `status5` text NOT NULL,
  `status6` text NOT NULL,
  `status7` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rfp_approvals`
--

CREATE TABLE `tbl_rfp_approvals` (
  `id` int(11) NOT NULL,
  `rfp_no` text NOT NULL,
  `status1` int(11) NOT NULL DEFAULT 0,
  `status2` int(11) NOT NULL DEFAULT 0,
  `status3` int(11) NOT NULL DEFAULT 0,
  `status4` int(11) NOT NULL DEFAULT 0,
  `status5` int(11) NOT NULL DEFAULT 0,
  `status6` int(11) NOT NULL,
  `status7` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vs_attachments`
--

CREATE TABLE `tbl_vs_attachments` (
  `id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `doc_no` int(11) NOT NULL,
  `doc_type` text NOT NULL,
  `num` text NOT NULL,
  `date_attached` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vs_attachments`
--

INSERT INTO `tbl_vs_attachments` (`id`, `image`, `doc_no`, `doc_type`, `num`, `date_attached`) VALUES
(867, '410822042_738122524868382_5653817881397888689_n.jpg', 200001, 'AP', '1', '2024-04-12 13:51:52'),
(868, '410732764_386316327210587_5107023290193660798_n.jpg', 200002, 'AP', '2', '2024-04-12 13:52:23'),
(869, '410732764_386316327210587_5107023290193660798_n.jpg', 200003, 'AP', '3', '2024-04-12 13:56:12'),
(870, '410732764_386316327210587_5107023290193660798_n.jpg', 200004, 'AP', '4', '2024-04-12 13:57:16'),
(874, 'wallpaper 2024.jpg', 200005, 'AP', '5', '2024-04-12 14:49:27');

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
  `conv_outlet_price` float NOT NULL,
  `service_area_price` float NOT NULL,
  `others_price` float NOT NULL,
  `floor_elev_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_additional_cost`
--

INSERT INTO `t_additional_cost` (`id`, `c_csr_no`, `floor_elevation`, `aircon_outlets`, `aircon_grill`, `service_area`, `others`, `conv_outlet`, `aircon_outlet_price`, `aircon_grill_price`, `conv_outlet_price`, `service_area_price`, `others_price`, `floor_elev_price`) VALUES
(132, 284, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_agents`
--

CREATE TABLE `t_agents` (
  `c_code` int(11) NOT NULL,
  `c_last_name` text DEFAULT NULL,
  `c_first_name` text DEFAULT NULL,
  `c_middle_initial` text DEFAULT NULL,
  `c_nick_name` text DEFAULT NULL,
  `c_sex` text DEFAULT NULL,
  `c_birthdate` date DEFAULT NULL,
  `c_birth_place` text DEFAULT NULL,
  `c_address_ln1` text DEFAULT NULL,
  `c_address_ln2` text DEFAULT NULL,
  `c_tel_no` text DEFAULT NULL,
  `c_civil_status` text DEFAULT NULL,
  `c_sss_no` text DEFAULT NULL,
  `c_tin` text DEFAULT NULL,
  `c_status` text DEFAULT NULL,
  `c_recruited_by` text DEFAULT NULL,
  `c_hire_date` date DEFAULT NULL,
  `c_position` text DEFAULT NULL,
  `c_network` text DEFAULT NULL,
  `c_division` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_agents`
--

INSERT INTO `t_agents` (`c_code`, `c_last_name`, `c_first_name`, `c_middle_initial`, `c_nick_name`, `c_sex`, `c_birthdate`, `c_birth_place`, `c_address_ln1`, `c_address_ln2`, `c_tel_no`, `c_civil_status`, `c_sss_no`, `c_tin`, `c_status`, `c_recruited_by`, `c_hire_date`, `c_position`, `c_network`, `c_division`) VALUES
(100269, 'Camingal', 'Raymond', '', 'Raymond', 'Male', '1976-10-29', 'Sagrada Paobong, Hagonoy, Bulacan', '#318 SAGRADA PAOMBONG, HAGONOY, BULACAN', 'M1029CR0', '', 'Single', '', '', 'Active', 'Reynaldo J. Camingal', '1996-11-16', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(100302, 'Ysais', 'Lynnet', 'C.', 'Lynneth', 'Female', '1974-04-22', 'Catmon, Malolos, Bulacan', '012 CATMON, MALOLOS, BULACAN', 'M0422YL0', '791-03-38', 'Single', '', '', 'Active', 'Lucita C. Ysais', '1995-06-10', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(100492, 'Hernandez', 'Marcelo', 'A.', 'Mar', 'Male', '1951-09-04', 'Caloocan, Metro Manila', '375 SAN PABLO, MALOLOS, BULACAN', 'M0904HM0', '791-36-73', 'Married', '323782432', '56159932', 'Active', 'Rosita S. Hernandez', '1995-11-15', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(100577, 'Magtira', 'Eugenio', '', 'Gene', 'Male', '1944-01-14', 'Mojon, Malolos, Bulacan', '118 LIBRA ST., SAN FELIPE SUBD., MOJON', 'M0114ME0', '', 'Married', '', '', 'Active', 'Leonora D. Punongbayan', '2006-10-16', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(100590, 'Magtira', 'Francisca', '', 'Francisca', 'Female', '1954-07-04', 'Mojon, Malolos, Bulacan', '118 LIBRA ST., SAN FELIPE SUBD., MOJON', 'M0704MF0', '', 'Married', '', '', 'Active', 'Eugenio Magtira', '2012-08-24', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(100824, 'Lizarondo', 'Regina', '', '', 'Female', '1899-12-31', '', '', 'M0101LR1', '', 'Single', '', '', 'Active', '', '2012-04-10', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(100901, 'Rebina', 'Bienvenida', '', '', 'Female', '1899-12-31', '', '', 'M0101RB0', '', 'Single', '', '', 'Active', '', '2009-10-13', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(100902, 'Santos', 'Remedios', '', '', 'Female', '1971-01-01', '', '', 'M0101SR4', '', 'Single', '', '', 'Active', '', '2005-06-14', 'SM', 'ACHIEVERS', 'Achievers - Direct'),
(100922, 'Quilantang', 'Annalyn', '', '', 'Female', '1971-01-01', '', '', 'M0101QA1', '', 'Single', '', '', 'Active', '', '2006-06-13', 'AVP', 'ACHIEVERS', 'Adrenaline'),
(101700, 'Carbo', 'William', 'R.', '', 'Male', '1971-01-01', '', '', 'M0101CW0', '', 'Single', '', '', 'Active', '', '2005-01-26', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(101787, 'Manalo', 'Rolando', 'Dj', '', 'Male', '1899-12-31', '', '', 'M0101MR3', '', 'Single', '', '', 'Active', '', '2007-02-07', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(102669, 'Mallari', 'Damasa', '', '', 'Female', '1899-12-31', '', '', 'M0101MD8', '', 'Single', '', '', 'Active', '', '2006-07-31', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(102685, 'Viterbo', 'Norelrin', '', '', 'Female', '1971-01-01', '', '', 'M0101VN3', '', 'Single', '', '', 'Active', '', '2004-06-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(102792, 'Bautista', 'Daisy', 'F.', '', 'Female', '1899-12-31', '', '', 'M0101BD4', '', 'Single', '', '', 'Active', '', '2011-03-01', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(102813, 'Lacanlale', 'Remedios', '', '', 'Female', '1899-12-31', '', '', 'M0101LR9', '', 'Single', '', '', 'Active', '', '2015-06-02', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(102980, 'Alipio', 'Shirley', 'F.', '', 'Female', '1900-02-01', '', '', 'M0202AS0', '', 'Single', '', '', 'Active', '', '2015-04-14', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(103098, 'Carbo', 'Mahnny', 'R.', '', 'Male', '1971-01-01', '', '', 'M0203CM2', '', 'Single', '', '', 'Active', '', '2004-05-31', 'SM', 'ACHIEVERS', 'Achievers - Direct'),
(103227, 'Nieves', 'Cecilia', '', '', 'Female', '1971-01-01', '', '', 'M0101NC0', '', 'Single', '', '', 'Active', '', '2004-06-22', 'MA', 'ACHIEVERS', 'Adrenaline'),
(103323, 'Amurao', 'Marissa', '', '', 'Female', '1900-02-02', '', '', 'M0203AM0', '', 'Single', '', '', 'Active', '', '2007-01-23', 'SMG', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(103806, 'Ocampo', 'Herminia', '', '', 'Female', '1971-01-01', '', '', 'M0101OH2', '', 'Single', '', '', 'Active', '', '2005-06-14', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(104216, 'Valencia', 'Marietta', '', '', 'Female', '1900-03-03', '', '', 'M0303VM0', '', 'Single', '', '', 'Active', '', '2011-02-02', 'MA', 'ACHIEVERS', 'Acts'),
(104235, 'Camingal', 'Rinagen', 'A.', '', 'Female', '1971-01-01', '', '', 'M0303AR2', '', 'Single', '', '', 'Active', '', '2018-06-01', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(104245, 'Nieves', 'Reynaldo', '', '', 'Male', '1971-01-01', '', '', 'M0303NR0', '', 'Single', '', '', 'Active', '', '2004-07-17', 'MA', 'ACHIEVERS', 'Adrenaline'),
(104685, 'Mariano', 'Richard', 'A.', '', 'Male', '1900-03-03', '', '', 'M0303MR4', '', 'Single', '', '', 'Active', '', '2009-02-10', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(104744, 'Brillante', 'Edna', 'R.', '', 'Female', '1900-03-03', '', '', 'M0303BE3', '', 'Single', '', '', 'Active', '', '2007-02-15', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(105283, 'Umali', 'Joyce', '', '', 'Female', '1900-01-26', '', '', 'M0127UJ0', '', 'Single', '', '', 'Active', '', '2012-10-03', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(105332, 'Mananghaya', 'Ludivina', 'S.', '', 'Female', '1971-01-01', '', '', 'M0712ML0', '', 'Single', '', '', 'Active', '', '2004-06-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(105429, 'Soria', 'Mayreen Grace', '', '', 'Female', '1980-07-12', '', '', '', '', 'Single', '', '', 'Active', '', '2004-03-26', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(105766, 'Magsakay', 'Ma. Jelyn', '', '', 'Female', '1980-07-12', '', '', '', '', 'Single', '', '', 'Active', '', '2004-08-02', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(105938, 'Carbo', 'Mary Grace', '', '', 'Female', '2004-10-09', '', '', '', '', 'Single', '', '', 'Active', '', '2004-10-09', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(106095, 'Roque', 'Devie', '', '', 'Female', '2004-12-13', '', '', '', '', 'Married', '', '', 'Active', '', '2004-12-13', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(106261, 'Bautista', 'Richard', '', '', 'Female', '2005-02-26', '', '', '', '', 'Single', '', '', 'Active', '', '2005-02-26', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(106473, 'Bantog', 'Angelita', '', '', 'Female', '2005-06-08', '', '', '', '', 'Single', '', '', 'Active', '', '2005-06-08', 'MA', 'ACHIEVERS', 'Acts'),
(106590, 'Flores Jr.', 'Bernardo', '', '', 'Male', '2005-08-02', '', '', '', '', 'Single', '', '', 'Active', '', '2005-08-02', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(106708, 'Villatura', 'Daisy', '', '', 'Female', '2005-10-03', '', '', '', '', 'Single', '', '', 'Active', '', '2005-10-03', 'SM', 'ACHIEVERS', 'Adrenaline'),
(107010, 'Rivera', 'Rosenda', '', '', 'Female', '2006-03-22', '', '', '', '', 'Single', '', '', 'Active', '', '2006-03-22', 'SMG', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(107098, 'Santos', 'Agnes', '', '', 'Female', '2006-05-17', '', '', '', '', 'Single', '', '', 'Active', '', '2006-05-17', 'MA', 'ACHIEVERS', 'Amazing'),
(107203, 'Carbo', 'Leonarda', '', '', 'Female', '2006-07-17', '', '', '', '', 'Single', '', '', 'Active', '', '2004-10-09', 'MA', 'ACHIEVERS', 'Amazing'),
(107311, 'Manlapaz', 'Anna Marie', '', '', 'Female', '2006-09-04', '', '', '', '', 'Single', '', '', 'Active', '', '2006-09-04', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(107380, 'Aberia', 'Joseph', '', '', 'Male', '2006-10-07', '', '', '', '', 'Single', '', '', 'Active', '', '2006-10-09', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(107390, 'Lim', 'Marites', '', '', 'Male', '2006-10-10', '', '', '', '', 'Single', '', '', 'Active', '', '2006-10-16', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(107588, 'Villatura', 'Reynaldo', 'O', '', 'Female', '2007-01-29', '', '', '', '', 'Single', '', '', 'Active', '', '2005-10-03', 'MA', 'ACHIEVERS', 'Adrenaline'),
(107597, 'Rodriguez', 'Rico', '', '', 'Male', '2007-01-31', '', '', '', '', 'Single', '', '', 'Active', '', '2007-02-01', 'MA', 'ACHIEVERS', 'Amazing'),
(107755, 'Andan', 'Edna', 'S', '', 'Male', '2007-03-22', '', '', '', '', 'Single', '', '', 'Active', '', '2007-04-18', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(107832, 'Cruz', 'Gorgonia', 'C', '', 'Male', '2007-05-31', '', '', '', '', 'Single', '', '', 'Active', '', '2007-06-02', 'MA', 'ACHIEVERS', 'Amazing'),
(107957, 'Quindao', 'Asuncion', '', '', 'Male', '2007-08-24', '', '', '', '', 'Single', '', '', 'Active', '', '2007-08-28', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(107989, 'Morales', 'Arlene', '', '', 'Male', '2007-09-16', '', '', '', '', 'Single', '', '', 'Active', '', '2007-09-18', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108024, 'Buquid', 'Analyn', '', '', 'Male', '2007-09-29', '', '', '', '', 'Single', '', '', 'Active', '', '2007-10-04', 'MA', 'ACHIEVERS', 'Acts'),
(108083, 'Galang', 'Josefina', 'A', '', 'Male', '2007-10-31', '', '', '', '', 'Single', '', '', 'Active', '', '2007-11-08', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108094, 'Hernando', 'Mary Ann', '', '', 'Male', '2007-11-18', '', '', '', '', 'Single', '', '', 'Active', '', '2007-11-19', 'SM', 'ACHIEVERS', 'Achievers - Direct'),
(108239, 'San Pedro', 'Elsa', 'R', '', 'Female', '2008-02-04', '', '', '', '', 'Single', '', '', 'Active', '', '2008-02-08', 'AVP', 'ACHIEVERS', 'Awesome'),
(108422, 'Carbo', 'Mildred', '', '', 'Female', '2008-04-25', '', '', '', '', 'Single', '', '', 'Active', '', '2008-04-28', 'AVP', 'ACHIEVERS', 'Achievers - Direct'),
(108427, 'Hernando Jr.', 'Rodolfo', '', '', 'Male', '2008-05-02', '', '', '', '', 'Single', '', '', 'Active', '', '2007-06-22', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108458, 'Guelas', 'Maylene', 'P', '', 'Female', '1977-08-21', '', '', '', '', 'Married', '33-6454233-7', '226-710-213-000', 'Active', '', '2000-07-10', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(108478, 'Cruz', 'Maritess', 'M', '', 'Female', '2008-05-24', '', '', '', '', 'Single', '', '', 'Active', '', '2008-05-26', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(108554, 'Cruz', 'Mercedes', 'P', '', 'Female', '2008-06-22', '', '', '', '', 'Married', '', '', 'Active', '', '1996-02-07', 'MA', 'ACHIEVERS', 'Amazing'),
(108648, 'Mendoza', 'Medy', 'S', '', 'Female', '2008-08-08', '', '', '', '', 'Single', '', '', 'Active', '', '2008-08-11', 'MA', 'ACHIEVERS', 'Amazing'),
(108662, 'Daquigan', 'Maria Cristina', '', '', 'Female', '2008-08-29', '', '', '', '', 'Single', '', '', 'Active', '', '2008-09-01', 'MA', 'ACHIEVERS', 'Acts'),
(108764, 'Pandacan', 'Rosemarie', '', '', 'Female', '2008-10-11', '', '', '', '', 'Single', '', '', 'Active', '', '2008-10-14', 'MA', 'ACHIEVERS', 'Acts'),
(108804, 'Flores', 'Edna', '', '', 'Female', '2008-10-31', '', '', '', '', 'Single', '', '', 'Active', '', '2008-11-06', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108828, 'Caparas', 'Geronima', 'M', '', 'Female', '2008-11-18', '', '', '', '', 'Single', '', '', 'Active', '', '2008-11-18', 'MA', 'ACHIEVERS', 'Acts'),
(108829, 'Santos', 'Marilyn', 'S', '', 'Female', '2008-11-18', '', '', '', '', 'Single', '', '', 'Active', '', '2008-11-19', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108910, 'Alcantara', 'Mary Ann', '', '', 'Female', '1980-03-16', '', '', '', '', 'Married', '', '', 'Active', '', '2009-01-13', 'SM', 'ACHIEVERS', 'Adrenaline'),
(108915, 'Sandoval', 'Milagros', '', '', 'Female', '1899-12-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-01-14', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108920, 'Manalad', 'Mercy', '', '', 'Female', '2009-01-09', '', '', '', '', 'Single', '', '', 'Active', '', '2009-01-15', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(108941, 'Santos', 'Rodan', 'M', '', 'Male', '2009-01-23', '', '', '', '', 'Single', '', '', 'Active', '', '2009-01-26', 'MA', 'ACHIEVERS', 'Amazing'),
(109036, 'Cruz', 'Puirficacion', '', '', 'Female', '2009-03-03', '', '', '', '', 'Married', '', '', 'Active', '', '2009-03-03', 'MA', 'ACHIEVERS', 'Amazing'),
(109078, 'Reyes', 'Mary Ann', '', '', 'Female', '2009-03-15', '', '', '', '', 'Single', '', '', 'Active', '', '2009-03-17', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109100, 'Angeles', 'Romeo', '', '', 'Male', '2009-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-04-03', 'MA', 'ACHIEVERS', 'Amazing'),
(109101, 'Sy', 'Myrna', '', '', 'Female', '2009-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2006-07-03', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109102, 'Santos', 'Deborah', '', '', 'Female', '2009-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-04-03', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109126, 'De Rueda', 'Ma. Rowena', '', '', 'Female', '2009-04-07', '', '', '', '', 'Single', '', '', 'Active', '', '2009-04-14', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109139, 'Villaluz', 'Maria', '', '', 'Female', '2009-04-19', '', '', '', '', 'Single', '', '', 'Active', '', '2009-04-21', 'MA', 'ACHIEVERS', 'Amazing'),
(109166, 'Herrera', 'Bernardo', '', '', 'Male', '2009-04-30', '', '', '', '', 'Single', '', '', 'Active', '', '2009-05-05', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109169, 'Dela Cruz', 'Grace', 'M', '', 'Female', '2009-04-30', '', '', '', '', 'Single', '', '', 'Active', '', '2009-05-06', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109170, 'Calonzo', 'Maria Luisa', '', '', 'Female', '2009-05-06', '', '', '', '', 'Single', '', '', 'Active', '', '2005-01-08', 'MA', 'ACHIEVERS', 'Amazing'),
(109184, 'Evangelista', 'Maria', '', '', 'Female', '2009-03-11', '', '', '', '', 'Single', '', '', 'Active', '', '2009-05-14', 'MA', 'ACHIEVERS', 'Amazing'),
(109192, 'Galvez', 'Elizabeth', '', '', 'Female', '2009-05-17', '', '', '', '', 'Single', '', '', 'Active', '', '2009-05-19', 'MA', 'ACHIEVERS', 'Amazing'),
(109218, 'Sabornido', 'Sophia', 'P', '', 'Female', '2009-05-29', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-03', 'MA', 'ACHIEVERS', 'Awesome'),
(109219, 'Panaligan', 'Cecilia', '', '', 'Female', '2009-05-29', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-03', 'MA', 'ACHIEVERS', 'Awesome'),
(109237, 'Reyes', 'Teodoro', '', '', 'Male', '2009-05-29', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-08', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109250, 'Barrun', 'Marilou', '', '', 'Female', '2009-06-14', '', '', '', '', 'Single', '', '', 'Active', '', '2004-03-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109267, 'Timbang', 'Juanito', '', '', 'Female', '2009-06-16', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-05', 'MA', 'ACHIEVERS', 'Amazing'),
(109273, 'Manuel', 'Herminia', 'R', '', 'Female', '2009-06-29', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-30', 'MA', 'ACHIEVERS', 'Amazing'),
(109278, 'Calonzo', 'Renato', '', '', 'Male', '2009-06-29', '', '', '', '', 'Single', '', '', 'Active', '', '2009-06-30', 'MA', 'ACHIEVERS', 'Amazing'),
(109326, 'Lazos', 'Mary Ann', '', '', 'Female', '2009-07-19', '', '', '', '', 'Single', '', '', 'Active', '', '2009-07-20', 'MA', 'ACHIEVERS', 'Adrenaline'),
(109354, 'Yamatsuda', 'Edlyn', 'G', '', 'Female', '2009-07-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-08-03', 'MA', 'ACHIEVERS', 'Adrenaline'),
(109356, 'Lacanlale', 'Mary Grace', '', '', 'Female', '2009-07-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-08-03', 'MA', 'ACHIEVERS', 'Amazing'),
(109370, 'Sablan', 'Jiji', 'M', '', 'Female', '2009-07-31', '', '', '', '', 'Single', '', '', 'Active', '', '2009-08-06', 'MA', 'ACHIEVERS', 'Acts'),
(109399, 'Gerona', 'Nelia', 'C', '', 'Female', '2009-08-04', '', '', '', '', 'Single', '', '', 'Active', '', '2006-04-12', 'MA', 'ACHIEVERS', 'Adrenaline'),
(109431, 'Mangalili', 'Angelus', '', '', 'Female', '2009-08-27', '', '', '', '', 'Single', '', '', 'Active', '', '2009-08-28', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109438, 'Quijano', 'Criselda', '', '', 'Female', '2009-09-02', '', '', '', '', 'Single', '', '', 'Active', '', '2009-09-02', 'MA', 'ACHIEVERS', 'Amazing'),
(109475, 'Esterban', 'Viobennyll', 'C', '', 'Male', '2009-09-14', '', '', '', '', 'Single', '', '', 'Active', '', '2009-09-16', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109477, 'Varilla', 'Eugene Dexter', '', '', 'Male', '2009-09-14', '', '', '', '', 'Single', '', '', 'Active', '', '2009-09-16', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109483, 'Gilo', 'Ma. Grazel', 'M', '', 'Female', '2009-09-20', '', '', '', '', 'Single', '', '', 'Active', '', '2009-09-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(109494, 'Quiambao', 'Karen', '', '', 'Female', '2009-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2009-10-01', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109533, 'Ang', 'Rowena', 'G', '', 'Female', '2009-10-10', '', '', '', '', 'Single', '', '', 'Active', '', '2009-10-21', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109538, 'Reyes', 'Ian', 'M', '', 'Male', '2009-10-18', '', '', '', '', 'Single', '', '', 'Active', '', '2009-10-22', 'MA', 'ACHIEVERS', 'Amazing'),
(109585, 'Marcos', 'Edna', '', '', 'Female', '2009-11-26', '', '', '', '', 'Single', '', '', 'Active', '', '2009-11-27', 'MA', 'ACHIEVERS', 'Amazing'),
(109628, 'Perez', 'Rosario', 'E', '', 'Female', '2009-12-29', '', '', '', '', 'Single', '', '', 'Active', '', '2010-01-05', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109657, 'Taguigui', 'Pilar', 'L', '', 'Female', '2010-01-17', '', '', '', '', 'Single', '', '', 'Active', '', '2010-01-18', 'SM', 'ACHIEVERS', 'Achievers - Direct'),
(109661, 'Disangcopan', 'Madrigal Jehan', '', '', 'Male', '2010-01-17', '', '', '', '', 'Single', '', '', 'Active', '', '2010-01-19', 'MA', 'ACHIEVERS', 'Awesome'),
(109671, 'Torres', 'Imelda', 'C', '', 'Female', '2010-01-25', '', '', '', '', 'Single', '', '', 'Active', '', '2010-01-25', 'MA', 'ACHIEVERS', 'Amazing'),
(109697, 'Aguas', 'Janet', 'C', '', 'Female', '2010-02-04', '', '', '', '', 'Single', '', '', 'Active', '', '2010-02-04', 'MA', 'ACHIEVERS', 'Amazing'),
(109719, 'Mercado', 'Marianita', 'C', '', 'Female', '2010-02-18', '', '', '', '', 'Single', '', '', 'Active', '', '2010-02-18', 'MA', 'ACHIEVERS', 'Amazing'),
(109787, 'Caberte', 'Mary Grace', '', '', 'Female', '2010-03-22', '', '', '', '', 'Single', '', '', 'Active', '', '2010-03-22', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(109918, 'Dabatos', 'Jovita', '', '', 'Female', '2010-05-18', '', '', '', '', 'Single', '', '', 'Active', '', '2010-05-18', 'SM', 'ACHIEVERS', 'Awesome'),
(109936, 'Robles', 'Erwin', '', '', 'Male', '2010-05-26', '', '', '', '', 'Single', '', '', 'Active', '', '2010-05-26', 'MA', 'ACHIEVERS', 'Amazing'),
(109950, 'Santos', 'Luzviminda', '', '', 'Female', '2010-06-01', '', '', '', '', 'Single', '', '', 'Active', '', '2010-06-01', 'MA', 'ACHIEVERS', 'Acts'),
(109970, 'Dequina', 'Richard', '', '', 'Male', '2010-06-16', '', '', '', '', 'Single', '', '', 'Active', '', '2010-06-16', 'MA', 'ACHIEVERS', 'Adrenaline'),
(109983, 'Villadarez', 'Evangeline', 'K.', '', 'Female', '2010-06-22', '', '', '', '', 'Single', '', '', 'Active', '', '2010-06-22', 'MA', 'ACHIEVERS', 'Amazing'),
(109993, 'Bulaclac', 'Nerisa', 'J.', '', 'Female', '2010-06-24', '', '', '', '', 'Single', '', '', 'Active', '', '2010-06-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110011, 'Martinez', 'Lolita', '', '', 'Female', '2010-07-01', '', '', '', '', 'Single', '', '', 'Active', '', '2010-07-01', 'MA', 'ACHIEVERS', 'Amazing'),
(110019, 'Matibag', 'Emerita', '', '', 'Female', '2010-07-05', '', '', '', '', 'Single', '', '', 'Active', '', '2010-07-05', 'MA', 'ACHIEVERS', 'Amazing'),
(110043, 'Bombase', 'Ma. Gertrudez', '', '', 'Female', '2010-07-22', '', '', '', '', 'Single', '', '', 'Active', '', '2010-07-22', 'MA', 'ACHIEVERS', 'Amazing'),
(110050, 'Robles', 'Herminia', '', '', 'Female', '2010-07-26', '', '', '', '', 'Single', '', '', 'Active', '', '2010-07-26', 'MA', 'ACHIEVERS', 'Amazing'),
(110055, 'Bautista', 'Ma. Rebecca', '', '', 'Female', '2010-07-27', '', '', '', '', 'Single', '', '', 'Active', '', '2010-07-27', 'SM', 'ACHIEVERS', 'Achievers - Direct'),
(110065, 'Francisco', 'Ma. Melody', '', '', 'Female', '2010-08-02', '', '', '', '', 'Single', '', '', 'Active', '', '2010-08-02', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110083, 'Gallego', 'Feliciana', '', '', 'Female', '2010-08-09', '', '', '', '', 'Single', '', '', 'Active', '', '2010-08-09', 'MA', 'ACHIEVERS', 'Awesome'),
(110089, 'Lazaro', 'Evangelina', '', '', 'Female', '2010-08-11', '', '', '', '', 'Single', '', '', 'Active', '', '2010-08-11', 'MA', 'ACHIEVERS', 'Awesome'),
(110111, 'Tan', 'Raymond Ryan', '', '', 'Male', '2010-08-23', '', '', '', '', 'Single', '', '', 'Active', '', '2010-08-23', 'MA', 'ACHIEVERS', 'Amazing'),
(110151, 'Chan', 'Elsa', 'A.', '', 'Female', '2010-09-13', '', '', '', '', 'Single', '', '', 'Active', '', '2010-09-13', 'MA', 'ACHIEVERS', 'Acts'),
(110156, 'Danga', 'Marlon', '', '', 'Male', '2010-09-14', '', '', '', '', 'Single', '', '', 'Active', '', '2010-09-14', 'MA', 'ACHIEVERS', 'Amazing'),
(110173, 'Brillantes', 'Levi', '', '', 'Male', '2010-09-27', '', '', '', '', 'Single', '', '', 'Active', '', '2010-09-27', 'MA', 'ACHIEVERS', 'Amazing'),
(110224, 'Torres', 'Alice', 'Q.', '', 'Female', '2010-10-19', '', '', '', '', 'Single', '', '', 'Active', '', '2010-10-19', 'MA', 'ACHIEVERS', 'Amazing'),
(110249, 'Dela Cruz', 'Ma. Luisa', '', '', 'Female', '2010-11-02', '', '', '', '', 'Single', '', '', 'Active', '', '2010-11-02', 'MA', 'ACHIEVERS', 'Awesome'),
(110297, 'Ordinario', 'Mary Grace', 'R.', '', 'Female', '2010-12-13', '', '', '', '', 'Single', '', '', 'Active', '', '2010-12-13', 'SM', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(110313, 'Urbano', 'Jocelyn', '', '', 'Female', '2010-12-16', '', '', '', '', 'Single', '', '', 'Active', '', '2010-12-16', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110320, 'Santiago', 'Diana Gwen', '', '', 'Female', '2010-12-28', '', '', '', '', 'Single', '', '', 'Active', '', '2010-12-28', 'MA', 'ACHIEVERS', 'Adrenaline'),
(110376, 'Catacutan', 'Gazelle', '', '', 'Female', '2011-01-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-01-21', 'MA', 'ACHIEVERS', 'Amazing'),
(110378, 'Arriola', 'Elvira', 'S.', '', 'Female', '2011-01-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-01-21', 'MA', 'ACHIEVERS', 'Amazing'),
(110381, 'Capisonda', 'Bernadette', '', '', 'Female', '2011-01-25', '', '', '', '', 'Single', '', '', 'Active', '', '2011-01-25', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(110456, 'San Pedro', 'Ramil', '', '', 'Male', '2011-02-18', '', '', '', '', 'Single', '', '', 'Active', '', '2011-02-18', 'MA', 'ACHIEVERS', 'Awesome'),
(110469, 'Peneyra', 'Nerisa', '', '', 'Female', '2011-02-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-02-21', 'MA', 'ACHIEVERS', 'Awesome'),
(110474, 'Nacional', 'Rogelio', '', '', 'Male', '2011-02-24', '', '', '', '', 'Single', '', '', 'Active', '', '2011-02-24', 'MA', 'ACHIEVERS', 'Amazing'),
(110480, 'Ongkeko', 'Amalia', 'V.', '', 'Female', '2011-02-24', '', '', '', '', 'Single', '', '', 'Active', '', '2011-02-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110517, 'Ramirez', 'Carolina', '', '', 'Female', '2011-03-08', '', '', '', '', 'Single', '', '', 'Active', '', '2011-03-08', 'MA', 'ACHIEVERS', 'Awesome'),
(110552, 'Carbo', 'Jimmel', '', '', 'Male', '2011-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2011-03-31', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110553, 'Clemente', 'Joy Angeline', '', '', 'Female', '2011-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2011-03-31', 'MA', 'ACHIEVERS', 'Acts'),
(110568, 'Peneyra', 'Baldwin', 'M.', '', 'Male', '2011-04-05', '', '', '', '', 'Single', '', '', 'Active', '', '2011-04-05', 'MA', 'ACHIEVERS', 'Awesome'),
(110570, 'Tan', 'Leticia', 'S.', '', 'Female', '2011-04-06', '', '', '', '', 'Single', '', '', 'Active', '', '2011-04-06', 'MA', 'ACHIEVERS', 'Acts'),
(110607, 'Santiago', 'Evelyn', '', '', 'Female', '2011-04-24', '', '', '', '', 'Single', '', '', 'Active', '', '2011-04-27', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110610, 'Valenzuela', 'Melody', 'P.', '', 'Female', '2011-04-28', '', '', '', '', 'Single', '', '', 'Active', '', '2011-04-28', 'MA', 'ACHIEVERS', 'Amazing'),
(110634, 'Manansala', 'Angelito', '', '', 'Female', '2011-05-05', '', '', '', '', 'Single', '', '', 'Active', '', '2011-05-05', 'MA', 'ACHIEVERS', 'Adrenaline'),
(110658, 'Garcia', 'Aldwin', 'L.', '', 'Male', '2011-05-19', '', '', '', '', 'Single', '', '', 'Active', '', '2011-05-19', 'MA', 'ACHIEVERS', 'Acts'),
(110663, 'Ramat', 'Merlito', '', '', 'Female', '2011-05-20', '', '', '', '', 'Single', '', '', 'Active', '', '2011-05-20', 'MA', 'ACHIEVERS', 'Amazing'),
(110673, 'Sevilla', 'Lucila', '', '', 'Female', '2011-05-31', '', '', '', '', 'Single', '', '', 'Active', '', '2011-05-31', 'MA', 'ACHIEVERS', 'Awesome'),
(110675, 'Juliano', 'Giselda', '', '', 'Female', '2011-05-31', '', '', '', '', 'Single', '', '', 'Active', '', '2011-05-31', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110687, 'Magsakay', 'Pamela', 'Z.', '', 'Female', '2011-06-01', '', '', '', '', 'Single', '', '', 'Active', '', '2011-06-01', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(110717, 'Flores', 'Lucita', '', '', 'Female', '2011-06-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-06-21', 'MA', 'ACHIEVERS', 'Awesome'),
(110741, 'Geronimo', 'Renier', '', '', 'Male', '2011-06-30', '', '', '', '', 'Single', '', '', 'Active', '', '2011-06-30', 'MA', 'ACHIEVERS', 'Adrenaline'),
(110742, 'Nabong', 'Gladys', 'T.', '', 'Female', '2011-06-30', '', '', '', '', 'Single', '', '', 'Active', '', '2011-06-30', 'MA', 'ACHIEVERS', 'Amazing'),
(110753, 'Rodriguez', 'Archie', '', '', 'Male', '2011-07-01', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-01', 'MA', 'ACHIEVERS', 'Amazing'),
(110759, 'Hilario', 'Corazon', '', '', 'Female', '2011-07-04', '', '', '', '', 'Single', '', '', 'Active', '', '2009-12-23', 'MA', 'ACHIEVERS', 'Amazing'),
(110775, 'Figueroa', 'Flordeliza', '', '', 'Female', '2011-07-11', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-11', 'MA', 'ACHIEVERS', 'Awesome'),
(110781, 'Alfaro', 'Wilma', '', '', 'Female', '2011-07-18', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-18', 'MA', 'ACHIEVERS', 'Acts'),
(110789, 'Gutierrez', 'John Robert', 'S.', '', 'Male', '2011-07-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-21', 'MA', 'ACHIEVERS', 'Awesome'),
(110791, 'Dela Cruz', 'Gerlie Ann', '', '', 'Female', '2011-07-21', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-21', 'MA', 'ACHIEVERS', 'Awesome'),
(110806, 'Santos', 'Charmaine', 'C.', '', 'Female', '2011-07-29', '', '', '', '', 'Single', '', '', 'Active', '', '2011-07-29', 'MA', 'ACHIEVERS', 'Amazing'),
(110824, 'Tan', 'Micah Blessy', '', '', 'Female', '2011-08-05', '', '', '', '', 'Single', '', '', 'Active', '', '2011-08-05', 'MA', 'ACHIEVERS', 'Acts'),
(110861, 'Flores', 'Rosita', '', '', 'Female', '2011-09-01', '', '', '', '', 'Single', '', '', 'Active', '', '2011-09-01', 'MA', 'ACHIEVERS', 'Awesome'),
(110883, 'Agra', 'Karen', '', '', 'Female', '2011-08-31', '', '', '', '', 'Single', '', '', 'Active', '', '2011-09-05', 'MA', 'ACHIEVERS', 'Amazing'),
(110908, 'Cruz', 'Manolito', '', '', 'Male', '2011-07-29', '', '', '', '', 'Single', '', '', 'Active', '', '2011-09-20', 'MA', 'ACHIEVERS', 'Acts'),
(110950, 'Rodriguez', 'Maricel', 'P', '', 'Female', '2011-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2011-10-06', 'MA', 'ACHIEVERS', 'Amazing'),
(110983, 'Vergara', 'Shirley', '', '', 'Female', '2011-10-16', '', '', '', '', 'Single', '', '', 'Active', '', '2011-10-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111006, 'Geronimo', 'Ederlyn Muriel', '', '', 'Female', '2011-10-28', '', '', '', '', 'Single', '', '', 'Active', '', '2011-11-03', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111034, 'Yambao', 'Rowena', '', '', 'Female', '2011-10-28', '', '', '', '', 'Single', '', '', 'Active', '', '2011-11-18', 'MA', 'ACHIEVERS', 'Acts'),
(111047, 'Buhain', 'Reynan', 'E', '', 'Male', '2011-11-27', '', '', '', '', 'Single', '', '', 'Active', '', '2011-12-01', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111078, 'Tuazon', 'Sheena', '', '', 'Male', '2011-12-11', '', '', '', '', 'Single', '', '', 'Active', '', '2011-12-14', 'MA', 'ACHIEVERS', 'Acts'),
(111113, 'Del Rosario', 'Rowena', 'A', '', 'Female', '2012-01-08', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-10', 'MA', 'ACHIEVERS', 'Acts'),
(111124, 'Arceo', 'Marianne', 'M', '', 'Female', '2012-01-08', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-11', 'MA', 'ACHIEVERS', 'Acts'),
(111126, 'Bolado', 'Zenaida', '', '', 'Female', '2012-01-08', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-13', 'MA', 'ACHIEVERS', 'Amazing'),
(111130, 'Arthur', 'Maria Teresa', '', '', 'Female', '2012-01-15', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-17', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(111139, 'Valdez', 'Rosella', '', '', 'Female', '2012-01-15', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-20', 'MA', 'ACHIEVERS', 'Awesome'),
(111143, 'Romasanta', 'Christine Lorraine', 'D', '', 'Female', '2012-01-19', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-20', 'MA', 'ACHIEVERS', 'Amazing'),
(111144, 'Idio', 'Jilly Lyneth', 'O', '', 'Female', '2012-01-18', '', '', '', '', 'Single', '', '', 'Active', '', '2012-01-20', 'MA', 'ACHIEVERS', 'Amazing'),
(111171, 'Garcia', 'Necita', '', '', 'Female', '2012-01-31', '', '', '', '', 'Single', '', '', 'Active', '', '2012-02-06', 'MA', 'ACHIEVERS', 'Awesome'),
(111188, 'Cristobal', 'Aiza', 'G', '', 'Female', '2012-02-05', '', '', '', '', 'Single', '', '', 'Active', '', '2012-02-10', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111191, 'Fajardo', 'Ian', '', '', 'Male', '2012-02-05', '', '', '', '', 'Single', '', '', 'Active', '', '2012-02-10', 'MA', 'ACHIEVERS', 'Amazing'),
(111201, 'Pascual', 'Michelle', '', '', 'Female', '2012-02-12', '', '', '', '', 'Single', '', '', 'Active', '', '2012-02-15', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111223, 'Gutierrez', 'Teresa', 'P', '', 'Female', '2012-02-27', '', '', '', '', 'Single', '', '', 'Active', '', '2012-03-01', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111226, 'Fajardo', 'Julito', 'S', '', 'Male', '2012-02-27', '', '', '', '', 'Single', '', '', 'Active', '', '2012-03-02', 'MA', 'ACHIEVERS', 'Acts'),
(111227, 'Munoz', 'George', 'P', '', 'Male', '2012-02-29', '', '', '', '', 'Single', '', '', 'Active', '', '2012-03-05', 'MA', 'ACHIEVERS', 'Awesome'),
(111260, 'Gonzales', 'Linela', '', '', 'Female', '2012-03-11', '', '', '', '', 'Single', '', '', 'Active', '', '2012-03-14', 'MA', 'ACHIEVERS', 'Awesome'),
(111268, 'Montes', 'Nimfa', '', '', 'Female', '2012-03-22', '', '', '', '', 'Single', '', '', 'Active', '', '2012-03-27', 'MA', 'ACHIEVERS', 'Awesome'),
(111291, 'Amurao', 'Aaron Jehrome', '', '', 'Male', '2012-04-10', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-10', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(111298, 'Bantog', 'Feliza', '', '', 'Female', '2012-03-30', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-10', 'MA', 'ACHIEVERS', 'Acts'),
(111304, 'Grospe', 'Maricel', '', '', 'Female', '2012-03-30', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-11', 'MA', 'ACHIEVERS', 'Amazing'),
(111308, 'Dumaguete', 'Janneth', 'R', '', 'Female', '2012-03-16', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-16', 'MA', 'ACHIEVERS', 'Amazing'),
(111311, 'Jimenez', 'Ronalyn', 'P', '', 'Female', '2012-04-11', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-17', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111317, 'Ramirez', 'Julie Ann', 'C', '', 'Female', '2012-03-27', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-19', 'MA', 'ACHIEVERS', 'Acts'),
(111353, 'Alcoriza', 'Mylene', 'T', '', 'Female', '2012-04-29', '', '', '', '', 'Single', '', '', 'Active', '', '2012-04-10', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111369, 'Dela Pena', 'Ma. Rosalinda', 'Dc', '', 'Female', '2012-05-07', '', '', '', '', 'Single', '', '', 'Active', '', '2012-05-25', 'MA', 'ACHIEVERS', 'Amazing'),
(111379, 'Sotta', 'Matilde', '', '', 'Female', '2012-04-29', '', '', '', '', 'Single', '', '', 'Active', '', '2012-06-01', 'SM', 'ACHIEVERS', 'Awesome'),
(111412, 'Javier', 'Brian', '', '', 'Male', '2012-05-31', '', '', '', '', 'Single', '', '', 'Active', '', '2012-06-19', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111423, 'Dela Cruz', 'Katherine', 'B', '', 'Female', '2012-06-24', '', '', '', '', 'Single', '', '', 'Active', '', '2012-06-28', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111434, 'Privaldos', 'Maricris', 'V', '', 'Female', '2012-06-26', '', '', '', '', 'Single', '', '', 'Active', '', '2012-07-03', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111435, 'Lopez', 'Armelinda', 'A.', '', 'Female', '2012-07-03', '', '', '', '', 'Single', '', '', 'Active', '', '2012-07-03', 'MA', 'ACHIEVERS', 'Amazing'),
(111463, 'Timbang', 'Milie', 'C', '', 'Female', '2012-05-31', '', '', '', '', 'Single', '', '', 'Active', '', '2012-07-12', 'MA', 'ACHIEVERS', 'Amazing'),
(111482, 'Russel', 'Gorgonia', '', '', 'Female', '2012-07-29', '', '', '', '', 'Single', '', '', 'Active', '', '2012-08-01', 'MA', 'ACHIEVERS', 'Awesome'),
(111487, 'Clemente', 'Icy Angeline', '', '', 'Female', '2012-07-31', '', '', '', '', 'Single', '', '', 'Active', '', '2012-08-03', 'MA', 'ACHIEVERS', 'Amazing'),
(111521, 'Alejandro', 'Ariel', 'C', '', 'Male', '2012-08-24', '', '', '', '', 'Single', '', '', 'Active', '', '2012-08-28', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111537, 'Cunan', 'Cherry', 'D', '', 'Female', '2012-08-22', '', '', '', '', 'Single', '', '', 'Active', '', '2012-09-04', 'MA', 'ACHIEVERS', 'Amazing'),
(111555, 'Martinez', 'Candy', 'P', '', 'Female', '2012-08-19', '', '', '', '', 'Single', '', '', 'Active', '', '2012-09-14', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111613, 'Manalaysay', 'Elizabeth', '', '', 'Female', '2012-10-23', '', '', '', '', 'Single', '', '', 'Active', '', '2012-10-29', 'MA', 'ACHIEVERS', 'Awesome'),
(111627, 'Bautista', 'Gerardo', 'J', '', 'Male', '2012-10-31', '', '', '', '', 'Single', '', '', 'Active', '', '2012-11-07', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111669, 'Dela Paz', 'Mark Joseph', 'F', '', 'Male', '2012-12-18', '', '', '', '', 'Single', '', '', 'Active', '', '2012-12-26', 'MA', 'ACHIEVERS', 'Amazing'),
(111672, 'Reyes', 'Edgar', '', '', 'Female', '2012-12-28', '', '', '', '', 'Single', '', '', 'Active', '', '2012-12-28', 'MA', 'ACHIEVERS', 'Amazing'),
(111688, 'Bautista', 'Daisy', '', '', 'Female', '2013-01-08', '', '', '', '', 'Single', '', '', 'Active', '', '2011-03-01', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111697, 'Sotta', 'Reynan', 'V', '', 'Male', '2013-01-13', '', '', '', '', 'Single', '', '', 'Active', '', '2012-06-01', 'MA', 'ACHIEVERS', 'Awesome'),
(111711, 'Ferrer', 'Norielia', '', '', 'Female', '2013-01-10', '', '', '', '', 'Single', '', '', 'Active', '', '2013-01-29', 'MA', 'ACHIEVERS', 'Awesome'),
(111750, 'Salmos', 'Jaypee', '', '', 'Male', '2013-02-07', '', '', '', '', 'Single', '', '', 'Active', '', '2013-02-13', 'MA', 'ACHIEVERS', 'Awesome'),
(111756, 'Carbo', 'Melissa', 'M', '', 'Female', '2013-02-15', '', '', '', '', 'Single', '', '', 'Active', '', '2013-02-18', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111770, 'Torres', 'Liezl', 'R', '', 'Female', '2013-02-26', '', '', '', '', 'Single', '', '', 'Active', '', '2013-02-27', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111773, 'Alvaro', 'Michael', '', '', 'Male', '2013-02-24', '', '', '', '', 'Single', '', '', 'Active', '', '2008-04-24', 'MA', 'ACHIEVERS', 'Awesome'),
(111797, 'Mallari', 'Noelito', 'I', '', 'Male', '2013-03-11', '', '', '', '', 'Single', '', '', 'Active', '', '2013-03-15', 'MA', 'ACHIEVERS', 'Awesome'),
(111804, 'Manlapig', 'Ma. Victoria', '', '', 'Female', '2013-03-21', '', '', '', '', 'Single', '', '', 'Active', '', '2013-03-25', 'MA', 'ACHIEVERS', 'Awesome'),
(111806, 'Reyes', 'Ciela', 'N', '', 'Female', '2013-03-20', '', '', '', '', 'Single', '', '', 'Active', '', '2013-03-25', 'MA', 'ACHIEVERS', 'Acts'),
(111811, 'Mercado', 'Samantha Elaine', '', '', 'Female', '2013-03-20', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-01', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111844, 'Cruz', 'Jhoane', '', '', 'Female', '2013-04-14', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-16', 'MA', 'ACHIEVERS', 'Awesome'),
(111853, 'Benson', 'Katherine Louise', 'C.', '', 'Female', '2013-04-15', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-18', 'MA', 'ACHIEVERS', 'Amazing'),
(111863, 'Santiago', 'Rhodora', '', '', 'Female', '2013-04-22', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-24', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111864, 'Danga', 'Demy', '', '', 'Male', '2013-02-22', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-24', 'MA', 'ACHIEVERS', 'Amazing'),
(111867, 'Ocampo', 'Lolita', '', '', 'Female', '2013-04-24', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111870, 'Balauag', 'Candelaria', 'D', '', 'Female', '2013-04-25', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-26', 'MA', 'ACHIEVERS', 'Awesome'),
(111873, 'Alberto', 'Rica', 'C', '', 'Female', '2013-04-28', '', '', '', '', 'Single', '', '', 'Active', '', '2013-04-29', 'MA', 'ACHIEVERS', 'Awesome'),
(111896, 'Canto', 'Eulogia', '', '', 'Female', '2013-05-09', '', '', '', '', 'Single', '', '', 'Active', '', '2013-05-10', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111905, 'De Leon', 'Osmond', 'L', '', 'Male', '2013-05-21', '', '', '', '', 'Single', '', '', 'Active', '', '2013-05-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(111906, 'Maniego', 'Jenarose', '', '', 'Female', '2013-07-07', '', '', '', '', 'Single', '', '', 'Active', '', '2013-05-23', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111907, 'Maniego', 'Paulo Edwin', '', '', 'Male', '2013-07-07', '', '', '', '', 'Single', '', '', 'Active', '', '2013-05-24', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(111915, 'Santos', 'Helen', 'C', '', 'Male', '2013-05-27', '', '', '', '', 'Single', '', '', 'Active', '', '2013-05-29', 'MA', 'ACHIEVERS', 'Acts'),
(111943, 'Benedictos', 'Aiza', '', '', 'Female', '2013-06-17', '', '', '', '', 'Single', '', '', 'Active', '', '2013-06-18', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111954, 'Santiago', 'Louie', '', '', 'Male', '2013-06-24', '', '', '', '', 'Single', '', '', 'Active', '', '2013-06-26', 'MA', 'ACHIEVERS', 'Adrenaline'),
(111969, 'Vinoya', 'Dorothy May', '', '', 'Female', '2013-07-05', '', '', '', '', 'Single', '', '', 'Active', '', '2008-04-01', 'MA', 'ACHIEVERS', 'Awesome'),
(111973, 'Cogama', 'Dorotea', '', '', 'Female', '2013-07-08', '', '', '', '', 'Single', '', '', 'Active', '', '2013-07-15', 'MA', 'ACHIEVERS', 'Awesome'),
(111987, 'Soto', 'Marina', 'O', '', 'Female', '2013-06-28', '', '', '', '', 'Single', '', '', 'Active', '', '2005-10-03', 'MA', 'ACHIEVERS', 'Amazing'),
(112007, 'Heredia', 'Alfredo', '', '', 'Male', '2013-07-31', '', '', '', '', 'Single', '', '', 'Active', '', '2013-08-07', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112023, 'Alfonso', 'Perla', 'B', '', 'Female', '2013-08-14', '', '', '', '', 'Single', '', '', 'Active', '', '2013-08-23', 'MA', 'ACHIEVERS', 'Amazing'),
(112037, 'Almario', 'Sandra', '', '', 'Female', '2013-08-28', '', '', '', '', 'Single', '', '', 'Active', '', '2013-09-03', 'MA', 'ACHIEVERS', 'Awesome'),
(112047, 'Meneses', 'Carmen', '', '', 'Female', '2013-08-30', '', '', '', '', 'Single', '', '', 'Active', '', '2013-09-05', 'MA', 'ACHIEVERS', 'Awesome'),
(112057, 'Rodriguez', 'Charlene', '', '', 'Female', '2013-08-30', '', '', '', '', 'Single', '', '', 'Active', '', '2013-09-09', 'MA', 'ACHIEVERS', 'Amazing'),
(112076, 'Manzano', 'Elieta', 'B', '', 'Female', '2013-09-20', '', '', '', '', 'Single', '', '', 'Active', '', '2013-09-25', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112113, 'Parinas', 'Agustin', 'C', '', 'Male', '2013-10-14', '', '', '', '', 'Single', '', '', 'Active', '', '2006-07-03', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112116, 'Lazaro', 'Rogelyn', '', '', 'Female', '2013-10-08', '', '', '', '', 'Single', '', '', 'Active', '', '2013-10-18', 'MA', 'ACHIEVERS', 'Awesome'),
(112117, 'Avendano', 'Fe', '', '', 'Female', '2013-10-16', '', '', '', '', 'Single', '', '', 'Active', '', '2013-10-18', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112133, 'Ramirez', 'Agrifina', 'F', '', 'Female', '2013-10-25', '', '', '', '', 'Single', '', '', 'Active', '', '2013-10-30', 'MA', 'ACHIEVERS', 'Awesome'),
(112140, 'Alsaihati', 'Alice', 'A', '', 'Female', '2013-10-27', '', '', '', '', 'Single', '', '', 'Active', '', '2013-11-04', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112161, 'Nanol', 'Jean Mae', 'Dy', '', 'Female', '2013-11-19', '', '', '', '', 'Single', '', '', 'Active', '', '2013-11-20', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112185, 'Valencia', 'Jonathan', '', '', 'Male', '2013-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2013-12-10', 'MA', 'ACHIEVERS', 'Amazing'),
(112188, 'Watanabe', 'Luzviminda', 'D', '', 'Female', '2013-11-26', '', '', '', '', 'Single', '', '', 'Active', '', '2013-12-11', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112194, 'Taberdo', 'Hermie', '', '', 'Female', '2013-12-22', '', '', '', '', 'Single', '', '', 'Active', '', '2013-12-26', 'MA', 'ACHIEVERS', 'Awesome'),
(112212, 'Miranda', 'Charmaine', 'V', '', 'Female', '2014-01-02', '', '', '', '', 'Single', '', '', 'Active', '', '2014-01-10', 'MA', 'ACHIEVERS', 'Awesome'),
(112227, 'Santos', 'Violeta', 'C', '', 'Female', '2014-01-13', '', '', '', '', 'Single', '', '', 'Active', '', '2014-01-15', 'MA', 'ACHIEVERS', 'Awesome'),
(112230, 'Yoneda', 'Chellimar', '', '', 'Female', '2014-01-17', '', '', '', '', 'Single', '', '', 'Active', '', '2014-01-20', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112248, 'Nieves', 'Reycel Marie', '', '', 'Female', '2014-01-22', '', '', '', '', 'Single', '', '', 'Active', '', '2014-01-27', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112252, 'Zartiga', 'Josie Ann', 'A', '', 'Female', '2014-01-27', '', '', '', '', 'Single', '', '', 'Active', '', '2014-01-29', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112266, 'Tacandong', 'Karen', 'M', '', 'Female', '2014-01-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-07', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112283, 'Gabriel', 'Janice', 'T', '', 'Female', '2014-01-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-10', 'MA', 'ACHIEVERS', 'Amazing'),
(112304, 'De Leon', 'Daisy', 'P', '', 'Female', '2014-02-09', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-13', 'MA', 'ACHIEVERS', 'Awesome'),
(112312, 'Jimenez', 'Archie', 'L', '', 'Male', '2014-02-12', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-14', 'MA', 'ACHIEVERS', 'Awesome'),
(112314, 'Samson', 'Martie', 'G', '', 'Male', '2014-02-07', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-14', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112340, 'Mananghaya', 'Sarah', '', '', 'Female', '2014-02-14', '', '', '', '', 'Single', '', '', 'Active', '', '2014-02-26', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112348, 'Chico', 'Emeriza', '', '', 'Female', '2014-02-28', '', '', '', '', 'Single', '', '', 'Active', '', '2014-03-04', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112352, 'Arnejo', 'Adelfa', 'C', '', 'Female', '2014-02-28', '', '', '', '', 'Single', '', '', 'Active', '', '2014-03-07', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112360, 'Mariano', 'Marlyn', 'A', '', 'Female', '2014-02-28', '', '', '', '', 'Single', '', '', 'Active', '', '2014-03-07', 'MA', 'ACHIEVERS', 'Amazing'),
(112387, 'Francisco', 'Rosanne', '', '', 'Female', '2014-03-23', '', '', '', '', 'Single', '', '', 'Active', '', '2014-03-25', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112401, 'Posillo', 'Marielle', '', '', 'Female', '2014-03-27', '', '', '', '', 'Single', '', '', 'Active', '', '2014-03-28', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112425, 'Espinola', 'Angelita', '', '', 'Female', '2014-03-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-04-04', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112462, 'Agustin', 'Angie', '', '', 'Female', '2014-04-23', '', '', '', '', 'Single', '', '', 'Active', '', '2014-05-07', 'MA', 'ACHIEVERS', 'Amazing'),
(112482, 'Varilla', 'Kristel', '', '', 'Female', '2014-04-25', '', '', '', '', 'Single', '', '', 'Active', '', '2014-05-12', 'MA', 'ACHIEVERS', 'Awesome'),
(112498, 'Ramos', 'Reymundo', '', '', 'Male', '2014-05-16', '', '', '', '', 'Single', '', '', 'Active', '', '2014-05-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112510, 'King', 'Isabelita', '', '', 'Male', '2014-05-20', '', '', '', '', 'Single', '', '', 'Active', '', '2014-05-30', 'MA', 'ACHIEVERS', 'Awesome'),
(112516, 'Tabalbag', 'Gil', 'D', '', 'Male', '2014-02-10', '', '', '', '', 'Single', '', '', 'Active', '', '2014-06-03', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112533, 'Acobo', 'Shiela', 'B.', '', 'Female', '2014-05-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-06-10', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112579, 'Calderon', 'Ronalyn', '', '', 'Female', '2014-06-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-07-10', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112595, 'Villafuerte', 'Maricel', 'S', '', 'Female', '2014-06-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-07-14', 'MA', 'ACHIEVERS', 'Awesome'),
(112599, 'Mercado', 'Irene', '', '', 'Female', '2014-07-14', '', '', '', '', 'Single', '', '', 'Active', '', '2014-07-21', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112606, 'Singson', 'Michael', '', '', 'Male', '2014-07-13', '', '', '', '', 'Single', '', '', 'Active', '', '2014-07-24', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112607, 'Singson', 'Noviemae', '', '', 'Female', '2014-07-13', '', '', '', '', 'Single', '', '', 'Active', '', '2014-07-24', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112636, 'Gabriel', 'Gina', '', '', 'Female', '2014-08-13', '', '', '', '', 'Single', '', '', 'Active', '', '2014-08-14', 'MA', 'ACHIEVERS', 'Awesome'),
(112646, 'Crisostomo', 'Jonas Arnel', 'Dc', '', 'Male', '2014-07-25', '', '', '', '', 'Single', '', '', 'Active', '', '2014-09-02', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112658, 'Sison', 'Elena', '', '', 'Female', '2014-08-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-09-08', 'MA', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112661, 'Castro', 'Andrea', 'E', '', 'Female', '2014-08-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-09-09', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112689, 'De Castro', 'Lucilo', '', '', 'Male', '2014-09-14', '', '', '', '', 'Single', '', '', 'Active', '', '2014-09-30', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112706, 'Crecencio', 'Carolina', '', '', 'Female', '2014-08-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-10-09', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112710, 'Formento, Jr.', 'Rodolfo', '', '', 'Male', '2014-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2004-04-05', 'MA', 'ACHIEVERS', 'Awesome'),
(112715, 'Fajardo', 'Cherry Rose', 'B', '', 'Female', '2014-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-10-10', 'MA', 'ACHIEVERS', 'Amazing'),
(112716, 'Banaban', 'Alona', '', '', 'Female', '2014-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-10-10', 'MA', 'ACHIEVERS', 'Awesome'),
(112727, 'Mabini', 'Karen', '', '', 'Female', '2014-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-10-13', 'MA', 'ACHIEVERS', 'Achievers - Direct'),
(112763, 'Dawang', 'Regina', '', '', 'Female', '1899-12-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-11-10', 'MA', 'ACHIEVERS', 'Awesome'),
(112770, 'Rodriguez', 'Alma', 'R', '', 'Female', '2014-10-31', '', '', '', '', 'Single', '', '', 'Active', '', '2014-11-12', 'MA', 'ACHIEVERS', 'Awesome'),
(112784, 'Angeles', 'Lenita', '', '', 'Female', '2014-11-13', '', '', '', '', 'Single', '', '', 'Active', '', '2014-11-20', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112794, 'Felipe', 'Maria Vilma', 'S', '', 'Female', '2014-11-25', '', '', '', '', 'Single', '', '', 'Active', '', '2014-11-27', 'MA', 'ACHIEVERS', 'Adrenaline'),
(112857, 'Vice President', 'Sales', '', '', 'Male', '2015-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2015-01-01', 'VPS', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112858, 'Director', 'Sales', '', '', 'Male', '2015-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2015-01-01', 'DS', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112859, 'Presidents', 'Direct', '', '', 'Male', '2015-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2015-01-01', 'PD', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112860, 'Psmi', '', '', '', 'Male', '2015-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2015-01-01', 'PSMI', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112861, 'Victoria', 'Marie Sheane', 'Del Rosario', '', 'Male', '2015-10-29', '', '', '', '', 'Single', '', '', 'Active', '', '2015-10-29', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112862, 'Victorio', 'Amos', '', '', 'Male', '2016-02-01', '', '', '', '', 'Single', '', '', 'Active', '', '2016-02-02', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112863, 'Remax Premier', 'Real Estate Manila Inc.', '', '', 'Male', '2016-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2016-01-01', 'Remax', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112871, 'Rodriguez', 'Wendy', '', '', 'Female', '2017-06-20', '', '', '', '', 'Married', '', '', 'Active', '', '2017-06-20', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112874, 'Fonbuena', 'Pacifico', '', '', 'Male', '2017-07-24', '', '', '', '', 'Single', '', '', 'Active', '', '2017-07-26', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112875, 'Borlongan', 'Violeta', '', '', 'Female', '2017-07-31', '', '', '', '', 'Married', '', '', 'Active', '', '2017-08-01', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112880, 'Francisco', 'Angelito', '', '', 'Male', '2017-09-23', '', '', '', '', 'Single', '', '', 'Active', '', '2017-09-23', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112881, 'Gonzales', 'Verlyn', '', '', 'Female', '1992-11-20', '', '', '', '', 'Single', '', '', 'Active', '', '2017-06-28', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112883, 'Luces', 'Rei', '', '', 'Male', '2017-09-29', '', '', '', '', 'Single', '', '', 'Active', '', '2017-09-29', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112886, 'Santiago', 'Rhoda', 'B', '', 'Female', '2017-11-02', '', '', '', '', 'Single', '', '', 'Active', '', '2017-11-02', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112887, 'Cruz', 'Janine', 'B.', '', 'Female', '1917-11-03', '', '', '', '', 'Single', '', '', 'Active', '', '2017-11-03', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral');
INSERT INTO `t_agents` (`c_code`, `c_last_name`, `c_first_name`, `c_middle_initial`, `c_nick_name`, `c_sex`, `c_birthdate`, `c_birth_place`, `c_address_ln1`, `c_address_ln2`, `c_tel_no`, `c_civil_status`, `c_sss_no`, `c_tin`, `c_status`, `c_recruited_by`, `c_hire_date`, `c_position`, `c_network`, `c_division`) VALUES
(112889, 'Cajucom', 'Marygrace', '', '', 'Female', '1976-07-07', '', '', '', '', 'Married', '', '', 'Active', '', '2000-02-10', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112890, 'Dela Cruz', 'Ethelmae', '', 'Ethel', 'Female', '1979-07-12', '', '', '', '', 'Single', '33-4813223-9', '300-098-813-000', 'Active', '', '2018-01-05', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112892, 'Benedictos', 'Michael', '', '', 'Male', '1971-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2018-01-24', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112893, 'Delos Santos', 'Merlyn', 'Pangan', 'Len', 'Female', '1978-07-10', '', '', '', '', 'Single', '33-4133078-2', '219-406-636    ', 'Active', '', '2018-02-06', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112894, 'Rodil', 'Celso', '', '', 'Male', '1972-09-15', '', '', '', '', 'Single', '33-6315912-9', '916-885-715-000', 'Active', '', '2018-02-20', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112895, 'Palencia', 'Nilo', '', '', 'Male', '1960-01-22', '', '', '', '', 'Married', '03-9098049-0', '115-834-946-000', 'Active', '', '2018-02-26', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112897, 'San Pedro', 'Rosalyn', 'Bulaong', '', 'Female', '1975-07-26', '', '', '', '', 'Married', '33-2791649-2', '903-705-238-000', 'Active', '', '2018-03-02', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112898, 'De Jesus', 'Victor', '', '', 'Male', '1972-07-28', '', '', '', '', 'Married', '33-2603621-8', '226-715-145-000', 'Active', '', '2018-03-08', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112900, 'Figueroa', 'Eliza', '', '', 'Female', '1980-11-10', '', '', '', '', 'Married', '33-5884885-6', '234-599-268-000', 'Active', '', '2018-03-13', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112901, 'Saad', 'Gerry', '', '', 'Male', '1964-02-05', '', '', '', '', 'Single', '03-8768316-6', '911-503-277-000', 'Active', '', '2018-04-18', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112904, 'Castillo', 'May Kathyrine', '', '', 'Female', '1993-01-26', '', '', '', '', 'Single', '34-3997336-5', '315-397-294-000', 'Active', '', '2018-06-04', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112905, 'Borlongan', 'Violeta', '', '', 'Female', '2018-06-13', '', '', '', '', 'Single', '', '', 'Active', '', '2018-06-13', 'SM', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112906, 'Posillo', 'Ma. Lourdes', '', '', 'Female', '2018-06-20', '', '', '', '', 'Single', '', '', 'Active', '', '2018-06-20', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112907, 'Cruz', 'Teresita', 'G', '', 'Female', '2018-06-20', '', '', '', '', 'Single', '', '', 'Active', '', '2018-06-20', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112909, 'Santos', 'Zandro Lemuel', '', '', 'Male', '2018-07-23', '', '', '', '', 'Single', '', '', 'Active', '', '2018-07-23', 'DS', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112910, 'Javier', 'Sheila May', '', '', 'Female', '2018-07-27', '', '', '', '', 'Single', '', '', 'Active', '', '2018-07-27', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112912, 'Concepcion', 'Danilo', '', '', 'Male', '2018-08-02', '', '', '', '', 'Single', '', '', 'Active', '', '2018-08-02', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112913, 'Cruz Iii', 'Eusebio', '', '', 'Male', '2018-08-07', '', '', '', '', 'Single', '', '', 'Active', '', '2018-08-07', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112914, 'Sanchez', 'Liezl', 'Sg', 'Matet', 'Female', '1984-12-02', '', '', '', '', 'Single', '', '', 'Active', '', '2018-08-14', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112915, 'Reyes', 'Ma. Cecilia', 'B.', '', 'Female', '2018-09-12', '', '', '', '', 'Single', '', '', 'Active', '', '2018-09-12', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112917, 'Geronimo Jr', 'Mariano', '', '', 'Male', '2018-09-24', '', '', '', '', 'Single', '', '', 'Active', '', '2018-09-25', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112919, 'Caballero', 'Mary Jean', '', '', 'Female', '1977-10-05', '', '', '', '', 'Single', '33-2587940-5', '480-493-451-000', 'Active', '', '2018-09-28', 'SM', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112920, 'Caballero', 'Marydhelle', '', '', 'Female', '2018-08-29', '', '', '', '', 'Single', '', '', 'Active', '', '2018-10-01', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112921, 'Linaban', 'Jemelyn Kris', '', '', 'Female', '2018-10-01', '', '', '', '', 'Single', '', '', 'Active', '', '2018-10-01', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112922, 'Pabustan', 'Sharon', '', '', 'Female', '2018-10-01', '', '', '', '', 'Single', '', '', 'Active', '', '2004-05-24', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112923, 'Lopez', 'Precious Veronica', '', '', 'Female', '2018-10-22', '', '', '', '', 'Single', '', '', 'Active', '', '2018-10-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112924, 'Simbulan', 'Daisylyn', '', '', 'Female', '2018-10-22', '', '', '', '', 'Single', '', '', 'Active', '', '2018-10-22', 'SM', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112925, 'Dela Cruz', 'Jadeth', 'B', '', 'Female', '2018-11-07', '', '', '', '', 'Single', '', '', 'Active', '', '2018-11-07', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112928, 'Aguilar', 'Joy', 'P', '', 'Female', '2018-12-20', '', '', '', '', 'Single', '', '', 'Active', '', '2018-12-20', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112930, 'De Guzman', 'Richie', '', '', 'Female', '2019-01-24', '', '', '', '', 'Single', '', '', 'Active', '', '2019-01-24', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112931, 'Malta', 'Benjamin', '', '', 'Male', '2019-02-19', '', '', '', '', 'Single', '', '', 'Active', '', '2019-02-19', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112932, 'Santos', 'Rommel', 'T', '', 'Female', '2019-03-13', '', '', '', '', 'Single', '', '', 'Active', '', '2019-03-13', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112933, 'Nuque', 'Marlon', '', '', 'Male', '2019-03-13', '', '', '', '', 'Single', '', '', 'Active', '', '2019-03-13', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112934, 'Santos', 'Santiago', '', '', 'Male', '1966-12-26', '', '`', '', '', 'Single', '', '', 'Active', '', '2019-03-14', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112935, 'Lopez', 'Liezl', 'B', '', 'Female', '2019-03-28', '', '', '', '', 'Single', '', '', 'Active', '', '2019-03-28', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112936, 'Salcedo', 'Ronnie', '', '', 'Male', '2019-04-01', '', '', '', '', 'Single', '', '', 'Active', '', '2019-04-01', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112937, 'Biong', 'Aileen', 'C', '', 'Female', '2019-04-01', '', '', '', '', 'Single', '', '', 'Active', '', '2019-04-01', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112938, 'Dabon', 'Ada', 'M', '', 'Female', '2019-04-01', '', '', '', '', 'Single', '', '', 'Active', '', '2019-04-01', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112939, 'Atencio', 'Michael', 'C', '', 'Male', '2019-04-12', '', '', '', '', 'Single', '', '', 'Active', '', '2019-04-12', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112940, 'Roque', 'Raquel', 'Pascual', '', 'Female', '2019-05-07', '', '', '', '', 'Single', '', '', 'Active', '', '2019-05-08', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112941, 'Santiago', 'Jomai', '', '', 'Male', '2019-05-17', '', '', '', '', 'Single', '', '', 'Active', '', '2019-05-17', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112942, 'Salvador', 'Allan Christian', '', '', 'Male', '2019-05-30', '', '', '', '', 'Single', '', '', 'Active', '', '2019-05-30', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112943, 'Faustino', 'Teodulo', '', '', 'Male', '2019-06-07', '', '', '', '', 'Single', '', '', 'Active', '', '2019-06-07', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112944, 'Capule', 'Rose Anne', '', '', 'Female', '2019-06-07', '', '', '', '', 'Single', '', '', 'Active', '', '2019-06-07', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112945, 'Ramos', 'Reymundo', '', '', 'Male', '1971-01-01', '', '', '', '', 'Single', '', '', 'Active', '', '2019-05-01', 'SM', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112947, 'Borja', 'Dennis', '', '', 'Male', '2019-06-28', '', '', '', '', 'Single', '', '', 'Active', '', '2019-06-28', 'EMP', 'VP/DIRECTOR OF SALES', 'Employee Referral'),
(112949, 'Palomares', 'Julie', 'V.', '', 'Female', '2019-07-05', '', '', '', '', 'Single', '', '', 'Active', '', '2019-07-05', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112950, 'Amurao', 'Keemy Ann', '', '', 'Female', '2019-07-09', '', '', '', '', 'Single', '', '', 'Active', '', '2019-07-09', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112951, 'Caparas', 'Elenita', '', '', 'Female', '2019-07-09', '', '', '', '', 'Single', '', '', 'Active', '', '2019-07-09', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112952, 'Reyna', 'Evelyn', '', '', 'Female', '2019-07-10', '', '', '', '', 'Single', '', '', 'Active', '', '2019-07-11', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112953, 'Rivera, Jr.', 'Rafael', 'F', '', 'Male', '2019-07-17', '', '', '', '', 'Single', '', '', 'Active', '', '2019-07-17', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112954, 'Diamante', 'Evangeline', 'P', '', 'Female', '2019-08-28', '', '', '', '', 'Single', '', '', 'Active', '', '2019-08-29', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112955, 'Salvador', 'Michelle', 'P', '', 'Female', '2019-09-03', '', '', '', '', 'Single', '', '', 'Active', '', '2019-09-06', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112957, 'Alonzo', 'Imelda', 'D', '', 'Female', '2019-09-19', '', '', '', '', 'Single', '', '', 'Active', '', '2019-09-19', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112959, 'Casia', 'Ma. Elena', '', '', 'Female', '2019-10-29', '', '', '', '', 'Single', '', '', 'Active', '', '2019-10-29', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112960, 'Francisco', 'Menchie', 'M', '', 'Female', '2019-10-30', '', '', '', '', 'Single', '', '', 'Active', '', '2019-10-31', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112961, 'Calderon', 'Corazon', 'M', '', 'Female', '2019-11-04', '', '', '', '', 'Single', '', '', 'Active', '', '2019-11-04', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112962, 'Reyes', 'Meijie Moore', 'M', '', 'Female', '2019-11-04', '', '', '', '', 'Single', '', '', 'Active', '', '2019-11-04', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112963, 'Maranan', 'Roberto', 'Y', '', 'Male', '2019-11-14', '', '', '', '', 'Single', '', '', 'Active', '', '2019-11-14', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112964, 'Gonzales', 'Elizabeth', '', '', 'Female', '2019-11-29', '', '', '', '', 'Single', '', '', 'Active', '', '2019-11-29', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112966, 'Bernal', 'Diana', '', '', 'Female', '2019-12-17', '', '', '', '', 'Single', '', '', 'Active', '', '2019-12-17', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112967, 'Carlos', 'Leslie', 'A', '', 'Male', '2020-01-21', '', '', '', '', 'Single', '', '', 'Active', '', '2020-01-21', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112968, 'Guirhem', 'Amor', '', '', 'Female', '2020-02-05', '', '', '', '', 'Single', '', '', 'Active', '', '2020-02-11', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112969, 'Ramos', 'Paulo', 'E.', '', 'Male', '2020-06-08', '', '', '', '', 'Single', '', '', 'Active', '', '2020-06-08', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112970, 'Malto', 'Nelce', 'N', '', 'Female', '2020-06-16', '', '', '', '', 'Single', '', '', 'Active', '', '2020-06-16', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112971, 'Reyes', 'Eliza', '', '', 'Female', '2020-07-13', '', '', '', '', 'Single', '', '', 'Active', '', '2020-07-13', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112972, 'Diaz', 'B.', 'Beverly', '', 'Female', '2020-10-13', '', '', '', '', 'Single', '', '', 'Active', '', '2020-10-13', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112973, 'Gran', 'Patricia May', '', '', 'Female', '2020-10-21', '', '', '', '', 'Single', '', '', 'Active', '', '2020-10-23', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112974, 'Yamat', 'Remedios', '', '', 'Female', '2020-11-18', '', '', '', '', 'Single', '', '', 'Active', '', '2020-11-18', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112975, 'Yutuc', 'Eden', '', '', 'Male', '2020-12-02', '', '', '', '', 'Single', '', '', 'Active', '', '2020-12-02', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112976, 'Caluag', 'Careen Ivy', '', '', 'Male', '1990-02-08', '', '', '', '', 'Single', '', '', 'Active', '', '2021-01-06', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112977, 'Fulgencio', 'Jennielyn', '', '', 'Female', '2021-01-08', '', '', '', '', 'Single', '', '', 'Active', '', '2021-01-08', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112978, 'Tan', 'Katrina Keith', '', '', 'Female', '2021-01-13', '', '', '', '', 'Single', '', '', 'Active', '', '2021-01-13', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112982, 'Mendoza', 'Ryan Karlo', '', '', 'Male', '2021-04-12', '', '', '', '', 'Single', '', '', 'Active', '', '2021-04-12', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112986, 'Damo', 'Joycelyn', '', '', 'Female', '2021-06-10', '', '', '', '', 'Single', '', '', 'Active', '', '2008-02-05', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112987, 'Sison', 'Ma. Elena', '', '', 'Female', '2021-06-28', '', '', '', '', 'Single', '', '', 'Active', '', '2021-06-28', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112988, 'Caballero', 'Ferdinand', 'D', '', 'Male', '2021-07-28', '', '', '', '', 'Single', '', '', 'Active', '', '2021-07-28', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112990, 'Gregorio', 'Bernadette', '', '', 'Female', '2021-10-29', '', '', '', '', 'Single', '', '', 'Active', '', '2021-10-29', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112991, 'Reyes', 'Renante', 'D', '', 'Male', '2021-12-01', '', '', '', '', 'Single', '', '', 'Active', '', '2021-12-01', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112993, 'Tanghal', 'Rosallie', '', '', 'Female', '2022-04-01', '', '', '', '', 'Single', '', '', 'Active', '', '2022-04-01', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112994, 'Malbataan', 'Sta. Anna', 'C', '', 'Male', '2022-04-25', '', '', '', '', 'Single', '', '', 'Active', '', '2022-04-25', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112997, 'Del Rosario', 'Ria', '', 'Iyah', 'Female', '1988-12-08', '', '0029 kalye onse st dampol 1st pulilan bulacan', '', '9230200260', 'Married', '', '432-902-099-000', 'Active', '', '2022-07-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112998, 'Viterbo', 'Norelrin', '', '', 'Female', '1971-01-01', '', '', 'M0101VN3', '', 'Single', '', '', 'Active', '', '2022-08-02', 'SPC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(112999, 'Faustino', 'Aeleen', '', '', 'Female', '2022-09-22', '', '', '', '', 'Single', '', '', 'Active', '', '2022-09-22', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(113000, 'Carasig', 'Elizabeth', '', '', 'Female', '2022-09-30', '', '', '', '', 'Single', '', '', 'Active', '', '2022-09-30', 'PC', 'VP/DIRECTOR OF SALES', 'Sm/pc');

-- --------------------------------------------------------

--
-- Table structure for table `t_approval_csr`
--

CREATE TABLE `t_approval_csr` (
  `ra_id` bigint(20) NOT NULL,
  `c_csr_no` bigint(20) DEFAULT NULL,
  `c_lot_lid` int(11) NOT NULL,
  `c_csr_status` tinyint(1) DEFAULT NULL COMMENT '0 =Pending\r\n1= Approved\r\n2=Lapsed\r\n3=Cancelled',
  `c_date_approved` datetime NOT NULL DEFAULT current_timestamp(),
  `c_duration` datetime NOT NULL DEFAULT current_timestamp(),
  `c_amount_paid` double NOT NULL DEFAULT 0,
  `c_reservation_amt` double NOT NULL DEFAULT 0,
  `c_date_reserved` datetime DEFAULT NULL,
  `c_reserved_duration` datetime DEFAULT NULL,
  `c_reserve_status` tinyint(1) DEFAULT 0 COMMENT '0= Unpaid\r\n1=Paid\r\n2=Partial Paid\r\n',
  `c_ca_status` tinyint(1) DEFAULT 0 COMMENT '0=Pending,\r\n1=Approved,\r\n2=Disapproved,\r\n3= For Revision,\r\n4=Lapsed\r\n',
  `cfo_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending\r\n1 = Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_approval_csr`
--

INSERT INTO `t_approval_csr` (`ra_id`, `c_csr_no`, `c_lot_lid`, `c_csr_status`, `c_date_approved`, `c_duration`, `c_amount_paid`, `c_reservation_amt`, `c_date_reserved`, `c_reserved_duration`, `c_reserve_status`, `c_ca_status`, `cfo_status`) VALUES
(32, 284, 16203804, 1, '2024-03-26 09:42:49', '2024-03-27 09:42:49', 20000, 20000, '2024-03-26 09:45:03', '2024-04-25 09:45:03', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_av_breakdown`
--

CREATE TABLE `t_av_breakdown` (
  `av_id` int(11) NOT NULL,
  `av_no` varchar(100) DEFAULT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `or_no` varchar(30) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `rebate` decimal(10,2) DEFAULT NULL,
  `surcharge` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `principal` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `status_count` smallint(6) NOT NULL,
  `payment_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_av_breakdown`
--

INSERT INTO `t_av_breakdown` (`av_id`, `av_no`, `property_id`, `payment_amount`, `pay_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `status_count`, `payment_count`) VALUES
(143, 'AV543321', 1216203804301, 20000.00, '2024-03-26', '2024-03-26', '543223', 0.00, 0.00, 0.00, 0.00, 20000.00, 2644000.00, 'RES', 0, 1),
(144, 'AV543321', 1216203804301, 18268.50, '2024-03-26', '2024-01-31', '543211', 18268.50, 0.00, 1175.17, 0.00, 17093.33, 2626906.67, 'PD - 1', 1, 2);

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
  `lvl1` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Pending / 1 = Approved / 2 = Disapproved',
  `lvl2` int(11) NOT NULL,
  `lvl3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_av_summary`
--

INSERT INTO `t_av_summary` (`av_id`, `property_id`, `c_av_no`, `c_av_date`, `c_av_amount`, `c_surcharge`, `c_principal`, `c_interest`, `c_rebate`, `c_deductions`, `c_remarks`, `c_av_type`, `lvl1`, `lvl2`, `lvl3`) VALUES
(52, '1216203804301', 'AV543321', '2024-03-26', 34593.33, 1175.17, 37093.33, 0, 0, 2500, 'TEST', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_buyer_info`
--

CREATE TABLE `t_buyer_info` (
  `id` int(11) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `c_created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_buyer_info`
--

INSERT INTO `t_buyer_info` (`id`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `email`, `contact_no`, `c_created_by`) VALUES
(48, 'Flores', 'Spouses Prince William', 'MOSQUEDA', '', '0156 DAANG BAKA 1, MAYSANTOL', '3017', '', '1993-03-13', 31, '09190934956', 'M', 'Married', 'Filipino', 'ivymaemae@gmail.com', '09190934956', '10093');

-- --------------------------------------------------------

--
-- Table structure for table `t_ca_requirement`
--

CREATE TABLE `t_ca_requirement` (
  `id` int(11) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `loan_amt` double NOT NULL,
  `terms` int(11) NOT NULL DEFAULT 0,
  `gross_income` double NOT NULL DEFAULT 0,
  `co_borrower` double NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `income_req` double NOT NULL DEFAULT 0,
  `interest` double NOT NULL DEFAULT 0,
  `terms_month` int(11) NOT NULL DEFAULT 0,
  `monthly` double NOT NULL,
  `doc_req1` tinyint(4) NOT NULL DEFAULT 0,
  `doc_req2` tinyint(4) NOT NULL DEFAULT 0,
  `doc_req3` tinyint(4) NOT NULL DEFAULT 0,
  `ver_doc1` tinyint(4) NOT NULL DEFAULT 0,
  `ver_doc2` tinyint(4) NOT NULL DEFAULT 0,
  `doc_req_remarks` varchar(100) DEFAULT NULL,
  `ver_doc_remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_credit_memo`
--

CREATE TABLE `t_credit_memo` (
  `cm_id` int(11) NOT NULL,
  `cm_date` date NOT NULL,
  `credit_amount` float NOT NULL,
  `reason` text NOT NULL,
  `reference` text NOT NULL,
  `lvl1` int(11) NOT NULL,
  `lvl2` int(11) NOT NULL,
  `lvl3` int(11) NOT NULL,
  `memo_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_csr`
--

CREATE TABLE `t_csr` (
  `c_csr_no` bigint(20) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `c_lot_lid` int(11) NOT NULL,
  `c_type` tinyint(2) NOT NULL COMMENT '1= Lot Only\r\n2= House Only\r\n3= Packaged\r\n4=Fence/Others',
  `c_date_of_sale` date DEFAULT current_timestamp(),
  `c_lot_area` double DEFAULT NULL,
  `c_price_sqm` double DEFAULT NULL,
  `c_lot_discount` double DEFAULT NULL,
  `c_lot_discount_amt` double DEFAULT NULL,
  `c_house_model` varchar(100) DEFAULT NULL,
  `c_floor_area` double DEFAULT NULL,
  `c_house_price_sqm` double DEFAULT NULL,
  `c_linear` float DEFAULT NULL,
  `c_fence_price_sqm` float DEFAULT NULL,
  `c_processing_fee` float DEFAULT NULL,
  `c_less` float DEFAULT NULL,
  `pf_mo` float DEFAULT NULL,
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
  `c_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `c_date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `c_created_by` text NOT NULL,
  `c_verify` tinyint(1) DEFAULT 0 COMMENT '0 = Pending\r\n1= Verified \r\n2= Void',
  `coo_approval` tinyint(1) DEFAULT 0 COMMENT '0= Pending\r\n1= Approved\r\n2= Lapsed\r\n3= Cancelled\r\n4= Disapproved',
  `c_revised` tinyint(1) DEFAULT 0 COMMENT '0 = Normal\r\n1 = For Revision\r\n2 = Adjustment',
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive,\r\n1 = Active',
  `old_property_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_csr`
--

INSERT INTO `t_csr` (`c_csr_no`, `ref_no`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_linear`, `c_fence_price_sqm`, `c_processing_fee`, `c_less`, `pf_mo`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_remarks`, `c_date_created`, `c_date_updated`, `c_created_by`, `c_verify`, `coo_approval`, `c_revised`, `c_active`, `old_property_id`) VALUES
(284, '5060833502\n', 16203804, 3, '2024-03-26', 72, 7000, 0, 0, 'ANNIKA', 40, 54000, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 2664000, 0, 2664000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 512800, 30, 17093.33, '2024-01-31', '2026-07-01', 2131200, 120, 16, 0.01675131, 35700.4, '2026-07-31', '1. WITH RA#13620 WITH APPROVAL OF PBM DTD. 12/18/23', '2024-03-26 09:03:35', '2024-03-26 09:42:49', '10093', 1, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_csr_buyers`
--

CREATE TABLE `t_csr_buyers` (
  `buyer_id` int(11) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
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
  `relationship` tinyint(4) DEFAULT NULL COMMENT '0= None\r\n1= And\r\n2= Spouses\r\n3= Married To\r\n4=Minor/Represented by Legal Guardian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_csr_buyers`
--

INSERT INTO `t_csr_buyers` (`buyer_id`, `c_csr_no`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`) VALUES
(355, 284, 1, 'Flores', 'Spouses Prince William', 'MOSQUEDA', '', '0156 DAANG BAKA 1, MAYSANTOL', '3017', ' ', '1993-03-13', 31, '09190934956 ', 'M', 'Single', 'Filipino', '', '', 'ivymaemae@gmail.com', '09190934956', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_csr_comments`
--

CREATE TABLE `t_csr_comments` (
  `comment_id` int(11) NOT NULL,
  `c_csr_no` text NOT NULL,
  `name` text NOT NULL,
  `comment` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `reply_of` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_csr_commission`
--

CREATE TABLE `t_csr_commission` (
  `comm_id` int(11) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `c_code` bigint(20) NOT NULL,
  `c_position` text NOT NULL,
  `c_agent` text NOT NULL,
  `c_amount` double NOT NULL,
  `c_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_csr_commission`
--

INSERT INTO `t_csr_commission` (`comm_id`, `c_csr_no`, `c_code`, `c_position`, `c_agent`, `c_amount`, `c_rate`) VALUES
(360, 284, 110297, ' SM ', 'Ordinario , Mary Grace ', 53280, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `t_csr_view`
-- (See below for the actual view)
--
CREATE TABLE `t_csr_view` (
`c_acronym` text
,`c_block` smallint(6)
,`c_lot` smallint(6)
,`last_name` varchar(255)
,`first_name` varchar(255)
,`middle_name` varchar(255)
,`suffix_name` varchar(255)
,`c_csr_no` bigint(20)
,`ref_no` varchar(100)
,`c_lot_lid` int(11)
,`c_type` tinyint(2)
,`c_date_of_sale` date
,`c_lot_area` double
,`c_price_sqm` double
,`c_lot_discount` double
,`c_lot_discount_amt` double
,`c_house_model` varchar(100)
,`c_floor_area` double
,`c_house_price_sqm` double
,`c_linear` float
,`c_fence_price_sqm` float
,`c_processing_fee` float
,`c_less` float
,`pf_mo` float
,`c_house_discount` double
,`c_house_discount_amt` double
,`c_tcp_discount` double
,`c_tcp_discount_amt` double
,`c_tcp` double
,`c_vat_amount` double
,`c_net_tcp` double
,`c_reservation` double
,`c_payment_type1` text
,`c_payment_type2` text
,`c_down_percent` double
,`c_net_dp` double
,`c_no_payments` int(11)
,`c_monthly_down` double
,`c_first_dp` date
,`c_full_down` date
,`c_amt_financed` double
,`c_terms` int(11)
,`c_interest_rate` double
,`c_fixed_factor` double
,`c_monthly_payment` double
,`c_start_date` date
,`c_remarks` text
,`c_date_created` datetime
,`c_date_updated` datetime
,`c_created_by` text
,`c_verify` tinyint(1)
,`coo_approval` tinyint(1)
,`c_revised` tinyint(1)
,`c_active` tinyint(1)
,`old_property_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `t_division`
--

CREATE TABLE `t_division` (
  `c_code` int(11) NOT NULL,
  `c_division` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_division`
--

INSERT INTO `t_division` (`c_code`, `c_division`) VALUES
(0, 'c_division'),
(1, 'Achievers - Direct'),
(1, 'Amazing'),
(1, 'Blue Lane 1'),
(1, 'Faith'),
(1, 'Acts'),
(1, 'Awesome'),
(1, 'Adrenaline'),
(2, 'Admiral-direct'),
(2, 'Baguettes'),
(2, 'Abundance'),
(3, 'Baguettes'),
(3, 'Excellent'),
(3, 'Altitude - Direct'),
(3, 'Magnificent'),
(3, 'Excel'),
(3, 'Celestial'),
(3, 'Fortune'),
(3, 'Admiral'),
(3, 'Governors'),
(4, 'Alpha'),
(4, 'Astra'),
(4, 'Atlas'),
(4, 'Absolute'),
(4, 'Anthurium - Direct'),
(4, 'Altruist'),
(4, 'Advent'),
(4, 'Aquarius'),
(5, 'Peak'),
(5, 'Fortitude'),
(5, 'Phoenix'),
(5, 'Bromeliads - Direct'),
(6, 'Prince'),
(6, 'Crown'),
(6, 'Prestige 1'),
(6, 'Prime'),
(6, 'Calypso - Direct'),
(6, 'Phenomenal'),
(6, 'Optimist'),
(6, 'Power'),
(7, 'Apex'),
(7, 'Brilliant'),
(7, 'Dynamic'),
(7, 'Genesis'),
(7, 'Paramount'),
(7, 'Elegance'),
(7, 'Cattleya - Direct'),
(7, 'Abba'),
(7, 'Grandslam'),
(7, 'Victorious'),
(7, 'Surmount'),
(7, 'Champion'),
(7, 'Benevolent'),
(8, 'Majesty'),
(8, 'Cherry Blossom - Direct'),
(8, 'Miracle'),
(8, 'Angels'),
(8, 'Righteous'),
(9, 'Pyramid'),
(9, 'Saviour'),
(9, 'Sun'),
(9, 'Lucky Charms'),
(9, 'Christop - Direct'),
(9, 'Green Peridot'),
(10, 'Achievers'),
(10, 'Blue Lane 1'),
(10, 'Chronicles - Direct'),
(10, 'Faith'),
(10, 'Amazing'),
(11, 'Gold'),
(11, 'Chrysanthemum - Direct'),
(11, 'Titanium'),
(12, 'Lighthouse'),
(12, 'Olympus'),
(12, 'Cornerstone - Direct'),
(12, 'Infinity'),
(13, 'Ingenious'),
(14, 'Crown-direct'),
(14, 'Empress'),
(14, 'Duchess'),
(15, 'Diamond - Direct'),
(15, 'Jabez'),
(15, 'Edifice'),
(15, 'Pearl'),
(16, 'Eagle-direct'),
(17, 'Obsidian'),
(17, 'Felsite-direct'),
(18, 'Gem-direct'),
(18, 'Heart'),
(18, 'Mahogany'),
(18, 'Topstar'),
(19, 'Emmanuel'),
(19, 'Pinnacle'),
(19, 'Virgo'),
(19, 'Aspen'),
(19, 'Gladiolus-direct'),
(19, 'Crest'),
(19, 'Taurus'),
(20, 'Gold'),
(20, 'Champion'),
(20, 'Grandslam-direct'),
(20, 'Abba'),
(20, 'Titanium'),
(20, 'Admiral'),
(20, 'Governors'),
(20, 'Magnificent'),
(20, 'Baguettes'),
(21, 'Felsite'),
(21, 'Granite 1'),
(21, 'Igneous'),
(21, 'Iris'),
(21, 'Hyacinth - Direct'),
(21, 'Waterlily'),
(21, 'Love'),
(21, 'Obsidian'),
(21, 'Chrysoprase'),
(22, 'Igneous - Direct'),
(22, 'Ebenezer'),
(22, 'Rubellite'),
(22, 'Stibnite'),
(23, 'Citrine'),
(23, 'Crusader'),
(23, 'Lifestream'),
(23, 'Marigold'),
(23, 'Tanzanite'),
(23, 'Treasure'),
(23, 'Jasmine - Direct'),
(23, 'Rainbow'),
(23, 'Horizon'),
(23, 'Sunbeam'),
(23, 'Shalom'),
(23, 'Aster'),
(23, 'Hollyhocks'),
(24, 'Crest'),
(24, 'Zenith'),
(24, 'Aspen'),
(24, 'Vertex'),
(24, 'Lotus - Direct'),
(24, 'Virgo'),
(24, 'Geranium'),
(24, 'Yellow Bell'),
(24, 'Pinnacle'),
(24, 'Gladiolus'),
(24, 'Emmanuel'),
(25, 'Pioneer'),
(25, 'Provident'),
(25, 'Paragon'),
(25, 'Predominant'),
(25, 'Magnolia - Direct'),
(25, 'Phyre'),
(25, 'Pine'),
(25, 'Prime'),
(25, 'Path Finder'),
(26, 'Righteous'),
(26, 'Clarion'),
(26, 'Majesty-direct'),
(26, 'Miracle'),
(26, 'Angels'),
(27, 'Felsite'),
(28, 'Blazing Star'),
(28, 'Aster'),
(28, 'Marigold-direct'),
(29, 'Jasper'),
(29, 'Gemini'),
(29, 'Magnolia'),
(29, 'Lotus'),
(29, 'Carnelian'),
(29, 'Everlasting'),
(29, 'Granite'),
(29, 'Cattleya'),
(29, 'Emerald'),
(29, 'Opal'),
(29, 'Silver'),
(29, 'Amethyst'),
(29, 'Sapphire'),
(29, 'Galaxy'),
(29, 'Alexandrite'),
(29, 'Blue Star'),
(29, 'Uranium'),
(29, 'Zircon'),
(29, 'Garnet'),
(29, 'Ivory'),
(29, 'Platinum'),
(29, 'Rose'),
(29, 'Bluestar'),
(29, 'Onyx'),
(29, 'Crystal'),
(29, 'Adamantine'),
(29, 'House Account'),
(29, 'Adventurer'),
(29, 'Amethyst-direct'),
(29, 'Pearl'),
(29, 'Topaz'),
(29, 'Rosequartz'),
(29, 'Jade'),
(29, 'Galaxy 16'),
(29, 'Zirconuim'),
(29, 'Morning Glory'),
(29, 'Sunflower'),
(29, 'Cetrine Quartz'),
(29, 'Opal Quartz'),
(29, 'Rock Quartz'),
(29, 'Chrystaline Quartz'),
(29, 'Citrine Quartz'),
(29, 'Turquoise'),
(29, 'Mercury'),
(29, 'Jet'),
(29, 'Jewels'),
(29, 'Broker'),
(29, 'Prestige'),
(29, 'Prestige I'),
(29, 'Jam Asia'),
(29, 'Golden Lion'),
(29, 'Chalcedony Quartz'),
(29, 'Sardonyx Quartz'),
(29, 'Moonstone'),
(29, 'Ruby Quartz'),
(29, 'Beryl'),
(29, 'Jasper Ii'),
(29, 'Silver I'),
(29, 'Sigya'),
(29, 'Amethyst I'),
(29, 'Mega'),
(29, 'White Stone'),
(29, 'Golden Eagle'),
(29, 'Pisces'),
(29, 'D Exponent'),
(29, 'Logistics'),
(29, 'Carnation'),
(29, 'West Avenue Network'),
(29, 'Task Force'),
(29, 'D Exponent I'),
(29, 'Cmo-direct Group'),
(29, 'Eagles International'),
(29, 'Magnificent'),
(29, 'Broker Intl I'),
(29, 'Antorium'),
(29, 'Broker-fareast'),
(29, 'Aquarius'),
(29, 'Broker Int. Ii'),
(29, 'Concordia Garcia'),
(29, 'Int. Operation'),
(29, 'Broker Int.'),
(29, 'House Accounts'),
(29, 'Copper'),
(29, 'Gold-2'),
(29, 'Diamond-2'),
(29, 'Aster'),
(29, 'Rockquartz'),
(29, 'Milestone'),
(29, 'Manila Group'),
(29, 'Bulacan Group'),
(29, 'Broker Int.-direct'),
(30, 'Altarose'),
(30, 'Ascend'),
(30, 'Gem'),
(30, 'Summit'),
(30, 'Pampanga - Direct'),
(30, 'Magnificat'),
(30, 'Marvelous'),
(30, 'Oasis'),
(30, 'Everest'),
(30, 'Juggernaut'),
(31, 'Precious - Direct'),
(31, 'Prominent'),
(31, 'Benevolent'),
(32, 'Power'),
(32, 'Prestige-direct'),
(32, 'Creative'),
(32, 'Strong'),
(32, 'Ingenious'),
(32, 'Innovative'),
(33, 'Prince- Direct'),
(33, 'Elite'),
(33, 'Royal'),
(33, 'Sunrise'),
(34, 'Marketing'),
(35, 'Reb'),
(36, 'Sampaguita'),
(36, 'Skyscraper'),
(36, 'Starlight'),
(36, 'Stargazer - Direct'),
(36, 'Gardenia'),
(36, 'Shamrock'),
(36, 'Smilax'),
(37, 'Atlas'),
(37, 'Advent'),
(37, 'Aquarius'),
(37, 'Gem'),
(37, 'Altarose'),
(37, 'Oasis'),
(37, 'The New Anthurium- Direct'),
(38, 'Treasure-direct'),
(38, 'Horizon'),
(38, 'Sunbeam'),
(38, 'Citrine'),
(38, 'Shalom'),
(38, 'Sun'),
(38, 'Green Peridot'),
(39, 'Sm/pc'),
(39, 'Employee Referral');

-- --------------------------------------------------------

--
-- Table structure for table `t_house`
--

CREATE TABLE `t_house` (
  `c_house_lid` int(11) NOT NULL,
  `c_site` smallint(6) NOT NULL,
  `c_block` smallint(6) NOT NULL,
  `c_lot` smallint(6) NOT NULL,
  `c_house_model` text NOT NULL,
  `c_floor_area` double NOT NULL,
  `c_h_price_sqm` double NOT NULL,
  `c_remarks` text NOT NULL,
  `c_status` text NOT NULL,
  `c_unit_status` text NOT NULL,
  `c_count` smallint(6) NOT NULL,
  `c_house_type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_house`
--

INSERT INTO `t_house` (`c_house_lid`, `c_site`, `c_block`, `c_lot`, `c_house_model`, `c_floor_area`, `c_h_price_sqm`, `c_remarks`, `c_status`, `c_unit_status`, `c_count`, `c_house_type`) VALUES
(105040112, 105, 4, 1, 'Nathalia', 50, 10000, 'New House Model', 'Available', 'For Construction', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice`
--

CREATE TABLE `t_invoice` (
  `invoice_id` int(11) NOT NULL,
  `property_id` bigint(20) DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `or_no` varchar(30) DEFAULT NULL,
  `amount_due` decimal(10,2) DEFAULT NULL,
  `rebate` decimal(10,2) DEFAULT NULL,
  `surcharge` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `principal` decimal(10,2) DEFAULT NULL,
  `remaining_balance` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `status_count` smallint(6) NOT NULL,
  `payment_count` int(11) DEFAULT NULL,
  `excess` double NOT NULL,
  `account_status` varchar(100) NOT NULL,
  `trans_date` date DEFAULT NULL,
  `surcharge_percent` int(11) NOT NULL,
  `gen_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_invoice`
--

INSERT INTO `t_invoice` (`invoice_id`, `property_id`, `payment_amount`, `pay_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `status_count`, `payment_count`, `excess`, `account_status`, `trans_date`, `surcharge_percent`, `gen_time`) VALUES
(17, 1214500401101, 440800.00, '2024-01-04', '2024-02-04', '41414', 440800.00, 0.00, 0.00, 0.00, 440800.00, 0.00, 'FPD', 0, 2, -1, 'Fully Paid', '2024-01-04', 0, '2024-03-25 14:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `t_lots`
--

CREATE TABLE `t_lots` (
  `c_lid` int(11) NOT NULL,
  `c_house_lid` int(11) DEFAULT NULL,
  `c_site` smallint(6) DEFAULT NULL,
  `c_block` smallint(6) DEFAULT NULL,
  `c_lot` smallint(6) DEFAULT NULL,
  `c_lot_area` decimal(10,0) DEFAULT NULL,
  `c_price_sqm` double DEFAULT NULL,
  `c_remarks` text DEFAULT NULL,
  `c_status` varchar(255) DEFAULT NULL,
  `c_lot_type` varchar(255) DEFAULT NULL,
  `c_title` varchar(255) DEFAULT NULL,
  `c_lot_type_remarks` varchar(255) DEFAULT NULL,
  `c_title_owner` varchar(255) DEFAULT NULL,
  `c_previous_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_lots`
--

INSERT INTO `t_lots` (`c_lid`, `c_house_lid`, `c_site`, `c_block`, `c_lot`, `c_lot_area`, `c_price_sqm`, `c_remarks`, `c_status`, `c_lot_type`, `c_title`, `c_lot_type_remarks`, `c_title_owner`, `c_previous_owner`) VALUES
(10100931, NULL, 101, 9, 31, 104, 10764.85, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(10300901, NULL, 103, 9, 1, 142, 2880, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(10902916, NULL, 109, 29, 16, 63, 10800, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(13001901, NULL, 130, 19, 1, 81, 34135.8, '1213', 'Available', NULL, NULL, NULL, NULL, NULL),
(13700202, NULL, 137, 2, 2, 100, 9500, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(14500323, NULL, 145, 3, 23, 76, 4700, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500401, NULL, 145, 4, 1, 96, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500402, NULL, 145, 4, 2, 93, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500403, NULL, 145, 4, 3, 72, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500404, NULL, 145, 4, 4, 72, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500405, NULL, 145, 4, 5, 76, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500407, NULL, 145, 4, 7, 69, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500408, NULL, 145, 4, 8, 72, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500410, NULL, 145, 4, 10, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500411, NULL, 145, 4, 11, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500413, NULL, 145, 4, 13, 112, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500414, NULL, 145, 4, 14, 117, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500501, NULL, 145, 5, 1, 87, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500502, NULL, 145, 5, 2, 84, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500503, NULL, 145, 5, 3, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500504, NULL, 145, 5, 4, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500505, NULL, 145, 5, 5, 87, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500506, NULL, 145, 5, 6, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500507, NULL, 145, 5, 7, 81, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500509, NULL, 145, 5, 9, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500510, NULL, 145, 5, 10, 84, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500511, NULL, 145, 5, 11, 72, 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500513, NULL, 145, 5, 13, 91, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500514, NULL, 145, 5, 14, 96, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500602, NULL, 145, 6, 2, 99, 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14502111, NULL, 145, 21, 11, 72, 7500, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(15102707, NULL, 151, 27, 7, 96, 9000, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(15200202, NULL, 152, 2, 2, 149, 6800, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(16203804, NULL, 162, 38, 4, 72, 7000, '', 'Sold', NULL, NULL, NULL, NULL, NULL),
(169123123, NULL, 169, 123, 123, 123, 123, '123', 'Available', NULL, NULL, NULL, NULL, NULL),
(2147483647, NULL, 169, 4444, 4444, 4444, 4444, '4444', 'Available', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_model_house`
--

CREATE TABLE `t_model_house` (
  `id` int(11) NOT NULL,
  `c_code` int(11) NOT NULL,
  `c_model` text NOT NULL,
  `c_acronym` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_model_house`
--

INSERT INTO `t_model_house` (`id`, `c_code`, `c_model`, `c_acronym`) VALUES
(1, 100, 'NATHALIA', 'NAT'),
(2, 101, 'ANNIKA', 'ANK'),
(3, 102, 'SASHA', 'SAS'),
(4, 104, 'FENCE', 'FNC'),
(5, 105, 'FREYA', 'FRY'),
(6, 144, 'SAMPLE MODELS', 'SMS'),
(7, 988, 'ZINNIA', 'ZNA');

-- --------------------------------------------------------

--
-- Table structure for table `t_network`
--

CREATE TABLE `t_network` (
  `c_code` int(11) NOT NULL,
  `c_network` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_network`
--

INSERT INTO `t_network` (`c_code`, `c_network`) VALUES
(1, 'ACHIEVERS'),
(2, 'ADMIRAL'),
(3, 'ALTITUDE'),
(4, 'ANTHURIUM'),
(5, 'BROMELIADS'),
(6, 'CALYPSO'),
(7, 'CATTLEYA'),
(8, 'CHERRY BLOSSOM'),
(9, 'CHRISTOP'),
(10, 'CHRONICLES'),
(11, 'CHRYSANTHEMUM'),
(12, 'CORNERSTONE'),
(13, 'CREATIVE'),
(14, 'CROWN'),
(15, 'DIAMOND'),
(16, 'EAGLE'),
(17, 'FELSITE'),
(18, 'GEM'),
(19, 'GLADIOLUS'),
(20, 'GRANDSLAM'),
(21, 'HYACINTH'),
(22, 'IGNEOUS'),
(23, 'JASMINE'),
(24, 'LOTUS'),
(25, 'MAGNOLIA'),
(26, 'MAJESTY'),
(27, 'MANILA GROUP'),
(28, 'MARIGOLD'),
(29, 'OTHERS'),
(30, 'PAMPANGA'),
(31, 'PRECIOUS'),
(32, 'PRESTIGE 1'),
(33, 'PRINCE'),
(34, 'PSMI'),
(35, 'RE/MAX PREMIERE INC.'),
(36, 'STARGAZER'),
(37, 'THE NEW ANTHURIUM'),
(38, 'TREASURE'),
(39, 'VP/DIRECTOR OF SALES');

-- --------------------------------------------------------

--
-- Table structure for table `t_network_division`
--

CREATE TABLE `t_network_division` (
  `c_code` int(11) NOT NULL,
  `c_network` text NOT NULL,
  `c_division` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_network_division`
--

INSERT INTO `t_network_division` (`c_code`, `c_network`, `c_division`) VALUES
(1, 'CATTLEYA', 'Apex'),
(3, 'CATTLEYA', 'Brilliant'),
(5, 'CATTLEYA', 'Dynamic'),
(7, 'CATTLEYA', 'Genesis'),
(8, 'CATTLEYA', 'Paramount'),
(9, 'ALTITUDE', 'Baguettes'),
(10, 'ALTITUDE', 'Excellent'),
(12, 'ANTHURIUM', 'Alpha'),
(13, 'ANTHURIUM', 'Astra'),
(14, 'ANTHURIUM', 'Atlas'),
(15, 'CALYPSO', 'Prince'),
(16, 'CALYPSO', 'Crown'),
(17, 'CALYPSO', 'Prestige 1'),
(18, 'CALYPSO', 'Prime'),
(20, 'CHERRY BLOSSOM', 'Majesty'),
(22, 'CHRISTOP', 'Pyramid'),
(23, 'CHRISTOP', 'Saviour'),
(24, 'CHRISTOP', 'Sun'),
(25, 'CHRYSANTHEMUM', 'Gold'),
(26, 'CORNERSTONE', 'Lighthouse'),
(27, 'CORNERSTONE', 'Olympus'),
(28, 'HYACINTH', 'Felsite'),
(29, 'HYACINTH', 'Granite 1'),
(30, 'HYACINTH', 'Igneous'),
(31, 'JASMINE', 'Citrine'),
(32, 'JASMINE', 'Crusader'),
(33, 'JASMINE', 'Lifestream'),
(35, 'JASMINE', 'Marigold'),
(37, 'JASMINE', 'Tanzanite'),
(38, 'LOTUS', 'Crest'),
(43, 'LOTUS', 'Zenith'),
(44, 'MAGNOLIA', 'Pioneer'),
(47, 'MAGNOLIA', 'Provident'),
(48, 'PAMPANGA', 'Altarose'),
(49, 'PAMPANGA', 'Ascend'),
(50, 'PAMPANGA', 'Gem'),
(52, 'PAMPANGA', 'Summit'),
(53, 'STARGAZER', 'Sampaguita'),
(54, 'STARGAZER', 'Skyscraper'),
(55, 'STARGAZER', 'Starlight'),
(56, 'ANTHURIUM', 'Absolute'),
(57, 'ALTITUDE', 'Altitude - Direct'),
(58, 'ANTHURIUM', 'Anthurium - Direct'),
(59, 'ANTHURIUM', 'Altruist'),
(60, 'CALYPSO', 'Calypso - Direct'),
(61, 'CATTLEYA', 'Elegance'),
(62, 'CATTLEYA', 'Cattleya - Direct'),
(63, 'CHRISTOP', 'Lucky Charms'),
(64, 'HYACINTH', 'Iris'),
(65, 'JASMINE', 'Treasure'),
(66, 'CHERRY BLOSSOM', 'Cherry Blossom - Direct'),
(67, 'CHRISTOP', 'Christop - Direct'),
(68, 'CHRYSANTHEMUM', 'Chrysanthemum - Direct'),
(69, 'CORNERSTONE', 'Cornerstone - Direct'),
(70, 'HYACINTH', 'Hyacinth - Direct'),
(71, 'JASMINE', 'Jasmine - Direct'),
(72, 'LOTUS', 'Aspen'),
(74, 'LOTUS', 'Vertex'),
(75, 'LOTUS', 'Lotus - Direct'),
(76, 'MAGNOLIA', 'Paragon'),
(77, 'MAGNOLIA', 'Predominant'),
(78, 'MAGNOLIA', 'Magnolia - Direct'),
(79, 'PAMPANGA', 'Pampanga - Direct'),
(80, 'STARGAZER', 'Stargazer - Direct'),
(81, 'OTHERS', 'Jasper'),
(82, 'OTHERS', 'Gemini'),
(83, 'OTHERS', 'Magnolia'),
(84, 'OTHERS', 'Lotus'),
(85, 'OTHERS', 'Carnelian'),
(86, 'OTHERS', 'Everlasting'),
(87, 'OTHERS', 'Granite'),
(88, 'OTHERS', 'Cattleya'),
(89, 'OTHERS', 'Emerald'),
(90, 'OTHERS', 'Opal'),
(91, 'OTHERS', 'Silver'),
(92, 'OTHERS', 'Amethyst'),
(93, 'OTHERS', 'Sapphire'),
(94, 'OTHERS', 'Galaxy'),
(95, 'OTHERS', 'Alexandrite'),
(96, 'OTHERS', 'Blue Star'),
(97, 'OTHERS', 'Uranium'),
(98, 'OTHERS', 'Zircon'),
(99, 'OTHERS', 'Garnet'),
(100, 'OTHERS', 'Ivory'),
(101, 'OTHERS', 'Platinum'),
(102, 'OTHERS', 'Rose'),
(103, 'OTHERS', 'Bluestar'),
(104, 'OTHERS', 'Onyx'),
(105, 'OTHERS', 'Crystal'),
(106, 'OTHERS', 'Adamantine'),
(107, 'OTHERS', 'House Account'),
(108, 'OTHERS', 'Adventurer'),
(109, 'OTHERS', 'Amethyst-direct'),
(110, 'OTHERS', 'Pearl'),
(111, 'OTHERS', 'Topaz'),
(112, 'OTHERS', 'Rosequartz'),
(113, 'OTHERS', 'Jade'),
(114, 'OTHERS', 'Galaxy 16'),
(115, 'OTHERS', 'Zirconuim'),
(116, 'OTHERS', 'Morning Glory'),
(117, 'OTHERS', 'Sunflower'),
(118, 'OTHERS', 'Cetrine Quartz'),
(119, 'OTHERS', 'Opal Quartz'),
(120, 'OTHERS', 'Rock Quartz'),
(121, 'OTHERS', 'Chrystaline Quartz'),
(122, 'OTHERS', 'Citrine Quartz'),
(123, 'OTHERS', 'Turquoise'),
(124, 'OTHERS', 'Mercury'),
(125, 'OTHERS', 'Jet'),
(126, 'OTHERS', 'Jewels'),
(127, 'OTHERS', 'Broker'),
(128, 'OTHERS', 'Prestige'),
(129, 'OTHERS', 'Prestige I'),
(130, 'OTHERS', 'Jam Asia'),
(131, 'OTHERS', 'Golden Lion'),
(132, 'OTHERS', 'Chalcedony Quartz'),
(133, 'OTHERS', 'Sardonyx Quartz'),
(134, 'OTHERS', 'Moonstone'),
(135, 'OTHERS', 'Ruby Quartz'),
(136, 'OTHERS', 'Beryl'),
(137, 'OTHERS', 'Jasper Ii'),
(138, 'OTHERS', 'Silver I'),
(139, 'OTHERS', 'Sigya'),
(140, 'OTHERS', 'Amethyst I'),
(141, 'OTHERS', 'Mega'),
(142, 'OTHERS', 'White Stone'),
(143, 'OTHERS', 'Golden Eagle'),
(144, 'OTHERS', 'Pisces'),
(145, 'OTHERS', 'D Exponent'),
(146, 'OTHERS', 'Logistics'),
(147, 'OTHERS', 'Carnation'),
(148, 'OTHERS', 'West Avenue Network'),
(149, 'OTHERS', 'Task Force'),
(150, 'OTHERS', 'D Exponent I'),
(151, 'OTHERS', 'Cmo-direct Group'),
(152, 'OTHERS', 'Eagles International'),
(153, 'OTHERS', 'Magnificent'),
(154, 'OTHERS', 'Broker Intl I'),
(155, 'OTHERS', 'Antorium'),
(156, 'OTHERS', 'Broker-fareast'),
(157, 'OTHERS', 'Aquarius'),
(158, 'OTHERS', 'Broker Int. Ii'),
(159, 'OTHERS', 'Concordia Garcia'),
(160, 'OTHERS', 'Int. Operation'),
(161, 'OTHERS', 'Broker Int.'),
(162, 'OTHERS', 'House Accounts'),
(163, 'OTHERS', 'Copper'),
(164, 'OTHERS', 'Gold-2'),
(165, 'OTHERS', 'Diamond-2'),
(166, 'OTHERS', 'Aster'),
(167, 'OTHERS', 'Rockquartz'),
(168, 'OTHERS', 'Milestone'),
(169, 'ALTITUDE', 'Magnificent'),
(170, 'ALTITUDE', 'Excel'),
(171, 'ANTHURIUM', 'Advent'),
(173, 'CATTLEYA', 'Abba'),
(174, 'CATTLEYA', 'Grandslam'),
(175, 'CATTLEYA', 'Victorious'),
(176, 'CHRYSANTHEMUM', 'Titanium'),
(177, 'HYACINTH', 'Waterlily'),
(178, 'JASMINE', 'Rainbow'),
(179, 'JASMINE', 'Horizon'),
(180, 'JASMINE', 'Sunbeam'),
(183, 'STARGAZER', 'Gardenia'),
(184, 'CHRONICLES', 'Achievers'),
(185, 'CHRONICLES', 'Blue Lane 1'),
(186, 'BROMELIADS', 'Peak'),
(187, 'BROMELIADS', 'Fortitude'),
(188, 'BROMELIADS', 'Phoenix'),
(189, 'BROMELIADS', 'Bromeliads - Direct'),
(190, 'CHRONICLES', 'Chronicles - Direct'),
(191, 'CALYPSO', 'Phenomenal'),
(192, 'PAMPANGA', 'Magnificat'),
(193, 'CATTLEYA', 'Surmount'),
(194, 'ALTITUDE', 'Celestial'),
(195, 'ALTITUDE', 'Fortune'),
(196, 'CHRISTOP', 'Green Peridot'),
(198, 'LOTUS', 'Virgo'),
(199, 'OTHERS', 'Manila Group'),
(200, 'OTHERS', 'Bulacan Group'),
(201, 'CHERRY BLOSSOM', 'Miracle'),
(202, 'PAMPANGA', 'Marvelous'),
(206, 'PAMPANGA', 'Oasis'),
(207, 'CALYPSO', 'Optimist'),
(208, 'PRECIOUS', 'Precious - Direct'),
(209, 'PRECIOUS', 'Prominent'),
(210, 'DIAMOND', 'Diamond - Direct'),
(211, 'DIAMOND', 'Jabez'),
(212, 'PRECIOUS', 'Benevolent'),
(213, 'CHRONICLES', 'Faith'),
(214, 'ALTITUDE', 'Admiral'),
(215, 'DIAMOND', 'Edifice'),
(216, 'LOTUS', 'Geranium'),
(217, 'CHERRY BLOSSOM', 'Angels'),
(218, 'ALTITUDE', 'Governors'),
(219, 'PAMPANGA', 'Everest'),
(220, 'DIAMOND', 'Pearl'),
(221, 'LOTUS', 'Yellow Bell'),
(222, 'PAMPANGA', 'Juggernaut'),
(223, 'CORNERSTONE', 'Infinity'),
(224, 'LOTUS', 'Pinnacle'),
(225, 'JASMINE', 'Shalom'),
(226, 'CATTLEYA', 'Champion'),
(227, 'OTHERS', 'Broker Int.-direct'),
(228, 'TREASURE', 'Treasure-direct'),
(229, 'GRANDSLAM', 'Gold'),
(230, 'TREASURE', 'Horizon'),
(231, 'TREASURE', 'Sunbeam'),
(232, 'GRANDSLAM', 'Champion'),
(233, 'LOTUS', 'Gladiolus'),
(234, 'TREASURE', 'Citrine'),
(236, 'GRANDSLAM', 'Grandslam-direct'),
(237, 'JASMINE', 'Aster'),
(238, 'TREASURE', 'Shalom'),
(239, 'GRANDSLAM', 'Abba'),
(240, 'GRANDSLAM', 'Titanium'),
(241, 'MAGNOLIA', 'Phyre'),
(242, 'ANTHURIUM', 'Aquarius'),
(243, 'THE NEW ANTHURIUM', 'Atlas'),
(244, 'THE NEW ANTHURIUM', 'Advent'),
(245, 'THE NEW ANTHURIUM', 'Aquarius'),
(246, 'THE NEW ANTHURIUM', 'Gem'),
(247, 'THE NEW ANTHURIUM', 'Altarose'),
(248, 'THE NEW ANTHURIUM', 'Oasis'),
(249, 'THE NEW ANTHURIUM', 'The New Anthurium- Direct'),
(250, 'CHRONICLES', 'Amazing'),
(251, 'LOTUS', 'Emmanuel'),
(252, 'GLADIOLUS', 'Emmanuel'),
(253, 'ACHIEVERS', 'Achievers - Direct'),
(254, 'ACHIEVERS', 'Amazing'),
(255, 'ACHIEVERS', 'Blue Lane 1'),
(256, 'ACHIEVERS', 'Faith'),
(257, 'GLADIOLUS', 'Pinnacle'),
(258, 'GLADIOLUS', 'Virgo'),
(259, 'GLADIOLUS', 'Aspen'),
(260, 'GLADIOLUS', 'Gladiolus-direct'),
(261, 'GLADIOLUS', 'Crest'),
(262, 'MAGNOLIA', 'Pine'),
(263, 'GEM', 'Gem-direct'),
(264, 'PRINCE', 'Prince- Direct'),
(265, 'PRINCE', 'Elite'),
(266, 'GRANDSLAM', 'Admiral'),
(267, 'GEM', 'Heart'),
(268, 'GRANDSLAM', 'Governors'),
(269, 'MAGNOLIA', 'Prime'),
(270, 'GEM', 'Mahogany'),
(271, 'ACHIEVERS', 'Acts'),
(272, 'CALYPSO', 'Power'),
(273, 'PRESTIGE 1', 'Power'),
(274, 'IGNEOUS', 'Igneous - Direct'),
(275, 'CREATIVE', 'Ingenious'),
(276, 'PRESTIGE 1', 'Prestige-direct'),
(277, 'IGNEOUS', 'Ebenezer'),
(278, 'HYACINTH', 'Love'),
(279, 'PRESTIGE 1', 'Creative'),
(280, 'GLADIOLUS', 'Taurus'),
(281, 'GRANDSLAM', 'Magnificent'),
(282, 'IGNEOUS', 'Rubellite'),
(283, 'ACHIEVERS', 'Awesome'),
(284, 'PRINCE', 'Royal'),
(285, 'PRINCE', 'Sunrise'),
(286, 'STARGAZER', 'Shamrock'),
(287, 'HYACINTH', 'Obsidian'),
(288, 'CATTLEYA', 'Benevolent'),
(289, 'ACHIEVERS', 'Adrenaline'),
(290, 'MARIGOLD', 'Blazing Star'),
(291, 'FELSITE', 'Obsidian'),
(292, 'CROWN', 'Crown-direct'),
(293, 'MARIGOLD', 'Aster'),
(294, 'EAGLE', 'Eagle-direct'),
(295, 'FELSITE', 'Felsite-direct'),
(296, 'MARIGOLD', 'Marigold-direct'),
(297, 'CROWN', 'Empress'),
(298, 'JASMINE', 'Hollyhocks'),
(299, 'GRANDSLAM', 'Baguettes'),
(300, 'IGNEOUS', 'Stibnite'),
(301, 'CROWN', 'Duchess'),
(302, 'CHERRY BLOSSOM', 'Righteous'),
(303, 'ADMIRAL', 'Admiral-direct'),
(304, 'MAJESTY', 'Righteous'),
(305, 'ADMIRAL', 'Baguettes'),
(306, 'MAJESTY', 'Clarion'),
(307, 'MAJESTY', 'Majesty-direct'),
(308, 'HYACINTH', 'Chrysoprase'),
(309, 'MAJESTY', 'Miracle'),
(310, 'MAJESTY', 'Angels'),
(311, 'TREASURE', 'Sun'),
(312, 'TREASURE', 'Green Peridot'),
(313, 'STARGAZER', 'Smilax'),
(314, 'ADMIRAL', 'Abundance'),
(315, 'GEM', 'Topstar'),
(316, 'MAGNOLIA', 'Path Finder'),
(317, 'MANILA GROUP', 'Felsite'),
(318, 'PRESTIGE 1', 'Strong'),
(319, 'PRESTIGE 1', 'Ingenious'),
(320, 'PRESTIGE 1', 'Innovative'),
(321, 'PSMI', 'Marketing'),
(322, 'VP/DIRECTOR OF SALES', 'Sm/pc'),
(323, 'RE/MAX PREMIERE INC.', 'Reb'),
(324, 'VP/DIRECTOR OF SALES', 'Employee Referral');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `t_reservation`
--

CREATE TABLE `t_reservation` (
  `id` int(11) NOT NULL,
  `ra_no` bigint(20) NOT NULL,
  `c_csr_no` bigint(20) NOT NULL,
  `c_lot_id` bigint(20) NOT NULL,
  `c_or_no` text NOT NULL,
  `c_reserve_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `c_amount_paid` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_reservation`
--

INSERT INTO `t_reservation` (`id`, `ra_no`, `c_csr_no`, `c_lot_id`, `c_or_no`, `c_reserve_date`, `c_amount_paid`) VALUES
(206, 30, 279, 10300901, '20000', '2024-03-26 08:35:34', 20000),
(207, 31, 280, 14500405, '3454545', '2024-03-26 08:35:49', 30000),
(208, 32, 284, 16203804, '543223', '2024-03-26 09:45:03', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_code` text NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `middle_name` text NOT NULL,
  `gender` char(1) NOT NULL,
  `division` text NOT NULL,
  `section` text NOT NULL,
  `position` text NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `hire_date` date DEFAULT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `department` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `avatar` text NOT NULL,
  `type` text NOT NULL,
  `user_type` text NOT NULL,
  `resign_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_code`, `firstname`, `lastname`, `middle_name`, `gender`, `division`, `section`, `position`, `address`, `birthdate`, `hire_date`, `username`, `password`, `department`, `email`, `phone`, `avatar`, `type`, `user_type`, `resign_date`) VALUES
(1, '20191', 'GARY', 'MORATA', 'MONZON', 'F', 'RANK', 'Technical Planning', 'JUNIOR DRAFTSMAN', '0369 NIA ROAD, BARIHAN, MALOLOS CITY, BULACAN', '1989-08-21', '2016-07-05', '20191', '0192023a7bbd73250516f069df18b500', 'Technical Planning', 'sample@gmail.com', '', '', '5', '', '2016-07-05'),
(2, '10160', 'JOMEL', 'ANGELES', 'PAGTALUNAN', 'M', 'RANK', 'Contracts and Doc.', 'JUNIOR DESIGNER', '#335 ROSAL STREET, BARANGAY LIGAS, MALOLOS CITY, BULACAN', '1994-08-14', '2022-08-18', '10160', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '5', '', '2022-08-18'),
(3, '20029', 'MA. MIRASOL', 'MANANGUIT', 'DELA PENA', 'F', 'RANK', 'IT', 'SENIOR SUPPORT SPECIALIST', '#444 BANGA 2ND, PLARIDEL, BULACAN', '1980-07-30', '2002-01-26', '20029', '0192023a7bbd73250516f069df18b500', 'IT', 'sample@gmail.com', '', './uploads/1711338660_365063107_10011711492180164_8542524408383329199_n.jpg', '5', '', '2002-01-26'),
(4, '20151', 'JERSON', 'GANELO', 'LEAL', 'F', 'RANK', 'General Services', 'UTILITY', '862 LONGOS, MALOLOS CITY, BULACAN', '1991-04-30', '2014-02-17', '20151', '0192023a7bbd73250516f069df18b500', 'General Services', 'sample@gmail.com', '21312321321321323', './uploads/1711939980_260551642_106048311913068_180629181988307938_n.jpg', '5', '', '2014-02-17'),
(5, '10114', 'JANICA', 'PALLER', 'DANGANAN', 'F', 'RANK', 'Engineering', 'EXECUTIVE ASSISTANT TO THE COO', '1131 DIVINE GRACE VILLAGE, BOROL 1ST, BALAGTAS BULACAN', '1994-08-07', '2019-03-04', '10114', '0192023a7bbd73250516f069df18b500', 'Engineering', 'sample@gmail.com', '', './uploads/1711415940_428631255_7400215430022059_1258907956511941295_n.jpg', '5', '', '2019-03-04'),
(6, '20123', 'FERNANDO', 'ALCARAZ', 'NATIVIDAD', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', 'B6 L4 LAPID VILLE SUBD., TAMBUBONG, SAN RAFAEL, BUL.', '1967-12-03', '2012-02-28', '20123', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2012-02-28'),
(7, '10075', 'ALLAN', 'GARALDE', 'VILLAMOR', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', '835 DULATRE ST., TABANG, GUIGUINTO, BULACAN', '1987-08-26', '2016-01-05', '10075', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', 'sample@gmail.com', '', './uploads/1711943040_314720159_6234768929884501_201767379164201419_n.jpg', '5', '', '2016-01-05'),
(8, '20121', 'RONEL', 'FERNANDEZ', 'PAGAS', 'M', 'RANK', 'General Services', 'UTILITY STAFF - STOCKS', '0579 PARULAN, PLARIDEL, BUL.', '1977-06-26', '2012-01-24', '20121', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2012-01-24'),
(9, '20062', 'ERNESTO', 'DE GUZMAN', 'SAPITAN', 'M', 'RANK', 'Electrical', 'ELECTRICIAN', '0378 RIVERSIDE, BULIHAN, MALOLOS CITY', '1972-10-12', '2006-06-01', '20062', '0192023a7bbd73250516f069df18b500', 'Electrical', '', '', '', '5', '', '2006-06-01'),
(10, '20189', 'RHODORA', 'BAUTISTA', 'ENRIQUEZ', 'F', 'RANK', 'Treasury', 'TREASURY ASSISTANT', 'B23 L9 P5 GRAND ROYALE SUBD., BULIHAN, MALOLOS CITY, BULACAN', '1985-08-04', '2016-05-30', '20189', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2016-05-30'),
(11, '20078', 'EBENIZER', 'DAYRIT', 'SAN JOSE', 'M', 'RANK', 'Const. and Impln.', 'PROJECT ASSISTANT', '4495 POBLACION, PLARIDEL, BULACAN', '1981-11-10', '2007-07-24', '20078', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2007-07-24'),
(12, '20069', 'RICHIE', 'DE GUZMAN', 'MORELOS', 'F', 'RANK', 'Electrical', 'ADMIN. ASSISTANT', '2002 PUROK 2 SAN FRANCISCO BULACAN, BULACAN', '1980-03-04', '2006-09-12', '20069', '0192023a7bbd73250516f069df18b500', 'Electrical', '', '', '', '5', '', '2006-09-12'),
(13, '20192', 'MA. LULUBELLE', 'ABERGAS', 'ALVAREZ', 'F', 'RANK', 'Electrical', 'ADMIN. COORDINATOR', '352 NIA ROAD, BARIHAN, MALOLOS CITY, BULACAN', '1984-09-26', '2016-07-08', '20192', '0192023a7bbd73250516f069df18b500', 'Electrical', '', '', '', '5', '', '2016-07-08'),
(14, '10102', 'NAZZAR', 'LUIS', 'REYES', 'M', 'MNGR', 'Legal', 'CHIEF LEGAL OFFICER', 'UNIT 321 PRINCEVILLE COND., LAUREL ST., MANDALUYONG, METRO MANILA', '1953-01-09', '2018-04-01', '10102', '0192023a7bbd73250516f069df18b500', 'Legal', '', '', '', '3', '', '2018-04-01'),
(15, '20198', 'JORDAN', 'TEODORO', 'ROXAS', 'M', 'SPVR', 'Repair and Maintenance', 'WAREHOUSE INVENTORY SUPERVISOR', '153 ILANG-ILANG ST., ALIDO SUBD., MALOLOS CITY, BULACAN', '1979-09-06', '2017-11-06', '20198', '0192023a7bbd73250516f069df18b500', 'Repair and Maintenance', '', '', '', '4', '', '2017-11-06'),
(16, '10131', 'LIA MARIE JOBELLE', 'MADRID', 'BUHAIN', 'F', 'MNGR', 'Corporate Communications', 'CORPORATE COMMUNICATIONS MANAGER', '4024 TABANG, PLARIDEL BULACAN', '1998-08-15', '2020-01-27', '10131', '0192023a7bbd73250516f069df18b500', 'Corporate Communications', 'sample@gmail.com', '', './uploads/1711417200_409185085_10232281232308945_6075352371341495233_n.jpg', '3', '', '2020-01-27'),
(17, '20152', 'JOSEPH', 'LAO', 'LEE', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '279 STO. CRISTO, PULILAN, BULACAN', '1979-01-14', '2014-02-24', '20152', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2014-02-24'),
(18, '20035', 'PABLITO', 'BERNARDINO', 'LUCAS', 'M', 'RANK', 'General Services', 'PRINTING OPERATOR', 'MALOLOS, BULACAN', '1972-01-15', '2003-01-13', '20035', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2003-01-13'),
(19, '20053', 'RUEL', 'DELA CRUZ', 'DE VERA', 'M', 'RANK', 'Repair and Maintenance', 'SITE INVENTORY ASSISTANT', '#160 CAPIHAN, SAN RAFAEL, BULACAN', '1984-10-02', '2005-01-14', '20053', '0192023a7bbd73250516f069df18b500', 'Repair and Maintenance', '', '', '', '5', '', '2005-01-14'),
(20, '10077', 'ROLAND', 'CO', 'HORIDA', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '11 VIOLETA PERSA LOOP, VERDANA HOMES, MOLINO, BACOOR, CAVITE', '1985-02-17', '2016-01-01', '10077', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2016-01-01'),
(21, '10143', 'JEFFREY', 'HERMINIGILDO', 'PORQUIADO', 'F', 'SPVR', 'General Services', 'GENERAL SERVICES SECTION OFFICER', '306 PUROK 3 BARANGAY CALIZON, CALUMPIT', '1986-09-17', '2021-04-12', '10143', '0192023a7bbd73250516f069df18b500', 'General Services', 'sample@gmail.com', '', './uploads/1711943820_95140018_3172008362843217_2484514971577221120_n.jpg', '4', '', '2021-04-12'),
(22, '20181', 'FRANCIS LORENZO', 'DIAZ', 'AGUILAR', 'M', 'MNGR', 'IT', 'IT MANAGER', '1604 NIA ROAD, BAMBANG, BOCAUE, BULACAN', '1995-08-10', '2015-10-05', '20181', '0192023a7bbd73250516f069df18b500', 'IT', 'sample@gmail.com', '', './uploads/1711338720_354431097_252227534084834_8158024681724352004_n.jpg', '3', '', '2015-10-05'),
(23, '10144', 'CHRISTINA', 'DELA CRUZ', 'DELA CRUZ', 'F', 'RANK', 'Inventory Control', 'CORPORATE ASSETS ASISTANT', '0314 LUMANG BAYAN PLARIDEL BULACAN', '1979-09-23', '2021-06-07', '10144', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '5', '', '2021-06-07'),
(24, '10095', 'ROSENDA', 'RIVERA', 'FLORES', 'F', 'MNGR', 'Marketing', 'SALES MANAGER', '#856 ESGUERRA ST., POBLACION, PULILAN, BULACAN', '1975-03-01', '2017-05-01', '10095', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '3', '', '2017-05-01'),
(25, '10070', 'MA. SHEILA', 'MANALO', 'GIUBAN', 'F', 'MNGR', 'Executive', 'CHIEF HUMAN RESOURCES OFFICER', '10 DONA JUSTINA AVE., FILINVEST SOUTH, TUBIGAN, BINAN, LAGUNA', '1976-02-12', '2015-01-12', '10070', '0192023a7bbd73250516f069df18b500', 'Executive', '', '', '', '3', '', '2015-01-12'),
(26, '30003', 'MARY GRACE ', 'CAJUCOM', 'VALENCIA', 'F', 'RANK', 'CALS', 'CREDIT ASSESSMENT ASSISTANT', 'BLK61 LT5 PH5 DREAMCREST HOMES, LONGOS, MALOLOS CITY, BULACAN', '1976-07-07', '2000-02-10', '30003', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '2000-02-10'),
(27, '10038', 'PREDY', 'ADAON', 'AGPAOA', 'M', 'SPVR', 'Electrical', 'ELECTRICAL SUPERVISOR', 'BOCAUE, BULACAN', '1979-01-03', '2003-01-13', '10038', '0192023a7bbd73250516f069df18b500', 'Electrical', '', '', '', '4', '', '2003-01-13'),
(28, '10034', 'FERNANDO ', 'SALCEDO JR.', 'PASCUAL', 'M', 'SPVR', 'Const. and Impln.', 'PROJECT MANAGER', '170 LAGUNDI, PLARIDEL, BULACAN', '1972-12-17', '2002-04-19', '10034', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '4', '', '2002-04-19'),
(29, '20050', 'ROMMEL', 'SANTOS', 'TORIBIO', 'M', 'RANK', 'Const. and Impln.', 'PROJECT ASSISTANT', '0125 TIAONG, BALIUAG, BUL.', '1970-05-17', '2004-08-09', '20050', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2004-08-09'),
(30, '20098', 'RIZZA LYN', 'DELLOTA', 'AGUILAR', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', '307 PADILLA ST., BANGA I, PLARIDEL, BULACAN', '1988-03-08', '2010-03-26', '20098', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2010-03-26'),
(31, '10023', 'DENNIS ', 'DE BORJA', 'CUSTODIO', 'M', 'SPVR', 'Engineering', 'QUALITY CONTROL SUPERVISOR', '856 F.T.REYES ST.STO. ROSARIO, MAL. BUL.', '1975-02-04', '2000-03-31', '10023', '0192023a7bbd73250516f069df18b500', 'Engineering', '', '', '', '4', '', '2000-03-31'),
(32, '20128', 'CENETTE', 'GONZALES', 'LUMBA', 'F', 'RANK', 'Design and Devt.', 'ASSISTANT ESTIMATOR', '47 SAN VICENTE, APALIT, PAMP.', '1974-03-16', '2012-05-13', '20128', '0192023a7bbd73250516f069df18b500', 'Design and Devt.', '', '', '', '5', '', '2012-05-13'),
(33, '10100', 'VIOLETA', 'BORLONGAN', 'SURIO', 'F', 'SPVR', 'Marketing', 'SALES AND MARKETING OPERATIONS SUPERVISOR', '910 FT REYES ST., SAN JUAN, MALOLOS CITY, BULACAN', '1980-06-01', '2017-05-01', '10100', '0192023a7bbd73250516f069df18b500', 'Marketing', 'sample@gmail.com', '', './uploads/1711415160_126239925_4679095345498153_5944678933933703195_n.jpg', '4', '', '2017-05-01'),
(34, '20032', 'MARILOU ', 'CRUZ', 'MORILLO', 'F', 'SPVR', 'Design and Devt.', 'ESTIMATE SUPERVISOR', '400 P. DAMASO ST., CONCEPCION, BALIUAG, BUL.', '1976-08-07', '2002-05-29', '20032', '0192023a7bbd73250516f069df18b500', 'Design and Devt.', '', '', '', '4', '', '2002-05-29'),
(35, '10027', 'EMMANUEL ', 'RAMOS', 'DELA CRUZ', 'M', 'SPVR', 'Const. and Impln.', 'PROJECT MANAGER', '#1273 PACO, OBANDO, BULACAN', '1975-06-17', '2000-11-04', '10027', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '4', '', '2000-11-04'),
(36, '10147', 'DONITA ROSE', 'TANTOCO', 'PINGOL', 'F', 'RANK', 'IT', 'SOFTWARE DEVELOPER', '2019 MALUSAK STREET SAN PABLO CITY MALOLOS BULACAN', '1996-12-09', '2021-08-05', '10147', '0192023a7bbd73250516f069df18b500', 'IT', 'sdsfw@gmail.com', '23456434', '../uploads/1711329840_313438776_184995770768566_3904009783811235452_n.jpg', '1', 'IT Admin', '2021-08-05'),
(37, '20076', 'JAJETH', 'DELA CRUZ', 'BERINGUELA', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', '141 STA. INES PLARIDEL, BULACAN', '1974-10-09', '2007-07-03', '20076', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2007-07-03'),
(38, '20190', 'GLADYS ANNE', 'DAVID', 'ESPINA', 'F', 'RANK', 'Technical Planning', 'DESIGNER 1 ', '960/E ENRIQUEZ ST., CAINIGN, MALOLOS CITY', '1987-02-26', '2016-05-30', '20190', '0192023a7bbd73250516f069df18b500', 'Technical Planning', '', '', '', '5', '', '2016-05-30'),
(39, '20168', 'JESSA', 'JACINTO', 'LEONCIO', 'F', 'RANK', 'Electrical', 'ADMIN. ASSISTANT', '207 STO. NINO, PLARIDEL, BULACAN', '1990-05-15', '2014-10-08', '20168', '0192023a7bbd73250516f069df18b500', 'Electrical', '', '', '', '5', '', '2014-10-08'),
(40, '10135', 'CHRISTINE JOY', 'TOLENTINO', 'FLORES', 'F', 'RANK', 'Contracts and Doc.', 'CUSTOMER SERVICE REPRESENTATIVE', '076 LOURDES STREET SAN JUAN, APALIT PAMPANGA', '1999-05-09', '2020-11-17', '10135', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '5', '', '2020-11-17'),
(41, '10086', 'MA. ANGELA', 'RUBIO', 'MONTANO', 'F', 'RANK', 'General Services', 'UTILITY', 'BUROL ST., SAN JUAN, MALOLOS CITY, BULACAN', '1983-11-19', '2016-07-18', '10086', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2016-07-18'),
(42, '20038', 'VICTOR', 'DE JESUS', 'VENUYA', 'M', 'RANK', 'Const. and Impln.', 'PROJECT ASSISTANT', 'SAN AGUSTIN, HAGONOY, BULACAN', '1972-07-28', '2003-01-17', '20038', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2003-01-17'),
(43, '10017', 'ARLENE', 'SAN PEDRO', 'CUSTODIO', 'F', 'SPVR', 'Treasury', 'TREASURY SUPERVISOR', '#128 PUROK 2 BALITE, MAL., BUL.', '1973-06-29', '1998-05-13', '10017', '0192023a7bbd73250516f069df18b500', 'Treasury', 'sample@gmail.com', '', './uploads/1711942980_419846564_7156179317772732_5841731241869196707_n.jpg', '4', '', '1998-05-13'),
(44, '20018', 'MARIA ELOIZA ', 'PERALTA', 'CAPULE', 'F', 'SPVR', 'Audit', 'AUDITING SUPERVISOR', '#40 CUPANG ST., SAN NICOLAS, BULAKAN, BULACAN', '1979-01-02', '2000-08-29', '20018', '0192023a7bbd73250516f069df18b500', 'Audit', '', '', '', '4', '', '2000-08-29'),
(45, '20082', 'FERDINAND', 'BAUTISTA', 'CORNESTA', 'M', 'RANK', 'Project Admin', 'PROPERTY ADMIN. SITE ASSISTANT', '630 LONGOS HI-WAY, MALOLOS CITY', '1980-09-11', '2008-01-30', '20082', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2008-01-30'),
(46, '20001', 'RUEL ', 'RUSTIA', 'MERCADO', 'M', 'SPVR', 'Project Admin', 'PROPERTY ADMINISTRATOR', '#222 RIZAL ST., STA BARBARA, BALIUAG, BULACAN', '1963-12-14', '1996-11-16', '20001', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '4', '', '1996-11-16'),
(47, '20136', 'ANALIZA', 'LAO', 'RAMOS', 'F', 'RANK', 'Inventory Control', 'CORPORATE ASSETS ASSISTANT', '#279 STO. CRISTO, PULILAN, BUL.', '1977-09-11', '2013-01-21', '20136', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '5', '', '2013-01-21'),
(48, '20064', 'VERNIE', 'DELA CRUZ', 'LOPEZ', 'M', 'RANK', 'IT', 'TECHNICAL SUPPORT', '111 ENRIQUEZ ST. CAINGIN MALOLOS CITY', '1985-09-15', '2006-06-13', '20064', '0192023a7bbd73250516f069df18b500', 'IT', '', '', '', '5', '', '2006-06-13'),
(49, '20097', 'MARLON', 'NUQUE', 'DUNGO', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', 'PUROK 4 GATBUCA, CALUMPIT, BULACAN', '1980-10-04', '2010-02-09', '20097', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2010-02-09'),
(50, '20051', 'ROMIL', 'CORTEZ', 'MARTINEZ', 'M', 'SPVR', 'Permits and Licenses', 'REGULATORY PERMITS AND LICENSES SUPERVISOR ', 'BLK 5 LOT 19 PHASE 6B GRAND ROYALE SUBD., PINAGBAKAHAN, MALOLOS CITY', '1970-05-28', '2004-09-02', '20051', '0192023a7bbd73250516f069df18b500', 'Permits and Licenses', '', '', '', '4', '', '2004-09-02'),
(51, '10157', 'EDHEN JOY', 'SESE', 'BAGONDOL', 'F', 'RANK', 'IT', 'SOFTWARE DEVELOPER', '0416 SAN ISIDRO HAGONOY BULACAN', '1999-08-28', '2022-05-10', '10157', '0192023a7bbd73250516f069df18b500', 'IT', 'sample@gmail.com', '', './uploads/1711345380_62033245_2337621039592379_4583572846134951936_n.jpg', '5', '', '2022-05-10'),
(52, '20104', 'JUDERICK', 'ALVAREZ', 'SANIDAD', 'M', 'RANK', 'Project Admin', 'PROPERTY ADMIN. SITE ASSISTANT', 'B1 L 1 PH2 GR SUBD. BULIHAN, MALOLOS CITY', '1987-06-05', '2011-01-26', '20104', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2011-01-26'),
(53, '20016', 'JENNIFER', 'SORIAGA', 'HERNANDEZ', 'F', 'SPVR', 'Billing', 'BILLING SUPERVISOR (DA 3MOS 9.6)', '375 CALLE BIGA ST. SAN PABLO MALOLOS BUL', '1974-10-24', '2000-04-10', '20016', '0192023a7bbd73250516f069df18b500', 'Billing', 'sample@gmail.com', '', './uploads/1711943040_312599568_10225269677703359_7955513899989990927_n.jpg', '4', '', '2000-04-10'),
(54, '10079', 'MARIA CECILIA', 'MADRID', 'BUHAIN', 'F', 'MNGR', 'Executive', 'TREASURER', '4024 TABANG, PLARIDEL, BULACAN', '1960-07-21', '2016-03-01', '10079', '0192023a7bbd73250516f069df18b500', 'Executive', '', '', '', '3', '', '2016-03-01'),
(55, '20106', 'MARIE JANE', 'SIAPCO', 'SANCHEZ', 'F', 'RANK', 'Billing', 'BILLING ASSISTANT', '208 VICEO ST. CAINGIN, SAN RAFAEL, BULACAN', '1972-01-28', '2011-03-01', '20106', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2011-03-01'),
(56, '20133', 'MARY ANN NINA', 'BELVEZ', 'TOMAS', 'F', 'RANK', 'Documentation and Loan', 'CUSTOMER SERVICE OFFICER', '803 RIZAL ST., STA. BARBARA, BALIUAG, BULACAN', '1983-11-04', '2012-09-10', '20133', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2012-09-10'),
(57, '20182', 'TERESITA', 'CRUZ', 'GATCHALIAN', 'F', 'RANK', 'Billing', 'TELEMARKETER', 'PUROK4, BUGUION, CALUMPIT, BULACAN', '1987-06-13', '2015-11-16', '20182', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2015-11-16'),
(58, '10006', 'MANUEL ', 'CLEMENTE', 'EUSEBIO', 'M', 'MNGR', 'Const. and Impln.', 'AVP - PROJECT MANAGEMENT', 'DAKILA, MALOLOS, BULACAN', '1966-06-17', '1995-08-07', '10006', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '3', '', '1995-08-07'),
(59, '10177', 'JULIE ANN', 'REYES', 'DE LEON', 'F', 'RANK', 'Marketing', 'SALES OPERATIONS ASSOCIATE', 'GRAND ROYALE SUBDIVISION PHASE 9 BLOCK 70 LOT 4, WHORTLEBERRY STREET, MALOLOS CITY, BULACAN 3000', '1991-07-01', '2023-07-12', '10177', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '5', '', '2023-07-12'),
(60, '20012', 'EDUARDO ', 'FRANCISCO', 'LEONARDO', 'M', 'RANK', 'Audit', 'MESSENGER', '291 CAINGIN, BOCAUE, BUL.', '1960-04-14', '1999-07-26', '20012', '0192023a7bbd73250516f069df18b500', 'Audit', '', '', '', '5', '', '1999-07-26'),
(61, '10007', 'MA. THERESA ', 'RABULAN', 'DELA CRUZ', 'F', 'MNGR', 'Treasury', 'AVP-TREASURY', '#310 WAWA IBA, HAGONOY, BULACAN', '1972-04-11', '1995-12-01', '10007', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '3', '', '1995-12-01'),
(62, '10026', 'MAYLENE ', 'GUELAS', 'PASCUAL', 'F', 'MNGR', 'Contracts and Doc.', 'AVP-CONTRACTS & DOCUMENTATIONS', '1450 PARULAN, PLARIDEL, BUL.', '1977-08-21', '2000-07-10', '10026', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '3', '', '2000-07-10'),
(63, '20054', 'CONNIE', 'GUTIERREZ', 'CRUZ', 'F', 'RANK', 'Legal', 'LEGAL ASSISTANT', '217 PUROK 6 DAMPOL, PLARIDEL, BUL.', '1981-09-10', '2005-01-14', '20054', '0192023a7bbd73250516f069df18b500', 'Legal', '', '', '', '5', '', '2005-01-14'),
(64, '20186', 'ERNESTO', 'FRANCISCO JR.', 'PACTORANAN', 'M', 'SPVR', 'Technical Planning', 'TECHNICAL PLANNING SUPERVISOR', 'BLK77 LOT41 LA RESIDENCIA SUBD., SERGIO BAYAN, CALUMPIT, BULACAN', '1984-11-04', '2016-02-01', '20186', '0192023a7bbd73250516f069df18b500', 'Technical Planning', '', '', '', '4', '', '2016-02-01'),
(65, '10181', 'MARIE JOSEPHINE', 'MANDIA', 'GALANG', 'F', 'RANK', 'General Services', 'GENERAL SERVICES ASSISTANT', '29 RAMOS STREET BRGY. BALUNGAO, CALUMPIT, BULACAN', '2000-01-08', '2023-09-11', '10181', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2023-09-11'),
(66, '20023', 'EDGARDO ', 'FAUSTINO', 'MORONA', 'M', 'RANK', 'Treasury', 'CASHIER', '46 SIKATUNA ST., CATMON, MAL. BUL.', '1959-12-29', '2001-04-17', '20023', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2001-04-17'),
(67, '10178', 'BEEGIL', 'MANUEL', 'RAMIREZ', 'M', 'RANK', 'IT', 'JR. TECHNICAL SUPPORT SPECIALIST', '47 RAMIREZ STREET, ABANGAN NORTE, MARILAO BULACAN', '1994-12-29', '2023-08-22', '10178', '0192023a7bbd73250516f069df18b500', 'IT', '', '', '', '5', '', '2023-08-22'),
(68, '20036', 'ARNEL ', 'SANTOS', 'DELA CRUZ', 'M', 'RANK', 'General Services', 'UTILITY', 'PLARIDEL, BULACAN', '1973-09-07', '2003-01-13', '20036', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2003-01-13'),
(69, '20003', 'IMELDA ', 'NAVIA', 'CASACLANG', 'F', 'SPVR', 'Inventory Control', 'INVENTORY CONTROL OFFICER ', '#130 STA. INES, PLARIDEL, BULACAN', '1978-09-11', '1997-07-12', '20003', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '4', '', '1997-07-12'),
(70, '20002', 'ADA ', 'DABON', 'MAGSAKAY', 'F', 'RANK', 'CALS', 'LOANS ASSISTANT', 'B78 L13 P4,ROCKAVILLAGE,TABANG,PLA.,BUL.', '1973-01-17', '1997-05-05', '20002', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '1997-05-05'),
(71, '20008', 'ELENA ', 'MILLO', 'BALA', 'F', 'RANK', 'Treasury', 'CASHIER', 'NILASIN 2ND, PURA, TARLAC', '1976-03-31', '1998-12-22', '20008', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '1998-12-22'),
(72, '10073', 'RAMON', 'SANTOS JR.', 'SARMIENTO', 'M', 'SPVR', 'Const. and Impln.', 'PROJECT MANAGER', '51 L E PUROK 1, LOOK 1, MALOLOS CITY, BULACAN', '1981-01-26', '2015-11-03', '10073', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '4', '', '2015-11-03'),
(73, '20063', 'EUSEBIO', 'CRUZ III', 'CRUZ', 'M', 'RANK', 'Accounting', 'ACCOUNTING ASSISTANT', 'B87 L12 PHASE 5 DREAMCREST HOMES SUBD. BULIHAN, MALOLOS CITY', '1974-04-11', '2006-06-09', '20063', '0192023a7bbd73250516f069df18b500', 'Accounting', 'sample@gmail.com', '09289189191', './uploads/1711329960_298553_259415577409596_7988318_n.jpg', '5', '', '2006-06-09'),
(74, '10163', 'MARIA ERICKA', 'SANTOS', 'APOSTOL', 'F', 'SPVR', 'Const. and Impln.', 'PROJECT SUPERVISOR', '196 BARANGAY PRITIL, GUIGUINTO BULACAN', '1997-09-08', '2022-10-17', '10163', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '4', '', '2022-10-17'),
(75, '10012', 'JANINE', 'CRUZ', 'BENEDICTOS', 'F', 'SPVR', 'CALS', 'CREDIT ASSESSMENT AND LOANS SUPERVISOR', '5613 STO. NINO PLARIDEL, BULACAN', '1977-06-11', '1996-09-09', '10012', '0192023a7bbd73250516f069df18b500', 'CALS', 'sample@gmail.com', '', './uploads/1711942980_416839552_10163205042779018_7848685482880071936_n.jpg', '4', '', '1996-09-09'),
(76, '10180', 'HANNYBELLE', 'VICTORIA', 'PINLAC', 'F', 'RANK', 'Personnel', 'FRONT DESK OFFICER', '625 TRAMO, STO.CRISTO, PULILAN BULACAN', '2001-04-19', '2023-08-24', '10180', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '5', '', '2023-08-24'),
(77, '10168', 'GLORIA MARIS', 'SANTIAGO', 'MANGAHAS', 'F', 'RANK', 'Corporate Communications', 'M.I.C.E-SALES COORDINATOR', '22 BUGA STREET SAN ISIDRO II PAOMBONG BULACAN', '1987-10-12', '2023-03-06', '10168', '0192023a7bbd73250516f069df18b500', 'Corporate Communications', '', '', '', '5', '', '2023-03-06'),
(78, '10172', 'JERVY', 'SUSADA', 'SELLOTE', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '117 SAMPAGUITA STREET, ALIDO HEIGHTS, MALOLOS CITY, BULACAN', '1988-10-17', '2023-05-15', '10172', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2023-05-15'),
(79, '10094', 'MARISSA', 'AMURAO', 'JAYME', 'F', 'MNGR', 'Marketing', 'SALES MANAGER', 'B5 L3 ROCKA VILLAGE III STA. RITA GUIGUINTO, BULACAN', '1967-11-10', '2017-05-01', '10094', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '3', '', '2017-05-01'),
(80, '20118', 'LAWRENCE', 'BUHAIN', 'DELA CRUZ', 'M', 'RANK', 'Project Admin', 'PROPERTY ADMIN. SITE ASSISTANT', '#300 STA. INES, PLARIDEL, BULACAN', '1980-10-29', '2011-10-03', '20118', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2011-10-03'),
(81, '10179', 'ANDREAFIL', 'DAGANDAN', 'ARTEGENIO', 'F', 'RANK', 'Billing', 'BILLING ASSISTANT', 'GRAND ROYALE SUBD. PHASE 5D SPEARMINT STREET BLK 5 L1 BRGY PINAGBAKAHAN', '1986-08-26', '2023-08-22', '10179', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2023-08-22'),
(82, '10140', 'JOYCE', 'CATIGBE', 'MARMITO', 'F', 'RANK', 'Billing', 'BILLING ASSISTANT', 'B4 L30 HUMEL HOMES, LONGOS, MALOLOS CITY, BULACAN', '1996-05-16', '2021-01-05', '10140', '0192023a7bbd73250516f069df18b500', 'Billing', 'sample@gmail.com', '', './uploads/1711345860_317900578_1386639618769315_2954432293621140477_n.jpg', '5', '', '2021-01-05'),
(83, '10183', 'ALBERT', 'MANALAYSAY', 'MUYCO', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '677 PUROK 4, BARANGAY SANTISSIMA  TRINIDAD, MALOLOS, BULACAN', '1988-11-17', '2023-09-18', '10183', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2023-09-18'),
(84, '20017', 'ROMEO ', 'BAUTISTA', 'BUHAIN', 'M', 'SPVR', 'Inventory Control', 'CORPORATE ASSETS SUPERVISOR', '#022 MABALAS-BALAS SAN RAFAEL, BULACAN', '1978-09-30', '2000-08-15', '20017', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '4', '', '2000-08-15'),
(85, '10051', 'PIA MARIE ISABELLE', 'MADRID', 'BUHAIN', 'F', 'MNGR', 'Engineering', 'CHIEF OF OPERATION', '4024 TABANG PLARIDEL BULACAN', '1989-01-22', '2009-11-03', '10051', '0192023a7bbd73250516f069df18b500', 'Engineering', 'sample@gmail.com', '', './uploads/1711338900_1674732540_89744207_10158068221285818_5380944493983825920_n.jpg', '3', '', '2009-11-03'),
(86, '10171', 'JANET', 'BAUTISTA', 'DOCOT', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', 'LA RESIDENCIA PHASE 3D BLOCK 7 LOT19 TEGULA STREET BARANGAY BALITE, CALUMPIT BULACAN', '1989-01-24', '2023-05-15', '10171', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2023-05-15'),
(87, '10176', 'NADINE', 'ESTRELLA', 'MALABANA', 'F', 'RANK', 'Corporate Communications', 'CORPORATE COMMUNICATIONS ASSOCIATE', '215 MILAFLOR EXTENSION, BOROL 1ST, BALAGTAS, BULACAN', '1994-08-19', '2023-06-29', '10176', '0192023a7bbd73250516f069df18b500', 'Corporate Communications', '', '', '', '5', '', '2023-06-29'),
(88, '10113', 'RUBY MAY', 'TANGCOGO', 'VILLASENOR', 'F', 'RANK', 'Billing', 'BILLING ASSISTANT', '0682 PUROK 3, SIPAT PLARIDEL, BULACAN', '1998-05-19', '2019-02-26', '10113', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2019-02-26'),
(89, '10169', 'RUEL', 'DELA CRUZ', 'SANTOS', 'M', 'RANK', 'CALS', 'LOANS ASSISTANT', 'PUROK 1 STO. NINO, PLARIDEL BULACAN', '1979-09-17', '2023-03-13', '10169', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '2023-03-13'),
(90, '10164', 'CHERRIE LYN ', 'ACUNA', 'DE LEON', 'F', 'RANK', 'Treasury', 'TREASURY ASSISTANT', '0519 BUBOG SAN ISIDRO II PAOMBONG, BULACAN', '1996-09-05', '2022-12-07', '10164', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2022-12-07'),
(91, '10015', 'MARIA TERESA', 'DELA PENA', 'DE GUZMAN', 'F', 'SPVR', 'Purchasing', 'PURCHASING OFFICER', '444 BANGA II, PLARIDEL, BULACAN', '1977-03-28', '1997-08-18', '10015', '0192023a7bbd73250516f069df18b500', 'Purchasing', 'sample@gmail.com', '', './uploads/1711939860_11707565_10207358608908011_7225584683169319690_n.jpg', '4', '', '1997-08-18'),
(92, '10170', 'MAY', 'NORIESTA', 'OLIQUINO', 'F', 'RANK', 'CALS', 'LOANS ASSISTANT', '460 ST. PAUL SUBDIVISION CANALATE MALOLOS CITY BULACAN', '1992-05-01', '2023-04-27', '10170', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '2023-04-27'),
(93, '20030', 'MICHAEL ', 'BENEDICTOS', 'MACALALAG', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '278 PULO BARIHAN, MALOLOS, BULACAN', '1976-11-03', '2002-04-03', '20030', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2002-04-03'),
(94, '20112', 'BABY BOY', 'CRUZ', 'OSIAN', 'M', 'RANK', 'General Services', 'UTILITY ', '#266 LONGOS, MALOLOS CITY', '1989-07-25', '2011-06-13', '20112', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2011-06-13'),
(95, '20175', 'CINDERELLA', 'DELIUPA', 'DELA CRUZ', 'F', 'RANK', 'Accounting', 'ACCOUNTING ASSISTANT', '02 PUROK 5, KAPITANGAN, PAOMBONG, BULACAN', '1984-10-24', '2015-05-04', '20175', '0192023a7bbd73250516f069df18b500', 'Accounting', 'sample@gmail.com', '', './uploads/1711942980_420173568_1110729463428366_8486191492491201560_n.jpg', '5', '', '2015-05-04'),
(96, '20153', 'JESSIE', 'PEREZ', 'ALCARAZ', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '445 PARULAN, PLARIDEL, BULACAN', '1972-06-01', '2014-02-24', '20153', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2014-02-24'),
(97, '10115', 'IAN REY', 'DELOS REYES', 'FABILA', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '0428 TARAPICHI STREET SAN JOSE BULACAN, BULACAN', '1992-08-09', '2019-03-04', '10115', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2019-03-04'),
(98, '20091', 'ROMEO', 'SIAPCO', 'VALONDO', 'M', 'RANK', 'Const. and Impln.', 'PROJECT ASSISTANT', '#208 CAINGIN, SAN RAFAEL, BULACAN', '1976-06-04', '2008-07-18', '20091', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2008-07-18'),
(99, '20074', 'ELIZA', 'FIGUEROA', 'GUMASING', 'F', 'RANK', 'Treasury', 'CASHIER', '#1545 GULOD, PULONG BUHANGIN, STA. MARIA, BULACAN', '1980-11-10', '2007-03-12', '20074', '0192023a7bbd73250516f069df18b500', 'Treasury', 'sample@gmail.com', '', './uploads/1711942920_82302970_2847537905289726_1343754911682134016_n.jpg', '5', '', '2007-03-12'),
(100, '20056', 'ANTONIO', 'VASQUEZ', 'BERJA', 'M', 'RANK', 'Treasury', 'FILING CLERK', '24 DE AGUSTO, CAINGIN, MALOLOS CITY', '1974-10-20', '2005-02-21', '20056', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2005-02-21'),
(101, '20015', 'JOEL ', 'CENSON', 'ROXAS', 'M', 'RANK', 'Inventory Control', 'DOCUMENTATION ASSISTANT/MESSENGER', '146 SAN JOSE ST., BINANG 2ND, BOCAUE BUL', '1966-10-07', '2000-02-08', '20015', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '5', '', '2000-02-08'),
(102, '20071', 'MARILYN', 'FERRERAS', 'SACDALAN', 'F', 'RANK', 'Contracts and Doc.', 'DEPARTMENT SECRETARY', '274 BANGA 1ST PLARIDEL BULACAN', '1983-08-31', '2007-01-09', '20071', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '5', '', '2007-01-09'),
(103, '20044', 'CIELITO', 'CATINDIG', 'CRUZ', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', 'SAN NICOLAS, BULACAN, BULACAN', '1974-10-12', '2003-08-08', '20044', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2003-08-08'),
(104, '20131', 'MA. LOURDES', 'POSILLO', 'SULIT', 'F', 'RANK', 'Project Admin', 'PROPERTY ADMIN. ASSISTANT', '6772 DAMPOL, PLARIDEL, BUL.', '1973-11-19', '2012-07-12', '20131', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2012-07-12'),
(105, '20160', 'ROSE ANNE', 'CAPULE', 'TAMAYO', 'F', 'RANK', 'Project Admin', 'PROPERTY ADMIN. ASSISTANT', 'L4 B33 109 ST. RUFINA GOLDEN VILLAGE, STO. CRISTO, MALOLOS CITY, BULACAN', '1990-12-11', '2014-06-10', '20160', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2014-06-10'),
(106, '10093', 'JUDE', 'DELA CRUZ', 'PANGILINAN', 'F', 'SPVR', 'IT', 'LEAD SOFTWARE DEVELOPER', '531 SANTOL, BALAGTAS, BULACAN', '1994-12-25', '2017-04-21', '10093', '0192023a7bbd73250516f069df18b500', 'IT', 'sample@gmail.com', '09283911093', './uploads/1711329600_1675125780_310082230_527806389353530_3496035450341313581_n.jpg', '1', 'IT Admin', '2017-04-21'),
(107, '20059', 'ORLANDO', 'SANTOS', 'DELA CRUZ', 'M', 'RANK', 'General Services', 'UTILITY STAFF - STOCKS', 'STO NINO PLARIDEL, BULACAN', '1976-02-04', '2006-02-20', '20059', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2006-02-20'),
(108, '10189', 'GEMMA LYN', 'CAPIRAL', 'LEGASPI', 'F', 'RANK', 'Treasury', 'CASHIER', '1240 SAN ISIDRO SR., HAGONOY, BULACAN', '1982-11-22', '2023-12-05', '10189', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2023-12-05'),
(109, '10110', 'LEONARDO JR', 'MAGSAKAY', 'MANLAPIG', 'M', 'SPVR', 'Security Admin', 'SECURITY SERVICES OFFICER', '64 SICAYUNA ST SAN GABRIEL MALOLOS CITY', '1964-08-07', '2018-10-01', '10110', '0192023a7bbd73250516f069df18b500', 'Security Admin', '', '', '', '4', '', '2018-10-01'),
(110, '10188', 'ANGELICA', 'SEMBRANO', 'BUNYOG', 'F', 'RANK', 'Project Admin', 'PROPERTY ADMIN ASSISTANT (RELIEVER)', '89 BARANGAY BALUNGAO, CALUMPIT, BULACAN', '2000-01-30', '2023-11-23', '10188', '0192023a7bbd73250516f069df18b500', 'Project Admin', '', '', '', '5', '', '2023-11-23'),
(111, '20115', 'SANTIAGO', 'SANTOS', 'DELA CRUZ', 'M', 'RANK', 'Const. and Impln.', 'PROJECT ASSISTANT', '#542 STO. NINO, PLARIDEL, BUL.', '1966-12-29', '2011-08-17', '20115', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2011-08-17'),
(112, '10154', 'JERUS', 'VALIENTE', 'ACABA', 'M', 'RANK', 'Billing', 'BILLING ASSISTANT', 'SITIO TABING ILOG II, BARANGAY BULIHAN, MALOLOS CITY BULACAN', '1993-08-19', '2022-02-21', '10154', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2022-02-21'),
(113, '20134', 'JILEN', 'ARELLANO', 'GAMAZON', 'F', 'SPVR', 'Personnel', 'RECRUITMENT OFFICER', 'B41 L2&4 PHASE 3 DCH SUBD., LONGOS, MALOLOS CITY', '1981-08-09', '2012-09-25', '20134', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '4', '', '2012-09-25'),
(114, '10148', 'DEVIE', 'ROQUE', 'CAMA', 'F', 'RANK', 'Marketing', 'BROKER SALES COORDINATOR', '455 L. VALENCIA STREET, STO.ROSARIO, MALOLOS CITY, BULACAN', '1978-11-30', '2021-12-01', '10148', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '5', '', '2021-12-01'),
(115, '20007', 'ELEONOR ', 'CABAL', 'SACDALAN', 'F', 'RANK', 'Personnel', 'COMPENSATION AND BENEFITS ASSISTANT', '36 DOMSAL SUBD., BULIHAN, MALOLOS, BUL.', '1975-01-15', '1998-08-07', '20007', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '5', '', '1998-08-07'),
(116, '10021', 'RAMON ', 'SASPA JR.', 'RUFO', 'M', 'MNGR', 'Personnel', 'EMPLOYEE ENGAGEMENT OFFICER', 'B58 LT4 BRGY DATU ISMAEL DASMA I DASMARINAS CAVITE', '1973-07-06', '1999-11-02', '10021', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '3', '', '1999-11-02'),
(117, '10185', 'KIMBERLY DAINE ', 'CRUZ', 'TARUC', 'F', 'RANK', 'Inventory Control', 'INVENTORY CONTROL ASSISTANT', '143, SITIO BACOOD TAMBUBONG, SAN RAFAEL, BULACAN', '1997-06-02', '2023-10-16', '10185', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '5', '', '2023-10-16'),
(118, '30006', 'RHEA ELIZ ', 'SEBASTIAN', 'CARANGAN', 'F', 'RANK', 'Personnel', 'COMPENSATION AND BENEFITS ASSISTANT', '099 BAGONG SILANG, PLARIDEL, BULACAN', '1981-09-16', '2002-11-21', '30006', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '5', '', '2002-11-21'),
(119, '10035', 'LHARA', 'MERCADO', 'DE GUZMAN', 'F', 'SPVR', 'Purchasing', 'PURCHASING ASSISTANT', 'BOCAUE, BULACAN', '1980-10-17', '2002-07-31', '10035', '0192023a7bbd73250516f069df18b500', 'Purchasing', 'sample@gmail.com', '', './uploads/1711939680_277758480_1113259749232831_411113507218527592_n.jpg', '4', '', '2002-07-31'),
(120, '10187', 'AR-JOHN KEVIN', 'DELA CRUZ', 'AREVALO', 'M', 'RANK', 'Billing', 'BILLING ASSISTANT', '2313 FLORANTE STREET, SULOK PANGINAY, BALAGTAS BULACAN', '1998-06-29', '2023-10-18', '10187', '0192023a7bbd73250516f069df18b500', 'Billing', '', '', '', '5', '', '2023-10-18'),
(121, '10186', 'MARINETH', 'PONSARAN', 'RAMOS', 'F', 'RANK', 'Inventory Control', 'INVENTORY CONTROL ASSISTANT', 'SILVERDALE RESIDENCES, BLOCK 8, LOT 12 TANGOS, BALIUAG, BULACAN', '1984-05-06', '2023-10-16', '10186', '0192023a7bbd73250516f069df18b500', 'Inventory Control', '', '', '', '5', '', '2023-10-16'),
(122, '10132', 'JOVELYN KAREN', 'BAUTISTA', 'SANGALANG', 'F', 'RANK', 'CALS', 'CREDIT ASSESSMENT ASSISTANT', '155 PIO CRUZCOSA, CALUMPIT BULACAN', '1991-12-04', '2020-02-24', '10132', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '2020-02-24'),
(123, '10009', 'PRISCILA', 'DEPALOBOS', 'GARCIA', 'F', 'MNGR', 'Inventory Control', 'AVP - ASSET AND PROPERTY MANAGEMENT', '#397 MALAMIG , BUSTOS, BUL.', '1971-12-06', '1996-01-16', '10009', '0192023a7bbd73250516f069df18b500', 'Inventory Control', 'sample@gmail.com', '', './uploads/1711942920_79030239_117084656441477_986228429370163200_n.jpg', '3', '', '1996-01-16'),
(124, '20060', 'PACIFICO', 'FONBUENA', 'MANGARAN', 'M', 'RANK', 'General Services', 'COMPANY DRIVER', '#14 CANLAPAN ST., SAN JUAN, MALOLOS CITY', '1976-09-25', '2006-02-21', '20060', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2006-02-21'),
(125, '10030', 'GIEZL ANN', 'GUIAO', 'JACOBE', 'F', 'MNGR', 'Executive', 'FINANCE MANAGER/SR EA TO THE BOARD/INTERNAL AUDITOR', 'STA. INES, PLARIDEL, BUL.', '1981-01-12', '2001-11-06', '10030', '0192023a7bbd73250516f069df18b500', 'Executive', 'sample@gmail.com', '', './uploads/1711942860_127177718_10221597659423788_2419905270100035939_n.jpg', '3', '', '2001-11-06'),
(126, '10120', 'LOUISE SHEMAYNE', 'LUCAS', 'AMBON', 'F', 'RANK', 'Marketing', 'SALES OPERATION ASSOCIATE', '356 NIA ROAD, BARANGAY BARIHAN, MALOLOS CITY, BULACAN', '1986-11-10', '2019-06-03', '10120', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '5', '', '2019-06-03'),
(127, '20006', 'ROMEO ', 'VASQUEZ', 'DELA CRUZ', 'M', 'RANK', 'General Services', 'UTILITY', 'STA. RITA, GUIGUINTO, BULACAN', '1965-03-08', '1998-08-04', '20006', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '1998-08-04'),
(128, '10184', 'JOYCELYN', 'AGUINALDO', 'PEREZ', 'F', 'SPVR', 'Accounting', 'ASSISTANT ACCOUNTING MANAGER', '381 SAN MIGUEL, HAGONOY, BULACAN', '1980-04-26', '2023-09-18', '10184', '0192023a7bbd73250516f069df18b500', 'Accounting', 'sample@gmail.com', '', './uploads/1711345380_13012803_1408399165846541_5750550726095559741_n.jpg', '4', '', '2023-09-18'),
(129, '20205', 'ANGELOU', 'CLEMENTE', 'TALUCOD', 'F', 'RANK', 'Treasury', 'TREASURY ASSISTANT', '049 IBA-IBAYO, HAGONOY, BULACAN', '1997-07-19', '2018-05-14', '20205', '0192023a7bbd73250516f069df18b500', 'Treasury', '', '', '', '5', '', '2018-05-14'),
(130, '20204', 'FLARE', 'CATANGHAL', 'MENDIOLA', 'F', 'RANK', 'CALS', 'LOANS ASSISTANT', '18 PUROK 1 PIO CRUZCOSA, CALUMPIT, BULACAN', '1995-01-25', '2018-03-19', '20204', '0192023a7bbd73250516f069df18b500', 'CALS', '', '', '', '5', '', '2018-03-19'),
(131, '20087', 'LIEZL', 'SANCHEZ', 'SAN GABRIEL', 'F', 'RANK', 'IT', 'SUPPORT SPECIALIST', '#165 STO. CRISTO, PULILAN, BULACAN', '1983-12-02', '2008-03-03', '20087', '0192023a7bbd73250516f069df18b500', 'IT', 'sample@gmail.com', '', './uploads/1711338660_422705070_7910490018978872_1015629993610848243_n.jpg', '5', '', '2008-03-03'),
(132, '10173', 'SHARMAINE', 'ALEGRE', 'PANGINDIAN', 'F', 'RANK', 'Contracts and Doc.', 'HOUSING PERMITS ASSISTANT', '66 DON ANTONIO STREET SAN AGUSTIN MALOLOS BULACAN', '1994-01-27', '2023-06-13', '10173', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '5', '', '2023-06-13'),
(133, '10103', 'ZANDRO LEMUEL', 'SANTOS', 'GUSTILO', 'M', 'MNGR', 'Marketing', 'SALES DIRECTOR', '214 TAAL MALOLOS BULACAN', '1977-03-19', '2018-07-02', '10103', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '3', '', '2018-07-02'),
(134, '10167', 'JAYCELL ', 'CRISOSTOMO', 'SANTIAGO', 'F', 'RANK', 'Contracts and Doc.', 'CUSTOMER SERVICE REPRESENTATIVE', '337 PUROK 4 ALAKAN, STO.ROSARIO HAGONOY, BULACAN', '1997-10-28', '2023-02-28', '10167', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '5', '', '2023-02-28'),
(135, '20119', 'MELVIC', 'ALCANTARA', 'CUNTAPAY', 'M', 'RANK', 'General Services', 'UTILITY', 'B59 L8 PHASE 4 DCH SUBD., LONGOS, MAL. CITY', '1991-06-05', '2012-01-24', '20119', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2012-01-24'),
(136, '10139', 'LOIS JANE', 'CHUA', 'NICOLAS', 'F', 'RANK', 'Audit', 'AUDIT ASSISTANT', '1781 SABANA CAINGIN, BOCAUE BULACAN', '1995-12-31', '2021-01-05', '10139', '0192023a7bbd73250516f069df18b500', 'Audit', '', '', '', '5', '', '2021-01-05'),
(137, '20137', 'RODALISA', 'MAPUE', 'LEONARDO', 'F', 'RANK', 'Const. and Impln.', 'DEPARTMENT SECRETARY', '#354 BOROL 2ND, BALAGTAS, BUL.', '1975-05-04', '2013-01-21', '20137', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '5', '', '2013-01-21'),
(138, '10124', 'MARY GRACE', 'ORDINARIO', 'REYES', 'F', 'MNGR', 'Marketing', 'SALES MANAGER', '113 BARANGAY DULONG MALABON, PULILAN, BULACAN', '1976-03-14', '2019-09-02', '10124', '0192023a7bbd73250516f069df18b500', 'Marketing', '', '', '', '3', '', '2019-09-02'),
(139, '20139', 'SHEREE ANN', 'GERON', 'BARTOLOME', 'F', 'RANK', 'Accounting', 'ACCOUNTING ASSISTANT', '13 TAMBUBONG, LONGOS, MAL. CITY', '1978-09-20', '2013-05-29', '20139', '0192023a7bbd73250516f069df18b500', 'Accounting', 'sample@gmail.com', '', './uploads/1711338960_1709518860_80270911_2810119929050397_3043423287758553088_n.jpg', '5', '', '2013-05-29'),
(140, '10182', 'JENA KATRINA', 'ADRIANO', 'FUTOL', 'F', 'SPVR', 'Contracts and Doc.', 'HOUSING PERMITS SUPERVISOR', 'LA RESIDENCIA PHASE1, BLOCK 84, LOT8, ALAHADO STREET CALUMPIT, BULACAN', '1989-09-28', '2023-09-11', '10182', '0192023a7bbd73250516f069df18b500', 'Contracts and Doc.', '', '', '', '4', '', '2023-09-11'),
(141, '20100', 'MARIE KRIS', 'PASCUAL', 'BONDOC', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', '#40 STO. NINO, PLARIDEL, BULACAN', '1986-07-14', '2010-06-21', '20100', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2010-06-21'),
(142, '10121', 'LUISITO', 'ZACARIAS', 'VICTORIA', 'M', 'RANK', 'Repair and Maintenance', 'SITE INVENTORY ASSISTANT', '82 ENRIQUEZ STREET, SAN GABRIEL, MALOLOS CITY, BULACAN', '1980-11-12', '2019-08-19', '10121', '0192023a7bbd73250516f069df18b500', 'Repair and Maintenance', '', '', '', '5', '', '2019-08-19'),
(143, '10041', 'LIZETH', 'CASTRO', 'YSAIS', 'F', 'SPVR', 'Personnel', 'COMPENSATION AND BENEFITS OFFICER', 'B1 L8 PH1C GRAND ROYALE SUBD. BULIHAN, MALOLOS CITY, BULACAN', '1982-11-24', '2005-02-01', '10041', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '4', '', '2005-02-01'),
(144, '20084', 'MARY ANN', 'PASCUAL', 'BERNARDO', 'F', 'SPVR', 'Documentation and Loan', 'DOCUMENTATION SUPERVISOR', '262 PULO BARIHAN, MALOLOS CITY', '1978-11-05', '2008-02-08', '20084', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '4', '', '2008-02-08'),
(145, '10069', 'JAVIER FELIPE', 'QUINTOS', 'EBRO', 'M', 'MNGR', 'Executive', 'CHIEF EXECUTIVE OFFICER', '11 VIOLETA PERSA LOOP, VERDANA HOMES, MOLINO, BACOOR, CAVITE', '1960-08-23', '2014-11-04', '10069', '0192023a7bbd73250516f069df18b500', 'Executive', '', '', '', '3', '', '2014-11-04'),
(146, '10190', 'IRA JOY', 'DELOS REYES', 'BULAWAN', 'F', 'SPVR', 'Const. and Impln.', 'PROJECT SUPERVISOR', 'II PAG ASA STREET PATUBIG MARILAO, BULACAN', '1999-07-22', '2024-01-15', '10190', '0192023a7bbd73250516f069df18b500', 'Const. and Impln.', '', '', '', '4', '', '2024-01-15'),
(147, '10080', 'CONSUELO MARIE', 'BUHAIN', 'SANTOS', 'F', 'MNGR', 'Executive', 'PRESIDENT', '4024 TABANG, PLARIDEL, BULACAN', '1967-02-19', '2016-03-01', '10080', '0192023a7bbd73250516f069df18b500', 'Executive', '', '', '', '3', '', '2016-03-01'),
(148, '30008', 'MERLYN', 'DELOS SANTOS', 'PANGAN', 'F', 'SPVR', 'Personnel', 'TRAINING OFFICER', 'BLK3 LT10 PH5A DREAMCREST HOMES, LONGOS, MALOLOS CITY, BULACAN', '1978-07-10', '2003-03-25', '30008', '0192023a7bbd73250516f069df18b500', 'Personnel', '', '', '', '4', '', '2003-03-25'),
(149, '10055', 'CELINE ANGELICA', 'GONZALES', 'BUHAIN', 'F', 'MNGR', 'Finance', 'CHIEF FINANCE OFFICER', '4024 TABANG, PLARIDEL, BULACAN', '1988-10-09', '2011-01-03', '10055', '0192023a7bbd73250516f069df18b500', 'Finance', 'sample@gmail.com', '', './uploads/1711338720_89936502_10156913182905736_7992193865882796032_n.jpg', '3', '', '2011-01-03'),
(150, '20043', 'TEODULO ', 'FAUSTINO', 'DAYAO', 'M', 'RANK', 'General Services', 'MAINTENANCE COORDINATOR/COMPANY DRIVER', 'SAN ISIDRO 1ST, PAOMBONG, BULACAN', '1976-09-12', '2003-06-15', '20043', '0192023a7bbd73250516f069df18b500', 'General Services', '', '', '', '5', '', '2003-06-15'),
(151, '10191', 'RONALINE', 'SERAVANES', 'NARVAJA', 'F', 'RANK', 'Documentation and Loan', 'DOCUMENTATION ASSISTANT', 'GRAND ROYALE SUBD. PHASE 2. BLOCK 24, LOT 7, ROSE STREET BRGY. PINAGBAKAHAN, MALOLOS CITY, BULACAN', '1993-03-24', '2024-02-14', '10191', '0192023a7bbd73250516f069df18b500', 'Documentation and Loan', '', '', '', '5', '', '2024-02-14'),
(152, '10192', 'LESYL', 'LABADO', 'MAGSINO', 'F', 'RANK', 'Audit', 'AUDIT ASSISTANT', 'GRAND ROYALE SUBDIVISION PHASE 8D BLOCK 33 LOT 13 PETUNIA ST. BULIHAN MALOLOS CITY BULACAN', '1991-11-21', '2024-02-21', '10192', '0192023a7bbd73250516f069df18b500', 'Audit', '', '', '', '5', '', '2024-02-21'),
(153, '10108', 'MARJIAN', 'CATAHAN', 'CANTA', 'F', 'RANK', 'Corporate Communications', 'SR. CORPORATE COMMUNICATIONS ASSOCIATE', '78 SAN MARCOS, CALUMPIT, BULACAN', '1993-04-24', '2018-09-26', '10108', '0192023a7bbd73250516f069df18b500', 'Corporate Communications', '', '', '', '5', '', '2018-09-26'),
(154, '10166', 'RAPHAEL MATTHEW', 'GONZALES', 'BUHAIN', 'M', 'MNGR', 'Engineering', 'EMERGING TECHNOLOGIES RESEARCH AND INTEGRATION MANAGER', '4024 ST. JAMES ROAD, TABANG PLARIDEL, BULACAN', '1997-10-14', '2023-02-01', '10166', '0192023a7bbd73250516f069df18b500', 'Engineering', '', '', '', '3', '', '2023-02-01'),
(155, '20124', 'MARIA RACHEL', 'JAVIER', 'LUMAGUE', 'F', 'SPVR', 'Executive', 'EA TO THE MANCOM', '#0152 LUMANG BAYAN, PLARIDEL, BUL.', '1989-01-10', '2012-03-07', '20124', '0192023a7bbd73250516f069df18b500', 'Executive', 'sample@gmail.com', '09898171661', './uploads/1711330560_246018831_10221873932743114_8120496461198630141_n.jpg', '4', '', '2012-03-07'),
(156, '10090', 'FELYNE ANGELI', 'GONZALES', 'BUHAIN', 'F', 'MNGR', 'Finance', 'VICE-PRESIDENT FOR INVENTORY CONTROL', '4024 TABANG, PLARIDEL, BULACAN', '1995-12-09', '2016-12-01', '10090', '0192023a7bbd73250516f069df18b500', 'Accounting', 'sample@gmail.com', '', './uploads/1711943160_280361754_10222111330509156_4370644619727377572_n.jpg', '1', 'IT Admin', '2016-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `vs_entries`
--

CREATE TABLE `vs_entries` (
  `v_num` int(11) NOT NULL,
  `po_no` text NOT NULL,
  `paid_to` int(11) NOT NULL COMMENT '1-employee/2-agent/3-supplier',
  `supplier_id` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `journal_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `description` text NOT NULL,
  `ref_no` text DEFAULT NULL,
  `rfp_no` text NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `c_status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vs_entries`
--

INSERT INTO `vs_entries` (`v_num`, `po_no`, `paid_to`, `supplier_id`, `name`, `journal_date`, `bill_date`, `due_date`, `description`, `ref_no`, `rfp_no`, `user_id`, `c_status`, `date_created`, `date_updated`) VALUES
(1, '', 0, '112140', '', '2024-04-12', NULL, '2024-04-19', 'TEST AGENT', '', '', '20175', 1, '2024-04-12 13:52:14', '2024-04-12 14:50:58'),
(2, '', 0, '20069', '', '2024-04-12', NULL, '2024-04-19', 'TEST EMPLOYEE', '', '', '20175', 1, '2024-04-12 13:54:58', '2024-04-12 14:51:19'),
(3, '', 0, '2493031335953', '', '2024-04-12', NULL, '2024-04-19', 'TEST CLIENT', '', '', '20175', 1, '2024-04-12 13:56:37', '2024-04-12 14:53:11'),
(4, '', 0, '35', '', '2024-04-12', NULL, '2024-04-19', 'TEST', '', '', '20175', 1, '2024-04-12 13:57:43', '2024-04-12 14:52:19'),
(5, '671', 0, '39', '', '2024-04-12', '2024-04-12', '0000-00-00', 'TEST', '', '', NULL, 1, '2024-04-12 14:49:27', '2024-04-12 14:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `vs_items`
--

CREATE TABLE `vs_items` (
  `id` int(11) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `journal_id` int(30) NOT NULL,
  `doc_no` text NOT NULL,
  `account_id` int(30) NOT NULL,
  `group_id` int(30) NOT NULL,
  `phase` varchar(30) NOT NULL,
  `block` varchar(30) NOT NULL,
  `lot` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vs_items`
--

INSERT INTO `vs_items` (`id`, `gr_id`, `journal_id`, `doc_no`, `account_id`, `group_id`, `phase`, `block`, `lot`, `amount`) VALUES
(7382, 0, 1, '200001', 21044, 0, '', '', '', 25000.00),
(7383, 0, 1, '200001', 21002, 0, '', '', '', -25000.00),
(7384, 0, 2, '200002', 11093, 0, '', '', '', 56000.00),
(7385, 0, 2, '200002', 21002, 0, '', '', '', -56000.00),
(7386, 0, 3, '200003', 11017, 0, '', '', '', 23340.00),
(7387, 0, 3, '200003', 21002, 0, '', '', '', -23340.00),
(7388, 0, 4, '200004', 11012, 0, '', '', '', 12440.00),
(7389, 0, 4, '200004', 21002, 0, '', '', '', -12440.00),
(7390, 2530, 5, '200005', 20147, 4, '152', '', '', 16025.62),
(7391, 2530, 5, '200005', 21032, 4, '152', '', '', 144.38),
(7392, 2530, 5, '200005', 11076, 1, '152', '', '', 1732.50),
(7393, 2530, 5, '200005', 21002, 4, '152', '', '', 16025.62),
(7394, 2530, 5, '200005', 11081, 1, '152', '', '', 1732.50),
(7395, 2530, 5, '200005', 21012, 4, '152', '', '', 144.38);

-- --------------------------------------------------------

--
-- Structure for view `t_csr_view`
--
DROP TABLE IF EXISTS `t_csr_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `t_csr_view`  AS SELECT `q`.`c_acronym` AS `c_acronym`, `z`.`c_block` AS `c_block`, `z`.`c_lot` AS `c_lot`, `y`.`last_name` AS `last_name`, `y`.`first_name` AS `first_name`, `y`.`middle_name` AS `middle_name`, `y`.`suffix_name` AS `suffix_name`, `x`.`c_csr_no` AS `c_csr_no`, `x`.`ref_no` AS `ref_no`, `x`.`c_lot_lid` AS `c_lot_lid`, `x`.`c_type` AS `c_type`, `x`.`c_date_of_sale` AS `c_date_of_sale`, `x`.`c_lot_area` AS `c_lot_area`, `x`.`c_price_sqm` AS `c_price_sqm`, `x`.`c_lot_discount` AS `c_lot_discount`, `x`.`c_lot_discount_amt` AS `c_lot_discount_amt`, `x`.`c_house_model` AS `c_house_model`, `x`.`c_floor_area` AS `c_floor_area`, `x`.`c_house_price_sqm` AS `c_house_price_sqm`, `x`.`c_linear` AS `c_linear`, `x`.`c_fence_price_sqm` AS `c_fence_price_sqm`, `x`.`c_processing_fee` AS `c_processing_fee`, `x`.`c_less` AS `c_less`, `x`.`pf_mo` AS `pf_mo`, `x`.`c_house_discount` AS `c_house_discount`, `x`.`c_house_discount_amt` AS `c_house_discount_amt`, `x`.`c_tcp_discount` AS `c_tcp_discount`, `x`.`c_tcp_discount_amt` AS `c_tcp_discount_amt`, `x`.`c_tcp` AS `c_tcp`, `x`.`c_vat_amount` AS `c_vat_amount`, `x`.`c_net_tcp` AS `c_net_tcp`, `x`.`c_reservation` AS `c_reservation`, `x`.`c_payment_type1` AS `c_payment_type1`, `x`.`c_payment_type2` AS `c_payment_type2`, `x`.`c_down_percent` AS `c_down_percent`, `x`.`c_net_dp` AS `c_net_dp`, `x`.`c_no_payments` AS `c_no_payments`, `x`.`c_monthly_down` AS `c_monthly_down`, `x`.`c_first_dp` AS `c_first_dp`, `x`.`c_full_down` AS `c_full_down`, `x`.`c_amt_financed` AS `c_amt_financed`, `x`.`c_terms` AS `c_terms`, `x`.`c_interest_rate` AS `c_interest_rate`, `x`.`c_fixed_factor` AS `c_fixed_factor`, `x`.`c_monthly_payment` AS `c_monthly_payment`, `x`.`c_start_date` AS `c_start_date`, `x`.`c_remarks` AS `c_remarks`, `x`.`c_date_created` AS `c_date_created`, `x`.`c_date_updated` AS `c_date_updated`, `x`.`c_created_by` AS `c_created_by`, `x`.`c_verify` AS `c_verify`, `x`.`coo_approval` AS `coo_approval`, `x`.`c_revised` AS `c_revised`, `x`.`c_active` AS `c_active`, `x`.`old_property_id` AS `old_property_id` FROM (((`t_csr` `x` join `t_csr_buyers` `y`) join `t_lots` `z`) join `t_projects` `q`) WHERE `x`.`c_csr_no` = `y`.`c_csr_no` AND `x`.`c_lot_lid` = `z`.`c_lid` AND `z`.`c_site` = `q`.`c_code` AND `y`.`c_buyer_count` = 1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_order_items`
--
ALTER TABLE `approved_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_details`
--
ALTER TABLE `check_details`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `cv_entries`
--
ALTER TABLE `cv_entries`
  ADD PRIMARY KEY (`c_num`);

--
-- Indexes for table `cv_items`
--
ALTER TABLE `cv_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `group_list`
--
ALTER TABLE `group_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jv_entries`
--
ALTER TABLE `jv_entries`
  ADD PRIMARY KEY (`jv_num`);

--
-- Indexes for table `jv_items`
--
ALTER TABLE `jv_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_tbl`
--
ALTER TABLE `message_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_no` (`item_id`);

--
-- Indexes for table `or_logs`
--
ALTER TABLE `or_logs`
  ADD PRIMARY KEY (`or_id`);

--
-- Indexes for table `payment_terms`
--
ALTER TABLE `payment_terms`
  ADD PRIMARY KEY (`terms_indicator`);

--
-- Indexes for table `pending_restructuring`
--
ALTER TABLE `pending_restructuring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_approved_list`
--
ALTER TABLE `po_approved_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_list`
--
ALTER TABLE `po_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `property_clients`
--
ALTER TABLE `property_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `property_payments`
--
ALTER TABLE `property_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `subsidiary_accounts`
--
ALTER TABLE `subsidiary_accounts`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gl_items`
--
ALTER TABLE `tbl_gl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gl_list`
--
ALTER TABLE `tbl_gl_list`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `tbl_gl_trans`
--
ALTER TABLE `tbl_gl_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grn_batch`
--
ALTER TABLE `tbl_grn_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grn_items`
--
ALTER TABLE `tbl_grn_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gr_list`
--
ALTER TABLE `tbl_gr_list`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `tbl_restructuring`
--
ALTER TABLE `tbl_restructuring`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `tbl_rfp`
--
ALTER TABLE `tbl_rfp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rfp_approvals`
--
ALTER TABLE `tbl_rfp_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vs_attachments`
--
ALTER TABLE `tbl_vs_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_agents`
--
ALTER TABLE `t_agents`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  ADD PRIMARY KEY (`ra_id`);

--
-- Indexes for table `t_av_breakdown`
--
ALTER TABLE `t_av_breakdown`
  ADD PRIMARY KEY (`av_id`);

--
-- Indexes for table `t_av_summary`
--
ALTER TABLE `t_av_summary`
  ADD PRIMARY KEY (`av_id`);

--
-- Indexes for table `t_buyer_info`
--
ALTER TABLE `t_buyer_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_ca_requirement`
--
ALTER TABLE `t_ca_requirement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_credit_memo`
--
ALTER TABLE `t_credit_memo`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `t_csr`
--
ALTER TABLE `t_csr`
  ADD PRIMARY KEY (`c_csr_no`);

--
-- Indexes for table `t_csr_buyers`
--
ALTER TABLE `t_csr_buyers`
  ADD PRIMARY KEY (`buyer_id`);

--
-- Indexes for table `t_csr_comments`
--
ALTER TABLE `t_csr_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `t_csr_commission`
--
ALTER TABLE `t_csr_commission`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `t_lots`
--
ALTER TABLE `t_lots`
  ADD PRIMARY KEY (`c_lid`);

--
-- Indexes for table `t_model_house`
--
ALTER TABLE `t_model_house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_network_division`
--
ALTER TABLE `t_network_division`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_projects`
--
ALTER TABLE `t_projects`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_reservation`
--
ALTER TABLE `t_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vs_entries`
--
ALTER TABLE `vs_entries`
  ADD PRIMARY KEY (`v_num`);

--
-- Indexes for table `vs_items`
--
ALTER TABLE `vs_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `approved_order_items`
--
ALTER TABLE `approved_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2715;

--
-- AUTO_INCREMENT for table `check_details`
--
ALTER TABLE `check_details`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cv_items`
--
ALTER TABLE `cv_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2113;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1633;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group_list`
--
ALTER TABLE `group_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `jv_items`
--
ALTER TABLE `jv_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `message_tbl`
--
ALTER TABLE `message_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3914;

--
-- AUTO_INCREMENT for table `or_logs`
--
ALTER TABLE `or_logs`
  MODIFY `or_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `payment_terms`
--
ALTER TABLE `payment_terms`
  MODIFY `terms_indicator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pending_restructuring`
--
ALTER TABLE `pending_restructuring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `po_approved_list`
--
ALTER TABLE `po_approved_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;

--
-- AUTO_INCREMENT for table `po_list`
--
ALTER TABLE `po_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1610100931102;

--
-- AUTO_INCREMENT for table `property_clients`
--
ALTER TABLE `property_clients`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2495120998823;

--
-- AUTO_INCREMENT for table `property_payments`
--
ALTER TABLE `property_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `subsidiary_accounts`
--
ALTER TABLE `subsidiary_accounts`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `tbl_gl_items`
--
ALTER TABLE `tbl_gl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_gl_list`
--
ALTER TABLE `tbl_gl_list`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `tbl_gl_trans`
--
ALTER TABLE `tbl_gl_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8224;

--
-- AUTO_INCREMENT for table `tbl_grn_batch`
--
ALTER TABLE `tbl_grn_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_grn_items`
--
ALTER TABLE `tbl_grn_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `tbl_gr_list`
--
ALTER TABLE `tbl_gr_list`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2536;

--
-- AUTO_INCREMENT for table `tbl_rfp`
--
ALTER TABLE `tbl_rfp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `tbl_rfp_approvals`
--
ALTER TABLE `tbl_rfp_approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=457;

--
-- AUTO_INCREMENT for table `tbl_vs_attachments`
--
ALTER TABLE `tbl_vs_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=876;

--
-- AUTO_INCREMENT for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `t_agents`
--
ALTER TABLE `t_agents`
  MODIFY `c_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113001;

--
-- AUTO_INCREMENT for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  MODIFY `ra_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `t_av_breakdown`
--
ALTER TABLE `t_av_breakdown`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `t_av_summary`
--
ALTER TABLE `t_av_summary`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `t_buyer_info`
--
ALTER TABLE `t_buyer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `t_ca_requirement`
--
ALTER TABLE `t_ca_requirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_credit_memo`
--
ALTER TABLE `t_credit_memo`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174356;

--
-- AUTO_INCREMENT for table `t_csr`
--
ALTER TABLE `t_csr`
  MODIFY `c_csr_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `t_csr_buyers`
--
ALTER TABLE `t_csr_buyers`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `t_csr_comments`
--
ALTER TABLE `t_csr_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_csr_commission`
--
ALTER TABLE `t_csr_commission`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_lots`
--
ALTER TABLE `t_lots`
  MODIFY `c_lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `t_model_house`
--
ALTER TABLE `t_model_house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_network_division`
--
ALTER TABLE `t_network_division`
  MODIFY `c_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `t_projects`
--
ALTER TABLE `t_projects`
  MODIFY `c_code` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=679;

--
-- AUTO_INCREMENT for table `t_reservation`
--
ALTER TABLE `t_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `vs_items`
--
ALTER TABLE `vs_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7396;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `po_list`
--
ALTER TABLE `po_list`
  ADD CONSTRAINT `po_list_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
