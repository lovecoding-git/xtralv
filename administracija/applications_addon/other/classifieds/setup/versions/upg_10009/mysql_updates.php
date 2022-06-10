<?php

$SQL[]	= "CREATE TABLE classifieds_field_sets (
  set_id int(5) NOT NULL AUTO_INCREMENT,
  name varchar(45) DEFAULT NULL,
  PRIMARY KEY (set_id)
);";

$SQL[] = "CREATE TABLE classifieds_images (
  item_id int(12) NOT NULL,
  attach_id int(12) NOT NULL,
  thumb_location varchar(255) NOT NULL,
  med_location varchar(255) NOT NULL,
  full_location varchar(255) NOT NULL,
  PRIMARY KEY (attach_id)
);";


$SQL[] = "ALTER TABLE classifieds_items ALTER COLUMN active SET DEFAULT 0;";
$SQL[] = "ALTER TABLE classifieds_field_groups ADD set_id INT(5) NOT NULL;";
$SQL[] = "ALTER TABLE classifieds_fields ADD set_id INT(5) NOT NULL;";
$SQL[] = "ALTER TABLE classifieds_field_entries MODIFY COLUMN value VARCHAR(255);";
$SQL[] = "ALTER TABLE classifieds_categories ADD fieldset_id INT(5) NULL;";

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key IN('classifieds_thumbnail_width', 'classifieds_thumbnail_height', 'classifieds_ad_expiry_interval', 'classifieds_currency_symbol');";


?>
