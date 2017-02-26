-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table loc_sentinal.address
DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `add_id` int(11) DEFAULT NULL,
  `add_ref_person` int(11) DEFAULT NULL,
  `add_number` varchar(256) DEFAULT '',
  `add_street_name` varchar(256) DEFAULT '',
  `add_suburb` varchar(256) DEFAULT '',
  `add_city` varchar(256) DEFAULT '',
  `add_code` varchar(256) DEFAULT '',
  KEY `fk_add_ref_person` (`add_ref_person`),
  CONSTRAINT `fk_add_ref_person` FOREIGN KEY (`add_ref_person`) REFERENCES `person` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.file
DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `fil_id` int(11) NOT NULL AUTO_INCREMENT,
  `fil_data` blob,
  `fil_name` varchar(256) DEFAULT '',
  `fil_path` varchar(256) DEFAULT '',
  `fil_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`fil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.person
DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `per_id` int(11) NOT NULL AUTO_INCREMENT,
  `per_type` tinyint(4) NOT NULL DEFAULT '0',
  `per_gender` tinyint(4) NOT NULL DEFAULT '0',
  `per_firstname` varchar(256) NOT NULL DEFAULT '',
  `per_lastname` varchar(256) NOT NULL DEFAULT '',
  `per_cemis_nr` varchar(256) NOT NULL DEFAULT '',
  `per_name` varchar(256) NOT NULL DEFAULT '',
  `per_email` varchar(256) NOT NULL DEFAULT '',
  `per_telnr` varchar(256) NOT NULL DEFAULT '',
  `per_cellnr` varchar(256) NOT NULL DEFAULT '',
  `per_username` varchar(256) NOT NULL DEFAULT '',
  `per_password` varchar(256) NOT NULL DEFAULT '',
  `per_online` tinyint(4) NOT NULL DEFAULT '0',
  `per_date_created` datetime DEFAULT NULL,
  `per_birthday` date DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.person_role
DROP TABLE IF EXISTS `person_role`;
CREATE TABLE IF NOT EXISTS `person_role` (
  `pel_id` int(11) NOT NULL AUTO_INCREMENT,
  `pel_ref_person` int(11) DEFAULT NULL,
  `pel_ref_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`pel_id`),
  KEY `fk_pel_ref_person` (`pel_ref_person`),
  KEY `fk_pel_ref_role` (`pel_ref_role`),
  CONSTRAINT `fk_pel_ref_person` FOREIGN KEY (`pel_ref_person`) REFERENCES `person` (`per_id`),
  CONSTRAINT `fk_pel_ref_role` FOREIGN KEY (`pel_ref_role`) REFERENCES `role` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_code` varchar(256) NOT NULL DEFAULT '',
  `rol_level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
