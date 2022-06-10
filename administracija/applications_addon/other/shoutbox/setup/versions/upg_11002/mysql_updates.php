<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

// Remove old templates
$SQL[] = "DELETE FROM skin_templates WHERE template_group='skin_shoutbox' AND template_name IN ('my_prefs_update','my_prefs','mod_options','members_viewing','members_viewing_row');";