<?php

class boardIndexTopicsBeingViewed
{
	public $registry;
	public $member;
	public $cache;
	
	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->DB		  =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		
		$this->registry->class_localization->loadLanguageFile( array( 'public_boards', 'forums' ) );
	}
	
	public function getOutput()
	{
		if ( !in_array( $this->memberData['member_group_id'], explode(',', $this->settings['boardIndexTopicsBeingViewed_groups'] ) ) )
		{
			return '';
		}

		$cut_off = $this->settings['au_cutoff'] * 60;
		$time    = time() - $cut_off;

		$forumIdsOk = $this->registry->class_forums->fetchSearchableForumIds();

		if( !is_array($forumIdsOk) OR !count($forumIdsOk) )
		{
			return '';
		}
		else
		{
			$forums = implode( ",", $forumIdsOk );
		}

		$qtd = intval( $this->settings['boardIndexTopicsBeingViewed_qtd'] ) ? $this->settings['boardIndexTopicsBeingViewed_qtd'] : 5;

		$this->DB->build( array( 
								'select' => 'location_1_id, count(location_1_id) as total',
								'from'   => array( 'sessions' => 's' ),
			                    'add_join' => array(
									0 => array(  'select' => 't.starter_id, t.title, t.title_seo, t.start_date',
						  	  					 'from'   => array( 'topics' => 't' ),
	 							  				 'where'  => 's.location_1_id=t.tid',
							  					 'type'   => 'left' ),
									1 => array(  'select' => 'm.member_id, m.members_display_name, m.members_seo_name, m.member_group_id',
						  	  					 'from'   => array( 'members' => 'm' ),
	 							  				 'where'  => 'm.member_id=t.starter_id',
							  					 'type'   => 'left' ),
									2 => array(  'select' => 'pp.*',
						  	  					 'from'   => array( 'profile_portal' => 'pp' ),
	 							  				 'where'  => 'pp.pp_member_id=m.member_id',
							  					 'type'   => 'left' )
	                               	),
	                            'where' => 's.running_time > ' . $time . ' AND s.location_2_type="forum" AND s.location_1_type="topic" AND t.forum_id IN ('.$forums.')',
								'group'	=> 's.location_1_id',
								'order' => "total DESC, t.start_date desc",
								'limit' => array( 0, $qtd )
		) );

		$q = $this->DB->execute();
			
		if ( $this->DB->getTotalRows( $q ) )
		{
			$viewers = array();
					
			while( $r = $this->DB->fetch( $q ) )
			{				
				$r = IPSMember::buildDisplayData( $r );
				
				$users[ $r['location_1_id'] ] = $r;
			}

			return $this->registry->output->getTemplate( 'boards' )->boardIndexTopicsBeingViewed( $users );
		}
	}
}