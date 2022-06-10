<?php
/**
* Installation Schematic File
*/
$TABLE[] = "CREATE TABLE classifieds_categories (
  category_id SMALLINT(5) NOT NULL AUTO_INCREMENT,
  parent_id SMALLINT(5) DEFAULT NULL,
  lft MEDIUMINT(8) NOT NULL,
  rgt MEDIUMINT(8) NOT NULL,
  name VARCHAR(255) NOT NULL,
  sort_order SMALLINT(5) DEFAULT NULL,
  depth SMALLINT(5) DEFAULT NULL,
  seo_title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  fieldset_id INT(5) DEFAULT NULL,
  advert_types text,
  PRIMARY KEY  (category_id),
  KEY parent (parent_id)
)";

$TABLE[] = "CREATE TABLE classifieds_items (
  item_id int(10) NOT NULL AUTO_INCREMENT,
  category_id smallint(5) NOT NULL,
  member_id mediumint(8) NOT NULL,
  name varchar(255) NOT NULL,
  description text,
  advert_type smallint(5) NOT NULL,
  price float(10,2) NOT NULL,
  date_added int(10) default NULL,
  date_updated int(10) NOT NULL,
  views int(10) NOT NULL default '0',
  attachments smallint(5) NOT NULL default '0',
  post_key varchar(32) default NULL,
  active tinyint(1) NOT NULL default '0',
  date_expiry int(10) NOT NULL,
  open tinyint(1) NOT NULL default '1',
  expired tinyint(1) NOT NULL default '0',
  seo_title VARCHAR(255) NOT NULL,
  package INT(5) NOT NULL,
  package_info TEXT NOT NULL,
  renewals INT(5) NOT NULL default '0',
  enhancements TEXT NOT NULL,
  featured tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (item_id),
  KEY category (category_id),
  KEY member_id (member_id)
)";

$TABLE[] = "CREATE TABLE classifieds_questions (
  question_id INT(12) NOT NULL AUTO_INCREMENT,
  item_id INT(10) NOT NULL,
  asker_id MEDIUMINT(8) NOT NULL,
  question TEXT NOT NULL,
  date_asked INT(10) NOT NULL,
  answer TEXT NOT NULL,
  date_answered INT(10) NOT NULL,
  is_public TINYINT(1) NOT NULL DEFAULT '0',
  post_key VARCHAR(32) NOT NULL,
  PRIMARY KEY (question_id),
  KEY item_id (item_id,asker_id)
)";

$TABLE[] = "CREATE TABLE classifieds_field_sets (
  set_id INT(5) NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (set_id)
);";

$TABLE[] = "CREATE TABLE classifieds_field_groups (
  group_id INT(5) NOT NULL AUTO_INCREMENT,
  set_id INT(5) NOT NULL,
  name VARCHAR(45) NOT NULL,
  sort_order INT(5) DEFAULT NULL,
  PRIMARY KEY  (group_id)
)";

$TABLE[] = "CREATE TABLE classifieds_fields (
  field_id INT(10) NOT NULL AUTO_INCREMENT,
  title VARCHAR(45) NOT NULL,
  description VARCHAR(255) DEFAULT NULL,
  required TINYINT(1) NOT NULL DEFAULT '0',
  max INT(5) DEFAULT NULL,
  min INT(5) DEFAULT NULL,
  type VARCHAR(45) NOT NULL DEFAULT 'input',
  sort_order INT(5) DEFAULT NULL,
  active TINYINT(1) NOT NULL DEFAULT '1',
  group_id INT(5) NOT NULL,
  set_id INT(5) NOT NULL,  
  options TEXT,
  PRIMARY KEY  (field_id)
)";

$TABLE[] = "CREATE TABLE classifieds_field_entries (
  field_entry_id INT(12) NOT NULL AUTO_INCREMENT,
  field_id INT(5) NOT NULL,
  value VARCHAR(255) NOT NULL,
  item_id INT(12) NOT NULL,
  PRIMARY KEY  (field_entry_id),
  KEY field_id (field_id)
)";

$TABLE[] ="CREATE TABLE classifieds_subscriptions (
  sub_id INT(10) NOT NULL AUTO_INCREMENT,
  sub_mid INT(10) NOT NULL DEFAULT '0',
  sub_type VARCHAR(25) NOT NULL DEFAULT 'item',
  sub_toid INT(10) NOT NULL DEFAULT '0',
  sub_added VARCHAR(13) NOT NULL DEFAULT '0',
  sub_last VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (sub_id),
  KEY sub_mid (sub_mid)
)";

$TABLE[] = "CREATE TABLE classifieds_packages (
  package_id smallint(5) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  sort_order smallint(5) DEFAULT NULL,
  price float(8,2) DEFAULT NULL,
  duration smallint(5) NOT NULL,
  enhancements text,
  description text,
  active tinyint(1) NOT NULL DEFAULT '0',
  renewal_price float(8,2) NOT NULL DEFAULT '0.00',
  max_renewals int(5) NOT NULL DEFAULT '0',
  tax_class int(5),
  member_groups text,
  pricing_format enum('flat','value') NOT NULL DEFAULT 'flat',
  rates text,
  PRIMARY KEY (package_id)
);";

$TABLE[] = "CREATE TABLE classifieds_images (
  item_id int(12) NOT NULL,
  attach_id int(12) NOT NULL,
  thumb_location varchar(255) NOT NULL,
  med_location varchar(255) NOT NULL,
  full_location varchar(255) NOT NULL,
  PRIMARY KEY (attach_id)
);";

$TABLE[] = "CREATE TABLE classifieds_field_sets (
  set_id int(5) NOT NULL AUTO_INCREMENT,
  name varchar(45) DEFAULT NULL,
  PRIMARY KEY (set_id)
);";

$TABLE[] = "CREATE TABLE classifieds_types (
  type_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(45) NOT NULL,
  sort_order smallint(5) unsigned DEFAULT NULL,
  show_badge tinyint(1) unsigned NOT NULL DEFAULT '0',
  badge_color enum('green','purple','grey','lightgrey','orange','red') NOT NULL,
  zero_text varchar(45) DEFAULT NULL,
  PRIMARY KEY (type_id)
);";


/* Alters */
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_can_access TINYINT(1) NOT NULL DEFAULT '1';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_can_list TINYINT(1) NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_can_open_close TINYINT(1) NOT NULL DEFAULT '1';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_can_edit_item TINYINT(1) NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_edit_time INT(10) NOT NULL DEFAULT '30';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_can_moderate TINYINT(1) NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_attach_per_item INT(10) NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD g_classifieds_attach_max INT(10) NOT NULL DEFAULT '0';";
?>