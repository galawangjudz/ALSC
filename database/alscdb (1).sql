-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 10:35 AM
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
-- Table structure for table `approved_order_items`
--

CREATE TABLE `approved_order_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` float NOT NULL,
  `quantity` float NOT NULL,
  `received` float NOT NULL DEFAULT 0,
  `outstanding` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Billing'),
(2, 'IT'),
(3, 'Engineering'),
(4, 'Marketing'),
(8, 'Finance');

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

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`member_id`, `client_id`, `c_buyer_count`, `last_name`, `first_name`, `middle_name`, `suffix_name`, `address`, `zip_code`, `address_abroad`, `birthdate`, `age`, `viber`, `gender`, `civil_status`, `citizenship`, `id_presented`, `tin_no`, `email`, `contact_no`, `contact_abroad`, `relationship`, `status`) VALUES
(0, 2395120940413, 2, 'GONZALES', 'CELINE ANGELICA', '', '', 'TABANG, PLARIDEL, BULACAN', '3018', '  ', '1988-09-10', 34, '  ', 'F', 'Single', 'Filipino', '', '', 'celineangelicagonz@gmail.com', '09873167818', '', 0, 0);

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
(2, 'Revenue', 'Cash coming into your business through sales and other types of payments', 2, 1, 0, '2022-02-01 09:57:45', NULL),
(3, 'Expenses', 'The amount you’re spending on services and other items, like payroll, utility bills, and fees for contractors.', 1, 1, 0, '2022-02-01 09:58:09', '2022-02-01 09:59:13'),
(4, 'Liabilities', 'The money you still owe on loans, debts, and other obligations.', 2, 1, 0, '2022-02-01 09:58:34', NULL),
(5, 'Equity', 'How much is remaining after you subtract liabilities from assets.', 2, 1, 0, '2022-02-01 09:59:05', NULL),
(6, 'Dividend', 'Form of income that shareholders of corporations receive for each share of stock that they hold.', 1, 1, 0, '2022-02-01 10:00:13', NULL),
(7, 'Sample101', 'Sample', 1, 0, 1, '2022-02-01 10:01:35', '2022-02-01 10:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `id` int(30) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `item_code` int(11) NOT NULL,
  `description` text NOT NULL,
  `default_unit` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT ' 1 = Active, 0 = Inactive',
  `last_date_canvassed` date DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `supplier_id`, `name`, `item_code`, `description`, `default_unit`, `status`, `last_date_canvassed`, `date_created`) VALUES
