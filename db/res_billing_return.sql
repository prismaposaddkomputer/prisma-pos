-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table prisma_pos.res_billing_detail
DROP TABLE IF EXISTS `res_billing_detail`;
CREATE TABLE IF NOT EXISTS `res_billing_detail` (
  `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tx_id` int(11) NOT NULL,
  `tx_type` varchar(3) NOT NULL,
  `item_id` int(11) NOT NULL,
  `is_custom` tinyint(1) NOT NULL DEFAULT '0',
  `item_name` varchar(128) NOT NULL,
  `item_price_before_tax` float(10,2) NOT NULL,
  `item_price_after_tax` float(10,2) NOT NULL,
  `item_price_buy_average` float(10,2) NOT NULL,
  `tx_amount` float NOT NULL,
  `tx_subtotal_tax` float(10,2) NOT NULL,
  `tx_subtotal_discount` float(10,2) NOT NULL,
  `tx_subtotal_buy_average` float(10,2) NOT NULL,
  `tx_subtotal_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_after_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_before_tax` float(10,2) NOT NULL,
  `tx_subtotal_profit_after_tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(128) NOT NULL DEFAULT 'System',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`billing_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
