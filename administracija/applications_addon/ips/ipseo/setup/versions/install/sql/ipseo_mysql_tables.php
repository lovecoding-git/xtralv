<?php
/**
* Installation Schematic File
*/

$TABLE[] = "CREATE TABLE search_visitors (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` int(11),
  `date` int(11) NOT NULL DEFAULT '0',
  `engine` varchar(50) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `url` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_date_engine` (`date`,`engine`)
)";

$TABLE[] = "CREATE TABLE search_keywords (
  `keyword` varchar(250) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_keyword_unq` (`keyword`),
  KEY `idx_kw_cnt` (`keyword`,`count`)
)";

$TABLE[] = "CREATE TABLE seo_meta (
  `url` varchar(255) NOT NULL DEFAULT '*',
  `name` varchar(50) NOT NULL DEFAULT '',
  `content` text NOT NULL
)";

$TABLE[] = "CREATE TABLE seo_acronyms (
  a_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  a_short varchar(255) DEFAULT NULL,
  a_long varchar(255) DEFAULT NULL,
  a_semantic tinyint(1) DEFAULT NULL,
  PRIMARY KEY (a_id),
  KEY a_short (a_short)
)";
