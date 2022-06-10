<?php
/**
 * Invision Power Services
 * IP.SEO Meta Tags AJAX
 * Last Updated: $Date: 2011-05-25 10:30:28 -0400 (Wed, 25 May 2011) $
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 8887 $
 */

class admin_ipseo_ajax_meta extends ipsAjaxCommand
{

	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
		$this->html = $this->registry->output->loadTemplate('cp_skin_seo');
	
		switch ( $this->request['do'] )
		{
			case 'add_tag':
				$this->addTag();
				break;
				
			case 'edit_tag':
				$this->editTag();
				break;
				
			case 'save_tag':
				$this->saveTagAdd();
				break;
		}
	}
	
	/**
	 * AJAX Action: Add Tag
	 */
	private function addTag()
	{
		$output = $this->html->addTag( $this->request['popup'] );
		$this->returnHtml( $output );
	}
	
	/**
	 * AJAX Action: Edit Tag
	 */
	private function editTag()
	{
		$output = $this->html->addTag( $this->request['popup'], $this->request['title'], $this->request['content'] );
		$this->returnHtml( $output );
	}
	
}