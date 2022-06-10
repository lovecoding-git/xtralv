<?php
/**
 * Invision Power Services
 * IP.SEO - Manage Meta Tags
 * Last Updated: $Date: 2011-08-18 05:41:19 -0400 (Thu, 18 Aug 2011) $
 *
 * @author 		$Author: mark $ (Orginal: Mark)
 * @copyright	© 2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @since		15th August 2011
 * @version		$Revision: 9398 $
 */

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}

class public_ipseo_meta_meta extends ipsCommand
{
	
	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	@e void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		$this->lang->loadLanguageFile( 'public_lang' );
	
		switch ( $this->request['do'] )
		{
			case 'init':
				$this->init();
				break;
				
			case 'save':
				$this->save();
				break;
				
			case 'end':
				$this->end();
				break;
		}
	}
	
	/**
	 * Action: Itnitiate
	 */
	public function init()
	{
		//-----------------------------------------
		// Are we an admin?
		//-----------------------------------------
	
		if ( ! $this->memberData['g_access_cp'] )
		{
			$this->registry->output->showError( 'meta_editor_no_admin' );
		}
	
		//-----------------------------------------
		// Check we have the hook enabled
		//-----------------------------------------
		
		$gotIt = FALSE;
		foreach( $this->caches['hooks']['skinHooks']['skin_global'] as $hook )
		{
			if ( $hook['className'] == 'ipSeoMeta' )
			{
				$gotIt = TRUE;
				break;
			}
		}
				
		if ( !$gotIt )
		{
			$this->registry->output->showError( 'no_hook' );
		}
		
		//-----------------------------------------
		// Set the session
		//-----------------------------------------
	
		$_SESSION['seo_meta_edit'] = TRUE;
		
		//-----------------------------------------
		// Boink
		//-----------------------------------------
		
		$this->registry->output->silentRedirect( $this->settings['base_url'] );
	}
	
	/**
	 * Action: Save Tags
	 */
	public function save()
	{
		//-----------------------------------------
		// Are we an admin?
		//-----------------------------------------
	
		if ( ! $this->memberData['g_access_cp'] )
		{
			$this->registry->output->showError( 'meta_editor_no_admin' );
		}
		
		//-----------------------------------------
		// Save em
		//-----------------------------------------
	
		/* Delete any DB entries for this page as we're about to rebuild them */
		$escapedPage = $this->DB->addSlashes( $this->request['url'] );
		$this->DB->delete( 'seo_meta', "url='{$escapedPage}'" );
		
		/* Insert Tags */
		foreach( $this->request['meta-tags-title'] as $k => $v )
		{
			if ( $v )
			{
				$cache[ $this->request['url'] ][ $v ] = $this->request['meta-tags-content'][ $k ];
				$this->DB->insert('seo_meta', array(
					'url'		=> $this->request['url'],
					'name'		=> $v,
					'content'	=> $this->request['meta-tags-content'][ $k ]
					) );
			}
		}
		
		/* Rebuild Cache */
		ips_CacheRegistry::instance()->rebuildCache( 'ipseo_meta', 'ipseo' );
		
		/* Boink */
		$this->registry->output->silentRedirect( ipsRegistry::$settings['base_url'] . $this->request['url'] );
	
	}
	
	/**
	 * Action: End
	 */
	public function end()
	{
		$_SESSION['seo_meta_edit'] = FALSE;
		$this->registry->output->silentRedirect( $_SERVER['HTTP_REFERER'] );
	}
}