<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

/* Normally the table should be there but let's prevent errors just in case... */
if ( ipsRegistry::DB()->checkForTable( 'shoutbox_upgrade_history' ) )
{
	// Remove the old upgrade_history table
	$SQL[] = "DROP TABLE shoutbox_upgrade_history;";
}

# Delete older templates since we use skin_shoutbox_hooks now =O
$SQL[] = "DELETE FROM skin_templates WHERE template_group='skin_shoutbox' AND template_name IN ('shoutbox_global','hookActiveUsers');";