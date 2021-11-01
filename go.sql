-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 08:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `go`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE `alert` (
  `alert_id` varchar(11) NOT NULL,
  `alert_name` varchar(50) NOT NULL,
  `description` varchar(120) NOT NULL,
  `date_ alert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `authorization`
--

CREATE TABLE `authorization` (
  `staff_ID` int(50) NOT NULL,
  `subject_ID` varchar(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `budget_limit`
--

CREATE TABLE `budget_limit` (
  `budget_no` varchar(11) NOT NULL,
  `staff_ID` int(50) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `description` varchar(120) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `catalog_ID` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `vendor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`id`, `catalog_ID`, `description`, `vendor_ID`) VALUES
(1, 'M001', 'Material', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_code` varchar(5) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_code`, `company_name`, `address`, `currency`, `language`) VALUES
('C101', 'Fast track', '123 asdhucy', 'RM', 'Chinese'),
('C102', 'Omesti', 'sadqbcwvcuy 13n21h43u2', 'RM', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(30) NOT NULL,
  `contract_ID` varchar(11) NOT NULL,
  `subcontractor_ID` varchar(11) NOT NULL,
  `vendor_ID` int(11) NOT NULL,
  `staff_ID` int(50) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `endDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `contract_ID`, `subcontractor_ID`, `vendor_ID`, `staff_ID`, `startDate`, `endDate`, `date_created`) VALUES
(4, 'C10001', '', 2, 0, '2021-10-26 16:17:11', '2022-02-27 16:17:11', '2021-10-27 00:17:46'),
(5, 'C10002', '', 0, 6, '2021-10-26 16:17:11', '2023-12-30 16:17:11', '2021-10-27 00:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` double(9,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT ' 1 = Active, 0 = Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `catalog_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `name`, `description`, `quantity`, `price`, `status`, `date_created`, `catalog_ID`) VALUES
(1, 'IC0001', 'Cotton', 'abc', 50, 50.00, 1, '2021-10-25 15:07:33', 1),
(2, 'IC0002', 'Fiber', 'efg', 100, 50.00, 1, '2021-10-25 15:07:33', 1),
(3, 'IC0003', 'Combed', 'hij', 50, 100.00, 0, '2021-10-25 15:07:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `materials_requisition`
--

CREATE TABLE `materials_requisition` (
  `mr_ID` varchar(11) NOT NULL,
  `staff_ID` int(50) NOT NULL,
  `description` varchar(120) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `materials_requisition_details`
--

CREATE TABLE `materials_requisition_details` (
  `mr_ID` varchar(11) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity_request` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(30) NOT NULL,
  `po_no` varchar(10) NOT NULL,
  `quotation_no` varchar(10) DEFAULT NULL,
  `vendor_ID` int(11) NOT NULL,
  `discount_percentage` float NOT NULL,
  `discount_amount` float NOT NULL,
  `tax_percentage` float NOT NULL,
  `tax_amount` float NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved, 2 = Rejected',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `po_no`, `quotation_no`, `vendor_ID`, `discount_percentage`, `discount_amount`, `tax_percentage`, `tax_amount`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(2, 'PO-2990089', NULL, 1, 20, 120, 5, 30, '', 2, '2021-10-25 20:34:01', '2021-10-26 00:05:18'),
(3, 'PO-6723152', NULL, 1, 0, 0, 0, 0, 'test edit', 0, '2021-10-25 20:34:19', '2021-10-26 00:05:26'),
(4, 'PO-0034819', NULL, 1, 1, 10, 1, 10, '', 0, '2021-10-25 22:29:28', '2021-10-26 22:03:36'),
(5, 'PO-1036966', NULL, 1, 0, 0, 0, 0, '', 1, '2021-10-26 22:04:12', '2021-10-26 22:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `po_id` int(11) NOT NULL,
  `item_id` int(30) NOT NULL,
  `unit_price` double(9,2) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`po_id`, `item_id`, `unit_price`, `quantity`) VALUES
(3, 2, 100.00, 20),
(2, 1, 30.00, 20),
(4, 1, 50.00, 20),
(5, 3, 50.00, 50);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition`
--

CREATE TABLE `purchase_requisition` (
  `pr_ID` varchar(11) NOT NULL,
  `staff_ID` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_requisition`
--

INSERT INTO `purchase_requisition` (`pr_ID`, `staff_ID`, `status`, `date_created`) VALUES
('PR001', 1, '0', '2021-10-24 07:34:41'),
('PR002', 5, '1', '2021-10-24 07:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisiton_details`
--

CREATE TABLE `purchase_requisiton_details` (
  `pr_ID` varchar(11) NOT NULL,
  `item_id` varchar(11) NOT NULL,
  `quantity_request` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_requisiton_details`
--

INSERT INTO `purchase_requisiton_details` (`pr_ID`, `item_id`, `quantity_request`) VALUES
('PR002', 'IC0001', 600),
('PR002', 'IC0002', 200),
('PR001', 'IC0001', 50);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(30) NOT NULL,
  `q_ID` varchar(11) NOT NULL,
  `pr_ID` varchar(11) NOT NULL,
  `vendor_ID` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `vendor_address` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1= Approved, 2 = Denied',
  `remarks` text NOT NULL,
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `q_ID`, `pr_ID`, `vendor_ID`, `deadline`, `delivery_date`, `vendor_address`, `date_created`, `status`, `remarks`, `date_updated`) VALUES
(13, '20RFQ-94856', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2021-10-27 00:12:23', 0, 'too many', '2021-10-27 02:13:51'),
(14, '20RFQ-66158', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2021-10-27 02:06:13', 1, 'Faster delivery', '2021-10-27 02:09:40'),
(15, '20RFQ629836', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2021-10-27 02:09:57', 2, '', '2021-10-27 02:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_ID` varchar(11) NOT NULL,
  `performance_ID` varchar(11) NOT NULL,
  `vendor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rating measurement`
--

CREATE TABLE `rating measurement` (
  `performance_ID` varchar(11) NOT NULL,
  `point` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rfq`
--

CREATE TABLE `rfq` (
  `rfq_no` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `unit_price` double(9,2) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfq`
--

INSERT INTO `rfq` (`rfq_no`, `item_id`, `unit_price`, `quantity`) VALUES
(15, 2, 500.00, 200),
(14, 3, 100.00, 20),
(14, 2, 200.00, 30),
(13, 3, 10000.00, 50);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Administrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2021-10-24 03:06:57'),
(3, 'Mike ', 'Williams', 'mwilliams', 'a88df23ac492e6e2782df6586a0c645f', 'uploads/1630999200_avatar5.png', NULL, 2, '2021-09-07 15:20:40', NULL),
(5, 'J.Yun', 'Tay', 'jiayun', '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/1635016800_corgi.jpg', NULL, 2, '2021-10-24 03:19:37', '2021-10-24 03:23:49'),
(6, 'Yap', 'Ming Nee', 'minnie', '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/1635140340_IMG-20181116-WA0079.jpg', NULL, 2, '2021-10-24 21:35:05', '2021-10-25 13:39:34'),
(8, 'sue faye', 'kok', 'faye', '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/1635172680_1635147420_profile.jpg', NULL, 2, '2021-10-25 22:38:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcontractor`
--

CREATE TABLE `subcontractor` (
  `subcontractor_ID` varchar(11) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `registration_status` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_ID` varchar(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `description` varchar(120) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'name', 'Online Purchasing System'),
(6, 'short_name', 'GO Uniform - OPS'),
(11, 'logo', 'uploads/1635230280_1635149340_Logo2.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1635082020_background.png'),
(15, 'company_name', 'GO Uniform Trading Sdn Bhd'),
(16, 'company_email', 'sales@gouniform.com.my'),
(17, 'company_address', '41, Jalan Perai Jaya 5, Bandar Perai Jaya, 13700 Perai, Pulau Pinang.');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `registration_status` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `product` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_ID`, `name`, `company_code`, `registration_status`, `email`, `product`, `description`) VALUES
(1, 'Minnie', 'C101', '1', 'haha@gmail.com', 'cocurikulum uniform', 'good'),
(2, 'kok', 'C102', '1', 'jjj', 'Career Uniform', 'buy in bulk'),
(5, 'kkk', 'kkk', '0', 'koksf-wm18@student.tarc.edu.my', 'kkk', 'kkk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `authorization`
--
ALTER TABLE `authorization`
  ADD KEY `authorization_ibfk_1` (`staff_ID`),
  ADD KEY `authorization_ibfk_2` (`subject_ID`);

--
-- Indexes for table `budget_limit`
--
ALTER TABLE `budget_limit`
  ADD PRIMARY KEY (`budget_no`),
  ADD KEY `budget_limit_ibfk_1` (`staff_ID`);

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_ibfk_1` (`vendor_ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_code`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_ibfk_1` (`catalog_ID`);

--
-- Indexes for table `materials_requisition`
--
ALTER TABLE `materials_requisition`
  ADD PRIMARY KEY (`mr_ID`),
  ADD KEY `mr_ibfk_1` (`staff_ID`);

--
-- Indexes for table `materials_requisition_details`
--
ALTER TABLE `materials_requisition_details`
  ADD KEY `mrd_ibfk_1` (`mr_ID`),
  ADD KEY `mrd_ibfk_2` (`item_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_ibfk_2` (`vendor_ID`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD KEY `purchase_order_details_ibfk_1` (`po_id`) USING BTREE,
  ADD KEY `purchase_order_details_ibfk_2` (`item_id`);

--
-- Indexes for table `purchase_requisition`
--
ALTER TABLE `purchase_requisition`
  ADD PRIMARY KEY (`pr_ID`),
  ADD KEY `pr_ibfk_1` (`staff_ID`);

--
-- Indexes for table `purchase_requisiton_details`
--
ALTER TABLE `purchase_requisiton_details`
  ADD KEY `prd_ibfk_1` (`pr_ID`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfq_ID` (`q_ID`),
  ADD KEY `quotation_ibfk_2` (`vendor_ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_ID`),
  ADD KEY `rating_ibfk_1` (`performance_ID`),
  ADD KEY `rating_ibfk_2` (`vendor_ID`);

--
-- Indexes for table `rating measurement`
--
ALTER TABLE `rating measurement`
  ADD PRIMARY KEY (`performance_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcontractor`
--
ALTER TABLE `subcontractor`
  ADD PRIMARY KEY (`subcontractor_ID`),
  ADD KEY `subcontractor_ibfk_1` (`company_code`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_ID`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_ID`),
  ADD UNIQUE KEY `company_code` (`company_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorization`
--
ALTER TABLE `authorization`
  ADD CONSTRAINT `authorization_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `authorization_ibfk_2` FOREIGN KEY (`subject_ID`) REFERENCES `subject` (`subject_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `budget_limit`
--
ALTER TABLE `budget_limit`
  ADD CONSTRAINT `budget_limit_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `i_ibfk_1` FOREIGN KEY (`catalog_ID`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `materials_requisition`
--
ALTER TABLE `materials_requisition`
  ADD CONSTRAINT `mr_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `materials_requisition_details`
--
ALTER TABLE `materials_requisition_details`
  ADD CONSTRAINT `mrd_ibfk_1` FOREIGN KEY (`mr_ID`) REFERENCES `materials_requisition` (`mr_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `mrd_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD CONSTRAINT `purchase_order_details_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase_order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_requisition`
--
ALTER TABLE `purchase_requisition`
  ADD CONSTRAINT `pr_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`id`);

--
-- Constraints for table `purchase_requisiton_details`
--
ALTER TABLE `purchase_requisiton_details`
  ADD CONSTRAINT `prd_ibfk_1` FOREIGN KEY (`pr_ID`) REFERENCES `purchase_requisition` (`pr_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_2` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`performance_ID`) REFERENCES `rating measurement` (`performance_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`vendor_ID`) REFERENCES `vendor` (`vendor_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subcontractor`
--
ALTER TABLE `subcontractor`
  ADD CONSTRAINT `subcontractor_ibfk_1` FOREIGN KEY (`company_code`) REFERENCES `company` (`company_code`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
