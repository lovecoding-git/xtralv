<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

// First Shout
$INSERT[] = "INSERT INTO shoutbox_shouts (s_id, s_mid, s_date, s_message, s_ip, s_edit_history) VALUES ( NULL, '0', UNIX_TIMESTAMP(), 'Congratulations, you have successfully installed Shoutbox!<br />Now you need to setup the shoutbox permissions in ACP -> Members TAB -> Manage User Groups -> Edit a Group -> Shoutbox TAB', '127.0.0.1', NULL );";