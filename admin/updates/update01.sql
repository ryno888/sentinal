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


-- Dumping structure for table loc_sentinal.calendar
CREATE TABLE IF NOT EXISTS `calendar` (
	`cal_id` INT(11) NOT NULL AUTO_INCREMENT,
	`cal_name` VARCHAR(256) NULL DEFAULT '',
	`cal_description` TEXT NULL,
	`cal_starttime` DATETIME NULL DEFAULT NULL,
	`cal_endtime` DATETIME NULL DEFAULT NULL,
	`cal_options` TEXT NULL,
	`cal_all_day_event` TINYINT(4) NULL DEFAULT '0',
	PRIMARY KEY (`cal_id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.file
CREATE TABLE IF NOT EXISTS `file` (
  `fil_id` int(11) NOT NULL AUTO_INCREMENT,
  `fil_data` blob,
  `fil_name` varchar(256) DEFAULT '',
  `fil_path` varchar(256) DEFAULT '',
  `fil_date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`fil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.grade
CREATE TABLE IF NOT EXISTS `grade` (
  `grd_id` int(11) NOT NULL AUTO_INCREMENT,
  `grd_name` varchar(256) DEFAULT '',
  PRIMARY KEY (`grd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.intervention
CREATE TABLE IF NOT EXISTS `intervention` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `int_year` year(4) DEFAULT NULL,
  `int_remark` text,
  `int_type` tinyint(4) DEFAULT '0',
  `int_ref_person` int(11) DEFAULT NULL,
  PRIMARY KEY (`int_id`),
  KEY `fk_int_ref_person` (`int_ref_person`),
  CONSTRAINT `fk_int_ref_person` FOREIGN KEY (`int_ref_person`) REFERENCES `person` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.observation
CREATE TABLE IF NOT EXISTS `observation` (
  `obs_id` int(11) NOT NULL AUTO_INCREMENT,
  `obs_ref_person` int(11) DEFAULT NULL,
  `obs_term` tinyint(4) DEFAULT '0',
  `obs_info_evening` tinyint(4) DEFAULT '0',
  `obs_report_discuss` tinyint(4) DEFAULT '0',
  `obs_other_meetings` tinyint(4) DEFAULT '0',
  `obs_message_book_signed` tinyint(4) DEFAULT '0',
  `obs_work_book_signed` tinyint(4) DEFAULT '0',
  `obs_homework` tinyint(4) DEFAULT '0',
  `obs_discipline` tinyint(4) DEFAULT '0',
  `obs_adjustment` tinyint(4) DEFAULT '0',
  `obs_neatness` tinyint(4) DEFAULT '0',
  `obs_days_absent` int(11) DEFAULT '0',
  `obs_other_info` text,
  PRIMARY KEY (`obs_id`),
  KEY `fk_obs_ref_person` (`obs_ref_person`),
  CONSTRAINT `fk_obs_ref_person` FOREIGN KEY (`obs_ref_person`) REFERENCES `person` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.observation_item
CREATE TABLE IF NOT EXISTS `observation_item` (
  `obv_id` int(11) NOT NULL AUTO_INCREMENT,
  `obv_content` text NOT NULL,
  `obv_date` datetime DEFAULT NULL,
  `obv_ref_observation` int(11) DEFAULT NULL,
  PRIMARY KEY (`obv_id`),
  KEY `fk_obv_ref_observation` (`obv_ref_observation`),
  CONSTRAINT `fk_obv_ref_observation` FOREIGN KEY (`obv_ref_observation`) REFERENCES `observation` (`obs_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.person
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
  `per_birthday` datetime DEFAULT NULL,
  `per_year_in_class` year(4) DEFAULT NULL,
  `per_grade` tinyint(4) DEFAULT '0',
  `per_previous_grade` tinyint(4) DEFAULT '0',
  `per_grade_repeated` tinyint(4) DEFAULT '0',
  `per_year_in_phase` varchar(256) DEFAULT '',
  `per_prev_school` varchar(256) DEFAULT '',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.person_role
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
CREATE TABLE IF NOT EXISTS `role` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_name` varchar(256) DEFAULT '',
  `rol_code` varchar(256) NOT NULL DEFAULT '',
  `rol_level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.student_details
CREATE TABLE IF NOT EXISTS `student_details` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_parent_firstname` varchar(256) DEFAULT '',
  `stu_parent_lastname` varchar(256) DEFAULT '',
  `stu_contact_number` varchar(256) DEFAULT '',
  `stu_email` varchar(256) DEFAULT '',
  `stu_type` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


INSERT INTO `person` (`per_type`, `per_gender`, `per_firstname`, `per_lastname`, `per_cemis_nr`, `per_name`, `per_email`, `per_telnr`, `per_cellnr`, `per_username`, `per_password`, `per_online`, `per_date_created`, `per_birthday`, `per_year_in_class`, `per_grade`, `per_previous_grade`, `per_grade_repeated`, `per_year_in_phase`, `per_prev_school`) VALUES (0, 1, 'Ryno', 'van Zyl', '15464', 'van Zyl, Ryno', 'ryno888@gmail.com', '', '', 'admin', 'lJKFKZVnvFS1wHZMU+0QVi7VAZg0DaHRl/gwU02low3Op2Pa1Tero1CXH+rFe0kQVIzfJ38ArGenOvxNm/vNeQ==', 0, NULL, NULL, NULL, 0, 0, 0, '', '');
