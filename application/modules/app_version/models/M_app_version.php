<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_app_version extends CI_Model {

  public function get_last()
  {
    return $this->db->order_by('version_now','DESC')->get('app_version')->row();
  }

  public function update_version($ver)
  {
    switch ($ver['version_now']) {
      case '1.1':
        //Drop db app_version_update
        $this->db->query("DROP TABLE IF EXISTS app_version_update");

        //alter db app_version
        $this->db->query("ALTER TABLE `app_version`
        	ADD COLUMN `version_id` INT NOT NULL AUTO_INCREMENT FIRST,
        	ADD COLUMN `version_release` TIMESTAMP NULL DEFAULT NULL AFTER `version_now`,
        	ADD COLUMN `version_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `version_release`,
        	ADD PRIMARY KEY (`version_id`);
        ");
        //update first version
        $this->db->query("UPDATE app_version SET version_release='2018-07-05 18:00:00' WHERE version_now='1.0'");
        break;

      case '1.2':
        //Drop db if exsit
        $this->db->query("DROP TABLE IF EXISTS `hot_tax`");
        //make table
        $this->db->query(
          "CREATE TABLE IF NOT EXISTS `hot_tax` (
            `tax_id` int(11) NOT NULL AUTO_INCREMENT,
            `tax_code` varchar(15) NOT NULL,
            `tax_name` varchar(128) NOT NULL,
            `tax_ratio` float(10,2) NOT NULL COMMENT 'in percent',
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` varchar(32) NOT NULL DEFAULT 'System',
            `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            `updated_by` varchar(32) NOT NULL DEFAULT 'System',
            `is_active` tinyint(1) NOT NULL DEFAULT '1',
            `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`tax_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT"
        );
        //empty table
        $this->db->query("DELETE FROM `par_tax`");
        //insert tax hotel
        $this->db->query(
          "INSERT INTO `hot_tax` (`tax_id`, `tax_code`, `tax_name`, `tax_ratio`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
        	(1, '1.1.1.01.05\r\n', 'Pajak Hotel', 10.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0)"
        );

        break;

      case '1.3':
        $this->db->query(
          "INSERT INTO `par_tax` (`tax_id`, `tax_code`, `tax_name`, `tax_ratio`, `created`, `created_by`, `updated`, `updated_by`, `is_active`, `is_deleted`) VALUES
	          (1, '1.1.1.07.01\r\n', 'Pajak Parkir', 15.00, '2018-07-05 09:49:40', 'System', '0000-00-00 00:00:00', 'System', 1, 0)
        ");
        break;

      case '1.4':
        //add status posting and posting date in db.
        //retail
        $this->db->query(
          "ALTER TABLE `ret_billing`
	         ADD COLUMN `posting_st` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`,
	          ADD COLUMN `posting_date` DATETIME NULL DEFAULT NULL AFTER `posting_st`"
        );
        //restaurant
        $this->db->query(
          "ALTER TABLE `res_billing`
	         ADD COLUMN `posting_st` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`,
	          ADD COLUMN `posting_date` DATETIME NULL DEFAULT NULL AFTER `posting_st`"
        );
        //hotel
        $this->db->query(
          "ALTER TABLE `hot_payment`
	         ADD COLUMN `posting_st` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`,
	          ADD COLUMN `posting_date` DATETIME NULL DEFAULT NULL AFTER `posting_st`"
        );
        //karaoke
        $this->db->query(
          "ALTER TABLE `kar_billing`
	         ADD COLUMN `posting_st` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`,
	          ADD COLUMN `posting_date` DATETIME NULL DEFAULT NULL AFTER `posting_st`"
        );
        //parking
        $this->db->query(
          "ALTER TABLE `par_billing`
	         ADD COLUMN `posting_st` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_deleted`,
	          ADD COLUMN `posting_date` DATETIME NULL DEFAULT NULL AFTER `posting_st`"
        );
        break;

      case '1.5':
        // add logo field
        // retail
        $this->db->query(
          "ALTER TABLE `ret_client`
	         ADD COLUMN `client_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `client_keyboard_status`"
        );
        // restaurant
        $this->db->query(
          "ALTER TABLE `res_client`
	         ADD COLUMN `client_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `client_keyboard_status`"
        );
        // hotel
        $this->db->query(
          "ALTER TABLE `hot_client`
	         ADD COLUMN `client_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `client_keyboard_status`"
        );
        // karaoke
        $this->db->query(
          "ALTER TABLE `kar_client`
	         ADD COLUMN `client_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `client_keyboard_status`"
        );
        //parking
        $this->db->query(
          "ALTER TABLE `par_client`
	         ADD COLUMN `client_logo` VARCHAR(255) NULL DEFAULT NULL AFTER `client_keyboard_status`"
        );
        break;

      case '1.6':
        $this->db->query(
          "ALTER TABLE hot_payment ADD COLUMN IF NOT EXISTS bayar int(155) after grand_total"
        );
        $this->db->query(
          "ALTER TABLE hot_payment ADD COLUMN IF NOT EXISTS sisa int(155) after bayar"
        );
        break;

      case '1.7':
        // Empty Data
        $this->db->query("DELETE FROM `res_permission`");
        // Reset auto increment
        $this->db->query("ALTER TABLE res_permission AUTO_INCREMENT = 1");
        // Insert data permission
        $this->db->query("INSERT INTO `res_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created_by`) VALUES
        	(NULL, 0, '01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.04', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.05', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.06', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.07', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '02.08', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '03.01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '03.02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '03.03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04.01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04.02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04.03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04.04', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '04.05', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.04', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.05', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.06', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.07', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.08', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.09', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.10', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '05.11', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.01', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.02', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.03', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.04', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.05', 1, 1, 1, 1, 'System'),
        	(NULL, 0, '99.06', 1, 1, 1, 1, 'System'),
          (NULL, 1, '01', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.01', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.02', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.04', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.05', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.06', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '02.08', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '03.01', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '03.02', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '03.03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04.01', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04.02', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04.03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04.04', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '04.05', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.01', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.02', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.04', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.05', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.06', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.07', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.08', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.09', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.10', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '05.11', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '99', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '99.03', 1, 1, 1, 1, 'System'),
        	(NULL, 1, '99.05', 1, 1, 1, 1, 'System'),
          (NULL, 2, '01', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '03', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '03.01', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '03.02', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '03.03', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '05', 1, 1, 1, 1, 'System'),
        	(NULL, 2, '05.04', 1, 1, 1, 1, 'System')
        ");
        break;

      case '1.8':
        // add column in res_item
        $this->db->query("ALTER TABLE `res_item`
          ADD COLUMN `item_tax` FLOAT(10,2) NOT NULL AFTER `item_price_before_tax`,
          ADD COLUMN `item_price_after_tax` FLOAT(10,2) NOT NULL AFTER `item_tax`
        ");
        break;

      case '1.9':
        // alter table for tax in hotel
        $this->db->query("ALTER TABLE hot_category
          ADD COLUMN IF NOT EXISTS
          status int(155)
        ");
        $this->db->query("ALTER TABLE hot_category
          ADD COLUMN IF NOT EXISTS
          before_tax int(155)
        ");
        $this->db->query("ALTER TABLE hot_category
          ADD COLUMN IF NOT EXISTS
          tax int(155)
        ");
        $this->db->query("ALTER TABLE hot_category
          ADD COLUMN IF NOT EXISTS
          after_tax int(155)
        ");
        break;

      case '2.0':
        //add column for setting in receipt
        $this->db->query("ALTER TABLE `ret_client`
          ADD COLUMN `client_receipt_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`
        ");
        $this->db->query("ALTER TABLE `res_client`
          ADD COLUMN `client_receipt_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`
        ");
         $this->db->query("ALTER TABLE `hot_client`
          ADD COLUMN `client_receipt_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`
        ");
        $this->db->query("ALTER TABLE `kar_client`
          ADD COLUMN `client_receipt_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`
        ");
         $this->db->query("ALTER TABLE `par_client`
          ADD COLUMN `client_receipt_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`
        ");
        break;

      case '2.1':
        //menambah kolom di hot_category
        $this->db->query("ALTER TABLE hot_category
          ADD COLUMN IF NOT EXISTS
          service_hotel int(155)
        ");
        // menambah kolom di hot service
        $this->db->query("ALTER TABLE hot_service
          ADD COLUMN IF NOT EXISTS
          status int(155)
        ");  
        $this->db->query("ALTER TABLE hot_service
          ADD COLUMN IF NOT EXISTS
          before_tax int(155)
        ");
        $this->db->query("ALTER TABLE hot_service
          ADD COLUMN IF NOT EXISTS
          before_tax int(155)
        ");
        $this->db->query("ALTER TABLE hot_service
          ADD COLUMN IF NOT EXISTS
          after_tax int(155)
        ");
        $this->db->query("ALTER TABLE hot_service
          ADD COLUMN IF NOT EXISTS
          service_hotel int(155)
        ");
        // Merubah nama modul
        $this->db->query("UPDATE `prisma_pos`.`hot_module` 
          SET `module_name`='Biaya Lain-lain' 
          WHERE  `module_id`='02.03'
        ");
        // nambah kolom
        $this->db->query("ALTER TABLE hot_diskon
          ADD COLUMN IF NOT EXISTS
          nominal int(155)
        ");
        // ganti tipe data guest
        $this->db->query("ALTER TABLE `hot_guest`
        	ALTER `guest_phone` DROP DEFAULT
        ");
        $this->db->query("ALTER TABLE `hot_guest`
          CHANGE COLUMN `guest_phone` `guest_phone` VARCHAR(50) NOT NULL AFTER `guest_number`
        ");
        // nambah kolom hot payment
        $this->db->query("ALTER TABLE hot_payment
          ADD COLUMN IF NOT EXISTS
          status int(155)
        ");
        break;

      case '2.2.1':
        // Make a new module for hotel
        // Empty table
        $this->db->query("DELETE FROM `hot_module`");
        // Populate new menus
        $this->db->query("INSERT INTO `hot_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`, `module_icon`, `created`, `created_by`, `updated`, `updated_by`, `is_actived`, `is_deleted`) VALUES
          ('01', '', 'Dashboard', 'hot_dashboard', 'hot_dashboard', 'index', 'dashboard', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02', '', 'Master', '', '', '#', 'cubes', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.01', '02', 'Jenis Biaya', 'hot_charge_type', 'hot_charge_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.02', '02', 'Tipe Kamar', 'hot_room_type', 'hot_room_type', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.03', '02', 'Kamar', 'hot_room', 'hot_room', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.04', '02', 'Member', 'hot_member', 'hot_member', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.05', '02', 'Tamu', 'hot_guest', 'hot_guest', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.06', '02', 'Pelayanan', 'hot_service', 'hot_service', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.07', '02', 'Ekstra', 'hot_extra', 'hot_extra', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.08', '02', 'FnB', 'hot_fnb', 'hot_fnb', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('02.09', '02', 'Diskon', 'hot_discount', 'hot_discount', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('03', '', 'Reservasi', 'hot_reservation', 'hot_reservation', 'index', 'address-book-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('04', '', 'Laporan', '', '', '#', 'files-o', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('04.01', '04', 'Laporan Reservasi (semua)', 'hot_report_reservation', 'hot_report_reservation', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('04.02', '04', 'Laporan Reservasi  (resepsionis)', 'hot_report_receptionist', 'hot_report_receptionist', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('04.03', '04', 'Laporan Pembayaran', 'hot_report_payment', 'hot_report_payment', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('04.04', '04', 'Laporan Piutang', 'hot_report_credit', 'hot_report_credit', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99', '', 'Pengaturan', '', '', '#', 'gears', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99.01', '99', 'Modul', 'hot_module', 'hot_module', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99.02', '99', 'Role', 'hot_role', 'hot_role', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99.03', '99', 'Pengguna', 'hot_user', 'hot_user', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99.04', '99', 'Hak Akses', 'hot_permission', 'hot_permission', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0),
          ('99.05', '99', 'Client', 'hot_client', 'hot_client', 'index', '', '2018-08-18 05:51:24', '', '2018-08-18 05:51:24', '', 0, 0)
        ");
        break;

      case '2.2.2':
        // Set permission for hotel role
        // Empty table
        $this->db->query("DELETE FROM `hot_permission`");
        // Reset autoincrement
        $this->db->query("ALTER TABLE `hot_permission` AUTO_INCREMENT=1");
        // Insert rule
        $this->db->query("INSERT INTO `hot_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created_by`) VALUES
          (NULL, 0, '01', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.01', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.02', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.03', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.04', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.05', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.06', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.07', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.08', 1, 1, 1, 1, 'System'),
          (NULL, 0, '02.09', 1, 1, 1, 1, 'System'),
          (NULL, 0, '03', 1, 1, 1, 1, 'System'),
          (NULL, 0, '04', 1, 1, 1, 1, 'System'),
          (NULL, 0, '04.01', 1, 1, 1, 1, 'System'),
          (NULL, 0, '04.02', 1, 1, 1, 1, 'System'),
          (NULL, 0, '04.03', 1, 1, 1, 1, 'System'),
          (NULL, 0, '04.04', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99.01', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99.02', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99.03', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99.04', 1, 1, 1, 1, 'System'),
          (NULL, 0, '99.05', 1, 1, 1, 1, 'System'),
          (NULL, 1, '01', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.01', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.02', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.03', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.04', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.05', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.06', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.07', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.08', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.09', 1, 1, 1, 1, 'System'),
          (NULL, 1, '03', 1, 1, 1, 1, 'System'),
          (NULL, 1, '04', 1, 1, 1, 1, 'System'),
          (NULL, 1, '04.01', 1, 1, 1, 1, 'System'),
          (NULL, 1, '04.02', 1, 1, 1, 1, 'System'),
          (NULL, 1, '04.03', 1, 1, 1, 1, 'System'),
          (NULL, 1, '04.04', 1, 1, 1, 1, 'System'),
          (NULL, 1, '99', 1, 1, 1, 1, 'System'),
          (NULL, 1, '99.03', 1, 1, 1, 1, 'System'),
          (NULL, 1, '99.05', 1, 1, 1, 1, 'System'),
          (NULL, 3, '01', 1, 1, 1, 1, 'System'),
          (NULL, 3, '03', 1, 1, 1, 1, 'System')
        ");
        break;

      case '2.2.3':
        // Delete column 
        $this->db->query("ALTER TABLE `hot_client`
          DROP COLUMN `client_receipt_is_taxed`");
        // Add new column
        $this->db->query("ALTER TABLE `hot_client`
	        ADD COLUMN `client_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_logo`");
        break;

      case '2.2.4':
        // Create table charge type
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_charge_type` (
            `charge_type_id` int(11) NOT NULL AUTO_INCREMENT,
            `charge_type_code` varchar(15) NOT NULL,
            `charge_type_name` varchar(128) NOT NULL,
            `charge_type_ratio` float(10,2) NOT NULL DEFAULT '0.00',
            `charge_type_desc` varchar(128) NOT NULL,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` varchar(128) NOT NULL DEFAULT 'System',
            `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `updated_by` varchar(128) NOT NULL DEFAULT 'System',
            `is_active` tinyint(1) NOT NULL DEFAULT '1',
            `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`charge_type_id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"
        );
        // Empty table
        $this->db->query("DELETE FROM `hot_charge_type`");
        // insert table
        $this->db->query("INSERT INTO `hot_charge_type` (`charge_type_id`, `charge_type_code`, `charge_type_name`, `charge_type_ratio`, `charge_type_desc`) VALUES
          (1, '1.1.1.01.05', 'Pajak Hotel', 10.00, 'Pajak Daerah'),
          (2, 'SRV', 'Servis Hotel', 10.00, 'Biaya Servis')");
        break;

      case '2.2.5':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_room_type`;");
        // Room Type
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_room_type` (
          `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
          `room_type_name` varchar(128) NOT NULL,
          `room_type_charge` float(10,2) NOT NULL,
          `room_type_desc` varchar(128) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(128) NOT NULL DEFAULT 'System',
          `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(128) NOT NULL,
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`room_type_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        break;
      
      case '2.2.6':
        // Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_room`");
        // Make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_room` (
          `room_id` int(11) NOT NULL AUTO_INCREMENT,
          `room_type_id` int(11) NOT NULL DEFAULT '0',
          `room_no` varchar(10) NOT NULL DEFAULT '0',
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(128) NOT NULL DEFAULT 'System',
          `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(128) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        break;

      case '2.2.7':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_member`");
        // make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_member` (
          `member_id` int(11) NOT NULL,
          `member_name` varchar(128) NOT NULL,
          `member_phone` varchar(128) NOT NULL,
          `member_address` varchar(255) NOT NULL,
          `member_id_type` tinyint(1) NOT NULL DEFAULT '1',
          `member_id_no` varchar(20) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`member_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        break;

      case '2.2.8':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_guest`");
        // make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_guest` (
          `guest_id` int(11) NOT NULL,
          `guest_name` varchar(128) NOT NULL,
          `guest_phone` varchar(128) NOT NULL,
          `guest_address` varchar(255) NOT NULL,
          `guest_id_type` tinyint(1) NOT NULL DEFAULT '1',
          `guest_id_no` varchar(20) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`guest_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        break;

      case '2.2.9':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_service`");
        // make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_service` (
          `service_id` int(11) NOT NULL AUTO_INCREMENT,
          `service_name` varchar(128) NOT NULL,
          `service_charge` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(32) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(32) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`service_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT");
        break;

      case '2.3.0':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_extra`");
        // make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_extra` (
          `extra_id` int(11) NOT NULL AUTO_INCREMENT,
          `extra_name` varchar(128) NOT NULL,
          `extra_charge` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`extra_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT");
        break;

      case '2.3.1':
        //Drop table
        $this->db->query("DROP TABLE IF EXISTS `hot_discount`");
        // make new table
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_discount` (
          `discount_id` int(11) NOT NULL AUTO_INCREMENT,
          `discount_name` varchar(128) NOT NULL,
          `discount_type` tinyint(1) NOT NULL DEFAULT '1',
          `discount_amount` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`discount_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;");
        break;

      case '2.3.2':
        // Delete menu for member add menu for non-pajak
        $this->db->query("DELETE FROM hot_module WHERE module_id = '02.04'");
        // Add menu for non-tax
        $this->db->query("INSERT INTO `prisma_pos`.`hot_module` (`module_id`, `module_parent`, `module_name`, `module_folder`, `module_controller`, `module_url`) VALUES ('02.10', '02', 'Non Pajak', 'hot_non_tax', 'hot_non_tax', 'index')");
        // Add permission for superhotel
        $this->db->query("INSERT INTO `hot_permission` (`permission_id`, `role_id`, `module_id`, `_create`, `_read`, `_update`, `_delete`, `created_by`) VALUES
          (NULL, 0, '02.10', 1, 1, 1, 1, 'System'),
          (NULL, 1, '02.10', 1, 1, 1, 1, 'System')
        ");
        break;

      case '2.3.3':
        // Add biaya lain lain
        $this->db->query("INSERT INTO `prisma_pos`.`hot_charge_type` (`charge_type_code`, `charge_type_name`, `charge_type_ratio`, `charge_type_desc`) VALUES ('OTH', 'Biaya Lain-lain', '1', 'Biaya Lain-lain')");
        break;
      
      case '2.3.4':
        // Alter table room
        $this->db->query("ALTER TABLE `hot_room`
          ADD COLUMN `room_name` VARCHAR(50) NOT NULL DEFAULT '0' AFTER `room_type_id`
        ");
        break;

      case '2.3.5':
        $this->db->query("ALTER TABLE `hot_guest`
          ADD COLUMN `guest_type` TINYINT(1) NOT NULL DEFAULT '0' AFTER `guest_id`");
        $this->db->query("ALTER TABLE `hot_guest`
	        ADD COLUMN `guest_gender` CHAR(1) NOT NULL AFTER `guest_name`");
        break;

      case '2.3.6':
        // drop database hot_fnb
        $this->db->query("DROP TABLE IF EXISTS `hot_fnb`");
        //create database
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_fnb` (
            `fnb_id` int(11) NOT NULL AUTO_INCREMENT,
            `fnb_name` varchar(128) NOT NULL,
            `fnb_charge` float(10,2) NOT NULL,
            `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `created_by` varchar(32) NOT NULL DEFAULT 'System',
            `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
            `updated_by` varchar(32) NOT NULL DEFAULT 'System',
            `is_active` tinyint(1) NOT NULL DEFAULT '1',
            `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`fnb_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT
        ");
        break;
      
      case '2.3.7':
        // make guest autoincrement
        $this->db->query("ALTER TABLE `hot_guest`
	        CHANGE COLUMN `guest_id` `guest_id` INT(11) NOT NULL AUTO_INCREMENT FIRST");
        break;

      case '2.3.8':
        // Make hot_billing
        $this->db->query("DROP TABLE IF EXISTS `hot_billing`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing` (
          `billing_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_receipt_no` varchar(50) NOT NULL,
          `guest_type` tinyint(1) NOT NULL DEFAULT '0',
          `guest_id` int(11) NOT NULL,
          `guest_name` varchar(128) NOT NULL,
          `guest_gender` char(1) NOT NULL,
          `guest_phone` varchar(15) NOT NULL,
          `guest_id_type` tinyint(1) NOT NULL,
          `guest_id_no` varchar(20) NOT NULL,
          `user_id` int(11) NOT NULL,
          `user_realname` varchar(128) NOT NULL,
          `billing_date_in` date NOT NULL,
          `billing_time_in` time NOT NULL,
          `billing_date_out` date NOT NULL,
          `billing_time_out` time NOT NULL,
          `billing_num_day` int(11) NOT NULL,
          `billing_subtotal` float(10,2) NOT NULL,
          `billing_tax` float(10,2) NOT NULL,
          `billing_service` float(10,2) NOT NULL,
          `billing_other` float(10,2) NOT NULL,
          `billing_total` float(10,2) NOT NULL,
          `billing_payment_type` tinyint(1) NOT NULL,
          `billing_down_payment` float(10,2) NOT NULL,
          `billing_payment` float(10,2) NOT NULL,
          `billing_change` float(10,2) NOT NULL,
          `billing_cancel_note` varchar(128) NOT NULL,
          `billing_status` tinyint(1) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(50) NOT NULL,
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        // make billing_room
        $this->db->query("DROP TABLE IF EXISTS `hot_billing_room`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing_room` (
          `billing_room_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_id` int(11) NOT NULL DEFAULT '0',
          `room_id` int(11) NOT NULL,
          `room_name` varchar(128) NOT NULL,
          `room_type_id` int(11) NOT NULL,
          `room_type_name` varchar(128) NOT NULL,
          `room_type_charge` float(10,2) NOT NULL,
          `room_type_duration` float(10,2) NOT NULL,
          `room_type_subtotal` float(10,2) NOT NULL,
          `room_type_tax` float(10,2) NOT NULL,
          `room_type_service` float(10,2) NOT NULL,
          `room_type_other` float(10,2) NOT NULL,
          `room_type_total` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_room_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
        ");
        // billing extra
        $this->db->query("DROP TABLE IF EXISTS `hot_billing_extra`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing_extra` (
          `billing_extra_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_id` int(11) NOT NULL DEFAULT '0',
          `extra_id` int(11) NOT NULL,
          `extra_name` varchar(128) NOT NULL,
          `extra_charge` float(10,2) NOT NULL,
          `extra_amount` float(10,2) NOT NULL,
          `extra_subtotal` float(10,2) NOT NULL,
          `extra_tax` float(10,2) NOT NULL,
          `extra_total` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_extra_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;");
        // billing_service
        $this->db->query("DROP TABLE IF EXISTS `hot_billing_service`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing_service` (
          `billing_service_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_id` int(11) NOT NULL DEFAULT '0',
          `service_id` int(11) NOT NULL,
          `service_name` varchar(128) NOT NULL,
          `service_charge` float(10,2) NOT NULL,
          `service_amount` float(10,2) NOT NULL,
          `service_subtotal` float(10,2) NOT NULL,
          `service_tax` float(10,2) NOT NULL,
          `service_total` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_service_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;");
        // billing_fnb
        $this->db->query("DROP TABLE IF EXISTS `hot_billing_fnb`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing_fnb` (
          `billing_fnb_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_id` int(11) NOT NULL DEFAULT '0',
          `fnb_id` int(11) NOT NULL,
          `fnb_name` varchar(128) NOT NULL,
          `fnb_charge` float(10,2) NOT NULL,
          `fnb_amount` float(10,2) NOT NULL,
          `fnb_subtotal` float(10,2) NOT NULL,
          `fnb_tax` float(10,2) NOT NULL,
          `fnb_total` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_fnb_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT");
        break;

      case '2.3.9':
        // Non tax
        $this->db->query("DROP TABLE IF EXISTS `hot_non_tax`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_non_tax` (
          `non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
          `non_tax_name` varchar(128) NOT NULL,
          `non_tax_charge` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(32) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(32) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`non_tax_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT");
        break;
      
      case '2.4.0':
        // add auto increment 
        $this->db->query("ALTER TABLE `hot_extra`
	        CHANGE COLUMN `extra_id` `extra_id` INT(11) NOT NULL AUTO_INCREMENT FIRST");
        break;
      
      case '2.4.1':
        $this->db->query("DROP TABLE IF EXISTS `hot_billing_non_tax`");
        $this->db->query("CREATE TABLE IF NOT EXISTS `hot_billing_non_tax` (
          `billing_non_tax_id` int(11) NOT NULL AUTO_INCREMENT,
          `billing_id` int(11) NOT NULL DEFAULT '0',
          `non_tax_id` int(11) NOT NULL,
          `non_tax_name` varchar(128) NOT NULL,
          `non_tax_charge` float(10,2) NOT NULL,
          `non_tax_amount` float(10,2) NOT NULL,
          `non_tax_total` float(10,2) NOT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `created_by` varchar(50) NOT NULL DEFAULT 'System',
          `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `updated_by` varchar(20) NOT NULL DEFAULT 'System',
          `is_active` tinyint(1) NOT NULL DEFAULT '1',
          `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`billing_non_tax_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT");
        break;
      
      case '2.4.2':
        $this->db->query("ALTER TABLE `res_client`
	        CHANGE COLUMN `client_receipt_is_taxed` `client_is_taxed` TINYINT(1) NOT NULL DEFAULT '1' AFTER `client_keyboard_status`");
        break;
    }

    //insert new update history
    $this->db->insert('app_version',$ver);
  }

  public function version_check($app_version)
  {
    $check = $this->db
      ->where('version_now',$app_version)
      ->get('app_version')
      ->row();

    if ($check != null) {
      return 1;
    }else {
      return 0;
    }
  }

  public function do_update()
  {
    $version = array();
    array_push($version, array("version_now"=>"1.1","version_release"=>"2018-07-09 14:16:00"));
    array_push($version, array("version_now"=>"1.2","version_release"=>"2018-07-16 11:20:00"));
    array_push($version, array("version_now"=>"1.3","version_release"=>"2018-07-17 10:00:00"));
    array_push($version, array("version_now"=>"1.4","version_release"=>"2018-07-17 10:41:00"));
    array_push($version, array("version_now"=>"1.5","version_release"=>"2018-07-18 11:52:00"));
    array_push($version, array("version_now"=>"1.6","version_release"=>"2018-07-22 19:47:00"));
    array_push($version, array("version_now"=>"1.7","version_release"=>"2018-08-07 10:46:00"));
    array_push($version, array("version_now"=>"1.8","version_release"=>"2018-08-07 12:12:00"));
    array_push($version, array("version_now"=>"1.9","version_release"=>"2018-08-07 14:12:00"));
    array_push($version, array("version_now"=>"2.0","version_release"=>"2018-08-08 11:15:00"));
    array_push($version, array("version_now"=>"2.1","version_release"=>"2018-08-13 12:12:00"));
    // Repairing hotel module
    // Make new module
    array_push($version, array("version_now"=>"2.2.1","version_release"=>"2018-08-18 09:00:00"));
    // Set permission for certain role
    array_push($version, array("version_now"=>"2.2.2","version_release"=>"2018-08-20 09:00:00"));
    // Change table client_receipt_is_taxed to client_is_taxed
    array_push($version, array("version_now"=>"2.2.3","version_release"=>"2018-08-21 09:40:00"));
    // Table hot_charge_type
    array_push($version, array("version_now"=>"2.2.4","version_release"=>"2018-08-21 10:20:00"));
    // Table hot_room_type
    array_push($version, array("version_now"=>"2.2.5","version_release"=>"2018-08-21 10:20:00"));
    // Table hot_room
    array_push($version, array("version_now"=>"2.2.6","version_release"=>"2018-08-21 14:45:00"));
    // table hot_member
    array_push($version, array("version_now"=>"2.2.7","version_release"=>"2018-08-21 14:56:00"));
    // table hot_guest
    array_push($version, array("version_now"=>"2.2.8","version_release"=>"2018-08-21 14:56:00"));
    // table hot_service
    array_push($version, array("version_now"=>"2.2.9","version_release"=>"2018-08-21 15:13:00"));
    // table hot_extra
    array_push($version, array("version_now"=>"2.3.0","version_release"=>"2018-08-21 15:20:00"));
    // table hot_discount
    array_push($version, array("version_now"=>"2.3.1","version_release"=>"2018-08-22 08:30:00"));
    // new menu and add permission for non-tax and member
    array_push($version, array("version_now"=>"2.3.2","version_release"=>"2018-09-02 07:01:00"));
    // biaya lain-lain
    array_push($version, array("version_now"=>"2.3.3","version_release"=>"2018-09-02 07:58:00"));
    // alter room_name
    array_push($version, array("version_now"=>"2.3.4","version_release"=>"2018-09-02 08:07:00"));
    // alter guest_type
    array_push($version, array("version_now"=>"2.3.5","version_release"=>"2018-09-02 08:15:00"));
    // make table fnb
    array_push($version, array("version_now"=>"2.3.6","version_release"=>"2018-09-02 08:24:00"));
    // make table autoincrement
    array_push($version, array("version_now"=>"2.3.7","version_release"=>"2018-09-02 08:28:00"));
    // billing database
    array_push($version, array("version_now"=>"2.3.8","version_release"=>"2018-09-02 08:51:00"));
    // Non tax
    array_push($version, array("version_now"=>"2.3.9","version_release"=>"2018-09-02 08:56:00"));
    // autoincrement
    array_push($version, array("version_now"=>"2.4.0","version_release"=>"2018-09-02 12:19:00"));
    // non tax billing
    array_push($version, array("version_now"=>"2.4.1","version_release"=>"2018-09-04 18:57:00"));
    // change res _client
    array_push($version, array("version_now"=>"2.4.2","version_release"=>"2018-09-06 10:29:00"));

    foreach ($version as $key => $val) {
      //check version
      $check = null;
      $check = $this->version_check($val['version_now']);
      if ($check == 0) {
        //update version
        $this->update_version($val);
      }
    }
  }

}
