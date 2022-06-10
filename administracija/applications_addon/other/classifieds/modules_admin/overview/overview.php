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
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
    exit();
}

class admin_classifieds_overview_overview extends ipsCommand {
    /**
     * Skin object
     *
     * @access	private
     * @var	object			Skin templates
     */
    private $html;

    /**
     * Shortcut for url
     *
     * @access	private
     * @var	string			URL shortcut
     */
    private $form_code;

    /**
     * Shortcut for url (javascript)
     *
     * @access	private
     * @var	string			JS URL shortcut
     */
    private $form_code_js;

    /**
     * Main class entry point
     *
     * @access	public
     * @param	object		ipsRegistry reference
     * @return	void		[Outputs to screen]
     */
    public function doExecute( ipsRegistry $registry ) {

        //-----------------------------------------
        // Load Libraries
        //-----------------------------------------

        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_classifieds' );

        $this->form_code    = 'module=overview&amp;section=overview';
        $this->form_code_js = 'module=overview&section=overview';

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );

        switch( $this->request['do'] ) {

            case 'overview':
                $this->overview();
                break;

            default:
                $this->overview();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------
        
        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }

    public function overview() {

        //---------------------------------------
		// Get Upgrade History
		//---------------------------------------

		$upgrade = array();

		$this->DB->build( array( 'select' => '*', 'from' => 'upgrade_history', 'where' => "upgrade_app='classifieds'", 'order' => 'upgrade_id DESC' ) );
		$this->DB->execute();

		$latest_version = '';
		while( $i = $this->DB->fetch() )
		{
			/* Latest Version */
			$latest_version = $latest_version ? $latest_version : $i['upgrade_version_id'];

			$i['upgrade_date'] = $this->registry->class_localization->getDate( $i['upgrade_date'], 'LONG' );

			$upgrade[] = $i;
		}

        $this->registry->output->html .= $this->html->classifiedsOverview($upgrade);
    }


}