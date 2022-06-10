<?php
/*
*
*  (SN) PM Viewer 1.2.0
*  SQL queries to be run upon upgrade
*
*/

$SQL[] = "ALTER TABLE message_topics ADD pmviewer_hide TINYINT( 1 ) NOT NULL DEFAULT '0'";

?>