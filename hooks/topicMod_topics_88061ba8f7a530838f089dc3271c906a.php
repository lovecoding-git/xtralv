<?php

/**
 *	Topic Moderators
 *
 * @author 		Martin Aronsen
 * @copyright	2008 - 2011 Invision Modding
 * @web: 		http://www.invisionmodding.com
 * @IPB ver.:	IP.Board 3.2
 * @version:	2.0.1  (20001)
 *
 */

class topicMod_topics extends public_forums_forums_topics
{
	public function _generateModerationPanel()
	{
		if ( ! $this->memberData['member_id'] )
		{
			return;
		}
		
		$moderator = $this->registry->getClass( 'topics' )->getModeratorData();
		
		if ( !empty( $moderator['mid'] ) )
		{
			$this->memberData['is_mod'] = 1;
		}
		
		return parent::_generateModerationPanel();
	}
}