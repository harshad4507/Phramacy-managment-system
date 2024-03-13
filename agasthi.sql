-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 09:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agasthi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Harshad', 'Harshaddange347@gmail.com', '206007', '206007'),
(21, 'AKASH GURAV', 'guravakash10@gmail.com', 'APG', 'APG@9559');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ctype` varchar(10) NOT NULL DEFAULT 'Wholesale'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `name`, `email`, `mobileno`, `password`, `address`, `ctype`) VALUES
(5, 'WalkIn', '', '1245354756', '123456', 'Dange gali juna budhawar peth 2519  d ward ,,', 'Retail'),
(7, 'Harshad', 'Harshaddange347@gmail.com', '1245354748', '123456', 'Dange gali juna budhawar peth 2519  d ward', 'Wholesale'),
(8, 'Akash', 'Akasha@gmail.com', '7249817156', 'Akash@', 'Dange gali juna budhawar peth 2519  d ward ,,', ''),
(16, 'Tushar Bhosale', 'Tusharbhosale@gmail.com', '9359372565', 'TusharBhosale@9359', 'Dange gali juna budhawar peth 2519  d ward', 'Retail'),
(17, 'Amey', 'Amey@gmail.com', '9422041947', 'AMEY@9422', 'Dange gali juna budhawar peth 2519  d ward', 'Retail'),
(18, 'Harshad', 'HarshadDange3@gmail.com', '7895675322', 'Harshad245', 'dkjsdkjfhbkjlskjfg', 'Retail'),
(19, 'Prasad', 'prasad10@gmail.com', '7889455612', 'PRASAD@7889', 'Kolhapur', 'Retail');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(50) NOT NULL,
  `pname` varchar(250) NOT NULL,
  `ptype` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subquantity` int(250) NOT NULL,
  `a_discount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pname`, `ptype`, `description`, `subquantity`, `a_discount`) VALUES
(1, 'paracitimole', 'Tablets', 's.,mfdam,fs', 10, 'Yes'),
(2, 'Ciprofloxacin', 'Tablets', 'kdfjghkglfd;s', 100, 'No'),
(5, 'Paracetamole Tablets IP INTEMOL-500', 'Tablets', 'KJASDF', 10, 'Yes'),
(6, 'ZanduBam', 'Capsules', 'on headache', 1, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `sid` int(10) NOT NULL,
  `total_amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `purchase_date`, `sid`, `total_amount`) VALUES
(12, '2023-02-10', 1, 34000),
(14, '2023-02-11', 1, 600),
(15, '2023-02-27', 1, 90000),
(16, '2023-02-27', 2, 45000),
(17, '2023-02-27', 2, 45000),
(18, '2023-02-24', 2, 46200),
(20, '2023-02-28', 1, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pd_id` int(100) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `batch_no` varchar(11) NOT NULL,
  `quantity` int(20) NOT NULL,
  `purchase_rate` int(11) NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `retailrate` int(11) NOT NULL,
  `wholesale_rate` int(11) NOT NULL,
  `mfg_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pd_id`, `purchase_id`, `pid`, `batch_no`, `quantity`, `purchase_rate`, `purchase_total`, `retailrate`, `wholesale_rate`, `mfg_date`, `expiry_date`, `stock`) VALUES
