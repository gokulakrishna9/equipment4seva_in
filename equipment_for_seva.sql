-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2020 at 04:32 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equipment_for_seva`
--

-- --------------------------------------------------------

--
-- Table structure for table `caller_institution`
--

DROP TABLE IF EXISTS `caller_institution`;
CREATE TABLE IF NOT EXISTS `caller_institution` (
  `caller_institution_id` int(11) NOT NULL AUTO_INCREMENT,
  `caller_institution` varchar(100) NOT NULL,
  PRIMARY KEY (`caller_institution_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

DROP TABLE IF EXISTS `donors`;
CREATE TABLE IF NOT EXISTS `donors` (
  `donor_id` int(11) NOT NULL AUTO_INCREMENT,
  `donor_name` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(6) NOT NULL AUTO_INCREMENT,
  `equipment_type_id` int(3) DEFAULT NULL,
  `equipment_procurement_type_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `eq_name` varchar(100) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `mac_address` varchar(100) DEFAULT NULL,
  `asset_number` varchar(100) DEFAULT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `procured_by_id` int(11) DEFAULT NULL COMMENT 'Owner, map to vendor_id',
  `purchase_order_date` date DEFAULT NULL,
  `cost` int(9) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL COMMENT 'Map to vendor',
  `invoice_number` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `supply_date` date DEFAULT NULL,
  `installation_date` date DEFAULT NULL,
  `warranty_start_date` date DEFAULT NULL,
  `warranty_end_date` date DEFAULT NULL,
  `functional_status_id` tinyint(1) DEFAULT '1',
  `procurement_status_id` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`equipment_id`),
  KEY `equipment_procurement_type_id` (`equipment_procurement_type_id`),
  KEY `invoice_number` (`invoice_number`),
  KEY `donor_id` (`donor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 COMMENT='List of equipments in hospital';

-- --------------------------------------------------------

--
-- Table structure for table `equipment_accessory`
--

DROP TABLE IF EXISTS `equipment_accessory`;
CREATE TABLE IF NOT EXISTS `equipment_accessory` (
  `equipment_accessory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(11) NOT NULL,
  `accessory_name` varchar(50) NOT NULL,
  PRIMARY KEY (`equipment_accessory_id`),
  KEY `equipment_id` (`equipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_functional_status`
--

DROP TABLE IF EXISTS `equipment_functional_status`;
CREATE TABLE IF NOT EXISTS `equipment_functional_status` (
  `functional_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `working_status` varchar(300) NOT NULL,
  PRIMARY KEY (`functional_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_location_log`
--

DROP TABLE IF EXISTS `equipment_location_log`;
CREATE TABLE IF NOT EXISTS `equipment_location_log` (
  `equipment_location_log_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `delivery_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  PRIMARY KEY (`equipment_location_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_maintenance_contract`
--

DROP TABLE IF EXISTS `equipment_maintenance_contract`;
CREATE TABLE IF NOT EXISTS `equipment_maintenance_contract` (
  `amc_cmc_id` int(6) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `equipment_id` int(6) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `rate` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `vendor_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Maintenance contracts for equipments';

-- --------------------------------------------------------

--
-- Table structure for table `equipment_procurement_status`
--

DROP TABLE IF EXISTS `equipment_procurement_status`;
CREATE TABLE IF NOT EXISTS `equipment_procurement_status` (
  `equipment_procurement_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `procurement_status` varchar(30) NOT NULL,
  PRIMARY KEY (`equipment_procurement_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_procurement_type`
--

DROP TABLE IF EXISTS `equipment_procurement_type`;
CREATE TABLE IF NOT EXISTS `equipment_procurement_type` (
  `equipment_procurement_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `procurment_type` varchar(50) NOT NULL,
  PRIMARY KEY (`equipment_procurement_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_service_issue_type`
--

DROP TABLE IF EXISTS `equipment_service_issue_type`;
CREATE TABLE IF NOT EXISTS `equipment_service_issue_type` (
  `equipment_service_issue_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_service_issue_type` varchar(70) NOT NULL,
  PRIMARY KEY (`equipment_service_issue_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_service_record`
--

DROP TABLE IF EXISTS `equipment_service_record`;
CREATE TABLE IF NOT EXISTS `equipment_service_record` (
  `request_id` int(6) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(6) NOT NULL,
  `user_id` int(8) NOT NULL,
  `call_date` date DEFAULT NULL,
  `call_time` time DEFAULT NULL,
  `call_type` varchar(20) NOT NULL COMMENT 'Hardcoded, online, call, inperson',
  `service_issue_type_id` int(11) NOT NULL,
  `call_information` varchar(500) DEFAULT NULL,
  `caller_institution_id` int(10) NOT NULL,
  `contact_person` varchar(70) NOT NULL,
  `service_provider_id` varchar(50) DEFAULT NULL COMMENT 'vendor_id',
  `service_person` varchar(50) DEFAULT NULL,
  `service_person_phone` varchar(12) NOT NULL,
  `contact_person_phone` varchar(12) NOT NULL,
  `service_person_remarks` varchar(500) DEFAULT NULL,
  `issue_closure` datetime DEFAULT NULL,
  `working_status_id` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`request_id`),
  UNIQUE KEY `request_id` (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Service records log for equipments';

-- --------------------------------------------------------

--
-- Table structure for table `equipment_service_record_log`
--

DROP TABLE IF EXISTS `equipment_service_record_log`;
CREATE TABLE IF NOT EXISTS `equipment_service_record_log` (
  `service_record_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `status_note` varchar(500) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`service_record_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

DROP TABLE IF EXISTS `equipment_type`;
CREATE TABLE IF NOT EXISTS `equipment_type` (
  `equipment_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `equipment_type` varchar(200) NOT NULL,
  PRIMARY KEY (`equipment_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='List of equipment types';

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
CREATE TABLE IF NOT EXISTS `operator` (
  `operator_id` int(11) NOT NULL AUTO_INCREMENT,
  `operator_name` varchar(40) NOT NULL,
  `operator_brief` varchar(100) NOT NULL,
  `inserted_on` date NOT NULL,
  `updated_on` date NOT NULL,
  PRIMARY KEY (`operator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE IF NOT EXISTS `user_detail` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `password` varchar(150) NOT NULL,
  `inserted_on` date NOT NULL,
  `updated_on` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_operator_link`
--

DROP TABLE IF EXISTS `user_operator_link`;
CREATE TABLE IF NOT EXISTS `user_operator_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `inserted_on` date NOT NULL,
  `updated_on` date NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type_id` int(11) NOT NULL,
  `vendor_name` varchar(30) NOT NULL,
  `vendor_address` varchar(50) NOT NULL,
  `vendor_city` varchar(50) NOT NULL,
  `vendor_state` varchar(50) NOT NULL,
  `vendor_country` varchar(50) NOT NULL,
  `account_no` varchar(30) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `vendor_email` varchar(200) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `contact_person_id` int(11) NOT NULL COMMENT 'primary contact person',
  `vendor_pan` varchar(10) NOT NULL,
  PRIMARY KEY (`vendor_id`),
  KEY `vendor_type_id` (`vendor_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='List of vendors';

-- --------------------------------------------------------

--
-- Table structure for table `vendor_contracts`
--

DROP TABLE IF EXISTS `vendor_contracts`;
CREATE TABLE IF NOT EXISTS `vendor_contracts` (
  `contract_id` int(4) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(4) NOT NULL,
  `facility_id` int(4) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_type`
--

DROP TABLE IF EXISTS `vendor_type`;
CREATE TABLE IF NOT EXISTS `vendor_type` (
  `vendor_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type` varchar(50) NOT NULL,
  PRIMARY KEY (`vendor_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `fk_vendor_vendortype_vendor_type_id` FOREIGN KEY (`vendor_type_id`) REFERENCES `vendor_type` (`vendor_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