(2, 2, 'Item 102', 102, 'Sample Only', 'piece', 1, '2023-09-09', '2021-09-08 10:21:42'),
(3, 3, 'Item 3', 103, 'Sample product 103. 3x25 per boxes', 'piece', 1, '2023-09-09', '2021-09-08 10:22:10'),
(4, 3, 'Laptop', 104, 'Asus', 'piece', 1, '2023-09-08', '2023-08-25 08:42:39'),
(5, 2, 'Mouse', 105, 'Mouse', 'piece', 1, '2023-09-01', '2023-08-25 08:43:27'),
(6, 3, 'Keyboard', 106, 'Mechanical', 'piece', 1, '2023-09-09', '2023-08-25 08:53:46'),
(9, 6, 'Printer', 120, 'Printer sample', 'piece', 1, '2023-09-09', '2023-08-25 11:56:36'),
(10, 5, 'Bond Paper', 121, 'Long/Short', 'rim', 1, '2023-09-09', '2023-08-25 12:00:57'),
(11, 5, 'Ballpen', 122, 'Red', 'box', 1, '2023-09-09', '2023-09-02 20:52:26'),
(12, 5, 'Folder', 125, 'Plastic Folder', 'piece', 1, '2023-09-09', '2023-09-02 20:52:47'),
(13, 5, 'Cartolina', 126, 'Pink', 'piece', 1, '2023-09-09', '2023-09-02 20:53:24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(65, 'admin added a new lot  with Lot ID # 169123123', 'IT Admin', 1, '2023-08-18 01:14:49'),
(66, 'admin updated lot  with Lot ID # 169123123.', 'IT Admin', 1, '2023-08-18 01:16:04'),
(67, 'admin added a new lot  with Lot ID #.', 'IT Admin', 1, '2023-08-18 01:19:34'),
(68, 'admin added a new house model  with code #144.', 'IT Admin', 1, '2023-08-18 01:25:27'),
(69, 'admin updated house model  with code #144.', 'IT Admin', 1, '2023-08-18 01:26:36'),
(70, 'admin added a new project site  SAMPLE SAMPLE.', 'IT Admin', 1, '2023-08-18 01:37:41'),
(72, 'admin updated project site SAMPLE SAMPLESSS.', 'IT Admin', 1, '2023-08-18 01:39:25'),
(75, 'admin added a new RA with reference # with reference #2327712588\n.', 'IT Admin', 1, '2023-08-18 02:06:04'),
(78, 'admin updated RA with reference # with CSR# 150.', 'IT Admin', 1, '2023-08-18 02:10:39'),
(81, 'admin added a new RA with reference # with ref#4795823189\n.', 'IT Admin', 1, '2023-08-18 02:17:38'),
(82, 'admin added a new RA with reference # with ref#4795823189\n.', 'SOS', 1, '2023-08-18 02:17:38'),
(83, 'admin updated RA with reference # with CSR# 152.', 'IT Admin', 1, '2023-08-18 02:18:02'),
(84, 'admin updated RA with reference # with CSR# 152.', 'SOS', 1, '2023-08-18 02:18:02'),
(91, 'sm_vio verified CSR #152.', 'CFO', 1, '2023-08-18 02:45:07'),
(92, 'sm_vio verified CSR #152.', 'COO', 1, '2023-08-18 02:45:07'),
(93, 'sm_vio verified CSR #152.', 'IT Admin', 1, '2023-08-18 02:45:07'),
(94, 'admin voided CSR #152.', 'CFO', 1, '2023-08-18 02:51:00'),
(95, 'admin voided CSR #152.', 'COO', 1, '2023-08-18 02:51:00'),
(96, 'admin voided CSR #152.', 'IT Admin', 1, '2023-08-18 02:51:00'),
(97, 'admin verified CSR #152.', 'CFO', 1, '2023-08-18 02:51:23'),
(98, 'admin verified CSR #152.', 'COO', 1, '2023-08-18 02:51:23'),
(99, 'admin verified CSR #152.', 'IT Admin', 1, '2023-08-18 02:51:23'),
(100, 'sm_vio verified CSR #151.', 'CFO', 1, '2023-08-18 03:01:02'),
(101, 'sm_vio verified CSR #151.', 'COO', 1, '2023-08-18 03:01:02'),
(102, 'sm_vio verified CSR #151.', 'IT Admin', 1, '2023-08-18 03:01:02'),
(103, ' approved CSR #151.', 'Cashier', 1, '2023-08-18 03:23:04'),
(104, ' approved CSR #151.', 'IT Admin', 1, '2023-08-18 03:23:04'),
(105, 'coo_pia approved CSR #151.', 'Cashier', 1, '2023-08-18 03:23:22'),
(106, 'coo_pia approved CSR #151.', 'IT Admin', 1, '2023-08-18 03:23:22'),
(107, 'donits approved CSR #151.', 'Cashier', 1, '2023-08-18 03:24:51'),
(108, 'donits approved CSR #151.', 'IT Admin', 1, '2023-08-18 03:24:51'),
(109, 'donits disapproved CSR #151.', 'CFO', 0, '2023-08-18 03:30:31'),
(110, 'donits disapproved CSR #151.', 'COO', 1, '2023-08-18 03:30:31'),
(111, 'donits disapproved CSR #151.', 'IT Admin', 1, '2023-08-18 03:30:31'),
(112, 'cfo_gian disapproved CSR #152.', 'CFO', 0, '2023-08-18 03:31:12'),
(113, 'cfo_gian disapproved CSR #152.', 'COO', 1, '2023-08-18 03:31:12'),
(114, 'cfo_gian disapproved CSR #152.', 'IT Admin', 1, '2023-08-18 03:31:12'),
(115, 'admin approved CSR #151.', 'Cashier', 1, '2023-08-18 03:33:50'),
(116, 'admin approved CSR #151.', 'IT Admin', 1, '2023-08-18 03:33:50'),
(117, 'admin verified CSR #150.', 'CFO', 0, '2023-08-18 03:34:42'),
(118, 'admin verified CSR #150.', 'COO', 1, '2023-08-18 03:34:42'),
(119, 'admin verified CSR #150.', 'IT Admin', 1, '2023-08-18 03:34:42'),
(120, 'cashier_eliza created a reservation for CSR # .', 'IT Admin', 1, '2023-08-18 04:00:05'),
(121, 'cashier_eliza created a reservation for CSR # .', 'SOS', 0, '2023-08-18 04:00:05'),
(122, 'cashier_eliza created a reservation for CSR # 150.', 'IT Admin', 1, '2023-08-18 04:01:06'),
(123, 'cashier_eliza created a reservation for CSR # 150.', 'CA', 1, '2023-08-18 04:01:06'),
(124, 'admincreated a reservation for CSR # 152.', 'IT Admin', 1, '2023-08-18 05:12:14'),
(125, 'admincreated a reservation for CSR # 152.', 'CA', 1, '2023-08-18 05:12:14'),
(126, 'ca_janine approved RA# 181. (CA Approved)', 'IT Admin', 1, '2023-08-18 05:37:43'),
(127, 'ca_janine approved RA# 181. (CA Approved)', 'SOS', 0, '2023-08-18 05:37:43'),
(130, 'admin disapproved RA# 181. (CA)', 'IT Admin', 1, '2023-08-18 05:43:45'),
(131, 'admin disapproved RA# 181. (CA)', 'SOS', 0, '2023-08-18 05:43:45'),
(132, 'admin revised RA# 180. (CA)', 'IT Admin', 1, '2023-08-18 05:44:09'),
(133, 'admin revised RA# 180. (CA)', 'SOS', 0, '2023-08-18 05:44:09'),
(134, 'admin approved RA# 179. (CA)', 'IT Admin', 1, '2023-08-18 05:44:39'),
(135, 'admin approved RA# 179. (CA)', 'SOS', 0, '2023-08-18 05:44:39'),
(136, 'admin created an evaluation for CSR #151.', 'IT Admin', 1, '2023-08-18 06:07:36'),
(137, 'admin created an evaluation for CSR #151.', 'SOS', 0, '2023-08-18 06:07:36'),
(138, 'admin updated the evaluation for CSR #152.', 'IT Admin', 1, '2023-08-18 06:08:54'),
(139, 'admin updated the evaluation for CSR #152.', 'SOS', 0, '2023-08-18 06:08:54'),
(140, 'admin updated the evaluation for CSR #152.', 'IT Admin', 1, '2023-08-18 06:09:14'),
(141, 'admin updated the evaluation for CSR #152.', 'SOS', 0, '2023-08-18 06:09:14'),
(142, 'admin booked CSR #151.', 'IT Admin', 1, '2023-08-18 06:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `po_id` int(30) NOT NULL,
  `item_id` int(11) NOT NULL,
  `default_unit` varchar(50) NOT NULL,
  `unit_price` float NOT NULL,
  `quantity` float NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - Approved (Default) / 1 - Disapproved',
  `item_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `po_id`, `item_id`, `default_unit`, `unit_price`, `quantity`, `item_status`, `item_notes`) VALUES
(606, 174, 6, 'piece', 5000, 2, 0, ''),
(607, 174, 5, 'piece', 3999, 2, 1, 'Pakiremove'),
(614, 175, 6, 'piece', 599, 5, 0, ''),
(615, 175, 4, 'piece', 59999, 5, 0, '');

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
  `discount_percentage` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_amount` float NOT NULL,
  `department` text NOT NULL,
  `notes` text NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Open, 0 = Closed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `po_list`
--

CREATE TABLE `po_list` (
  `id` int(30) NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `discount_percentage` float NOT NULL DEFAULT 0,
  `discount_amount` float NOT NULL DEFAULT 0,
  `tax_percentage` float NOT NULL DEFAULT 0,
  `tax_amount` float NOT NULL DEFAULT 0,
  `department` text NOT NULL,
  `notes` text NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `terms` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `status2` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - Approved / 2 - Disapproved / 3 - For Review',
  `status3` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 - Approved / 2 - Disapproved / 3 - For Review',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_list`
--

INSERT INTO `po_list` (`id`, `po_no`, `supplier_id`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `department`, `notes`, `delivery_date`, `terms`, `status`, `status2`, `status3`, `date_created`, `date_updated`) VALUES
(174, 'PO - 001', 7, 0, 0, 12, 2159.76, 'Finance', 'aaaaaaaa', '2023-09-19', 0, 1, 3, 0, '2023-09-11 13:59:30', '2023-09-11 15:42:00'),
(175, 'PO - 175', 5, 5, 15249.2, 12, 36598.2, 'Billing', 'TETSSTSTSTGRsfcescescededed', '2023-09-18', 0, 1, 3, 0, '2023-09-11 15:57:37', '2023-09-11 16:09:55');

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
(1213700202101, 151, 12, 13700202, '1', '2023-08-18', 1039000, 'Reservation', 'LOC', 'REG', 100, 9500, 0, 0, 'None', 0, 0, 0, 0, 0, 0, 950000, 114000, 1064000, 25000, 'Partial DownPayment', 'Monthly Amortization', 20, 187800, 12, 15650, '2023-08-18', '2023-08-18', 851200, 1, 15, 1.0125, 861840, '2023-08-18', 0, 0, 0, 0, '', 1, NULL, NULL);

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
(2395120940413, 1213700202101, 1, 'Gonzales', 'Felyne Angeli', 'Buhain', '', 'Tabang, Plaridel, Bulacan', '3018', '   ', '1995-12-09', 27, '   ', 'F', 'Single', 'Filipino', '', '', 'inggygonz@gmail.com', '09789184718', '', 0, 0);

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
(763, 1213700202101, 25000.00, '2023-08-18', '2023-08-18', '214222', 0.00, 0.00, 0.00, 0.00, 25000.00, 1039000.00, 'RES', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 0 = Inactive, 1 = Active',
  `vatable` int(11) NOT NULL,
  `mop` int(11) NOT NULL DEFAULT 0 COMMENT '0 - COD / 1 - Check',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `address`, `contact_person`, `contact`, `email`, `status`, `vatable`, `mop`, `date_created`) VALUES
(2, 'Samsung', 'Supplier 102 Address, 23rd St, Sample City, Test Province, ####', 'Samantha Lou', '09332145889', 'sLou@supplier102.com', 1, 0, 0, '2021-09-08 10:25:12'),
(3, 'Acer', 'PULILAN, BULACAN', 'DONITA ROSE TANTOCO', '09789754111', 'donitarosetantoco2028@gmail.com', 1, 0, 0, '2023-08-25 08:52:46'),
(4, 'Monde', 'PULILAN, BULACAN', 'LIEZL SANCHEZ', '09789754111', 'liezlsanchez@gmail.com', 1, 0, 0, '2023-08-25 11:37:21'),
(5, 'PANDAYAN', 'MALOLOS, BULACAN', 'F.Somera', '09678908111', 'sample@gmail.com', 1, 12, 0, '2023-08-25 11:38:06'),
(6, 'EPSON', 'MANILA', 'Francis Diaz', '0978154141414', 'francisdiaz@gmail.com', 1, 12, 0, '2023-08-25 11:40:36'),
(7, 'DOMEX', 'TEST', 'DOMEX', '09394849184', 'domex@gmail.com', 1, 12, 0, '2023-09-09 18:16:03'),
(8, 'Jollibee', 'TEST', 'Jabili', '0939484918433231', 'chaosgirl.2oo9@gmail.com', 1, 0, 0, '2023-09-09 18:16:33');

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
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `c_locations` text NOT NULL,
  `c_timecardid` int(11) NOT NULL,
  `c_idno` int(11) NOT NULL,
  `c_trandate` date NOT NULL,
  `c_trantime` time NOT NULL,
  `c_trantype` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `c_locations`, `c_timecardid`, `c_idno`, `c_trandate`, `c_trantime`, `c_trantype`) VALUES
(1, 'MAL', 1381145, 20030, '2023-08-20', '07:17:35', 'A'),
(2, 'MAL', 1381146, 20119, '2023-08-20', '07:18:12', 'A'),
(3, 'MAL', 1381147, 20060, '2023-08-21', '07:17:54', 'A'),
(4, 'MAL', 1381148, 20036, '2023-08-22', '05:38:51', 'A'),
(5, 'MAL', 1381149, 20062, '2023-08-22', '05:55:22', 'A'),
(6, 'MAL', 1381150, 20097, '2023-08-22', '06:42:29', 'A'),
(7, 'MAL', 1381151, 20059, '2023-08-22', '06:51:57', 'A'),
(8, 'MAL', 1381152, 10144, '2023-08-22', '06:52:46', 'A'),
(9, 'MAL', 1381153, 20051, '2023-08-22', '06:57:49', 'A'),
(10, 'MAL', 1381154, 20115, '2023-08-22', '06:59:56', 'A'),
(11, 'MAL', 1381155, 20054, '2023-08-22', '07:09:28', 'A'),
(12, 'MAL', 1381156, 20104, '2023-08-22', '07:10:28', 'A'),
(13, 'MAL', 1381157, 10126, '2023-08-22', '07:10:53', 'A'),
(14, 'MAL', 1381158, 20038, '2023-08-22', '07:11:20', 'A'),
(15, 'MAL', 1381159, 10114, '2023-08-22', '07:18:18', 'A'),
(16, 'MAL', 1381160, 20050, '2023-08-22', '07:21:12', 'A'),
(17, 'MAL', 1381161, 10073, '2023-08-22', '07:21:37', 'A'),
(18, 'MAL', 1381162, 20181, '2023-08-22', '07:22:35', 'A'),
(19, 'MAL', 1381163, 20121, '2023-08-22', '07:27:18', 'A'),
(20, 'MAL', 1381164, 20002, '2023-08-22', '07:29:40', 'A'),
(21, 'MAL', 1381165, 10007, '2023-08-22', '07:29:45', 'A'),
(22, 'MAL', 1381166, 20205, '2023-08-22', '07:29:52', 'A'),
(23, 'MAL', 1381167, 20008, '2023-08-22', '07:29:57', 'A'),
(24, 'MAL', 1381168, 10013, '2023-08-22', '07:30:13', 'A'),
(25, 'MAL', 1381169, 20035, '2023-08-22', '07:32:15', 'A'),
(26, 'MAL', 1381170, 20165, '2023-08-22', '07:32:31', 'A'),
(27, 'MAL', 1381171, 10017, '2023-08-22', '07:32:40', 'A'),
(28, 'MAL', 1381172, 20060, '2023-08-22', '07:32:44', 'A'),
(29, 'MAL', 1381173, 20012, '2023-08-22', '07:32:44', 'A'),
(30, 'MAL', 1381174, 10147, '2023-08-22', '07:32:49', 'A'),
(31, 'MAL', 1381175, 20118, '2023-08-22', '07:35:01', 'A'),
(32, 'MAL', 1381176, 10177, '2023-08-22', '07:36:18', 'A'),
(33, 'MAL', 1381177, 20015, '2023-08-22', '07:36:28', 'A'),
(34, 'MAL', 1381178, 10160, '2023-08-22', '07:37:18', 'A'),
(35, 'MAL', 1381179, 30003, '2023-08-22', '07:37:33', 'A'),
(36, 'MAL', 1381180, 20134, '2023-08-22', '07:38:26', 'A'),
(37, 'MAL', 1381181, 10167, '2023-08-22', '07:39:10', 'A'),
(38, 'MAL', 1381182, 10110, '2023-08-22', '07:39:43', 'A'),
(39, 'MAL', 1381183, 20017, '2023-08-22', '07:39:58', 'A'),
(40, 'MAL', 1381184, 10023, '2023-08-22', '07:41:08', 'A'),
(41, 'MAL', 1381185, 20016, '2023-08-22', '07:42:38', 'A'),
(42, 'MAL', 1381186, 20023, '2023-08-22', '07:44:00', 'A'),
(43, 'MAL', 1381187, 20139, '2023-08-22', '07:44:54', 'A'),
(44, 'MAL', 1381188, 20131, '2023-08-22', '07:45:30', 'A'),
(45, 'MAL', 1381189, 10034, '2023-08-22', '07:45:37', 'A'),
(46, 'MAL', 1381190, 10035, '2023-08-22', '07:46:06', 'A'),
(47, 'MAL', 1381191, 10176, '2023-08-22', '07:46:14', 'A'),
(48, 'MAL', 1381192, 10139, '2023-08-22', '07:46:17', 'A'),
(49, 'MAL', 1381193, 10075, '2023-08-22', '07:46:18', 'A'),
(50, 'MAL', 1381194, 20044, '2023-08-22', '07:46:34', 'A'),
(51, 'MAL', 1381195, 20151, '2023-08-22', '07:47:37', 'A'),
(52, 'MAL', 1381196, 20115, '2023-08-22', '07:47:54', 'A'),
(53, 'MAL', 1381197, 10135, '2023-08-22', '07:48:08', 'A'),
(54, 'MAL', 1381198, 20186, '2023-08-22', '07:48:13', 'A'),
(55, 'MAL', 1381199, 20159, '2023-08-22', '07:48:17', 'A'),
(56, 'MAL', 1381200, 20182, '2023-08-22', '07:48:20', 'A'),
(57, 'MAL', 1381201, 10145, '2023-08-22', '07:48:23', 'A'),
(58, 'MAL', 1381202, 20204, '2023-08-22', '07:48:29', 'A'),
(59, 'MAL', 1381203, 10171, '2023-08-22', '07:48:32', 'A'),
(60, 'MAL', 1381204, 20128, '2023-08-22', '07:48:35', 'A'),
(61, 'MAL', 1381205, 20043, '2023-08-22', '07:49:03', 'A'),
(62, 'MAL', 1381206, 30006, '2023-08-22', '07:49:49', 'A'),
(63, 'MAL', 1381207, 20018, '2023-08-22', '07:49:59', 'A'),
(64, 'MAL', 1381208, 10038, '2023-08-22', '07:50:18', 'A'),
(65, 'MAL', 1381209, 10041, '2023-08-22', '07:50:22', 'A'),
(66, 'MAL', 1381210, 10027, '2023-08-22', '07:50:41', 'A'),
(67, 'MAL', 1381211, 10172, '2023-08-22', '07:52:11', 'A'),
(68, 'MAL', 1381212, 20198, '2023-08-22', '07:52:23', 'A'),
(69, 'MAL', 1381213, 20053, '2023-08-22', '07:53:24', 'A'),
(70, 'MAL', 1381214, 20136, '2023-08-22', '07:53:53', 'A'),
(71, 'MAL', 1381215, 20087, '2023-08-22', '07:53:56', 'A'),
(72, 'MAL', 1381216, 20152, '2023-08-22', '07:54:01', 'A'),
(73, 'MAL', 1381217, 20069, '2023-08-22', '07:54:22', 'A'),
(74, 'MAL', 1381218, 20082, '2023-08-22', '07:54:26', 'A'),
(75, 'MAL', 1381219, 20112, '2023-08-22', '07:54:34', 'A'),
(76, 'MAL', 1381220, 10174, '2023-08-22', '07:56:29', 'A'),
(77, 'MAL', 1381221, 10175, '2023-08-22', '07:56:34', 'A'),
(78, 'MAL', 1381222, 20106, '2023-08-22', '07:56:48', 'A'),
(79, 'MAL', 1381223, 20091, '2023-08-22', '07:56:52', 'A'),
(80, 'MAL', 1381224, 20078, '2023-08-22', '07:57:00', 'A'),
(81, 'MAL', 1381225, 20189, '2023-08-22', '07:57:22', 'A'),
(82, 'MAL', 1381226, 10140, '2023-08-22', '07:57:57', 'A'),
(83, 'MAL', 1381227, 20084, '2023-08-22', '07:58:00', 'A'),
(84, 'MAL', 1381228, 20192, '2023-08-22', '07:58:12', 'A'),
(85, 'MAL', 1381229, 20168, '2023-08-22', '07:58:12', 'A'),
(86, 'MAL', 1381230, 10093, '2023-08-22', '07:58:29', 'A'),
(87, 'MAL', 1381231, 20098, '2023-08-22', '07:59:25', 'A'),
(88, 'MAL', 1381232, 20003, '2023-08-22', '07:59:30', 'A'),
(89, 'MAL', 1381233, 20124, '2023-08-22', '07:59:35', 'A'),
(90, 'MAL', 1381234, 20132, '2023-08-22', '07:59:37', 'A'),
(91, 'MAL', 1381235, 20100, '2023-08-22', '07:59:40', 'A'),
(92, 'MAL', 1381236, 20191, '2023-08-22', '07:59:41', 'A'),
(93, 'MAL', 1381237, 10113, '2023-08-22', '07:59:45', 'A'),
(94, 'MAL', 1381238, 10169, '2023-08-22', '07:59:49', 'A'),
(95, 'MAL', 1381239, 10026, '2023-08-22', '07:59:57', 'A'),
(96, 'MAL', 1381240, 10163, '2023-08-22', '08:00:07', 'A'),
(97, 'MAL', 1381241, 20071, '2023-08-22', '08:00:31', 'A'),
(98, 'MAL', 1381242, 20007, '2023-08-22', '08:00:36', 'A'),
(99, 'MAL', 1381243, 20056, '2023-08-22', '08:00:36', 'A'),
(100, 'MAL', 1381244, 10154, '2023-08-22', '08:00:40', 'A'),
(101, 'MAL', 1381245, 20190, '2023-08-22', '08:00:44', 'A'),
(102, 'MAL', 1381246, 20064, '2023-08-22', '08:00:51', 'A'),
(103, 'MAL', 1381247, 10021, '2023-08-22', '08:00:52', 'A'),
(104, 'MAL', 1381248, 10121, '2023-08-22', '08:00:59', 'A'),
(105, 'MAL', 1381249, 10170, '2023-08-22', '08:01:02', 'A'),
(106, 'MAL', 1381250, 10168, '2023-08-22', '08:01:03', 'A'),
(107, 'MAL', 1381251, 20160, '2023-08-22', '08:01:06', 'A'),
(108, 'MAL', 1381252, 10164, '2023-08-22', '08:01:09', 'A'),
(109, 'MAL', 1381253, 10115, '2023-08-22', '08:01:17', 'A'),
(110, 'MAL', 1381254, 20175, '2023-08-22', '08:03:17', 'A'),
(111, 'MAL', 1381255, 10120, '2023-08-22', '08:03:19', 'A'),
(112, 'MAL', 1381256, 10012, '2023-08-22', '08:03:50', 'A'),
(113, 'MAL', 1381257, 30008, '2023-08-22', '08:03:56', 'A'),
(114, 'MAL', 1381258, 10143, '2023-08-22', '08:04:03', 'A'),
(115, 'MAL', 1381259, 20063, '2023-08-22', '08:04:17', 'A'),
(116, 'MAL', 1381260, 20029, '2023-08-22', '08:05:30', 'A'),
(117, 'MAL', 1381261, 10015, '2023-08-22', '08:05:33', 'A'),
(118, 'MAL', 1381262, 20001, '2023-08-22', '08:05:42', 'A'),
(119, 'MAL', 1381263, 20074, '2023-08-22', '08:06:27', 'A'),
(120, 'MAL', 1381264, 20032, '2023-08-22', '08:06:29', 'A'),
(121, 'MAL', 1381265, 20133, '2023-08-22', '08:06:33', 'A'),
(122, 'MAL', 1381266, 20123, '2023-08-22', '08:06:36', 'A'),
(123, 'MAL', 1381267, 20076, '2023-08-22', '08:06:41', 'A'),
(124, 'MAL', 1381268, 10009, '2023-08-22', '08:06:44', 'A'),
(125, 'MAL', 1381269, 10146, '2023-08-22', '08:09:56', 'A'),
(126, 'MAL', 1381270, 10173, '2023-08-22', '08:11:41', 'A'),
(127, 'MAL', 1381271, 10148, '2023-08-22', '08:16:38', 'A'),
(128, 'MAL', 1381272, 10030, '2023-08-22', '08:25:28', 'A'),
(129, 'MAL', 1381273, 60120, '2023-08-22', '08:56:24', 'A'),
(130, 'MAL', 1381274, 20006, '2023-08-22', '08:58:10', 'A'),
(131, 'MAL', 1381275, 10086, '2023-08-22', '09:00:34', 'A'),
(132, 'MAL', 1381276, 10094, '2023-08-22', '09:08:03', 'A'),
(133, 'MAL', 1381277, 10103, '2023-08-22', '09:21:32', 'A'),
(134, 'MAL', 1381278, 10095, '2023-08-22', '10:29:20', 'A'),
(135, 'MAL', 1381279, 10034, '2023-08-22', '10:44:24', 'A'),
(136, 'MAL', 1381280, 10100, '2023-08-22', '11:08:39', 'A'),
(137, 'MAL', 1381281, 10113, '2023-08-22', '11:32:33', 'B'),
(138, 'MAL', 1381282, 10113, '2023-08-22', '11:47:36', 'C'),
(139, 'MAL', 1381283, 20189, '2023-08-22', '12:00:20', 'B'),
(140, 'MAL', 1381284, 20189, '2023-08-22', '12:33:31', 'C'),
(141, 'MAL', 1381285, 20074, '2023-08-22', '12:34:08', 'B'),
(142, 'MAL', 1381286, 20182, '2023-08-22', '12:34:10', 'B'),
(143, 'MAL', 1381287, 10136, '2023-08-22', '12:39:20', 'A'),
(144, 'MAL', 1381288, 20186, '2023-08-22', '12:54:52', 'Z'),
(145, 'MAL', 1381289, 20182, '2023-08-22', '13:05:35', 'C'),
(146, 'MAL', 1381290, 20074, '2023-08-22', '13:06:15', 'C'),
(147, 'MAL', 1381291, 20036, '2023-08-22', '16:02:30', 'Z'),
(148, 'MAL', 1381292, 20119, '2023-08-22', '16:05:41', 'Z'),
(149, 'MAL', 1381293, 10126, '2023-08-22', '16:12:49', 'Z'),
(150, 'MAL', 1381294, 20115, '2023-08-22', '17:00:03', 'Z'),
(151, 'MAL', 1381295, 20118, '2023-08-22', '17:00:11', 'Z'),
(152, 'MAL', 1381296, 20204, '2023-08-22', '17:00:18', 'Z'),
(153, 'MAL', 1381297, 20053, '2023-08-22', '17:00:21', 'Z'),
(154, 'MAL', 1381298, 20182, '2023-08-22', '17:00:23', 'Z'),
(155, 'MAL', 1381299, 20098, '2023-08-22', '17:00:30', 'Z'),
(156, 'MAL', 1381300, 20016, '2023-08-22', '17:00:39', 'Z'),
(157, 'MAL', 1381301, 10140, '2023-08-22', '17:00:42', 'Z'),
(158, 'MAL', 1381302, 20043, '2023-08-22', '17:00:45', 'Z'),
(159, 'MAL', 1381303, 10139, '2023-08-22', '17:00:46', 'Z'),
(160, 'MAL', 1381304, 20123, '2023-08-22', '17:00:49', 'Z'),
(161, 'MAL', 1381305, 10103, '2023-08-22', '17:00:52', 'Z'),
(162, 'MAL', 1381306, 10144, '2023-08-22', '17:00:59', 'Z'),
(163, 'MAL', 1381307, 20017, '2023-08-22', '17:01:04', 'Z'),
(164, 'MAL', 1381308, 20078, '2023-08-22', '17:01:05', 'Z'),
(165, 'MAL', 1381309, 20035, '2023-08-22', '17:01:06', 'Z'),
(166, 'MAL', 1381310, 10136, '2023-08-22', '17:01:09', 'Z'),
(167, 'MAL', 1381311, 30003, '2023-08-22', '17:01:12', 'Z'),
(168, 'MAL', 1381312, 10013, '2023-08-22', '17:01:15', 'Z'),
(169, 'MAL', 1381313, 20136, '2023-08-22', '17:01:15', 'Z'),
(170, 'MAL', 1381314, 20012, '2023-08-22', '17:01:21', 'Z'),
(171, 'MAL', 1381315, 20038, '2023-08-22', '17:01:26', 'Z'),
(172, 'MAL', 1381316, 20151, '2023-08-22', '17:01:27', 'Z'),
(173, 'MAL', 1381317, 10176, '2023-08-22', '17:01:28', 'Z'),
(174, 'MAL', 1381318, 10168, '2023-08-22', '17:01:31', 'Z'),
(175, 'MAL', 1381319, 30008, '2023-08-22', '17:01:37', 'Z'),
(176, 'MAL', 1381320, 20087, '2023-08-22', '17:01:42', 'Z'),
(177, 'MAL', 1381321, 10147, '2023-08-22', '17:01:46', 'Z'),
(178, 'MAL', 1381322, 20064, '2023-08-22', '17:01:46', 'Z'),
(179, 'MAL', 1381323, 10164, '2023-08-22', '17:01:49', 'Z'),
(180, 'MAL', 1381324, 20139, '2023-08-22', '17:01:55', 'Z'),
(181, 'MAL', 1381325, 20084, '2023-08-22', '17:01:56', 'Z'),
(182, 'MAL', 1381326, 20175, '2023-08-22', '17:01:58', 'Z'),
(183, 'MAL', 1381327, 10075, '2023-08-22', '17:02:00', 'Z'),
(184, 'MAL', 1381328, 20189, '2023-08-22', '17:02:02', 'Z'),
(185, 'MAL', 1381329, 10171, '2023-08-22', '17:02:07', 'Z'),
(186, 'MAL', 1381330, 20056, '2023-08-22', '17:02:09', 'Z'),
(187, 'MAL', 1381331, 10110, '2023-08-22', '17:02:12', 'Z'),
(188, 'MAL', 1381332, 20063, '2023-08-22', '17:02:13', 'Z'),
(189, 'MAL', 1381333, 20112, '2023-08-22', '17:02:14', 'Z'),
(190, 'MAL', 1381334, 10093, '2023-08-22', '17:02:16', 'Z'),
(191, 'MAL', 1381335, 10170, '2023-08-22', '17:02:19', 'Z'),
(192, 'MAL', 1381336, 20133, '2023-08-22', '17:02:23', 'Z'),
(193, 'MAL', 1381337, 20054, '2023-08-22', '17:02:23', 'Z'),
(194, 'MAL', 1381338, 10007, '2023-08-22', '17:02:34', 'Z'),
(195, 'MAL', 1381339, 20032, '2023-08-22', '17:02:35', 'Z'),
(196, 'MAL', 1381340, 10120, '2023-08-22', '17:02:38', 'Z'),
(197, 'MAL', 1381341, 20059, '2023-08-22', '17:02:38', 'Z'),
(198, 'MAL', 1381342, 20124, '2023-08-22', '17:02:39', 'Z'),
(199, 'MAL', 1381343, 20100, '2023-08-22', '17:02:42', 'Z'),
(200, 'MAL', 1381344, 20191, '2023-08-22', '17:02:44', 'Z'),
(201, 'MAL', 1381345, 20069, '2023-08-22', '17:02:46', 'Z'),
(202, 'MAL', 1381346, 20121, '2023-08-22', '17:02:48', 'Z'),
(203, 'MAL', 1381347, 10146, '2023-08-22', '17:02:51', 'Z'),
(204, 'MAL', 1381348, 20168, '2023-08-22', '17:02:55', 'Z'),
(205, 'MAL', 1381349, 20192, '2023-08-22', '17:02:58', 'Z'),
(206, 'MAL', 1381350, 10145, '2023-08-22', '17:02:58', 'Z'),
(207, 'MAL', 1381351, 10174, '2023-08-22', '17:02:59', 'Z'),
(208, 'MAL', 1381352, 10026, '2023-08-22', '17:03:01', 'Z'),
(209, 'MAL', 1381353, 10175, '2023-08-22', '17:03:05', 'Z'),
(210, 'MAL', 1381354, 20190, '2023-08-22', '17:03:08', 'Z'),
(211, 'MAL', 1381355, 30006, '2023-08-22', '17:03:08', 'Z'),
(212, 'MAL', 1381356, 20128, '2023-08-22', '17:03:13', 'Z'),
(213, 'MAL', 1381357, 10027, '2023-08-22', '17:03:14', 'Z'),
(214, 'MAL', 1381358, 20071, '2023-08-22', '17:03:18', 'Z'),
(215, 'MAL', 1381359, 10163, '2023-08-22', '17:03:19', 'Z'),
(216, 'MAL', 1381360, 20131, '2023-08-22', '17:03:21', 'Z'),
(217, 'MAL', 1381361, 10160, '2023-08-22', '17:03:22', 'Z'),
(218, 'MAL', 1381362, 20104, '2023-08-22', '17:03:23', 'Z'),
(219, 'MAL', 1381363, 10177, '2023-08-22', '17:03:28', 'Z'),
(220, 'MAL', 1381364, 20160, '2023-08-22', '17:03:30', 'Z'),
(221, 'MAL', 1381365, 10100, '2023-08-22', '17:03:32', 'Z'),
(222, 'MAL', 1381366, 10113, '2023-08-22', '17:03:35', 'Z'),
(223, 'MAL', 1381367, 10169, '2023-08-22', '17:03:35', 'Z'),
(224, 'MAL', 1381368, 10012, '2023-08-22', '17:03:41', 'Z'),
(225, 'MAL', 1381369, 20165, '2023-08-22', '17:03:45', 'Z'),
(226, 'MAL', 1381370, 20082, '2023-08-22', '17:03:49', 'Z'),
(227, 'MAL', 1381371, 10023, '2023-08-22', '17:03:58', 'Z'),
(228, 'MAL', 1381372, 20106, '2023-08-22', '17:03:58', 'Z'),
(229, 'MAL', 1381373, 10154, '2023-08-22', '17:04:03', 'Z'),
(230, 'MAL', 1381374, 10017, '2023-08-22', '17:04:08', 'Z'),
(231, 'MAL', 1381375, 20002, '2023-08-22', '17:04:12', 'Z'),
(232, 'MAL', 1381376, 10034, '2023-08-22', '17:04:17', 'Z'),
(233, 'MAL', 1381377, 20074, '2023-08-22', '17:04:21', 'Z'),
(234, 'MAL', 1381378, 20076, '2023-08-22', '17:04:31', 'Z'),
(235, 'MAL', 1381379, 20001, '2023-08-22', '17:04:37', 'Z'),
(236, 'MAL', 1381380, 20007, '2023-08-22', '17:04:42', 'Z'),
(237, 'MAL', 1381381, 10038, '2023-08-22', '17:04:48', 'Z'),
(238, 'MAL', 1381382, 10073, '2023-08-22', '17:04:50', 'Z'),
(239, 'MAL', 1381383, 20050, '2023-08-22', '17:05:00', 'Z'),
(240, 'MAL', 1381384, 20198, '2023-08-22', '17:05:01', 'Z'),
(241, 'MAL', 1381385, 10172, '2023-08-22', '17:05:09', 'Z'),
(242, 'MAL', 1381386, 10095, '2023-08-22', '17:05:10', 'Z'),
(243, 'MAL', 1381387, 10035, '2023-08-22', '17:05:20', 'Z'),
(244, 'MAL', 1381388, 20205, '2023-08-22', '17:05:37', 'Z'),
(245, 'MAL', 1381389, 20091, '2023-08-22', '17:05:44', 'Z'),
(246, 'MAL', 1381390, 20181, '2023-08-22', '17:06:21', 'Z'),
(247, 'MAL', 1381391, 20008, '2023-08-22', '17:06:37', 'Z'),
(248, 'MAL', 1381392, 20062, '2023-08-22', '17:06:51', 'Z'),
(249, 'MAL', 1381393, 20159, '2023-08-22', '17:07:34', 'Z'),
(250, 'MAL', 1381394, 10173, '2023-08-22', '17:07:40', 'Z'),
(251, 'MAL', 1381395, 10135, '2023-08-22', '17:07:41', 'Z'),
(252, 'MAL', 1381396, 10167, '2023-08-22', '17:07:43', 'Z'),
(253, 'MAL', 1381397, 10009, '2023-08-22', '17:07:53', 'Z'),
(254, 'MAL', 1381398, 10041, '2023-08-22', '17:08:33', 'Z'),
(255, 'MAL', 1381399, 20134, '2023-08-22', '17:08:49', 'Z'),
(256, 'MAL', 1381400, 10015, '2023-08-22', '17:09:07', 'Z'),
(257, 'MAL', 1381401, 20029, '2023-08-22', '17:09:10', 'Z'),
(258, 'MAL', 1381402, 20015, '2023-08-22', '17:09:30', 'Z'),
(259, 'MAL', 1381403, 10114, '2023-08-22', '17:10:04', 'Z'),
(260, 'MAL', 1381404, 10121, '2023-08-22', '17:10:38', 'Z'),
(261, 'MAL', 1381405, 20018, '2023-08-22', '17:10:42', 'Z'),
(262, 'MAL', 1381406, 10143, '2023-08-22', '17:16:25', 'Z'),
(263, 'MAL', 1381407, 10148, '2023-08-22', '17:19:25', 'Z'),
(264, 'MAL', 1381408, 10030, '2023-08-22', '17:32:20', 'Z'),
(265, 'MAL', 1381409, 10094, '2023-08-22', '17:33:18', 'Z'),
(266, 'MAL', 1381410, 20023, '2023-08-22', '17:33:27', 'Z'),
(267, 'MAL', 1381411, 10021, '2023-08-22', '18:24:15', 'Z'),
(268, 'MAL', 1381412, 10086, '2023-08-22', '18:27:24', 'Z'),
(269, 'MAL', 1381413, 20006, '2023-08-22', '18:55:41', 'Z'),
(270, 'MAL', 1381414, 20062, '2023-08-23', '05:52:22', 'A'),
(271, 'MAL', 1381415, 20036, '2023-08-23', '05:53:25', 'A'),
(272, 'MAL', 1381416, 20030, '2023-08-23', '06:18:59', 'A'),
(273, 'MAL', 1381417, 20051, '2023-08-23', '06:43:23', 'A'),
(274, 'MAL', 1381418, 20119, '2023-08-23', '06:50:56', 'A'),
(275, 'MAL', 1381419, 20104, '2023-08-23', '06:51:06', 'A'),
(276, 'MAL', 1381420, 20059, '2023-08-23', '06:58:18', 'A'),
(277, 'MAL', 1381421, 10126, '2023-08-23', '07:02:11', 'A'),
(278, 'MAL', 1381422, 20035, '2023-08-23', '07:05:34', 'A'),
(279, 'MAL', 1381423, 20115, '2023-08-23', '07:06:55', 'A'),
(280, 'MAL', 1381424, 10144, '2023-08-23', '07:12:11', 'A'),
(281, 'MAL', 1381425, 20054, '2023-08-23', '07:12:29', 'A'),
(282, 'MAL', 1381426, 20121, '2023-08-23', '07:19:48', 'A'),
(283, 'MAL', 1381427, 20038, '2023-08-23', '07:21:24', 'A'),
(284, 'MAL', 1381428, 10073, '2023-08-23', '07:23:04', 'A'),
(285, 'MAL', 1381429, 10114, '2023-08-23', '07:23:24', 'A'),
(286, 'MAL', 1381430, 10110, '2023-08-23', '07:24:45', 'A'),
(287, 'MAL', 1381431, 10176, '2023-08-23', '07:26:56', 'A'),
(288, 'MAL', 1381432, 10075, '2023-08-23', '07:26:59', 'A'),
(289, 'MAL', 1381433, 10139, '2023-08-23', '07:27:01', 'A'),
(290, 'MAL', 1381434, 20181, '2023-08-23', '07:27:12', 'A'),
(291, 'MAL', 1381435, 10035, '2023-08-23', '07:27:13', 'A'),
(292, 'MAL', 1381436, 20044, '2023-08-23', '07:27:24', 'A'),
(293, 'MAL', 1381437, 20050, '2023-08-23', '07:28:55', 'A'),
(294, 'MAL', 1381438, 10017, '2023-08-23', '07:29:19', 'A'),
(295, 'MAL', 1381439, 20060, '2023-08-23', '07:29:21', 'A'),
(296, 'MAL', 1381440, 10147, '2023-08-23', '07:29:24', 'A'),
(297, 'MAL', 1381441, 20012, '2023-08-23', '07:29:32', 'A'),
(298, 'MAL', 1381442, 10100, '2023-08-23', '07:29:38', 'A'),
(299, 'MAL', 1381443, 10136, '2023-08-23', '07:29:43', 'A'),
(300, 'MAL', 1381444, 20134, '2023-08-23', '07:34:14', 'A'),
(301, 'MAL', 1381445, 10027, '2023-08-23', '07:35:20', 'A'),
(302, 'MAL', 1381446, 20015, '2023-08-23', '07:36:35', 'A'),
(303, 'MAL', 1381447, 10013, '2023-08-23', '07:37:20', 'A'),
(304, 'MAL', 1381448, 10135, '2023-08-23', '07:38:18', 'A'),
(305, 'MAL', 1381449, 10167, '2023-08-23', '07:39:14', 'A'),
(306, 'MAL', 1381450, 10023, '2023-08-23', '07:40:21', 'A'),
(307, 'MAL', 1381451, 20002, '2023-08-23', '07:40:31', 'A'),
(308, 'MAL', 1381452, 10007, '2023-08-23', '07:40:34', 'A'),
(309, 'MAL', 1381453, 20205, '2023-08-23', '07:40:39', 'A'),
(310, 'MAL', 1381454, 20118, '2023-08-23', '07:40:47', 'A'),
(311, 'MAL', 1381455, 20008, '2023-08-23', '07:40:48', 'A'),
(312, 'MAL', 1381456, 10006, '2023-08-23', '07:40:50', 'A'),
(313, 'MAL', 1381457, 10089, '2023-08-23', '07:42:26', 'A'),
(314, 'MAL', 1381458, 20186, '2023-08-23', '07:42:30', 'A'),
(315, 'MAL', 1381459, 20159, '2023-08-23', '07:42:38', 'A'),
(316, 'MAL', 1381460, 20204, '2023-08-23', '07:42:43', 'A'),
(317, 'MAL', 1381461, 20128, '2023-08-23', '07:42:48', 'A'),
(318, 'MAL', 1381462, 10145, '2023-08-23', '07:42:49', 'A'),
(319, 'MAL', 1381463, 10171, '2023-08-23', '07:42:55', 'A'),
(320, 'MAL', 1381464, 20097, '2023-08-23', '07:42:55', 'A'),
(321, 'MAL', 1381465, 10177, '2023-08-23', '07:43:14', 'A'),
(322, 'MAL', 1381466, 20151, '2023-08-23', '07:43:16', 'A'),
(323, 'MAL', 1381467, 10034, '2023-08-23', '07:45:07', 'A'),
(324, 'MAL', 1381468, 10041, '2023-08-23', '07:45:53', 'A'),
(325, 'MAL', 1381469, 20056, '2023-08-23', '07:47:18', 'A'),
(326, 'MAL', 1381470, 10038, '2023-08-23', '07:47:22', 'A'),
(327, 'MAL', 1381471, 20007, '2023-08-23', '07:47:28', 'A'),
(328, 'MAL', 1381472, 10154, '2023-08-23', '07:47:32', 'A'),
(329, 'MAL', 1381473, 20064, '2023-08-23', '07:47:39', 'A'),
(330, 'MAL', 1381474, 10168, '2023-08-23', '07:47:58', 'A'),
(331, 'MAL', 1381475, 20160, '2023-08-23', '07:48:01', 'A'),
(332, 'MAL', 1381476, 10164, '2023-08-23', '07:48:05', 'A'),
(333, 'MAL', 1381477, 20018, '2023-08-23', '07:48:08', 'A'),
(334, 'MAL', 1381478, 10170, '2023-08-23', '07:48:08', 'A'),
(335, 'MAL', 1381479, 10021, '2023-08-23', '07:48:17', 'A'),
(336, 'MAL', 1381480, 10157, '2023-08-23', '07:48:23', 'A'),
(337, 'MAL', 1381481, 30008, '2023-08-23', '07:48:30', 'A'),
(338, 'MAL', 1381482, 20029, '2023-08-23', '07:49:11', 'A'),
(339, 'MAL', 1381483, 10115, '2023-08-23', '07:49:16', 'A'),
(340, 'MAL', 1381484, 20001, '2023-08-23', '07:49:24', 'A'),
(341, 'MAL', 1381485, 20043, '2023-08-23', '07:49:44', 'A'),
(342, 'MAL', 1381486, 30006, '2023-08-23', '07:49:47', 'A'),
(343, 'MAL', 1381487, 20082, '2023-08-23', '07:50:37', 'A'),
(344, 'MAL', 1381488, 20198, '2023-08-23', '07:51:23', 'A'),
(345, 'MAL', 1381489, 20053, '2023-08-23', '07:52:44', 'A'),
(346, 'MAL', 1381490, 20078, '2023-08-23', '07:53:39', 'A'),
(347, 'MAL', 1381491, 10012, '2023-08-23', '07:53:43', 'A'),
(348, 'MAL', 1381492, 10121, '2023-08-23', '07:53:48', 'A'),
(349, 'MAL', 1381493, 20168, '2023-08-23', '07:54:13', 'A'),
(350, 'MAL', 1381494, 20192, '2023-08-23', '07:54:19', 'A'),
(351, 'MAL', 1381495, 20084, '2023-08-23', '07:54:21', 'A'),
(352, 'MAL', 1381496, 30003, '2023-08-23', '07:54:29', 'A'),
(353, 'MAL', 1381497, 20032, '2023-08-23', '07:54:36', 'A'),
(354, 'MAL', 1381498, 20087, '2023-08-23', '07:54:41', 'A'),
(355, 'MAL', 1381499, 20074, '2023-08-23', '07:54:44', 'A'),
(356, 'MAL', 1381500, 20136, '2023-08-23', '07:54:54', 'A'),
(357, 'MAL', 1381501, 20076, '2023-08-23', '07:54:55', 'A'),
(358, 'MAL', 1381502, 20191, '2023-08-23', '07:54:58', 'A'),
(359, 'MAL', 1381503, 20152, '2023-08-23', '07:55:00', 'A'),
(360, 'MAL', 1381504, 10009, '2023-08-23', '07:55:04', 'A'),
(361, 'MAL', 1381505, 20133, '2023-08-23', '07:55:05', 'A'),
(362, 'MAL', 1381506, 10026, '2023-08-23', '07:55:08', 'A'),
(363, 'MAL', 1381507, 20063, '2023-08-23', '07:55:26', 'A'),
(364, 'MAL', 1381508, 10175, '2023-08-23', '07:55:38', 'A'),
(365, 'MAL', 1381509, 10174, '2023-08-23', '07:55:47', 'A'),
(366, 'MAL', 1381510, 10172, '2023-08-23', '07:56:04', 'A'),
(367, 'MAL', 1381511, 20069, '2023-08-23', '07:56:23', 'A'),
(368, 'MAL', 1381512, 20017, '2023-08-23', '07:58:03', 'A'),
(369, 'MAL', 1381513, 20189, '2023-08-23', '07:58:23', 'A'),
(370, 'MAL', 1381514, 10163, '2023-08-23', '07:59:11', 'A'),
(371, 'MAL', 1381515, 10160, '2023-08-23', '07:59:11', 'A'),
(372, 'MAL', 1381516, 10169, '2023-08-23', '07:59:19', 'A'),
(373, 'MAL', 1381517, 10140, '2023-08-23', '07:59:35', 'A'),
(374, 'MAL', 1381518, 10093, '2023-08-23', '07:59:45', 'A'),
(375, 'MAL', 1381519, 20175, '2023-08-23', '07:59:51', 'A'),
(376, 'MAL', 1381520, 10120, '2023-08-23', '07:59:58', 'A'),
(377, 'MAL', 1381521, 10173, '2023-08-23', '08:00:18', 'A'),
(378, 'MAL', 1381522, 20112, '2023-08-23', '08:00:44', 'A'),
(379, 'MAL', 1381523, 20003, '2023-08-23', '08:01:36', 'A'),
(380, 'MAL', 1381524, 20100, '2023-08-23', '08:01:36', 'A'),
(381, 'MAL', 1381525, 20124, '2023-08-23', '08:01:41', 'A'),
(382, 'MAL', 1381526, 20016, '2023-08-23', '08:01:45', 'A'),
(383, 'MAL', 1381527, 20131, '2023-08-23', '08:01:45', 'A'),
(384, 'MAL', 1381528, 20132, '2023-08-23', '08:01:49', 'A'),
(385, 'MAL', 1381529, 20098, '2023-08-23', '08:01:50', 'A'),
(386, 'MAL', 1381530, 10113, '2023-08-23', '08:01:55', 'A'),
(387, 'MAL', 1381531, 20106, '2023-08-23', '08:03:01', 'A'),
(388, 'MAL', 1381532, 20091, '2023-08-23', '08:03:13', 'A'),
(389, 'MAL', 1381533, 20182, '2023-08-23', '08:03:40', 'A'),
(390, 'MAL', 1381534, 10146, '2023-08-23', '08:04:35', 'A'),
(391, 'MAL', 1381535, 10148, '2023-08-23', '08:06:26', 'A'),
(392, 'MAL', 1381536, 10143, '2023-08-23', '08:11:32', 'A'),
(393, 'MAL', 1381537, 10030, '2023-08-23', '08:20:21', 'A'),
(394, 'MAL', 1381538, 20115, '2023-08-23', '08:23:36', 'A'),
(395, 'MAL', 1381539, 10095, '2023-08-23', '08:27:11', 'A'),
(396, 'MAL', 1381540, 10103, '2023-08-23', '08:35:52', 'A'),
(397, 'MAL', 1381541, 10094, '2023-08-23', '08:37:21', 'A'),
(398, 'MAL', 1381542, 10086, '2023-08-23', '08:44:46', 'A'),
(399, 'MAL', 1381543, 20006, '2023-08-23', '09:00:30', 'A'),
(400, 'MAL', 1381544, 20134, '2023-08-23', '09:38:07', 'A'),
(401, 'MAL', 1381545, 10178, '2023-08-23', '09:40:17', 'A'),
(402, 'MAL', 1381546, 10179, '2023-08-23', '09:42:51', 'A'),
(403, 'MAL', 1381547, 10034, '2023-08-23', '10:23:13', 'A'),
(404, 'MAL', 1381548, 20071, '2023-08-23', '11:49:35', 'A'),
(405, 'MAL', 1381549, 20139, '2023-08-23', '12:29:29', 'A'),
(406, 'MAL', 1381550, 20131, '2023-08-23', '12:46:15', 'B'),
(407, 'MAL', 1381551, 20104, '2023-08-23', '12:57:06', 'Z'),
(408, 'MAL', 1381552, 20131, '2023-08-23', '12:57:43', 'C'),
(409, 'MAL', 1381553, 20115, '2023-08-23', '16:06:25', 'Z'),
(410, 'MAL', 1381554, 10034, '2023-08-23', '16:07:54', 'Z'),
(411, 'MAL', 1381555, 20036, '2023-08-23', '16:10:31', 'Z'),
(412, 'MAL', 1381556, 10126, '2023-08-23', '16:14:30', 'Z'),
(413, 'MAL', 1381557, 20119, '2023-08-23', '16:24:33', 'Z'),
(414, 'MAL', 1381558, 20053, '2023-08-23', '17:00:02', 'Z'),
(415, 'MAL', 1381559, 20204, '2023-08-23', '17:00:12', 'Z'),
(416, 'MAL', 1381560, 20205, '2023-08-23', '17:00:13', 'Z'),
(417, 'MAL', 1381561, 20098, '2023-08-23', '17:00:19', 'Z'),
(418, 'MAL', 1381562, 20182, '2023-08-23', '17:00:23', 'Z'),
(419, 'MAL', 1381563, 10013, '2023-08-23', '17:00:30', 'Z'),
(420, 'MAL', 1381564, 20091, '2023-08-23', '17:00:31', 'Z'),
(421, 'MAL', 1381565, 20078, '2023-08-23', '17:00:33', 'Z'),
(422, 'MAL', 1381566, 10140, '2023-08-23', '17:00:37', 'Z'),
(423, 'MAL', 1381567, 10139, '2023-08-23', '17:00:41', 'Z'),
(424, 'MAL', 1381568, 20012, '2023-08-23', '17:00:44', 'Z'),
(425, 'MAL', 1381569, 10103, '2023-08-23', '17:01:00', 'Z'),
(426, 'MAL', 1381570, 10073, '2023-08-23', '17:01:05', 'Z'),
(427, 'MAL', 1381571, 20038, '2023-08-23', '17:01:05', 'Z'),
(428, 'MAL', 1381572, 10034, '2023-08-23', '17:01:08', 'Z'),
(429, 'MAL', 1381573, 30003, '2023-08-23', '17:01:12', 'Z'),
(430, 'MAL', 1381574, 10136, '2023-08-23', '17:01:13', 'Z'),
(431, 'MAL', 1381575, 10038, '2023-08-23', '17:01:18', 'Z'),
(432, 'MAL', 1381576, 20121, '2023-08-23', '17:01:18', 'A'),
(433, 'MAL', 1381577, 20151, '2023-08-23', '17:01:21', 'Z'),
(434, 'MAL', 1381578, 20016, '2023-08-23', '17:01:23', 'Z'),
(435, 'MAL', 1381579, 20112, '2023-08-23', '17:01:26', 'Z'),
(436, 'MAL', 1381580, 20059, '2023-08-23', '17:01:29', 'Z'),
(437, 'MAL', 1381581, 10176, '2023-08-23', '17:01:29', 'Z'),
(438, 'MAL', 1381582, 20076, '2023-08-23', '17:01:35', 'Z'),
(439, 'MAL', 1381583, 10168, '2023-08-23', '17:01:35', 'Z'),
(440, 'MAL', 1381584, 30008, '2023-08-23', '17:01:38', 'Z'),
(441, 'MAL', 1381585, 20002, '2023-08-23', '17:01:40', 'Z'),
(442, 'MAL', 1381586, 20087, '2023-08-23', '17:01:44', 'Z'),
(443, 'MAL', 1381587, 20084, '2023-08-23', '17:01:47', 'Z'),
(444, 'MAL', 1381588, 10093, '2023-08-23', '17:01:48', 'Z'),
(445, 'MAL', 1381589, 10113, '2023-08-23', '17:01:51', 'Z'),
(446, 'MAL', 1381590, 20064, '2023-08-23', '17:01:52', 'Z'),
(447, 'MAL', 1381591, 20050, '2023-08-23', '17:02:00', 'Z'),
(448, 'MAL', 1381592, 10147, '2023-08-23', '17:02:01', 'Z'),
(449, 'MAL', 1381593, 20032, '2023-08-23', '17:02:02', 'Z'),
(450, 'MAL', 1381594, 10075, '2023-08-23', '17:02:05', 'Z'),
(451, 'MAL', 1381595, 10157, '2023-08-23', '17:02:05', 'Z'),
(452, 'MAL', 1381596, 20069, '2023-08-23', '17:02:06', 'Z'),
(453, 'MAL', 1381597, 10170, '2023-08-23', '17:02:09', 'Z'),
(454, 'MAL', 1381598, 20192, '2023-08-23', '17:02:09', 'Z'),
(455, 'MAL', 1381599, 20168, '2023-08-23', '17:02:11', 'Z'),
(456, 'MAL', 1381600, 10178, '2023-08-23', '17:02:11', 'Z'),
(457, 'MAL', 1381601, 20191, '2023-08-23', '17:02:14', 'Z'),
(458, 'MAL', 1381602, 10171, '2023-08-23', '17:02:14', 'Z'),
(459, 'MAL', 1381603, 10089, '2023-08-23', '17:02:15', 'Z'),
(460, 'MAL', 1381604, 20100, '2023-08-23', '17:02:18', 'Z'),
(461, 'MAL', 1381605, 20118, '2023-08-23', '17:02:18', 'Z'),
(462, 'MAL', 1381606, 10160, '2023-08-23', '17:02:19', 'Z'),
(463, 'MAL', 1381607, 10164, '2023-08-23', '17:02:20', 'Z'),
(464, 'MAL', 1381608, 10145, '2023-08-23', '17:02:21', 'Z'),
(465, 'MAL', 1381609, 20186, '2023-08-23', '17:02:23', 'Z'),
(466, 'MAL', 1381610, 20133, '2023-08-23', '17:02:25', 'Z'),
(467, 'MAL', 1381611, 20136, '2023-08-23', '17:02:26', 'Z'),
(468, 'MAL', 1381612, 20128, '2023-08-23', '17:02:29', 'Z'),
(469, 'MAL', 1381613, 20139, '2023-08-23', '17:02:31', 'Z'),
(470, 'MAL', 1381614, 10027, '2023-08-23', '17:02:32', 'Z'),
(471, 'MAL', 1381615, 20071, '2023-08-23', '17:02:33', 'Z'),
(472, 'MAL', 1381616, 20175, '2023-08-23', '17:02:35', 'Z'),
(473, 'MAL', 1381617, 10163, '2023-08-23', '17:02:35', 'Z'),
(474, 'MAL', 1381618, 20056, '2023-08-23', '17:02:40', 'Z'),
(475, 'MAL', 1381619, 10023, '2023-08-23', '17:02:41', 'Z'),
(476, 'MAL', 1381620, 20051, '2023-08-23', '17:02:44', 'Z'),
(477, 'MAL', 1381621, 10006, '2023-08-23', '17:02:46', 'Z'),
(478, 'MAL', 1381622, 20134, '2023-08-23', '17:02:49', 'Z'),
(479, 'MAL', 1381623, 20054, '2023-08-23', '17:02:51', 'Z'),
(480, 'MAL', 1381624, 20008, '2023-08-23', '17:02:53', 'Z'),
(481, 'MAL', 1381625, 10144, '2023-08-23', '17:02:53', 'Z'),
(482, 'MAL', 1381626, 20029, '2023-08-23', '17:02:58', 'Z'),
(483, 'MAL', 1381627, 20074, '2023-08-23', '17:02:59', 'Z'),
(484, 'MAL', 1381628, 10007, '2023-08-23', '17:03:04', 'Z'),
(485, 'MAL', 1381629, 20198, '2023-08-23', '17:03:06', 'Z'),
(486, 'MAL', 1381630, 10174, '2023-08-23', '17:03:09', 'Z'),
(487, 'MAL', 1381631, 20131, '2023-08-23', '17:03:10', 'Z'),
(488, 'MAL', 1381632, 10175, '2023-08-23', '17:03:14', 'Z'),
(489, 'MAL', 1381633, 20017, '2023-08-23', '17:03:16', 'Z'),
(490, 'MAL', 1381634, 20160, '2023-08-23', '17:03:16', 'Z'),
(491, 'MAL', 1381635, 20063, '2023-08-23', '17:03:20', 'Z'),
(492, 'MAL', 1381636, 10154, '2023-08-23', '17:03:24', 'Z'),
(493, 'MAL', 1381637, 10179, '2023-08-23', '17:03:27', 'Z'),
(494, 'MAL', 1381638, 10009, '2023-08-23', '17:03:31', 'Z'),
(495, 'MAL', 1381639, 20106, '2023-08-23', '17:03:37', 'Z'),
(496, 'MAL', 1381640, 20082, '2023-08-23', '17:03:42', 'Z'),
(497, 'MAL', 1381641, 20007, '2023-08-23', '17:03:46', 'Z'),
(498, 'MAL', 1381642, 10120, '2023-08-23', '17:03:49', 'Z'),
(499, 'MAL', 1381643, 30006, '2023-08-23', '17:03:57', 'Z'),
(500, 'MAL', 1381644, 10035, '2023-08-23', '17:04:01', 'Z'),
(501, 'MAL', 1381645, 20189, '2023-08-23', '17:04:03', 'Z'),
(502, 'MAL', 1381646, 10146, '2023-08-23', '17:04:05', 'Z'),
(503, 'MAL', 1381647, 20043, '2023-08-23', '17:04:08', 'Z'),
(504, 'MAL', 1381648, 20124, '2023-08-23', '17:04:16', 'Z'),
(505, 'MAL', 1381649, 10017, '2023-08-23', '17:04:26', 'Z'),
(506, 'MAL', 1381650, 10026, '2023-08-23', '17:04:30', 'Z'),
(507, 'MAL', 1381651, 20035, '2023-08-23', '17:04:50', 'Z'),
(508, 'MAL', 1381652, 10135, '2023-08-23', '17:04:59', 'Z'),
(509, 'MAL', 1381653, 10173, '2023-08-23', '17:05:05', 'Z'),
(510, 'MAL', 1381654, 10012, '2023-08-23', '17:05:10', 'Z'),
(511, 'MAL', 1381655, 10167, '2023-08-23', '17:05:15', 'Z'),
(512, 'MAL', 1381656, 10177, '2023-08-23', '17:05:15', 'Z'),
(513, 'MAL', 1381657, 10100, '2023-08-23', '17:05:19', 'Z'),
(514, 'MAL', 1381658, 20159, '2023-08-23', '17:05:25', 'Z'),
(515, 'MAL', 1381659, 20181, '2023-08-23', '17:05:54', 'Z'),
(516, 'MAL', 1381660, 20062, '2023-08-23', '17:06:17', 'Z'),
(517, 'MAL', 1381661, 10121, '2023-08-23', '17:06:48', 'Z'),
(518, 'MAL', 1381662, 10110, '2023-08-23', '17:08:42', 'Z'),
(519, 'MAL', 1381663, 20097, '2023-08-23', '17:08:45', 'Z'),
(520, 'MAL', 1381664, 20015, '2023-08-23', '17:08:50', 'Z'),
(521, 'MAL', 1381665, 20018, '2023-08-23', '17:08:54', 'Z'),
(522, 'MAL', 1381666, 20076, '2023-08-23', '17:10:36', 'Z'),
(523, 'MAL', 1381667, 60120, '2023-08-23', '17:11:29', 'Z'),
(524, 'MAL', 1381668, 10114, '2023-08-23', '17:13:18', 'Z'),
(525, 'MAL', 1381669, 10143, '2023-08-23', '17:22:01', 'Z'),
(526, 'MAL', 1381670, 10148, '2023-08-23', '17:22:51', 'Z'),
(527, 'MAL', 1381671, 10030, '2023-08-23', '17:25:43', 'Z'),
(528, 'MAL', 1381672, 20003, '2023-08-23', '17:25:49', 'Z'),
(529, 'MAL', 1381673, 10095, '2023-08-23', '17:33:06', 'Z'),
(530, 'MAL', 1381674, 10094, '2023-08-23', '17:35:58', 'Z'),
(531, 'MAL', 1381675, 10169, '2023-08-23', '17:51:37', 'Z'),
(532, 'MAL', 1381676, 10086, '2023-08-23', '18:14:06', 'Z'),
(533, 'MAL', 1381677, 10021, '2023-08-23', '18:29:56', 'Z'),
(534, 'MAL', 1381678, 20006, '2023-08-23', '18:30:58', 'Z'),
(535, 'MAL', 1381679, 20036, '2023-08-24', '05:50:02', 'A'),
(536, 'MAL', 1381680, 20082, '2023-08-24', '06:37:39', 'A'),
(537, 'MAL', 1381681, 20115, '2023-08-24', '06:44:21', 'A'),
(538, 'MAL', 1381682, 10178, '2023-08-24', '06:49:51', 'A'),
(539, 'MAL', 1381683, 20119, '2023-08-24', '06:52:41', 'A'),
(540, 'MAL', 1381684, 10144, '2023-08-24', '06:52:47', 'A'),
(541, 'MAL', 1381685, 20035, '2023-08-24', '06:56:34', 'A'),
(542, 'MAL', 1381686, 20054, '2023-08-24', '07:02:20', 'A'),
(543, 'MAL', 1381687, 20104, '2023-08-24', '07:05:13', 'A'),
(544, 'MAL', 1381688, 10114, '2023-08-24', '07:05:36', 'A'),
(545, 'MAL', 1381689, 20181, '2023-08-24', '07:09:45', 'A'),
(546, 'MAL', 1381690, 20059, '2023-08-24', '07:15:46', 'A'),
(547, 'MAL', 1381691, 20050, '2023-08-24', '07:16:11', 'A'),
(548, 'MAL', 1381692, 20051, '2023-08-24', '07:18:51', 'A'),
(549, 'MAL', 1381693, 10073, '2023-08-24', '07:19:05', 'A'),
(550, 'MAL', 1381694, 20121, '2023-08-24', '07:21:20', 'A'),
(551, 'MAL', 1381695, 10027, '2023-08-24', '07:22:47', 'A'),
(552, 'MAL', 1381696, 20115, '2023-08-24', '07:26:23', 'A'),
(553, 'MAL', 1381697, 10110, '2023-08-24', '07:28:25', 'A'),
(554, 'MAL', 1381698, 20012, '2023-08-24', '07:32:05', 'A'),
(555, 'MAL', 1381699, 10100, '2023-08-24', '07:32:10', 'A'),
(556, 'MAL', 1381700, 20165, '2023-08-24', '07:32:14', 'A'),
(557, 'MAL', 1381701, 10017, '2023-08-24', '07:32:19', 'A'),
(558, 'MAL', 1381702, 20060, '2023-08-24', '07:32:23', 'A'),
(559, 'MAL', 1381703, 10136, '2023-08-24', '07:32:24', 'A'),
(560, 'MAL', 1381704, 10007, '2023-08-24', '07:33:11', 'A'),
(561, 'MAL', 1381705, 20002, '2023-08-24', '07:33:24', 'A'),
(562, 'MAL', 1381706, 20008, '2023-08-24', '07:33:39', 'A'),
(563, 'MAL', 1381707, 20205, '2023-08-24', '07:33:45', 'A'),
(564, 'MAL', 1381708, 10157, '2023-08-24', '07:33:49', 'A'),
(565, 'MAL', 1381709, 10147, '2023-08-24', '07:34:03', 'A'),
(566, 'MAL', 1381710, 20134, '2023-08-24', '07:34:38', 'A'),
(567, 'MAL', 1381711, 20015, '2023-08-24', '07:35:00', 'A'),
(568, 'MAL', 1381712, 20151, '2023-08-24', '07:35:12', 'A'),
(569, 'MAL', 1381713, 10173, '2023-08-24', '07:35:27', 'A'),
(570, 'MAL', 1381714, 10177, '2023-08-24', '07:35:44', 'A'),
(571, 'MAL', 1381715, 10023, '2023-08-24', '07:43:49', 'A'),
(572, 'MAL', 1381716, 10038, '2023-08-24', '07:43:54', 'A'),
(573, 'MAL', 1381717, 10035, '2023-08-24', '07:43:59', 'A'),
(574, 'MAL', 1381718, 10075, '2023-08-24', '07:44:03', 'A'),
(575, 'MAL', 1381719, 10139, '2023-08-24', '07:44:07', 'A'),
(576, 'MAL', 1381720, 10176, '2023-08-24', '07:44:10', 'A'),
(577, 'MAL', 1381721, 20044, '2023-08-24', '07:44:12', 'A'),
(578, 'MAL', 1381722, 20137, '2023-08-24', '07:44:14', 'A'),
(579, 'MAL', 1381723, 20044, '2023-08-24', '07:44:23', 'A'),
(580, 'MAL', 1381724, 10006, '2023-08-24', '07:45:24', 'A'),
(581, 'MAL', 1381725, 10126, '2023-08-24', '07:45:37', 'A'),
(582, 'MAL', 1381726, 20118, '2023-08-24', '07:45:43', 'A'),
(583, 'MAL', 1381727, 10034, '2023-08-24', '07:46:41', 'A'),
(584, 'MAL', 1381728, 10167, '2023-08-24', '07:46:55', 'A'),
(585, 'MAL', 1381729, 10012, '2023-08-24', '07:47:04', 'A'),
(586, 'MAL', 1381730, 10013, '2023-08-24', '07:47:28', 'A'),
(587, 'MAL', 1381731, 10089, '2023-08-24', '07:47:32', 'A'),
(588, 'MAL', 1381732, 20182, '2023-08-24', '07:47:38', 'A'),
(589, 'MAL', 1381733, 20159, '2023-08-24', '07:47:42', 'A'),
(590, 'MAL', 1381734, 20186, '2023-08-24', '07:47:45', 'A'),
(591, 'MAL', 1381735, 10145, '2023-08-24', '07:47:51', 'A'),
(592, 'MAL', 1381736, 20139, '2023-08-24', '07:47:54', 'A'),
(593, 'MAL', 1381737, 20204, '2023-08-24', '07:47:55', 'A'),
(594, 'MAL', 1381738, 10171, '2023-08-24', '07:48:03', 'A'),
(595, 'MAL', 1381739, 10135, '2023-08-24', '07:48:08', 'A'),
(596, 'MAL', 1381740, 20128, '2023-08-24', '07:48:16', 'A'),
(597, 'MAL', 1381741, 10146, '2023-08-24', '07:48:21', 'A'),
(598, 'MAL', 1381742, 10172, '2023-08-24', '07:48:26', 'A'),
(599, 'MAL', 1381743, 30003, '2023-08-24', '07:48:42', 'A'),
(600, 'MAL', 1381744, 20053, '2023-08-24', '07:48:43', 'A'),
(601, 'MAL', 1381745, 20056, '2023-08-24', '07:49:21', 'A'),
(602, 'MAL', 1381746, 20071, '2023-08-24', '07:49:32', 'A'),
(603, 'MAL', 1381747, 10154, '2023-08-24', '07:49:34', 'A'),
(604, 'MAL', 1381748, 20007, '2023-08-24', '07:49:39', 'A'),
(605, 'MAL', 1381749, 10170, '2023-08-24', '07:49:43', 'A'),
(606, 'MAL', 1381750, 10021, '2023-08-24', '07:49:45', 'A'),
(607, 'MAL', 1381751, 20160, '2023-08-24', '07:49:52', 'A'),
(608, 'MAL', 1381752, 10168, '2023-08-24', '07:49:59', 'A'),
(609, 'MAL', 1381753, 10164, '2023-08-24', '07:50:03', 'A'),
(610, 'MAL', 1381754, 20018, '2023-08-24', '07:50:05', 'A'),
(611, 'MAL', 1381755, 10041, '2023-08-24', '07:51:01', 'A'),
(612, 'MAL', 1381756, 20198, '2023-08-24', '07:51:07', 'A'),
(613, 'MAL', 1381757, 20063, '2023-08-24', '07:51:17', 'A'),
(614, 'MAL', 1381758, 10115, '2023-08-24', '07:51:25', 'A'),
(615, 'MAL', 1381759, 20112, '2023-08-24', '07:51:38', 'A'),
(616, 'MAL', 1381760, 30006, '2023-08-24', '07:52:18', 'A'),
(617, 'MAL', 1381761, 20043, '2023-08-24', '07:52:33', 'A'),
(618, 'MAL', 1381762, 20029, '2023-08-24', '07:52:55', 'A'),
(619, 'MAL', 1381763, 10015, '2023-08-24', '07:53:01', 'A'),
(620, 'MAL', 1381764, 20001, '2023-08-24', '07:53:03', 'A'),
(621, 'MAL', 1381765, 20189, '2023-08-24', '07:53:49', 'A'),
(622, 'MAL', 1381766, 20023, '2023-08-24', '07:54:01', 'A'),
(623, 'MAL', 1381767, 10179, '2023-08-24', '07:54:08', 'A'),
(624, 'MAL', 1381768, 20084, '2023-08-24', '07:55:31', 'A'),
(625, 'MAL', 1381769, 20192, '2023-08-24', '07:55:33', 'A'),
(626, 'MAL', 1381770, 20168, '2023-08-24', '07:55:37', 'A'),
(627, 'MAL', 1381771, 10163, '2023-08-24', '07:55:47', 'A'),
(628, 'MAL', 1381772, 30008, '2023-08-24', '07:56:21', 'A'),
(629, 'MAL', 1381773, 20191, '2023-08-24', '07:56:24', 'A'),
(630, 'MAL', 1381774, 20074, '2023-08-24', '07:56:36', 'A'),
(631, 'MAL', 1381775, 20032, '2023-08-24', '07:56:38', 'A'),
(632, 'MAL', 1381776, 20152, '2023-08-24', '07:56:42', 'A'),
(633, 'MAL', 1381777, 20136, '2023-08-24', '07:56:44', 'A'),
(634, 'MAL', 1381778, 20087, '2023-08-24', '07:56:50', 'A'),
(635, 'MAL', 1381779, 20133, '2023-08-24', '07:56:53', 'A'),
(636, 'MAL', 1381780, 10009, '2023-08-24', '07:56:57', 'A'),
(637, 'MAL', 1381781, 20076, '2023-08-24', '07:57:02', 'A'),
(638, 'MAL', 1381782, 10175, '2023-08-24', '07:57:41', 'A'),
(639, 'MAL', 1381783, 10174, '2023-08-24', '07:57:49', 'A'),
(640, 'MAL', 1381784, 10026, '2023-08-24', '07:57:54', 'A'),
(641, 'MAL', 1381785, 20100, '2023-08-24', '07:57:54', 'A'),
(642, 'MAL', 1381786, 10143, '2023-08-24', '07:57:57', 'A'),
(643, 'MAL', 1381787, 20016, '2023-08-24', '07:58:01', 'A'),
(644, 'MAL', 1381788, 20124, '2023-08-24', '07:58:03', 'A'),
(645, 'MAL', 1381789, 20123, '2023-08-24', '07:58:03', 'A'),
(646, 'MAL', 1381790, 20003, '2023-08-24', '07:58:08', 'A'),
(647, 'MAL', 1381791, 20098, '2023-08-24', '07:58:09', 'A'),
(648, 'MAL', 1381792, 10113, '2023-08-24', '07:58:14', 'A'),
(649, 'MAL', 1381793, 20132, '2023-08-24', '07:58:17', 'A'),
(650, 'MAL', 1381794, 20131, '2023-08-24', '07:58:18', 'A'),
(651, 'MAL', 1381795, 20175, '2023-08-24', '07:58:23', 'A'),
(652, 'MAL', 1381796, 10121, '2023-08-24', '07:59:31', 'A'),
(653, 'MAL', 1381797, 20106, '2023-08-24', '08:00:10', 'A'),
(654, 'MAL', 1381798, 20091, '2023-08-24', '08:00:11', 'A'),
(655, 'MAL', 1381799, 10169, '2023-08-24', '08:00:16', 'A'),
(656, 'MAL', 1381800, 20069, '2023-08-24', '08:01:03', 'A'),
(657, 'MAL', 1381801, 10140, '2023-08-24', '08:01:25', 'A'),
(658, 'MAL', 1381802, 10093, '2023-08-24', '08:01:42', 'A'),
(659, 'MAL', 1381803, 10120, '2023-08-24', '08:01:50', 'A'),
(660, 'MAL', 1381804, 20062, '2023-08-24', '08:01:58', 'A'),
(661, 'MAL', 1381805, 10160, '2023-08-24', '08:04:01', 'A'),
(662, 'MAL', 1381806, 10148, '2023-08-24', '08:12:03', 'A'),
(663, 'MAL', 1381807, 10030, '2023-08-24', '08:14:25', 'A'),
(664, 'MAL', 1381808, 10094, '2023-08-24', '08:21:50', 'A'),
(665, 'MAL', 1381809, 10095, '2023-08-24', '08:25:23', 'A'),
(666, 'MAL', 1381810, 10086, '2023-08-24', '08:37:55', 'A'),
(667, 'MAL', 1381811, 10103, '2023-08-24', '08:42:53', 'A'),
(668, 'MAL', 1381812, 20006, '2023-08-24', '08:56:21', 'A'),
(669, 'MAL', 1381813, 10034, '2023-08-24', '10:29:45', 'A'),
(670, 'MAL', 1381814, 30008, '2023-08-24', '12:00:20', 'C'),
(671, 'MAL', 1381815, 20076, '2023-08-24', '12:00:25', 'B'),
(672, 'MAL', 1381816, 30003, '2023-08-24', '12:00:29', 'B'),
(673, 'MAL', 1381817, 10179, '2023-08-24', '12:00:41', 'B'),
(674, 'MAL', 1381818, 20160, '2023-08-24', '12:08:41', 'Z'),
(675, 'MAL', 1381819, 10021, '2023-08-24', '12:12:04', 'Z'),
(676, 'MAL', 1381820, 30003, '2023-08-24', '12:31:32', 'C'),
(677, 'MAL', 1381821, 30008, '2023-08-24', '12:50:59', 'C'),
(678, 'MAL', 1381822, 10179, '2023-08-24', '12:52:24', 'C'),
(679, 'MAL', 1381823, 20036, '2023-08-24', '16:01:25', 'Z'),
(680, 'MAL', 1381824, 20119, '2023-08-24', '16:08:34', 'Z'),
(681, 'MAL', 1381825, 20053, '2023-08-24', '17:00:02', 'Z'),
(682, 'MAL', 1381826, 20115, '2023-08-24', '17:00:07', 'Z'),
(683, 'MAL', 1381827, 20098, '2023-08-24', '17:00:22', 'Z'),
(684, 'MAL', 1381828, 20062, '2023-08-24', '17:00:23', 'Z'),
(685, 'MAL', 1381829, 20151, '2023-08-24', '17:00:27', 'Z'),
(686, 'MAL', 1381830, 20152, '2023-08-24', '17:00:34', 'Z'),
(687, 'MAL', 1381831, 10103, '2023-08-24', '17:00:39', 'Z'),
(688, 'MAL', 1381832, 10073, '2023-08-24', '17:00:42', 'Z'),
(689, 'MAL', 1381833, 10013, '2023-08-24', '17:00:52', 'Z'),
(690, 'MAL', 1381834, 10163, '2023-08-24', '17:00:55', 'Z'),
(691, 'MAL', 1381835, 20091, '2023-08-24', '17:01:00', 'Z'),
(692, 'MAL', 1381836, 20050, '2023-08-24', '17:01:05', 'Z'),
(693, 'MAL', 1381837, 20137, '2023-08-24', '17:01:06', 'Z'),
(694, 'MAL', 1381838, 20204, '2023-08-24', '17:01:09', 'Z'),
(695, 'MAL', 1381839, 20112, '2023-08-24', '17:01:13', 'Z'),
(696, 'MAL', 1381840, 10027, '2023-08-24', '17:01:15', 'Z'),
(697, 'MAL', 1381841, 20121, '2023-08-24', '17:01:16', 'Z'),
(698, 'MAL', 1381842, 10006, '2023-08-24', '17:01:16', 'Z'),
(699, 'MAL', 1381843, 20059, '2023-08-24', '17:01:20', 'Z'),
(700, 'MAL', 1381844, 20074, '2023-08-24', '17:01:23', 'Z'),
(701, 'MAL', 1381845, 20205, '2023-08-24', '17:01:26', 'Z'),
(702, 'MAL', 1381846, 20008, '2023-08-24', '17:01:28', 'Z'),
(703, 'MAL', 1381847, 10126, '2023-08-24', '17:01:35', 'Z'),
(704, 'MAL', 1381848, 10089, '2023-08-24', '17:01:38', 'Z'),
(705, 'MAL', 1381849, 10178, '2023-08-24', '17:01:41', 'Z'),
(706, 'MAL', 1381850, 20189, '2023-08-24', '17:01:46', 'Z'),
(707, 'MAL', 1381851, 10023, '2023-08-24', '17:01:48', 'Z'),
(708, 'MAL', 1381852, 10136, '2023-08-24', '17:01:50', 'Z'),
(709, 'MAL', 1381853, 10168, '2023-08-24', '17:01:56', 'Z'),
(710, 'MAL', 1381854, 10157, '2023-08-24', '17:01:59', 'Z'),
(711, 'MAL', 1381855, 20087, '2023-08-24', '17:02:01', 'Z'),
(712, 'MAL', 1381856, 10157, '2023-08-24', '17:02:04', 'Z'),
(713, 'MAL', 1381857, 10144, '2023-08-24', '17:02:06', 'Z'),
(714, 'MAL', 1381858, 10174, '2023-08-24', '17:02:08', 'Z'),
(715, 'MAL', 1381859, 10147, '2023-08-24', '17:02:10', 'Z'),
(716, 'MAL', 1381860, 10176, '2023-08-24', '17:02:12', 'Z'),
(717, 'MAL', 1381861, 20131, '2023-08-24', '17:02:13', 'Z'),
(718, 'MAL', 1381862, 20084, '2023-08-24', '17:02:19', 'Z'),
(719, 'MAL', 1381863, 20035, '2023-08-24', '17:02:21', 'Z'),
(720, 'MAL', 1381864, 10175, '2023-08-24', '17:02:21', 'Z'),
(721, 'MAL', 1381865, 20136, '2023-08-24', '17:02:25', 'Z'),
(722, 'MAL', 1381866, 10075, '2023-08-24', '17:02:25', 'Z'),
(723, 'MAL', 1381867, 30008, '2023-08-24', '17:02:29', 'Z'),
(724, 'MAL', 1381868, 10171, '2023-08-24', '17:02:33', 'Z'),
(725, 'MAL', 1381869, 10164, '2023-08-24', '17:02:33', 'Z'),
(726, 'MAL', 1381870, 30003, '2023-08-24', '17:02:36', 'Z'),
(727, 'MAL', 1381871, 10012, '2023-08-24', '17:02:37', 'Z'),
(728, 'MAL', 1381872, 20175, '2023-08-24', '17:02:38', 'Z'),
(729, 'MAL', 1381873, 10145, '2023-08-24', '17:02:41', 'Z'),
(730, 'MAL', 1381874, 10012, '2023-08-24', '17:02:43', 'Z'),
(731, 'MAL', 1381875, 20059, '2023-08-24', '17:02:46', 'Z'),
(732, 'MAL', 1381876, 20100, '2023-08-24', '17:02:51', 'Z'),
(733, 'MAL', 1381877, 10113, '2023-08-24', '17:02:53', 'Z'),
(734, 'MAL', 1381878, 20139, '2023-08-24', '17:02:53', 'Z'),
(735, 'MAL', 1381879, 10170, '2023-08-24', '17:02:57', 'Z'),
(736, 'MAL', 1381880, 10038, '2023-08-24', '17:02:59', 'Z'),
(737, 'MAL', 1381881, 20056, '2023-08-24', '17:02:59', 'Z'),
(738, 'MAL', 1381882, 20104, '2023-08-24', '17:03:00', 'Z'),
(739, 'MAL', 1381883, 10007, '2023-08-24', '17:03:03', 'Z'),
(740, 'MAL', 1381884, 20182, '2023-08-24', '17:03:05', 'Z'),
(741, 'MAL', 1381885, 20198, '2023-08-24', '17:03:08', 'Z'),
(742, 'MAL', 1381886, 20002, '2023-08-24', '17:03:11', 'Z'),
(743, 'MAL', 1381887, 20063, '2023-08-24', '17:03:12', 'Z'),
(744, 'MAL', 1381888, 20032, '2023-08-24', '17:03:13', 'Z'),
(745, 'MAL', 1381889, 20063, '2023-08-24', '17:03:13', 'Z'),
(746, 'MAL', 1381890, 20168, '2023-08-24', '17:03:16', 'Z'),
(747, 'MAL', 1381891, 10093, '2023-08-24', '17:03:17', 'Z'),
(748, 'MAL', 1381892, 10026, '2023-08-24', '17:03:21', 'Z'),
(749, 'MAL', 1381893, 20003, '2023-08-24', '17:03:22', 'Z'),
(750, 'MAL', 1381894, 20192, '2023-08-24', '17:03:24', 'Z'),
(751, 'MAL', 1381895, 20054, '2023-08-24', '17:03:25', 'Z'),
(752, 'MAL', 1381896, 10154, '2023-08-24', '17:03:28', 'Z'),
(753, 'MAL', 1381897, 20069, '2023-08-24', '17:03:29', 'Z'),
(754, 'MAL', 1381898, 20165, '2023-08-24', '17:03:30', 'Z'),
(755, 'MAL', 1381899, 20023, '2023-08-24', '17:03:34', 'Z'),
(756, 'MAL', 1381900, 10179, '2023-08-24', '17:03:35', 'Z'),
(757, 'MAL', 1381901, 20128, '2023-08-24', '17:03:37', 'Z'),
(758, 'MAL', 1381902, 20106, '2023-08-24', '17:03:40', 'Z'),
(759, 'MAL', 1381903, 20124, '2023-08-24', '17:03:40', 'Z'),
(760, 'MAL', 1381904, 20186, '2023-08-24', '17:03:42', 'Z'),
(761, 'MAL', 1381905, 20191, '2023-08-24', '17:03:45', 'Z'),
(762, 'MAL', 1381906, 20029, '2023-08-24', '17:03:48', 'Z'),
(763, 'MAL', 1381907, 10140, '2023-08-24', '17:03:50', 'Z'),
(764, 'MAL', 1381908, 10160, '2023-08-24', '17:03:50', 'Z'),
(765, 'MAL', 1381909, 20016, '2023-08-24', '17:03:53', 'Z'),
(766, 'MAL', 1381910, 10139, '2023-08-24', '17:03:53', 'Z'),
(767, 'MAL', 1381911, 20071, '2023-08-24', '17:03:55', 'Z'),
(768, 'MAL', 1381912, 20051, '2023-08-24', '17:03:57', 'Z'),
(769, 'MAL', 1381913, 10120, '2023-08-24', '17:03:59', 'Z'),
(770, 'MAL', 1381914, 10035, '2023-08-24', '17:04:07', 'Z'),
(771, 'MAL', 1381915, 30006, '2023-08-24', '17:04:14', 'Z'),
(772, 'MAL', 1381916, 20133, '2023-08-24', '17:04:16', 'Z'),
(773, 'MAL', 1381917, 20007, '2023-08-24', '17:04:20', 'Z'),
(774, 'MAL', 1381918, 10009, '2023-08-24', '17:04:24', 'Z'),
(775, 'MAL', 1381919, 20018, '2023-08-24', '17:04:29', 'Z'),
(776, 'MAL', 1381920, 20001, '2023-08-24', '17:04:35', 'Z'),
(777, 'MAL', 1381921, 10167, '2023-08-24', '17:04:42', 'Z'),
(778, 'MAL', 1381922, 10017, '2023-08-24', '17:04:43', 'Z'),
(779, 'MAL', 1381923, 10167, '2023-08-24', '17:04:43', 'Z'),
(780, 'MAL', 1381924, 20159, '2023-08-24', '17:04:48', 'Z'),
(781, 'MAL', 1381925, 10177, '2023-08-24', '17:04:55', 'Z'),
(782, 'MAL', 1381926, 10135, '2023-08-24', '17:05:02', 'Z'),
(783, 'MAL', 1381927, 10173, '2023-08-24', '17:05:06', 'Z'),
(784, 'MAL', 1381928, 10100, '2023-08-24', '17:05:15', 'Z'),
(785, 'MAL', 1381929, 10146, '2023-08-24', '17:05:49', 'Z'),
(786, 'MAL', 1381930, 20012, '2023-08-24', '17:06:52', 'Z'),
(787, 'MAL', 1381931, 10015, '2023-08-24', '17:07:03', 'Z'),
(788, 'MAL', 1381932, 20043, '2023-08-24', '17:13:01', 'Z'),
(789, 'MAL', 1381933, 10114, '2023-08-24', '17:13:35', 'Z'),
(790, 'MAL', 1381934, 20181, '2023-08-24', '17:13:37', 'Z'),
(791, 'MAL', 1381935, 10110, '2023-08-24', '17:14:51', 'Z'),
(792, 'MAL', 1381936, 10121, '2023-08-24', '17:15:53', 'Z'),
(793, 'MAL', 1381937, 20118, '2023-08-24', '17:18:48', 'Z'),
(794, 'MAL', 1381938, 10034, '2023-08-24', '17:28:32', 'Z'),
(795, 'MAL', 1381939, 10143, '2023-08-24', '17:31:32', 'Z'),
(796, 'MAL', 1381940, 10030, '2023-08-24', '17:33:41', 'Z'),
(797, 'MAL', 1381941, 20076, '2023-08-24', '17:34:05', 'Z'),
(798, 'MAL', 1381942, 20015, '2023-08-24', '17:45:44', 'Z'),
(799, 'MAL', 1381943, 10169, '2023-08-24', '17:54:13', 'Z'),
(800, 'MAL', 1381944, 10095, '2023-08-24', '17:54:15', 'Z'),
(801, 'MAL', 1381945, 20082, '2023-08-24', '18:01:17', 'Z'),
(802, 'MAL', 1381946, 10094, '2023-08-24', '18:26:28', 'Z'),
(803, 'MAL', 1381947, 10086, '2023-08-24', '18:29:13', 'Z'),
(804, 'MAL', 1381948, 20006, '2023-08-24', '18:39:24', 'Z'),
(805, 'MAL', 1381949, 20036, '2023-08-25', '05:52:42', 'A'),
(806, 'MAL', 1381950, 20030, '2023-08-25', '06:21:52', 'A'),
(807, 'MAL', 1381951, 20119, '2023-08-25', '06:52:43', 'A'),
(808, 'MAL', 1381952, 20059, '2023-08-25', '07:00:14', 'A'),
(809, 'MAL', 1381953, 20115, '2023-08-25', '07:03:12', 'A'),
(810, 'MAL', 1381954, 10126, '2023-08-25', '07:03:40', 'A'),
(811, 'MAL', 1381955, 10178, '2023-08-25', '07:04:17', 'A'),
(812, 'MAL', 1381956, 20050, '2023-08-25', '07:06:48', 'A'),
(813, 'MAL', 1381957, 20104, '2023-08-25', '07:08:10', 'A'),
(814, 'MAL', 1381958, 20038, '2023-08-25', '07:10:51', 'A'),
(815, 'MAL', 1381959, 10114, '2023-08-25', '07:16:56', 'A'),
(816, 'MAL', 1381960, 10160, '2023-08-25', '07:22:03', 'A'),
(817, 'MAL', 1381961, 10144, '2023-08-25', '07:22:54', 'A'),
(818, 'MAL', 1381962, 20181, '2023-08-25', '07:23:02', 'A'),
(819, 'MAL', 1381963, 20054, '2023-08-25', '07:23:05', 'A'),
(820, 'MAL', 1381964, 20035, '2023-08-25', '07:23:14', 'A'),
(821, 'MAL', 1381965, 10027, '2023-08-25', '07:24:01', 'A'),
(822, 'MAL', 1381966, 20015, '2023-08-25', '07:26:25', 'A'),
(823, 'MAL', 1381967, 20121, '2023-08-25', '07:29:27', 'A'),
(824, 'MAL', 1381968, 10012, '2023-08-25', '07:29:28', 'A'),
(825, 'MAL', 1381969, 20002, '2023-08-25', '07:32:28', 'A'),
(826, 'MAL', 1381970, 30008, '2023-08-25', '07:32:29', 'A'),
(827, 'MAL', 1381971, 10007, '2023-08-25', '07:32:34', 'A'),
(828, 'MAL', 1381972, 20008, '2023-08-25', '07:32:40', 'A'),
(829, 'MAL', 1381973, 20205, '2023-08-25', '07:32:55', 'A'),
(830, 'MAL', 1381974, 10157, '2023-08-25', '07:33:01', 'A'),
(831, 'MAL', 1381975, 20012, '2023-08-25', '07:35:08', 'A'),
(832, 'MAL', 1381976, 10136, '2023-08-25', '07:35:12', 'A'),
(833, 'MAL', 1381977, 20165, '2023-08-25', '07:35:14', 'A'),
(834, 'MAL', 1381978, 10147, '2023-08-25', '07:35:19', 'A'),
(835, 'MAL', 1381979, 10017, '2023-08-25', '07:35:26', 'A'),
(836, 'MAL', 1381980, 20017, '2023-08-25', '07:35:46', 'A'),
(837, 'MAL', 1381981, 10173, '2023-08-25', '07:36:14', 'A'),
(838, 'MAL', 1381982, 20063, '2023-08-25', '07:36:26', 'A'),
(839, 'MAL', 1381983, 20137, '2023-08-25', '07:36:54', 'A'),
(840, 'MAL', 1381984, 10176, '2023-08-25', '07:36:59', 'A'),
(841, 'MAL', 1381985, 10139, '2023-08-25', '07:37:06', 'A'),
(842, 'MAL', 1381986, 10075, '2023-08-25', '07:37:09', 'A'),
(843, 'MAL', 1381987, 10035, '2023-08-25', '07:37:16', 'A'),
(844, 'MAL', 1381988, 20097, '2023-08-25', '07:38:06', 'A'),
(845, 'MAL', 1381989, 20044, '2023-08-25', '07:38:07', 'A'),
(846, 'MAL', 1381990, 20118, '2023-08-25', '07:39:15', 'A'),
(847, 'MAL', 1381991, 10163, '2023-08-25', '07:40:33', 'A');
INSERT INTO `tbl_attendance` (`id`, `c_locations`, `c_timecardid`, `c_idno`, `c_trandate`, `c_trantime`, `c_trantype`) VALUES
(848, 'MAL', 1381992, 20078, '2023-08-25', '07:42:09', 'A'),
(849, 'MAL', 1381993, 20056, '2023-08-25', '07:43:52', 'A'),
(850, 'MAL', 1381994, 20071, '2023-08-25', '07:44:06', 'A'),
(851, 'MAL', 1381995, 20007, '2023-08-25', '07:44:09', 'A'),
(852, 'MAL', 1381996, 10154, '2023-08-25', '07:44:13', 'A'),
(853, 'MAL', 1381997, 20064, '2023-08-25', '07:44:24', 'A'),
(854, 'MAL', 1381998, 10170, '2023-08-25', '07:44:35', 'A'),
(855, 'MAL', 1381999, 10168, '2023-08-25', '07:44:40', 'A'),
(856, 'MAL', 1382000, 10021, '2023-08-25', '07:44:44', 'A'),
(857, 'MAL', 1382001, 30003, '2023-08-25', '07:44:46', 'A'),
(858, 'MAL', 1382002, 20160, '2023-08-25', '07:44:49', 'A'),
(859, 'MAL', 1382003, 10164, '2023-08-25', '07:44:52', 'A'),
(860, 'MAL', 1382004, 20018, '2023-08-25', '07:44:55', 'A'),
(861, 'MAL', 1382005, 10115, '2023-08-25', '07:45:11', 'A'),
(862, 'MAL', 1382006, 10006, '2023-08-25', '07:45:38', 'A'),
(863, 'MAL', 1382007, 20053, '2023-08-25', '07:46:43', 'A'),
(864, 'MAL', 1382008, 20136, '2023-08-25', '07:46:48', 'A'),
(865, 'MAL', 1382009, 20152, '2023-08-25', '07:47:00', 'A'),
(866, 'MAL', 1382010, 10177, '2023-08-25', '07:47:13', 'A'),
(867, 'MAL', 1382011, 10034, '2023-08-25', '07:47:59', 'A'),
(868, 'MAL', 1382012, 20112, '2023-08-25', '07:48:22', 'A'),
(869, 'MAL', 1382013, 20191, '2023-08-25', '07:48:25', 'A'),
(870, 'MAL', 1382014, 20151, '2023-08-25', '07:48:29', 'A'),
(871, 'MAL', 1382015, 20123, '2023-08-25', '07:48:35', 'A'),
(872, 'MAL', 1382016, 20074, '2023-08-25', '07:48:35', 'A'),
(873, 'MAL', 1382017, 20076, '2023-08-25', '07:48:40', 'A'),
(874, 'MAL', 1382018, 20087, '2023-08-25', '07:48:46', 'A'),
(875, 'MAL', 1382019, 20133, '2023-08-25', '07:48:49', 'A'),
(876, 'MAL', 1382020, 10009, '2023-08-25', '07:48:54', 'A'),
(877, 'MAL', 1382021, 20134, '2023-08-25', '07:49:06', 'A'),
(878, 'MAL', 1382022, 20192, '2023-08-25', '07:49:06', 'A'),
(879, 'MAL', 1382023, 20084, '2023-08-25', '07:49:12', 'A'),
(880, 'MAL', 1382024, 20168, '2023-08-25', '07:49:12', 'A'),
(881, 'MAL', 1382025, 20204, '2023-08-25', '07:50:00', 'A'),
(882, 'MAL', 1382026, 10089, '2023-08-25', '07:50:14', 'A'),
(883, 'MAL', 1382027, 20182, '2023-08-25', '07:50:17', 'A'),
(884, 'MAL', 1382028, 10135, '2023-08-25', '07:50:24', 'A'),
(885, 'MAL', 1382029, 20159, '2023-08-25', '07:50:25', 'A'),
(886, 'MAL', 1382030, 10171, '2023-08-25', '07:50:34', 'A'),
(887, 'MAL', 1382031, 10145, '2023-08-25', '07:50:35', 'A'),
(888, 'MAL', 1382032, 20128, '2023-08-25', '07:50:39', 'A'),
(889, 'MAL', 1382033, 20186, '2023-08-25', '07:50:43', 'A'),
(890, 'MAL', 1382034, 30006, '2023-08-25', '07:50:49', 'A'),
(891, 'MAL', 1382035, 20043, '2023-08-25', '07:50:52', 'A'),
(892, 'MAL', 1382036, 10172, '2023-08-25', '07:50:56', 'A'),
(893, 'MAL', 1382037, 10026, '2023-08-25', '07:51:07', 'A'),
(894, 'MAL', 1382038, 20001, '2023-08-25', '07:51:18', 'A'),
(895, 'MAL', 1382039, 20100, '2023-08-25', '07:51:33', 'A'),
(896, 'MAL', 1382040, 20062, '2023-08-25', '07:51:33', 'A'),
(897, 'MAL', 1382041, 20124, '2023-08-25', '07:51:43', 'A'),
(898, 'MAL', 1382042, 20098, '2023-08-25', '07:51:44', 'A'),
(899, 'MAL', 1382043, 20003, '2023-08-25', '07:51:47', 'A'),
(900, 'MAL', 1382044, 20132, '2023-08-25', '07:51:50', 'A'),
(901, 'MAL', 1382045, 10113, '2023-08-25', '07:51:52', 'A'),
(902, 'MAL', 1382046, 20029, '2023-08-25', '07:52:05', 'A'),
(903, 'MAL', 1382047, 10167, '2023-08-25', '07:52:08', 'A'),
(904, 'MAL', 1382048, 10041, '2023-08-25', '07:52:13', 'A'),
(905, 'MAL', 1382049, 10015, '2023-08-25', '07:52:20', 'A'),
(906, 'MAL', 1382050, 10143, '2023-08-25', '07:53:08', 'A'),
(907, 'MAL', 1382051, 20139, '2023-08-25', '07:53:31', 'A'),
(908, 'MAL', 1382052, 20069, '2023-08-25', '07:54:12', 'A'),
(909, 'MAL', 1382053, 20189, '2023-08-25', '07:55:22', 'A'),
(910, 'MAL', 1382054, 20131, '2023-08-25', '07:55:29', 'A'),
(911, 'MAL', 1382055, 10174, '2023-08-25', '07:57:22', 'A'),
(912, 'MAL', 1382056, 10175, '2023-08-25', '07:57:29', 'A'),
(913, 'MAL', 1382057, 20198, '2023-08-25', '07:58:27', 'A'),
(914, 'MAL', 1382058, 10169, '2023-08-25', '07:58:45', 'A'),
(915, 'MAL', 1382059, 10140, '2023-08-25', '07:59:53', 'A'),
(916, 'MAL', 1382060, 20175, '2023-08-25', '08:00:04', 'A'),
(917, 'MAL', 1382061, 10093, '2023-08-25', '08:00:10', 'A'),
(918, 'MAL', 1382062, 20062, '2023-08-25', '08:01:12', 'A'),
(919, 'MAL', 1382063, 10124, '2023-08-25', '08:01:50', 'A'),
(920, 'MAL', 1382064, 20115, '2023-08-25', '08:01:51', 'A'),
(921, 'MAL', 1382065, 10179, '2023-08-25', '08:03:13', 'A'),
(922, 'MAL', 1382066, 20106, '2023-08-25', '08:04:14', 'A'),
(923, 'MAL', 1382067, 20091, '2023-08-25', '08:04:25', 'A'),
(924, 'MAL', 1382068, 10121, '2023-08-25', '08:04:35', 'A'),
(925, 'MAL', 1382069, 10148, '2023-08-25', '08:05:05', 'A'),
(926, 'MAL', 1382070, 10100, '2023-08-25', '08:06:11', 'A'),
(927, 'MAL', 1382071, 10030, '2023-08-25', '08:09:33', 'A'),
(928, 'MAL', 1382072, 20023, '2023-08-25', '08:10:13', 'A'),
(929, 'MAL', 1382073, 10094, '2023-08-25', '08:23:41', 'A'),
(930, 'MAL', 1382074, 10103, '2023-08-25', '08:29:30', 'A'),
(931, 'MAL', 1382075, 10086, '2023-08-25', '08:48:28', 'A'),
(932, 'MAL', 1382076, 20006, '2023-08-25', '08:56:03', 'A'),
(933, 'MAL', 1382077, 10146, '2023-08-25', '09:08:46', 'A'),
(934, 'MAL', 1382078, 10034, '2023-08-25', '09:49:56', 'A'),
(935, 'MAL', 1382079, 10095, '2023-08-25', '10:18:36', 'A'),
(936, 'MAL', 1382080, 1, '2023-08-25', '11:35:34', 'A'),
(937, 'MAL', 1382081, 10179, '2023-08-25', '12:01:04', 'B'),
(938, 'MAL', 1382082, 10179, '2023-08-25', '12:58:18', 'C'),
(939, 'MAL', 1382083, 10143, '2023-08-25', '14:12:10', 'A'),
(940, 'MAL', 1382084, 20115, '2023-08-25', '14:53:29', 'Z'),
(941, 'MAL', 1382085, 10126, '2023-08-25', '16:09:55', 'Z'),
(942, 'MAL', 1382086, 20119, '2023-08-25', '16:11:57', 'Z'),
(943, 'MAL', 1382087, 20036, '2023-08-25', '16:12:37', 'Z'),
(944, 'MAL', 1382088, 1, '2023-08-25', '16:14:07', 'Z'),
(945, 'MAL', 1382089, 20053, '2023-08-25', '17:00:13', 'Z'),
(946, 'MAL', 1382090, 20182, '2023-08-25', '17:00:27', 'Z'),
(947, 'MAL', 1382091, 20204, '2023-08-25', '17:00:30', 'Z'),
(948, 'MAL', 1382092, 20098, '2023-08-25', '17:00:32', 'Z'),
(949, 'MAL', 1382093, 20078, '2023-08-25', '17:00:41', 'Z'),
(950, 'MAL', 1382094, 10140, '2023-08-25', '17:00:41', 'Z'),
(951, 'MAL', 1382095, 20151, '2023-08-25', '17:00:43', 'Z'),
(952, 'MAL', 1382096, 10139, '2023-08-25', '17:00:44', 'Z'),
(953, 'MAL', 1382097, 20121, '2023-08-25', '17:00:47', 'Z'),
(954, 'MAL', 1382098, 20112, '2023-08-25', '17:00:49', 'Z'),
(955, 'MAL', 1382099, 10089, '2023-08-25', '17:00:52', 'Z'),
(956, 'MAL', 1382100, 20059, '2023-08-25', '17:00:54', 'Z'),
(957, 'MAL', 1382101, 10089, '2023-08-25', '17:00:54', 'Z'),
(958, 'MAL', 1382102, 20091, '2023-08-25', '17:00:54', 'Z'),
(959, 'MAL', 1382103, 10124, '2023-08-25', '17:01:00', 'Z'),
(960, 'MAL', 1382104, 10113, '2023-08-25', '17:01:05', 'Z'),
(961, 'MAL', 1382105, 10093, '2023-08-25', '17:01:07', 'Z'),
(962, 'MAL', 1382106, 30008, '2023-08-25', '17:01:13', 'Z'),
(963, 'MAL', 1382107, 20002, '2023-08-25', '17:01:15', 'Z'),
(964, 'MAL', 1382108, 10144, '2023-08-25', '17:01:17', 'Z'),
(965, 'MAL', 1382109, 20132, '2023-08-25', '17:01:19', 'Z'),
(966, 'MAL', 1382110, 10176, '2023-08-25', '17:01:21', 'Z'),
(967, 'MAL', 1382111, 10168, '2023-08-25', '17:01:24', 'Z'),
(968, 'MAL', 1382112, 20115, '2023-08-25', '17:01:26', 'Z'),
(969, 'MAL', 1382113, 10178, '2023-08-25', '17:01:28', 'Z'),
(970, 'MAL', 1382114, 20064, '2023-08-25', '17:01:30', 'Z'),
(971, 'MAL', 1382115, 10027, '2023-08-25', '17:01:31', 'Z'),
(972, 'MAL', 1382116, 20043, '2023-08-25', '17:01:34', 'Z'),
(973, 'MAL', 1382117, 10103, '2023-08-25', '17:01:35', 'Z'),
(974, 'MAL', 1382118, 10157, '2023-08-25', '17:01:36', 'Z'),
(975, 'MAL', 1382119, 10075, '2023-08-25', '17:01:39', 'Z'),
(976, 'MAL', 1382120, 20087, '2023-08-25', '17:01:40', 'Z'),
(977, 'MAL', 1382121, 20136, '2023-08-25', '17:01:44', 'Z'),
(978, 'MAL', 1382122, 20084, '2023-08-25', '17:01:45', 'Z'),
(979, 'MAL', 1382123, 10147, '2023-08-25', '17:01:48', 'Z'),
(980, 'MAL', 1382124, 20133, '2023-08-25', '17:01:49', 'Z'),
(981, 'MAL', 1382125, 10175, '2023-08-25', '17:01:54', 'Z'),
(982, 'MAL', 1382126, 20175, '2023-08-25', '17:01:59', 'Z'),
(983, 'MAL', 1382127, 20139, '2023-08-25', '17:02:03', 'Z'),
(984, 'MAL', 1382128, 20050, '2023-08-25', '17:02:05', 'Z'),
(985, 'MAL', 1382129, 10164, '2023-08-25', '17:02:06', 'Z'),
(986, 'MAL', 1382130, 20198, '2023-08-25', '17:02:09', 'Z'),
(987, 'MAL', 1382131, 10174, '2023-08-25', '17:02:12', 'Z'),
(988, 'MAL', 1382132, 20137, '2023-08-25', '17:02:17', 'Z'),
(989, 'MAL', 1382133, 10146, '2023-08-25', '17:02:18', 'Z'),
(990, 'MAL', 1382134, 20137, '2023-08-25', '17:02:20', 'Z'),
(991, 'MAL', 1382135, 10146, '2023-08-25', '17:02:20', 'Z'),
(992, 'MAL', 1382136, 10007, '2023-08-25', '17:02:25', 'Z'),
(993, 'MAL', 1382137, 20038, '2023-08-25', '17:02:25', 'Z'),
(994, 'MAL', 1382138, 10163, '2023-08-25', '17:02:28', 'Z'),
(995, 'MAL', 1382139, 10006, '2023-08-25', '17:02:29', 'Z'),
(996, 'MAL', 1382140, 20056, '2023-08-25', '17:02:33', 'Z'),
(997, 'MAL', 1382141, 20165, '2023-08-25', '17:02:35', 'Z'),
(998, 'MAL', 1382142, 10171, '2023-08-25', '17:02:38', 'Z'),
(999, 'MAL', 1382143, 10154, '2023-08-25', '17:02:42', 'Z'),
(1000, 'MAL', 1382144, 10145, '2023-08-25', '17:02:42', 'Z'),
(1001, 'MAL', 1382145, 10179, '2023-08-25', '17:02:48', 'Z'),
(1002, 'MAL', 1382146, 10017, '2023-08-25', '17:02:53', 'Z'),
(1003, 'MAL', 1382147, 20100, '2023-08-25', '17:02:57', 'Z'),
(1004, 'MAL', 1382148, 20074, '2023-08-25', '17:02:58', 'Z'),
(1005, 'MAL', 1382149, 10136, '2023-08-25', '17:03:01', 'Z'),
(1006, 'MAL', 1382150, 20106, '2023-08-25', '17:03:07', 'Z'),
(1007, 'MAL', 1382151, 10136, '2023-08-25', '17:03:08', 'Z'),
(1008, 'MAL', 1382152, 20012, '2023-08-25', '17:03:12', 'Z'),
(1009, 'MAL', 1382153, 20152, '2023-08-25', '17:03:13', 'Z'),
(1010, 'MAL', 1382154, 30006, '2023-08-25', '17:03:19', 'Z'),
(1011, 'MAL', 1382155, 20160, '2023-08-25', '17:03:21', 'Z'),
(1012, 'MAL', 1382156, 20017, '2023-08-25', '17:03:23', 'Z'),
(1013, 'MAL', 1382157, 20007, '2023-08-25', '17:03:27', 'Z'),
(1014, 'MAL', 1382158, 20104, '2023-08-25', '17:03:32', 'Z'),
(1015, 'MAL', 1382159, 10167, '2023-08-25', '17:03:36', 'Z'),
(1016, 'MAL', 1382160, 10135, '2023-08-25', '17:03:38', 'Z'),
(1017, 'MAL', 1382161, 10173, '2023-08-25', '17:03:43', 'Z'),
(1018, 'MAL', 1382162, 20159, '2023-08-25', '17:03:45', 'Z'),
(1019, 'MAL', 1382163, 20118, '2023-08-25', '17:03:47', 'Z'),
(1020, 'MAL', 1382164, 20181, '2023-08-25', '17:03:48', 'Z'),
(1021, 'MAL', 1382165, 10114, '2023-08-25', '17:03:53', 'Z'),
(1022, 'MAL', 1382166, 20035, '2023-08-25', '17:03:57', 'Z'),
(1023, 'MAL', 1382167, 20001, '2023-08-25', '17:04:05', 'Z'),
(1024, 'MAL', 1382168, 20018, '2023-08-25', '17:04:07', 'Z'),
(1025, 'MAL', 1382169, 20071, '2023-08-25', '17:04:08', 'Z'),
(1026, 'MAL', 1382170, 20168, '2023-08-25', '17:04:10', 'Z'),
(1027, 'MAL', 1382171, 20023, '2023-08-25', '17:04:14', 'Z'),
(1028, 'MAL', 1382172, 20069, '2023-08-25', '17:04:14', 'Z'),
(1029, 'MAL', 1382173, 20192, '2023-08-25', '17:04:16', 'Z'),
(1030, 'MAL', 1382174, 20008, '2023-08-25', '17:04:18', 'Z'),
(1031, 'MAL', 1382175, 20186, '2023-08-25', '17:04:20', 'Z'),
(1032, 'MAL', 1382176, 20128, '2023-08-25', '17:04:25', 'Z'),
(1033, 'MAL', 1382177, 20205, '2023-08-25', '17:04:25', 'Z'),
(1034, 'MAL', 1382178, 10177, '2023-08-25', '17:04:29', 'Z'),
(1035, 'MAL', 1382179, 20131, '2023-08-25', '17:04:32', 'Z'),
(1036, 'MAL', 1382180, 10100, '2023-08-25', '17:04:33', 'Z'),
(1037, 'MAL', 1382181, 10114, '2023-08-25', '17:04:35', 'Z'),
(1038, 'MAL', 1382182, 10160, '2023-08-25', '17:04:37', 'Z'),
(1039, 'MAL', 1382183, 10035, '2023-08-25', '17:04:39', 'Z'),
(1040, 'MAL', 1382184, 20191, '2023-08-25', '17:04:41', 'Z'),
(1041, 'MAL', 1382185, 10035, '2023-08-25', '17:04:41', 'Z'),
(1042, 'MAL', 1382186, 20063, '2023-08-25', '17:04:45', 'Z'),
(1043, 'MAL', 1382187, 20062, '2023-08-25', '17:05:13', 'Z'),
(1044, 'MAL', 1382188, 10026, '2023-08-25', '17:05:21', 'Z'),
(1045, 'MAL', 1382189, 10009, '2023-08-25', '17:05:44', 'Z'),
(1046, 'MAL', 1382190, 10121, '2023-08-25', '17:06:01', 'Z'),
(1047, 'MAL', 1382191, 10034, '2023-08-25', '17:06:15', 'Z'),
(1048, 'MAL', 1382192, 10169, '2023-08-25', '17:06:31', 'Z'),
(1049, 'MAL', 1382193, 20003, '2023-08-25', '17:06:39', 'Z'),
(1050, 'MAL', 1382194, 10012, '2023-08-25', '17:07:05', 'Z'),
(1051, 'MAL', 1382195, 20029, '2023-08-25', '17:07:37', 'Z'),
(1052, 'MAL', 1382196, 10015, '2023-08-25', '17:08:37', 'Z'),
(1053, 'MAL', 1382197, 30003, '2023-08-25', '17:08:52', 'Z'),
(1054, 'MAL', 1382198, 20054, '2023-08-25', '17:09:01', 'Z'),
(1055, 'MAL', 1382199, 20134, '2023-08-25', '17:09:28', 'Z'),
(1056, 'MAL', 1382200, 20189, '2023-08-25', '17:09:49', 'Z'),
(1057, 'MAL', 1382201, 20015, '2023-08-25', '17:09:56', 'Z'),
(1058, 'MAL', 1382202, 10170, '2023-08-25', '17:10:42', 'Z'),
(1059, 'MAL', 1382203, 10095, '2023-08-25', '17:12:04', 'Z'),
(1060, 'MAL', 1382204, 20124, '2023-08-25', '17:12:07', 'Z'),
(1061, 'MAL', 1382205, 10041, '2023-08-25', '17:15:32', 'Z'),
(1062, 'MAL', 1382206, 10030, '2023-08-25', '17:15:37', 'Z'),
(1063, 'MAL', 1382207, 20076, '2023-08-25', '17:16:30', 'Z'),
(1064, 'MAL', 1382208, 10021, '2023-08-25', '17:45:41', 'Z'),
(1065, 'MAL', 1382209, 10148, '2023-08-25', '17:47:19', 'Z'),
(1066, 'MAL', 1382210, 10094, '2023-08-25', '17:48:15', 'Z'),
(1067, 'MAL', 1382211, 20082, '2023-08-25', '18:00:22', 'Z'),
(1068, 'MAL', 1382212, 10086, '2023-08-25', '18:12:49', 'Z'),
(1069, 'MAL', 1382213, 20006, '2023-08-25', '18:49:38', 'Z'),
(1070, 'MAL', 1382214, 20036, '2023-08-26', '06:08:36', 'A'),
(1071, 'MAL', 1382215, 20121, '2023-08-26', '06:50:26', 'A'),
(1072, 'MAL', 1382216, 20064, '2023-08-26', '07:22:13', 'A'),
(1073, 'MAL', 1382217, 10177, '2023-08-26', '07:23:11', 'A'),
(1074, 'MAL', 1382218, 10160, '2023-08-26', '07:40:37', 'A'),
(1075, 'MAL', 1382219, 20030, '2023-08-26', '07:47:24', 'A'),
(1076, 'MAL', 1382220, 20123, '2023-08-26', '07:48:55', 'A'),
(1077, 'MAL', 1382221, 10120, '2023-08-26', '07:50:02', 'A'),
(1078, 'MAL', 1382222, 10172, '2023-08-26', '07:51:22', 'A'),
(1079, 'MAL', 1382223, 10100, '2023-08-26', '07:53:36', 'A'),
(1080, 'MAL', 1382224, 20023, '2023-08-26', '08:20:52', 'A'),
(1081, 'MAL', 1382225, 20064, '2023-08-26', '12:00:02', 'A'),
(1082, 'MAL', 1382226, 10160, '2023-08-26', '17:00:45', 'Z'),
(1083, 'MAL', 1382227, 10177, '2023-08-26', '17:00:52', 'A'),
(1084, 'MAL', 1382228, 20036, '2023-08-26', '17:11:54', 'Z'),
(1085, 'MAL', 1382229, 20121, '2023-08-26', '17:11:58', 'Z'),
(1086, 'MAL', 1382230, 20044, '2023-08-27', '07:20:05', 'A'),
(1087, 'MAL', 1382231, 20060, '2023-08-27', '07:44:07', 'A'),
(1088, 'MAL', 1382232, 20059, '2023-08-29', '06:20:45', 'A'),
(1089, 'MAL', 1382233, 20038, '2023-08-29', '06:45:14', 'A'),
(1090, 'MAL', 1382234, 20097, '2023-08-29', '06:45:40', 'A'),
(1091, 'MAL', 1382235, 20119, '2023-08-29', '06:49:44', 'A'),
(1092, 'MAL', 1382236, 20104, '2023-08-29', '06:53:23', 'A'),
(1093, 'MAL', 1382237, 10178, '2023-08-29', '06:56:37', 'A'),
(1094, 'MAL', 1382238, 20115, '2023-08-29', '07:04:23', 'A'),
(1095, 'MAL', 1382239, 20051, '2023-08-29', '07:09:42', 'A'),
(1096, 'MAL', 1382240, 20050, '2023-08-29', '07:13:17', 'A'),
(1097, 'MAL', 1382241, 20054, '2023-08-29', '07:14:21', 'A'),
(1098, 'MAL', 1382242, 10114, '2023-08-29', '07:23:28', 'A'),
(1099, 'MAL', 1382243, 20151, '2023-08-29', '07:25:23', 'A'),
(1100, 'MAL', 1382244, 20134, '2023-08-29', '07:25:29', 'A'),
(1101, 'MAL', 1382245, 20035, '2023-08-29', '07:26:32', 'A'),
(1102, 'MAL', 1382246, 20181, '2023-08-29', '07:27:01', 'A'),
(1103, 'MAL', 1382247, 10144, '2023-08-29', '07:28:16', 'A'),
(1104, 'MAL', 1382248, 20165, '2023-08-29', '07:28:45', 'A'),
(1105, 'MAL', 1382249, 20012, '2023-08-29', '07:28:50', 'A'),
(1106, 'MAL', 1382250, 10017, '2023-08-29', '07:29:00', 'A'),
(1107, 'MAL', 1382251, 10147, '2023-08-29', '07:29:03', 'A'),
(1108, 'MAL', 1382252, 10100, '2023-08-29', '07:29:08', 'A'),
(1109, 'MAL', 1382253, 10007, '2023-08-29', '07:29:34', 'A'),
(1110, 'MAL', 1382254, 20008, '2023-08-29', '07:29:43', 'A'),
(1111, 'MAL', 1382255, 20002, '2023-08-29', '07:29:44', 'A'),
(1112, 'MAL', 1382256, 20134, '2023-08-29', '07:30:10', 'A'),
(1113, 'MAL', 1382257, 10157, '2023-08-29', '07:32:13', 'A'),
(1114, 'MAL', 1382258, 20015, '2023-08-29', '07:35:22', 'A'),
(1115, 'MAL', 1382259, 20062, '2023-08-29', '07:35:47', 'A'),
(1116, 'MAL', 1382260, 20017, '2023-08-29', '07:36:08', 'A'),
(1117, 'MAL', 1382261, 20121, '2023-08-29', '07:36:37', 'A'),
(1118, 'MAL', 1382262, 10073, '2023-08-29', '07:37:21', 'A'),
(1119, 'MAL', 1382263, 10023, '2023-08-29', '07:39:14', 'A'),
(1120, 'MAL', 1382264, 10089, '2023-08-29', '07:39:44', 'A'),
(1121, 'MAL', 1382265, 20078, '2023-08-29', '07:40:27', 'A'),
(1122, 'MAL', 1382266, 10177, '2023-08-29', '07:43:41', 'A'),
(1123, 'MAL', 1382267, 20139, '2023-08-29', '07:44:06', 'A'),
(1124, 'MAL', 1382268, 10006, '2023-08-29', '07:44:38', 'A'),
(1125, 'MAL', 1382269, 30008, '2023-08-29', '07:45:39', 'A'),
(1126, 'MAL', 1382270, 10038, '2023-08-29', '07:46:11', 'A'),
(1127, 'MAL', 1382271, 20082, '2023-08-29', '07:46:36', 'A'),
(1128, 'MAL', 1382272, 10034, '2023-08-29', '07:47:54', 'A'),
(1129, 'MAL', 1382273, 20023, '2023-08-29', '07:48:25', 'A'),
(1130, 'MAL', 1382274, 10167, '2023-08-29', '07:48:53', 'A'),
(1131, 'MAL', 1382275, 10120, '2023-08-29', '07:48:57', 'A'),
(1132, 'MAL', 1382276, 20198, '2023-08-29', '07:50:01', 'A'),
(1133, 'MAL', 1382277, 10135, '2023-08-29', '07:50:20', 'A'),
(1134, 'MAL', 1382278, 20186, '2023-08-29', '07:50:23', 'A'),
(1135, 'MAL', 1382279, 20128, '2023-08-29', '07:50:24', 'A'),
(1136, 'MAL', 1382280, 20159, '2023-08-29', '07:50:26', 'A'),
(1137, 'MAL', 1382281, 20204, '2023-08-29', '07:50:32', 'A'),
(1138, 'MAL', 1382282, 10171, '2023-08-29', '07:50:33', 'A'),
(1139, 'MAL', 1382283, 10145, '2023-08-29', '07:50:39', 'A'),
(1140, 'MAL', 1382284, 10173, '2023-08-29', '07:51:53', 'A'),
(1141, 'MAL', 1382285, 10163, '2023-08-29', '07:51:53', 'A'),
(1142, 'MAL', 1382286, 10012, '2023-08-29', '07:53:08', 'A'),
(1143, 'MAL', 1382287, 20056, '2023-08-29', '07:53:23', 'A'),
(1144, 'MAL', 1382288, 20071, '2023-08-29', '07:53:30', 'A'),
(1145, 'MAL', 1382289, 20007, '2023-08-29', '07:53:37', 'A'),
(1146, 'MAL', 1382290, 10154, '2023-08-29', '07:53:41', 'A'),
(1147, 'MAL', 1382291, 10170, '2023-08-29', '07:53:42', 'A'),
(1148, 'MAL', 1382292, 20064, '2023-08-29', '07:53:45', 'A'),
(1149, 'MAL', 1382293, 20190, '2023-08-29', '07:53:50', 'A'),
(1150, 'MAL', 1382294, 10021, '2023-08-29', '07:53:51', 'A'),
(1151, 'MAL', 1382295, 10168, '2023-08-29', '07:53:54', 'A'),
(1152, 'MAL', 1382296, 20160, '2023-08-29', '07:53:58', 'A'),
(1153, 'MAL', 1382297, 10164, '2023-08-29', '07:54:02', 'A'),
(1154, 'MAL', 1382298, 20018, '2023-08-29', '07:54:03', 'A'),
(1155, 'MAL', 1382299, 20189, '2023-08-29', '07:54:29', 'A'),
(1156, 'MAL', 1382300, 10015, '2023-08-29', '07:54:31', 'A'),
(1157, 'MAL', 1382301, 30003, '2023-08-29', '07:54:33', 'A'),
(1158, 'MAL', 1382302, 10115, '2023-08-29', '07:54:36', 'A'),
(1159, 'MAL', 1382303, 20029, '2023-08-29', '07:54:43', 'A'),
(1160, 'MAL', 1382304, 10174, '2023-08-29', '07:54:47', 'A'),
(1161, 'MAL', 1382305, 10175, '2023-08-29', '07:54:52', 'A'),
(1162, 'MAL', 1382306, 20131, '2023-08-29', '07:55:09', 'A'),
(1163, 'MAL', 1382307, 20168, '2023-08-29', '07:55:14', 'A'),
(1164, 'MAL', 1382308, 20084, '2023-08-29', '07:55:20', 'A'),
(1165, 'MAL', 1382309, 20091, '2023-08-29', '07:55:30', 'A'),
(1166, 'MAL', 1382310, 30006, '2023-08-29', '07:57:03', 'A'),
(1167, 'MAL', 1382311, 10026, '2023-08-29', '07:57:06', 'A'),
(1168, 'MAL', 1382312, 10172, '2023-08-29', '07:57:18', 'A'),
(1169, 'MAL', 1382313, 10075, '2023-08-29', '07:57:20', 'A'),
(1170, 'MAL', 1382314, 20043, '2023-08-29', '07:57:27', 'A'),
(1171, 'MAL', 1382315, 10176, '2023-08-29', '07:57:32', 'A'),
(1172, 'MAL', 1382316, 10035, '2023-08-29', '07:57:37', 'A'),
(1173, 'MAL', 1382317, 20044, '2023-08-29', '07:57:38', 'A'),
(1174, 'MAL', 1382318, 10139, '2023-08-29', '07:57:40', 'A'),
(1175, 'MAL', 1382319, 20063, '2023-08-29', '07:57:43', 'A'),
(1176, 'MAL', 1382320, 10140, '2023-08-29', '07:57:49', 'A'),
(1177, 'MAL', 1382321, 20044, '2023-08-29', '07:57:50', 'A'),
(1178, 'MAL', 1382322, 10093, '2023-08-29', '07:57:59', 'A'),
(1179, 'MAL', 1382323, 10169, '2023-08-29', '07:58:09', 'A'),
(1180, 'MAL', 1382324, 20136, '2023-08-29', '07:58:24', 'A'),
(1181, 'MAL', 1382325, 20016, '2023-08-29', '07:58:27', 'A'),
(1182, 'MAL', 1382326, 20152, '2023-08-29', '07:58:44', 'A'),
(1183, 'MAL', 1382327, 10179, '2023-08-29', '07:59:05', 'A'),
(1184, 'MAL', 1382328, 20032, '2023-08-29', '07:59:14', 'A'),
(1185, 'MAL', 1382329, 20074, '2023-08-29', '07:59:19', 'A'),
(1186, 'MAL', 1382330, 20076, '2023-08-29', '07:59:22', 'A'),
(1187, 'MAL', 1382331, 20087, '2023-08-29', '07:59:25', 'A'),
(1188, 'MAL', 1382332, 20133, '2023-08-29', '07:59:27', 'A'),
(1189, 'MAL', 1382333, 10009, '2023-08-29', '07:59:33', 'A'),
(1190, 'MAL', 1382334, 20112, '2023-08-29', '07:59:35', 'A'),
(1191, 'MAL', 1382335, 20123, '2023-08-29', '08:00:10', 'A'),
(1192, 'MAL', 1382336, 20115, '2023-08-29', '08:01:01', 'A'),
(1193, 'MAL', 1382337, 20175, '2023-08-29', '08:01:31', 'A'),
(1194, 'MAL', 1382338, 20098, '2023-08-29', '08:01:52', 'A'),
(1195, 'MAL', 1382339, 20124, '2023-08-29', '08:01:58', 'A'),
(1196, 'MAL', 1382340, 20003, '2023-08-29', '08:02:02', 'A'),
(1197, 'MAL', 1382341, 10113, '2023-08-29', '08:02:06', 'A'),
(1198, 'MAL', 1382342, 20132, '2023-08-29', '08:02:08', 'A'),
(1199, 'MAL', 1382343, 20100, '2023-08-29', '08:02:08', 'A'),
(1200, 'MAL', 1382344, 10121, '2023-08-29', '08:02:19', 'A'),
(1201, 'MAL', 1382345, 10148, '2023-08-29', '08:03:12', 'A'),
(1202, 'MAL', 1382346, 10143, '2023-08-29', '08:04:39', 'A'),
(1203, 'MAL', 1382347, 10095, '2023-08-29', '08:13:03', 'A'),
(1204, 'MAL', 1382348, 10124, '2023-08-29', '08:16:06', 'A'),
(1205, 'MAL', 1382349, 10030, '2023-08-29', '08:18:14', 'A'),
(1206, 'MAL', 1382350, 10027, '2023-08-29', '08:22:56', 'A'),
(1207, 'MAL', 1382351, 10103, '2023-08-29', '08:37:12', 'A'),
(1208, 'MAL', 1382352, 20006, '2023-08-29', '08:56:03', 'A'),
(1209, 'MAL', 1382353, 10094, '2023-08-29', '10:04:25', 'A'),
(1210, 'MAL', 1382354, 10034, '2023-08-29', '10:19:45', 'A'),
(1211, 'MAL', 1382355, 10113, '2023-08-29', '11:00:49', 'B'),
(1212, 'MAL', 1382356, 20160, '2023-08-29', '11:35:46', 'B'),
(1213, 'MAL', 1382357, 20160, '2023-08-29', '12:00:34', 'C'),
(1214, 'MAL', 1382358, 20189, '2023-08-29', '12:00:56', 'B'),
(1215, 'MAL', 1382359, 20139, '2023-08-29', '12:00:58', 'B'),
(1216, 'MAL', 1382360, 20159, '2023-08-29', '12:05:36', 'Z'),
(1217, 'MAL', 1382361, 10021, '2023-08-29', '12:18:06', 'B'),
(1218, 'MAL', 1382362, 20175, '2023-08-29', '12:20:24', 'B'),
(1219, 'MAL', 1382363, 20139, '2023-08-29', '12:21:36', 'C'),
(1220, 'MAL', 1382364, 20175, '2023-08-29', '12:30:01', 'C'),
(1221, 'MAL', 1382365, 20189, '2023-08-29', '12:32:22', 'C'),
(1222, 'MAL', 1382366, 20106, '2023-08-29', '12:52:32', 'A'),
(1223, 'MAL', 1382367, 20115, '2023-08-29', '16:00:12', 'Z'),
(1224, 'MAL', 1382368, 10178, '2023-08-29', '16:02:41', 'A'),
(1225, 'MAL', 1382369, 20036, '2023-08-29', '16:24:46', 'Z'),
(1226, 'MAL', 1382370, 20062, '2023-08-29', '17:00:06', 'A'),
(1227, 'MAL', 1382371, 20091, '2023-08-29', '17:00:18', 'Z'),
(1228, 'MAL', 1382372, 20098, '2023-08-29', '17:00:28', 'Z'),
(1229, 'MAL', 1382373, 20038, '2023-08-29', '17:00:35', 'Z'),
(1230, 'MAL', 1382374, 20112, '2023-08-29', '17:00:37', 'Z'),
(1231, 'MAL', 1382375, 20151, '2023-08-29', '17:00:47', 'Z'),
(1232, 'MAL', 1382376, 10073, '2023-08-29', '17:00:55', 'A'),
(1233, 'MAL', 1382377, 20012, '2023-08-29', '17:00:56', 'Z'),
(1234, 'MAL', 1382378, 10103, '2023-08-29', '17:01:07', 'Z'),
(1235, 'MAL', 1382379, 20204, '2023-08-29', '17:01:10', 'Z'),
(1236, 'MAL', 1382380, 20078, '2023-08-29', '17:01:12', 'Z'),
(1237, 'MAL', 1382381, 20119, '2023-08-29', '17:01:15', 'Z'),
(1238, 'MAL', 1382382, 20204, '2023-08-29', '17:01:16', 'Z'),
(1239, 'MAL', 1382383, 30008, '2023-08-29', '17:01:19', 'Z'),
(1240, 'MAL', 1382384, 20002, '2023-08-29', '17:01:28', 'Z'),
(1241, 'MAL', 1382385, 10027, '2023-08-29', '17:01:32', 'Z'),
(1242, 'MAL', 1382386, 20050, '2023-08-29', '17:01:32', 'Z'),
(1243, 'MAL', 1382387, 10006, '2023-08-29', '17:01:35', 'Z'),
(1244, 'MAL', 1382388, 10163, '2023-08-29', '17:01:41', 'Z'),
(1245, 'MAL', 1382389, 10170, '2023-08-29', '17:01:43', 'Z'),
(1246, 'MAL', 1382390, 10140, '2023-08-29', '17:01:44', 'Z'),
(1247, 'MAL', 1382391, 20064, '2023-08-29', '17:01:45', 'Z'),
(1248, 'MAL', 1382392, 10139, '2023-08-29', '17:01:46', 'Z'),
(1249, 'MAL', 1382393, 20121, '2023-08-29', '17:01:48', 'Z'),
(1250, 'MAL', 1382394, 20134, '2023-08-29', '17:01:51', 'Z'),
(1251, 'MAL', 1382395, 10171, '2023-08-29', '17:01:51', 'Z'),
(1252, 'MAL', 1382396, 20087, '2023-08-29', '17:01:56', 'Z'),
(1253, 'MAL', 1382397, 10075, '2023-08-29', '17:01:59', 'Z'),
(1254, 'MAL', 1382398, 10180, '2023-08-29', '17:02:01', 'Z'),
(1255, 'MAL', 1382399, 10168, '2023-08-29', '17:02:05', 'Z'),
(1256, 'MAL', 1382400, 10176, '2023-08-29', '17:02:10', 'Z'),
(1257, 'MAL', 1382401, 30003, '2023-08-29', '17:02:10', 'Z'),
(1258, 'MAL', 1382402, 10113, '2023-08-29', '17:02:14', 'Z'),
(1259, 'MAL', 1382403, 20051, '2023-08-29', '17:02:17', 'Z'),
(1260, 'MAL', 1382404, 20104, '2023-08-29', '17:02:22', 'Z'),
(1261, 'MAL', 1382405, 10144, '2023-08-29', '17:02:26', 'Z'),
(1262, 'MAL', 1382406, 20084, '2023-08-29', '17:02:27', 'Z'),
(1263, 'MAL', 1382407, 10157, '2023-08-29', '17:02:30', 'Z'),
(1264, 'MAL', 1382408, 20136, '2023-08-29', '17:02:37', 'Z'),
(1265, 'MAL', 1382409, 20168, '2023-08-29', '17:02:43', 'Z'),
(1266, 'MAL', 1382410, 10169, '2023-08-29', '17:02:44', 'Z'),
(1267, 'MAL', 1382411, 20165, '2023-08-29', '17:02:44', 'Z'),
(1268, 'MAL', 1382412, 10147, '2023-08-29', '17:02:46', 'Z'),
(1269, 'MAL', 1382413, 20032, '2023-08-29', '17:02:49', 'Z'),
(1270, 'MAL', 1382414, 10038, '2023-08-29', '17:02:51', 'Z'),
(1271, 'MAL', 1382415, 20003, '2023-08-29', '17:02:51', 'Z'),
(1272, 'MAL', 1382416, 10154, '2023-08-29', '17:02:54', 'Z'),
(1273, 'MAL', 1382417, 10093, '2023-08-29', '17:02:55', 'Z'),
(1274, 'MAL', 1382418, 10023, '2023-08-29', '17:02:56', 'Z'),
(1275, 'MAL', 1382419, 20076, '2023-08-29', '17:02:58', 'Z'),
(1276, 'MAL', 1382420, 10026, '2023-08-29', '17:02:59', 'Z'),
(1277, 'MAL', 1382421, 20056, '2023-08-29', '17:03:03', 'Z'),
(1278, 'MAL', 1382422, 20186, '2023-08-29', '17:03:03', 'Z'),
(1279, 'MAL', 1382423, 10179, '2023-08-29', '17:03:04', 'Z'),
(1280, 'MAL', 1382424, 10164, '2023-08-29', '17:03:08', 'Z'),
(1281, 'MAL', 1382425, 20128, '2023-08-29', '17:03:11', 'Z'),
(1282, 'MAL', 1382426, 10012, '2023-08-29', '17:03:11', 'Z'),
(1283, 'MAL', 1382427, 20175, '2023-08-29', '17:03:14', 'Z'),
(1284, 'MAL', 1382428, 20190, '2023-08-29', '17:03:18', 'Z'),
(1285, 'MAL', 1382429, 20139, '2023-08-29', '17:03:19', 'Z'),
(1286, 'MAL', 1382430, 10146, '2023-08-29', '17:03:21', 'Z'),
(1287, 'MAL', 1382431, 10017, '2023-08-29', '17:03:22', 'Z'),
(1288, 'MAL', 1382432, 20071, '2023-08-29', '17:03:23', 'Z'),
(1289, 'MAL', 1382433, 10100, '2023-08-29', '17:03:26', 'Z'),
(1290, 'MAL', 1382434, 20059, '2023-08-29', '17:03:27', 'Z'),
(1291, 'MAL', 1382435, 10120, '2023-08-29', '17:03:29', 'Z'),
(1292, 'MAL', 1382436, 20007, '2023-08-29', '17:03:30', 'Z'),
(1293, 'MAL', 1382437, 30006, '2023-08-29', '17:03:36', 'Z'),
(1294, 'MAL', 1382438, 20152, '2023-08-29', '17:03:39', 'Z'),
(1295, 'MAL', 1382439, 20008, '2023-08-29', '17:03:45', 'Z'),
(1296, 'MAL', 1382440, 20133, '2023-08-29', '17:03:46', 'Z'),
(1297, 'MAL', 1382441, 10089, '2023-08-29', '17:03:52', 'Z'),
(1298, 'MAL', 1382442, 20160, '2023-08-29', '17:03:54', 'Z'),
(1299, 'MAL', 1382443, 10175, '2023-08-29', '17:03:59', 'Z'),
(1300, 'MAL', 1382444, 20106, '2023-08-29', '17:04:00', 'Z'),
(1301, 'MAL', 1382445, 20189, '2023-08-29', '17:04:04', 'Z'),
(1302, 'MAL', 1382446, 20131, '2023-08-29', '17:04:09', 'Z'),
(1303, 'MAL', 1382447, 10177, '2023-08-29', '17:04:09', 'Z'),
(1304, 'MAL', 1382448, 20063, '2023-08-29', '17:04:15', 'Z'),
(1305, 'MAL', 1382449, 10167, '2023-08-29', '17:04:27', 'Z'),
(1306, 'MAL', 1382450, 10173, '2023-08-29', '17:04:38', 'Z'),
(1307, 'MAL', 1382451, 20082, '2023-08-29', '17:04:43', 'Z'),
(1308, 'MAL', 1382452, 10007, '2023-08-29', '17:04:48', 'Z'),
(1309, 'MAL', 1382453, 10035, '2023-08-29', '17:04:52', 'Z'),
(1310, 'MAL', 1382454, 20100, '2023-08-29', '17:04:56', 'Z'),
(1311, 'MAL', 1382455, 10135, '2023-08-29', '17:04:59', 'Z'),
(1312, 'MAL', 1382456, 10145, '2023-08-29', '17:05:08', 'Z'),
(1313, 'MAL', 1382457, 10172, '2023-08-29', '17:05:39', 'Z'),
(1314, 'MAL', 1382458, 10114, '2023-08-29', '17:05:54', 'Z'),
(1315, 'MAL', 1382459, 20074, '2023-08-29', '17:05:56', 'Z'),
(1316, 'MAL', 1382460, 10009, '2023-08-29', '17:06:05', 'Z'),
(1317, 'MAL', 1382461, 20198, '2023-08-29', '17:06:10', 'Z'),
(1318, 'MAL', 1382462, 20124, '2023-08-29', '17:06:29', 'Z'),
(1319, 'MAL', 1382463, 20054, '2023-08-29', '17:06:47', 'Z'),
(1320, 'MAL', 1382464, 10148, '2023-08-29', '17:08:25', 'Z'),
(1321, 'MAL', 1382465, 20015, '2023-08-29', '17:08:40', 'Z'),
(1322, 'MAL', 1382466, 20029, '2023-08-29', '17:08:43', 'Z'),
(1323, 'MAL', 1382467, 10015, '2023-08-29', '17:08:46', 'Z'),
(1324, 'MAL', 1382468, 20043, '2023-08-29', '17:10:08', 'Z'),
(1325, 'MAL', 1382469, 20035, '2023-08-29', '17:11:44', 'Z'),
(1326, 'MAL', 1382470, 10143, '2023-08-29', '17:12:45', 'Z'),
(1327, 'MAL', 1382471, 20018, '2023-08-29', '17:16:25', 'Z'),
(1328, 'MAL', 1382472, 20016, '2023-08-29', '17:16:29', 'Z'),
(1329, 'MAL', 1382473, 10121, '2023-08-29', '17:17:26', 'Z'),
(1330, 'MAL', 1382474, 10114, '2023-08-29', '17:17:40', 'Z'),
(1331, 'MAL', 1382475, 20181, '2023-08-29', '17:17:46', 'Z'),
(1332, 'MAL', 1382476, 10034, '2023-08-29', '17:23:23', 'Z'),
(1333, 'MAL', 1382477, 10030, '2023-08-29', '17:33:23', 'Z'),
(1334, 'MAL', 1382478, 10124, '2023-08-29', '17:38:02', 'Z'),
(1335, 'MAL', 1382479, 20023, '2023-08-29', '18:04:49', 'Z'),
(1336, 'MAL', 1382480, 10094, '2023-08-29', '18:25:00', 'Z'),
(1337, 'MAL', 1382481, 20006, '2023-08-29', '18:56:20', 'Z'),
(1338, 'MAL', 1382482, 10174, '2023-08-29', '19:11:55', 'Z'),
(1339, 'MAL', 1382483, 20030, '2023-08-30', '07:35:36', 'A'),
(1340, 'MAL', 1382484, 20036, '2023-08-31', '05:56:33', 'A'),
(1341, 'MAL', 1382485, 20060, '2023-08-31', '06:10:59', 'A'),
(1342, 'MAL', 1382486, 20059, '2023-08-31', '06:42:47', 'A'),
(1343, 'MAL', 1382487, 20119, '2023-08-31', '06:48:42', 'A'),
(1344, 'MAL', 1382488, 20097, '2023-08-31', '06:51:09', 'A'),
(1345, 'MAL', 1382489, 20104, '2023-08-31', '06:53:32', 'A'),
(1346, 'MAL', 1382490, 20115, '2023-08-31', '07:03:13', 'A'),
(1347, 'MAL', 1382491, 20038, '2023-08-31', '07:06:36', 'A'),
(1348, 'MAL', 1382492, 10178, '2023-08-31', '07:14:21', 'A'),
(1349, 'MAL', 1382493, 10144, '2023-08-31', '07:22:01', 'A'),
(1350, 'MAL', 1382494, 20050, '2023-08-31', '07:25:23', 'A'),
(1351, 'MAL', 1382495, 20015, '2023-08-31', '07:25:28', 'A'),
(1352, 'MAL', 1382496, 20053, '2023-08-31', '07:31:47', 'A'),
(1353, 'MAL', 1382497, 20182, '2023-08-31', '07:36:02', 'A'),
(1354, 'MAL', 1382498, 10114, '2023-08-31', '07:36:29', 'A'),
(1355, 'MAL', 1382499, 20017, '2023-08-31', '07:36:53', 'A'),
(1356, 'MAL', 1382500, 20023, '2023-08-31', '07:37:43', 'A'),
(1357, 'MAL', 1382501, 20017, '2023-08-31', '07:38:20', 'A'),
(1358, 'MAL', 1382502, 20181, '2023-08-31', '07:40:46', 'A'),
(1359, 'MAL', 1382503, 10007, '2023-08-31', '07:41:00', 'A'),
(1360, 'MAL', 1382504, 20205, '2023-08-31', '07:41:01', 'A'),
(1361, 'MAL', 1382505, 20008, '2023-08-31', '07:41:30', 'A'),
(1362, 'MAL', 1382506, 10157, '2023-08-31', '07:41:47', 'A'),
(1363, 'MAL', 1382507, 20002, '2023-08-31', '07:41:58', 'A'),
(1364, 'MAL', 1382508, 20071, '2023-08-31', '07:42:28', 'A'),
(1365, 'MAL', 1382509, 20139, '2023-08-31', '07:44:18', 'A'),
(1366, 'MAL', 1382510, 20134, '2023-08-31', '07:45:17', 'A'),
(1367, 'MAL', 1382511, 20151, '2023-08-31', '07:46:06', 'A'),
(1368, 'MAL', 1382512, 20035, '2023-08-31', '07:46:51', 'A'),
(1369, 'MAL', 1382513, 10034, '2023-08-31', '07:47:07', 'A'),
(1370, 'MAL', 1382514, 10177, '2023-08-31', '07:47:42', 'A'),
(1371, 'MAL', 1382515, 10167, '2023-08-31', '07:48:06', 'A'),
(1372, 'MAL', 1382516, 20082, '2023-08-31', '07:50:00', 'A'),
(1373, 'MAL', 1382517, 30003, '2023-08-31', '07:52:14', 'A'),
(1374, 'MAL', 1382518, 10023, '2023-08-31', '07:53:24', 'A'),
(1375, 'MAL', 1382519, 10100, '2023-08-31', '07:53:46', 'A'),
(1376, 'MAL', 1382520, 10147, '2023-08-31', '07:54:02', 'A'),
(1377, 'MAL', 1382521, 10139, '2023-08-31', '07:54:05', 'A'),
(1378, 'MAL', 1382522, 10035, '2023-08-31', '07:54:10', 'A'),
(1379, 'MAL', 1382523, 10075, '2023-08-31', '07:54:16', 'A'),
(1380, 'MAL', 1382524, 20112, '2023-08-31', '07:54:23', 'A'),
(1381, 'MAL', 1382525, 10017, '2023-08-31', '07:54:29', 'A'),
(1382, 'MAL', 1382526, 20044, '2023-08-31', '07:54:33', 'A'),
(1383, 'MAL', 1382527, 20012, '2023-08-31', '07:54:33', 'A'),
(1384, 'MAL', 1382528, 10176, '2023-08-31', '07:54:37', 'A'),
(1385, 'MAL', 1382529, 20062, '2023-08-31', '07:54:42', 'A'),
(1386, 'MAL', 1382530, 20165, '2023-08-31', '07:54:58', 'A'),
(1387, 'MAL', 1382531, 10006, '2023-08-31', '07:55:04', 'A'),
(1388, 'MAL', 1382532, 20118, '2023-08-31', '07:55:07', 'A'),
(1389, 'MAL', 1382533, 10073, '2023-08-31', '07:56:21', 'A'),
(1390, 'MAL', 1382534, 20106, '2023-08-31', '07:57:10', 'A'),
(1391, 'MAL', 1382535, 20198, '2023-08-31', '07:57:17', 'A'),
(1392, 'MAL', 1382536, 20189, '2023-08-31', '07:57:26', 'A'),
(1393, 'MAL', 1382537, 10041, '2023-08-31', '07:57:35', 'A'),
(1394, 'MAL', 1382538, 10038, '2023-08-31', '07:57:38', 'A'),
(1395, 'MAL', 1382539, 20078, '2023-08-31', '07:57:44', 'A'),
(1396, 'MAL', 1382540, 20091, '2023-08-31', '07:57:52', 'A'),
(1397, 'MAL', 1382541, 20056, '2023-08-31', '07:58:12', 'A'),
(1398, 'MAL', 1382542, 10154, '2023-08-31', '07:58:15', 'A'),
(1399, 'MAL', 1382543, 20007, '2023-08-31', '07:58:15', 'A'),
(1400, 'MAL', 1382544, 10160, '2023-08-31', '07:58:21', 'A'),
(1401, 'MAL', 1382545, 20064, '2023-08-31', '07:58:22', 'A'),
(1402, 'MAL', 1382546, 20190, '2023-08-31', '07:58:36', 'A'),
(1403, 'MAL', 1382547, 10170, '2023-08-31', '07:58:38', 'A'),
(1404, 'MAL', 1382548, 20160, '2023-08-31', '07:58:44', 'A'),
(1405, 'MAL', 1382549, 20018, '2023-08-31', '07:58:50', 'A'),
(1406, 'MAL', 1382550, 10021, '2023-08-31', '07:58:54', 'A'),
(1407, 'MAL', 1382551, 10115, '2023-08-31', '07:59:10', 'A'),
(1408, 'MAL', 1382552, 20152, '2023-08-31', '07:59:29', 'A'),
(1409, 'MAL', 1382553, 10172, '2023-08-31', '07:59:59', 'A'),
(1410, 'MAL', 1382554, 10095, '2023-08-31', '08:00:25', 'A'),
(1411, 'MAL', 1382555, 10121, '2023-08-31', '08:02:18', 'A'),
(1412, 'MAL', 1382556, 20115, '2023-08-31', '08:03:44', 'A'),
(1413, 'MAL', 1382557, 10175, '2023-08-31', '08:05:12', 'A'),
(1414, 'MAL', 1382558, 10174, '2023-08-31', '08:05:18', 'A'),
(1415, 'MAL', 1382559, 20204, '2023-08-31', '08:05:37', 'A'),
(1416, 'MAL', 1382560, 10140, '2023-08-31', '08:06:21', 'A'),
(1417, 'MAL', 1382561, 10093, '2023-08-31', '08:06:31', 'A'),
(1418, 'MAL', 1382562, 20192, '2023-08-31', '08:07:05', 'A'),
(1419, 'MAL', 1382563, 20168, '2023-08-31', '08:07:11', 'A'),
(1420, 'MAL', 1382564, 20084, '2023-08-31', '08:07:13', 'A'),
(1421, 'MAL', 1382565, 10012, '2023-08-31', '08:08:11', 'A'),
(1422, 'MAL', 1382566, 10026, '2023-08-31', '08:08:22', 'A'),
(1423, 'MAL', 1382567, 20191, '2023-08-31', '08:08:27', 'A'),
(1424, 'MAL', 1382568, 20003, '2023-08-31', '08:08:41', 'A'),
(1425, 'MAL', 1382569, 20124, '2023-08-31', '08:08:44', 'A'),
(1426, 'MAL', 1382570, 20098, '2023-08-31', '08:08:49', 'A'),
(1427, 'MAL', 1382571, 30008, '2023-08-31', '08:08:49', 'A'),
(1428, 'MAL', 1382572, 20100, '2023-08-31', '08:08:52', 'A'),
(1429, 'MAL', 1382573, 20016, '2023-08-31', '08:08:55', 'A'),
(1430, 'MAL', 1382574, 20029, '2023-08-31', '08:08:57', 'A'),
(1431, 'MAL', 1382575, 20132, '2023-08-31', '08:08:59', 'A'),
(1432, 'MAL', 1382576, 10113, '2023-08-31', '08:09:01', 'A'),
(1433, 'MAL', 1382577, 20076, '2023-08-31', '08:09:03', 'A'),
(1434, 'MAL', 1382578, 10015, '2023-08-31', '08:09:07', 'A'),
(1435, 'MAL', 1382579, 20186, '2023-08-31', '08:09:13', 'A'),
(1436, 'MAL', 1382580, 20001, '2023-08-31', '08:09:16', 'A'),
(1437, 'MAL', 1382581, 10135, '2023-08-31', '08:09:20', 'A'),
(1438, 'MAL', 1382582, 20128, '2023-08-31', '08:09:26', 'A'),
(1439, 'MAL', 1382583, 10145, '2023-08-31', '08:09:30', 'A'),
(1440, 'MAL', 1382584, 10089, '2023-08-31', '08:09:37', 'A'),
(1441, 'MAL', 1382585, 10171, '2023-08-31', '08:09:46', 'A'),
(1442, 'MAL', 1382586, 20159, '2023-08-31', '08:10:14', 'A'),
(1443, 'MAL', 1382587, 20063, '2023-08-31', '08:10:23', 'A'),
(1444, 'MAL', 1382588, 10027, '2023-08-31', '08:11:06', 'A'),
(1445, 'MAL', 1382589, 10120, '2023-08-31', '08:12:55', 'A'),
(1446, 'MAL', 1382590, 20175, '2023-08-31', '08:13:55', 'A'),
(1447, 'MAL', 1382591, 10173, '2023-08-31', '08:16:59', 'A'),
(1448, 'MAL', 1382592, 10169, '2023-08-31', '08:17:27', 'A'),
(1449, 'MAL', 1382593, 10168, '2023-08-31', '08:20:18', 'A'),
(1450, 'MAL', 1382594, 10164, '2023-08-31', '08:20:21', 'A'),
(1451, 'MAL', 1382595, 20069, '2023-08-31', '08:23:13', 'A'),
(1452, 'MAL', 1382596, 10124, '2023-08-31', '08:24:05', 'A'),
(1453, 'MAL', 1382597, 10163, '2023-08-31', '08:24:52', 'A'),
(1454, 'MAL', 1382598, 30006, '2023-08-31', '08:26:01', 'A'),
(1455, 'MAL', 1382599, 20043, '2023-08-31', '08:26:13', 'A'),
(1456, 'MAL', 1382600, 10030, '2023-08-31', '08:27:33', 'A'),
(1457, 'MAL', 1382601, 20074, '2023-08-31', '08:35:42', 'A'),
(1458, 'MAL', 1382602, 20032, '2023-08-31', '08:35:45', 'A'),
(1459, 'MAL', 1382603, 20087, '2023-08-31', '08:35:52', 'A'),
(1460, 'MAL', 1382604, 20133, '2023-08-31', '08:36:08', 'A'),
(1461, 'MAL', 1382605, 10180, '2023-08-31', '08:36:17', 'A'),
(1462, 'MAL', 1382606, 20123, '2023-08-31', '08:36:22', 'A'),
(1463, 'MAL', 1382607, 10146, '2023-08-31', '08:42:09', 'A'),
(1464, 'MAL', 1382608, 10148, '2023-08-31', '08:42:22', 'A'),
(1465, 'MAL', 1382609, 10009, '2023-08-31', '09:04:18', 'A'),
(1466, 'MAL', 1382610, 20006, '2023-08-31', '09:05:04', 'A'),
(1467, 'MAL', 1382611, 10179, '2023-08-31', '09:05:23', 'A'),
(1468, 'MAL', 1382612, 10086, '2023-08-31', '09:14:33', 'A'),
(1469, 'MAL', 1382613, 10103, '2023-08-31', '09:26:20', 'A'),
(1470, 'MAL', 1382614, 10034, '2023-08-31', '10:28:29', 'A'),
(1471, 'MAL', 1382615, 10143, '2023-08-31', '10:32:28', 'A'),
(1472, 'MAL', 1382616, 10094, '2023-08-31', '10:36:42', 'A'),
(1473, 'MAL', 1382617, 30008, '2023-08-31', '12:00:01', 'B'),
(1474, 'MAL', 1382618, 20189, '2023-08-31', '12:04:10', 'Z'),
(1475, 'MAL', 1382619, 20097, '2023-08-31', '12:04:18', 'Z'),
(1476, 'MAL', 1382620, 10179, '2023-08-31', '12:06:20', 'B'),
(1477, 'MAL', 1382621, 10135, '2023-08-31', '12:33:27', 'B'),
(1478, 'MAL', 1382622, 10179, '2023-08-31', '13:00:24', 'C'),
(1479, 'MAL', 1382623, 30008, '2023-08-31', '13:03:56', 'C'),
(1480, 'MAL', 1382624, 20165, '2023-08-31', '13:16:28', 'Z'),
(1481, 'MAL', 1382625, 10021, '2023-08-31', '15:28:54', 'Z'),
(1482, 'MAL', 1382626, 20036, '2023-08-31', '16:01:09', 'Z'),
(1483, 'MAL', 1382627, 20119, '2023-08-31', '16:01:10', 'Z'),
(1484, 'MAL', 1382628, 20118, '2023-08-31', '17:00:03', 'Z'),
(1485, 'MAL', 1382629, 20115, '2023-08-31', '17:00:10', 'Z'),
(1486, 'MAL', 1382630, 20053, '2023-08-31', '17:00:24', 'Z'),
(1487, 'MAL', 1382631, 20098, '2023-08-31', '17:00:50', 'Z'),
(1488, 'MAL', 1382632, 20151, '2023-08-31', '17:00:54', 'Z'),
(1489, 'MAL', 1382633, 10163, '2023-08-31', '17:01:01', 'Z'),
(1490, 'MAL', 1382634, 20062, '2023-08-31', '17:01:02', 'Z'),
(1491, 'MAL', 1382635, 10027, '2023-08-31', '17:01:06', 'Z'),
(1492, 'MAL', 1382636, 20182, '2023-08-31', '17:01:09', 'Z'),
(1493, 'MAL', 1382637, 20078, '2023-08-31', '17:01:14', 'Z'),
(1494, 'MAL', 1382638, 10006, '2023-08-31', '17:01:16', 'Z'),
(1495, 'MAL', 1382639, 10103, '2023-08-31', '17:01:18', 'Z'),
(1496, 'MAL', 1382640, 20016, '2023-08-31', '17:01:23', 'Z'),
(1497, 'MAL', 1382641, 20091, '2023-08-31', '17:01:23', 'Z'),
(1498, 'MAL', 1382642, 20152, '2023-08-31', '17:01:32', 'Z'),
(1499, 'MAL', 1382643, 20050, '2023-08-31', '17:01:38', 'Z'),
(1500, 'MAL', 1382644, 20008, '2023-08-31', '17:01:42', 'Z'),
(1501, 'MAL', 1382645, 20038, '2023-08-31', '17:01:42', 'Z'),
(1502, 'MAL', 1382646, 20175, '2023-08-31', '17:01:47', 'Z'),
(1503, 'MAL', 1382647, 20139, '2023-08-31', '17:01:51', 'Z'),
(1504, 'MAL', 1382648, 30008, '2023-08-31', '17:01:55', 'Z'),
(1505, 'MAL', 1382649, 20035, '2023-08-31', '17:01:56', 'Z'),
(1506, 'MAL', 1382650, 10073, '2023-08-31', '17:01:58', 'Z'),
(1507, 'MAL', 1382651, 20059, '2023-08-31', '17:02:01', 'Z'),
(1508, 'MAL', 1382652, 20112, '2023-08-31', '17:02:05', 'Z'),
(1509, 'MAL', 1382653, 10144, '2023-08-31', '17:02:08', 'Z'),
(1510, 'MAL', 1382654, 20112, '2023-08-31', '17:02:08', 'Z'),
(1511, 'MAL', 1382655, 20084, '2023-08-31', '17:02:13', 'Z'),
(1512, 'MAL', 1382656, 10180, '2023-08-31', '17:02:14', 'Z'),
(1513, 'MAL', 1382657, 20133, '2023-08-31', '17:02:19', 'Z'),
(1514, 'MAL', 1382658, 20002, '2023-08-31', '17:02:21', 'Z'),
(1515, 'MAL', 1382659, 10075, '2023-08-31', '17:02:27', 'Z'),
(1516, 'MAL', 1382660, 10095, '2023-08-31', '17:02:29', 'Z'),
(1517, 'MAL', 1382661, 20100, '2023-08-31', '17:02:31', 'Z'),
(1518, 'MAL', 1382662, 20087, '2023-08-31', '17:02:33', 'Z'),
(1519, 'MAL', 1382663, 10157, '2023-08-31', '17:02:36', 'Z'),
(1520, 'MAL', 1382664, 10171, '2023-08-31', '17:02:37', 'Z'),
(1521, 'MAL', 1382665, 10147, '2023-08-31', '17:02:40', 'Z'),
(1522, 'MAL', 1382666, 10168, '2023-08-31', '17:02:47', 'Z'),
(1523, 'MAL', 1382667, 10176, '2023-08-31', '17:02:50', 'Z'),
(1524, 'MAL', 1382668, 20124, '2023-08-31', '17:02:54', 'Z'),
(1525, 'MAL', 1382669, 20082, '2023-08-31', '17:02:59', 'Z'),
(1526, 'MAL', 1382670, 10113, '2023-08-31', '17:03:01', 'Z'),
(1527, 'MAL', 1382671, 20104, '2023-08-31', '17:03:02', 'Z'),
(1528, 'MAL', 1382672, 20204, '2023-08-31', '17:03:03', 'Z'),
(1529, 'MAL', 1382673, 10093, '2023-08-31', '17:03:05', 'Z'),
(1530, 'MAL', 1382674, 10179, '2023-08-31', '17:03:05', 'Z'),
(1531, 'MAL', 1382675, 10164, '2023-08-31', '17:03:12', 'Z'),
(1532, 'MAL', 1382676, 30003, '2023-08-31', '17:03:13', 'Z'),
(1533, 'MAL', 1382677, 30006, '2023-08-31', '17:03:18', 'Z'),
(1534, 'MAL', 1382678, 10146, '2023-08-31', '17:03:25', 'Z'),
(1535, 'MAL', 1382679, 10170, '2023-08-31', '17:03:27', 'Z'),
(1536, 'MAL', 1382680, 10140, '2023-08-31', '17:03:28', 'Z'),
(1537, 'MAL', 1382681, 10139, '2023-08-31', '17:03:30', 'Z'),
(1538, 'MAL', 1382682, 10017, '2023-08-31', '17:03:32', 'Z'),
(1539, 'MAL', 1382683, 10175, '2023-08-31', '17:03:36', 'Z'),
(1540, 'MAL', 1382684, 20106, '2023-08-31', '17:03:39', 'Z'),
(1541, 'MAL', 1382685, 10154, '2023-08-31', '17:03:40', 'Z'),
(1542, 'MAL', 1382686, 20076, '2023-08-31', '17:03:43', 'Z'),
(1543, 'MAL', 1382687, 20160, '2023-08-31', '17:03:46', 'Z'),
(1544, 'MAL', 1382688, 20029, '2023-08-31', '17:03:47', 'Z'),
(1545, 'MAL', 1382689, 10023, '2023-08-31', '17:03:47', 'Z'),
(1546, 'MAL', 1382690, 10038, '2023-08-31', '17:03:49', 'Z'),
(1547, 'MAL', 1382691, 20032, '2023-08-31', '17:03:51', 'Z'),
(1548, 'MAL', 1382692, 20018, '2023-08-31', '17:03:53', 'Z'),
(1549, 'MAL', 1382693, 20074, '2023-08-31', '17:03:56', 'Z'),
(1550, 'MAL', 1382694, 10169, '2023-08-31', '17:03:58', 'Z'),
(1551, 'MAL', 1382695, 10145, '2023-08-31', '17:04:08', 'Z'),
(1552, 'MAL', 1382696, 20168, '2023-08-31', '17:04:17', 'Z'),
(1553, 'MAL', 1382697, 20190, '2023-08-31', '17:04:20', 'Z'),
(1554, 'MAL', 1382698, 10035, '2023-08-31', '17:04:21', 'Z'),
(1555, 'MAL', 1382699, 20071, '2023-08-31', '17:04:25', 'Z'),
(1556, 'MAL', 1382700, 20017, '2023-08-31', '17:04:25', 'Z'),
(1557, 'MAL', 1382701, 20054, '2023-08-31', '17:04:27', 'Z'),
(1558, 'MAL', 1382702, 20069, '2023-08-31', '17:04:27', 'Z'),
(1559, 'MAL', 1382703, 10007, '2023-08-31', '17:04:34', 'Z'),
(1560, 'MAL', 1382704, 20128, '2023-08-31', '17:04:34', 'Z'),
(1561, 'MAL', 1382705, 10121, '2023-08-31', '17:04:39', 'Z'),
(1562, 'MAL', 1382706, 10160, '2023-08-31', '17:04:40', 'Z'),
(1563, 'MAL', 1382707, 20192, '2023-08-31', '17:04:48', 'Z'),
(1564, 'MAL', 1382708, 20205, '2023-08-31', '17:04:48', 'Z'),
(1565, 'MAL', 1382709, 20186, '2023-08-31', '17:04:51', 'Z'),
(1566, 'MAL', 1382710, 10120, '2023-08-31', '17:04:54', 'Z'),
(1567, 'MAL', 1382711, 10100, '2023-08-31', '17:04:59', 'Z'),
(1568, 'MAL', 1382712, 10089, '2023-08-31', '17:05:03', 'Z'),
(1569, 'MAL', 1382713, 20063, '2023-08-31', '17:05:06', 'Z'),
(1570, 'MAL', 1382714, 10174, '2023-08-31', '17:05:14', 'Z'),
(1571, 'MAL', 1382715, 20198, '2023-08-31', '17:05:18', 'Z'),
(1572, 'MAL', 1382716, 10135, '2023-08-31', '17:05:20', 'Z'),
(1573, 'MAL', 1382717, 20159, '2023-08-31', '17:05:26', 'Z'),
(1574, 'MAL', 1382718, 10173, '2023-08-31', '17:05:32', 'Z'),
(1575, 'MAL', 1382719, 10167, '2023-08-31', '17:05:36', 'Z'),
(1576, 'MAL', 1382720, 10177, '2023-08-31', '17:05:37', 'Z'),
(1577, 'MAL', 1382721, 20191, '2023-08-31', '17:05:40', 'Z'),
(1578, 'MAL', 1382722, 10009, '2023-08-31', '17:05:52', 'Z'),
(1579, 'MAL', 1382723, 20001, '2023-08-31', '17:06:02', 'Z'),
(1580, 'MAL', 1382724, 20043, '2023-08-31', '17:06:05', 'Z'),
(1581, 'MAL', 1382725, 10026, '2023-08-31', '17:06:21', 'Z'),
(1582, 'MAL', 1382726, 20012, '2023-08-31', '17:06:39', 'Z'),
(1583, 'MAL', 1382727, 10034, '2023-08-31', '17:07:20', 'Z'),
(1584, 'MAL', 1382728, 20007, '2023-08-31', '17:08:35', 'Z'),
(1585, 'MAL', 1382729, 20023, '2023-08-31', '17:08:40', 'Z'),
(1586, 'MAL', 1382730, 10114, '2023-08-31', '17:09:43', 'Z'),
(1587, 'MAL', 1382731, 20015, '2023-08-31', '17:09:49', 'Z'),
(1588, 'MAL', 1382732, 10012, '2023-08-31', '17:10:02', 'Z'),
(1589, 'MAL', 1382733, 20003, '2023-08-31', '17:10:30', 'Z'),
(1590, 'MAL', 1382734, 20056, '2023-08-31', '17:16:32', 'Z'),
(1591, 'MAL', 1382735, 10041, '2023-08-31', '17:18:37', 'Z'),
(1592, 'MAL', 1382736, 10143, '2023-08-31', '17:29:51', 'Z'),
(1593, 'MAL', 1382737, 10030, '2023-08-31', '17:29:57', 'Z'),
(1594, 'MAL', 1382738, 10124, '2023-08-31', '17:32:07', 'Z'),
(1595, 'MAL', 1382739, 20134, '2023-08-31', '17:40:19', 'Z'),
(1596, 'MAL', 1382740, 10094, '2023-08-31', '18:01:24', 'Z'),
(1597, 'MAL', 1382741, 10148, '2023-08-31', '18:08:07', 'Z'),
(1598, 'MAL', 1382742, 10086, '2023-08-31', '18:13:09', 'Z'),
(1599, 'MAL', 1382743, 20006, '2023-08-31', '18:28:50', 'Z'),
(1600, 'MAL', 1382744, 10178, '2023-08-31', '20:04:41', 'Z'),
(1601, 'MAL', 1382745, 20181, '2023-08-31', '20:04:49', 'Z'),
(1602, 'MAL', 1382746, 20064, '2023-08-31', '20:04:54', 'Z'),
(1603, 'MAL', 1382747, 20036, '2023-09-01', '05:55:31', 'A'),
(1604, 'MAL', 1382748, 20030, '2023-09-01', '06:22:15', 'A'),
(1605, 'MAL', 1382749, 20097, '2023-09-01', '06:32:46', 'A'),
(1606, 'MAL', 1382750, 20115, '2023-09-01', '06:47:14', 'A'),
(1607, 'MAL', 1382751, 20119, '2023-09-01', '06:56:29', 'A'),
(1608, 'MAL', 1382752, 20104, '2023-09-01', '07:03:27', 'A'),
(1609, 'MAL', 1382753, 20035, '2023-09-01', '07:09:40', 'A'),
(1610, 'MAL', 1382754, 20051, '2023-09-01', '07:13:44', 'A'),
(1611, 'MAL', 1382755, 20121, '2023-09-01', '07:14:31', 'A'),
(1612, 'MAL', 1382756, 20059, '2023-09-01', '07:20:55', 'A'),
(1613, 'MAL', 1382757, 20038, '2023-09-01', '07:22:25', 'A'),
(1614, 'MAL', 1382758, 10157, '2023-09-01', '07:22:31', 'A'),
(1615, 'MAL', 1382759, 10124, '2023-09-01', '07:22:56', 'A'),
(1616, 'MAL', 1382760, 10114, '2023-09-01', '07:23:35', 'A'),
(1617, 'MAL', 1382761, 20134, '2023-09-01', '07:24:09', 'A'),
(1618, 'MAL', 1382762, 20015, '2023-09-01', '07:27:04', 'A'),
(1619, 'MAL', 1382763, 20181, '2023-09-01', '07:27:23', 'A'),
(1620, 'MAL', 1382764, 20023, '2023-09-01', '07:32:32', 'A'),
(1621, 'MAL', 1382765, 10007, '2023-09-01', '07:33:09', 'A'),
(1622, 'MAL', 1382766, 20205, '2023-09-01', '07:33:27', 'A'),
(1623, 'MAL', 1382767, 20008, '2023-09-01', '07:33:31', 'A'),
(1624, 'MAL', 1382768, 20002, '2023-09-01', '07:33:41', 'A'),
(1625, 'MAL', 1382769, 10144, '2023-09-01', '07:37:52', 'A'),
(1626, 'MAL', 1382770, 20165, '2023-09-01', '07:38:32', 'A'),
(1627, 'MAL', 1382771, 10147, '2023-09-01', '07:38:38', 'A'),
(1628, 'MAL', 1382772, 20060, '2023-09-01', '07:38:44', 'A'),
(1629, 'MAL', 1382773, 10017, '2023-09-01', '07:38:51', 'A'),
(1630, 'MAL', 1382774, 20139, '2023-09-01', '07:42:48', 'A'),
(1631, 'MAL', 1382775, 20082, '2023-09-01', '07:43:39', 'A'),
(1632, 'MAL', 1382776, 10177, '2023-09-01', '07:44:16', 'A'),
(1633, 'MAL', 1382777, 10038, '2023-09-01', '07:44:56', 'A'),
(1634, 'MAL', 1382778, 20106, '2023-09-01', '07:47:00', 'A'),
(1635, 'MAL', 1382779, 20053, '2023-09-01', '07:47:07', 'A'),
(1636, 'MAL', 1382780, 20091, '2023-09-01', '07:47:16', 'A'),
(1637, 'MAL', 1382781, 10034, '2023-09-01', '07:47:30', 'A'),
(1638, 'MAL', 1382782, 20029, '2023-09-01', '07:48:08', 'A'),
(1639, 'MAL', 1382783, 10015, '2023-09-01', '07:48:27', 'A'),
(1640, 'MAL', 1382784, 20151, '2023-09-01', '07:48:46', 'A'),
(1641, 'MAL', 1382785, 20017, '2023-09-01', '07:48:50', 'A'),
(1642, 'MAL', 1382786, 20118, '2023-09-01', '07:48:55', 'A'),
(1643, 'MAL', 1382787, 10023, '2023-09-01', '07:49:08', 'A'),
(1644, 'MAL', 1382788, 20198, '2023-09-01', '07:49:18', 'A'),
(1645, 'MAL', 1382789, 20001, '2023-09-01', '07:49:50', 'A'),
(1646, 'MAL', 1382790, 10073, '2023-09-01', '07:50:09', 'A'),
(1647, 'MAL', 1382791, 10075, '2023-09-01', '07:51:32', 'A'),
(1648, 'MAL', 1382792, 10139, '2023-09-01', '07:51:35', 'A'),
(1649, 'MAL', 1382793, 10035, '2023-09-01', '07:51:36', 'A'),
(1650, 'MAL', 1382794, 10176, '2023-09-01', '07:51:41', 'A'),
(1651, 'MAL', 1382795, 20044, '2023-09-01', '07:51:45', 'A'),
(1652, 'MAL', 1382796, 20069, '2023-09-01', '07:51:57', 'A'),
(1653, 'MAL', 1382797, 10006, '2023-09-01', '07:52:21', 'A'),
(1654, 'MAL', 1382798, 30003, '2023-09-01', '07:53:16', 'A'),
(1655, 'MAL', 1382799, 20078, '2023-09-01', '07:54:27', 'A'),
(1656, 'MAL', 1382800, 20032, '2023-09-01', '07:54:44', 'A'),
(1657, 'MAL', 1382801, 10172, '2023-09-01', '07:54:52', 'A'),
(1658, 'MAL', 1382802, 20133, '2023-09-01', '07:54:59', 'A'),
(1659, 'MAL', 1382803, 20074, '2023-09-01', '07:55:00', 'A'),
(1660, 'MAL', 1382804, 10009, '2023-09-01', '07:55:07', 'A'),
(1661, 'MAL', 1382805, 20076, '2023-09-01', '07:55:31', 'A'),
(1662, 'MAL', 1382806, 10175, '2023-09-01', '07:55:45', 'A'),
(1663, 'MAL', 1382807, 20112, '2023-09-01', '07:55:59', 'A'),
(1664, 'MAL', 1382808, 10027, '2023-09-01', '07:56:10', 'A'),
(1665, 'MAL', 1382809, 20191, '2023-09-01', '07:56:16', 'A'),
(1666, 'MAL', 1382810, 20123, '2023-09-01', '07:56:26', 'A'),
(1667, 'MAL', 1382811, 10174, '2023-09-01', '07:56:26', 'A'),
(1668, 'MAL', 1382812, 20062, '2023-09-01', '07:56:33', 'A'),
(1669, 'MAL', 1382813, 20192, '2023-09-01', '07:56:36', 'A'),
(1670, 'MAL', 1382814, 20056, '2023-09-01', '07:56:40', 'A'),
(1671, 'MAL', 1382815, 20084, '2023-09-01', '07:56:41', 'A'),
(1672, 'MAL', 1382816, 10180, '2023-09-01', '07:56:46', 'A'),
(1673, 'MAL', 1382817, 20071, '2023-09-01', '07:56:46', 'A'),
(1674, 'MAL', 1382818, 20168, '2023-09-01', '07:56:50', 'A'),
(1675, 'MAL', 1382819, 10154, '2023-09-01', '07:56:55', 'A'),
(1676, 'MAL', 1382820, 20064, '2023-09-01', '07:57:01', 'A'),
(1677, 'MAL', 1382821, 20029, '2023-09-01', '07:57:05', 'A'),
(1678, 'MAL', 1382822, 10170, '2023-09-01', '07:57:13', 'A'),
(1679, 'MAL', 1382823, 10173, '2023-09-01', '07:57:15', 'A'),
(1680, 'MAL', 1382824, 20190, '2023-09-01', '07:57:28', 'A');
INSERT INTO `tbl_attendance` (`id`, `c_locations`, `c_timecardid`, `c_idno`, `c_trandate`, `c_trantime`, `c_trantype`) VALUES
(1681, 'MAL', 1382825, 10168, '2023-09-01', '07:57:30', 'A'),
(1682, 'MAL', 1382826, 20160, '2023-09-01', '07:57:33', 'A'),
(1683, 'MAL', 1382827, 20018, '2023-09-01', '07:57:35', 'A'),
(1684, 'MAL', 1382828, 10164, '2023-09-01', '07:57:38', 'A'),
(1685, 'MAL', 1382829, 30008, '2023-09-01', '07:57:41', 'A'),
(1686, 'MAL', 1382830, 10021, '2023-09-01', '07:57:47', 'A'),
(1687, 'MAL', 1382831, 10026, '2023-09-01', '07:58:06', 'A'),
(1688, 'MAL', 1382832, 10012, '2023-09-01', '07:58:09', 'A'),
(1689, 'MAL', 1382833, 20063, '2023-09-01', '07:58:16', 'A'),
(1690, 'MAL', 1382834, 10041, '2023-09-01', '07:58:33', 'A'),
(1691, 'MAL', 1382835, 10115, '2023-09-01', '07:58:41', 'A'),
(1692, 'MAL', 1382836, 10135, '2023-09-01', '07:58:55', 'A'),
(1693, 'MAL', 1382837, 20186, '2023-09-01', '07:58:59', 'A'),
(1694, 'MAL', 1382838, 20182, '2023-09-01', '07:59:03', 'A'),
(1695, 'MAL', 1382839, 10089, '2023-09-01', '07:59:04', 'A'),
(1696, 'MAL', 1382840, 20186, '2023-09-01', '07:59:07', 'A'),
(1697, 'MAL', 1382841, 20159, '2023-09-01', '07:59:13', 'A'),
(1698, 'MAL', 1382842, 10145, '2023-09-01', '07:59:18', 'A'),
(1699, 'MAL', 1382843, 20204, '2023-09-01', '07:59:21', 'A'),
(1700, 'MAL', 1382844, 10140, '2023-09-01', '07:59:23', 'A'),
(1701, 'MAL', 1382845, 10171, '2023-09-01', '07:59:25', 'A'),
(1702, 'MAL', 1382846, 20128, '2023-09-01', '07:59:30', 'A'),
(1703, 'MAL', 1382847, 10093, '2023-09-01', '07:59:35', 'A'),
(1704, 'MAL', 1382848, 10120, '2023-09-01', '08:00:11', 'A'),
(1705, 'MAL', 1382849, 30006, '2023-09-01', '08:00:28', 'A'),
(1706, 'MAL', 1382850, 10143, '2023-09-01', '08:00:36', 'A'),
(1707, 'MAL', 1382851, 20016, '2023-09-01', '08:00:42', 'A'),
(1708, 'MAL', 1382852, 20043, '2023-09-01', '08:00:52', 'A'),
(1709, 'MAL', 1382853, 20136, '2023-09-01', '08:01:01', 'A'),
(1710, 'MAL', 1382854, 20152, '2023-09-01', '08:01:14', 'A'),
(1711, 'MAL', 1382855, 20131, '2023-09-01', '08:01:18', 'A'),
(1712, 'MAL', 1382856, 10179, '2023-09-01', '08:01:25', 'A'),
(1713, 'MAL', 1382857, 10163, '2023-09-01', '08:01:55', 'A'),
(1714, 'MAL', 1382858, 10121, '2023-09-01', '08:02:26', 'A'),
(1715, 'MAL', 1382859, 10169, '2023-09-01', '08:03:26', 'A'),
(1716, 'MAL', 1382860, 20189, '2023-09-01', '08:04:32', 'A'),
(1717, 'MAL', 1382861, 10100, '2023-09-01', '08:04:56', 'A'),
(1718, 'MAL', 1382862, 20175, '2023-09-01', '08:05:13', 'A'),
(1719, 'MAL', 1382863, 10160, '2023-09-01', '08:06:02', 'A'),
(1720, 'MAL', 1382864, 20098, '2023-09-01', '08:09:09', 'A'),
(1721, 'MAL', 1382865, 20124, '2023-09-01', '08:09:20', 'A'),
(1722, 'MAL', 1382866, 20003, '2023-09-01', '08:09:24', 'A'),
(1723, 'MAL', 1382867, 20132, '2023-09-01', '08:09:26', 'A'),
(1724, 'MAL', 1382868, 20100, '2023-09-01', '08:09:27', 'A'),
(1725, 'MAL', 1382869, 10113, '2023-09-01', '08:09:33', 'A'),
(1726, 'MAL', 1382870, 10148, '2023-09-01', '08:21:38', 'A'),
(1727, 'MAL', 1382871, 20007, '2023-09-01', '08:28:43', 'A'),
(1728, 'MAL', 1382872, 10030, '2023-09-01', '08:29:59', 'A'),
(1729, 'MAL', 1382873, 10086, '2023-09-01', '08:40:53', 'A'),
(1730, 'MAL', 1382874, 10095, '2023-09-01', '08:50:19', 'A'),
(1731, 'MAL', 1382875, 10103, '2023-09-01', '08:52:58', 'A'),
(1732, 'MAL', 1382876, 20006, '2023-09-01', '09:00:13', 'A'),
(1733, 'MAL', 1382877, 20115, '2023-09-01', '09:19:53', 'A'),
(1734, 'MAL', 1382878, 10146, '2023-09-01', '09:24:07', 'A'),
(1735, 'MAL', 1382879, 20054, '2023-09-01', '11:11:17', 'C'),
(1736, 'MAL', 1382880, 20064, '2023-09-01', '12:01:56', 'Z'),
(1737, 'MAL', 1382881, 10179, '2023-09-01', '12:02:13', 'B'),
(1738, 'MAL', 1382882, 20124, '2023-09-01', '12:13:14', 'Z'),
(1739, 'MAL', 1382883, 10034, '2023-09-01', '12:33:53', 'A'),
(1740, 'MAL', 1382884, 20044, '2023-09-01', '12:34:13', 'Z'),
(1741, 'MAL', 1382885, 20159, '2023-09-01', '12:53:54', 'Z'),
(1742, 'MAL', 1382886, 10179, '2023-09-01', '12:54:43', 'C'),
(1743, 'MAL', 1382887, 20182, '2023-09-01', '13:03:10', 'B'),
(1744, 'MAL', 1382888, 20182, '2023-09-01', '13:54:02', 'C'),
(1745, 'MAL', 1382889, 10174, '2023-09-01', '15:34:10', 'C'),
(1746, 'MAL', 1382890, 20119, '2023-09-01', '16:03:04', 'Z'),
(1747, 'MAL', 1382891, 20036, '2023-09-01', '16:03:17', 'Z'),
(1748, 'MAL', 1382892, 10103, '2023-09-01', '17:00:03', 'Z'),
(1749, 'MAL', 1382893, 20115, '2023-09-01', '17:00:12', 'Z'),
(1750, 'MAL', 1382894, 10140, '2023-09-01', '17:00:24', 'Z'),
(1751, 'MAL', 1382895, 20016, '2023-09-01', '17:00:32', 'Z'),
(1752, 'MAL', 1382896, 20098, '2023-09-01', '17:00:35', 'Z'),
(1753, 'MAL', 1382897, 10139, '2023-09-01', '17:00:41', 'Z'),
(1754, 'MAL', 1382898, 20204, '2023-09-01', '17:00:43', 'Z'),
(1755, 'MAL', 1382899, 20053, '2023-09-01', '17:01:00', 'Z'),
(1756, 'MAL', 1382900, 20084, '2023-09-01', '17:01:05', 'Z'),
(1757, 'MAL', 1382901, 10021, '2023-09-01', '17:01:08', 'Z'),
(1758, 'MAL', 1382902, 10171, '2023-09-01', '17:01:13', 'Z'),
(1759, 'MAL', 1382903, 20002, '2023-09-01', '17:01:14', 'Z'),
(1760, 'MAL', 1382904, 10145, '2023-09-01', '17:01:19', 'Z'),
(1761, 'MAL', 1382905, 20121, '2023-09-01', '17:01:21', 'Z'),
(1762, 'MAL', 1382906, 30003, '2023-09-01', '17:01:22', 'Z'),
(1763, 'MAL', 1382907, 20100, '2023-09-01', '17:01:23', 'Z'),
(1764, 'MAL', 1382908, 10075, '2023-09-01', '17:01:29', 'Z'),
(1765, 'MAL', 1382909, 20059, '2023-09-01', '17:01:39', 'Z'),
(1766, 'MAL', 1382910, 20062, '2023-09-01', '17:01:41', 'Z'),
(1767, 'MAL', 1382911, 20112, '2023-09-01', '17:01:43', 'Z'),
(1768, 'MAL', 1382912, 20106, '2023-09-01', '17:01:43', 'Z'),
(1769, 'MAL', 1382913, 10154, '2023-09-01', '17:01:48', 'Z'),
(1770, 'MAL', 1382914, 20165, '2023-09-01', '17:01:53', 'Z'),
(1771, 'MAL', 1382915, 10113, '2023-09-01', '17:01:57', 'Z'),
(1772, 'MAL', 1382916, 20160, '2023-09-01', '17:02:00', 'Z'),
(1773, 'MAL', 1382917, 10157, '2023-09-01', '17:02:03', 'Z'),
(1774, 'MAL', 1382918, 10179, '2023-09-01', '17:02:04', 'Z'),
(1775, 'MAL', 1382919, 10147, '2023-09-01', '17:02:07', 'Z'),
(1776, 'MAL', 1382920, 10180, '2023-09-01', '17:02:11', 'Z'),
(1777, 'MAL', 1382921, 20133, '2023-09-01', '17:02:14', 'Z'),
(1778, 'MAL', 1382922, 10176, '2023-09-01', '17:02:17', 'Z'),
(1779, 'MAL', 1382923, 20151, '2023-09-01', '17:02:18', 'Z'),
(1780, 'MAL', 1382924, 30008, '2023-09-01', '17:02:24', 'Z'),
(1781, 'MAL', 1382925, 10168, '2023-09-01', '17:02:28', 'Z'),
(1782, 'MAL', 1382926, 10093, '2023-09-01', '17:02:31', 'Z'),
(1783, 'MAL', 1382927, 20104, '2023-09-01', '17:02:39', 'Z'),
(1784, 'MAL', 1382928, 20205, '2023-09-01', '17:02:40', 'Z'),
(1785, 'MAL', 1382929, 10135, '2023-09-01', '17:02:43', 'Z'),
(1786, 'MAL', 1382930, 10146, '2023-09-01', '17:02:44', 'Z'),
(1787, 'MAL', 1382931, 10173, '2023-09-01', '17:02:52', 'Z'),
(1788, 'MAL', 1382932, 10170, '2023-09-01', '17:02:54', 'Z'),
(1789, 'MAL', 1382933, 20032, '2023-09-01', '17:03:01', 'Z'),
(1790, 'MAL', 1382934, 20168, '2023-09-01', '17:03:05', 'Z'),
(1791, 'MAL', 1382935, 20192, '2023-09-01', '17:03:07', 'Z'),
(1792, 'MAL', 1382936, 20078, '2023-09-01', '17:03:11', 'Z'),
(1793, 'MAL', 1382937, 20186, '2023-09-01', '17:03:14', 'Z'),
(1794, 'MAL', 1382938, 10089, '2023-09-01', '17:03:15', 'Z'),
(1795, 'MAL', 1382939, 20074, '2023-09-01', '17:03:25', 'Z'),
(1796, 'MAL', 1382940, 20051, '2023-09-01', '17:03:27', 'Z'),
(1797, 'MAL', 1382941, 20128, '2023-09-01', '17:03:31', 'Z'),
(1798, 'MAL', 1382942, 20131, '2023-09-01', '17:03:32', 'Z'),
(1799, 'MAL', 1382943, 10163, '2023-09-01', '17:03:36', 'Z'),
(1800, 'MAL', 1382944, 20071, '2023-09-01', '17:03:37', 'Z'),
(1801, 'MAL', 1382945, 20056, '2023-09-01', '17:03:41', 'Z'),
(1802, 'MAL', 1382946, 20175, '2023-09-01', '17:03:45', 'Z'),
(1803, 'MAL', 1382947, 20069, '2023-09-01', '17:03:49', 'Z'),
(1804, 'MAL', 1382948, 10027, '2023-09-01', '17:03:49', 'Z'),
(1805, 'MAL', 1382949, 10012, '2023-09-01', '17:03:51', 'Z'),
(1806, 'MAL', 1382950, 20190, '2023-09-01', '17:03:52', 'Z'),
(1807, 'MAL', 1382951, 10006, '2023-09-01', '17:03:55', 'Z'),
(1808, 'MAL', 1382952, 20139, '2023-09-01', '17:03:56', 'Z'),
(1809, 'MAL', 1382953, 20191, '2023-09-01', '17:03:57', 'Z'),
(1810, 'MAL', 1382954, 20063, '2023-09-01', '17:03:59', 'Z'),
(1811, 'MAL', 1382955, 10160, '2023-09-01', '17:04:02', 'Z'),
(1812, 'MAL', 1382956, 10175, '2023-09-01', '17:04:04', 'Z'),
(1813, 'MAL', 1382957, 20018, '2023-09-01', '17:04:06', 'Z'),
(1814, 'MAL', 1382958, 10164, '2023-09-01', '17:04:08', 'Z'),
(1815, 'MAL', 1382959, 20136, '2023-09-01', '17:04:17', 'Z'),
(1816, 'MAL', 1382960, 20054, '2023-09-01', '17:04:20', 'Z'),
(1817, 'MAL', 1382961, 10026, '2023-09-01', '17:04:20', 'Z'),
(1818, 'MAL', 1382962, 10038, '2023-09-01', '17:04:21', 'Z'),
(1819, 'MAL', 1382963, 10035, '2023-09-01', '17:04:29', 'Z'),
(1820, 'MAL', 1382964, 20035, '2023-09-01', '17:04:40', 'Z'),
(1821, 'MAL', 1382965, 20007, '2023-09-01', '17:04:51', 'Z'),
(1822, 'MAL', 1382966, 20029, '2023-09-01', '17:04:56', 'Z'),
(1823, 'MAL', 1382967, 10017, '2023-09-01', '17:05:04', 'Z'),
(1824, 'MAL', 1382968, 20198, '2023-09-01', '17:05:09', 'Z'),
(1825, 'MAL', 1382969, 10144, '2023-09-01', '17:05:09', 'Z'),
(1826, 'MAL', 1382970, 20008, '2023-09-01', '17:05:34', 'Z'),
(1827, 'MAL', 1382971, 10120, '2023-09-01', '17:05:42', 'Z'),
(1828, 'MAL', 1382972, 10169, '2023-09-01', '17:05:44', 'Z'),
(1829, 'MAL', 1382973, 10124, '2023-09-01', '17:06:12', 'Z'),
(1830, 'MAL', 1382974, 10177, '2023-09-01', '17:06:22', 'Z'),
(1831, 'MAL', 1382975, 10100, '2023-09-01', '17:06:32', 'Z'),
(1832, 'MAL', 1382976, 20001, '2023-09-01', '17:06:37', 'Z'),
(1833, 'MAL', 1382977, 10073, '2023-09-01', '17:06:42', 'Z'),
(1834, 'MAL', 1382978, 10023, '2023-09-01', '17:06:54', 'Z'),
(1835, 'MAL', 1382979, 10015, '2023-09-01', '17:07:16', 'Z'),
(1836, 'MAL', 1382980, 10114, '2023-09-01', '17:07:40', 'Z'),
(1837, 'MAL', 1382981, 30006, '2023-09-01', '17:07:42', 'Z'),
(1838, 'MAL', 1382982, 20003, '2023-09-01', '17:07:47', 'Z'),
(1839, 'MAL', 1382983, 10178, '2023-09-01', '17:07:52', 'Z'),
(1840, 'MAL', 1382984, 20017, '2023-09-01', '17:08:02', 'Z'),
(1841, 'MAL', 1382985, 20076, '2023-09-01', '17:09:50', 'Z'),
(1842, 'MAL', 1382986, 10041, '2023-09-01', '17:10:01', 'Z'),
(1843, 'MAL', 1382987, 10009, '2023-09-01', '17:10:13', 'Z'),
(1844, 'MAL', 1382988, 10007, '2023-09-01', '17:12:41', 'Z'),
(1845, 'MAL', 1382989, 20091, '2023-09-01', '17:12:55', 'Z'),
(1846, 'MAL', 1382990, 20043, '2023-09-01', '17:13:48', 'Z'),
(1847, 'MAL', 1382991, 10095, '2023-09-01', '17:14:02', 'Z'),
(1848, 'MAL', 1382992, 10121, '2023-09-01', '17:14:20', 'Z'),
(1849, 'MAL', 1382993, 20038, '2023-09-01', '17:14:50', 'Z'),
(1850, 'MAL', 1382994, 20152, '2023-09-01', '17:16:01', 'Z'),
(1851, 'MAL', 1382995, 20076, '2023-09-01', '17:16:09', 'Z'),
(1852, 'MAL', 1382996, 20134, '2023-09-01', '17:18:35', 'Z'),
(1853, 'MAL', 1382997, 20118, '2023-09-01', '17:23:05', 'Z'),
(1854, 'MAL', 1382998, 20181, '2023-09-01', '17:23:22', 'Z'),
(1855, 'MAL', 1382999, 10114, '2023-09-01', '17:23:29', 'Z'),
(1856, 'MAL', 1383000, 10034, '2023-09-01', '17:24:43', 'Z'),
(1857, 'MAL', 1383001, 10143, '2023-09-01', '17:25:47', 'Z'),
(1858, 'MAL', 1383002, 20189, '2023-09-01', '17:31:24', 'Z'),
(1859, 'MAL', 1383003, 10030, '2023-09-01', '17:40:06', 'Z'),
(1860, 'MAL', 1383004, 20015, '2023-09-01', '17:44:30', 'Z'),
(1861, 'MAL', 1383005, 10172, '2023-09-01', '17:44:43', 'Z'),
(1862, 'MAL', 1383006, 20023, '2023-09-01', '17:47:33', 'Z'),
(1863, 'MAL', 1383007, 10094, '2023-09-01', '18:03:37', 'Z'),
(1864, 'MAL', 1383008, 10086, '2023-09-01', '18:30:04', 'Z'),
(1865, 'MAL', 1383009, 20006, '2023-09-01', '19:02:03', 'Z'),
(1866, 'MAL', 1383010, 20060, '2023-09-02', '07:37:06', 'A'),
(1867, 'MAL', 1383011, 20123, '2023-09-02', '08:05:33', 'A'),
(1868, 'MAL', 1383012, 20044, '2023-09-03', '07:29:56', 'A'),
(1869, 'MAL', 1383013, 20030, '2023-09-03', '07:46:55', 'A'),
(1870, 'MAL', 1383014, 10172, '2023-09-03', '07:57:47', 'A'),
(1871, 'MAL', -20230905, 20030, '2023-08-22', '06:28:00', 'A'),
(1872, 'MAL', -20230905, 20030, '2023-08-29', '06:20:00', 'A'),
(1873, 'MAL', -20230905, 20030, '2023-08-31', '06:26:00', 'A'),
(1874, 'MAL', -20230905, 20030, '2023-08-26', '17:00:00', 'Z'),
(1875, 'MAL', -20230905, 20030, '2023-08-30', '17:00:00', 'Z'),
(1876, 'MAL', -20230905, 20030, '2023-09-03', '17:01:00', 'Z'),
(1877, 'MAL', 1383015, 10172, '2023-09-03', '07:57:49', 'A'),
(1878, 'MAL', 1383016, 20030, '2023-09-03', '17:01:23', 'Z'),
(1879, 'MAL', 1383017, 20044, '2023-09-03', '17:02:06', 'Z'),
(1880, 'MAL', 1383018, 10172, '2023-09-03', '17:02:10', 'Z'),
(1881, 'MAL', 1383019, 20044, '2023-09-03', '17:02:34', 'Z'),
(1882, 'MAL', 1383020, 20036, '2023-09-04', '05:53:47', 'A'),
(1883, 'MAL', 1383021, 20060, '2023-09-04', '06:06:52', 'A'),
(1884, 'MAL', 1383022, 20030, '2023-09-04', '06:22:10', 'A'),
(1885, 'MAL', 1383023, 20097, '2023-09-04', '06:43:25', 'A'),
(1886, 'MAL', 1383024, 10114, '2023-09-04', '06:45:12', 'A'),
(1887, 'MAL', 1383025, 20119, '2023-09-04', '06:48:54', 'A'),
(1888, 'MAL', 1383026, 20181, '2023-09-04', '06:49:04', 'A'),
(1889, 'MAL', 1383027, 20050, '2023-09-04', '07:01:33', 'A'),
(1890, 'MAL', 1383028, 20104, '2023-09-04', '07:03:00', 'A'),
(1891, 'MAL', 1383029, 10178, '2023-09-04', '07:03:30', 'A'),
(1892, 'MAL', 1383030, 20059, '2023-09-04', '07:03:56', 'A'),
(1893, 'MAL', 1383031, 20051, '2023-09-04', '07:08:47', 'A'),
(1894, 'MAL', 1383032, 20038, '2023-09-04', '07:11:04', 'A'),
(1895, 'MAL', 1383033, 20134, '2023-09-04', '07:15:48', 'A'),
(1896, 'MAL', 1383034, 10023, '2023-09-04', '07:16:45', 'A'),
(1897, 'MAL', 1383035, 20121, '2023-09-04', '07:16:56', 'A'),
(1898, 'MAL', 1383036, 20165, '2023-09-04', '07:23:18', 'A'),
(1899, 'MAL', 1383037, 20012, '2023-09-04', '07:23:22', 'A'),
(1900, 'MAL', 1383038, 10017, '2023-09-04', '07:23:31', 'A'),
(1901, 'MAL', 1383039, 10147, '2023-09-04', '07:23:35', 'A'),
(1902, 'MAL', 1383040, 10023, '2023-09-04', '07:24:20', 'A'),
(1903, 'MAL', 1383041, 10110, '2023-09-04', '07:24:21', 'A'),
(1904, 'MAL', 1383042, 10073, '2023-09-04', '07:24:38', 'A'),
(1905, 'MAL', 1383043, 20035, '2023-09-04', '07:24:58', 'A'),
(1906, 'MAL', 1383044, 20205, '2023-09-04', '07:28:32', 'A'),
(1907, 'MAL', 1383045, 20002, '2023-09-04', '07:28:56', 'A'),
(1908, 'MAL', 1383046, 10157, '2023-09-04', '07:29:10', 'A'),
(1909, 'MAL', 1383047, 10007, '2023-09-04', '07:30:08', 'A'),
(1910, 'MAL', 1383048, 20008, '2023-09-04', '07:30:13', 'A'),
(1911, 'MAL', 1383049, 20053, '2023-09-04', '07:31:37', 'A'),
(1912, 'MAL', 1383050, 20074, '2023-09-04', '07:32:59', 'A'),
(1913, 'MAL', 1383051, 20032, '2023-09-04', '07:33:03', 'A'),
(1914, 'MAL', 1383052, 20087, '2023-09-04', '07:33:10', 'A'),
(1915, 'MAL', 1383053, 20133, '2023-09-04', '07:33:19', 'A'),
(1916, 'MAL', 1383054, 20191, '2023-09-04', '07:34:05', 'A'),
(1917, 'MAL', 1383055, 20123, '2023-09-04', '07:34:25', 'A'),
(1918, 'MAL', 1383056, 10027, '2023-09-04', '07:34:45', 'A'),
(1919, 'MAL', 1383057, 10015, '2023-09-04', '07:34:53', 'A'),
(1920, 'MAL', 1383058, 20029, '2023-09-04', '07:35:16', 'A'),
(1921, 'MAL', 1383059, 20001, '2023-09-04', '07:35:25', 'A'),
(1922, 'MAL', 1383060, 20017, '2023-09-04', '07:35:38', 'A'),
(1923, 'MAL', 1383061, 10012, '2023-09-04', '07:37:56', 'A'),
(1924, 'MAL', 1383062, 10167, '2023-09-04', '07:38:18', 'A'),
(1925, 'MAL', 1383063, 20131, '2023-09-04', '07:39:32', 'A'),
(1926, 'MAL', 1383064, 10163, '2023-09-04', '07:40:38', 'A'),
(1927, 'MAL', 1383065, 20043, '2023-09-04', '07:40:46', 'A'),
(1928, 'MAL', 1383066, 30006, '2023-09-04', '07:40:53', 'A'),
(1929, 'MAL', 1383067, 10035, '2023-09-04', '07:41:17', 'A'),
(1930, 'MAL', 1383068, 10139, '2023-09-04', '07:41:31', 'A'),
(1931, 'MAL', 1383069, 10176, '2023-09-04', '07:41:35', 'A'),
(1932, 'MAL', 1383070, 20044, '2023-09-04', '07:41:37', 'A'),
(1933, 'MAL', 1383071, 10075, '2023-09-04', '07:41:38', 'A'),
(1934, 'MAL', 1383072, 20137, '2023-09-04', '07:41:48', 'A'),
(1935, 'MAL', 1383073, 20044, '2023-09-04', '07:41:52', 'A'),
(1936, 'MAL', 1383074, 20084, '2023-09-04', '07:41:53', 'A'),
(1937, 'MAL', 1383075, 20192, '2023-09-04', '07:41:58', 'A'),
(1938, 'MAL', 1383076, 10089, '2023-09-04', '07:42:45', 'A'),
(1939, 'MAL', 1383077, 10038, '2023-09-04', '07:42:57', 'A'),
(1940, 'MAL', 1383078, 10135, '2023-09-04', '07:42:59', 'A'),
(1941, 'MAL', 1383079, 20063, '2023-09-04', '07:42:59', 'A'),
(1942, 'MAL', 1383080, 10135, '2023-09-04', '07:43:00', 'A'),
(1943, 'MAL', 1383081, 20186, '2023-09-04', '07:43:07', 'A'),
(1944, 'MAL', 1383082, 20128, '2023-09-04', '07:43:13', 'A'),
(1945, 'MAL', 1383083, 20204, '2023-09-04', '07:43:21', 'A'),
(1946, 'MAL', 1383084, 10171, '2023-09-04', '07:43:23', 'A'),
(1947, 'MAL', 1383085, 20186, '2023-09-04', '07:43:28', 'A'),
(1948, 'MAL', 1383086, 20078, '2023-09-04', '07:43:52', 'A'),
(1949, 'MAL', 1383087, 10026, '2023-09-04', '07:44:21', 'A'),
(1950, 'MAL', 1383088, 10006, '2023-09-04', '07:45:04', 'A'),
(1951, 'MAL', 1383089, 10013, '2023-09-04', '07:45:19', 'A'),
(1952, 'MAL', 1383090, 20056, '2023-09-04', '07:45:47', 'A'),
(1953, 'MAL', 1383091, 10173, '2023-09-04', '07:45:50', 'A'),
(1954, 'MAL', 1383092, 20071, '2023-09-04', '07:45:53', 'A'),
(1955, 'MAL', 1383093, 20151, '2023-09-04', '07:45:59', 'A'),
(1956, 'MAL', 1383094, 20007, '2023-09-04', '07:46:01', 'A'),
(1957, 'MAL', 1383095, 20151, '2023-09-04', '07:46:03', 'A'),
(1958, 'MAL', 1383096, 10154, '2023-09-04', '07:46:05', 'A'),
(1959, 'MAL', 1383097, 20064, '2023-09-04', '07:46:21', 'A'),
(1960, 'MAL', 1383098, 10168, '2023-09-04', '07:46:24', 'A'),
(1961, 'MAL', 1383099, 10170, '2023-09-04', '07:46:24', 'A'),
(1962, 'MAL', 1383100, 20190, '2023-09-04', '07:46:29', 'A'),
(1963, 'MAL', 1383101, 20160, '2023-09-04', '07:46:39', 'A'),
(1964, 'MAL', 1383102, 10164, '2023-09-04', '07:46:45', 'A'),
(1965, 'MAL', 1383103, 20018, '2023-09-04', '07:46:49', 'A'),
(1966, 'MAL', 1383104, 10115, '2023-09-04', '07:47:06', 'A'),
(1967, 'MAL', 1383105, 10021, '2023-09-04', '07:47:13', 'A'),
(1968, 'MAL', 1383106, 10177, '2023-09-04', '07:48:07', 'A'),
(1969, 'MAL', 1383107, 30008, '2023-09-04', '07:48:13', 'A'),
(1970, 'MAL', 1383108, 10034, '2023-09-04', '07:48:19', 'A'),
(1971, 'MAL', 1383109, 20076, '2023-09-04', '07:49:05', 'A'),
(1972, 'MAL', 1383110, 20182, '2023-09-04', '07:49:31', 'A'),
(1973, 'MAL', 1383111, 20003, '2023-09-04', '07:49:40', 'A'),
(1974, 'MAL', 1383112, 20100, '2023-09-04', '07:49:59', 'A'),
(1975, 'MAL', 1383113, 20136, '2023-09-04', '07:50:03', 'A'),
(1976, 'MAL', 1383114, 20124, '2023-09-04', '07:50:09', 'A'),
(1977, 'MAL', 1383115, 20016, '2023-09-04', '07:50:13', 'A'),
(1978, 'MAL', 1383116, 20152, '2023-09-04', '07:50:19', 'A'),
(1979, 'MAL', 1383117, 10113, '2023-09-04', '07:50:23', 'A'),
(1980, 'MAL', 1383118, 10030, '2023-09-04', '07:51:04', 'A'),
(1981, 'MAL', 1383119, 20189, '2023-09-04', '07:51:10', 'A'),
(1982, 'MAL', 1383120, 20198, '2023-09-04', '07:51:33', 'A'),
(1983, 'MAL', 1383121, 20069, '2023-09-04', '07:52:04', 'A'),
(1984, 'MAL', 1383122, 10041, '2023-09-04', '07:52:25', 'A'),
(1985, 'MAL', 1383123, 20118, '2023-09-04', '07:53:14', 'A'),
(1986, 'MAL', 1383124, 20023, '2023-09-04', '07:53:49', 'A'),
(1987, 'MAL', 1383125, 10143, '2023-09-04', '07:54:12', 'A'),
(1988, 'MAL', 1383126, 20106, '2023-09-04', '07:55:21', 'A'),
(1989, 'MAL', 1383127, 20091, '2023-09-04', '07:55:29', 'A'),
(1990, 'MAL', 1383128, 20062, '2023-09-04', '07:55:47', 'A'),
(1991, 'MAL', 1383129, 20139, '2023-09-04', '07:55:59', 'A'),
(1992, 'MAL', 1383130, 10093, '2023-09-04', '07:56:24', 'A'),
(1993, 'MAL', 1383131, 20175, '2023-09-04', '07:57:51', 'A'),
(1994, 'MAL', 1383132, 20112, '2023-09-04', '07:57:59', 'A'),
(1995, 'MAL', 1383133, 30003, '2023-09-04', '07:58:02', 'A'),
(1996, 'MAL', 1383134, 10174, '2023-09-04', '07:58:32', 'A'),
(1997, 'MAL', 1383135, 10175, '2023-09-04', '07:58:42', 'A'),
(1998, 'MAL', 1383136, 20082, '2023-09-04', '07:58:49', 'A'),
(1999, 'MAL', 1383137, 10120, '2023-09-04', '07:58:56', 'A'),
(2000, 'MAL', 1383138, 10172, '2023-09-04', '07:59:35', 'A'),
(2001, 'MAL', 1383139, 10160, '2023-09-04', '08:00:40', 'A'),
(2002, 'MAL', 1383140, 10179, '2023-09-04', '08:01:23', 'A'),
(2003, 'MAL', 1383141, 20168, '2023-09-04', '08:01:58', 'A'),
(2004, 'MAL', 1383142, 10169, '2023-09-04', '08:04:38', 'A'),
(2005, 'MAL', 1383143, 20159, '2023-09-04', '08:05:03', 'A'),
(2006, 'MAL', 1383144, 10121, '2023-09-04', '08:11:52', 'A'),
(2007, 'MAL', 1383145, 10148, '2023-09-04', '08:16:42', 'A'),
(2008, 'MAL', 1383146, 10103, '2023-09-04', '08:21:45', 'A'),
(2009, 'MAL', 1383147, 10095, '2023-09-04', '08:27:38', 'A'),
(2010, 'MAL', 1383148, 10094, '2023-09-04', '08:31:41', 'A'),
(2011, 'MAL', 1383149, 10086, '2023-09-04', '08:41:34', 'A'),
(2012, 'MAL', 1383150, 20006, '2023-09-04', '08:42:55', 'A'),
(2013, 'MAL', 1383151, 10034, '2023-09-04', '09:27:36', 'A'),
(2014, 'MAL', 1383152, 20160, '2023-09-04', '11:32:09', 'B'),
(2015, 'MAL', 1383153, 20008, '2023-09-04', '11:32:52', 'B'),
(2016, 'MAL', 1383154, 20008, '2023-09-04', '11:59:54', 'C'),
(2017, 'MAL', 1383155, 10113, '2023-09-04', '12:01:26', 'B'),
(2018, 'MAL', 1383156, 30003, '2023-09-04', '12:02:26', 'B'),
(2019, 'MAL', 1383157, 10179, '2023-09-04', '12:03:03', 'B'),
(2020, 'MAL', 1383158, 20160, '2023-09-04', '12:08:48', 'C'),
(2021, 'MAL', 1383159, 10113, '2023-09-04', '12:27:28', 'C'),
(2022, 'MAL', 1383160, 20131, '2023-09-04', '12:38:41', 'B'),
(2023, 'MAL', 1383161, 30003, '2023-09-04', '12:48:54', 'C'),
(2024, 'MAL', 1383162, 20131, '2023-09-04', '12:52:17', 'C'),
(2025, 'MAL', 1383163, 10179, '2023-09-04', '13:01:28', 'C'),
(2026, 'MAL', 1383164, 10146, '2023-09-04', '13:13:10', 'Z'),
(2027, 'MAL', 1383165, 20036, '2023-09-04', '16:02:58', 'Z'),
(2028, 'MAL', 1383166, 20119, '2023-09-04', '16:05:15', 'Z'),
(2029, 'MAL', 1383167, 10178, '2023-09-04', '16:38:58', 'Z'),
(2030, 'MAL', 1383168, 20053, '2023-09-04', '17:00:03', 'Z'),
(2031, 'MAL', 1383169, 20012, '2023-09-04', '17:00:25', 'Z'),
(2032, 'MAL', 1383170, 20016, '2023-09-04', '17:00:40', 'Z'),
(2033, 'MAL', 1383171, 10139, '2023-09-04', '17:00:45', 'Z'),
(2034, 'MAL', 1383172, 20043, '2023-09-04', '17:01:03', 'Z'),
(2035, 'MAL', 1383173, 20038, '2023-09-04', '17:01:08', 'Z'),
(2036, 'MAL', 1383174, 20091, '2023-09-04', '17:01:11', 'Z'),
(2037, 'MAL', 1383175, 20112, '2023-09-04', '17:01:12', 'Z'),
(2038, 'MAL', 1383176, 20151, '2023-09-04', '17:01:16', 'Z'),
(2039, 'MAL', 1383177, 20062, '2023-09-04', '17:01:16', 'Z'),
(2040, 'MAL', 1383178, 20151, '2023-09-04', '17:01:17', 'Z'),
(2041, 'MAL', 1383179, 20078, '2023-09-04', '17:01:21', 'Z'),
(2042, 'MAL', 1383180, 10013, '2023-09-04', '17:01:34', 'Z'),
(2043, 'MAL', 1383181, 10073, '2023-09-04', '17:01:35', 'C'),
(2044, 'MAL', 1383182, 10073, '2023-09-04', '17:01:37', 'Z'),
(2045, 'MAL', 1383183, 20050, '2023-09-04', '17:01:41', 'C'),
(2046, 'MAL', 1383184, 20137, '2023-09-04', '17:01:43', 'Z'),
(2047, 'MAL', 1383185, 20035, '2023-09-04', '17:01:44', 'Z'),
(2048, 'MAL', 1383186, 20137, '2023-09-04', '17:01:44', 'Z'),
(2049, 'MAL', 1383187, 20035, '2023-09-04', '17:01:45', 'Z'),
(2050, 'MAL', 1383188, 10163, '2023-09-04', '17:01:47', 'Z'),
(2051, 'MAL', 1383189, 20121, '2023-09-04', '17:01:47', 'Z'),
(2052, 'MAL', 1383190, 20056, '2023-09-04', '17:01:52', 'Z'),
(2053, 'MAL', 1383191, 20159, '2023-09-04', '17:01:53', 'C'),
(2054, 'MAL', 1383192, 10006, '2023-09-04', '17:02:05', 'Z'),
(2055, 'MAL', 1383193, 10021, '2023-09-04', '17:02:13', 'Z'),
(2056, 'MAL', 1383194, 20051, '2023-09-04', '17:02:16', 'Z'),
(2057, 'MAL', 1383195, 20017, '2023-09-04', '17:02:18', 'Z'),
(2058, 'MAL', 1383196, 10157, '2023-09-04', '17:02:20', 'Z'),
(2059, 'MAL', 1383197, 20002, '2023-09-04', '17:02:21', 'C'),
(2060, 'MAL', 1383198, 10147, '2023-09-04', '17:02:24', 'Z'),
(2061, 'MAL', 1383199, 10089, '2023-09-04', '17:02:29', 'Z'),
(2062, 'MAL', 1383200, 10113, '2023-09-04', '17:02:30', 'C'),
(2063, 'MAL', 1383201, 20059, '2023-09-04', '17:02:30', 'Z'),
(2064, 'MAL', 1383202, 10089, '2023-09-04', '17:02:30', 'Z'),
(2065, 'MAL', 1383203, 20087, '2023-09-04', '17:02:33', 'Z'),
(2066, 'MAL', 1383204, 10093, '2023-09-04', '17:02:35', 'Z'),
(2067, 'MAL', 1383205, 10175, '2023-09-04', '17:02:38', 'C'),
(2068, 'MAL', 1383206, 10174, '2023-09-04', '17:02:40', 'Z'),
(2069, 'MAL', 1383207, 20100, '2023-09-04', '17:02:43', 'C'),
(2070, 'MAL', 1383208, 10007, '2023-09-04', '17:02:47', 'Z'),
(2071, 'MAL', 1383209, 10154, '2023-09-04', '17:02:49', 'C'),
(2072, 'MAL', 1383210, 10164, '2023-09-04', '17:02:51', 'Z'),
(2073, 'MAL', 1383211, 20032, '2023-09-04', '17:02:52', 'Z'),
(2074, 'MAL', 1383212, 20168, '2023-09-04', '17:02:56', 'Z'),
(2075, 'MAL', 1383213, 20139, '2023-09-04', '17:02:56', 'Z'),
(2076, 'MAL', 1383214, 20069, '2023-09-04', '17:02:57', 'Z'),
(2077, 'MAL', 1383215, 10075, '2023-09-04', '17:02:58', 'C'),
(2078, 'MAL', 1383216, 20192, '2023-09-04', '17:02:59', 'Z'),
(2079, 'MAL', 1383217, 10154, '2023-09-04', '17:02:59', 'Z'),
(2080, 'MAL', 1383218, 10075, '2023-09-04', '17:02:59', 'C'),
(2081, 'MAL', 1383219, 20175, '2023-09-04', '17:03:03', 'Z'),
(2082, 'MAL', 1383220, 30003, '2023-09-04', '17:03:06', 'Z'),
(2083, 'MAL', 1383221, 10075, '2023-09-04', '17:03:07', 'Z'),
(2084, 'MAL', 1383222, 10176, '2023-09-04', '17:03:09', 'Z'),
(2085, 'MAL', 1383223, 10075, '2023-09-04', '17:03:09', 'Z'),
(2086, 'MAL', 1383224, 10168, '2023-09-04', '17:03:13', 'Z'),
(2087, 'MAL', 1383225, 20104, '2023-09-04', '17:03:13', 'Z'),
(2088, 'MAL', 1383226, 20160, '2023-09-04', '17:03:17', 'Z'),
(2089, 'MAL', 1383227, 20063, '2023-09-04', '17:03:20', 'Z'),
(2090, 'MAL', 1383228, 20106, '2023-09-04', '17:03:23', 'Z'),
(2091, 'MAL', 1383229, 20136, '2023-09-04', '17:03:28', 'Z'),
(2092, 'MAL', 1383230, 10120, '2023-09-04', '17:03:29', 'Z'),
(2093, 'MAL', 1383231, 10026, '2023-09-04', '17:03:32', 'Z'),
(2094, 'MAL', 1383232, 30006, '2023-09-04', '17:03:32', 'Z'),
(2095, 'MAL', 1383233, 10179, '2023-09-04', '17:03:36', 'Z'),
(2096, 'MAL', 1383234, 20186, '2023-09-04', '17:03:37', 'Z'),
(2097, 'MAL', 1383235, 20084, '2023-09-04', '17:03:38', 'Z'),
(2098, 'MAL', 1383236, 20186, '2023-09-04', '17:03:39', 'Z'),
(2099, 'MAL', 1383237, 30008, '2023-09-04', '17:03:41', 'Z'),
(2100, 'MAL', 1383238, 20071, '2023-09-04', '17:03:43', 'Z'),
(2101, 'MAL', 1383239, 20165, '2023-09-04', '17:03:47', 'Z'),
(2102, 'MAL', 1383240, 10170, '2023-09-04', '17:03:47', 'Z'),
(2103, 'MAL', 1383241, 20198, '2023-09-04', '17:03:50', 'Z'),
(2104, 'MAL', 1383242, 20128, '2023-09-04', '17:03:51', 'Z'),
(2105, 'MAL', 1383243, 20001, '2023-09-04', '17:03:56', 'Z'),
(2106, 'MAL', 1383244, 20190, '2023-09-04', '17:03:57', 'Z'),
(2107, 'MAL', 1383245, 20064, '2023-09-04', '17:03:59', 'Z'),
(2108, 'MAL', 1383246, 20191, '2023-09-04', '17:04:00', 'Z'),
(2109, 'MAL', 1383247, 10017, '2023-09-04', '17:04:00', 'Z'),
(2110, 'MAL', 1383248, 20064, '2023-09-04', '17:04:00', 'Z'),
(2111, 'MAL', 1383249, 10160, '2023-09-04', '17:04:03', 'Z'),
(2112, 'MAL', 1383250, 10171, '2023-09-04', '17:04:05', 'Z'),
(2113, 'MAL', 1383251, 10038, '2023-09-04', '17:04:07', 'Z'),
(2114, 'MAL', 1383252, 10177, '2023-09-04', '17:04:11', 'Z'),
(2115, 'MAL', 1383253, 10023, '2023-09-04', '17:04:16', 'Z'),
(2116, 'MAL', 1383254, 20131, '2023-09-04', '17:04:18', 'Z'),
(2117, 'MAL', 1383255, 20082, '2023-09-04', '17:04:22', 'Z'),
(2118, 'MAL', 1383256, 20007, '2023-09-04', '17:04:25', 'Z'),
(2119, 'MAL', 1383257, 10169, '2023-09-04', '17:04:27', 'Z'),
(2120, 'MAL', 1383258, 20133, '2023-09-04', '17:04:28', 'Z'),
(2121, 'MAL', 1383259, 10027, '2023-09-04', '17:04:33', 'Z'),
(2122, 'MAL', 1383260, 10041, '2023-09-04', '17:04:34', 'Z'),
(2123, 'MAL', 1383261, 10103, '2023-09-04', '17:04:39', 'Z'),
(2124, 'MAL', 1383262, 10173, '2023-09-04', '17:04:52', 'Z'),
(2125, 'MAL', 1383263, 20029, '2023-09-04', '17:05:07', 'Z'),
(2126, 'MAL', 1383264, 10121, '2023-09-04', '17:05:33', 'Z'),
(2127, 'MAL', 1383265, 20008, '2023-09-04', '17:05:57', 'Z'),
(2128, 'MAL', 1383266, 10035, '2023-09-04', '17:06:04', 'Z'),
(2129, 'MAL', 1383267, 10012, '2023-09-04', '17:06:07', 'Z'),
(2130, 'MAL', 1383268, 10135, '2023-09-04', '17:06:22', 'Z'),
(2131, 'MAL', 1383269, 20018, '2023-09-04', '17:06:30', 'Z'),
(2132, 'MAL', 1383270, 20189, '2023-09-04', '17:06:43', 'Z'),
(2133, 'MAL', 1383271, 20118, '2023-09-04', '17:06:47', 'Z'),
(2134, 'MAL', 1383272, 20003, '2023-09-04', '17:07:04', 'Z'),
(2135, 'MAL', 1383273, 20124, '2023-09-04', '17:07:31', 'Z'),
(2136, 'MAL', 1383274, 20134, '2023-09-04', '17:07:46', 'Z'),
(2137, 'MAL', 1383275, 10015, '2023-09-04', '17:08:31', 'Z'),
(2138, 'MAL', 1383276, 20074, '2023-09-04', '17:09:03', 'Z'),
(2139, 'MAL', 1383277, 10034, '2023-09-04', '17:10:02', 'Z'),
(2140, 'MAL', 1383278, 20204, '2023-09-04', '17:10:13', 'Z'),
(2141, 'MAL', 1383279, 20182, '2023-09-04', '17:10:19', 'Z'),
(2142, 'MAL', 1383280, 20205, '2023-09-04', '17:11:03', 'Z'),
(2143, 'MAL', 1383281, 20076, '2023-09-04', '17:11:18', 'Z'),
(2144, 'MAL', 1383282, 10110, '2023-09-04', '17:11:35', 'Z'),
(2145, 'MAL', 1383283, 10172, '2023-09-04', '17:11:37', 'Z'),
(2146, 'MAL', 1383284, 10167, '2023-09-04', '17:12:28', 'Z'),
(2147, 'MAL', 1383285, 10143, '2023-09-04', '17:18:19', 'Z'),
(2148, 'MAL', 1383286, 10030, '2023-09-04', '17:18:50', 'Z'),
(2149, 'MAL', 1383287, 10124, '2023-09-04', '17:21:15', 'Z'),
(2150, 'MAL', 1383288, 10148, '2023-09-04', '17:23:27', 'Z'),
(2151, 'MAL', 1383289, 20023, '2023-09-04', '17:25:20', 'Z'),
(2152, 'MAL', 1383290, 10095, '2023-09-04', '17:28:14', 'Z'),
(2153, 'MAL', 1383291, 10094, '2023-09-04', '17:39:36', 'Z'),
(2154, 'MAL', 1383292, 20181, '2023-09-04', '17:40:49', 'Z'),
(2155, 'MAL', 1383293, 10114, '2023-09-04', '17:42:10', 'Z'),
(2156, 'MAL', 1383294, 10086, '2023-09-04', '18:07:47', 'Z'),
(2157, 'MAL', 1383295, 20006, '2023-09-04', '18:58:27', 'Z'),
(2158, 'MAL', 1383296, 20036, '2023-09-05', '05:56:42', 'A'),
(2159, 'MAL', 1383297, 20030, '2023-09-05', '06:16:36', 'A'),
(2160, 'MAL', 1383298, 20115, '2023-09-05', '06:47:26', 'A'),
(2161, 'MAL', 1383299, 20119, '2023-09-05', '06:49:48', 'A'),
(2162, 'MAL', 1383300, 10178, '2023-09-05', '06:52:58', 'A'),
(2163, 'MAL', 1383301, 10144, '2023-09-05', '07:02:01', 'A'),
(2164, 'MAL', 1383302, 20035, '2023-09-05', '07:06:10', 'A'),
(2165, 'MAL', 1383303, 10114, '2023-09-05', '07:11:28', 'A'),
(2166, 'MAL', 1383304, 20121, '2023-09-05', '07:11:46', 'A'),
(2167, 'MAL', 1383305, 20181, '2023-09-05', '07:15:31', 'A'),
(2168, 'MAL', 1383306, 20038, '2023-09-05', '07:16:25', 'A'),
(2169, 'MAL', 1383307, 20051, '2023-09-05', '07:16:45', 'A'),
(2170, 'MAL', 1383308, 20054, '2023-09-05', '07:17:00', 'A'),
(2171, 'MAL', 1383309, 20050, '2023-09-05', '07:17:42', 'A'),
(2172, 'MAL', 1383310, 10017, '2023-09-05', '07:21:32', 'A'),
(2173, 'MAL', 1383311, 20165, '2023-09-05', '07:21:33', 'A'),
(2174, 'MAL', 1383312, 10147, '2023-09-05', '07:21:39', 'A'),
(2175, 'MAL', 1383313, 20012, '2023-09-05', '07:21:46', 'A'),
(2176, 'MAL', 1383314, 10073, '2023-09-05', '07:21:51', 'A'),
(2177, 'MAL', 1383315, 20060, '2023-09-05', '07:22:05', 'A'),
(2178, 'MAL', 1383316, 20059, '2023-09-05', '07:24:50', 'A'),
(2179, 'MAL', 1383317, 20023, '2023-09-05', '07:25:35', 'A'),
(2180, 'MAL', 1383318, 10007, '2023-09-05', '07:28:30', 'A'),
(2181, 'MAL', 1383319, 20002, '2023-09-05', '07:28:36', 'A'),
(2182, 'MAL', 1383320, 20205, '2023-09-05', '07:28:46', 'A'),
(2183, 'MAL', 1383321, 20008, '2023-09-05', '07:28:47', 'A'),
(2184, 'MAL', 1383322, 10015, '2023-09-05', '07:32:56', 'A'),
(2185, 'MAL', 1383323, 20029, '2023-09-05', '07:33:01', 'A'),
(2186, 'MAL', 1383324, 20001, '2023-09-05', '07:33:07', 'A'),
(2187, 'MAL', 1383325, 10157, '2023-09-05', '07:33:10', 'A'),
(2188, 'MAL', 1383326, 10139, '2023-09-05', '07:33:16', 'A'),
(2189, 'MAL', 1383327, 10075, '2023-09-05', '07:33:21', 'A'),
(2190, 'MAL', 1383328, 10176, '2023-09-05', '07:33:25', 'A'),
(2191, 'MAL', 1383329, 10075, '2023-09-05', '07:33:26', 'A'),
(2192, 'MAL', 1383330, 20137, '2023-09-05', '07:33:30', 'A'),
(2193, 'MAL', 1383331, 20044, '2023-09-05', '07:33:44', 'A'),
(2194, 'MAL', 1383332, 20015, '2023-09-05', '07:33:59', 'A'),
(2195, 'MAL', 1383333, 10027, '2023-09-05', '07:34:59', 'A'),
(2196, 'MAL', 1383334, 20078, '2023-09-05', '07:36:16', 'A'),
(2197, 'MAL', 1383335, 10110, '2023-09-05', '07:36:33', 'A'),
(2198, 'MAL', 1383336, 20191, '2023-09-05', '07:36:38', 'A'),
(2199, 'MAL', 1383337, 20032, '2023-09-05', '07:36:42', 'A'),
(2200, 'MAL', 1383338, 20133, '2023-09-05', '07:36:50', 'A'),
(2201, 'MAL', 1383339, 20087, '2023-09-05', '07:36:55', 'A'),
(2202, 'MAL', 1383340, 20074, '2023-09-05', '07:36:58', 'A'),
(2203, 'MAL', 1383341, 20076, '2023-09-05', '07:36:59', 'A'),
(2204, 'MAL', 1383342, 10009, '2023-09-05', '07:37:03', 'A'),
(2205, 'MAL', 1383343, 20098, '2023-09-05', '07:37:09', 'A'),
(2206, 'MAL', 1383344, 20074, '2023-09-05', '07:37:13', 'A'),
(2207, 'MAL', 1383345, 20123, '2023-09-05', '07:37:18', 'A'),
(2208, 'MAL', 1383346, 10006, '2023-09-05', '07:38:53', 'A'),
(2209, 'MAL', 1383347, 10012, '2023-09-05', '07:42:30', 'A'),
(2210, 'MAL', 1383348, 20062, '2023-09-05', '07:42:57', 'A'),
(2211, 'MAL', 1383349, 10023, '2023-09-05', '07:43:17', 'A'),
(2212, 'MAL', 1383350, 20056, '2023-09-05', '07:43:28', 'A'),
(2213, 'MAL', 1383351, 20071, '2023-09-05', '07:43:29', 'A'),
(2214, 'MAL', 1383352, 20007, '2023-09-05', '07:43:42', 'A'),
(2215, 'MAL', 1383353, 20190, '2023-09-05', '07:43:53', 'A'),
(2216, 'MAL', 1383354, 20064, '2023-09-05', '07:44:07', 'A'),
(2217, 'MAL', 1383355, 10154, '2023-09-05', '07:44:13', 'A'),
(2218, 'MAL', 1383356, 10170, '2023-09-05', '07:44:23', 'A'),
(2219, 'MAL', 1383357, 20018, '2023-09-05', '07:44:26', 'A'),
(2220, 'MAL', 1383358, 10021, '2023-09-05', '07:44:30', 'A'),
(2221, 'MAL', 1383359, 20131, '2023-09-05', '07:44:32', 'A'),
(2222, 'MAL', 1383360, 10034, '2023-09-05', '07:44:33', 'A'),
(2223, 'MAL', 1383361, 10038, '2023-09-05', '07:44:39', 'A'),
(2224, 'MAL', 1383362, 20063, '2023-09-05', '07:44:43', 'A'),
(2225, 'MAL', 1383363, 10115, '2023-09-05', '07:44:47', 'A'),
(2226, 'MAL', 1383364, 10013, '2023-09-05', '07:44:51', 'A'),
(2227, 'MAL', 1383365, 20100, '2023-09-05', '07:45:40', 'A'),
(2228, 'MAL', 1383366, 20016, '2023-09-05', '07:45:41', 'A'),
(2229, 'MAL', 1383367, 20100, '2023-09-05', '07:45:41', 'A'),
(2230, 'MAL', 1383368, 10113, '2023-09-05', '07:45:47', 'A'),
(2231, 'MAL', 1383369, 20124, '2023-09-05', '07:45:53', 'A'),
(2232, 'MAL', 1383370, 20152, '2023-09-05', '07:45:56', 'A'),
(2233, 'MAL', 1383371, 20136, '2023-09-05', '07:45:58', 'A'),
(2234, 'MAL', 1383372, 10167, '2023-09-05', '07:46:05', 'A'),
(2235, 'MAL', 1383373, 20017, '2023-09-05', '07:46:14', 'A'),
(2236, 'MAL', 1383374, 10168, '2023-09-05', '07:46:33', 'A'),
(2237, 'MAL', 1383375, 20186, '2023-09-05', '07:47:45', 'A'),
(2238, 'MAL', 1383376, 20182, '2023-09-05', '07:47:51', 'A'),
(2239, 'MAL', 1383377, 10135, '2023-09-05', '07:47:53', 'A'),
(2240, 'MAL', 1383378, 20182, '2023-09-05', '07:47:55', 'A'),
(2241, 'MAL', 1383379, 10135, '2023-09-05', '07:47:55', 'A'),
(2242, 'MAL', 1383380, 10089, '2023-09-05', '07:48:00', 'A'),
(2243, 'MAL', 1383381, 20159, '2023-09-05', '07:48:07', 'A'),
(2244, 'MAL', 1383382, 20128, '2023-09-05', '07:48:16', 'A'),
(2245, 'MAL', 1383383, 20204, '2023-09-05', '07:48:22', 'A'),
(2246, 'MAL', 1383384, 10171, '2023-09-05', '07:48:25', 'A'),
(2247, 'MAL', 1383385, 20097, '2023-09-05', '07:48:29', 'A'),
(2248, 'MAL', 1383386, 20168, '2023-09-05', '07:49:00', 'A'),
(2249, 'MAL', 1383387, 20192, '2023-09-05', '07:49:01', 'A'),
(2250, 'MAL', 1383388, 20084, '2023-09-05', '07:49:08', 'A'),
(2251, 'MAL', 1383389, 20189, '2023-09-05', '07:49:17', 'A'),
(2252, 'MAL', 1383390, 10026, '2023-09-05', '07:49:58', 'A'),
(2253, 'MAL', 1383391, 30006, '2023-09-05', '07:50:15', 'A'),
(2254, 'MAL', 1383392, 20043, '2023-09-05', '07:50:23', 'A'),
(2255, 'MAL', 1383393, 10160, '2023-09-05', '07:50:36', 'A'),
(2256, 'MAL', 1383394, 20134, '2023-09-05', '07:50:52', 'A'),
(2257, 'MAL', 1383395, 10163, '2023-09-05', '07:51:16', 'A'),
(2258, 'MAL', 1383396, 10177, '2023-09-05', '07:51:26', 'A'),
(2259, 'MAL', 1383397, 10173, '2023-09-05', '07:52:49', 'A'),
(2260, 'MAL', 1383398, 20069, '2023-09-05', '07:52:53', 'A'),
(2261, 'MAL', 1383399, 20151, '2023-09-05', '07:54:44', 'A'),
(2262, 'MAL', 1383400, 20198, '2023-09-05', '07:55:18', 'A'),
(2263, 'MAL', 1383401, 20082, '2023-09-05', '07:56:11', 'A'),
(2264, 'MAL', 1383402, 10041, '2023-09-05', '07:56:26', 'A'),
(2265, 'MAL', 1383403, 30003, '2023-09-05', '07:56:31', 'A'),
(2266, 'MAL', 1383404, 10169, '2023-09-05', '07:56:52', 'A'),
(2267, 'MAL', 1383405, 10172, '2023-09-05', '07:57:32', 'A'),
(2268, 'MAL', 1383406, 20003, '2023-09-05', '07:57:50', 'A'),
(2269, 'MAL', 1383407, 10180, '2023-09-05', '07:57:58', 'A'),
(2270, 'MAL', 1383408, 10121, '2023-09-05', '07:58:22', 'A'),
(2271, 'MAL', 1383409, 20112, '2023-09-05', '07:58:49', 'A'),
(2272, 'MAL', 1383410, 10120, '2023-09-05', '07:59:44', 'A'),
(2273, 'MAL', 1383411, 10179, '2023-09-05', '08:00:57', 'A'),
(2274, 'MAL', 1383412, 20106, '2023-09-05', '08:01:19', 'A'),
(2275, 'MAL', 1383413, 20091, '2023-09-05', '08:01:27', 'A'),
(2276, 'MAL', 1383414, 10140, '2023-09-05', '08:01:47', 'A'),
(2277, 'MAL', 1383415, 20139, '2023-09-05', '08:01:48', 'A'),
(2278, 'MAL', 1383416, 10093, '2023-09-05', '08:02:04', 'A'),
(2279, 'MAL', 1383417, 10143, '2023-09-05', '08:03:32', 'A'),
(2280, 'MAL', 1383418, 30008, '2023-09-05', '08:04:27', 'A'),
(2281, 'MAL', 1383419, 20175, '2023-09-05', '08:07:36', 'A'),
(2282, 'MAL', 1383420, 10148, '2023-09-05', '08:10:38', 'A'),
(2283, 'MAL', 1383421, 10174, '2023-09-05', '08:12:11', 'A'),
(2284, 'MAL', 1383422, 10175, '2023-09-05', '08:12:16', 'A'),
(2285, 'MAL', 1383423, 10030, '2023-09-05', '08:22:16', 'A'),
(2286, 'MAL', 1383424, 10086, '2023-09-05', '08:45:32', 'A'),
(2287, 'MAL', 1383425, 20006, '2023-09-05', '08:54:32', 'A'),
(2288, 'MAL', 1383426, 10103, '2023-09-05', '09:06:13', 'A'),
(2289, 'MAL', 1383427, 10146, '2023-09-05', '09:09:47', 'A'),
(2290, 'MAL', 1383428, 10095, '2023-09-05', '10:36:31', 'A'),
(2291, 'MAL', 1383429, 20160, '2023-09-05', '11:39:53', 'A'),
(2292, 'MAL', 1383430, 10041, '2023-09-05', '12:00:42', 'B'),
(2293, 'MAL', 1383431, 10179, '2023-09-05', '12:02:11', 'B'),
(2294, 'MAL', 1383432, 10124, '2023-09-05', '12:02:27', 'A'),
(2295, 'MAL', 1383433, 20165, '2023-09-05', '12:05:17', 'B'),
(2296, 'MAL', 1383434, 10100, '2023-09-05', '12:17:50', 'B'),
(2297, 'MAL', 1383435, 10094, '2023-09-05', '12:36:13', 'A'),
(2298, 'MAL', 1383436, 20165, '2023-09-05', '12:43:21', 'A'),
(2299, 'MAL', 1383437, 20165, '2023-09-05', '12:43:34', 'C'),
(2300, 'MAL', 1383438, 10041, '2023-09-05', '12:54:05', 'C'),
(2301, 'MAL', 1383439, 20186, '2023-09-05', '12:54:29', 'Z'),
(2302, 'MAL', 1383440, 10179, '2023-09-05', '12:58:54', 'C'),
(2303, 'MAL', 1383441, 20136, '2023-09-05', '13:27:55', 'Z'),
(2304, 'MAL', 1383442, 20165, '2023-09-05', '15:03:55', 'Z'),
(2305, 'MAL', 1383443, 20136, '2023-09-05', '15:30:30', 'A'),
(2306, 'MAL', 1383444, 20119, '2023-09-05', '16:03:03', 'A'),
(2307, 'MAL', 1383445, 20119, '2023-09-05', '16:03:14', 'Z'),
(2308, 'MAL', 1383446, 20036, '2023-09-05', '16:03:25', 'Z'),
(2309, 'MAL', 1383447, 10178, '2023-09-05', '16:11:18', 'Z'),
(2310, 'MAL', 1383448, 20098, '2023-09-05', '17:00:32', 'Z'),
(2311, 'MAL', 1383449, 20001, '2023-09-05', '17:00:49', 'Z'),
(2312, 'MAL', 1383450, 10144, '2023-09-05', '17:00:52', 'Z'),
(2313, 'MAL', 1383451, 10175, '2023-09-05', '17:00:57', 'Z'),
(2314, 'MAL', 1383452, 10174, '2023-09-05', '17:01:02', 'Z'),
(2315, 'MAL', 1383453, 20112, '2023-09-05', '17:01:03', 'Z'),
(2316, 'MAL', 1383454, 20038, '2023-09-05', '17:01:08', 'Z'),
(2317, 'MAL', 1383455, 20121, '2023-09-05', '17:01:08', 'Z'),
(2318, 'MAL', 1383456, 20064, '2023-09-05', '17:01:12', 'Z'),
(2319, 'MAL', 1383457, 20035, '2023-09-05', '17:01:13', 'Z'),
(2320, 'MAL', 1383458, 20064, '2023-09-05', '17:01:13', 'Z'),
(2321, 'MAL', 1383459, 20035, '2023-09-05', '17:01:15', 'Z'),
(2322, 'MAL', 1383460, 20151, '2023-09-05', '17:01:17', 'Z'),
(2323, 'MAL', 1383461, 10023, '2023-09-05', '17:01:18', 'Z'),
(2324, 'MAL', 1383462, 20017, '2023-09-05', '17:01:20', 'Z'),
(2325, 'MAL', 1383463, 10140, '2023-09-05', '17:01:24', 'Z'),
(2326, 'MAL', 1383464, 20059, '2023-09-05', '17:01:26', 'Z'),
(2327, 'MAL', 1383465, 10013, '2023-09-05', '17:01:27', 'Z'),
(2328, 'MAL', 1383466, 20016, '2023-09-05', '17:01:30', 'Z'),
(2329, 'MAL', 1383467, 10103, '2023-09-05', '17:01:32', 'Z'),
(2330, 'MAL', 1383468, 10139, '2023-09-05', '17:01:33', 'Z'),
(2331, 'MAL', 1383469, 20115, '2023-09-05', '17:01:38', 'Z'),
(2332, 'MAL', 1383470, 30003, '2023-09-05', '17:01:39', 'Z'),
(2333, 'MAL', 1383471, 20003, '2023-09-05', '17:01:44', 'Z'),
(2334, 'MAL', 1383472, 10027, '2023-09-05', '17:01:44', 'Z'),
(2335, 'MAL', 1383473, 20062, '2023-09-05', '17:01:48', 'Z'),
(2336, 'MAL', 1383474, 10073, '2023-09-05', '17:01:50', 'Z'),
(2337, 'MAL', 1383475, 20062, '2023-09-05', '17:01:51', 'Z'),
(2338, 'MAL', 1383476, 20136, '2023-09-05', '17:01:54', 'Z'),
(2339, 'MAL', 1383477, 20078, '2023-09-05', '17:01:57', 'Z'),
(2340, 'MAL', 1383478, 20152, '2023-09-05', '17:02:00', 'Z'),
(2341, 'MAL', 1383479, 20137, '2023-09-05', '17:02:02', 'Z'),
(2342, 'MAL', 1383480, 10038, '2023-09-05', '17:02:05', 'Z'),
(2343, 'MAL', 1383481, 10006, '2023-09-05', '17:02:06', 'Z'),
(2344, 'MAL', 1383482, 10180, '2023-09-05', '17:02:10', 'Z'),
(2345, 'MAL', 1383483, 10168, '2023-09-05', '17:02:14', 'Z'),
(2346, 'MAL', 1383484, 20168, '2023-09-05', '17:02:16', 'Z'),
(2347, 'MAL', 1383485, 20204, '2023-09-05', '17:02:16', 'Z'),
(2348, 'MAL', 1383486, 10176, '2023-09-05', '17:02:19', 'Z'),
(2349, 'MAL', 1383487, 10163, '2023-09-05', '17:02:21', 'Z'),
(2350, 'MAL', 1383488, 10034, '2023-09-05', '17:02:24', 'Z'),
(2351, 'MAL', 1383489, 20032, '2023-09-05', '17:02:27', 'Z'),
(2352, 'MAL', 1383490, 20051, '2023-09-05', '17:02:27', 'Z'),
(2353, 'MAL', 1383491, 20069, '2023-09-05', '17:02:30', 'Z'),
(2354, 'MAL', 1383492, 20018, '2023-09-05', '17:02:32', 'Z'),
(2355, 'MAL', 1383493, 20182, '2023-09-05', '17:02:32', 'Z'),
(2356, 'MAL', 1383494, 20018, '2023-09-05', '17:02:33', 'Z'),
(2357, 'MAL', 1383495, 20182, '2023-09-05', '17:02:33', 'Z'),
(2358, 'MAL', 1383496, 20192, '2023-09-05', '17:02:33', 'Z'),
(2359, 'MAL', 1383497, 10113, '2023-09-05', '17:02:35', 'Z'),
(2360, 'MAL', 1383498, 10026, '2023-09-05', '17:02:38', 'Z'),
(2361, 'MAL', 1383499, 10089, '2023-09-05', '17:02:40', 'Z'),
(2362, 'MAL', 1383500, 20012, '2023-09-05', '17:02:41', 'Z'),
(2363, 'MAL', 1383501, 10089, '2023-09-05', '17:02:41', 'Z'),
(2364, 'MAL', 1383502, 20190, '2023-09-05', '17:02:41', 'Z'),
(2365, 'MAL', 1383503, 20084, '2023-09-05', '17:02:46', 'Z'),
(2366, 'MAL', 1383504, 20056, '2023-09-05', '17:02:46', 'Z'),
(2367, 'MAL', 1383505, 20071, '2023-09-05', '17:02:47', 'Z'),
(2368, 'MAL', 1383506, 10009, '2023-09-05', '17:02:49', 'Z'),
(2369, 'MAL', 1383507, 10075, '2023-09-05', '17:02:52', 'Z'),
(2370, 'MAL', 1383508, 20128, '2023-09-05', '17:02:54', 'Z'),
(2371, 'MAL', 1383509, 20087, '2023-09-05', '17:02:54', 'Z'),
(2372, 'MAL', 1383510, 20128, '2023-09-05', '17:02:55', 'Z'),
(2373, 'MAL', 1383511, 10157, '2023-09-05', '17:02:58', 'Z'),
(2374, 'MAL', 1383512, 20002, '2023-09-05', '17:02:59', 'Z'),
(2375, 'MAL', 1383513, 10146, '2023-09-05', '17:03:00', 'Z'),
(2376, 'MAL', 1383514, 20191, '2023-09-05', '17:03:01', 'Z'),
(2377, 'MAL', 1383515, 10171, '2023-09-05', '17:03:05', 'Z'),
(2378, 'MAL', 1383516, 10147, '2023-09-05', '17:03:05', 'Z'),
(2379, 'MAL', 1383517, 20100, '2023-09-05', '17:03:08', 'Z'),
(2380, 'MAL', 1383518, 10160, '2023-09-05', '17:03:08', 'Z'),
(2381, 'MAL', 1383519, 20100, '2023-09-05', '17:03:10', 'Z'),
(2382, 'MAL', 1383520, 10093, '2023-09-05', '17:03:10', 'Z'),
(2383, 'MAL', 1383521, 30008, '2023-09-05', '17:03:16', 'Z'),
(2384, 'MAL', 1383522, 10012, '2023-09-05', '17:03:20', 'Z'),
(2385, 'MAL', 1383523, 20198, '2023-09-05', '17:03:24', 'Z'),
(2386, 'MAL', 1383524, 20074, '2023-09-05', '17:03:24', 'Z'),
(2387, 'MAL', 1383525, 10100, '2023-09-05', '17:03:26', 'Z'),
(2388, 'MAL', 1383526, 20133, '2023-09-05', '17:03:29', 'Z'),
(2389, 'MAL', 1383527, 30006, '2023-09-05', '17:03:30', 'Z'),
(2390, 'MAL', 1383528, 10120, '2023-09-05', '17:03:34', 'Z'),
(2391, 'MAL', 1383529, 20160, '2023-09-05', '17:03:35', 'Z'),
(2392, 'MAL', 1383530, 20007, '2023-09-05', '17:03:36', 'Z'),
(2393, 'MAL', 1383531, 20050, '2023-09-05', '17:03:38', 'Z'),
(2394, 'MAL', 1383532, 20029, '2023-09-05', '17:03:41', 'Z'),
(2395, 'MAL', 1383533, 20043, '2023-09-05', '17:03:45', 'Z'),
(2396, 'MAL', 1383534, 20175, '2023-09-05', '17:03:47', 'Z'),
(2397, 'MAL', 1383535, 20106, '2023-09-05', '17:03:49', 'Z'),
(2398, 'MAL', 1383536, 20063, '2023-09-05', '17:03:52', 'Z'),
(2399, 'MAL', 1383537, 10154, '2023-09-05', '17:03:54', 'Z'),
(2400, 'MAL', 1383538, 10007, '2023-09-05', '17:03:57', 'Z'),
(2401, 'MAL', 1383539, 10170, '2023-09-05', '17:04:03', 'Z'),
(2402, 'MAL', 1383540, 10179, '2023-09-05', '17:04:03', 'Z'),
(2403, 'MAL', 1383541, 10121, '2023-09-05', '17:04:09', 'Z'),
(2404, 'MAL', 1383542, 10177, '2023-09-05', '17:04:14', 'Z'),
(2405, 'MAL', 1383543, 10169, '2023-09-05', '17:04:19', 'Z'),
(2406, 'MAL', 1383544, 20082, '2023-09-05', '17:04:31', 'Z'),
(2407, 'MAL', 1383545, 20131, '2023-09-05', '17:04:41', 'Z'),
(2408, 'MAL', 1383546, 10124, '2023-09-05', '17:04:49', 'Z'),
(2409, 'MAL', 1383547, 10017, '2023-09-05', '17:05:01', 'Z'),
(2410, 'MAL', 1383548, 20124, '2023-09-05', '17:05:08', 'Z'),
(2411, 'MAL', 1383549, 20205, '2023-09-05', '17:05:27', 'Z'),
(2412, 'MAL', 1383550, 20076, '2023-09-05', '17:05:41', 'Z'),
(2413, 'MAL', 1383551, 10110, '2023-09-05', '17:05:42', 'Z'),
(2414, 'MAL', 1383552, 20091, '2023-09-05', '17:05:53', 'Z'),
(2415, 'MAL', 1383553, 20023, '2023-09-05', '17:06:02', 'Z'),
(2416, 'MAL', 1383554, 10135, '2023-09-05', '17:06:04', 'Z'),
(2417, 'MAL', 1383555, 20023, '2023-09-05', '17:06:04', 'Z'),
(2418, 'MAL', 1383556, 10135, '2023-09-05', '17:06:06', 'Z'),
(2419, 'MAL', 1383557, 10167, '2023-09-05', '17:06:15', 'Z'),
(2420, 'MAL', 1383558, 10173, '2023-09-05', '17:06:17', 'Z'),
(2421, 'MAL', 1383559, 20159, '2023-09-05', '17:06:19', 'Z'),
(2422, 'MAL', 1383560, 20139, '2023-09-05', '17:06:26', 'Z'),
(2423, 'MAL', 1383561, 10095, '2023-09-05', '17:06:37', 'Z'),
(2424, 'MAL', 1383562, 20008, '2023-09-05', '17:06:45', 'Z'),
(2425, 'MAL', 1383563, 20134, '2023-09-05', '17:07:37', 'Z'),
(2426, 'MAL', 1383564, 10015, '2023-09-05', '17:08:33', 'Z'),
(2427, 'MAL', 1383565, 20054, '2023-09-05', '17:10:16', 'Z'),
(2428, 'MAL', 1383566, 10114, '2023-09-05', '17:10:40', 'Z'),
(2429, 'MAL', 1383567, 20181, '2023-09-05', '17:10:46', 'Z'),
(2430, 'MAL', 1383568, 20189, '2023-09-05', '17:11:02', 'Z'),
(2431, 'MAL', 1383569, 10030, '2023-09-05', '17:11:31', 'Z'),
(2432, 'MAL', 1383570, 10041, '2023-09-05', '17:11:35', 'Z'),
(2433, 'MAL', 1383571, 10172, '2023-09-05', '17:22:15', 'Z'),
(2434, 'MAL', 1383572, 20015, '2023-09-05', '17:22:30', 'Z'),
(2435, 'MAL', 1383573, 10143, '2023-09-05', '17:23:59', 'Z'),
(2436, 'MAL', 1383574, 10148, '2023-09-05', '17:37:05', 'Z'),
(2437, 'MAL', 1383575, 10094, '2023-09-05', '17:51:08', 'Z'),
(2438, 'MAL', 1383576, 10086, '2023-09-05', '18:02:52', 'Z'),
(2439, 'MAL', 1383577, 10021, '2023-09-05', '18:09:48', 'Z'),
(2440, 'MAL', 1383578, 20006, '2023-09-05', '18:44:01', 'Z'),
(2441, 'MAL', 1383579, 20036, '2023-09-06', '05:58:05', 'A'),
(2442, 'MAL', 1383580, 20030, '2023-09-06', '06:23:21', 'A'),
(2443, 'MAL', 1383581, 10023, '2023-09-06', '06:39:30', 'A'),
(2444, 'MAL', 1383582, 20119, '2023-09-06', '06:48:02', 'A'),
(2445, 'MAL', 1383583, 10178, '2023-09-06', '07:01:34', 'A'),
(2446, 'MAL', 1383584, 20059, '2023-09-06', '07:06:28', 'A'),
(2447, 'MAL', 1383585, 20007, '2023-09-06', '07:07:39', 'A'),
(2448, 'MAL', 1383586, 20051, '2023-09-06', '07:08:03', 'A'),
(2449, 'MAL', 1383587, 20115, '2023-09-06', '07:08:27', 'A'),
(2450, 'MAL', 1383588, 20104, '2023-09-06', '07:13:03', 'A'),
(2451, 'MAL', 1383589, 20038, '2023-09-06', '07:16:42', 'A'),
(2452, 'MAL', 1383590, 20134, '2023-09-06', '07:22:10', 'A'),
(2453, 'MAL', 1383591, 20035, '2023-09-06', '07:24:53', 'A'),
(2454, 'MAL', 1383592, 20054, '2023-09-06', '07:26:13', 'A'),
(2455, 'MAL', 1383593, 20050, '2023-09-06', '07:26:58', 'A'),
(2456, 'MAL', 1383594, 10157, '2023-09-06', '07:28:27', 'A'),
(2457, 'MAL', 1383595, 10073, '2023-09-06', '07:28:40', 'A'),
(2458, 'MAL', 1383596, 20082, '2023-09-06', '07:28:50', 'A'),
(2459, 'MAL', 1383597, 20121, '2023-09-06', '07:29:18', 'A'),
(2460, 'MAL', 1383598, 10114, '2023-09-06', '07:29:54', 'A'),
(2461, 'MAL', 1383599, 10007, '2023-09-06', '07:30:05', 'A'),
(2462, 'MAL', 1383600, 20002, '2023-09-06', '07:30:12', 'A'),
(2463, 'MAL', 1383601, 20205, '2023-09-06', '07:30:16', 'A'),
(2464, 'MAL', 1383602, 20008, '2023-09-06', '07:30:19', 'A'),
(2465, 'MAL', 1383603, 10100, '2023-09-06', '07:31:05', 'A'),
(2466, 'MAL', 1383604, 20165, '2023-09-06', '07:31:10', 'A'),
(2467, 'MAL', 1383605, 10147, '2023-09-06', '07:31:14', 'A'),
(2468, 'MAL', 1383606, 20012, '2023-09-06', '07:31:17', 'A'),
(2469, 'MAL', 1383607, 10017, '2023-09-06', '07:31:21', 'A'),
(2470, 'MAL', 1383608, 20060, '2023-09-06', '07:31:29', 'A'),
(2471, 'MAL', 1383609, 10173, '2023-09-06', '07:32:06', 'A'),
(2472, 'MAL', 1383610, 20181, '2023-09-06', '07:33:32', 'A'),
(2473, 'MAL', 1383611, 10006, '2023-09-06', '07:33:47', 'A'),
(2474, 'MAL', 1383612, 10143, '2023-09-06', '07:37:53', 'A'),
(2475, 'MAL', 1383613, 20015, '2023-09-06', '07:39:50', 'A'),
(2476, 'MAL', 1383614, 10038, '2023-09-06', '07:41:42', 'A'),
(2477, 'MAL', 1383615, 20151, '2023-09-06', '07:41:55', 'A'),
(2478, 'MAL', 1383616, 10089, '2023-09-06', '07:42:22', 'A'),
(2479, 'MAL', 1383617, 10013, '2023-09-06', '07:43:39', 'A'),
(2480, 'MAL', 1383618, 20139, '2023-09-06', '07:43:49', 'A'),
(2481, 'MAL', 1383619, 10167, '2023-09-06', '07:45:13', 'A'),
(2482, 'MAL', 1383620, 10110, '2023-09-06', '07:46:02', 'A'),
(2483, 'MAL', 1383621, 20189, '2023-09-06', '07:46:10', 'A'),
(2484, 'MAL', 1383622, 20128, '2023-09-06', '07:47:56', 'A'),
(2485, 'MAL', 1383623, 20159, '2023-09-06', '07:48:00', 'A'),
(2486, 'MAL', 1383624, 10135, '2023-09-06', '07:48:06', 'A'),
(2487, 'MAL', 1383625, 10171, '2023-09-06', '07:48:13', 'A'),
(2488, 'MAL', 1383626, 20204, '2023-09-06', '07:48:13', 'A'),
(2489, 'MAL', 1383627, 20182, '2023-09-06', '07:48:17', 'A'),
(2490, 'MAL', 1383628, 20097, '2023-09-06', '07:48:23', 'A'),
(2491, 'MAL', 1383629, 10075, '2023-09-06', '07:48:24', 'A'),
(2492, 'MAL', 1383630, 20097, '2023-09-06', '07:48:24', 'A'),
(2493, 'MAL', 1383631, 10075, '2023-09-06', '07:48:25', 'A'),
(2494, 'MAL', 1383632, 10139, '2023-09-06', '07:48:30', 'A'),
(2495, 'MAL', 1383633, 20044, '2023-09-06', '07:48:37', 'A'),
(2496, 'MAL', 1383634, 10144, '2023-09-06', '07:49:33', 'A'),
(2497, 'MAL', 1383635, 10015, '2023-09-06', '07:49:42', 'A'),
(2498, 'MAL', 1383636, 10177, '2023-09-06', '07:50:15', 'A'),
(2499, 'MAL', 1383637, 20001, '2023-09-06', '07:50:20', 'A'),
(2500, 'MAL', 1383638, 30006, '2023-09-06', '07:50:34', 'A'),
(2501, 'MAL', 1383639, 20043, '2023-09-06', '07:51:17', 'A'),
(2502, 'MAL', 1383640, 20131, '2023-09-06', '07:51:42', 'A'),
(2503, 'MAL', 1383641, 20016, '2023-09-06', '07:51:43', 'A'),
(2504, 'MAL', 1383642, 20062, '2023-09-06', '07:51:52', 'A'),
(2505, 'MAL', 1383643, 20029, '2023-09-06', '07:51:58', 'A'),
(2506, 'MAL', 1383644, 10034, '2023-09-06', '07:52:16', 'A'),
(2507, 'MAL', 1383645, 30003, '2023-09-06', '07:53:01', 'A'),
(2508, 'MAL', 1383646, 10041, '2023-09-06', '07:53:29', 'A'),
(2509, 'MAL', 1383647, 10160, '2023-09-06', '07:53:30', 'A'),
(2510, 'MAL', 1383648, 20023, '2023-09-06', '07:54:00', 'A'),
(2511, 'MAL', 1383649, 10175, '2023-09-06', '07:54:04', 'A');
INSERT INTO `tbl_attendance` (`id`, `c_locations`, `c_timecardid`, `c_idno`, `c_trandate`, `c_trantime`, `c_trantype`) VALUES
(2512, 'MAL', 1383650, 10174, '2023-09-06', '07:54:09', 'A'),
(2513, 'MAL', 1383651, 10012, '2023-09-06', '07:54:49', 'A'),
(2514, 'MAL', 1383652, 20078, '2023-09-06', '07:54:59', 'A'),
(2515, 'MAL', 1383653, 30008, '2023-09-06', '07:55:05', 'A'),
(2516, 'MAL', 1383654, 10012, '2023-09-06', '07:55:08', 'A'),
(2517, 'MAL', 1383655, 20017, '2023-09-06', '07:55:28', 'A'),
(2518, 'MAL', 1383656, 20098, '2023-09-06', '07:56:07', 'A'),
(2519, 'MAL', 1383657, 20191, '2023-09-06', '07:56:17', 'A'),
(2520, 'MAL', 1383658, 20003, '2023-09-06', '07:56:18', 'A'),
(2521, 'MAL', 1383659, 20124, '2023-09-06', '07:56:21', 'A'),
(2522, 'MAL', 1383660, 20100, '2023-09-06', '07:56:25', 'A'),
(2523, 'MAL', 1383661, 20136, '2023-09-06', '07:56:29', 'A'),
(2524, 'MAL', 1383662, 20100, '2023-09-06', '07:56:30', 'A'),
(2525, 'MAL', 1383663, 10113, '2023-09-06', '07:56:37', 'A'),
(2526, 'MAL', 1383664, 10027, '2023-09-06', '07:56:37', 'A'),
(2527, 'MAL', 1383665, 20152, '2023-09-06', '07:56:45', 'A'),
(2528, 'MAL', 1383666, 20063, '2023-09-06', '07:57:07', 'A'),
(2529, 'MAL', 1383667, 20106, '2023-09-06', '07:57:17', 'A'),
(2530, 'MAL', 1383668, 20091, '2023-09-06', '07:57:23', 'A'),
(2531, 'MAL', 1383669, 10160, '2023-09-06', '07:58:05', 'A'),
(2532, 'MAL', 1383670, 10168, '2023-09-06', '07:58:09', 'A'),
(2533, 'MAL', 1383671, 20069, '2023-09-06', '07:58:20', 'A'),
(2534, 'MAL', 1383672, 10179, '2023-09-06', '07:58:26', 'A'),
(2535, 'MAL', 1383673, 10169, '2023-09-06', '07:58:41', 'A'),
(2536, 'MAL', 1383674, 20112, '2023-09-06', '07:58:46', 'A'),
(2537, 'MAL', 1383675, 20084, '2023-09-06', '07:58:50', 'A'),
(2538, 'MAL', 1383676, 20168, '2023-09-06', '07:58:51', 'A'),
(2539, 'MAL', 1383677, 20192, '2023-09-06', '07:58:55', 'A'),
(2540, 'MAL', 1383678, 20056, '2023-09-06', '07:59:34', 'A'),
(2541, 'MAL', 1383679, 20071, '2023-09-06', '07:59:36', 'A'),
(2542, 'MAL', 1383680, 10170, '2023-09-06', '07:59:40', 'A'),
(2543, 'MAL', 1383681, 20160, '2023-09-06', '07:59:42', 'A'),
(2544, 'MAL', 1383682, 20190, '2023-09-06', '07:59:47', 'A'),
(2545, 'MAL', 1383683, 20018, '2023-09-06', '07:59:49', 'A'),
(2546, 'MAL', 1383684, 10154, '2023-09-06', '07:59:52', 'A'),
(2547, 'MAL', 1383685, 10021, '2023-09-06', '07:59:57', 'A'),
(2548, 'MAL', 1383686, 10140, '2023-09-06', '08:00:00', 'A'),
(2549, 'MAL', 1383687, 10172, '2023-09-06', '08:00:05', 'A'),
(2550, 'MAL', 1383688, 10026, '2023-09-06', '08:00:09', 'A'),
(2551, 'MAL', 1383689, 10115, '2023-09-06', '08:00:10', 'A'),
(2552, 'MAL', 1383690, 10172, '2023-09-06', '08:00:17', 'A'),
(2553, 'MAL', 1383691, 10093, '2023-09-06', '08:00:22', 'A'),
(2554, 'MAL', 1383692, 20076, '2023-09-06', '08:01:31', 'A'),
(2555, 'MAL', 1383693, 20032, '2023-09-06', '08:01:32', 'A'),
(2556, 'MAL', 1383694, 20123, '2023-09-06', '08:01:39', 'A'),
(2557, 'MAL', 1383695, 20175, '2023-09-06', '08:01:44', 'A'),
(2558, 'MAL', 1383696, 20074, '2023-09-06', '08:01:45', 'A'),
(2559, 'MAL', 1383697, 20133, '2023-09-06', '08:01:49', 'A'),
(2560, 'MAL', 1383698, 20087, '2023-09-06', '08:01:56', 'A'),
(2561, 'MAL', 1383699, 10120, '2023-09-06', '08:02:01', 'A'),
(2562, 'MAL', 1383700, 10009, '2023-09-06', '08:02:04', 'A'),
(2563, 'MAL', 1383701, 10163, '2023-09-06', '08:02:07', 'A'),
(2564, 'MAL', 1383702, 10180, '2023-09-06', '08:02:13', 'A'),
(2565, 'MAL', 1383703, 20133, '2023-09-06', '08:02:27', 'A'),
(2566, 'MAL', 1383704, 10030, '2023-09-06', '08:02:51', 'A'),
(2567, 'MAL', 1383705, 20118, '2023-09-06', '08:05:36', 'A'),
(2568, 'MAL', 1383706, 10121, '2023-09-06', '08:06:35', 'A'),
(2569, 'MAL', 1383707, 10124, '2023-09-06', '08:08:45', 'A'),
(2570, 'MAL', 1383708, 10148, '2023-09-06', '08:17:15', 'A'),
(2571, 'MAL', 1383709, 20137, '2023-09-06', '08:17:52', 'A'),
(2572, 'MAL', 1383710, 10164, '2023-09-06', '08:30:22', 'A'),
(2573, 'MAL', 1383711, 10095, '2023-09-06', '08:32:41', 'A'),
(2574, 'MAL', 1383712, 20006, '2023-09-06', '08:52:19', 'A'),
(2575, 'MAL', 1383713, 10086, '2023-09-06', '08:52:43', 'A'),
(2576, 'MAL', 1383714, 10094, '2023-09-06', '09:22:36', 'A'),
(2577, 'MAL', 1383715, 20139, '2023-09-06', '12:01:16', 'B'),
(2578, 'MAL', 1383716, 20159, '2023-09-06', '12:15:55', 'Z'),
(2579, 'MAL', 1383717, 20139, '2023-09-06', '12:30:01', 'C'),
(2580, 'MAL', 1383718, 20186, '2023-09-06', '12:38:02', 'C'),
(2581, 'MAL', 1383719, 20186, '2023-09-06', '12:38:12', 'A'),
(2582, 'MAL', -20230909, 101470, '2023-09-06', '07:00:00', 'A'),
(2583, 'MAL', -20230909, 101470, '2023-09-06', '07:30:00', 'A'),
(2584, 'MAL', -20230909, 101470, '2023-09-06', '08:00:00', 'A'),
(2585, 'MAL', -20230909, 101470, '2023-09-06', '08:30:00', 'A'),
(2586, 'MAL', -20230909, 101470, '2023-09-06', '09:00:00', 'C'),
(2587, 'MAL', -20230909, 101470, '2023-09-06', '13:00:00', 'Z'),
(2588, 'MAL', -20230909, 101470, '2023-09-06', '17:01:00', 'Z'),
(2589, 'MAL', -20230909, 101470, '2023-09-06', '07:02:00', 'A');

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
(135, 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(136, 151, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(137, 152, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_approval_csr`
--

INSERT INTO `t_approval_csr` (`ra_id`, `c_csr_no`, `c_lot_lid`, `c_csr_status`, `c_date_approved`, `c_duration`, `c_amount_paid`, `c_reservation_amt`, `c_date_reserved`, `c_reserved_duration`, `c_reserve_status`, `c_ca_status`, `cfo_status`) VALUES
(179, 151, 13700202, 1, '2023-08-18 11:33:50', '2023-08-19 11:33:50', 25000, 25000, '2023-08-18 12:00:05', '2023-09-17 12:00:05', 1, 1, 1),
(180, 150, 10300901, 1, '2023-08-18 11:42:39', '2023-08-20 11:42:39', 25000, 25000, '2023-08-18 12:01:06', '2023-09-17 12:01:06', 1, 3, 0),
(181, 152, 13001901, 1, '2023-08-18 11:44:48', '2023-08-20 11:44:48', 25000, 25000, '2023-08-18 13:12:14', '2023-09-17 13:12:14', 1, 2, 0);

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
(27, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '', '1994-12-25', 28, '', 'M', 'Single', 'Filipino', 'jaevoli18@gmail.com', '09561305511', 'admin'),
(28, 'DIAZ', 'FRANCIS', 'AGUILAR', '', 'BOCAUE, BULACAN', '3011', '', '1995-01-01', 28, '', 'M', 'Single', 'Filipino', 'francisdiaz22@gmail.com', '09123456789', 'admin'),
(29, 'TANTOCO', 'DONITA ROSE', '', '', 'MALOLOS BULACAN', '3000', '', '1995-02-02', 27, '', 'F', 'Single', 'Filipino', 'donitarose09@gmail.com', '0934512142434', 'admin'),
(30, 'SANCHEZ', 'LIEZL', '', '', 'PULILAN, BULACAN', '3010', '', '1988-01-31', 34, '', 'F', 'Married', 'Filipino', 'liezlsanchez@gmail.com', '012121313131', 'admin'),
(31, 'SESE', 'EDHEN', '', '', 'HAGONOY, BULACAN', '3144', '', '1996-05-01', 26, '', 'F', 'Single', 'Filipino', 'edhensee@gmail.com', '121345577', 'admin'),
(32, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', '', '1996-08-10', 26, '', 'M', 'Single', 'Filipino', 'kimsalibay@gmail.com', '1211455666', 'admin'),
(33, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', '', '1978-07-12', 44, '', 'F', 'Married', 'Filipino', 'cutiepiesol@yahoo.com', '012121313131', 'admin'),
(34, 'Gonzales', 'Felyne Angeli', 'Buhain', '', 'Tabang, Plaridel, Bulacan', '3018', '', '1995-12-09', 27, '', 'F', 'Single', 'Filipino', 'inggygonz@gmail.com', '09789184718', 'admin'),
(35, 'GONZALES', 'CELINE ANGELICA', '', '', 'TABANG, PLARIDEL, BULACAN', '3018', '', '1988-09-10', 34, '', 'F', 'Single', 'Filipino', 'celineangelicagonz@gmail.com', '09873167818', 'admin');

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

--
-- Dumping data for table `t_ca_requirement`
--

INSERT INTO `t_ca_requirement` (`id`, `c_csr_no`, `loan_amt`, `terms`, `gross_income`, `co_borrower`, `total`, `income_req`, `interest`, `terms_month`, `monthly`, `doc_req1`, `doc_req2`, `doc_req3`, `ver_doc1`, `ver_doc2`, `doc_req_remarks`, `ver_doc_remarks`) VALUES
(1, 152, 2211999.84, 20, 0, 0, 0, 0, 15, 240, 0, 0, 0, 0, 0, 0, '', '1212fewe'),
(2, 151, 851200, 20, 0, 0, 0, 0, 15, 240, 0, 0, 0, 0, 0, 0, '', '');

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
(150, '2327712588\n', 10300901, 1, '2023-08-18', 142, 2880, 0, 0, 'None', 0, 0, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 408960, 49075.2, 458035.2, 25000, 'Partial DownPayment', 'Monthly Amortization', 20, 66607.04, 12, 5550.59, '2023-08-18', '2023-08-18', 366428.16, 1, 15, 1.0125, 371008.51, '2023-08-18', '', '2023-08-18 10:06:04', '2023-08-18 13:44:09', 'admin', 0, 0, 1, 0, NULL),
(151, '2887022458\n', 13700202, 1, '2023-08-18', 100, 9500, 0, 0, 'None', 0, 0, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 950000, 114000, 1064000, 25000, 'Partial DownPayment', 'Monthly Amortization', 20, 187800, 12, 15650, '2023-08-18', '2023-08-18', 851200, 1, 15, 1.0125, 861840, '2023-08-18', '', '2023-08-18 10:11:42', '2023-08-18 13:44:39', 'admin', 1, 1, 0, 1, NULL),
(152, '4795823189\n', 13001901, 1, '2023-08-18', 81, 34135.8, 0, 0, 'None', 0, 0, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 2764999.8, 0, 2764999.8, 25000, 'Partial DownPayment', 'Monthly Amortization', 20, 527999.96, 12, 44000, '2023-08-18', '2023-08-18', 2211999.84, 1, 15, 1.0125, 2239649.84, '2023-08-18', '', '2023-08-18 10:17:38', '2023-08-18 13:43:45', 'admin', 1, 1, 0, 0, NULL);

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
(155, 150, 1, 'DELA CRUZ', 'JUDE', 'PANGILINAN', '', '0682 SANTOL BALAGTAS BULACAN', '3016', '0682 SANTOL BALAGTAS   ', '1994-12-25', 28, '   ', 'M', 'Single', 'Filipino', '', '', 'jaevoli18@gmail.com', '09561305511', '', 0),
(156, 150, 2, 'SALIBAY', 'SEBASTIEN', '', '', 'CALUMPIT, BULACAN', '3333', ' ', '1996-08-10', 26, ' ', 'M', 'Single', 'Filipino', '', '', 'kimsalibay@gmail.com', '1211455666', '', 0),
(158, 151, 1, 'Gonzales', 'Felyne Angeli', 'Buhain', '', 'Tabang, Plaridel, Bulacan', '3018', '  ', '1995-12-09', 27, '  ', 'F', 'Single', 'Filipino', '', '', 'inggygonz@gmail.com', '09789184718', '', 0),
(159, 151, 2, 'GONZALES', 'CELINE ANGELICA', '', '', 'TABANG, PLARIDEL, BULACAN', '3018', ' ', '1988-09-10', 34, ' ', 'F', 'Single', 'Filipino', '', '', 'celineangelicagonz@gmail.com', '09873167818', '', 0),
(161, 152, 1, 'MANANGUIT', 'MARIA MIRASOL', '', '', 'PULILAN, BULACAN', '3011', '  ', '1978-07-12', 44, '  ', 'F', 'Single', 'Filipino', '', '', 'cutiepiesol@yahoo.com', '012121313131', '', 0);

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
(139, 149, 108910, ' SM ', 'Alcantara , Mary Ann ', 4089.6, 1),
(142, 150, 108910, ' SM ', 'Alcantara , Mary Ann ', 4089.6, 1),
(144, 151, 112462, ' MA ', 'Agustin , Angie ', 9500, 1),
(146, 152, 111873, ' MA ', 'Alberto , Rica ', 27650, 1);

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
(10300901, NULL, 103, 9, 1, 142, 2880, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(13001901, NULL, 130, 19, 1, 81, 34135.8, '1213', 'Available', NULL, NULL, NULL, NULL, NULL),
(13700202, NULL, 137, 2, 2, 100, 9500, '', 'Sold', NULL, NULL, NULL, NULL, NULL),
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
(15200202, NULL, 152, 2, 2, 149, 6800, '', 'Available', NULL, NULL, NULL, NULL, NULL),
(169123123, NULL, 169, 123, 123, 123, 123, '123', 'Available', NULL, NULL, NULL, NULL, NULL),
(2147483647, NULL, 169, 4444, 4444, 4444, 4444, '4444', 'Available', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_model_house`
--

CREATE TABLE `t_model_house` (
  `c_code` int(11) NOT NULL,
  `c_model` text NOT NULL,
  `c_acronym` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_model_house`
--

INSERT INTO `t_model_house` (`c_code`, `c_model`, `c_acronym`) VALUES
(100, 'NATHALIA', 'NAT'),
(101, 'ANNIKA', 'ANK'),
(102, 'SASHA', 'SAS'),
(104, 'FENCE', 'FNC'),
(105, 'FREYA', 'FRY'),
(144, 'SAMPLE MODELS', 'SMS');

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
(174, 179, 151, 13700202, '214222', '2023-08-18 12:00:05', 25000),
(175, 180, 150, 10300901, '546644', '2023-08-18 12:01:06', 25000),
(176, 181, 152, 13001901, '312422', '2023-08-18 13:12:14', 25000);

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
  `department` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `password`, `avatar`, `last_login`, `type`, `user_type`, `department`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', 'admin2@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675232580_1675125780_310082230_527806389353530_3496035450341313581_n.jpg', NULL, 1, 'IT Admin', 'IT', '2021-01-20 14:02:37', '2023-09-01 14:56:23'),
(2, 'Pia', 'Madrid', 'coo_pia', 'admin3@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1693405560_cf4102f8b7e92f11f6c0a8be89a64f42.jpg', NULL, 2, 'CFO', 'MANCOMM', '2021-01-20 14:02:37', '2023-09-01 14:56:31'),
(3, 'Agent', 'x44', 'agentx44', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675754520_NZ6_5625.JPG', NULL, 5, 'Agent', 'Marketing', '2021-01-20 14:02:37', '2023-09-01 14:56:38'),
(4, 'Janine', 'Cruz', 'ca_janine', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', NULL, NULL, 4, 'CA', 'CA', '2021-01-20 14:02:37', '2023-09-01 14:56:41'),
(5, 'Vio', 'Borlongan', 'sm_vio', 'agent@gmail.com', '639561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1674780660_1674735360_Tiny+Avatar.png', NULL, 4, 'SOS', 'Marketing', '2021-01-20 14:02:37', '2023-09-01 14:56:55'),
(6, 'Eliza', 'Figueroa', 'cashier_eliza', 'eliza@gmail.com', '12345678910', '0192023a7bbd73250516f069df18b500', 'uploads/1675124340_1664026500_male1.jfif', NULL, 5, 'Cashier', 'Accounting', '2023-01-31 08:19:54', '2023-09-01 14:57:00'),
(7, 'LIEZL', 'SANCHEZ', 'liezlsa', 'liezl@gmail.com', '123455678', '0192023a7bbd73250516f069df18b500', 'uploads/1675125480_NZ6_5624.JPG', NULL, 5, 'Cashier', 'Accounting', '2023-01-31 08:38:49', '2023-09-01 14:57:04'),
(8, 'JUDE', 'DELA CRUZ', 'judedel', 'jaevoli18@gmail.com', '09561305511', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1675126620_310082230_527806389353530_3496035450341313581_n.jpg', NULL, 1, 'IT Admin', 'IT', '2023-01-31 08:43:22', '2023-09-01 14:57:08'),
(11, 'DONITA ROSE', 'TANTOCO', 'donits', 'donita@gmail.com', '09561305511', '0192023a7bbd73250516f069df18b500', 'uploads/1675126140_user_icon.png', NULL, 1, 'IT Admin', 'IT', '2023-01-31 08:49:33', '2023-09-01 14:57:11'),
(12, 'Rosalyn', 'San Pedro', 'BS_Lhen', 'rosalynsanpedro@gmail.com', '097898765112', '0192023a7bbd73250516f069df18b500', 'uploads/1687405680_4157705191_34525f6cb1_b.jpg', NULL, 4, 'Billing', 'Billing', '2023-06-22 11:48:51', '2023-09-01 14:57:18'),
(13, 'Giezl Ann', 'Guiao', 'fm_ghie', 'sample@gmail.com', '09878945632', '0192023a7bbd73250516f069df18b500', 'uploads/1687411320_ad992844046d9f4ce594624a7b0a01fb.jpg', NULL, 3, 'Manager', 'Finance', '2023-06-22 13:22:54', '2023-09-01 14:57:26'),
(14, 'Gianne', 'Gonzales', 'cfo_gian', 'gian_gonzales@gmail.com', '091213141414', '0192023a7bbd73250516f069df18b500', 'uploads/1689227700_331035310_750837646457661_1634213244119424426_n.jpg', NULL, 2, 'COO', 'MANCOMM', '2023-07-13 13:55:40', '2023-09-01 14:57:30'),
(15, 'Lhara', 'Mercado', 'po_lhara', 'sample@gmail.com', '09278982817', '0192023a7bbd73250516f069df18b500', 'uploads/1692943680_unnamed.jpg', NULL, 4, 'Purchasing Officer', 'Disbursement', '2023-08-25 14:08:47', '2023-09-10 10:59:31'),
(16, 'Lemuel', 'Santos', 'sm_lem', 'sm_lem@gmail.com', '0967988999823', '0192023a7bbd73250516f069df18b500', 'uploads/1693550880_guy-clipart-man-portrait-15.png', NULL, 4, 'Marketing Supervisor', 'Marketing', '2023-09-01 14:48:19', '2023-09-01 14:57:59');

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
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
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
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_restructuring`
--
ALTER TABLE `tbl_restructuring`
  ADD PRIMARY KEY (`res_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `message_tbl`
--
ALTER TABLE `message_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=616;

--
-- AUTO_INCREMENT for table `or_logs`
--
ALTER TABLE `or_logs`
  MODIFY `or_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pending_restructuring`
--
ALTER TABLE `pending_restructuring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `po_list`
--
ALTER TABLE `po_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1413001901104;

--
-- AUTO_INCREMENT for table `property_clients`
--
ALTER TABLE `property_clients`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2396081081526;

--
-- AUTO_INCREMENT for table `property_payments`
--
ALTER TABLE `property_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=764;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2590;

--
-- AUTO_INCREMENT for table `t_additional_cost`
--
ALTER TABLE `t_additional_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `t_agents`
--
ALTER TABLE `t_agents`
  MODIFY `c_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113001;

--
-- AUTO_INCREMENT for table `t_approval_csr`
--
ALTER TABLE `t_approval_csr`
  MODIFY `ra_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `t_av_breakdown`
--
ALTER TABLE `t_av_breakdown`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `t_av_summary`
--
ALTER TABLE `t_av_summary`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `t_buyer_info`
--
ALTER TABLE `t_buyer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `t_ca_requirement`
--
ALTER TABLE `t_ca_requirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_credit_memo`
--
ALTER TABLE `t_credit_memo`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174356;

--
-- AUTO_INCREMENT for table `t_csr`
--
ALTER TABLE `t_csr`
  MODIFY `c_csr_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `t_csr_buyers`
--
ALTER TABLE `t_csr_buyers`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `t_csr_comments`
--
ALTER TABLE `t_csr_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_csr_commission`
--
ALTER TABLE `t_csr_commission`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_lots`
--
ALTER TABLE `t_lots`
  MODIFY `c_lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
