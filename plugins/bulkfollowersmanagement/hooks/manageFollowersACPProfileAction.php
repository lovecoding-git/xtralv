//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook20 extends _HOOK_CLASS_
{
	/**
	 * Remove all followed content from a member
	 *
	 * @return	void
	 */
	public function removeFollowedContent()
	{
		try
		{
			\IPS\Dispatcher::i()->checkAcpPermission( 'member_edit' );
	
			/* Load Member */
			$member = \IPS\Member::load( \IPS\Request::i()->id );
	
			if ( !$member->member_id )
			{
				\IPS\Output::i()->error( 'node_error', 'BFM/3', 404, '' );
			}
	
			\IPS\Db::i()->delete( 'core_follow', array( 'follow_member_id=?', $member->member_id ) );
	
			\IPS\Output::i()->redirect( $member->acpUrl(), 'remove_followed_content_done' );
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
