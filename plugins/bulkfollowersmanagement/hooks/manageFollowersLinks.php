//<?php

abstract class hook21 extends _HOOK_CLASS_
{
	/**
	 * [Node] Get buttons to display in tree
	 * Example code explains return value
	 *
	 * @code
	 	array(
	 		array(
	 			'icon'	=>	'plus-circle', // Name of FontAwesome icon to use
	 			'title'	=> 'foo',		// Language key to use for button's title parameter
	 			'link'	=> \IPS\Http\Url::internal( 'app=foo...' )	// URI to link to
	 			'class'	=> 'modalLink'	// CSS Class to use on link (Optional)
	 		),
	 		...							// Additional buttons
	 	);
	 * @endcode
	 * @param	string	$url		Base URL
	 * @param	bool	$subnode	Is this a subnode?
	 * @return	array
	 */
	public function getButtons( $url, $subnode=FALSE )
	{
		try
		{
			try
			{
				$parent 	= parent::getButtons( $url, $subnode );
				$showLinks 	= FALSE;
		
				foreach ( \IPS\Content::routedClasses( TRUE, TRUE ) as $class )
				{
					if ( isset( $class::$containerNodeClass ) AND in_array( 'IPS\Content\Followable', class_implements( $class ) ) AND get_called_class() == $class::$containerNodeClass )
					{
						if( $class::$application != 'cms' )
						{
							$showLinks 	= TRUE;
						}
					}
				}
		
				if( $showLinks )
				{
					$merge	= array();
		
					$merge['add_followers'] = array(
						'icon'	=> 'plus-square',
						'title'	=> 'manageFollowers_add',
						'link'	=> $url->setQueryString( array( 'do' => 'followersAdd', 'id' => $this->_id ) ),
						'data'	=> array( 'ipsDialog' => '', 'ipsDialog-size' => 'medium', 'ipsDialog-title' => \IPS\Member::loggedIn()->language()->addToStack('manageFollowers_add' ) )
					);
		
					$merge['remove_followers'] = array(
						'icon'	=> 'minus-square',
						'title'	=> 'manageFollowers_remove',
						'link'	=> $url->setQueryString( array( 'do' => 'followersRemoveall', 'id' => $this->_id ) ),
						'data'	=> array( 'ipsDialog' => '', 'ipsDialog-size' => 'medium', 'ipsDialog-title' => \IPS\Member::loggedIn()->language()->addToStack('manageFollowers_remove' ) )
					);
			
					array_splice( $parent, 4, 0, $merge );
				}
		
				return $parent;
			}
			catch ( \RuntimeException $e )
			{
				if ( method_exists( get_parent_class(), __FUNCTION__ ) )
				{
					return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
				}
				else
				{
					throw $e;
				}
			}
		}
		catch ( \RuntimeException $e )
		{
			if ( method_exists( get_parent_class(), __FUNCTION__ ) )
			{
				return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
			}
			else
			{
				throw $e;
			}
		}
	}
}