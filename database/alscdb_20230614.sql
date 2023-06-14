-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 03:06 AM
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
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Cash', 'Cash', 1, 0, '2022-02-01 10:09:26', NULL),
(2, 'Petty Cash', 'Petty Cash', 1, 0, '2022-02-01 10:09:40', NULL),
(3, 'Cash Equivalents', 'Cash Equivalents', 1, 0, '2022-02-01 10:09:56', NULL),
(4, 'Accounts Receivable', 'Accounts Receivable', 1, 0, '2022-02-01 10:10:22', NULL),
(5, 'Interest Receivable', 'Interest Receivable', 1, 0, '2022-02-01 10:10:57', NULL),
(6, 'Office Supplies', 'Office Supplies', 1, 0, '2022-02-01 10:11:13', NULL),
(7, 'Accounts Payable', 'Accounts Payable', 1, 0, '2022-02-01 10:11:55', NULL),
(8, 'Insurance Payable', 'Insurance Payable', 1, 0, '2022-02-01 10:12:07', NULL),
(9, 'Interest Payable', 'Interest Payable', 1, 0, '2022-02-01 10:12:20', NULL),
(10, 'Legal Fees Payable', 'Legal Fees Payable', 1, 0, '2022-02-01 10:12:35', NULL),
(11, 'Office Salaries Payable', 'Office Salaries Payable', 1, 0, '2022-02-01 10:12:51', NULL),
(12, 'Salaries Payable', 'Salaries Payable', 1, 0, '2022-02-01 10:13:03', NULL),
(13, 'Wages Payable', 'Wages Payable', 1, 0, '2022-02-01 10:13:24', NULL),
(14, 'Owner’s Capital', 'Owner’s Capital', 1, 0, '2022-02-01 10:13:54', NULL),
(15, 'Owner’s Withdrawals', 'Owner’s Withdrawals', 1, 0, '2022-02-01 10:14:04', NULL),
(16, 'Common Stock, Par Value', 'Common Stock, Par Value', 1, 0, '2022-02-01 10:14:25', NULL),
(17, 'Common stock, no par value', 'Common stock, no par value', 1, 0, '2022-02-01 10:14:34', NULL),
(18, 'Common stock dividend distributable', 'Common stock dividend distributable', 1, 0, '2022-02-01 10:14:50', NULL),
(19, 'Paid-in capital in excess of par value, Common stock', 'Paid-in capital in excess of par value, Common\r\nstock', 1, 0, '2022-02-01 10:15:02', NULL),
(20, 'Paid-in capital in excess of stated value, No-par common stock', 'Paid-in capital in excess of stated value, No-par\r\ncommon stock', 1, 0, '2022-02-01 10:15:11', NULL),
(21, 'Retained earnings', 'Retained earnings', 1, 0, '2022-02-01 10:15:31', NULL),
(22, 'Cash dividends', 'Cash dividends', 1, 0, '2022-02-01 10:15:44', NULL),
(23, 'Stock dividends', 'Stock dividends', 1, 0, '2022-02-01 10:15:58', NULL),
(24, 'Treasury stock, Common', 'Treasury stock, Common', 1, 0, '2022-02-01 10:16:48', NULL),
(25, 'Unrealized gain-Equity', 'Unrealized gain-Equity', 1, 0, '2022-02-01 10:16:57', NULL),
(26, 'Unrealized loss-Equity', 'Unrealized loss-Equity', 1, 0, '2022-02-01 10:17:05', NULL),
(27, 'Fees earned from product one', 'Fees earned from product one', 1, 0, '2022-02-01 10:17:27', NULL),
(28, 'Fees earned from product two', 'Fees earned from product two', 1, 0, '2022-02-01 10:17:43', NULL),
(29, 'Service revenue one', 'Service revenue one', 1, 0, '2022-02-01 10:17:55', NULL),
(30, 'Service revenue two', 'Service revenue two', 1, 0, '2022-02-01 10:18:04', NULL),
(31, 'Commissions earned', 'Commissions earned', 1, 0, '2022-02-01 10:18:14', NULL),
(32, 'Rent revenue', 'Rent revenue', 1, 0, '2022-02-01 10:18:26', NULL),
(33, 'Dividends revenue', 'Dividends revenue', 1, 0, '2022-02-01 10:18:40', NULL),
(34, 'Earnings from investments in “blank”', 'Earnings from investments in “blank”', 1, 0, '2022-02-01 10:18:51', NULL),
(35, 'Interest revenue', 'Interest revenue', 1, 0, '2022-02-01 10:19:03', NULL),
(36, 'Sinking fund earnings', 'Sinking fund earnings', 1, 0, '2022-02-01 11:41:57', NULL),
(37, 'Amortization expense', 'Amortization expense', 1, 0, '2022-02-01 11:42:08', NULL),
(38, 'Depletion expense', 'Depletion expense', 1, 0, '2022-02-01 11:42:16', NULL),
(39, 'Depreciation expense-Automobiles', 'Depreciation expense-Automobiles', 1, 0, '2022-02-01 11:42:25', NULL),
(40, 'Depreciation expense-Building', 'Depreciation expense-Building', 1, 0, '2022-02-01 11:42:34', NULL),
(41, 'Depreciation expense-Furniture', 'Depreciation expense-Furniture', 1, 0, '2022-02-01 11:43:02', NULL),
(42, 'Office salaries expense', 'Office salaries expense', 1, 0, '2022-02-01 11:43:12', NULL),
(43, 'Sales salaries expense', 'Sales salaries expense', 1, 0, '2022-02-01 11:43:21', NULL),
(44, 'Salaries expense', 'Salaries expense', 1, 0, '2022-02-01 11:43:31', NULL),
(45, 'Income taxes expense', 'Income taxes expense', 1, 0, '2022-02-01 11:43:44', NULL),
(46, 'Warranty expense', 'Warranty expense', 1, 0, '2022-02-01 11:44:01', NULL),
(47, 'Utilities expense', 'Utilities expense', 1, 0, '2022-02-01 11:44:10', NULL),
(48, 'Selling expense', 'Selling expense', 1, 0, '2022-02-01 11:44:23', NULL),
(49, 'Sample101', 'Sample101', 0, 1, '2022-02-01 11:45:03', '2022-02-01 11:45:23'),
(50, 'Sample 01', 'Sample 01', 1, 1, '2023-06-05 16:39:10', '2023-06-05 16:43:54'),
(51, 'Sample', 'Sample', 1, 0, '2023-06-05 16:39:26', NULL),
(52, 'Sample1', 'Sample1', 1, 0, '2023-06-06 09:29:09', NULL),
(53, 'Sample2', 'Sample2', 1, 0, '2023-06-06 09:30:53', NULL),
(54, 'dsdsd', 'adds', 0, 0, '2023-06-06 09:51:24', NULL),
(55, '1212', '1211313', 0, 1, '2023-06-06 09:56:50', '2023-06-06 10:00:07'),
(56, '131313', '13132', 0, 1, '2023-06-06 09:57:01', '2023-06-06 10:00:16'),
(57, '1314255', '1231313', 1, 1, '2023-06-06 09:57:55', '2023-06-06 10:31:29'),
(58, '131414', '31313', 0, 1, '2023-06-06 09:59:13', '2023-06-06 10:00:22'),
(59, '31313', '31313', 1, 1, '2023-06-06 09:59:51', '2023-06-06 10:31:25'),
(60, '1212', '12121212', 0, 1, '2023-06-06 10:12:55', '2023-06-06 10:17:26'),
(61, '131313', 'qe213', 0, 1, '2023-06-06 10:13:04', '2023-06-06 10:17:29');

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
(20, 2390082879460, 2, 'MAMANTA', 'JOANNA MARIE', 'JULIANO', '', '0734 SUCOL SAN SEBASTIEN, HAGONOY, BULACAN', '3002', '  ', '1990-01-01', 32, '  ', 'F', 'Married', 'FILIPINO', 'UMID', '12345678', 'joannamariemamanta@gmail.com', '09694842560', '', 0),
(21, 2394122522193, 0, 'DELA CRUZ', 'JOMAR', 'PANGILINAN', '', 'SANTOL, BALAGTAS, BULACAN', '3016', '', '1994-12-25', 28, '12345667', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305512', '', NULL),
(22, 2396050160796, 2, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', '  ', '1978-07-12', 44, '  ', 'F', 'Single', 'Filipino', '', '', 'cutiepiesol@yahoo.com', '012121313131', '', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_list`
--

INSERT INTO `group_list` (`id`, `name`, `description`, `type`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Assets', 'The cash, inventory, and other resources you owned.', 1, 1, 0, '2022-02-01 09:56:35', '2022-02-01 09:56:58'),
(2, 'Revenue', 'Cash coming into your business through sales and other types of payments', 2, 1, 0, '2022-02-01 09:57:45', NULL),
(3, 'Expenses', 'The amount you’re spending on services and other items, like payroll, utility bills, and fees for contractors.', 1, 1, 0, '2022-02-01 09:58:09', '2022-02-01 09:59:13'),
(4, 'Liabilities', 'The money you still owe on loans, debts, and other obligations.', 2, 1, 0, '2022-02-01 09:58:34', NULL),
(5, 'Equity', 'How much is remaining after you subtract liabilities from assets.', 2, 1, 0, '2022-02-01 09:59:05', NULL),
(6, 'Dividend', 'Form of income that shareholders of corporations receive for each share of stock that they hold.', 1, 1, 0, '2022-02-01 10:00:13', NULL),
(7, 'Sample101', 'Sample', 1, 0, 1, '2022-02-01 10:01:35', '2022-02-01 10:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `journal_date` date NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `code`, `journal_date`, `description`, `user_id`, `date_created`, `date_updated`) VALUES
(3, '202306-00001', '2023-06-01', 'Capital', 1, '2023-06-05 00:00:00', '2023-06-06 13:11:52'),
(4, '202306-00002', '2023-06-01', 'Sample', 1, '2023-06-05 00:00:00', '2023-06-06 13:12:06'),
(5, '202306-00003', '2023-06-01', 'Sample 102', 1, '2023-06-05 00:00:00', '2023-06-06 13:12:08'),
(8, '202306-00001', '2023-06-06', 'Sample 101', 1, '2023-06-06 08:55:37', '2023-06-06 13:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `journal_items`
--

CREATE TABLE `journal_items` (
  `journal_id` int(30) NOT NULL,
  `account_id` int(30) NOT NULL,
  `group_id` int(30) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_items`
--

INSERT INTO `journal_items` (`journal_id`, `account_id`, `group_id`, `amount`, `date_created`) VALUES
(3, 1, 1, 15000, '2022-02-01 14:52:56'),
(3, 14, 5, 15000, '2022-02-01 14:52:56'),
(4, 42, 3, 5000, '2022-02-01 15:55:46'),
(4, 11, 4, 5000, '2022-02-01 15:55:46'),
(5, 31, 2, 5000, '2022-02-01 15:59:34'),
(5, 31, 2, 3000, '2022-02-01 15:59:34'),
(5, 4, 1, 8000, '2022-02-01 15:59:34'),
(8, 4, 1, 1000, '2023-06-06 08:55:37'),
(8, 1, 4, 1000, '2023-06-06 08:55:37');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `or_logs`
--

INSERT INTO `or_logs` (`or_id`, `property_id`, `pay_date`, `or_no`, `amount_paid`, `amount_due`, `surcharge`, `interest`, `principal`, `rebate`, `remaining_balance`, `mode_of_payment`, `user`, `gen_time`, `check_date`, `branch`, `particulars`, `check_number`, `status`) VALUES
(26, 1413001901101, '2020-06-08', '395273', '22209.00', '22207.66', '0.00', '0.00', '22209.00', '0.00', '2722791.00', '-1', 'admin', '2023-05-11 09:34:53', '0000-00-00', '', '', '', 1),
(27, 1413001901101, '2020-06-08', '395274', '22209.00', '22206.99', '0.00', '0.00', '22209.00', '0.00', '2700582.00', '-1', 'admin', '2023-05-11 09:39:50', '0000-00-00', '', '', '', 1),
(28, 1413001901101, '2020-07-27', '397428', '66627.00', '22204.98', '0.00', '0.00', '66627.00', '0.00', '2633955.00', '-1', 'admin', '2023-05-11 09:43:25', '0000-00-00', '', '', '', 1),
(29, 1413001901101, '2020-08-25', '398465', '22209.00', '22204.31', '0.00', '0.00', '22209.00', '0.00', '2611746.00', '-1', 'admin', '2023-05-11 09:44:30', '0000-00-00', '', '', '', 1),
(30, 1413001901101, '2020-09-25', '399658', '22209.00', '22203.64', '0.00', '0.00', '22209.00', '0.00', '2589537.00', '-1', 'admin', '2023-05-11 09:45:02', '0000-00-00', '', '', '', 1),
(31, 1413001901101, '2020-10-26', '400754', '22209.00', '22202.97', '0.00', '0.00', '22209.00', '0.00', '2567328.00', '-1', 'admin', '2023-05-11 09:45:30', '0000-00-00', '', '', '', 1),
(32, 1413001901101, '2020-11-25', '401902', '22209.00', '22202.30', '0.00', '0.00', '22209.00', '0.00', '2545119.00', '-1', 'admin', '2023-05-11 09:45:56', '0000-00-00', '', '', '', 1),
(33, 1413001901101, '2020-12-23', '402923', '22209.00', '22201.63', '0.00', '0.00', '22209.00', '0.00', '2522910.00', '-1', 'admin', '2023-05-11 09:46:31', '0000-00-00', '', '', '', 1),
(34, 1413001901101, '2021-01-25', '404230', '22209.00', '22200.96', '0.00', '0.00', '22209.00', '0.00', '2500701.00', '-1', 'admin', '2023-05-11 09:53:49', '0000-00-00', '', '', '', 1),
(35, 1413001901101, '2021-02-24', '405295', '22209.00', '22200.29', '0.00', '0.00', '22209.00', '0.00', '2478492.00', '-1', 'admin', '2023-05-11 09:54:48', '0000-00-00', '', '', '', 1),
(36, 1413001901101, '2021-03-25', '407107', '22209.00', '22199.62', '0.00', '0.00', '22209.00', '0.00', '2456283.00', '-1', 'admin', '2023-05-11 09:56:51', '0000-00-00', '', '', '', 1),
(37, 1413001901101, '2021-04-26', '408865', '22209.00', '22198.95', '0.00', '0.00', '22209.00', '0.00', '2434074.00', '-1', 'admin', '2023-05-11 09:57:39', '0000-00-00', '', '', '', 1),
(39, 1413001901101, '2021-05-25', '409899', '22209.00', '22198.28', '0.00', '0.00', '22209.00', '0.00', '2411865.00', '-1', 'admin', '2023-05-11 10:04:33', '0000-00-00', '', '', '', 1),
(40, 1413001901101, '2021-07-27', '412366', '44418.00', '22196.94', '0.00', '0.00', '44418.00', '0.00', '2367447.00', '-1', 'admin', '2023-05-11 10:09:53', '0000-00-00', '', '', '', 1),
(41, 1413001901101, '2021-08-25', '413465', '22209.00', '22196.27', '0.00', '0.00', '22209.00', '0.00', '2345238.00', '-1', 'admin', '2023-05-11 10:11:38', '0000-00-00', '', '', '', 1),
(45, 1413001901101, '2021-09-27', '414786', '22209.00', '22195.60', '0.00', '0.00', '22209.00', '0.00', '2323029.00', '-1', 'admin', '2023-05-11 10:20:40', '0000-00-00', '', '', '', 1),
(46, 1413001901101, '2021-11-25', '416974', '44418.00', '22194.26', '0.00', '0.00', '44418.00', '0.00', '2278611.00', '-1', 'admin', '2023-05-11 10:21:37', '0000-00-00', '', '', '', 1),
(47, 1413001901101, '2021-12-27', '418040', '22209.00', '22193.59', '0.00', '0.00', '22209.00', '0.00', '2256402.00', '-1', 'admin', '2023-05-11 10:22:14', '0000-00-00', '', '', '', 1),
(48, 1413001901101, '2022-01-25', '418999', '22209.00', '22193.00', '0.00', '0.00', '22209.00', '0.00', '2234193.00', '-1', 'admin', '2023-05-11 10:25:05', '0000-00-00', '', '', '', 1),
(49, 1413001901101, '2022-02-24', '421210', '22209.00', '44057.90', '0.00', '16.00', '22193.00', '0.00', '2212000.00', '-1', 'admin', '2023-05-11 10:25:40', '0000-00-00', '', '', '', 0),
(50, 1413001901101, '2022-02-24', '421210', '22193.00', '45204.00', '0.00', '0.00', '22193.00', '0.00', '2212000.00', '-1', 'admin', '2023-05-11 10:30:18', '0000-00-00', '', '', '', 0),
(51, 1413001901101, '2022-02-24', '1213313', '150000.00', '45204.00', '0.00', '0.00', '150000.00', '0.00', '2062000.00', '-1', 'admin', '2023-05-11 10:30:41', '0000-00-00', '', '', '', 0),
(52, 1413001901101, '2022-02-24', '421210', '22209.00', '45204.00', '0.00', '0.00', '22209.00', '0.00', '2211984.00', '-1', 'admin', '2023-05-11 10:36:05', '0000-00-00', '', '', '', 1),
(53, 1413001901101, '2022-04-25', '424657', '90408.00', '45204.00', '0.00', '62476.42', '27931.58', '0.00', '2184052.42', '-1', 'admin', '2023-05-11 10:46:50', '0000-00-00', '', '', '', 1),
(54, 1413001901101, '2022-04-25', '131414', '88147.80', '45204.00', '0.00', '61679.42', '26468.38', '2260.20', '2155323.84', '-1', 'admin', '2023-05-11 10:49:51', '0000-00-00', '', '', '', 0),
(55, 1413001901101, '2022-06-06', '431802', '45204.00', '904.08', '904.08', '30940.74', '13359.18', '0.00', '2170693.24', '-1', 'admin', '2023-05-11 11:06:49', '0000-00-00', '', '', '', 1),
(56, 1413001901101, '2022-06-08', '431849', '904.08', '45204.00', '0.00', '0.00', '904.08', '0.00', '2169789.16', '-1', 'admin', '2023-05-11 11:28:28', '0000-00-00', '', '', '', 1),
(57, 1413001901101, '2022-07-27', '426009', '47623.00', '45195.88', '2410.88', '30746.80', '14465.32', '0.00', '2155323.84', '-1', 'admin', '2023-05-11 11:29:15', '0000-00-00', '', '', '', 0),
(58, 1413001901101, '2022-07-27', '426009', '47623.00', '45204.00', '2410.88', '30738.68', '14473.44', '0.00', '2155315.72', '-1', 'admin', '2023-05-11 11:32:00', '0000-00-00', '', '', '', 0),
(59, 1413001901101, '2022-11-05', '429352', '52500.00', '464.02', '7760.02', '30533.64', '14206.34', '0.00', '2141109.38', '-1', 'admin', '2023-05-11 11:38:18', '0000-00-00', '', '', '', 1),
(60, 1413001901101, '2023-03-22', '442073', '285110.56', '33926.98', '47349.52', '160768.25', '76992.79', '0.00', '2064116.59', '-1', 'admin', '2023-05-11 13:21:18', '0000-00-00', '', '', '', 1),
(61, 1214500602101, '2023-05-04', '1212', '8840.49', '9043.98', '0.00', '4752.00', '4088.49', '203.49', '375868.02', '-1', 'admin', '2023-05-25 11:02:39', '0000-00-00', '', '', '', 1),
(62, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 11:55:24', '0000-00-00', '', '', '', 1),
(63, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 11:55:32', '0000-00-00', '', '', '', 1),
(64, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 11:59:56', '0000-00-00', '', '', '', 1),
(65, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 12:00:42', '0000-00-00', '', '', '', 1),
(66, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 12:00:54', '0000-00-00', '', '', '', 1),
(67, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 12:01:13', '0000-00-00', '', '', '', 1),
(68, 1214500402101, '2023-06-08', '3141414', '5773.33', '5773.33', '0.00', '0.00', '5773.33', '0.00', '420626.67', '-1', 'admin', '2023-06-08 12:01:36', '0000-00-00', '', '', '', 1);

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
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive,\r\n1 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `c_csr_no`, `project_id`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_balance`, `c_account_status`, `c_account_type`, `c_account_type1`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_retention`, `c_reopen`, `c_change_date`, `c_restructured`, `c_remarks`, `c_active`) VALUES
(1015200202101, 62, 10, 15200202, '1', '2023-04-26', 881616, 'Deferred Cash Payment', 'LOC', 'REG', 149, 6800, 12, 121584, 'None', 0, 0, 0, 0, 0, 0, 891616, 0, 891616, 10000, 'Full DownPayment', 'Deferred Cash Payment', 20, 168323.2, 0, 0, '2006-05-25', '2006-05-25', 713292.8, 30, 15, 0, 23776, '2006-06-25', 0, 0, 0, 0, '', 1),
(1213700202101, 64, 12, 13700202, '1', '2023-04-27', 930000, 'Partial DownPayment', 'LOC', 'REG', 100, 9500, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 950000, 0, 950000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 170000, 12, 14166.67, '2020-11-02', '2021-10-02', 760000, 36, 15, 0.03466533, 26345.65, '2021-11-02', 0, 0, 0, 0, '', 1),
(1214500402101, 67, 12, 14500402, '1', '2023-06-08', 426400, 'Partial DownPayment', 'LOC', 'REG', 93, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 446400, 0, 446400, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 69280, 12, 5773.33, '2023-06-08', '2024-05-08', 357120, 120, 17, 0.01737977, 6206.66, '2024-06-08', 0, 0, 0, 0, 'hellow', 1),
(1214500502101, 68, 12, 14500502, '1', '2023-06-08', 437068.16, 'Reservation', 'LOC', 'REG', 84, 4800, 0, 0, 'None', 0, 0, 0, 0, 1, 4032, 399168, 47900.16, 447068.16, 10000, 'Full DownPayment', 'Deferred Cash Payment', 30, 124120.45, 0, 0, '2023-06-08', '2023-06-08', 312947.71, 60, 14, 0, 5215.8, '2023-07-08', 0, 0, 0, 0, '', 1),
(1214500602101, 65, 12, 14500602, '1', '2023-05-04', 455200, 'Monthly Amortization', 'LOC', 'REG', 99, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 475200, 0, 475200, 20000, 'Partial DownPayment', 'Monthly Amortization', 0, 75040, 12, 6253.33, '2023-01-01', '2023-12-01', 455200, 30, 7, 0.03643191, 16656.67, '2024-06-01', 0, 0, 0, 1, '', 1),
(1410300901101, 63, 14, 10300901, '1', '2023-04-27', 345166, 'Partial DownPayment', 'LOC', 'REG', 142, 2880, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 408960, 0, 408960, 10000, 'Partial DownPayment', 'Monthly Amortization', 20, 112688, 12, 28172, '1996-02-27', '1997-01-27', 345166, 24, 24, 0.0528711, 18249.31, '1996-06-27', 0, 0, 0, 1, '', 0),
(1413001901101, 66, 14, 13001901, '1', '2023-05-04', 2169789.16, 'Monthly Amortization', 'LOC', 'REG', 81, 34135.8, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 2765000, 0, 2765000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 0, 0, 0, '0000-00-00', '0000-00-00', 2169789.16, 120, 15, 0.0161335, 35038.55, '2023-05-29', 0, 0, 0, 1, '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_clients`
--

INSERT INTO `property_clients` (`client_id`, `property_id`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`, `c_reopen`) VALUES
(2307010153033, 1015200202101, 1, 'RAMOS', 'AMELITA', 'D.', '', '#225 San Pedro, Bustos, Bulacan', '3015', '   ', '2007-01-01', 15, '   ', 'F', 'Single', 'FILIPINO', 'UMID', '12345678', 'jaevoli18@gmail.com', '09561305511', '', 0, 0),
(2307090406676, 1410300901101, 1, 'DELA CRUZ', 'MARLON', 'B', '', '15 ST. IGNATIUS VILL. MABOLO, MALOLOS, BULACAN', '3000', '   ', '2007-09-04', 15, '   ', 'M', 'Single', 'FILIPINO', 'sss', '12134444', 'jaevoli18@gmail.com', '0934512142434', '', 0, 0),
(2390082879460, 1213700202101, 1, 'MAMANTA', 'MICHAEL JORDAN', 'DE LUNA', '', '0734 SUCOL SAN SEBASTIEN, HAGONOY, BULACAN', '3002', '  ', '1990-08-28', 32, '  ', 'M', 'Married', 'FILIPINO', 'UMID', '12345678', 'joannamariemamanta@gmail.com', '09561305511', '', 2, 0),
(2394122522193, 1413001901101, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '', '1994-12-25', 28, '  ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0, 0),
(2395010137547, 1214500602101, 1, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '  ', '1995-01-01', 28, '  ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 0, 0),
(2396050160796, 1214500402101, 1, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', '  ', '1996-05-01', 26, '  ', 'F', 'Single', 'Filipino', '', '', 'edhensee@gmail.com', '121345577', '', 0, 0),
(2396081053220, 1214500502101, 1, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', '  ', '1996-08-10', 26, '  ', 'M', 'Single', 'Filipino', '', '', 'kimsalibay@gmail.com', '1211455666', '', 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_payments`
--

INSERT INTO `property_payments` (`payment_id`, `property_id`, `payment_amount`, `pay_date`, `due_date`, `or_no`, `amount_due`, `rebate`, `surcharge`, `interest`, `principal`, `remaining_balance`, `status`, `status_count`, `payment_count`) VALUES
(290, 1015200202101, '10000.00', '2006-04-29', '2006-04-29', '447632', '0.00', '0.00', '0.00', '0.00', '10000.00', '881616.00', 'RES', 0, 1),
(291, 1015200202101, '168323.20', '2006-05-25', '2006-05-25', '450630', '168323.20', '0.00', '0.00', '0.00', '168323.20', '713292.80', 'FD', 1, 2),
(292, 1015200202101, '23776.00', '2006-06-27', '2006-06-25', '456673', '23776.00', '0.00', '0.00', '0.00', '23776.00', '689516.80', 'DFC - 1', 1, 3),
(293, 1015200202101, '1.00', '2006-06-27', '2006-07-25', '456673', '23776.00', '0.00', '0.00', '0.00', '1.00', '689515.80', 'DFC - 2', 2, 4),
(294, 1015200202101, '23775.00', '2006-07-24', '2006-07-25', '461903', '23775.00', '0.00', '0.00', '0.00', '23775.00', '665740.80', 'DFC - 2', 2, 5),
(295, 1015200202101, '23776.00', '2006-08-17', '2006-08-25', '465404', '23776.00', '0.00', '0.00', '0.00', '23776.00', '641964.80', 'DFC - 3', 3, 6),
(296, 1015200202101, '23776.00', '2006-09-27', '2006-09-25', '473087', '23776.00', '0.00', '0.00', '0.00', '23776.00', '618188.80', 'DFC - 4', 4, 7),
(297, 1410300901101, '10000.00', '1996-01-27', '1996-01-27', '3225', '0.00', '0.00', '0.00', '0.00', '10000.00', '398960.00', 'RES', 0, 1),
(298, 1410300901101, '25622.00', '1996-02-28', '1996-02-27', '3588', '28172.00', '0.00', '0.00', '0.00', '25622.00', '373338.00', 'PD - 1', 1, 2),
(299, 1410300901101, '2550.00', '1996-03-27', '1996-02-27', '3887', '2550.00', '0.00', '0.00', '0.00', '2550.00', '370788.00', 'PD - 1', 1, 3),
(300, 1410300901101, '25622.00', '1996-03-27', '1996-03-27', '3887', '28172.00', '0.00', '0.00', '0.00', '25622.00', '345166.00', 'PD - 2', 2, 4),
(316, 1213700202101, '20000.00', '2020-09-18', '2020-09-18', '399190', '0.00', '0.00', '0.00', '0.00', '20000.00', '930000.00', 'RES', 0, 1),
(318, 1213700202101, '14166.67', '2023-05-02', '2020-10-18', '12341', '14166.67', '0.00', '0.00', '0.00', '14166.67', '915833.33', 'PD - 1', 1, 2),
(319, 1213700202101, '35298.62', '2023-05-02', '2020-11-18', '1212', '35298.62', '0.00', '21131.95', '0.00', '14166.67', '901666.66', 'PD - 2', 2, 3),
(320, 1213700202101, '34590.29', '2023-05-02', '2020-12-18', '121313', '34590.29', '0.00', '20423.62', '0.00', '14166.67', '887499.99', 'PD - 3', 3, 4),
(321, 1213700202101, '33858.34', '2023-05-02', '2021-01-18', '1213141', '33858.34', '0.00', '19691.67', '0.00', '14166.67', '873333.32', 'PD - 4', 4, 5),
(322, 1213700202101, '33126.40', '2023-05-02', '2021-02-18', '12131', '33126.40', '0.00', '18959.73', '0.00', '14166.67', '859166.65', 'PD - 5', 5, 6),
(323, 1213700202101, '32465.29', '2023-05-02', '2021-03-18', '1212', '32465.29', '0.00', '18298.62', '0.00', '14166.67', '844999.98', 'PD - 6', 6, 7),
(324, 1213700202101, '31733.34', '2023-05-02', '2021-04-18', '12131', '31733.34', '0.00', '17566.67', '0.00', '14166.67', '830833.31', 'PD - 7', 7, 8),
(325, 1213700202101, '31025.01', '2023-05-02', '2021-05-18', '12345', '31025.01', '0.00', '16858.34', '0.00', '14166.67', '816666.64', 'PD - 8', 8, 9),
(326, 1213700202101, '30293.06', '2023-05-02', '2021-06-18', '12345', '30293.06', '0.00', '16126.39', '0.00', '14166.67', '802499.97', 'PD - 9', 9, 10),
(337, 1213700202101, '14166.67', '2023-05-03', '2021-07-18', '12345', '14166.67', '0.00', '0.00', '0.00', '14166.67', '788333.30', 'PD - 10', 10, 11),
(338, 1213700202101, '833.33', '2023-05-03', '2021-08-18', '12345', '28852.78', '0.00', '14686.11', '0.00', '0.00', '788333.30', 'PD - 11', 11, 12),
(339, 1015200202101, '38239.73', '2023-05-03', '2006-10-25', '124546', '38239.73', '0.00', '14463.73', '0.00', '23776.00', '594412.80', 'DFC - 5', 5, 8),
(340, 1015200202101, '37011.31', '2023-05-03', '2006-11-25', '124546', '37011.31', '0.00', '13235.31', '0.00', '23776.00', '570636.80', 'DFC - 6', 6, 9),
(341, 1015200202101, '35822.51', '2023-05-03', '2006-12-25', '124546', '35822.51', '0.00', '12046.51', '0.00', '23776.00', '546860.80', 'DFC - 7', 7, 10),
(342, 1015200202101, '34594.08', '2023-05-03', '2007-01-25', '124546', '34594.08', '0.00', '10818.08', '0.00', '23776.00', '523084.80', 'DFC - 8', 8, 11),
(343, 1015200202101, '33365.65', '2023-05-03', '2007-02-25', '124546', '33365.65', '0.00', '9589.65', '0.00', '23776.00', '499308.80', 'DFC - 9', 9, 12),
(344, 1015200202101, '32256.11', '2023-05-03', '2007-03-25', '124546', '32256.11', '0.00', '8480.11', '0.00', '23776.00', '475532.80', 'DFC - 10', 10, 13),
(345, 1015200202101, '31027.68', '2023-05-03', '2007-04-25', '124546', '31027.68', '0.00', '7251.68', '0.00', '23776.00', '451756.80', 'DFC - 11', 11, 14),
(346, 1015200202101, '29838.88', '2023-05-03', '2007-05-25', '124546', '29838.88', '0.00', '6062.88', '0.00', '23776.00', '427980.80', 'DFC - 12', 12, 15),
(347, 1015200202101, '28610.45', '2023-05-03', '2007-06-25', '124546', '28610.45', '0.00', '4834.45', '0.00', '23776.00', '404204.80', 'DFC - 13', 13, 16),
(348, 1015200202101, '27421.65', '2023-05-03', '2007-07-25', '124546', '27421.65', '0.00', '3645.65', '0.00', '23776.00', '380428.80', 'DFC - 14', 14, 17),
(349, 1015200202101, '26193.23', '2023-05-03', '2007-08-25', '124546', '26193.23', '0.00', '2417.23', '0.00', '23776.00', '356652.80', 'DFC - 15', 15, 18),
(350, 1015200202101, '24964.80', '2023-05-03', '2007-09-25', '124546', '24964.80', '0.00', '1188.80', '0.00', '23776.00', '332876.80', 'DFC - 16', 16, 19),
(351, 1015200202101, '23776.00', '2023-05-03', '2007-10-25', '124546', '23776.00', '0.00', '0.00', '0.00', '23776.00', '309100.80', 'DFC - 17', 17, 20),
(352, 1015200202101, '23894.88', '2023-05-03', '2007-11-25', '123414', '23894.88', '0.00', '118.88', '0.00', '23776.00', '285324.80', 'DFC - 18', 18, 21),
(353, 1214500602101, '20000.00', '2023-01-01', '2023-01-01', '654134', '0.00', '0.00', '0.00', '0.00', '20000.00', '455200.00', 'RES', 0, 1),
(354, 1214500602101, '6894.30', '2023-05-04', '2023-01-01', '12345', '6894.30', '0.00', '640.97', '0.00', '6253.33', '448946.67', 'PD - 1', 1, 2),
(355, 1214500602101, '6732.75', '2023-05-04', '2023-02-01', '12345', '6732.75', '0.00', '479.42', '0.00', '6253.33', '442693.34', 'PD - 2', 2, 3),
(356, 1214500602101, '6586.84', '2023-05-04', '2023-03-01', '12345', '6586.84', '0.00', '333.51', '0.00', '6253.33', '436440.01', 'PD - 3', 3, 4),
(357, 1214500602101, '6425.30', '2023-05-04', '2023-04-01', '12345', '6425.30', '0.00', '171.97', '0.00', '6253.33', '430186.68', 'PD - 4', 4, 5),
(358, 1214500602101, '6268.97', '2023-05-04', '2023-05-01', '12345', '6268.97', '0.00', '15.64', '0.00', '6253.33', '423933.35', 'PD - 5', 5, 6),
(359, 1214500602101, '6253.33', '2023-05-04', '2023-06-01', '12345', '6253.33', '0.00', '0.00', '0.00', '6253.33', '417680.02', 'PD - 6', 6, 7),
(360, 1214500602101, '6253.33', '2023-05-04', '2023-07-01', '1234', '6253.33', '0.00', '0.00', '0.00', '6253.33', '411426.69', 'PD - 7', 7, 8),
(361, 1214500602101, '6253.33', '2023-05-04', '2023-08-01', '124141', '6253.33', '0.00', '0.00', '0.00', '6253.33', '405173.36', 'PD - 8', 8, 9),
(362, 1214500602101, '6253.33', '2023-05-04', '2023-09-01', '121314', '6253.33', '0.00', '0.00', '0.00', '6253.33', '398920.03', 'PD - 9', 9, 10),
(363, 1214500602101, '6253.33', '2023-05-04', '2023-10-01', '1414', '6253.33', '0.00', '0.00', '0.00', '6253.33', '392666.70', 'PD - 10', 10, 11),
(364, 1214500602101, '6253.33', '2023-05-04', '2023-11-01', '1212', '6253.33', '0.00', '0.00', '0.00', '6253.33', '386413.37', 'PD - 11', 11, 12),
(365, 1214500602101, '6253.37', '2023-05-04', '2023-12-01', '121212', '6253.37', '0.00', '0.00', '0.00', '6253.37', '380160.00', 'FD', 12, 13),
(366, 1413001901101, '20000.00', '2020-02-10', '2020-02-10', '390385', '0.00', '0.00', '0.00', '0.00', '20000.00', '2745000.00', 'RES', 0, 1),
(457, 1413001901101, '22208.33', '2020-06-08', '2020-03-25', '395273', '22208.33', '0.00', '0.00', '0.00', '22208.33', '2722791.67', 'PD - 1', 1, 2),
(458, 1413001901101, '0.67', '2020-06-08', '2020-04-25', '395273', '22208.33', '0.00', '0.00', '0.00', '0.67', '2722791.00', 'PD - 2', 2, 3),
(459, 1413001901101, '22207.66', '2020-06-08', '2020-04-25', '395274', '22207.66', '0.00', '0.00', '0.00', '22207.66', '2700583.34', 'PD - 2', 2, 4),
(460, 1413001901101, '1.34', '2020-06-08', '2020-05-25', '395274', '22208.33', '0.00', '0.00', '0.00', '1.34', '2700582.00', 'PD - 3', 3, 5),
(461, 1413001901101, '22206.99', '2020-06-08', '2020-05-25', '395275', '22206.99', '0.00', '0.00', '0.00', '22206.99', '2678375.01', 'PD - 3', 3, 6),
(462, 1413001901101, '2.01', '2020-06-08', '2020-06-25', '395275', '22208.33', '0.00', '0.00', '0.00', '2.01', '2678373.00', 'PD - 4', 4, 7),
(463, 1413001901101, '22206.32', '2020-06-25', '2020-06-25', '396021', '22206.32', '0.00', '0.00', '0.00', '22206.32', '2656166.68', 'PD - 4', 4, 8),
(464, 1413001901101, '2.68', '2020-06-25', '2020-07-25', '396021', '22208.33', '0.00', '0.00', '0.00', '2.68', '2656164.00', 'PD - 5', 5, 9),
(465, 1413001901101, '22205.65', '2020-07-27', '2020-07-25', '397428', '22205.65', '0.00', '0.00', '0.00', '22205.65', '2633958.35', 'PD - 5', 5, 10),
(466, 1413001901101, '3.35', '2020-07-27', '2020-08-25', '397428', '22208.33', '0.00', '0.00', '0.00', '3.35', '2633955.00', 'PD - 6', 6, 11),
(467, 1413001901101, '22204.98', '2020-08-25', '2020-08-25', '398465', '22204.98', '0.00', '0.00', '0.00', '22204.98', '2611750.02', 'PD - 6', 6, 12),
(468, 1413001901101, '4.02', '2020-08-25', '2020-09-25', '398465', '22208.33', '0.00', '0.00', '0.00', '4.02', '2611746.00', 'PD - 7', 7, 13),
(469, 1413001901101, '22204.31', '2020-09-25', '2020-09-25', '399658', '22204.31', '0.00', '0.00', '0.00', '22204.31', '2589541.69', 'PD - 7', 7, 14),
(470, 1413001901101, '4.69', '2020-09-25', '2020-10-25', '399658', '22208.33', '0.00', '0.00', '0.00', '4.69', '2589537.00', 'PD - 8', 8, 15),
(471, 1413001901101, '22203.64', '2020-10-26', '2020-10-25', '400754', '22203.64', '0.00', '0.00', '0.00', '22203.64', '2567333.36', 'PD - 8', 8, 16),
(472, 1413001901101, '5.36', '2020-10-26', '2020-11-25', '400754', '22208.33', '0.00', '0.00', '0.00', '5.36', '2567328.00', 'PD - 9', 9, 17),
(473, 1413001901101, '22202.97', '2020-11-25', '2020-11-25', '401902', '22202.97', '0.00', '0.00', '0.00', '22202.97', '2545125.03', 'PD - 9', 9, 18),
(474, 1413001901101, '6.03', '2020-11-25', '2020-12-25', '401902', '22208.33', '0.00', '0.00', '0.00', '6.03', '2545119.00', 'PD - 10', 10, 19),
(475, 1413001901101, '22202.30', '2020-12-23', '2020-12-25', '402923', '22202.30', '0.00', '0.00', '0.00', '22202.30', '2522916.70', 'PD - 10', 10, 20),
(476, 1413001901101, '6.70', '2020-12-23', '2021-01-25', '402923', '22208.33', '0.00', '0.00', '0.00', '6.70', '2522910.00', 'PD - 11', 11, 21),
(477, 1413001901101, '22201.63', '2021-01-25', '2021-01-25', '404230', '22201.63', '0.00', '0.00', '0.00', '22201.63', '2500708.37', 'PD - 11', 11, 22),
(478, 1413001901101, '7.37', '2021-01-25', '2021-02-25', '404230', '22208.33', '0.00', '0.00', '0.00', '7.37', '2500701.00', 'PD - 12', 12, 23),
(479, 1413001901101, '22200.96', '2021-02-24', '2021-02-25', '405295', '22200.96', '0.00', '0.00', '0.00', '22200.96', '2478500.04', 'PD - 12', 12, 24),
(480, 1413001901101, '8.04', '2021-02-24', '2021-03-25', '405295', '22208.33', '0.00', '0.00', '0.00', '8.04', '2478492.00', 'PD - 13', 13, 25),
(481, 1413001901101, '22200.29', '2021-03-25', '2021-03-25', '407107', '22200.29', '0.00', '0.00', '0.00', '22200.29', '2456291.71', 'PD - 13', 13, 26),
(482, 1413001901101, '8.71', '2021-03-25', '2021-04-25', '407107', '22208.33', '0.00', '0.00', '0.00', '8.71', '2456283.00', 'PD - 14', 14, 27),
(483, 1413001901101, '22199.62', '2021-04-26', '2021-04-25', '408865', '22199.62', '0.00', '0.00', '0.00', '22199.62', '2434083.38', 'PD - 14', 14, 28),
(484, 1413001901101, '9.38', '2021-04-26', '2021-05-25', '408865', '22208.33', '0.00', '0.00', '0.00', '9.38', '2434074.00', 'PD - 15', 15, 29),
(485, 1413001901101, '22198.95', '2021-05-25', '2021-05-25', '409899', '22198.95', '0.00', '0.00', '0.00', '22198.95', '2411875.05', 'PD - 15', 15, 30),
(486, 1413001901101, '10.05', '2021-05-25', '2021-06-25', '409899', '22208.33', '0.00', '0.00', '0.00', '10.05', '2411865.00', 'PD - 16', 16, 31),
(487, 1413001901101, '22198.28', '2021-06-25', '2021-06-25', '410993', '22198.28', '0.00', '0.00', '0.00', '22198.28', '2389666.72', 'PD - 16', 16, 32),
(488, 1413001901101, '10.72', '2021-06-25', '2021-07-25', '410993', '22208.33', '0.00', '0.00', '0.00', '10.72', '2389656.00', 'PD - 17', 17, 33),
(489, 1413001901101, '22197.61', '2021-07-27', '2021-07-25', '412366', '22197.61', '0.00', '0.00', '0.00', '22197.61', '2367458.39', 'PD - 17', 17, 34),
(490, 1413001901101, '11.39', '2021-07-27', '2021-08-25', '412366', '22208.33', '0.00', '0.00', '0.00', '11.39', '2367447.00', 'PD - 18', 18, 35),
(491, 1413001901101, '22196.94', '2021-08-25', '2021-08-25', '413465', '22196.94', '0.00', '0.00', '0.00', '22196.94', '2345250.06', 'PD - 18', 18, 36),
(492, 1413001901101, '12.06', '2021-08-25', '2021-09-25', '413465', '22208.33', '0.00', '0.00', '0.00', '12.06', '2345238.00', 'PD - 19', 19, 37),
(493, 1413001901101, '22196.27', '2021-09-27', '2021-09-25', '414786', '22196.27', '0.00', '0.00', '0.00', '22196.27', '2323041.73', 'PD - 19', 19, 38),
(494, 1413001901101, '12.73', '2021-09-27', '2021-10-25', '414786', '22208.33', '0.00', '0.00', '0.00', '12.73', '2323029.00', 'PD - 20', 20, 39),
(495, 1413001901101, '22195.60', '2021-10-25', '2021-10-25', '415766', '22195.60', '0.00', '0.00', '0.00', '22195.60', '2300833.40', 'PD - 20', 20, 40),
(496, 1413001901101, '13.40', '2021-10-25', '2021-11-25', '415766', '22208.33', '0.00', '0.00', '0.00', '13.40', '2300820.00', 'PD - 21', 21, 41),
(497, 1413001901101, '22194.93', '2021-11-25', '2021-11-25', '416974', '22194.93', '0.00', '0.00', '0.00', '22194.93', '2278625.07', 'PD - 21', 21, 42),
(498, 1413001901101, '14.07', '2021-11-25', '2021-12-25', '416974', '22208.33', '0.00', '0.00', '0.00', '14.07', '2278611.00', 'PD - 22', 22, 43),
(499, 1413001901101, '22194.26', '2021-12-27', '2021-12-25', '418040', '22194.26', '0.00', '0.00', '0.00', '22194.26', '2256416.74', 'PD - 22', 22, 44),
(500, 1413001901101, '14.74', '2021-12-27', '2022-01-25', '418040', '22208.33', '0.00', '0.00', '0.00', '14.74', '2256402.00', 'PD - 23', 23, 45),
(501, 1413001901101, '22193.59', '2022-01-25', '2022-01-25', '418999', '22193.59', '0.00', '0.00', '0.00', '22193.59', '2234208.41', 'PD - 23', 23, 46),
(502, 1413001901101, '15.41', '2022-01-25', '2022-02-25', '418999', '22208.41', '0.00', '0.00', '0.00', '15.41', '2234193.00', 'PD', 24, 47),
(507, 1413001901101, '22193.00', '2022-02-24', '2022-02-25', '421210', '22193.00', '0.00', '0.00', '0.00', '22193.00', '2212000.00', 'FD', 24, 48),
(508, 1413001901101, '16.00', '2022-02-24', '2022-02-25', '421210', '16.00', '0.00', '0.00', '0.00', '16.00', '2211984.00', 'C PRIN', 24, 49),
(509, 1413001901101, '45204.00', '2022-03-25', '2022-03-25', '423422', '45204.00', '0.00', '0.00', '31336.44', '13867.56', '2198116.44', 'MA - 1', 1, 50),
(510, 1413001901101, '45204.00', '2022-04-25', '2022-04-25', '424657', '45204.00', '0.00', '0.00', '31139.98', '14064.02', '2184052.42', 'MA - 2', 2, 51),
(513, 1413001901101, '45204.00', '2022-06-06', '2022-05-25', '431802', '46108.08', '0.00', '904.08', '30940.74', '13359.18', '2170693.24', 'MA - 3', 3, 52),
(514, 1413001901101, '904.08', '2022-06-08', '2022-05-25', '431849', '904.08', '0.00', '0.00', '0.00', '904.08', '2169789.16', 'MA - 3', 3, 53),
(530, 1214500602101, '8840.49', '2023-05-04', '2024-01-01', '1212', '8840.49', '203.49', '0.00', '4752.00', '4088.49', '375868.02', 'MA - 1', 1, 14),
(548, 1413001901101, '0.00', '2023-06-01', '2022-05-25', '******', '0.00', '0.00', '0.00', '0.00', '0.00', '2169789.16', 'RESTRUCTURED', 0, 54),
(549, 1214500602101, '0.00', '2023-06-01', '2024-01-01', '******', '2000.00', '0.00', '1000.00', '1000.00', '0.00', '457200.00', 'RESTRUCTURED', 0, 15),
(550, 1214500402101, '20000.00', '2023-06-08', '2023-06-08', '4143434', '0.00', '0.00', '0.00', '0.00', '20000.00', '426400.00', 'RES', 0, 1),
(551, 1214500502101, '10000.00', '2023-06-08', '2023-06-08', '24411141', '0.00', '0.00', '0.00', '0.00', '10000.00', '437068.16', 'RES', 0, 1),
(552, 1214500402101, '5773.33', '2023-06-08', '2023-06-08', '3141414', '5773.33', '0.00', '0.00', '0.00', '5773.33', '420626.67', 'PD - 1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'ALSC Web Application'),
(6, 'short_name', 'ALSC Web App'),
(11, 'logo', 'uploads/1674192240_logo2.jpg'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1624240440_banner1.jpg'),
(15, 'tax_rate', '12');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attachments`
--

INSERT INTO `tbl_attachments` (`id`, `c_csr_no`, `title`, `name`, `date_uploaded`, `approval_status`) VALUES
(150, 55, '121212', 'RESTRUCTURED ACCTS NEW.xlsx', '2023-02-20 15:56:30', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_additional_cost`
--

INSERT INTO `t_additional_cost` (`id`, `c_csr_no`, `floor_elevation`, `aircon_outlets`, `aircon_grill`, `service_area`, `others`, `conv_outlet`, `aircon_outlet_price`, `aircon_grill_price`, `conv_outlet_price`, `service_area_price`, `others_price`, `floor_elev_price`) VALUES
(36, 51, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 121212),
(37, 52, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 121212),
(38, 53, 0, 1, 1, 1, 1, 1, 12, 12, 2222, 31313, 0, 0),
(39, 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 62, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 63, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(50, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(52, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(112533, 'Acobo', 'Shiela', '', '', 'Female', '2014-05-30', '', '', '', '', 'Single', '', '', 'Active', '', '2014-06-10', 'MA', 'ACHIEVERS', 'Adrenaline'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_approval_csr`
--

INSERT INTO `t_approval_csr` (`ra_id`, `c_csr_no`, `c_lot_lid`, `c_csr_status`, `c_date_approved`, `c_duration`, `c_amount_paid`, `c_reservation_amt`, `c_date_reserved`, `c_reserved_duration`, `c_reserve_status`, `c_ca_status`, `cfo_status`) VALUES
(105, 52, 14500401, 1, '2023-02-17 09:08:41', '2023-02-18 09:08:41', 10000, 10000, '2023-02-21 14:41:49', '2023-03-23 14:41:49', 1, 1, 1),
(106, 53, 14500405, 1, '2023-02-17 10:05:07', '2023-02-18 10:05:07', 10000, 10000, '2023-02-17 10:05:39', '2023-03-19 10:05:39', 1, 1, 1),
(107, 55, 14500323, 1, '2023-02-17 15:01:16', '2023-02-18 15:01:16', 20000, 20000, '2023-02-17 15:01:30', '2023-03-19 15:01:30', 1, 1, 1),
(108, 54, 14500410, 1, '2023-02-21 14:43:01', '2023-02-22 14:43:01', 50000, 50000, '2023-02-21 14:43:53', '2023-03-23 14:43:53', 1, 1, 1),
(109, 56, 14500408, 1, '2023-03-28 15:04:34', '2023-03-29 15:04:34', 10000, 10000, '2023-03-28 15:04:47', '2023-04-27 15:04:47', 1, 1, 1),
(110, 57, 14500510, 1, '2023-03-28 16:21:56', '2023-03-29 16:21:56', 30000, 30000, '2023-03-28 16:22:11', '2023-04-27 16:22:11', 1, 1, 1),
(111, 58, 14500501, 1, '2023-03-28 16:43:20', '2023-03-29 16:43:20', 20000, 20000, '2023-03-28 16:43:36', '2023-04-27 16:43:36', 1, 1, 1),
(112, 59, 14500504, 1, '2023-04-19 12:07:41', '2023-04-20 12:07:41', 200000, 200000, '2023-04-19 12:07:52', '2023-05-19 12:07:52', 1, 1, 1),
(113, 60, 14500505, 1, '2023-04-19 14:15:38', '2023-04-20 14:15:38', 10000, 10000, '2023-04-19 14:15:53', '2023-05-19 14:15:53', 1, 1, 1),
(114, 61, 14500403, 1, '2023-04-20 09:55:13', '2023-04-21 09:55:13', 20000, 20000, '2023-04-20 09:55:21', '2023-05-20 09:55:21', 1, 1, 1),
(115, 62, 15200202, 1, '2023-04-26 14:53:50', '2023-04-27 14:53:50', 10000, 10000, '2023-04-26 14:54:08', '2023-05-26 14:54:08', 1, 1, 1),
(116, 63, 10300901, 1, '2023-04-27 08:53:29', '2023-04-28 08:53:29', 10000, 10000, '2023-04-27 08:53:43', '2023-05-27 08:53:43', 1, 1, 1),
(117, 64, 13700202, 1, '2023-04-27 11:12:59', '2023-04-28 11:12:59', 20000, 20000, '2023-04-27 11:13:22', '2023-05-27 11:13:22', 1, 1, 1),
(118, 65, 14500602, 1, '2023-05-04 09:27:16', '2023-05-05 09:27:16', 20000, 20000, '2023-05-04 09:27:33', '2023-06-03 09:27:33', 1, 1, 1),
(119, 66, 13001901, 1, '2023-05-04 11:51:09', '2023-05-05 11:51:09', 20000, 20000, '2023-05-04 11:51:42', '2023-06-03 11:51:42', 1, 1, 1),
(120, 67, 14500402, 1, '2023-06-08 08:29:16', '2023-06-09 08:29:16', 20000, 20000, '2023-06-08 08:29:40', '2023-07-08 08:29:40', 1, 1, 1),
(121, 68, 14500502, 1, '2023-06-08 10:28:33', '2023-06-09 10:28:33', 10000, 10000, '2023-06-08 10:28:55', '2023-07-08 10:28:55', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_av_payment`
--

CREATE TABLE `t_av_payment` (
  `av_id` int(11) NOT NULL,
  `property_id` text NOT NULL,
  `c_av_no` text NOT NULL,
  `c_av_date` date NOT NULL DEFAULT current_timestamp(),
  `c_av_amount` double DEFAULT 0,
  `c_surcharge` double NOT NULL,
  `c_interest` double NOT NULL,
  `c_rebate` double NOT NULL,
  `c_new_acc_no` int(25) DEFAULT NULL,
  `c_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_buyer_info`
--

INSERT INTO `t_buyer_info` (`id`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `email`, `contact_no`, `c_created_by`) VALUES
(27, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '', '1994-12-25', 28, '', 'M', 'Single', 'Filipino', 'jaevoli18@gmail.com', '09561305511', 'admin'),
(28, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '', '1995-01-01', 28, '', 'M', 'Single', 'Filipino', 'francisdiaz22@gmail.com', '09123456789', 'admin'),
(29, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', '', '1995-02-02', 27, '', 'F', 'Single', 'Filipino', 'donitarose09@gmail.com', '0934512142434', 'admin'),
(30, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', '', '1988-01-31', 34, '', 'F', 'Married', 'Filipino', 'liezlsanchez@gmail.com', '012121313131', 'admin'),
(31, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', '', '1996-05-01', 26, '', 'F', 'Single', 'Filipino', 'edhensee@gmail.com', '121345577', 'admin'),
(32, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', '', '1996-08-10', 26, '', 'M', 'Single', 'Filipino', 'kimsalibay@gmail.com', '1211455666', 'admin'),
(33, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', '', '1978-07-12', 44, '', 'F', 'Married', 'Filipino', 'cutiepiesol@yahoo.com', '012121313131', 'admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_ca_requirement`
--

INSERT INTO `t_ca_requirement` (`id`, `c_csr_no`, `loan_amt`, `terms`, `gross_income`, `co_borrower`, `total`, `income_req`, `interest`, `terms_month`, `monthly`, `doc_req1`, `doc_req2`, `doc_req3`, `ver_doc1`, `ver_doc2`, `doc_req_remarks`, `ver_doc_remarks`) VALUES
(17, 52, 8665962.12, 20, 100000, 100000, 200000, 349530.66, 15, 120, 139812.26, 1, 1, 1, 1, 1, '', '');

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
  `c_linear` float NOT NULL,
  `c_fence_price_sqm` float NOT NULL,
  `c_processing_fee` float NOT NULL,
  `c_less` float NOT NULL,
  `pf_mo` float NOT NULL,
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
  `c_revised` tinyint(1) DEFAULT 0 COMMENT '0 = Normal\r\n1 = For Revision',
  `c_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive,\r\n1 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_csr`
--

INSERT INTO `t_csr` (`c_csr_no`, `ref_no`, `c_lot_lid`, `c_type`, `c_date_of_sale`, `c_lot_area`, `c_price_sqm`, `c_lot_discount`, `c_lot_discount_amt`, `c_house_model`, `c_floor_area`, `c_house_price_sqm`, `c_linear`, `c_fence_price_sqm`, `c_processing_fee`, `c_less`, `pf_mo`, `c_house_discount`, `c_house_discount_amt`, `c_tcp_discount`, `c_tcp_discount_amt`, `c_tcp`, `c_vat_amount`, `c_net_tcp`, `c_reservation`, `c_payment_type1`, `c_payment_type2`, `c_down_percent`, `c_net_dp`, `c_no_payments`, `c_monthly_down`, `c_first_dp`, `c_full_down`, `c_amt_financed`, `c_terms`, `c_interest_rate`, `c_fixed_factor`, `c_monthly_payment`, `c_start_date`, `c_remarks`, `c_date_created`, `c_date_updated`, `c_created_by`, `c_verify`, `coo_approval`, `c_revised`, `c_active`) VALUES
(52, '5740597781\n', 14500401, 3, '2023-02-17', 96, 4800, 0, 0, 'ANNIKA', 81, 129999, 0, 0, 0, 0, 0, 0, 0, 12, 1318886.28, 9671832.72, 1160619.93, 10832452.65, 10000, 'Partial DownPayment', 'Monthly Amortization', 20, 2156490.53, 12, 179707.54, '2023-02-17', '2024-02-17', 8665962.12, 120, 15, 0.0161335, 139812.26, '2024-03-17', '', '2023-02-17 09:06:28', '2023-04-26 14:30:07', 'admin', 1, 1, 0, 0),
(53, '3224398473\n', 14500405, 1, '2023-02-17', 76, 4600, 12, 41952, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 36917.76, 270730.24, 32487.63, 303217.87, 10000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 293217.87, 0, 0, 0, 0, '2023-02-17', '', '2023-02-17 10:04:46', '2023-04-26 14:30:11', 'admin', 1, 1, 0, 0),
(54, '1500201943\n', 14500410, 3, '2023-02-17', 84, 4600, 0, 0, 'SASHA', 120, 100000, 0, 0, 0, 0, 0, 0, 0, 1, 123864, 12262536, 1471504.32, 13734040.32, 50000, 'Partial DownPayment', 'Monthly Amortization', 30, 4070212.1, 24, 169592.17, '2023-02-17', '2025-01-17', 9613828.22, 120, 14, 0.01552664, 149270.48, '2025-02-17', '', '2023-02-17 13:27:03', '2023-04-26 14:30:14', 'admin', 1, 1, 0, 0),
(55, '6126474173\n', 14500323, 1, '2023-02-17', 76, 4700, 12, 42864, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 6286.72, 308049.28, 36965.91, 345015.19, 20000, 'Partial DownPayment', 'Monthly Amortization', 30, 83504.56, 12, 6958.71, '2023-02-17', '2024-01-17', 241510.63, 120, 14, 0.01552664, 3749.85, '2024-02-17', 'test', '2023-02-17 13:28:01', '2023-04-26 14:30:16', 'admin', 1, 1, 1, 0),
(56, '7694008600\n', 14500408, 1, '2023-02-22', 72, 4600, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 331200, 0, 331200, 10000, 'Partial DownPayment', 'Monthly Amortization', 20, 56240, 12, 4686.67, '2023-02-22', '2024-01-22', 264960, 1, 15, 1.0125, 268272, '2024-02-22', '', '2023-02-22 13:54:24', '2023-04-26 14:30:18', 'admin', 1, 1, 0, 0),
(57, '8553047339\n', 14500510, 3, '2023-03-28', 84, 4600, 0, 0, 'FREYA', 60, 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 986400, 0, 986400, 30000, 'Spot Cash', 'None', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 956400, 0, 0, 0, 0, '2023-04-28', '', '2023-03-28 16:21:49', '2023-04-26 14:30:20', 'admin', 1, 1, 0, 0),
(58, '3484255687\n', 14500501, 1, '2023-03-28', 87, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 417600, 0, 417600, 20000, 'Full DownPayment', 'Monthly Amortization', 30, 105280, 0, 0, '2023-03-28', '2023-03-28', 292320, 120, 16, 0.01675131, 4896.74, '2023-04-28', '', '2023-03-28 16:43:12', '2023-04-26 14:30:22', 'admin', 1, 1, 0, 0),
(59, '4975952998\n', 14500504, 3, '2023-04-19', 84, 4600, 0, 0, 'ANNIKA', 60, 1200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 72386400, 0, 72386400, 200000, 'Partial DownPayment', 'Deferred Cash Payment', 20, 14277280, 12, 1189773.33, '2023-04-19', '2024-03-19', 57909120, 240, 19, 0, 241288, '2024-04-19', '', '2023-04-19 12:07:34', '2023-04-26 14:30:24', 'admin', 1, 1, 0, 0),
(60, '9677752771\n', 14500505, 1, '2023-04-19', 87, 4600, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 400200, 0, 400200, 10000, 'No DownPayment', 'Deferred Cash Payment', 0, 0, 0, 0, '0000-00-00', '0000-00-00', 390200, 12, 0, 0, 32516.67, '2023-04-19', '', '2023-04-19 14:15:32', '2023-04-26 14:30:26', 'admin', 1, 1, 0, 0),
(61, '4497058655\n', 14500403, 1, '2023-04-20', 72, 4600, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 331200, 0, 331200, 20000, 'Full DownPayment', 'Monthly Amortization', 20, 46240, 0, 0, '2023-04-20', '2023-04-20', 264960, 120, 17, 0.01737977, 4604.94, '2023-05-20', '', '2023-04-20 09:55:03', '2023-04-26 14:30:28', 'admin', 1, 1, 0, 0),
(62, '4594869278\n', 15200202, 1, '2023-04-26', 149, 6800, 12, 121584, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 891616, 0, 891616, 10000, 'Full DownPayment', 'Deferred Cash Payment', 20, 168323.2, 0, 0, '2023-04-26', '2023-04-26', 713292.8, 30, 15, 0, 23776.43, '2023-04-26', '', '2023-04-26 14:49:53', '2023-04-26 14:53:50', 'admin', 1, 1, 0, 1),
(63, '1438585508\n', 10300901, 1, '2023-04-27', 142, 2880, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 408960, 0, 408960, 10000, 'Partial DownPayment', 'Monthly Amortization', 30, 112688, 4, 28172, '1996-02-27', '1996-05-27', 286272, 24, 24, 0.05287, 15136, '1996-06-27', '', '2023-04-27 08:51:42', '2023-04-27 08:53:29', 'admin', 1, 1, 0, 1),
(64, '4387666171\n', 13700202, 1, '2023-04-27', 100, 9500, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 950000, 0, 950000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 170000, 12, 14166.67, '2020-11-02', '2021-10-02', 760000, 36, 15, 0.03466533, 26345.65, '2021-11-02', '', '2023-04-27 11:12:51', '2023-04-27 11:12:59', 'admin', 1, 1, 0, 1),
(65, '7047301779\n', 14500602, 1, '2023-05-04', 99, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 475200, 0, 475200, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 75040, 12, 6253.33, '2023-01-01', '2023-12-01', 380160, 60, 15, 0.02378993, 9043.98, '2024-01-01', '', '2023-05-04 09:27:05', '2023-05-04 09:27:16', 'admin', 1, 1, 0, 1),
(66, '6610980322\n', 13001901, 1, '2023-05-04', 81, 34135.8, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2765000, 0, 2765000, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 533000, 24, 22208.33, '2020-03-25', '2022-02-25', 2212000, 84, 17, 0.0204358, 45204, '2022-03-25', '', '2023-05-04 11:51:01', '2023-05-04 11:51:09', 'admin', 1, 1, 0, 1),
(67, '4779388474\n', 14500402, 1, '2023-06-08', 93, 4800, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 446400, 0, 446400, 20000, 'Partial DownPayment', 'Monthly Amortization', 20, 69280, 12, 5773.33, '2023-06-08', '2024-05-08', 357120, 120, 17, 0.01737977, 6206.66, '2024-06-08', 'hellow', '2023-06-08 08:29:03', '2023-06-08 08:29:16', 'admin', 1, 1, 0, 1),
(68, '8141170951\n', 14500502, 1, '2023-06-08', 84, 4800, 0, 0, 'None', 0, 0, 0, 0, 10000, 0, 0, 0, 0, 1, 4032, 399168, 47900.16, 447068.16, 10000, 'Full DownPayment', 'Deferred Cash Payment', 30, 124120.45, 0, 0, '2023-06-08', '2023-06-08', 312947.71, 60, 14, 0, 5215.8, '2023-07-08', '', '2023-06-08 10:25:42', '2023-06-08 10:28:33', 'admin', 1, 1, 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_csr_buyers`
--

INSERT INTO `t_csr_buyers` (`buyer_id`, `c_csr_no`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`) VALUES
(18, 52, 1, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', ' ', '1988-01-31', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 0),
(19, 52, 2, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', ' ', '1988-01-31', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 2),
(20, 53, 1, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', ' ', '1996-08-10', 26, ' ', 'M', 'Single', 'Filipino', '', '', 'kimsalibay@gmail.com', '1211455666', '', 0),
(21, 53, 2, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', ' ', '1995-02-02', 27, ' ', 'F', 'Single', 'Filipino', '', '', 'donitarose09@gmail.com', '0934512142434', '', 3),
(22, 53, 3, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', ' ', '1995-01-01', 28, ' ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 4),
(23, 54, 1, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', ' ', '1996-05-01', 26, ' ', 'F', 'Single', 'Filipino', '', '', 'edhensee@gmail.com', '121345577', '', 0),
(24, 54, 2, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', ' ', '1988-01-31', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 1),
(25, 54, 3, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', ' ', '1995-02-02', 27, ' ', 'F', 'Single', 'Filipino', '', '', 'donitarose09@gmail.com', '0934512142434', '', 1),
(26, 55, 1, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', ' ', '1988-01-31', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 0),
(27, 56, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', ' ', '1994-12-25', 28, ' ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(28, 57, 1, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', ' ', '1978-07-12', 44, ' ', 'F', 'Single', 'Filipino', '', '', 'cutiepiesol@yahoo.com', '012121313131', '', 0),
(29, 58, 1, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', ' ', '1996-05-01', 26, ' ', 'F', 'Single', 'Filipino', '', '', 'edhensee@gmail.com', '121345577', '', 0),
(30, 59, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', ' ', '1994-12-25', 28, ' ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(31, 60, 1, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', ' ', '1995-02-02', 27, ' ', 'F', 'Single', 'Filipino', '', '', 'donitarose09@gmail.com', '0934512142434', '', 0),
(32, 61, 1, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', ' ', '1988-01-31', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'liezlsanchez@gmail.com', '012121313131', '', 0),
(36, 62, 1, 'RAMOS', 'AMELITA', 'D.', '', '#225 San Pedro, Bustos, Bulacan', '3015', '  ', '2007-01-01', 15, '  ', 'F', 'Single', 'FILIPINO', 'UMID', '12345678', 'jaevoli18@gmail.com', '09561305511', '', 0),
(40, 63, 1, 'DELA CRUZ', 'MARLON', 'B', '', '15 ST. IGNATIUS VILL. MABOLO, MALOLOS, BULACAN', '3000', '  ', '2007-09-04', 15, '  ', 'M', 'Single', 'FILIPINO', 'sss', '12134444', 'jaevoli18@gmail.com', '0934512142434', '', 0),
(41, 64, 1, 'MAMANTA', 'MICHAEL JORDAN', 'DE LUNA', '', '0734 SUCOL SAN SEBASTIEN, HAGONOY, BULACAN', '3002', ' ', '1990-08-28', 32, ' ', 'M', 'Married', 'FILIPINO', 'UMID', '12345678', 'joannamariemamanta@gmail.com', '09561305511', '', 2),
(42, 64, 2, 'MAMANTA', 'JOANNA MARIE', 'JULIANO', '', '0734 SUCOL SAN SEBASTIEN, HAGONOY, BULACAN', '3002', ' ', '1990-01-01', 32, ' ', 'F', 'Married', 'FILIPINO', 'UMID', '12345678', 'joannamariemamanta@gmail.com', '09694842560', '', 0),
(43, 65, 1, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', ' ', '1995-01-01', 28, ' ', 'M', 'Single', 'Filipino', '', '', 'francisdiaz22@gmail.com', '09123456789', '', 0),
(44, 66, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', ' ', '1994-12-25', 28, ' ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(45, 67, 1, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', ' ', '1996-05-01', 26, ' ', 'F', 'Single', 'Filipino', '', '', 'edhensee@gmail.com', '121345577', '', 0),
(46, 67, 2, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', ' ', '1978-07-12', 44, ' ', 'F', 'Single', 'Filipino', '', '', 'cutiepiesol@yahoo.com', '012121313131', '', 0),
(47, 68, 1, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', ' ', '1996-08-10', 26, ' ', 'M', 'Single', 'Filipino', '', '', 'kimsalibay@gmail.com', '1211455666', '', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_csr_commission`
--

INSERT INTO `t_csr_commission` (`comm_id`, `c_csr_no`, `c_code`, `c_position`, `c_agent`, `c_amount`, `c_rate`) VALUES
(12, 53, 109697, ' MA ', 'Aguas , Janet ', 2707.3, 1),
(13, 54, 110883, ' MA ', 'Agra , Karen ', 122625.36, 1),
(14, 55, 109697, ' MA ', 'Aguas , Janet ', 9241.48, 3),
(15, 56, 112462, ' MA ', 'Agustin , Angie ', 3312, 1),
(16, 57, 107380, ' MA ', 'Aberia , Joseph ', 9864, 1),
(17, 58, 107380, ' MA ', 'Aberia , Joseph ', 4176, 1),
(18, 59, 0, '', '', 0, 0),
(19, 60, 0, '', '', 0, 0),
(20, 61, 107380, ' MA ', 'Aberia , Joseph ', 6624, 2),
(24, 62, 107380, ' MA ', 'Aberia , Joseph ', 8916.16, 1),
(28, 63, 107380, ' MA ', 'Aberia , Joseph ', 4464, 1),
(29, 64, 107380, ' MA ', 'Aberia , Joseph ', 9500, 1),
(30, 65, 107380, ' MA ', 'Aberia , Joseph ', 4752, 1),
(31, 66, 107380, ' MA ', 'Aberia , Joseph ', 27650, 1),
(32, 67, 107380, ' MA ', 'Aberia , Joseph ', 4464, 1),
(33, 68, 0, '', '', 0, 0);

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
);

-- --------------------------------------------------------

--
-- Table structure for table `t_division`
--

CREATE TABLE `t_division` (
  `c_code` int(11) NOT NULL,
  `c_division` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_lots`
--

INSERT INTO `t_lots` (`c_lid`, `c_house_lid`, `c_site`, `c_block`, `c_lot`, `c_lot_area`, `c_price_sqm`, `c_remarks`, `c_status`, `c_lot_type`, `c_title`, `c_lot_type_remarks`, `c_title_owner`, `c_previous_owner`) VALUES
(10300901, NULL, 103, 9, 1, '142', 2880, '', 'Sold', NULL, NULL, NULL, NULL, NULL),
(13001901, NULL, 130, 19, 1, '81', 34135.8, '1213', 'Sold', NULL, NULL, NULL, NULL, NULL),
(13700202, NULL, 137, 2, 2, '100', 9500, '', 'Sold', NULL, NULL, NULL, NULL, NULL),
(14500323, NULL, 145, 3, 23, '76', 4700, '', 'Reserved', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500401, NULL, 145, 4, 1, '96', 4800, '', 'Reserved', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500402, NULL, 145, 4, 2, '93', 4800, '', 'Sold', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500403, NULL, 145, 4, 3, '72', 4600, '', 'Sold', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500404, NULL, 145, 4, 4, '72', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500405, NULL, 145, 4, 5, '76', 4600, '', 'Reserved', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500407, NULL, 145, 4, 7, '69', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500408, NULL, 145, 4, 8, '72', 4600, '', 'Sold', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500410, NULL, 145, 4, 10, '84', 4600, '', 'Reserved', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500411, NULL, 145, 4, 11, '84', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500413, NULL, 145, 4, 13, '112', 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500414, NULL, 145, 4, 14, '117', 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500501, NULL, 145, 5, 1, '87', 4800, '', 'Sold', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500502, NULL, 145, 5, 2, '84', 4800, '', 'Sold', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(14500503, NULL, 145, 5, 3, '84', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500504, NULL, 145, 5, 4, '84', 4600, '', 'Sold', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500505, NULL, 145, 5, 5, '87', 4600, '', 'Sold', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500506, NULL, 145, 5, 6, '84', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500507, NULL, 145, 5, 7, '81', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500509, NULL, 145, 5, 9, '84', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500510, NULL, 145, 5, 10, '84', 4600, '', 'Sold', 'Regular Lot', 'With Title', '', 'Buyer', 'ALSC'),
(14500511, NULL, 145, 5, 11, '72', 4600, '', 'Available', 'Regular Lot', 'With Title', '', 'ALSC', 'ALSC'),
(14500513, NULL, 145, 5, 13, '91', 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500514, NULL, 145, 5, 14, '96', 4800, '', 'Available', 'Prime Lot', 'With Title', 'corner lot', 'ALSC', 'ALSC'),
(14500602, NULL, 145, 6, 2, '99', 4800, '', 'Sold', 'Prime Lot', 'With Title', 'corner lot', 'Buyer', 'ALSC'),
(15200202, NULL, 152, 2, 2, '149', 6800, '', 'Sold', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_model_house`
--

CREATE TABLE `t_model_house` (
  `c_code` int(11) NOT NULL,
  `c_model` text NOT NULL,
  `c_acronym` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_model_house`
--

INSERT INTO `t_model_house` (`c_code`, `c_model`, `c_acronym`) VALUES
(100, 'NATHALIA', 'NAT'),
(101, 'ANNIKA', 'ANK'),
(102, 'SASHA', 'SAS'),
(104, 'FENCE', 'FNC'),
(105, 'FREYA', 'FRY');

-- --------------------------------------------------------

--
-- Table structure for table `t_moved_av`
--

CREATE TABLE `t_moved_av` (
  `av_id` int(11) NOT NULL,
  `av_no` int(11) NOT NULL,
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
  `account_status` text NOT NULL,
  `gen_time` time DEFAULT current_timestamp(),
  `trans_date` date NOT NULL DEFAULT current_timestamp(),
  `surcharge_percent` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_network`
--

CREATE TABLE `t_network` (
  `c_code` int(11) NOT NULL,
  `c_network` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_network_division`
--

INSERT INTO `t_network_division` (`c_code`, `c_network`, `c_division`) VALUES
(0, 'CATTLEYA', 'Apex'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_reservation`
--

INSERT INTO `t_reservation` (`id`, `ra_no`, `c_csr_no`, `c_lot_id`, `c_or_no`, `c_reserve_date`, `c_amount_paid`) VALUES
(99, 105, 52, 14500401, '12345', '2023-02-21 08:22:32', 5000),
(100, 106, 53, 14500405, '12346', '2023-02-17 10:05:39', 10000),
(101, 107, 55, 14500323, '20000', '2023-02-17 15:01:30', 20000),
(102, 105, 52, 14500401, '1341413', '2023-02-21 14:41:49', 5000),
(103, 108, 54, 14500410, '44343', '2023-02-21 14:43:42', 25000),
(104, 108, 54, 14500410, '12244', '2023-02-21 14:43:53', 25000),
(105, 109, 56, 14500408, '314243', '2023-03-28 15:04:47', 10000),
(106, 110, 57, 14500510, '32434v131', '2023-03-28 16:22:11', 30000),
(107, 111, 58, 14500501, '1213414', '2023-03-28 16:43:36', 20000),
(108, 112, 59, 14500504, '12121212', '2023-04-19 12:07:52', 200000),
(109, 113, 60, 14500505, '12121', '2023-04-19 14:15:53', 10000),
(110, 114, 61, 14500403, '12121', '2023-04-20 09:55:21', 20000),
(111, 115, 62, 15200202, '447632', '2023-04-26 14:54:08', 10000),
(112, 116, 63, 10300901, '3225', '2023-04-27 08:53:43', 10000),
(113, 117, 64, 13700202, '399190', '2023-04-27 11:13:22', 20000),
(114, 118, 65, 14500602, '654134', '2023-05-04 09:27:33', 20000),
(115, 119, 66, 13001901, '390385', '2020-02-10 11:51:42', 20000),
(116, 120, 67, 14500402, '4143434', '2023-06-08 08:29:40', 20000),
(117, 121, 68, 14500502, '24411141', '2023-06-08 10:28:55', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` smallint(1) DEFAULT NULL COMMENT '1= Admin, 2= COO, 3= Manager, 4= Supervisor, 5 = Employee',
  `user_type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `password`, `avatar`, `last_login`, `type`, `user_type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', 'admin2@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675232580_1675125780_310082230_527806389353530_3496035450341313581_n.jpg', NULL, 1, 'IT Admin', '2021-01-20 14:02:37', '2023-02-01 14:23:28'),
(2, 'Pia', 'Madrid', 'coo_pia', 'admin3@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1674732540_89744207_10158068221285818_5380944493983825920_n.jpg', NULL, 2, 'COO', '2021-01-20 14:02:37', '2023-01-26 20:23:14'),
(3, 'Agent', 'x44', 'agentx44', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675754520_NZ6_5625.JPG', NULL, 5, 'Agent', '2021-01-20 14:02:37', '2023-02-07 15:22:23'),
(4, 'Janine', 'Cruz', 'ca_janine', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', NULL, NULL, 4, 'CA', '2021-01-20 14:02:37', '2023-01-26 20:23:22'),
(5, 'Vio', 'Borlongan', 'sm_vio', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1674780660_1674735360_Tiny+Avatar.png', NULL, 4, 'SOS', '2021-01-20 14:02:37', '2023-01-27 11:54:52'),
(6, 'Eliza', 'Figueroa', 'cashier_eliza', 'eliza@gmail.com', '12345678910', '0192023a7bbd73250516f069df18b500', 'uploads/1675124340_1664026500_male1.jfif', NULL, 5, 'Cashier', '2023-01-31 08:19:54', '2023-01-31 08:44:00'),
(7, 'LIEZL', 'SANCHEZ', 'liezlsa', 'liezl@gmail.com', '123455678', '0192023a7bbd73250516f069df18b500', 'uploads/1675125480_NZ6_5624.JPG', NULL, 5, 'Cashier', '2023-01-31 08:38:49', '2023-01-31 08:44:03'),
(8, 'JUDE', 'DELA CRUZ', 'judedel', 'jaevoli18@gmail.com', '09561305511', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1675126620_310082230_527806389353530_3496035450341313581_n.jpg', NULL, 1, 'IT Admin', '2023-01-31 08:43:22', '2023-01-31 08:57:23'),
(9, 'DONITA ROSE', 'TANTOCO', 'donits', 'donita@gmail.com', '09561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675126140_user_icon.png', NULL, 1, 'IT Admin', '2023-01-31 08:49:33', NULL);

-- --------------------------------------------------------

--
-- Structure for view `t_csr_view`
--
DROP TABLE IF EXISTS `t_csr_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `t_csr_view`  AS SELECT `q`.`c_acronym` AS `c_acronym`, `z`.`c_block` AS `c_block`, `z`.`c_lot` AS `c_lot`, `y`.`last_name` AS `last_name`, `y`.`first_name` AS `first_name`, `y`.`middle_name` AS `middle_name`, `y`.`suffix_name` AS `suffix_name`, `x`.`c_csr_no` AS `c_csr_no`, `x`.`ref_no` AS `ref_no`, `x`.`c_lot_lid` AS `c_lot_lid`, `x`.`c_type` AS `c_type`, `x`.`c_date_of_sale` AS `c_date_of_sale`, `x`.`c_lot_area` AS `c_lot_area`, `x`.`c_price_sqm` AS `c_price_sqm`, `x`.`c_lot_discount` AS `c_lot_discount`, `x`.`c_lot_discount_amt` AS `c_lot_discount_amt`, `x`.`c_house_model` AS `c_house_model`, `x`.`c_floor_area` AS `c_floor_area`, `x`.`c_house_price_sqm` AS `c_house_price_sqm`, `x`.`c_linear` AS `c_linear`, `x`.`c_fence_price_sqm` AS `c_fence_price_sqm`, `x`.`c_processing_fee` AS `c_processing_fee`, `x`.`c_less` AS `c_less`, `x`.`pf_mo` AS `pf_mo`, `x`.`c_house_discount` AS `c_house_discount`, `x`.`c_house_discount_amt` AS `c_house_discount_amt`, `x`.`c_tcp_discount` AS `c_tcp_discount`, `x`.`c_tcp_discount_amt` AS `c_tcp_discount_amt`, `x`.`c_tcp` AS `c_tcp`, `x`.`c_vat_amount` AS `c_vat_amount`, `x`.`c_net_tcp` AS `c_net_tcp`, `x`.`c_reservation` AS `c_reservation`, `x`.`c_payment_type1` AS `c_payment_type1`, `x`.`c_payment_type2` AS `c_payment_type2`, `x`.`c_down_percent` AS `c_down_percent`, `x`.`c_net_dp` AS `c_net_dp`, `x`.`c_no_payments` AS `c_no_payments`, `x`.`c_monthly_down` AS `c_monthly_down`, `x`.`c_first_dp` AS `c_first_dp`, `x`.`c_full_down` AS `c_full_down`, `x`.`c_amt_financed` AS `c_amt_financed`, `x`.`c_terms` AS `c_terms`, `x`.`c_interest_rate` AS `c_interest_rate`, `x`.`c_fixed_factor` AS `c_fixed_factor`, `x`.`c_monthly_payment` AS `c_monthly_payment`, `x`.`c_start_date` AS `c_start_date`, `x`.`c_remarks` AS `c_remarks`, `x`.`c_date_created` AS `c_date_created`, `x`.`c_date_updated` AS `c_date_updated`, `x`.`c_created_by` AS `c_created_by`, `x`.`c_verify` AS `c_verify`, `x`.`coo_approval` AS `coo_approval`, `x`.`c_revised` AS `c_revised`, `x`.`c_active` AS `c_active` FROM (((`t_csr` `x` join `t_csr_buyers` `y` on(`x`.`c_csr_no` = `y`.`c_csr_no`)) join `t_lots` `z` on(`x`.`c_lot_lid` = `z`.`c_lid`)) join `t_projects` `q` on(`z`.`c_site` = `q`.`c_code`)) WHERE `y`.`c_buyer_count` = 11  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `group_list`
--
ALTER TABLE `group_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `journal_items`
--
ALTER TABLE `journal_items`
  ADD KEY `journal_id` (`journal_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `or_logs`
--
ALTER TABLE `or_logs`
  ADD PRIMARY KEY (`or_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `fk_c_lot_lid` (`c_lot_lid`);

--
-- Indexes for table `property_clients`
--
ALTER TABLE `property_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_payments`
--
ALTER TABLE `property_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_additional_cost` (`c_csr_no`);

--
-- Indexes for table `t_agents`
--
ALTER TABLE `t_agents`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  ADD PRIMARY KEY (`ra_id`),
  ADD UNIQUE KEY `c_csr_no` (`c_csr_no`),
  ADD KEY `fk_c_csr_no` (`c_csr_no`),
  ADD KEY `fk_c_lid` (`c_lot_lid`);

--
-- Indexes for table `t_av_payment`
--
ALTER TABLE `t_av_payment`
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
-- Indexes for table `t_csr`
--
ALTER TABLE `t_csr`
  ADD PRIMARY KEY (`c_csr_no`),
  ADD KEY `fk_c_lot_lid` (`c_lot_lid`);

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
-- Indexes for table `t_house`
--
ALTER TABLE `t_house`
  ADD PRIMARY KEY (`c_house_lid`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `t_lots`
--
ALTER TABLE `t_lots`
  ADD PRIMARY KEY (`c_lid`),
  ADD KEY `fk_c_h_lid` (`c_house_lid`);

--
-- Indexes for table `t_model_house`
--
ALTER TABLE `t_model_house`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_moved_av`
--
ALTER TABLE `t_moved_av`
  ADD PRIMARY KEY (`av_id`);

--
-- Indexes for table `t_projects`
--
ALTER TABLE `t_projects`
  ADD PRIMARY KEY (`c_code`);

--
-- Indexes for table `t_reservation`
--
ALTER TABLE `t_reservation`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `group_list`
--
ALTER TABLE `group_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `or_logs`
--
ALTER TABLE `or_logs`
  MODIFY `or_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `property_payments`
--
ALTER TABLE `property_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `t_agents`
--
ALTER TABLE `t_agents`
  MODIFY `c_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113001;

--
-- AUTO_INCREMENT for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  MODIFY `ra_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `t_buyer_info`
--
ALTER TABLE `t_buyer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_ca_requirement`
--
ALTER TABLE `t_ca_requirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_csr`
--
ALTER TABLE `t_csr`
  MODIFY `c_csr_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `t_csr_buyers`
--
ALTER TABLE `t_csr_buyers`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `t_csr_comments`
--
ALTER TABLE `t_csr_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `t_csr_commission`
--
ALTER TABLE `t_csr_commission`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1560;

--
-- AUTO_INCREMENT for table `t_moved_av`
--
ALTER TABLE `t_moved_av`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_reservation`
--
ALTER TABLE `t_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `property_clients` (`client_id`);

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `journal_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `journal_items`
--
ALTER TABLE `journal_items`
  ADD CONSTRAINT `journal_items_ibfk_1` FOREIGN KEY (`journal_id`) REFERENCES `journal_entries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_items_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `journal_items_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_clients`
--
ALTER TABLE `property_clients`
  ADD CONSTRAINT `property_clients_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);

--
-- Constraints for table `property_payments`
--
ALTER TABLE `property_payments`
  ADD CONSTRAINT `property_payments_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);

--
-- Constraints for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  ADD CONSTRAINT `fk_c_csr_no` FOREIGN KEY (`c_csr_no`) REFERENCES `t_csr` (`c_csr_no`),
  ADD CONSTRAINT `fk_c_lid` FOREIGN KEY (`c_lot_lid`) REFERENCES `t_lots` (`c_lid`);

--
-- Constraints for table `t_csr`
--
ALTER TABLE `t_csr`
  ADD CONSTRAINT `fk_c_lot_lid` FOREIGN KEY (`c_lot_lid`) REFERENCES `t_lots` (`c_lid`);

--
-- Constraints for table `t_lots`
--
ALTER TABLE `t_lots`
  ADD CONSTRAINT `fk_c_h_lid` FOREIGN KEY (`c_house_lid`) REFERENCES `t_house` (`c_house_lid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
