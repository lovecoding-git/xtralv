<?php

	/**
	 * Product Title:		(SOS32) Total Time Spent On Forums
	 * Product Version:		3.0.2
	 * Author:				Adriano Faria
	 * Website:				SOS Invision
	 * Website URL:			http://forum.sosinvision.com.br/
	 * Email:				administracao@sosinvision.com.br
	 */
	 
class sos32_timespent_profile
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
		$this->lang       =  $this->registry->getClass('class_localization');
		$this->request    =& $this->registry->fetchRequest();
		$this->registry->class_localization->loadLanguageFile( array( 'public_profile', 'members' ) );
	}
	
	public function getOutput()
	{
		$string = "";
			
		$member	    = $this->registry->output->getTemplate('profile')->functionData['profileModern'][0]['member'];

		if ( !in_array( $member['member_group_id'], explode(',',$this->settings['sidebar_toponlineusers_hide'] ) ) )
		{
			return false;
		}
		
		if ( $member['time_spent'] > 0 )
		{
			$days = 0; $hrs = 0; $mins = 0;
			$secs = $member['time_spent'];
			while( $secs >= 86400 ){ $days++; $secs -= 86400; }
			while( $secs >= 3600 ){ $hrs++; $secs -= 3600; }
			while( $secs >= 60 ){ $mins++; $secs -= 60; }
		}

		$days = $days ? $days.'d ' : '';
		$hrs  = $hrs  ? $hrs .'h '  : '';
		$mins = $mins ? $mins.'m ' : '';
		$secs = $secs ? $secs.'s ' : '';
		
		if ( $member['time_spent'] > 0 )
		{
			$text = $member['time_spent'] > 0 ? $this->lang->words['time_spent'] : '';
			$string = "<li><span class='row_title'>{$text}</span><span class='row_data'>{$days}{$hrs}{$mins}{$secs}</span></li>";
			
			return $this->registry->output->getTemplate( 'profile' )->sos32_timespent( $string );
		}
	}
}