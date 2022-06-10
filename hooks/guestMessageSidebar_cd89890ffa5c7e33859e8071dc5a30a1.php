<?php
/*
+--------------------------------------------------------------------------
|   Guest Message 1.6.0
|   =============================================
|   by Michael
|   Copyright 2007-2011 DevFuse
|   http://www.devfuse.com
+--------------------------------------------------------------------------
*/

class guestMessageSidebar
{
	public $registry;
	public $member;
	
	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->request    =& $this->registry->fetchRequest();		
		$this->settings   =& $this->registry->fetchSettings();		
		$this->member	  = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}
	
	public function getOutput()
	{		
		if( !$this->settings['gm_enable_sidebar'] OR $this->memberData['member_id'] )
		{
			return FALSE;
		}
		
		if( $this->request['section'] == 'login' OR $this->request['section'] == 'register' )
		{
			return FALSE;
		}
				
        IPSText::getTextClass('bbcode')->parse_html            = 0;
        IPSText::getTextClass('bbcode')->parse_nl2br           = 1;
        IPSText::getTextClass('bbcode')->parse_bbcode          = 1;
        IPSText::getTextClass('bbcode')->parse_smilies         = 1;
        IPSText::getTextClass('bbcode')->parsing_section       = 'guest_message';
        IPSText::getTextClass('bbcode')->parsing_mgroup        = $this->memberData['member_group_id'];
        IPSText::getTextClass('bbcode')->parsing_mgroup_others = $this->memberData['mgroup_others'];
        
        $search  = array( '/%board_name%/', '/%register_link%/', '/%signin_link%/');
        $replace = array( $this->settings['board_name'], "{$this->settings['base_url']}app=core&amp;module=global&amp;section=register", "{$this->settings['base_url']}app=core&amp;module=global&amp;section=login" );
 
        $this->settings['gm_title']   = preg_replace( $search, $replace, $this->settings['gm_title'] ); 
        $this->settings['gm_message'] = preg_replace( $search, $replace, $this->settings['gm_message'] );
        $this->settings['gm_message'] = IPSText::getTextClass('bbcode')->preDisplayParse( $this->settings['gm_message'] );
	
		return $this->registry->output->getTemplate( 'boards' )->guestMessageSidebar();
	}	
}?>