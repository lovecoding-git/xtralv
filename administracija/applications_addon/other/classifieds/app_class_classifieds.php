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

class app_class_classifieds
{
	/**#@+
	 * Registry Object Shortcuts
	 *
	 * @access	protected
	 * @var		object
	 */
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	/**#@-*/
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object		ipsRegistry
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		
		/* Classifieds Object */
		require_once( IPS_ROOT_PATH . '/applications_addon/other/classifieds/sources/classes/classifieds.php' );
		$registry->setClass( 'classifieds', new classifieds( $registry ) );
		
		/* Public Side Stuff */
		if( ! IN_ACP )
		{
			/* Load the language File */
			$registry->class_localization->loadLanguageFile( array( 'public_lang' ), 'classifieds' );
			
			/* Set a default module */
			if ( ! ipsRegistry::$request['module'] )
			{
				ipsRegistry::$request['module'] = 'core';
			}
		}
		
		//-----------------------------------------
		// Locale
		//-----------------------------------------
		
		if ( ipsRegistry::$settings['classifieds_locale'] )
		{
			setlocale( LC_MONETARY, ipsRegistry::$settings['classifieds_locale'] );
			ipsRegistry::getClass('class_localization')->local_data = localeconv();
		}
		
	}
	
/**
	 * After output initialization
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @return	@e void
	 */
	public function afterOutputInit( ipsRegistry $registry )
	{ 
		/* Public Side Stuff */
		if ( ! IN_ACP )
		{	
			$registry->getClass('classifieds')->checkGlobalAccess();	
					
		}
	}		
	
	
}

