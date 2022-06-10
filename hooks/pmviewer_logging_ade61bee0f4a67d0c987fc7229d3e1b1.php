<?php

/**
 * (SN) PM Viewer
 * PM Viewer Logging Hook
 * Last Updated: November 23rd 2010
 *
 * @author 		signet51
 * @copyright	(c) 2011 signet51 Modding
 * @version		1.6.0 (1600)
 *
 */

class pmviewer_logging extends messengerFunctions
{
	public function deleteTopics( $memberID, $ids, $rawSQL=NULL, $hardDelete=false )
	{
		if ( $this->settings['pmviewer_log_deleted'] )
		{
			$memberData   = IPSMember::load( $memberID, 'groups,extendedProfile' );
			
			/* Let the original method handle the exceptions */
			if ( ! $memberData['member_id'] )
			{
				return parent::deleteTopics( $memberID, $ids, $rawSQL, $hardDelete );
			}
			
			if ( ! is_array( $ids ) OR ! count ( $ids ) )
			{
				return parent::deleteTopics( $memberID, $ids, $rawSQL, $hardDelete );
			}
			
			$idString = implode( ",", IPSLib::cleanIntArray( $ids ) );
			
			$this->DB->build( array( 'select' => 'mt.*',
									 'from'   => array( 'message_topics' => 'mt' ),
									 'where'  => "mt.mt_id IN(" . $idString . ")" . $rawSQL,
									 'add_join' => array( array( 'select' => 'map.*',
																 'from'   => array( 'message_topic_user_map' => 'map' ),
																 'where'  => 'map.map_topic_id=mt.mt_id AND map.map_user_id=' . $memberData['member_id'],
																 'type'   => 'left' ) ) ) );
			$this->DB->execute();
			
			/* Build up topics to remove */
			while ( $i = $this->DB->fetch() )
			{
				/* Starter? */
				if ( $i['mt_starter_id'] == $memberData['member_id'] )
				{
					$starter[ $i['mt_id'] ]   = $i;
					$allTopics[ $i['mt_id'] ] = $i;
				}
				else if ( $i['map_user_id'] AND $i['mt_is_system'] )
				{
					$system[ $i['mt_id'] ]       = $i;
					$allTopics[ $i['mt_id'] ]    = $i;
				}
				else if ( $i['map_user_id'] )
				{
					$wanttoleave[ $i['mt_id'] ]  = $i;
					$allTopics[ $i['mt_id'] ]    = $i;
				}
			}
			
			require_once( IPSLib::getAppDir( 'pmviewer' ) . '/sources/messageLogging.php' );
			$messageLogging = new messageLogging( $this->registry );
			
			if ( $hardDelete )
			{
				$messageLogging->logTopics( 'string', $idString );
			}
			else
			{
				
				if ( count( $system ) )
				{	
					$messageLogging->logTopics( 'array', $system );
				}
				
				if ( count( $starter ) )
				{
					$this->DB->update( 'message_topics', 'mt_is_deleted=1', 'mt_id IN (' . implode( ',', array_keys( $starter ) ) . ')', FALSE, TRUE );
				
					$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 0 ), 'map_user_id=' . $memberData['member_id'] . ' AND map_topic_id IN ('. implode( ',', array_keys( $starter ) ) . ')' );
				}
				
				if ( count( $wanttoleave ) )
				{
					$this->DB->update( 'message_topic_user_map', array( 'map_user_active' => 0 ), 'map_user_id=' . $memberData['member_id'] . ' AND map_topic_id IN ('. implode( ',', array_keys( $wanttoleave ) ) . ')' );
				}
				
				if ( count( $allTopics ) )
				{
					$this->DB->build( array( 'select'   => 'mt.*',
											 'from'     => array( 'message_topics' => 'mt' ),
											 'where'    => "mt.mt_id IN(" . implode( ',', array_keys( $allTopics ) ) . ")",
											 'add_join' => array( array( 'select' => 'map.*',
																		 'from'   => array( 'message_topic_user_map' => 'map' ),
																		 'where'  => 'map.map_topic_id=mt.mt_id AND map.map_user_active=1',
																		 'type'   => 'left' ) ) ) );
					$this->DB->execute();
				
					while( $row = $this->DB->fetch() )
					{
						/* Not got -any- mapping? */
						if ( ! $row['map_user_id'] )
						{
							$toHardDelete[ $row['mt_id'] ] = $row;
						}
					}
				}
				
				if ( count( $toHardDelete ) )
				{
					$messageLogging->logTopics( 'array', $toHardDelete );
				}
			}
			
			/* Now that we have logged let's let the original class take over and do its normal job */
			return parent::deleteTopics( $memberID, $ids, $rawSQL, $hardDelete );
		}
		else
		{
			return parent::deleteTopics( $memberID, $ids, $rawSQL, $hardDelete );
		}
	}
	
	public function deleteMessages( $msgIDs=array(), $deletedByMemberID )
	{
		$deletedByMember = IPSMember::load( intval( $deletedByMemberID ), 'all' );
		
		if ( $this->settings['pmviewer_log_deleted'] )
		{
			if ( ! is_array( $msgIDs ) or ! count( $msgIDs ) )
			{
				return FALSE;
			}
			
			$this->DB->build( array( 'select' => 'msg.msg_id, msg.msg_topic_id, msg.msg_author_id',
									 'from'   => array( 'message_posts' => 'msg' ),
									 'where'  => 'msg.msg_id IN (' . implode( ',', IPSLib::cleanIntArray( $msgIDs ) ) . ') AND msg.msg_is_first_post != 1',
									 'add_join' => array( array( 'select' => 'mt.*',
																 'from'   => array( 'message_topics' => 'mt' ),
																 'where'  => 'mt.mt_id=msg.msg_topic_id',
																 'type'   => 'left' ) ) ) );
									
			$this->DB->execute();
			
			while( $msg = $this->DB->fetch() )
			{
				if ( !$msg['mt_is_deleted'] )
				{
					if ( ( $msg['msg_author_id'] == $deletedByMember['member_id'] ) OR ( $deletedByMember['g_is_supmod'] == 1 ) )
					{
						$idsToDelete[ $msg['msg_id'] ]  = $msg['msg_id'];
					}
				}
			}
			
			if ( ! count( $idsToDelete ) )
			{
				return FALSE;
			}
			
			require_once( IPSLib::getAppDir( 'pmviewer' ) . '/sources/messageLogging.php' );
			$messageLogging = new messageLogging( $this->registry );
							
			$messageLogging->logMessages( $msgIDs );
			
			return parent::deleteMessages( $msgIDs, $deletedByMemberID );
		}
		else
		{
			return parent::deleteMessages( $msgIDs, $deletedByMemberID );
		}
	}
}
?>