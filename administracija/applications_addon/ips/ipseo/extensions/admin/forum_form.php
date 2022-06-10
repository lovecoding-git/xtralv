<?php
/**
 * Invision Power Services
 * IP.SEO - Forum Form Extension
 * Last Updated: $Date: 2011-08-15 11:00:40 -0400 (Mon, 15 Aug 2011) $
 *
 * @author 		$Author: mark $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @since		12th August 2011
 * @version		$Revision: 9393 $
 */
 
class admin_forum_form__ipseo
{
	public function getDisplayContent( $forum=array(), $tabsUsed=5 )
	{
		$this->registry = ipsRegistry::instance();
		$this->DB       = $this->registry->DB();
		
		$this->html = $this->registry->getClass('output')->loadTemplate('cp_skin_forum_form_ipseo', 'ipseo');
		$this->registry->getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ), 'ipseo' );
			
		return array( 'tabs' => $this->html->acp_forum_form_tabs( $forum, ( $tabsUsed + 1 ) ), 'content' => $this->html->acp_forum_form_main( $forum, ( $tabsUsed + 1) ), 'tabsUsed' => 1 );
	}
	
	public function getForSave()
	{	
		return array( 'ipseo_priority' => ipsRegistry::$request['ipseo_priority'] );
	}
}