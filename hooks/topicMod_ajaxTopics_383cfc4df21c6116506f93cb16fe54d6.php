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

class topicMod_ajaxTopics extends public_forums_ajax_topics
{
	protected function _postApproveToggle()
	{
		$this->topicMod_setModerator();
		
		return parent::_postApproveToggle();
	}
	
	public function saveTopicTitle()
	{
		$this->topicMod_setModerator();
		
		return parent::saveTopicTitle();
	}
	
	private function topicMod_setModerator()
	{
		if ( ! $this->memberData['member_id'] )
		{
			return;
		}
		
		if ( $topicID = intval( $this->request['t'] ) )
	 	{	
		 	/* OK, this member can moderate own topics */			
	 		if ( isset( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] ) )
			{
				$topic = $this->DB->buildAndFetch( array( 'select' => 'starter_id, forum_id',
														  'from'   => 'topics',
														  'where'  => 'tid=' . $topicID ) );
				/* But is this my topic? */
				foreach( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $topic['forum_id'] . ',' ) )
					{
						if ( $topic['starter_id'] == $this->memberData['member_id'] )
						{
							$moderator = $mod;
							$this->memberData['is_mod'] = 1;
							
							break;
						}
					}
				}
			}
			else if ( isset( $this->caches['topicmod']['moderate_own']['group'][ $this->memberData['member_group_id'] ] ) )
			{
				$topic = $this->DB->buildAndFetch( array( 'select' => 'starter_id, forum_id',
														  'from'   => 'topics',
														  'where'  => 'tid=' . $topicID ) );
				/* But is this my topic? */
				foreach( $this->caches['topicmod']['moderate_own']['group'][ $this->memberData['member_group_id'] ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $topic['forum_id'] . ',' ) )
					{
						if ( $topic['starter_id'] == $this->memberData['member_id'] )
						{
							$moderator = $mod;
							$this->memberData['is_mod'] = 1;
							
							break;
						}
					}
				}
			}
			
			
			if( isset( $this->caches['topicmod']['member'][ $topicID ][ $this->memberData['member_id'] ] ) )
			{
				$moderator = $this->caches['topicmod']['member'][ $topicID ][ $this->memberData['member_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			else if( isset( $this->caches['topicmod']['group'][ $topicID ][ $this->memberData['member_group_id'] ] ) )
			{
				$moderator = $this->caches['topicmod']['group'][ $topicID ][ $this->memberData['member_group_id'] ];
				$this->memberData['is_mod'] = 1;
			}

			if ( !empty( $moderator['mid'] ) )
			{
				$this->memberData['is_mod'] = 1;
				$this->memberData['forumsModeratorData'][ $this->request['f'] ] = $moderator;
			}
	 	}
	}
}