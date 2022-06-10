<?php

/**
 *	Topic Moderators
 *
 * @author 		Martin Aronsen
 * @copyright	2008 - 2011 Invision Modding
 * @web: 		http://www.invisionmodding.com
 * @IPB ver.:	IP.Board 3.2
 * @version:	2.1  (21000)
 *
 */


class topicMod_moderate extends public_forums_moderate_moderate
{
	protected function _resetModerator( $forumId )
	{
		parent::_resetModerator( $forumId );
		
	 	if ( $this->request['t'] )
	 	{	
		 	/* OK, this member can moderate own topics */
			if ( isset( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] ) )
			{
				/* But is this my topic? */
				foreach( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $this->request['f'] . ',' ) )
					{
						if ( $this->topic['starter_id'] == $this->memberData['member_id'] )
						{
							$this->moderator = $mod;
							$this->memberData['is_mod'] = 1;
						}
					}
				}
			}
			else if ( isset( $this->caches['topicmod']['moderate_own']['group'][ $this->memberData['member_group_id'] ] ) )
			{
				/* But is this my topic? */
				foreach( $this->caches['topicmod']['moderate_own']['group'][ $this->memberData['member_group_id'] ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $this->request['f'] . ',' ) )
					{
						if ( $this->topic['starter_id'] == $this->memberData['member_id'] )
						{
							$this->moderator = $mod;
							$this->memberData['is_mod'] = 1;
						}
					}
				}
			}
			
			
			if( isset( $this->caches['topicmod']['member'][ $this->request['t'] ][ $this->memberData['member_id'] ] ) )
			{
				$this->moderator = $this->caches['topicmod']['member'][ $this->request['t'] ][ $this->memberData['member_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			else if( isset( $this->caches['topicmod']['group'][ $this->request['t'] ][ $this->memberData['member_group_id'] ] ) )
			{
				$this->moderator = $this->caches['topicmod']['group'][ $this->request['t'] ][ $this->memberData['member_group_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			
			
			$this->memberData['gbw_soft_delete'] 			= $this->moderator['gbw_soft_delete'];
			$this->memberData['gbw_un_soft_delete'] 		= $this->moderator['gbw_un_soft_delete'];
			$this->memberData['gbw_soft_delete_see'] 		= $this->moderator['gbw_soft_delete_see'];
			$this->memberData['gbw_soft_delete_reason'] 	= $this->moderator['gbw_soft_delete_reason'];
			$this->memberData['gbw_soft_delete_see_post'] 	= $this->moderator['gbw_soft_delete_see_post'];
			
			$this->registry->getClass( 'class_forums' )->setMemberData( $this->memberData );
		}
	}
	
	protected function _setupAndCheckInput()
	{
		parent::_setupAndCheckInput();
		
	 	if ( $this->request['t'] )
	 	{	
		 	/* OK, this member can moderate own topics */
			if ( isset( $this->caches['topicmod']['moderate_own'][ $this->memberData['member_id'] ] ) )
			{
				/* But is this my topic? */
				if ( $this->topic['starter_id'] == $this->memberData['member_id'] )
				{
					$this->moderator = $this->caches['topicmod']['moderate_own'][ $this->memberData['member_id'] ];
					$this->memberData['is_mod'] = 1;
				}
			}
			
			
			if( isset( $this->caches['topicmod']['member'][ $this->request['t'] ][ $this->memberData['member_id'] ] ) )
			{
				$this->moderator = $this->caches['topicmod']['member'][ $this->request['t'] ][ $this->memberData['member_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			else if( isset( $this->caches['topicmod']['group'][ $this->request['t'] ][ $this->memberData['member_group_id'] ] ) )
			{
				$this->moderator = $this->caches['topicmod']['group'][ $this->request['t'] ][ $this->memberData['member_group_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			
			$this->memberData['gbw_soft_delete'] 			= $this->moderator['gbw_soft_delete'];
			$this->memberData['gbw_un_soft_delete'] 		= $this->moderator['gbw_un_soft_delete'];
			$this->memberData['gbw_soft_delete_see'] 		= $this->moderator['gbw_soft_delete_see'];
			$this->memberData['gbw_soft_delete_reason'] 	= $this->moderator['gbw_soft_delete_reason'];
			$this->memberData['gbw_soft_delete_see_post'] 	= $this->moderator['gbw_soft_delete_see_post'];
		}
	}
}