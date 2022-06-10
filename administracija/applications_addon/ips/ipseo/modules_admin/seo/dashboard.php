<?php
/**
 * Invision Power Services
 * IP.SEO -  Dashboard
 * Last Updated: $Date: 2011-09-16 07:48:45 -0400 (Fri, 16 Sep 2011) $
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 9499 $
 */

class admin_ipseo_seo_dashboard extends ipsCommand
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
			case 'ignore':
				$this->ignoreWarning();
			break;
			
			case 'clear_warnings':
				$this->clearWarnings();
			break;
			
			case 'download_sitemap':
				$this->downloadSitemap();
			break;
			
			default:
				$this->dashboard();
			break;
			
		}
		
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
	
	/**
	 * Action: Download Sitemap
	 */
	public function downloadSitemap()
	{
		header( "Content-type: application/xml" );
		header( "Content-Disposition: attachment; filename=\"sitemap.xml\"" );
		exit;
	}
	
	/**
	 * Action: Show Dashboard
	 */
	public function dashboard()
	{
		$messages = array();
	
		//-----------------------------------------
		// Get Ignored Messages
		//-----------------------------------------

		$ignores  = ips_CacheRegistry::instance()->getCache('ipseo_ignore_messages');
		if(!$ignores) $ignores = array();
						
		//-----------------------------------------
		// Any messages?
		//-----------------------------------------
		
		/* Bad */
		$this->settings['sitemap_path'] = $this->settings['sitemap_path'] ? $this->settings['sitemap_path'] : DOC_IPS_ROOT_PATH;
		if ( !array_key_exists( 'sitemap_path', $ignores ) and ( !file_exists( $this->settings['sitemap_path'] . 'sitemap.xml' ) or !is_writable( $this->settings['sitemap_path'] . 'sitemap.xml' ) ) )
		{
			// Hang on, can we create one?
			@file_put_contents( $this->settings['sitemap_path'] . 'sitemap.xml', '' );
			@chmod( $this->settings['sitemap_path'] . 'sitemap.xml', 0777 );
				
			if ( !file_exists( $this->settings['sitemap_path'] . 'sitemap.xml' ) or !is_writable( $this->settings['sitemap_path'] . 'sitemap.xml' ) )
			{
				$messages[] = array( 'level' => 'bad', 'fix' => 'app=ipseo&module=seo&section=dashboard&do=download_sitemap', 'key' => 'sitemap_path' );
			}
		}
						
		if(!array_key_exists('sitemap_success', $ignores) && !ips_CacheRegistry::instance()->getCache('sitemap_success'))
		{
			$messages[] = array('level' => 'bad', 'fix' => 'app=ipseo&module=sitemap&section=info&do=cron', 'key' => 'sitemap_success');
		}
		
		if(!array_key_exists('url_type', $ignores) && $this->settings['url_type'] != 'path_info')
		{
			$messages[] = array('level' => 'bad', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'url_type');
		}
				
		if(!array_key_exists('seo_index_title', $ignores) && !$this->settings['seo_index_title'])
		{
			$messages[] = array('level' => 'bad', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'seo_index_title');
		}
		
		if(!array_key_exists('seo_index_md', $ignores) && !$this->settings['seo_index_md'])
		{
			$messages[] = array('level' => 'bad', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'seo_index_md');
		}		
		
		if(!array_key_exists('spider_visit', $ignores) && !$this->settings['spider_visit'] )
		{
			$messages[] = array('level' => 'bad', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'spider_visit');
		}

		/* Warn */
		
		if(!array_key_exists('sitemap_not_run', $ignores) && !ips_CacheRegistry::instance()->getCache('sitemap_last_run'))
		{
			$messages[] = array('level' => 'warn', 'fix' => 'app=core&module=system&section=taskmanager&do=overview&tab=ipseo', 'key' => 'sitemap_not_run');
		}
		
		$meta = ips_CacheRegistry::instance()->getCache('ipseo_meta');
		if(!array_key_exists('ipseo_no_meta', $ignores) && (!$meta || !count($meta)))
		{
			$messages[] = array('level' => 'warn', 'fix' => 'app=ipseo&module=seo&section=meta', 'key' => 'ipseo_no_meta');
		}
		
		if(!array_key_exists('sitemap_ping', $ignores) && !$this->settings['sitemap_ping'])
		{
			$messages[] = array('level' => 'warn', 'fix' => 'app=ipseo&module=sitemap&section=info&do=settings', 'key' => 'sitemap_ping');
		}
		
		if(!array_key_exists('seo_r_on', $ignores) && !$this->settings['seo_r_on'])
		{
			$messages[] = array('level' => 'warn', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'seo_r_on');
		}
		
		if(!array_key_exists('htaccess_mod_rewrite', $ignores) && !$this->settings['htaccess_mod_rewrite'])
		{
			$messages[] = array('level' => 'warn', 'fix' => 'app=ipseo&module=seo&section=settings&amp;area=seo', 'key' => 'htaccess_mod_rewrite');
		}
		
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html  = $this->html->dashboard( $messages, $ignores );
	}
	
	/**
	 * Action: Ignore Message
	 */
	public function ignoreWarning()
	{
		$ignores = ips_CacheRegistry::instance()->getCache('ipseo_ignore_messages');
		if( !$ignores )
		{
			$ignores = array();
		}

		$ignores[ $this->request['key'] ] = 1;
		
		ips_CacheRegistry::instance()->setCache( 'ipseo_ignore_messages', $ignores, array( 'array' => 1 ) );
		
		$this->registry->output->silentRedirect( ipsRegistry::$settings['base_url'] . "module=seo" );  
	}
	
	/**
	 * Action: Clear Warnings
	 */
	public function clearWarnings()
	{
		ips_CacheRegistry::instance()->setCache( 'ipseo_ignore_messages', array(), array( 'array' => 1 ) );
		
		$this->registry->output->silentRedirect( ipsRegistry::$settings['base_url'] . "module=seo" );  
	}
	
}