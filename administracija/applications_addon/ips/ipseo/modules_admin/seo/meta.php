<?php
/**
 * Invision Power Services
 * IP.SEO -  Meta Tags
 * Last Updated: $Date: 2011-08-16 09:41:42 -0400 (Tue, 16 Aug 2011) $
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9394 $
 */

class admin_ipseo_seo_meta extends ipsCommand
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
		//-----------------------------------------
		// Init
		//-----------------------------------------
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_seo' );
		
		//-----------------------------------------
		// What are we doing?
		//-----------------------------------------

		switch($this->request['do'])
		{
			case 'add':
			case 'edit':
				$this->form();
			break;
		
			case 'save':
				$this->save();
			break;
			
			case 'delete':
				$this->delete();
			break;
			
			default:
				$this->manage();
			break;
		}
		
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
	
	/**
	 * Action: Manage Meta Tags
	 */
	protected function manage()
	{
		$metaTags = ips_CacheRegistry::instance()->getCache('ipseo_meta');
				
		/* Display */
		$this->registry->output->html  = $this->html->metaTags( $metaTags );
	}
	
	/**
	 * Action: Show Form
	 */
	public function form()
	{
		$page = '';
		$tags = array();
		
		if ( isset( $this->request['page'] ) )
		{
			$cache = ips_CacheRegistry::instance()->getCache('ipseo_meta');
			
			$page	= $this->request['page'];
			$tags	= $cache[ $page ];
		}
	
		/* Display */
		$this->registry->output->html  = $this->html->metaTagForm( $page, $tags );
	}
	
	/**
	 * Action: Save
	 */	
	protected function save()
	{
		/* Get Cache */
		$cache = ips_CacheRegistry::instance()->getCache('ipseo_meta');
		
		/* Delete any DB entries for this page as we're about to rebuild them */
		$escapedPage = $this->DB->addSlashes( $this->request['old-page'] );
		$this->DB->delete( 'seo_meta', "url='{$escapedPage}'" );
		unset( $cache[ $this->request['old-page'] ] );
		
		/* Init Page */
		if ( !$this->request['page'] )
		{
			$this->registry->output->showError( 'err_no_page' );
		}
		$cache[ $this->request['page'] ] = array();
		
		/* Insert Tags */
		$id = 0;
		do
		{
			if ( !empty( $this->request[ 'title-' . $id ] ) )
			{
				$cache[ $this->request['page'] ][ $this->request[ 'title-' . $id ] ] = $this->request[ 'content-' . $id ];
				$this->DB->insert('seo_meta', array(
					'url'		=> $this->request['page'],
					'name'		=> $this->request[ 'title-' . $id ],
					'content'	=> $this->request[ 'content-' . $id ]
					) );
			}
			
			$id++;
		}
		while ( isset( $this->request[ 'title-' . $id ] ) );
				
		/* Rebuild Cache */
		ips_CacheRegistry::instance()->setCache( 'ipseo_meta', serialize( $cache ) );
		
		/* Boink */
		$this->registry->output->silentRedirect( ipsRegistry::$settings['base_url'] . "module=seo&section=meta" );
	}
	
	/**
	 * Action: Delete
	 */	
	protected function delete()
	{
		/* Rebuild Cache */
		$cache = ips_CacheRegistry::instance()->getCache('ipseo_meta');
		unset( $cache[ $this->request['page'] ] );
		ips_CacheRegistry::instance()->setCache( 'ipseo_meta', serialize( $cache ) );
		
		/* Delete any DB entries for this page */
		$escapedPage = $this->DB->addSlashes( $this->request['page'] );
		$this->DB->delete( 'seo_meta', "url='{$escapedPage}'" );
		
		/* Boink */
		$this->registry->output->silentRedirect( ipsRegistry::$settings['base_url'] . "module=seo&section=meta" );
	}
}