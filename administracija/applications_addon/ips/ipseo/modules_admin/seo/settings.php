<?php

class admin_ipseo_seo_settings extends ipsCommand
{
	public function doExecute( ipsRegistry $registry )
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
		$this->settingsClass->return_after_save	= $this->settings['base_url'] . '&module=seo&section=settings' . "&amp;area={$this->request['area']}";

		//-----------------------------------------
		// Show settings form
		//-----------------------------------------

		if ( !$this->request['area'] )
		{
			$this->request['conf_title_keyword']	= 'ipseo';
		}
		else
		{
			$this->request['conf_title_keyword']	= $this->request['area'];
		}
		$this->settingsClass->_viewSettings();
				
		//-----------------------------------------
		// Send output
		//-----------------------------------------	
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}
}