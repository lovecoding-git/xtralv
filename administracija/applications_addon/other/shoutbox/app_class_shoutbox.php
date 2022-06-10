<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

class app_class_shoutbox
{
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object	ipsRegistry
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		require_once( IPSLib::getAppDir( 'shoutbox' ) . "/sources/classes/library.php" );
		$registry->setClass( 'shoutboxLibrary', new shoutboxLibrary( $registry ) );
		
		if ( IN_ACP )
		{
			$registry->getClass('class_localization')->loadLanguageFile( array( 'admin_shoutbox' ), 'shoutbox' );
		}
		else
		{
			$registry->getClass('class_localization')->loadLanguageFile( array( 'public_shoutbox' ), 'shoutbox' );
		}
	}
}