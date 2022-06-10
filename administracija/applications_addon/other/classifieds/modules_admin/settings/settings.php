<?php

/**
 *
 * Classifieds 1.2.1
 *
 * @author		$Author: Andrew Millne $
 * @copyright   2011 Andrew Millne. All Rights Reserved.
 * @license		http://dev.millne.com/license.html
 * @package		Classifieds
 * @link		http://dev.millne.com
 *
 */

if ( ! defined( 'IN_ACP' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly.";
    exit();
}


class admin_classifieds_settings_settings extends ipsCommand {
    /**
     * Settings gateway
     *
     * @access	protected
     * @var		object
     */
    protected $settingsClass;

    /**
     * Main class entry point
     *
     * @access	public
     * @param	object		ipsRegistry reference
     * @return	void		[Outputs to screen]
     */
    public function doExecute( ipsRegistry $registry ) {

        //-----------------------------------------
        // Load settings controller
        //-----------------------------------------

        $this->registry->class_localization->loadLanguageFile( array( 'admin_tools' ), 'core' );

		$classToLoad	= IPSLib::loadLibrary( IPSLib::getAppDir('core') . '/modules_admin/settings/settings.php', 'admin_core_settings_settings' );
		$settings		= new $classToLoad( $this->registry );
		$settings->makeRegistryShortcuts( $this->registry );


        $settings->html		= $this->registry->output->loadTemplate( 'cp_skin_settings', 'core' );
        $settings->form_code		= $settings->html->form_code		= 'module=tools&amp;section=settings';
        $settings->form_code_js	= $settings->html->form_code_js	= 'module=tools&section=settings';
        $settings->return_after_save	= $this->settings['base_url'] . '&module=settings&updated=1';

        //-----------------------------------------
        // Show settings form
        //-----------------------------------------

        $this->request['conf_title_keyword']	= 'cfds_general';

        //-----------------------------------------
        // View settings
        //-----------------------------------------

        $settings->_viewSettings();

        //-----------------------------------------
        // Pass to CP output hander
        //-----------------------------------------
        if ($this->request['updated'] == 1) {
            $this->registry->output->global_message = "Settings updated";
        }
        $this->registry->getClass('output')->html_main .= $this->registry->getClass('output')->global_template->global_frame_wrapper();
        $this->registry->getClass('output')->sendOutput();
    }

    
}