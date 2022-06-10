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

class topicMod_classPostForms extends classPostForms
{
	public function globalSetUp()
	{	
	 	if ( $this->request['t'] )
	 	{
		 	$topicMod = $this->caches['topicmod'];
		 	
		 	/* OK, this member can moderate own topics */			
	 		if ( isset( $topicMod['moderate_own']['member'][ $this->getAuthor('member_id') ] ) )
			{
				/* But is this my topic? */
				foreach( $topicMod['moderate_own']['member'][ $this->getAuthor('member_id') ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $this->getTopicData( 'forum_id' ) . ',' ) )
					{
						if ( $this->getTopicData( 'starter_id' ) == $this->getAuthor('member_id') )
						{
							$this->moderator = $mod;
							$setAuthor = array( 'is_mod' => 1 );
				
							if ( $this->moderator['close_topic'] AND $this->moderator['open_topic'] )
							{
								$setAuthor['g_post_closed'] = 1;
							}
							
							$this->setAuthor( array_merge( $this->getAuthor(), $setAuthor ) );
							
							break;
						}
					}
				}
			}
			else if ( isset( $topicMod['moderate_own']['group'][ $this->getAuthor('member_group_id') ] ) )
			{
				/* But is this my topic? */
				foreach( $topicMod['moderate_own']['group'][ $this->getAuthor('member_group_id') ] as $mod )
				{
					if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $this->getTopicData( 'forum_id' ) . ',' ) )
					{
						if ( $this->getTopicData( 'starter_id' ) == $this->getAuthor('member_id') )
						{
							$this->moderator = $mod;
							$setAuthor = array( 'is_mod' => 1 );
				
							if ( $this->moderator['close_topic'] AND $this->moderator['open_topic'] )
							{
								$setAuthor['g_post_closed'] = 1;
							}
							
							$this->setAuthor( array_merge( $this->getAuthor(), $setAuthor ) );
							
							break;
						}
					}
				}
			}

			if(  isset( $topicMod['member'][ $this->request['t'] ][ $this->getAuthor('member_id') ] ) )
			{
				$this->moderator = $topicMod['member'][ $this->request['t'] ][ $this->getAuthor('member_id') ];
				$setAuthor = array( 'is_mod' => 1 );
				
				if ( $this->moderator['close_topic'] AND $this->moderator['open_topic'] )
				{
					$setAuthor['g_post_closed'] = 1;
				}
				
				$this->setAuthor( array_merge( $this->getAuthor(), $setAuthor ) );
			}
			else if( isset( $topicMod['group'][ $this->request['t'] ][ $this->getAuthor('member_group_id') ] ) ) 
			{ 
				$this->moderator = $topicMod['group'][ $this->request['t'] ][ $this->getAuthor('member_group_id') ];
				$setAuthor = array( 'is_mod' => 1 );
				
				if ( $this->moderator['close_topic'] AND $this->moderator['open_topic'] )
				{
					$setAuthor['g_post_closed'] = 1;
				}
				
				$this->setAuthor( array_merge( $this->getAuthor(), $setAuthor ) );
			}
			
	 		if ( !empty( $this->moderator['mid'] ) )
			{
				$setAuthor['forumsModeratorData'][ $this->request['f'] ] = $this->moderator;
				$this->setAuthor( array_merge( $this->getAuthor(), $setAuthor ) );
			}
		}
		
		return parent::globalSetUp(); 
	}
}