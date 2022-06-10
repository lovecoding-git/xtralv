<?php

$SQL   = array();
$SQL[] = "ALTER TABLE forums ADD COLUMN ipseo_priority VARCHAR(3) NOT NULL DEFAULT '';";

$SQL[] = "CREATE TABLE seo_acronyms (
  a_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  a_short varchar(255) DEFAULT NULL,
  a_long varchar(255) DEFAULT NULL,
  a_semantic tinyint(1) DEFAULT NULL,
  PRIMARY KEY (a_id),
  KEY a_short (a_short)
);";
