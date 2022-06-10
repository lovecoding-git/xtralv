<?php

	/**
	 * Product Title:		(SOS32) Total Time Spent On Forums
	 * Product Version:		3.0.2
	 * Author:				Adriano Faria
	 * Website:				SOS Invision
	 * Website URL:			http://forum.sosinvision.com.br/
	 * Email:				administracao@sosinvision.com.br
	 */

class sos32_timespent
{
	public $registry;
	public $settings;
	public $pids = array();
	
	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->settings   =& $this->registry->fetchSettings();
		$this->DB         =  $this->registry->DB();
		$this->lang		  =  $this->registry->getClass('class_localization');
		$this->cache	  =& $this->registry->cache()->fetchCaches();
		$this->request    =& $this->registry->fetchRequest();
	
		$this->registry->class_localization->loadLanguageFile( array( 'public_global', 'core' ) );
	}
	
	public function getOutput()
	{
		return '';
	}
	
	public function replaceOutput( $output, $key )
	{
		if( is_array($this->registry->output->getTemplate('global')->functionData['userInfoPane']) AND count($this->registry->output->getTemplate('global')->functionData['userInfoPane']) )
		{
			$tag	= '<!--hook.' . $key . '-->';
			$last	= 0;
			$canUse = ( $this->settings['sidebar_toponlineusers_hide'] ) ? explode(",", $this->settings['sidebar_toponlineusers_hide']) : array();

			if ( is_array( $canUse) AND count( $canUse) AND $this->settings['sidebar_toponlineusers_userinfopane'] )
			{
				foreach( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $_id => $_data )
				{
					$pos = strpos( $output, $tag, $last );
			
					if( $pos !== FALSE )
					{
						$days = 0; $hrs = 0; $mins = 0;
						$secs = $_data['author']['time_spent'];
						while( $secs >= 86400 ){ $days++; $secs -= 86400; }
						while( $secs >= 3600 ){ $hrs++; $secs -= 3600; }
						while( $secs >= 60 ){ $mins++; $secs -= 60; }
	
						$days = $days ? $days.'d ' : '';
						$hrs  = $hrs  ? $hrs .'h ' : '';
						$mins = $mins ? $mins.'m ' : '';
						$secs = $secs ? $secs.'s ' : '';
	
						$text = $_data['author']['time_spent'] > 0 ? $this->lang->words['time_spent'] : '';
						
						$string	= ( $_data['author']['member_id'] && in_array($_data['author']['member_group_id'], $canUse) ) ? "<ul class='basic_info'><li class='post_count desc lighter'>{$text}: {$days}{$hrs}{$mins}{$secs}</li></ul>" : '';
						
						//$string =  $_data['author']['time_spent'] > 0 ? "<li><span class='ft'>{$text}</span><span class='fc'>{$days}{$hrs}{$mins}{$secs}</span></li>" : "";
	
						$output	= substr_replace( $output, $string . $tag, $pos, strlen( $tag ) ); 
						$last	= $pos + strlen( $tag . $string );
						
						$string = "";
						$days	= "";
						$hrs	= "";
						$mins	= "";
						$secs 	= "";
					}
					else
					{
						break;
					}
				}
			}
		}
		
		return $output;
	}
}