<?php

$SQL[] = "ALTER TABLE classifieds_categories ADD advert_types text;";
$SQL[] = "ALTER TABLE classifieds_fields MODIFY COLUMN group_id int(5) NOT NULL DEFAULT '0';";

$SQL[] = "UPDATE classifieds_categories SET advert_types ='*';";

$SQL[] = "CREATE TABLE classifieds_types (
  type_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(45) NOT NULL,
  sort_order smallint(5) unsigned DEFAULT NULL,
  show_badge tinyint(1) unsigned NOT NULL DEFAULT '0',
  badge_color enum('green','purple','grey','lightgrey','orange','red') NOT NULL,
  zero_text varchar(45) DEFAULT NULL,
  PRIMARY KEY (type_id)
);";

// Default Ad Types

$SQL[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (1,'For Sale',1,0,'green','Free');";
$SQL[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (2,'Wanted',2,1,'orange','Offers');";
$SQL[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (3,'Exchange',3,1,'purple',NULL);";

$SQL[] = "UPDATE classifieds_items SET advert_type ='1' WHERE advert_type = 'sale';";
$SQL[] = "UPDATE classifieds_items SET advert_type ='2' WHERE advert_type = 'wanted';";
$SQL[] = "UPDATE classifieds_items SET advert_type ='3' WHERE advert_type = 'exchange';";

$SQL[] = "ALTER TABLE classifieds_items MODIFY COLUMN advert_type int(5) DEFAULT NULL;";

// New global custom fields and moving condition
$SQL[] = "UPDATE classifieds_categories SET fieldset_id = 0 WHERE fieldset_id = '';";

?>
