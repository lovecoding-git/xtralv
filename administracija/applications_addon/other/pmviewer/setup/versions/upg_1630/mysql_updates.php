<?php
/*
*
*  (SN) PM Viewer 1.6.1
*  SQL queries to be run upon upgrade
*
*/

$SQL[] = "ALTER TABLE pmviewer_message_topic_user_map DROP INDEX map_user;";
$SQL[] = "ALTER TABLE pmviewer_message_topic_user_map ADD INDEX map_user ( map_user_id , map_folder_id , map_last_topic_reply );";

?>