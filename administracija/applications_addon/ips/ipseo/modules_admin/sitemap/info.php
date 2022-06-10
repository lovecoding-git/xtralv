<?php
/**
 * Invision Power Services
 * IP.SEO -  Sitemap
 * Last Updated: $Date: 2011-05-05 11:26:38 -0400 (Thu, 05 May 2011) $
 *
 * @author 		$Author: mark $
 * @copyright	(c) 2010-2011 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.SEO
 * @link		http://www.invisionpower.com
 * @version		$Revision: 8652 $
 */
if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

class admin_ipseo_sitemap_info extends ipsCommand
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
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_sitemap' );
		
		//-----------------------------------------
		// What are we doing?
		//-----------------------------------------

		switch($this->request['do'])
		{
			case 'settings':
				$this->doSettings();
			break;
		
			case 'cron':
				$this->doCronInstructions();
			break;
			
			default:
				$this->lastRun();
			break;
		}
		
		//-----------------------------------------
		// Display
		//-----------------------------------------
		
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
		
	}
	
	/**
	 * Action: Show Log of Last Run
	 */
	public function lastRun()
	{
		$log  = ips_CacheRegistry::instance()->getCache('sitemap_log');
		
		$last = ips_CacheRegistry::instance()->getCache('sitemap_last_run');
		$last = sprintf( $this->lang->words['sitemaplog_lastran'], $this->lang->getDate( $last, 'JOINED' ) );
		
		$this->registry->output->html  = $this->html->log( $log, $last );
	}
	
	/**
	 * Action: Show Cron Instructions
	 */	
	protected function doCronInstructions()
	{
		$this->registry->output->html  = $this->html->cronInstructions();
	}
	
	/**
	 * Action: Show Settings
	 */	
	protected function doSettings()
	{
		//-----------------------------------------
		// Load settings controller
		//-----------------------------------------
		$this->registry->class_localization->loadLanguageFile( array( 'admin_tools' ), 'core' );
		
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'core' ) . '/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$this->settingsClass					= new $classToLoad( $this->registry );
		$this->settingsClass->makeRegistryShortcuts( $this->registry );
		$this->settingsClass->html				= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
		$this->settingsClass->form_code			= $this->settingsClass->html->form_code		= 'module=settings&amp;section=settings';
		$this->settingsClass->form_code_js		= $this->settingsClass->html->form_code_js	= 'module=settings&section=settings';
		$this->settingsClass->return_after_save	= $this->settings['base_url'] . '&module=sitemap&do=settings';

		//-----------------------------------------
		// Show settings form
		//-----------------------------------------

		$this->request['conf_title_keyword']	= 'sitemaps';
		$this->settingsClass->_viewSettings();
				
		//-----------------------------------------
		// Send output
		//-----------------------------------------	
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
}