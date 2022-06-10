<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

// Add new group permission to view shoutbox but not use it
$SQL[] = "ALTER TABLE groups ADD g_shoutbox_view TINYINT(1) NOT NULL DEFAULT '1';";

// Add new group permission to let users edit their shouts
$SQL[] = "ALTER TABLE groups ADD g_shoutbox_edit TINYINT(1) NOT NULL DEFAULT '0';";

// Remove old setting not used anymore
$SQL[] = "DELETE FROM conf_settings WHERE conf_key='shoutbox_global_exclude_pages';";