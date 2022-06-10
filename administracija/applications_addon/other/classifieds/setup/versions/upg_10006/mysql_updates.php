<?php


$SQL[]	= "CREATE TABLE classifieds_packages (
  package_id smallint(5) NOT NULL AUTO_INCREMENT,
  name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  sort_order smallint(5) DEFAULT NULL,
  price float(8,2) DEFAULT NULL,
  duration smallint(5) NOT NULL,
  enhancements text COLLATE utf8_unicode_ci,
  description text COLLATE utf8_unicode_ci,
  active tinyint(1) NOT NULL DEFAULT '0',
  renewal_price float(8,2) NOT NULL DEFAULT '0.00',
  max_renewals int(5) NOT NULL DEFAULT '0',
  tax_class int(5),
  PRIMARY KEY (package_id)
);";


$SQL[] = "ALTER TABLE classifieds_categories ADD description TEXT NULL;";
$SQL[] = "ALTER TABLE classifieds_items ADD open TINYINT(1) NOT NULL default '1';";
$SQL[] = "ALTER TABLE classifieds_items ADD package INT(5) NOT NULL;";
$SQL[] = "ALTER TABLE classifieds_items ADD package_info TEXT NOT NULL;";
$SQL[] = "ALTER TABLE classifieds_items ADD renewals INT(5) NOT NULL default '0';";
$SQL[] = "ALTER TABLE classifieds_items ADD enhancements TEXT NOT NULL;";

?>
