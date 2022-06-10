<?php

/**
 *
 * Classifieds 1.2.1
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

/* Can search with this app */
$CONFIG['can_search']	      = 1;

/* Can view new content with this app */
$CONFIG['can_viewNewContent'] = 1;

/* Can fetch active content with this app */
$CONFIG['can_activeContent']  = 1;

/* Can fetch user generated content */
$CONFIG['can_userContent'] = 1;