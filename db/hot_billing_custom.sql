-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for prisma_pos
CREATE DATABASE IF NOT EXISTS `prisma_pos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `prisma_pos`;

-- Dumping structure for table prisma_pos.hot_billing_custom
CREATE TABLE IF NOT EXISTS `hot_billing_custom` (
  `billing_custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL DEFAULT '0',
  `custom_id` int(11) NOT NULL,
  `custom_name` varchar(128) NOT NULL,
  `custom_charge` float(10,2) NOT NULL,
  `custom_amount` float(10,2) NOT NULL,
  `custom_subtotal` float(10,2) NOT NULL,
  `custom_tax` float(10,2) NOT NULL,
  `custom_total` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(20) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table prisma_pos.hot_billing_custom: ~1 rows (approximately)
DELETE FROM `hot_billing_custom`;
/*!40000 ALTER TABLE `hot_billing_custom` DISABLE KEYS */;
INSERT INTO `hot_billing_custom` (`billing_custom_id`, `billing_id`, `custom_id`, `custom_name`, `custom_charge`, `custom_amount`, `custom_subtotal`, `custom_tax`, `custom_total`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	(2, 4, 99, 'telo', 2500.00, 5.00, 12500.00, 0.00, 12500.00, '2018-12-18 11:37:28', 'Super Hotel', '0000-00-00 00:00:00', 'System', 1, 0);
/*!40000 ALTER TABLE `hot_billing_custom` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
