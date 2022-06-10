<?php
/*
*
*  (SN) PM Viewer 1.6.0
*  SQL queries to be run upon upgrade
*
*/

$SQL[] = "ALTER TABLE pmviewer_message_posts MODIFY msg_ip_address varchar(46)";

?>