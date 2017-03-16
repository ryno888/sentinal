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

-- Dumping structure for table loc_sentinal.observation
DROP TABLE IF EXISTS `observation`;
CREATE TABLE IF NOT EXISTS `observation` (
  `obs_id` int(11) NOT NULL AUTO_INCREMENT,
  `obs_ref_person` int(11) DEFAULT NULL,
  `obs_term` tinyint(4) DEFAULT '0',
  `obs_type` tinyint(4) DEFAULT '0',
  `obs_value` varchar(256) DEFAULT '',
  PRIMARY KEY (`obs_id`),
  KEY `fk_obs_ref_person` (`obs_ref_person`),
  CONSTRAINT `fk_obs_ref_person` FOREIGN KEY (`obs_ref_person`) REFERENCES `person` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table loc_sentinal.observation_item
DROP TABLE IF EXISTS `observation_item`;
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
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
