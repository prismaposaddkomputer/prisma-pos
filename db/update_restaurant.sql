ALTER TABLE `res_item`
	ADD COLUMN `tax_name` VARCHAR(50) NOT NULL AFTER `tax_id`,
	ADD COLUMN `tax_ratio` FLOAT(10,2) NOT NULL AFTER `tax_name`;