(26, 12, 1, '1', 100, 100, 10000, 100, 1000, '2023-01-31', '2023-03-23', 748),
(27, 14, 1, '12', 10, 20, 200, 15, 46, '2023-01-25', '2023-02-22', 690),
(28, 14, 2, '75', 10, 40, 400, 47, 76, '2023-02-07', '2023-02-17', 0),
(29, 18, 5, 'p-1', 1100, 42, 46200, 45, 41, '2023-02-27', '2023-12-27', 740),
(30, 20, 6, 'z-1', 10000, 40, 400000, 45, 42, '2023-02-27', '2025-07-22', 9681);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(10) NOT NULL,
  `sale_date` date NOT NULL,
  `cid` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_date`, `cid`, `subtotal`, `discount`, `total`, `status`) VALUES
(2, '2023-02-16', 5, 16200, 1150, 15050, 'Closed'),
(3, '2023-02-09', 7, 104600, 10460, 94140, 'Closed'),
(4, '2023-02-17', 7, 11220, 1046, 10174, 'Closed'),
(5, '2023-02-08', 7, 5320, 0, 5320, 'Closed'),
(6, '2023-02-09', 8, 11500, 0, 11500, 'Closed'),
(7, '2023-02-16', 8, 1500, 0, 1500, 'Closed'),
(8, '2023-02-27', 16, 4950, 0, 45000, 'Closed'),
(9, '2023-02-27', 17, 4500, 0, 4500, 'Closed'),
(10, '2023-02-27', 17, 1000, 0, 1000, 'Closed'),
(11, '2023-02-28', 8, 1000, 0, 1000, 'Closed'),
(12, '2023-02-28', 7, 42, 0, 42, 'Closed'),
(13, '2023-02-28', 16, 225, 0, 225, 'Closed'),
(14, '2023-02-28', 17, 450, 0, 450, 'Closed'),
(15, '2023-02-28', 16, 1000, 0, 1000, 'Closed'),
(16, '2023-02-28', 8, 2250, 45, 2205, 'Closed'),
(17, '2023-02-28', 17, 2025, 0, 2025, 'Closed'),
(18, '2023-03-04', 17, 1450, 0, 1450, 'Closed'),
(19, '2023-03-03', 7, 420, 0, 420, 'Closed'),
(20, '2023-03-02', 16, 1000, 100, 900, 'Closed'),
(21, '2023-03-04', 17, 225, 0, 225, 'Closed'),
(31, '2023-03-06', 16, 2250, 225, 2025, 'Closed'),
(33, '2023-03-07', 7, 0, 0, 0, 'Closed'),
(37, '2023-03-17', 18, 0, 0, 0, 'Closed'),
(38, '2023-03-10', 19, 0, 0, 0, 'Closed'),
(39, '2023-03-08', 8, 3625, 73, 3553, 'Closed'),
(40, '2023-10-15', 8, 5175, 0, 5175, 'Closed'),
(41, '2023-10-17', 8, 6750, 0, 6750, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `salereturns`
--

CREATE TABLE `salereturns` (
  `id` int(10) NOT NULL,
  `srdate` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `total_amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salereturns`
--

INSERT INTO `salereturns` (`id`, `srdate`, `customer_id`, `total_amount`) VALUES
(1, '2023-03-07', 7, 84),
(2, '2023-03-07', 8, 255),
(3, '2023-03-07', 7, 1600),
(4, '2023-03-09', 7, 8000),
(5, '2023-03-07', 7, 800),
(6, '2023-03-07', 7, 8000),
(7, '2023-03-07', 16, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `salereturns_details`
--

CREATE TABLE `salereturns_details` (
  `id` int(10) NOT NULL,
  `srid` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `sd_id` int(10) NOT NULL,
  `pd_id` int(10) NOT NULL,
  `quantity` int(100) NOT NULL,
  `rate` int(100) NOT NULL,
  `total_amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salereturns_details`
--

INSERT INTO `salereturns_details` (`id`, `srid`, `product_id`, `sd_id`, `pd_id`, `quantity`, `rate`, `total_amount`) VALUES
(1, 1, 6, 27, 30, 2, 42, 84),
(2, 2, 6, 23, 30, 5, 45, 225),
(3, 3, 1, 6, 26, 2, 800, 1600),
(4, 4, 1, 6, 26, 10, 800, 8000),
(5, 5, 1, 6, 26, 1, 800, 800),
(6, 6, 1, 4, 26, 10, 800, 8000),
(7, 7, 1, 21, 26, 10, 100, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `sd_id` int(10) NOT NULL,
  `sale_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `pd_id` int(10) NOT NULL,
  `subquantity` int(10) NOT NULL,
  `rate` int(10) NOT NULL,
  `subtotal` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`sd_id`, `sale_id`, `product_id`, `pd_id`, `subquantity`, `rate`, `subtotal`, `discount`, `total`) VALUES
