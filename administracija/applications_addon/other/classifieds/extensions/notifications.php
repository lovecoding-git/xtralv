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


class classifieds_notifications
{
	public function getConfiguration()
	{

            ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'public_lang' ), 'classifieds' );

                $_NOTIFY	= array(
					array( 'key' => 'new_classified', 'default' => array( 'email' ), 'disabled' => array(),'show_callback' => FALSE, 'icon' => 'notify_classifieds' ),
                                        array( 'key' => 'new_cfds_question', 'default' => array( 'email' ), 'disabled' => array(),'show_callback' => FALSE, 'icon' => 'notify_classifieds' ),
                                         array( 'key' => 'new_cfds_own_item_question', 'default' => array( 'email' ), 'disabled' => array(),'show_callback' => FALSE, 'icon' => 'notify_classifieds' ),
                                        array( 'key' => 'new_cfds_answer', 'default' => array( 'email' ), 'disabled' => array(),'show_callback' => FALSE, 'icon' => 'notify_classifieds' ),
					);

		return $_NOTIFY;
	}


}

