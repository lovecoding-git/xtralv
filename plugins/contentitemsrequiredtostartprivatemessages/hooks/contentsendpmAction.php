//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook7 extends _HOOK_CLASS_
{
	/**
	 * Compose
	 *
	 * @return	void
	 */
	protected function compose()
	{
		try
		{
			if( \IPS\Member::loggedIn()->inGroup( explode( ',', \IPS\Settings::i()->contentsendpmGroups ) ) AND \IPS\Member::loggedIn()->member_posts < \IPS\Settings::i()->contentsendpmNumberofItems )
			{
				if( \IPS\Settings::i()->contentsendpmShowNumberofItems )
				{
					$text = \IPS\Member::loggedIn()->language()->addToStack( 'contentsendpm_error_complete', FALSE, array( 'sprintf' => \IPS\Settings::i()->contentsendpmNumberofItems ) );
					\IPS\Output::i()->error( $text, 'CONTENT ITEMS REQUIRED TO START PRIVATE MESSAGES/1', 403, '' );
				}
				else
				{
					\IPS\Output::i()->error( 'contentsendpm_error_short', 'CONTENT ITEMS REQUIRED TO START PRIVATE MESSAGES/2', 403, '' );
				}	
			}
	
			return parent::compose();
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}