<?php

	/**
	 * Product Title:		(SOS32) Total Time Spent On Forums
	 * Product Version:		3.0.2
	 * Author:				Adriano Faria
	 * Website:				SOS Invision
	 * Website URL:			http://forum.sosinvision.com.br/
	 * Email:				administracao@sosinvision.com.br
	 */

class sos32_timespent_sidebarhook
{
	public $registry;
	public $member;
	public $cache;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		$this->DB		=  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->cache    = $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->registry->class_localization->loadLanguageFile( array( 'public_global', 'core' ) );
	}
	
	public function getOutput()
	{
		if ( !$this->settings['sidebar_toponlineusers_onoff'] )
		{
			return '';
		}
	
		if ( IPSMember::isInGroup( $this->memberData, explode( ",", IPSText::cleanPermString($this->settings['sidebar_toponlineusers_grupos'] ) ) ) )
		{
			$this->DB->build( array( 
									'select' => 'm.member_id, m.members_seo_name, m.members_display_name, m.member_group_id',
									'from'   => array( 'members' => 'm' ),
				                    'add_join' => array(
									0 => array( 'select' => 'pp.*',
						  	  					 'from'   => array( 'profile_portal' => 'pp' ),
	 							  				 'where'  => 'pp.pp_member_id=m.member_id',
							  					 'type'   => 'left' )
                                	),
            						'where'  => "pp.time_spent > 0 AND m.member_group_id IN (".$this->settings['sidebar_toponlineusers_hide'].")",
									'order' => "pp.time_spent desc",
									'limit' => array( 0, $this->settings['sidebar_toponlineusers_registros'])
			) );
								 
			$q = $this->DB->execute();
			
			if ( $this->DB->getTotalRows( $q ) )
			{
				$users = array();
						
				while( $r = $this->DB->fetch( $q ) )
				{
					$r = IPSMember::buildDisplayData( $r );
	
					$days = 0; $hrs = 0; $mins = 0;
					$secs = $r['time_spent'];
					while( $secs >= 86400 ){ $days++; $secs -= 86400; }
					while( $secs >= 3600 ){ $hrs++; $secs -= 3600; }
					while( $secs >= 60 ){ $mins++; $secs -= 60; }
			
					$days = $days ? $days.'d ' : '';
					$hrs  = $hrs  ? $hrs .'h '  : '';
					$mins = $mins ? $mins.'m ' : '';
					$secs = $secs ? $secs.'s ' : '';

					$r['time'] = "{$days}{$hrs}{$mins}{$secs}";

					$users[ $r['member_id'] ] = $r;
				}
				
				return $this->registry->output->getTemplate( 'boards' )->sos32_timespent_sidebar( $users );
			}
		}
	}
}