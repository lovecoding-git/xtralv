<?php

class similarTopicsPostScreen_template
{
	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}
	
	public function getOutput()
	{
		if( ! in_array( $this->memberData['member_group_id'], explode(',', $this->settings['sos31_similartopics_groups'] ) ) )
		{
			return false;
		}
		
		if( ! in_array( $this->request['f'], explode(',', $this->settings['sos31_similartopics_forums'] ) ) )
		{
			return false;
		}
		
		if ( $this->settings['sos31_similartopics_posts'] > 0 AND $this->memberData['posts'] >= $this->settings['sos31_similartopics_posts'] )
		{
			return false;
		}
		
		return $this->registry->getClass('output')->getTemplate('post')->similarTopics();
	}
}