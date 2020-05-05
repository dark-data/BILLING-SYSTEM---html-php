-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2018 at 04:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_records`
--

CREATE TABLE IF NOT EXISTS `bill_records` (
  `bill_no` int(9) NOT NULL AUTO_INCREMENT,
  `pid` varchar(600) NOT NULL,
  `total_amount` int(7) NOT NULL,
  `discout` int(2) NOT NULL,
  `qty` varchar(600) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `final_amount` int(9) NOT NULL,
  `product_name` varchar(3000) NOT NULL,
  `product_price` varchar(2000) NOT NULL,
  PRIMARY KEY (`bill_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `bil_temp`
--

CREATE TABLE IF NOT EXISTS `bil_temp` (
  `bill_no` int(9) NOT NULL,
  `p_id` varchar(100) NOT NULL,
  `qty` int(4) NOT NULL,
  `price` int(7) NOT NULL,
  `total_price` int(7) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_contact`
--

CREATE TABLE IF NOT EXISTS `dealer_contact` (
  `name` varchar(30) NOT NULL,
  `company` varchar(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `additional_info` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_cur_bal`
--

CREATE TABLE IF NOT EXISTS `dealer_cur_bal` (
  `name` varchar(30) NOT NULL,
  `current_balance` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_history_of_transaction`
--

CREATE TABLE IF NOT EXISTS `dealer_history_of_transaction` (
  `name` varchar(30) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `amount_paid` int(7) NOT NULL,
  `purchase_bill` int(8) NOT NULL,
  `liability_amount` int(7) NOT NULL,
  `bill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_product`
--

CREATE TABLE IF NOT EXISTS `dealer_product` (
  `name` varchar(30) NOT NULL,
  `product` varchar(30) NOT NULL,
  `product_details` varchar(50) NOT NULL,
  `pid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `sno` int(6) NOT NULL,
  `user` varchar(25) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE IF NOT EXISTS `product_details` (
  `product_name` varchar(30) NOT NULL,
  `details` varchar(60) NOT NULL,
  `amount` int(7) NOT NULL,
  `quantity` int(5) NOT NULL,
  `dealer` varchar(30) NOT NULL,
  `pid` int(9) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `month` varchar(40) NOT NULL,
  `year` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `quantity` int(9) NOT NULL,
  `amount` int(9) NOT NULL,
  `bill_no` int(9) NOT NULL,
  `day` varchar(15) NOT NULL,
  KEY `bill_no` (`bill_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `profile` varchar(30) NOT NULL,
  `u_id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`username`, `password`, `name`, `address`, `phone`, `profile`, `u_id`, `type`) VALUES
('admin', 'admin', 'admin', '', '', '', 1, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`bill_no`) REFERENCES `bill_records` (`bill_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
