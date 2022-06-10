<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * IP.Portal
 * Last Updated: $Date: 2010-10-21 14:02:34 -0400 (Thu, 21 Oct 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Portal
 * @link		http://www.invisionpower.com
 * @since		1st April 2004
 * @version		$Revision: 7011 $
 */

if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}

class admin_portal_portal_portal extends ipsCommand
{
	/**
	 * Portal objects
	 *
	 * @var		array
	 */
	private $portal_objects		= array();
	
	/**
	 * Skin object
	 *
	 * @var		object			Skin templates
	 */
	private $html;
	
	/**
	 * Shortcut for url
	 *
	 * @var		string			URL shortcut
	 */
	private $form_code;
	
	/**
	 * Shortcut for url (javascript)
	 *
	 * @var		string			JS URL shortcut
	 */
	private $form_code_js;
	
	/**
	 * Main class entry point
	 *
	 * @param	object		ipsRegistry reference
	 * @return	void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry ) 
	{
		//-----------------------------------------
		// Load HTML
		//-----------------------------------------
		
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_portal' );
		
		//-----------------------------------------
		// Set up stuff
		//-----------------------------------------
		
		$this->form_code	= $this->html->form_code	= 'module=portal&amp;section=portal';
		$this->form_code_js	= $this->html->form_code_js	= 'module=portal&section=portal';
		
		//-----------------------------------------
		// Load Language
		//-----------------------------------------
		
		ipsRegistry::getClass( 'class_localization')->loadLanguageFile( array( 'admin_portal' ) );
		
		//-------------------------------
		// Get portal objects
		//-------------------------------
		
		$this->_getPortalObjects();

		//-----------------------------------------
		// What to do?
		//-----------------------------------------
		
		switch($this->request['do'])
		{
			case 'portal_settings':
				$this->_portalSettings();
			break;
				
			case 'portal_viewtags':
				$this->_portalViewTags();
			break;
			
			case 'manage':
			default:
				$this->_portalList();
			break;
		}
		
		//-----------------------------------------
		// Pass to CP output hander
		//-----------------------------------------
		
		$this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
		$this->registry->getClass('output')->sendOutput();
	}
	
	/**
	 * Rebuild portal cache
	 *
	 * @return	void
	 */
	public function portalRebuildCache()
	{
		$cache = array();
			
		if ( ! is_array( $this->portal_objects ) or ! count( $this->portal_objects ) )
		{
			$this->_getPortalObjects();
		}
		
		$cache = $this->portal_objects;
		
		$this->cache->setCache( 'portal', $cache, array( 'array' => 1 ) );
	}
	
	/**
	 * View portal tags (settings)
	 *
	 * @return	void		[Outputs to screen]
	 */
	private function _portalViewTags()
	{
		//-------------------------------
		// INIT
		//-------------------------------
		
		$pc_key		= IPSText::alphanumericalClean( $this->request['pc_key'] );
		
		foreach( $this->portal_objects as $key => $data )
		{
			if( $key == $pc_key )
			{
				$file = $data['_cfg_location'];
			}
		}

		//-------------------------------
		// Check
		//-------------------------------
		
		if ( ! $pc_key OR ! file_exists( $file ) )
		{
			$this->registry->output->global_message = $this->lang->words['error_no_key'];
			$this->_portalList();
			return;
		}
		
		//-------------------------------
		// Grab config file
		//-------------------------------
		$PORTAL_CONFIG = array();
		require( $file );

		$this->registry->output->html .= $this->html->portal_pop_overview( $PORTAL_CONFIG['pc_title'], $PORTAL_CONFIG['pc_exportable_tags'] );
		
		//-------------------------------
		// Print
		//-------------------------------
		
		$this->registry->output->printPopupWindow();
	}
	
