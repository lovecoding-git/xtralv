<?php

/**
 * Product Title:		Shoutbox
 * Product Version:		1.2.7
 * Author:				Michael McCune
 * Website:				Invision Focus
 * Website URL:			http://invisionfocus.com/
 * Email:				michael.mccune@gmail.com
 */

if ( !defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}


class admin_shoutbox_settings_settings extends ipsCommand
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
		/* Check permissions */
		$this->registry->class_permissions->checkPermissionAutoMsg( 'shoutbox_settings_' . $this->request['do'] );
		
		/* Grab, init and load settings */
		$classToLoad = IPSLib::loadActionOverloader( IPSLib::getAppDir('core').'/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings    = new $classToLoad();
		$settings->makeRegistryShortcuts( $this->registry );
		
		/* Load skin and language */
		$settings->html         = $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
		$settings->form_code	= $settings->html->form_code    = 'module=settings&amp;section=settings';
		$settings->form_code_js	= $settings->html->form_code_js = 'module=settings&section=settings';
		
		$this->lang->loadLanguageFile( array( 'admin_tools' ), 'core' );
		
		/* Show our settings */
		$this->request['conf_title_keyword'] = 'shoutbox_'.$this->request['do'];
		$settings->return_after_save         = $this->settings['base_url'] . 'module=settings&amp;section=settings&amp;do=' . $this->request['do'];
		$settings->_viewSettings();
		
		/* Output */
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
}