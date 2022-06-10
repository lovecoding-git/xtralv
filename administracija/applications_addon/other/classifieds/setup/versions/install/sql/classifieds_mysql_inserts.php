<?php
/**
* Installation Schematic File
*/
$INSERT[] = "INSERT INTO classifieds_categories (category_id, parent_id, lft, rgt, name, sort_order, depth, seo_title, advert_types) VALUES(1,0,1,2,'Root',NULL,1, 'root', '*');";

// Default Ad Types

$INSERT[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (1,'For Sale',1,0,'green','Free');";
$INSERT[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (2,'Wanted',2,1,'orange','Offers');";
$INSERT[] = "INSERT INTO classifieds_types (type_id, name, sort_order, show_badge, badge_color, zero_text) values (3,'Exchange',3,1,'purple',NULL);";


// Add entry for report center
$INSERT[] = "INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd, app) values(1,'Classifieds Plugin','Allows Classified items to be reported.','Andrew Millne','','v1.0','classifieds','','','N;',0,'classifieds');";

?>