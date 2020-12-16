-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2017 at 03:52 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `insurance_db`
--
CREATE DATABASE IF NOT EXISTS `insurance_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `insurance_db`;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `agent_id` int(10) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(30) NOT NULL,
  `agent_code` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `agent_address` text NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `Qualification` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_id`, `agent_name`, `agent_code`, `password`, `agent_address`, `email_id`, `Qualification`, `status`) VALUES
(22, 'raksha', 'raksha', 'b691dd8ba369b44bcc19c4f9d60a5a04', 'mattar', 'raksha@gmail.com', 'bca', 'Active'),
(23, 'Seeta', 'seeta', '85482e02896237dc421008cad4dbfbb3', 'palli', 'abc@gmail.com', 'bbm', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(10) NOT NULL AUTO_INCREMENT,
  `state_id` int(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `state_id`, `city`, `status`) VALUES
(2, 4, 'Karkala', 'Active'),
(3, 4, 'Manglore', 'Active'),
(4, 4, 'Hubli', 'Active'),
(5, 4, 'Belgaum', 'Active'),
(6, 5, 'Pune', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `commission_master`
--

CREATE TABLE IF NOT EXISTS `commission_master` (
  `commission_master_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_scheme_id` int(10) NOT NULL,
  `insurance_account_id` int(10) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `commission_amt` float(10,2) NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `particulars` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`commission_master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `commission_master`
--

INSERT INTO `commission_master` (`commission_master_id`, `insurance_scheme_id`, `insurance_account_id`, `agent_id`, `commission_amt`, `transaction_type`, `transaction_date`, `particulars`, `status`) VALUES
(10, 1, 62, 6, 111.00, 'Credit', '0000-00-00', '', 'Active'),
(11, 1, 62, 6, 222.00, 'Credit', '0000-00-00', '', 'Active'),
(12, 1, 62, 6, 104.17, 'Credit', '0000-00-00', '', 'Active'),
(13, 1, 62, 6, 104.17, 'Credit', '2017-03-02', '', 'Active'),
(14, 1, 63, 6, 48.93, 'Credit', '2017-03-02', '', 'Active'),
(15, 1, 64, 18, 3125.00, 'Credit', '2017-03-02', '', 'Active'),
(16, 1, 64, 18, 3125.00, 'Credit', '2017-03-02', '', 'Active'),
(17, 1, 65, 0, 0.00, 'Credit', '0000-00-00', '', 'Active'),
(18, 1, 65, 0, 0.00, 'Credit', '0000-00-00', '', 'Active'),
(19, 1, 67, 6, 347.22, 'Credit', '2017-03-10', '', 'Active'),
(20, 1, 67, 6, 347.22, 'Credit', '2017-03-10', '', 'Active'),
(21, 0, 0, 6, 150.00, 'Debit', '2017-03-15', 'Paid through net banking', 'Active'),
(22, 0, 0, 22, 0.00, 'Debit', '2021-02-26', '', 'Rejected'),
(23, 1, 81, 22, 48000.00, 'Credit', '2017-03-18', '', 'Active'),
(24, 0, 0, 22, 560.00, 'Debit', '2017-03-18', 'Paid through credit card', 'Active'),
(25, 1, 81, 22, 48000.00, 'Credit', '2017-03-19', '', 'Active'),
(26, 0, 0, 22, 4000.00, 'Debit', '2017-03-19', 'paid', 'Active'),
(27, 1, 86, 22, 133.33, 'Credit', '2017-03-21', '', 'Active'),
(28, 1, 86, 22, 133.33, 'Credit', '2017-03-21', '', 'Active'),
(29, 1, 86, 22, 133.33, 'Credit', '2017-03-21', '', 'Active'),
(30, 0, 0, 22, 1839.99, 'Debit', '2017-03-21', '', 'Active'),
(31, 1, 87, 22, 266.67, 'Credit', '2017-03-23', '', 'Active'),
(32, 1, 88, 22, 166.67, 'Credit', '2017-03-23', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `contact_date` date NOT NULL,
  `reply` text NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `customer_id`, `title`, `message`, `contact_date`, `reply`) VALUES
(12, 47, 'Insurance Query By Pavitra', '<p>Please help this problem</p>', '2027-03-19', 'here is your solution'),
(14, 47, 'nmbhj', '<p>khgkj</p>', '2029-03-21', 'hjgjhg'),
(17, 48, 'jekhdfjakda', '<p>jkbwdqgehkuw</p>', '2017-03-21', 'esfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `agent_id` int(32) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_mobile` varchar(15) NOT NULL,
  `cust_dob` date NOT NULL,
  `login_id` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `nominee` varchar(25) NOT NULL,
  `nominee_relation` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `city_id` varchar(25) NOT NULL,
  `state_id` varchar(25) NOT NULL,
  `pin` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `agent_id`, `customer_name`, `cust_address`, `cust_mobile`, `cust_dob`, `login_id`, `password`, `email_id`, `nominee`, `nominee_relation`, `status`, `city_id`, `state_id`, `pin`) VALUES
(47, 0, 'Pavitra Prabhu', 'Manjarpalke', '9876453210', '1994-12-09', 'pavvi', 'fd1e21cf84fd9dad641445bbf9a5bbf4', 'pavitraprabhu@gmail.com', 'Mamata', 'Mother', 'Active', '2', '4', '567111'),
(48, 22, 'Pranita', 'Mattar', '9876543210', '1999-03-08', 'praneeta', '35c0ebe941a7e5cf9829180a74983719', 'rakshubelman@gmail.com', 'raksha', 'Mother', 'Active', '2', '4', '567890'),
(49, 0, 'savi', 'palli', '9876543210', '1950-03-19', 'savi', 'bdc2f7f3e38c9cee6f503c3dfc5c500b', 'savi1234@gmail.com', 'raksha', 'Mother', 'Pending', '2', '4', '12345'),
(50, 0, 'pramila', 'sooda', '9876543210', '1983-12-28', 'pramila', 'd86da91893bb7b31fa61300422b0bc6b', 'pramilanayak@gmail.com', 'sahana', 'Mother', 'Pending', '3', '4', '12344');

-- --------------------------------------------------------

--
-- Table structure for table `customer_document`
--

CREATE TABLE IF NOT EXISTS `customer_document` (
  `cust_doc_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `document_type` varchar(25) NOT NULL,
  `document_path` varchar(100) NOT NULL,
  PRIMARY KEY (`cust_doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer_document`
--

INSERT INTO `customer_document` (`cust_doc_id`, `customer_id`, `document_type`, `document_path`) VALUES
(6, 0, 'Aadhar Card', '315705.jpg'),
(7, 0, 'Voter ID', '1252795408582.jpg'),
(9, 48, 'Ration Card', '16027535724747.jpg'),
(11, 48, 'Aadhar Card', '21670accordion1.png');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_type` varchar(20) NOT NULL,
  `emp_name` varchar(25) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `emp_type`, `emp_name`, `login_id`, `password`, `status`) VALUES
(1, 'Admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Active'),
(2, 'Employee', 'employee', 'employee', 'fa5473530e4d1a5a1e1eb53d2fedb10c', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_account`
--

CREATE TABLE IF NOT EXISTS `insurance_account` (
  `insurance_account_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `insurance_plan_id` int(10) NOT NULL,
  `date_create` date NOT NULL,
  `maturity_date` date NOT NULL,
  `policy_term` varchar(10) NOT NULL,
  `sum_assured` float(10,2) NOT NULL,
  `profit_ratio` float(10,2) NOT NULL,
  `total_amt` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`insurance_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `insurance_account`
--

INSERT INTO `insurance_account` (`insurance_account_id`, `customer_id`, `insurance_plan_id`, `date_create`, `maturity_date`, `policy_term`, `sum_assured`, `profit_ratio`, `total_amt`, `status`) VALUES
(1, 0, 0, '0000-00-00', '0000-00-00', '0', 0.00, 6.00, 106000.00, 'Pending'),
(2, 0, 0, '0000-00-00', '0000-00-00', '0', 0.00, 6.00, 106000.00, 'Pending'),
(3, 2, 1, '2017-01-26', '2021-01-25', '3', 100000.00, 6.00, 106000.00, 'Pending'),
(4, 2, 1, '2017-01-26', '2022-01-25', '3', 100000.00, 6.00, 106000.00, 'Pending'),
(5, 2, 1, '2017-01-26', '2022-01-25', '3', 100000.00, 6.00, 106000.00, 'Pending'),
(6, 2, 1, '2017-01-26', '2021-01-25', '1', 100000.00, 6.00, 106000.00, 'Pending'),
(7, 2, 1, '2017-01-27', '2023-01-26', '1', 100000.00, 6.00, 106000.00, 'Pending'),
(8, 2, 1, '2017-01-27', '2021-01-26', '3', 100000.00, 6.00, 106000.00, 'Pending'),
(9, 2, 1, '2017-01-27', '2025-01-26', '3', 100000.00, 6.00, 106000.00, 'Pending'),
(10, 2, 1, '2017-02-01', '0000-00-00', '3', 1111111.00, 6.00, 1177777.62, 'Pending'),
(11, 2, 1, '2017-02-01', '0000-00-00', '1', 100000.00, 6.00, 106000.00, 'Pending'),
(12, 2, 1, '2017-02-02', '0000-00-00', '1', 100000.00, 6.00, 106000.00, 'Pending'),
(13, 2, 1, '2017-02-02', '0000-00-00', '1', 100000.00, 6.00, 106000.00, 'Pending'),
(14, 2, 1, '2017-02-02', '0000-00-00', '3 Month', 31321320.00, 6.00, 33200600.00, 'Pending'),
(15, 2, 1, '2017-02-02', '0000-00-00', '3 Month', 31321320.00, 6.00, 33200600.00, 'Pending'),
(16, 2, 1, '2017-02-02', '0000-00-00', '3 Month', 31321320.00, 6.00, 33200600.00, 'Pending'),
(77, 47, 1, '2023-03-18', '2027-03-18', '1 Year', 120000.00, 6.00, 127200.00, 'Active'),
(78, 47, 1, '2027-03-19', '2031-03-19', '1 Month', 333333.00, 6.00, 353332.97, 'Active'),
(79, 47, 1, '2027-03-19', '2030-03-19', '3 Month', 3333333.00, 6.00, 3533333.00, 'Active'),
(80, 47, 1, '2027-03-19', '2029-03-19', '1 Year', 120000.00, 6.00, 127200.00, 'Active'),
(81, 48, 1, '2017-03-18', '2019-03-18', '1 Year', 1200000.00, 6.00, 1272000.00, 'Active'),
(82, 47, 2, '2017-03-19', '2023-03-19', '1 Month', 300000.00, 5.00, 315000.00, 'Active'),
(83, 47, 6, '2017-03-20', '2023-03-20', '1 Year', 324000.00, 8.00, 349920.00, 'Active'),
(84, 50, 1, '2019-04-04', '2025-04-04', '3 Month', 120000.00, 6.00, 127200.00, 'Pending'),
(85, 50, 1, '2019-04-04', '2026-04-04', '3 Month', 120000.00, 6.00, 127200.00, 'Active'),
(86, 48, 1, '2017-03-21', '2022-03-21', '1 Month', 100000.00, 6.00, 106000.00, 'Active'),
(87, 48, 1, '2017-03-23', '2020-03-23', '1 Month', 120000.00, 6.00, 127200.00, 'Active'),
(88, 48, 1, '2017-03-23', '2021-03-23', '1 Month', 100000.00, 6.00, 106000.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_plan`
--

CREATE TABLE IF NOT EXISTS `insurance_plan` (
  `insurance_plan_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_type_id` int(10) NOT NULL,
  `insurance_scheme_id` int(10) NOT NULL,
  `policy_term_min` int(10) NOT NULL,
  `policy_term_max` int(10) NOT NULL,
  `min_age` int(10) NOT NULL,
  `max_age` int(10) NOT NULL,
  `sum_assured_min` float(10,2) NOT NULL,
  `sum_assured_max` float(10,2) NOT NULL,
  `profit_ratio` float(10,2) NOT NULL,
  `penalty_amt` float(10,2) NOT NULL,
  `exit_policy` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`insurance_plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `insurance_plan`
--

INSERT INTO `insurance_plan` (`insurance_plan_id`, `insurance_type_id`, `insurance_scheme_id`, `policy_term_min`, `policy_term_max`, `min_age`, `max_age`, `sum_assured_min`, `sum_assured_max`, `profit_ratio`, `penalty_amt`, `exit_policy`, `status`) VALUES
(1, 1, 1, 2, 8, 25, 60, 110000.00, 150000.00, 6.00, 5.00, 0.00, 'Active'),
(2, 1, 2, 6, 9, 25, 60, 300000.00, 500000.00, 5.00, 5.00, 0.00, 'Active'),
(3, 1, 3, 6, 12, 24, 50, 100000.00, 500000.00, 8.00, 6.00, 0.00, 'Active'),
(4, 2, 4, 2, 7, 30, 45, 167000.00, 450000.00, 4.00, 7.00, 0.00, 'Active'),
(5, 2, 5, 5, 9, 28, 46, 400000.00, 769000.00, 6.00, 7.00, 0.00, 'Active'),
(6, 3, 6, 6, 8, 30, 60, 324000.00, 670000.00, 8.00, 8.00, 0.00, 'Active'),
(7, 3, 7, 4, 9, 33, 67, 234000.00, 450000.00, 5.00, 8.00, 0.00, 'Active'),
(8, 3, 8, 3, 9, 33, 56, 340000.00, 540000.00, 9.00, 8.00, 0.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_scheme`
--

CREATE TABLE IF NOT EXISTS `insurance_scheme` (
  `insurance_scheme_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_scheme` varchar(50) NOT NULL,
  `agent_commission` float(10,2) NOT NULL,
  `agent_commission2` float(10,2) NOT NULL,
  `insurance_type_id` varchar(10) NOT NULL,
  `claim_deducation` float(10,2) NOT NULL,
  `penalty_amt` float(10,2) NOT NULL,
  `note` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`insurance_scheme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `insurance_scheme`
--

INSERT INTO `insurance_scheme` (`insurance_scheme_id`, `insurance_scheme`, `agent_commission`, `agent_commission2`, `insurance_type_id`, `claim_deducation`, `penalty_amt`, `note`, `img`, `status`) VALUES
(1, 'test protective plan', 11.00, 3.00, '1', 0.00, 0.00, '<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Comprehensive Plan :</strong></em> A Comprehensive cancer insurance plan covering all stages of cancer.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Lump Sum Payout/s</strong> </em>: Lump sum Payouts to cover medical expenses across all stages.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Waiver of all Future Premiums :</strong></em> Waiver of premium for entire policy term in case diagnosed with Carcinoma in Situ (CiS) or Early Stage CancerIncome.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong> Benefit</strong> </em>: Income benefit for 5 years in case diagnosed with Major Stage Cancer along with lump sum.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Indexation of Sum Insured :</strong></em> Sum Insured to increase by 10% (simple rate) for every claim free year upto a maximum of 150% of base Sum Insured</p>', '16670006.jpg', 'Active'),
(2, 'Super Term Plan', 6.00, 0.00, '1', 0.00, 0.00, '<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Option To Cope Up With Rising Inflation:</strong></em> Max Life Super Term Plan offers a unique Sum Assured option, where the Sum Assured increases by 5% every year at simple rate till the end of the Policy Term without any increase in the Premium. This helps your Life Insurance Plan cope with the rising inflation and in line with your upgrading life style.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36pt;"><em><strong>Flexibility To Choose The Benefit Payout:</strong></em> On death of the Life Insured, the nominee can choose the Settlement Option:</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36pt; padding-left: 30px;"><strong> Option 1:</strong> He / she will have an option to receive the entire Death Benefit as lump sum.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36pt; padding-left: 30px;"><strong> Option 2:</strong> Receive 50% of Guaranteed Death Benefit as lump sum and 0.42% of Guaranteed Death Benefit as monthly income for 10 years increasing at 8.50% p.a. (simple rate) every year starting from the policy anniversary following the date of death.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36pt;"><em><strong>Flexibility To Choose Between Policy Terms:</strong></em> Choose Policy Terms from a minimum of 10 years to maximum of 35 years.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36pt;"><em><strong>Comprehensive Insurance Cover At Affordable Rates:</strong></em> Max Life Super Term Plan offers comprehensive insurance cover at affordable rates to take care of your loved ones in case you are not around</p>', '24308super-term-plan (1).jpg ', 'Active'),
(3, 'Premium Return Protection', 4.00, 0.00, '1', 0.00, 0.00, '<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Comprehensive protection with in - built accidental death benefit:</strong> </em>Base Policy Sum Assured is paid in case of Death. In case of Death by accident, the nominee gets an additional 50% of the Base Policy Sum Assured.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong> Return of premiums on survival at maturity:</strong></em> Guaranteed return of all premiums paid (including extra premiums), in case of your survival till maturity.</p>\r\n<p style="margin: 0cm 0cm 7.5pt 36.0pt;"><em><strong>Flexibility to choose the period of protection by paying for a limited period:</strong> </em>Pay premiums for a limited period of 11 years. The plan offers you the flexibility to choose the Policy Term between 20 / 25 / 30 years (period of protection).</p>', '31331premium-return-protection-plan-banner.jpg ', 'Active'),
(4, 'Future Genius Education Plan', 7.00, 0.00, '2', 0.00, 0.00, '', '6800p15.jpg ', 'Active'),
(5, 'Shiksha Plus Super', 6.00, 0.00, '2', 0.00, 0.00, '', '25703shiksha-plus-super.jpg ', 'Active'),
(6, 'Forever Young Pension Plan', 6.00, 0.00, '3', 0.00, 0.00, '', '17849p8.jpg ', 'Active'),
(7, 'Guaranteed Lifetime Income Plan', 9.00, 0.00, '3', 0.00, 0.00, '', '20396guaranteed lifetime income plan.jpg ', 'Active'),
(8, 'Life Perfect Partner Super', 8.00, 0.00, '3', 0.00, 0.00, '', '19579life_partener perfect super.jpg ', 'Active'),
(9, 'Monthly Income Advantage Plan', 4.00, 0.00, '4', 0.00, 0.00, '', '4049monthly- income-advantage-plan-banner.jpg ', 'Active'),
(10, 'Life Guaranteed Income Plan', 6.00, 0.00, '4', 0.00, 0.00, '', '21156guaranteed lifetime income plan.jpg ', 'Active'),
(11, 'Whole Life Super', 3.00, 0.00, '4', 0.00, 0.00, '', '1491whole_life_savings.jpg ', 'Active'),
(12, 'Fast Track Super Plan', 7.00, 0.00, '5', 0.00, 0.00, '', '15710fast_track_super_banner.jpg ', 'Active'),
(13, 'Platinum Wealth Plan', 6.00, 0.00, '5', 0.00, 0.00, '', '4949platinum-wealth-plan-banner.jpg ', 'Active'),
(14, 'Group Credit Life Premerier Plan', 3.00, 0.00, '6', 0.00, 0.00, '', '25716group credit life.jpg ', 'Active'),
(16, 'test protective plan', 10.00, 0.00, '', 0.00, 0.00, '<p>test note</p>', '8273007.jpg ', 'Active'),
(17, 'test protective plan', 10.00, 0.00, '', 0.00, 0.00, '<p>test note</p>', '4535007.jpg ', 'Active'),
(18, 'test protective plan', 23.00, 2.00, '2', 0.00, 0.00, '<p>test</p>', '28813007.jpg ', 'Active'),
(19, 'test protective plan', 10.00, 5.00, '3', 0.00, 0.00, '<p>test record</p>', '14869007.jpg ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_type`
--

CREATE TABLE IF NOT EXISTS `insurance_type` (
  `insurance_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_type` varchar(25) NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`insurance_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `insurance_type`
--

INSERT INTO `insurance_type` (`insurance_type_id`, `insurance_type`, `img`, `status`) VALUES
(1, 'PROTECTION PLANS', '', 'Active'),
(2, 'CHILD PLANS', '', 'Active'),
(3, 'RETIREMENT PLANS', '', 'Active'),
(4, 'SAVINGS PLAN', '', 'Active'),
(5, 'GROWTH PLANS', '', 'Active'),
(6, 'GROUP PLANS', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `policy_payment`
--

CREATE TABLE IF NOT EXISTS `policy_payment` (
  `policy_payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_account_id` int(10) NOT NULL,
  `paid_amt` float(10,2) NOT NULL,
  `tax_amt` float(10,2) NOT NULL,
  `paid_date` date NOT NULL,
  `trans_type` varchar(25) NOT NULL,
  `card_holder` text NOT NULL,
  `card_no` varchar(30) NOT NULL,
  `exp_date` date NOT NULL,
  `particulars` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`policy_payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

--
-- Dumping data for table `policy_payment`
--

INSERT INTO `policy_payment` (`policy_payment_id`, `insurance_account_id`, `paid_amt`, `tax_amt`, `paid_date`, `trans_type`, `card_holder`, `card_no`, `exp_date`, `particulars`, `status`) VALUES
(11, 14, 166602.77, 34.00, '2017-02-02', 'Credit card', 'wwqswqs', '123123', '2017-02-01', 'jkk', 'Active'),
(12, 15, 166602.77, 34.00, '2017-02-02', 'Credit card', 'dscds', '121', '2017-02-01', 'asdas', 'Active'),
(13, 16, 166602.77, 34.00, '2017-02-02', 'Credit card', 'gfh', 'gf', '2017-02-01', 'fgf', 'Active'),
(14, 17, 166602.77, 34.00, '2017-02-02', 'Debit card', 'qw', 'w', '2017-02-01', 'weswq', 'Active'),
(15, 17, 166602.77, 34.00, '2017-02-02', 'Debit card', 'qw', 'w', '2017-02-01', 'weswq', 'Active'),
(16, 29, 177.30, 12.00, '2017-02-02', 'Debit card', 'n', 'k', '2017-02-01', ',m', 'Active'),
(17, 29, 177.30, 12.00, '2017-02-22', 'VISA', 'dsf', 'dsfsd', '2017-02-01', 'sdfs', 'Active'),
(18, 34, 177.30, 12.00, '2017-02-03', '', 'dsfsd', 'dsfsd', '2017-02-01', 'dsfd', 'Active'),
(19, 35, 394.01, 12.00, '2017-02-03', 'Master card', 'sxfsd', '32423', '2017-02-01', 'xdfsdfsdf', 'Active'),
(20, 36, 531.91, 12.00, '2017-02-03', 'Debit card', 'dsfgdgdf', '222222', '2017-02-01', 'erytr', 'Active'),
(21, 44, 2083.33, 12.00, '2017-02-03', 'VISA', 'werwer', '1231', '2017-02-01', 'rtretew', 'Active'),
(22, 45, 1388.89, 12.00, '2017-02-05', 'VISA', 'dgf', 'rre', '2017-02-01', 'edewd', 'Active'),
(23, 46, 13888.88, 12.00, '2017-02-05', 'Debit card', 'fg', '5464', '2017-02-01', 'fgdf', 'Active'),
(24, 47, 13888.88, 12.00, '2017-02-05', 'Debit card', 'efd', 'eww', '0032-09-01', 'cvf', 'Active'),
(25, 48, 1666.67, 12.00, '2017-02-08', 'VISA', 'eryr', 'tytry', '2017-02-01', 'tytryr', 'Active'),
(26, 49, 5000.00, 12.00, '2017-02-08', 'VISA', 'jbhjbh', '67576', '2017-02-01', 'gfhgf', 'Active'),
(27, 50, 1666.67, 12.00, '2017-02-11', 'Debit card', 'rakshita', '12678935226767', '2023-02-01', 'test', 'Active'),
(28, 51, 10000.00, 12.00, '2017-02-15', 'Debit card', 'sahana', '0987654321', '2017-03-01', 'test sahana', 'Active'),
(29, 53, 2777.78, 12.00, '2017-02-20', 'Credit card', '1q', '1qwq', '2017-02-01', 'sax', 'Active'),
(30, 53, 2777.78, 12.00, '2017-02-20', 'Credit card', 'qsqsa', 'qwsqw', '2017-02-01', 'qsx', 'Active'),
(31, 53, 2777.78, 12.00, '2017-02-09', 'VISA', 'asxs', '111', '2017-02-01', 'as', 'Active'),
(32, 54, 1041.67, 12.00, '2017-02-21', 'Credit card', '7894561230', '1235467496', '2017-12-01', 'test me', 'Active'),
(33, 55, 2500.00, 12.00, '2017-02-21', 'Debit card', 'raj kiran', '12345678901234567', '2017-12-01', 'test particular', 'Active'),
(34, 56, 8333.33, 12.00, '2017-02-21', 'Debit card', 'rj ira', '123456789', '2017-01-01', 'yer', 'Active'),
(35, 57, 25000.00, 12.00, '2017-02-21', 'Debit card', 'raj kiran', '223232323', '2017-02-01', 'rteew', 'Active'),
(36, 58, 50000.00, 12.00, '2017-02-21', 'Credit card', 'raj kiran', '112121212', '2017-01-01', 'tet', 'Active'),
(37, 59, 100000.00, 12.00, '2017-02-21', 'Debit card', 'raj kiran', '232423424', '2017-02-01', 'tet', 'Active'),
(38, 60, 347.22, 12.00, '2017-02-21', 'Debit card', 'raj kiran', '232323', '2017-02-01', 'test', 'Active'),
(39, 51, 10000.00, 12.00, '2017-02-23', 'Debit card', 'sdfsd', '3123', '2017-02-01', 'qweq', 'Active'),
(40, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(41, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(42, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(43, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(44, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(45, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(46, 61, 6250.00, 12.00, '2017-02-28', 'Debit card', '345', '234234', '2017-02-01', '2424', 'Active'),
(47, 62, 1041.67, 12.00, '2017-03-02', 'Debit card', 'Raj kiran', '1234567812345689', '2017-12-01', 'Test particulars', 'Active'),
(48, 62, 1041.67, 12.00, '2017-03-02', 'Debit card', '232323', '2323', '2017-01-01', 'dgdg', 'Active'),
(49, 62, 1041.67, 12.00, '2017-03-02', 'Debit card', '232323', '2323', '2017-01-01', 'dgdg', 'Active'),
(50, 62, 1041.67, 12.00, '2017-03-02', 'Debit card', '232323', '2323', '2017-01-01', 'dgdg', 'Active'),
(51, 62, 1041.67, 12.00, '2017-03-02', 'Credit card', 'raj kiran', '22323423424234', '2017-03-01', 'rareerr', 'Active'),
(52, 62, 1041.67, 12.00, '2017-03-02', 'Credit card', 'raj kiran', '22323423424234', '2017-03-01', 'rareerr', 'Active'),
(53, 62, 1041.67, 12.00, '2017-03-02', 'Credit card', 'raj kiran', '22323423424234', '2017-03-01', 'rareerr', 'Active'),
(54, 62, 1041.67, 12.00, '2017-03-02', 'Credit card', 'raj kiran', '22323423424234', '2017-03-01', 'rareerr', 'Active'),
(55, 62, 1041.67, 12.00, '2017-03-02', 'Credit card', 'raj kiran', '22323423424234', '2017-03-01', 'rareerr', 'Active'),
(56, 63, 489.29, 12.00, '2017-03-02', 'Credit card', 'Raj kiran', '54545454545', '2017-03-01', 'test', 'Active'),
(57, 64, 31250.00, 12.00, '2017-03-02', 'Credit card', 'Raj kiran', '345354345345345', '2017-03-01', 'test', 'Active'),
(58, 64, 31250.00, 12.00, '2017-03-02', 'Credit card', 'Raj kiran2', '24234234234', '2017-03-01', '2test', 'Active'),
(59, 65, 27777.78, 12.00, '2017-03-03', 'Credit card', 'sdgdsfg', '34235436', '2017-03-01', 'test', 'Active'),
(60, 65, 27777.78, 12.00, '2017-03-03', 'Credit card', 'raksha', '124556', '2017-03-01', 'teat', 'Active'),
(61, 65, 27777.78, 12.00, '2017-03-03', 'Credit card', 'hjgbxsd', '3453456', '2017-03-01', 'ygytr', 'Active'),
(62, 65, 27777.78, 12.00, '2017-03-03', 'Credit card', 'dsfdsf', '324234', '2017-03-01', 'wefrs', 'Active'),
(63, 58, 50000.00, 12.00, '2017-03-03', 'Debit card', 'dsfsd', '2343242', '2017-03-01', 'regreg', 'Active'),
(64, 66, 4166.67, 12.00, '2017-03-03', 'Credit card', 'adasdsa', '123467889', '2017-03-01', 'zdvdz', 'Active'),
(65, 66, 4166.67, 12.00, '2017-03-03', 'Credit card', 'sadsa', '54564554', '2017-03-01', ' fgf', 'Active'),
(66, 67, 3472.22, 12.00, '2017-03-10', 'Credit card', 'eretertre', '35345346356546546', '2017-03-01', '', 'Active'),
(67, 67, 3472.22, 12.00, '2017-03-10', 'Credit card', 'dfgdfgdfggfd', '5436345345', '2017-03-01', '', 'Active'),
(68, 59, 100000.00, 0.00, '2021-02-22', 'Credit card', 'efasd', '21321', '2021-02-01', '', 'Active'),
(69, 59, 100000.00, 0.00, '2021-02-22', 'Credit card', 'cxvxc', '5645645645', '2021-02-01', '', 'Active'),
(70, 59, 100000.00, 0.00, '2021-02-22', 'Credit card', 'XZCzxc', '54645', '2021-02-01', '', 'Active'),
(71, 59, 100000.00, 0.00, '2021-02-22', 'Credit card', 'fdgvxgvxcvxcv', '234234324', '2021-02-01', '', 'Active'),
(72, 69, 3125.00, 0.00, '2021-02-26', 'Credit card', 'raksha', '0987641561243', '2021-02-01', '', 'Active'),
(73, 51, 10000.00, 0.00, '2021-02-26', 'Credit card', 'cxvxc', 'Aravinda', '2021-12-01', '', 'Active'),
(74, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', 'XZCzxc', '', '0000-00-00', '', 'Active'),
(75, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(76, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(77, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(78, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(79, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(80, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(81, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(82, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(83, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(84, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(85, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(86, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(87, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(88, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(89, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(90, 51, 10000.00, 0.00, '2021-02-26', 'Debit card', '', '', '0000-00-00', '', 'Active'),
(91, 0, 0.00, 0.00, '2017-03-17', '', '', '', '0000-00-00', '', 'Active'),
(92, 0, 0.00, 0.00, '2017-03-17', '', '', '78687678', '0000-00-00', '', 'Active'),
(93, 0, 0.00, 0.00, '2017-03-17', '', '', '989', '0000-00-00', '', 'Active'),
(94, 0, 0.00, 0.00, '2017-03-17', '', '', '', '0000-00-00', '', 'Active'),
(95, 70, 75000.00, 0.00, '2017-03-17', 'VISA Card', 'asd', '234', '2017-03-01', '', 'Active'),
(96, 70, 75000.00, 0.00, '2017-03-17', 'Debit card', 'sdf', '43534', '2017-03-01', '', 'Active'),
(97, 71, 75000.00, 0.00, '2017-03-18', 'VISA Card', 'fsdgsdfgsd', '324234234234', '2017-03-01', '', 'Active'),
(98, 71, 75000.00, 0.00, '2019-03-20', 'VISA Card', 'dfasdfasdsad', '324234523523', '2017-03-01', '', 'Active'),
(99, 74, 47045.42, 0.00, '2017-03-18', 'VISA Card', 'stwerwe', '345345', '2017-03-01', '', 'Active'),
(100, 75, 5144.00, 0.00, '2017-03-18', 'Credit card', 'zczczc', '435345', '2017-02-01', '', 'Active'),
(101, 76, 13888.88, 12.00, '2023-03-18', 'Debit card', 'dscsda', '12321', '2023-03-01', '', 'Active'),
(102, 77, 30000.00, 12.00, '2023-03-18', 'Credit card', 'Pavitra Prabhu', '4467890543216785', '2023-06-01', '', 'Active'),
(103, 77, 30000.00, 12.00, '2023-03-18', 'Credit card', 'Pavitra prabhu', '4412345678901342', '2023-03-01', '', 'Active'),
(104, 77, 30000.00, 12.00, '2023-03-18', '', 'Pavitra Prabhu', '4498765432123456', '2023-03-01', '', 'Active'),
(105, 77, 30000.00, 12.00, '2023-03-18', 'Credit card', 'Pavitra Prabhu', '6757645634431453', '2023-03-01', '', 'Active'),
(106, 78, 6944.44, 12.00, '2027-03-19', 'Debit card', 'aesdfas', 'asdasd', '2027-03-01', '', 'Active'),
(107, 79, 277777.75, 12.00, '2027-03-19', 'VISA Card', 'sdfsd', '25243', '2027-03-01', '', 'Active'),
(108, 80, 60000.00, 12.00, '2027-03-19', 'Credit card', 'asdas', '3242', '2027-03-01', '', 'Active'),
(109, 80, 60000.00, 12.00, '2027-03-19', 'Debit card', 'qwdwqed', '345435', '2027-03-01', '', 'Active'),
(110, 81, 600000.00, 12.00, '2017-03-18', 'Credit card', 'praneeta', '5678900098376', '2017-03-01', '', 'Active'),
(111, 81, 600000.00, 12.00, '2017-03-19', 'Credit card', 'zsdasdas', '234234', '2017-03-01', '', 'Active'),
(112, 82, 4166.67, 12.00, '2017-03-19', 'Debit card', 'Pavitra Prabhu', '78675564354243243', '2017-03-01', '', 'Active'),
(113, 83, 54000.00, 12.00, '2017-03-20', 'Debit card', 'rakshita', '674764765', '2017-03-01', '', 'Active'),
(114, 85, 4285.71, 12.00, '2019-04-04', 'Debit card', 'trty', '656557667876666666666666666666', '2024-12-01', '', 'Active'),
(115, 86, 1666.67, 12.00, '2017-03-21', 'Debit card', '123456789', '1123456798', '2017-12-01', '', 'Active'),
(116, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(117, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(118, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(119, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(120, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(121, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(122, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(123, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(124, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(125, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(126, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(127, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(128, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(129, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(130, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(131, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(132, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(133, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(134, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(135, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(136, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(137, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(138, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(139, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(140, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(141, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(142, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(143, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(144, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(145, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(146, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(147, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(148, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(149, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(150, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(151, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(152, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(153, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(154, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(155, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(156, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(157, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(158, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(159, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(160, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(161, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(162, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(163, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(164, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(165, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(166, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(167, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(168, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(169, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(170, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(171, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(172, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(173, 86, 1666.67, 12.00, '2017-03-21', 'Credit card', 'Pavitra Prabhu', '1234567891235689', '2017-12-01', '', 'Active'),
(174, 86, 1666.67, 12.00, '2017-03-21', 'Debit card', 'raj', '123456789123456', '2017-12-01', '', 'Active'),
(175, 87, 3333.33, 12.00, '2017-03-23', 'Credit card', 'uydgsduy', '5132', '2017-03-01', '', 'Active'),
(176, 88, 2083.33, 12.00, '2017-03-23', 'Credit card', 'hjbhj', '897897698', '2017-03-01', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `policy_withdrawal`
--

CREATE TABLE IF NOT EXISTS `policy_withdrawal` (
  `claim_id` int(10) NOT NULL AUTO_INCREMENT,
  `insurance_account_id` int(10) NOT NULL,
  `claim_type` varchar(15) NOT NULL COMMENT 'exit policy or Full year',
  `claim_amt` float(10,2) NOT NULL,
  `claim_date` date NOT NULL,
  `bank_name` varchar(25) NOT NULL,
  `bank_ac_no` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `branch_code` varchar(15) NOT NULL,
  `particulars` text NOT NULL,
  `claim_status` varchar(10) NOT NULL,
  PRIMARY KEY (`claim_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `policy_withdrawal`
--

INSERT INTO `policy_withdrawal` (`claim_id`, `insurance_account_id`, `claim_type`, `claim_amt`, `claim_date`, `bank_name`, `bank_ac_no`, `branch`, `branch_code`, `particulars`, `claim_status`) VALUES
(7, 77, '', 127200.00, '2027-03-19', 'Corporation Bank', '20895674321', 'belman', '2089', 'Claim amount is paid', 'Completed'),
(8, 80, '', 127200.00, '2029-03-21', 'hjgjh', '8678', 'kjhkj', '98798', 'dwcs', 'Completed'),
(9, 81, '', 1272000.00, '2019-04-04', 'Corporation Bank', '435346346457', 'Belman', '2345', 'hgfghd', 'Completed'),
(10, 86, '', 106000.00, '2022-07-21', 'sm', '20895674321', 'Belman', '2345', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(10) NOT NULL AUTO_INCREMENT,
  `state` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state`, `status`) VALUES
(4, 'Karnataka', 'Inactive'),
(5, 'Maharashtra', 'Active'),
(6, 'Orissa', 'Active'),
(9, 'Kerala', 'Active'),
(10, 'UttarPradesh', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `tax_id` int(10) NOT NULL AUTO_INCREMENT,
  `premiumtype` varchar(20) NOT NULL,
  `tax_perc` float(10,2) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `premiumtype`, `tax_perc`) VALUES
(1, '', 12.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