	/**
	 * Show settings for the portal
	 *
	 * @return	void		[Outputs to screen]
	 */
	private function _portalSettings()
	{
		//-------------------------------
		// INIT
		//-------------------------------

		$pc_key	= IPSText::alphanumericalClean( $this->request['pc_key'] );

		foreach( $this->portal_objects as $key => $data )
		{
			if( $key == $pc_key )
			{
				$file = $data['_cfg_location'];
			}
		}

		//-------------------------------
		// Check
		//-------------------------------
		
		if ( ! $pc_key OR ! file_exists( $file ) )
		{

			$this->registry->output->global_message = $this->lang->words['error_no_key'];
			$this->_portalList();
			return;
		}
		
		//-------------------------------
		// Grab config file
		//-------------------------------
		$PORTAL_CONFIG = array();
		require ( $file );

		if ( ! $PORTAL_CONFIG['pc_settings_keyword'] )
		{
			$this->registry->output->global_message = $this->lang->words['error_no_settings'];
			$this->_portalList();
			return;
		}
		
		//-------------------------------
		// Grab, init and load settings
		//-------------------------------
		
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir( 'core' ).'/modules_admin/tools/settings.php', 'admin_core_tools_settings' );
		$settings    = new $classToLoad();
		$settings->makeRegistryShortcuts( $this->registry );
		
		ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_tools' ), 'core' );
		
		$settings->html			= $this->registry->output->loadTemplate( 'cp_skin_tools', 'core' );		
		$settings->form_code	= $settings->html->form_code    = 'module=tools&amp;section=settings';
		$settings->form_code_js	= $settings->html->form_code_js = 'module=tools&section=settings';

		$this->request['conf_title_keyword']	= $PORTAL_CONFIG['pc_settings_keyword'];
		$settings->return_after_save			= $this->settings['base_url'] . $this->form_code . '&do=portal_settings&pc_key='.$pc_key;
		$settings->base_nav_url					= $this->settings['base_url'] . $this->form_code . '&do=portal_settings&pc_key='.$pc_key;
		$settings->_viewSettings();
	}
	
	/**
	 * List the portal objects
	 *
	 * @return	void		[Outputs to screen]
	 */
	private function _portalList()
	{
		$this->registry->output->html .= $this->html->portal_overview( $this->portal_objects );
		
		//-------------------------------
		// Update cache
		//-------------------------------
			
		$this->portalRebuildCache();
	}
	
	/**
	 * Get the portal objects from disk
	 *
	 * @return	void		[Outputs to screen]
	 */
	private function _getPortalObjects()
	{
		//-------------------------------
		// Loop over each application
		//-------------------------------
		
		foreach( ipsRegistry::$applications as $_app_dir => $app_data )
		{
			//-------------------------------
			// Get the path to the plugins
			//-------------------------------
			
			$path = IPSLib::getAppDir( $_app_dir ) . '/extensions/portalPlugins';

			//-------------------------------
			// Does it exist?
			//-------------------------------
			
			if( !is_dir($path) OR !file_exists($path) )
			{
				continue;
			}

			//-------------------------------
			// Open the dir and grab configs
			//-------------------------------
			
			try
			{
				foreach( new DirectoryIterator($path) as $file )
				{
					if( $file->isDot() OR $file->isDir() )
					{
						continue;
					}
            	
					//-------------------------------
					// This is a file...
					//-------------------------------
				
					if( $file->isFile() )
					{
						preg_match( "#^(.*)-cfg\.php$#", $file->getFilename(), $matches );
						
						//-------------------------------
						// And it's a conf file, yahhh!
						//-------------------------------
            	
						if ( $matches[0] AND $matches[1] )
						{
							$PORTAL_CONFIG = array();
							
							require_once( $file->getPathname() );
							
							if ( is_array( $PORTAL_CONFIG ) AND count( $PORTAL_CONFIG ) )
							{
								$PORTAL_CONFIG['pc_key']				= $matches[1];
								$PORTAL_CONFIG['_cfg_location']			= str_replace( '\\', '/', $file->getPathname() );
								$PORTAL_CONFIG['_file_location']		= str_replace( '\\', '/', str_replace( '-cfg', '', $file->getPathname() ) );
								$PORTAL_CONFIG['_app_dir']				= $_app_dir;
								$this->portal_objects[ $matches[1] ]	= $PORTAL_CONFIG;
							}
						}
					}
				}
			} catch ( Exception $e ) {}
		}
		
		if ( ! count($this->portal_objects) )
		{
			$this->registry->output->global_message = $this->lang->words['error_no_dir'];
			return;
		}
	}
}