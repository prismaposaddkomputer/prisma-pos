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
