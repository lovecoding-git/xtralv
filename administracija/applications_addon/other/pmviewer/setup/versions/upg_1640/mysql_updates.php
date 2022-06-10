<?php
/*
*
*  (SN) PM Viewer 1.6.3a
*  SQL queries to be run upon upgrade
*
*/

$DB = ipsRegistry::DB();

if ( ! method_exists( $DB, 'checkForIndex' ) )
{
	print "Your ips_kernel/classDbMysql.php is out of date! Please update it from the download zip and refresh this browser window";
	exit();
}

if ( ! $DB->checkForIndex( 'msg_post', 'pmviewer_message_posts' ) )
{
	$SQL[] = "ALTER TABLE pmviewer_message_posts ADD FULLTEXT KEY msg_post (msg_post);";
}

if ( ! $DB->checkForIndex( 'mt_title', 'pmviewer_message_topics' ) )
{
	$SQL[] = "ALTER TABLE pmviewer_message_topics ADD FULLTEXT KEY mt_title (mt_title);";
}

?>