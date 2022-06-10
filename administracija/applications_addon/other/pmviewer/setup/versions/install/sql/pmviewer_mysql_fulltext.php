<?php
/*
*
*  (SN) PM Viewer 1.6.0
*  SQL queries to be run on install
*
*/

$INDEX[] = "ALTER TABLE pmviewer_message_posts ADD FULLTEXT KEY msg_post (msg_post)";
$INDEX[] = "ALTER TABLE pmviewer_message_topics ADD FULLTEXT KEY mt_title (mt_title)";

?>