(1, 2, 1, 26, 100, 100, 10000, 1000, 9000),
(2, 2, 2, 28, 100, 47, 4700, 0, 4700),
(3, 2, 1, 27, 100, 15, 1500, 150, 1350),
(4, 3, 1, 26, 100, 1000, 100000, 10000, 90000),
(5, 3, 1, 27, 100, 46, 4600, 460, 4140),
(6, 4, 1, 26, 10, 1000, 10000, 1000, 9000),
(7, 4, 2, 28, 10, 76, 760, 0, 760),
(8, 4, 1, 27, 10, 46, 460, 46, 414),
(9, 5, 2, 28, 70, 76, 5320, 0, 5320),
(10, 6, 1, 27, 100, 15, 1500, 0, 1500),
(11, 6, 1, 26, 100, 100, 10000, 0, 10000),
(12, 7, 1, 27, 100, 15, 1500, 0, 1500),
(13, 8, 5, 29, 10, 45, 450, 0, 450),
(14, 8, 6, 30, 100, 45, 4500, 0, 4500),
(15, 9, 6, 30, 100, 45, 4500, 0, 4500),
(16, 10, 1, 26, 10, 100, 1000, 0, 1000),
(17, 11, 1, 26, 10, 100, 1000, 0, 1000),
(18, 12, 6, 30, 1, 42, 42, 0, 42),
(19, 13, 5, 29, 5, 45, 225, 0, 225),
(20, 14, 5, 29, 10, 45, 450, 0, 450),
(21, 15, 1, 26, 10, 100, 1000, 0, 1000),
(22, 16, 5, 29, 10, 45, 450, 45, 405),
(23, 16, 6, 30, 40, 45, 1800, 0, 1800),
(24, 17, 6, 30, 45, 45, 2025, 0, 2025),
(25, 18, 1, 26, 10, 100, 1000, 0, 1000),
(26, 18, 6, 30, 10, 45, 450, 0, 450),
(27, 19, 6, 30, 10, 42, 420, 0, 420),
(28, 20, 1, 26, 10, 100, 1000, 100, 900),
(29, 21, 6, 30, 5, 45, 225, 0, 225),
(30, 31, 5, 29, 50, 45, 2250, 225, 2025),
(36, 39, 1, 26, 25, 100, 2500, 50, 2450),
(37, 39, 5, 29, 25, 45, 1125, 23, 1103),
(38, 40, 5, 29, 100, 45, 4500, 0, 4500),
(39, 40, 6, 30, 15, 45, 675, 0, 675),
(40, 41, 5, 29, 150, 45, 6750, 0, 6750);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sid` int(10) NOT NULL,
  `suppliercode` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobileno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sid`, `suppliercode`, `name`, `email`, `address`, `mobileno`) VALUES
(1, 1234, 'Harshad', 'Harshaddange347@gmail.com', 'Dange gali juna budhawar peth 2519  d ward', '1245354756'),
(2, 1475, 'Akash', 'Akasha@gmail.com', 'Dange gali juna budhawar peth 2519  d ward ,,', '412275566');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD UNIQUE KEY `mobileno_2` (`mobileno`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `salereturns`
--
ALTER TABLE `salereturns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `srid` (`srid`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sale_id` (`sd_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`sd_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD UNIQUE KEY `mobileno_2` (`mobileno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pd_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `salereturns`
--
ALTER TABLE `salereturns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `sd_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `suppliers` (`sid`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers` (`cid`);

--
-- Constraints for table `salereturns`
--
ALTER TABLE `salereturns`
  ADD CONSTRAINT `salereturns_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cid`);

--
-- Constraints for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  ADD CONSTRAINT `salereturns_details_ibfk_1` FOREIGN KEY (`srid`) REFERENCES `salereturns` (`id`),
  ADD CONSTRAINT `salereturns_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `salereturns_details_ibfk_3` FOREIGN KEY (`sd_id`) REFERENCES `sale_details` (`sd_id`),
  ADD CONSTRAINT `salereturns_details_ibfk_4` FOREIGN KEY (`pd_id`) REFERENCES `purchase_details` (`pd_id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`),
  ADD CONSTRAINT `sale_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `sale_details_ibfk_3` FOREIGN KEY (`pd_id`) REFERENCES `purchase_details` (`pd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
