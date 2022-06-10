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


class topicMod_withoutActiveUsers_template
{
	public function __construct()
	{
		$this->registry 	=  ipsRegistry::instance();
		$this->DB       	=  $this->registry->DB();
		$this->settings 	=& $this->registry->fetchSettings();
		$this->request  	=& $this->registry->fetchRequest();
		$this->cache    	=  $this->registry->cache();
		$this->caches   	=& $this->registry->cache()->fetchCaches();
		
	}
	
	public function getOutput()
	{
		
		if ( $this->settings['im_topicMod-showTopicLedBy'] == 0 )
		{
			return;
		}
		
		if ( $this->settings['no_au_topic'] == 0 )
		{
			return;
		}
		
		$mods = $modsGID = $modsID = array();
				
		if ( isset( $this->caches['topicmod']['group'][ $this->request['t'] ] ) )
		{
			foreach( $this->caches['topicmod']['group'][ $this->request['t'] ] as $mod )
			{
				$mod['g_title'] = IPSMember::makeNameFormatted( $mod['g_title'], $mod['g_id'] );
				
				$mods[] = array( $this->registry->getClass( 'output' )->buildUrl( "app=members&section=view&module=list&filter={$mod['g_id']}", "public" ), $mod['g_title'] );
				$modsGID[ $mod['group_id'] ] = $mod['group_id'];
			}
		}
		
		if ( isset( $this->caches['topicmod']['moderate_own']['group'] ) AND count( $this->caches['topicmod']['moderate_own']['group'] ) )
		{
			$topicData = $this->DB->buildAndFetch( 
				array( 
					'select' 	=> 't.starter_id, t.forum_id', 
					'from' 		=> array( 'topics' => 't' ), 
					'where' 	=> 't.tid=' . $this->request['t'],
					'add_join'	=> array(
										array(
											'select' => 'm.member_group_id',
											'from'		=> array( 'members' => 'm' ),
											'where'		=> 't.starter_id=m.member_id'
										)
					)
			) );
			if ( isset( $this->caches['topicmod']['moderate_own']['group'][ $topicData['member_group_id'] ] ) AND count( $this->caches['topicmod']['moderate_own']['group'][ $topicData['member_group_id'] ] ) )
			{
				foreach ( $this->caches['topicmod']['moderate_own']['group'][ $topicData['member_group_id'] ] as $mod )
				{
					if ( $topicData['member_group_id'] == $mod['group_id'] AND ! isset( $modsGID[ $mod['group_id'] ] ) )
					{
						if ( $mod['forums'] == '*' OR strstr( ',' . $mod['forums'] . ',', ',' . $topicData['forum_id'] . ',' ) )
						{
							$mod['g_title'] = IPSMember::makeNameFormatted( $mod['g_title'], $mod['g_id'] );
							
							$mods[] = array( $this->registry->getClass( 'output' )->buildUrl( "app=members&section=view&module=list&filter={$mod['g_id']}", "public" ), $mod['g_title'] );
						}
					}
				}
			}
		}
		
		if ( isset( $this->caches['topicmod']['member'][ $this->request['t'] ] ) )
		{
			foreach( $this->caches['topicmod']['member'][ $this->request['t'] ] as $mod )
			{
				$mod['members_display_name'] = IPSMember::makeNameFormatted( $mod['members_display_name'], $mod['member_group_id'] );
				
				$mods[] = array( $this->registry->getClass( 'output' )->buildSEOUrl( "showuser={$mod['member_id']}", "public", $mod['seoname'], 'showuser' ), $mod['members_display_name'], $mod['member_id'] );
				
				/* Used to prevent duplicate entries and complex foreaches() */
				$modsID[ $mod['member_id'] ] = $mod['member_id'];
			}
		}
		
		if ( isset( $this->caches['topicmod']['moderate_own']['member'] ) AND count( $this->caches['topicmod']['moderate_own']['member'] ) )
		{
			if ( ! count( $topicData ) )
			{
				$topicData = $this->DB->buildAndFetch( array( 'select' => 'starter_id, forum_id', 'from' => 'topics', 'where' => 'tid=' . $this->request['t'] ) );
			}
			
			if ( isset( $this->caches['topicmod']['moderate_own']['member'][ $topicData['starter_id'] ] ) AND count( $this->caches['topicmod']['moderate_own']['member'][ $topicData['starter_id'] ] ) )
			{
				foreach ( $this->caches['topicmod']['moderate_own']['member'][ $topicData['starter_id'] ] as $mod )
				{
					if ( $topicData['starter_id'] == $mod['member_id'] AND ! isset( $modsID[ $mod['member_id'] ] ) )
					{
						$mod['members_display_name'] = IPSMember::makeNameFormatted( $mod['members_display_name'], $mod['member_gr1oup_id'] );
						
						$mods[] = array( $this->registry->getClass( 'output' )->buildSEOUrl( "showuser={$mod['member_id']}", "public", $mod['seoname'], 'showuser' ), $mod['members_display_name'], $mod['member_id'] );
					}
				}
			}
		}
			
		if ( count( $mods ) )
		{	
			return $this->registry->getClass( 'output' )->getTemplate( 'topic' )->topicLedByWithActiveUsers( $mods );
		}
	}
}