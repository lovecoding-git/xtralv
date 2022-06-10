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

/**
* Plug in name (Default tab name)
*/

// Load the language file
ipsRegistry::getClass( 'class_localization' )->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

$CONFIG['plugin_name']        = ipsRegistry::getClass('class_localization')->words['cfds_classifieds'];


/**
* Plug in key (must be the same as the main {file}.php name
*/
$CONFIG['plugin_key']         = 'classifieds';

/**
* Show tab?
*/
$CONFIG['plugin_enabled']     = IPSLib::appIsInstalled('classifieds') ? 1 : 0;

/**
* Order: CANNOT USE 1
*/
$CONFIG['plugin_order'] = 2;