<?php
/*
*
*  (SN) PM Viewer 1.6.1
*  SQL queries to be run upon upgrade
*
*/

$SQL[] = "UPDATE core_applications SET app_public_title = 'pmviewer' WHERE app_directory = 'pmviewer'";
$SQL[] = "UPDATE core_applications SET app_hide_tab = 1 WHERE app_directory = 'pmviewer'";

?>