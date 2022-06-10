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


class topicMod_classTopics extends app_forums_classes_topics
{
	public function canView( $topicData=false, $memberData=false )
	{
		if ( is_array( $topicData ) && isset( $topicData['tid'] ) )
		{
			$this->setTopicData( $topicData );
		}
		
		if ( is_array( $memberData ) && isset( $memberData['member_id'] ) )
		{
			$this->setMemberData( $memberData );
		}
		
		
		if ( $this->moderatorData === null AND $this->memberData['member_id'] AND ! $this->memberData['g_is_supmod'] )
		{
			/* OK, this member can moderate own topics */
			if ( isset( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] ) )
			{
				/* But is this my topic? */
				foreach( $this->caches['topicmod']['moderate_own']['member'][ $this->memberData['member_id'] ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $this->request['f'] . ',' ) )
					{
						if ( $this->topicData['starter_id'] == $this->memberData['member_id'] )
						{
							$this->moderatorData = $mod;
							$this->memberData['is_mod'] = 1;
							
							break;
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
						if ( $this->topicData['starter_id'] == $this->memberData['member_id'] )
						{
							$this->moderatorData = $mod;
							$this->memberData['is_mod'] = 1;
							
							break;
						}
					}
				}
			}
			
			
			if( isset( $this->caches['topicmod']['member'][ $this->getTopicData( 'tid' ) ][ $this->memberData['member_id'] ] ) )
			{
				$this->moderatorData = $this->caches['topicmod']['member'][ $this->getTopicData( 'tid' ) ][ $this->memberData['member_id'] ];
				$this->memberData['is_mod'] = 1;
			}
			else if ( isset( $this->caches['topicmod']['group'][ $this->getTopicData( 'tid' ) ][ $this->memberData['member_group_id'] ] ) )
			{
				$this->moderatorData = $this->caches['topicmod']['group'][ $this->getTopicData( 'tid' ) ][ $this->memberData['member_group_id'] ];
				$this->memberData['is_mod'] = 1;	
			}
			
			if ( $this->moderatorData !== null )
			{
				if ( $this->moderatorData['close_topic'] AND $this->moderatorData['open_topic'] )
				{
					$this->memberData['g_post_closed'] = 1;
				}
				
				$this->memberData['forumsModeratorData'][ $this->getTopicData( 'forum_id' ) ] = $this->moderatorData;
				
				$this->setMemberData( 'gbw_soft_delete', 			$this->moderatorData['gbw_soft_delete'] );
				$this->setMemberData( 'gbw_un_soft_delete', 		$this->moderatorData['gbw_un_soft_delete'] );
				$this->setMemberData( 'gbw_soft_delete_see', 		$this->moderatorData['gbw_soft_delete_see'] );
				$this->setMemberData( 'gbw_soft_delete_reason', 	$this->moderatorData['gbw_soft_delete_reason'] );
				$this->setMemberData( 'gbw_soft_delete_see_post',	$this->moderatorData['gbw_soft_delete_see_post'] );
				$this->setMemberData( 'g_post_closed', 				$this->memberData['g_post_closed'] );
				$this->setMemberData( 'is_mod',						1 );
				$this->setMEmberData( 'forumsModeratorData',		$this->memberData['forumsModeratorData'] );

			}
		}
		
		return parent::canView( $this->getTopicData(), $this->getMemberData() );
	}
}