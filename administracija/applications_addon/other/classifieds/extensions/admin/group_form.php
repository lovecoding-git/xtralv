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

if ( ! defined( 'IN_IPB' ) ) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

class admin_group_form__classifieds implements admin_group_form {
    /**
     * Tab name
     * This can be left blank and the application title will
     * be used
     *
     * @access	public
     * @var	string
     */
    public $tab_name = "";


    /**
     * Returns content for the page.
     *
     * @access	public
     * @param	array 				Group data
     * @param	integer				Number of tabs used so far
     * @return	array 				Array of tabs, content
     */
    public function getDisplayContent( $group=array(), $tabsUsed = 0 ) {
        //-----------------------------------------
        // Load skin
        //-----------------------------------------

        $this->html = ipsRegistry::getClass('output')->loadTemplate( 'cp_skin_classifieds_group_form', 'classifieds' );

        //-----------------------------------------
        // Load lang
        //-----------------------------------------

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ), "classifieds" );
        
        //-----------------------------------------
        // Show...
        //-----------------------------------------

        return array( 'tabs' => $this->html->acp_classifieds_group_form_tabs( $group, ( $tabsUsed + 1 ) ), 'content' => $this->html->acp_classifieds_group_form_main( $group, ( $tabsUsed + 1 ) ), 'tabsUsed' => 1 );
    }

    /**
     * Process the entries for saving and return
     *
     * @access	public
     * @author	Andrew Millne
     * @return	array 				Array of keys => values for saving
     */
    public function getForSave() {
        $return = array(
                'g_classifieds_can_access'		=> intval( ipsRegistry::$request[ 'g_classifieds_can_access' ] ),
                'g_classifieds_can_list'		=> intval( ipsRegistry::$request[ 'g_classifieds_can_list' ] ),
                'g_classifieds_can_open_close'		=> intval( ipsRegistry::$request[ 'g_classifieds_can_open_close' ] ),
                'g_classifieds_can_edit_item'		=> intval( ipsRegistry::$request[ 'g_classifieds_can_edit_item' ] ),
                'g_classifieds_edit_time'		=> intval( ipsRegistry::$request[ 'g_classifieds_edit_time' ] ),
                'g_classifieds_attach_per_item'		=> intval( ipsRegistry::$request[ 'g_classifieds_attach_per_item' ] ),
                'g_classifieds_attach_max'		=> intval( ipsRegistry::$request[ 'g_classifieds_attach_max' ] ),
                'g_classifieds_can_moderate'		=> intval( ipsRegistry::$request[ 'g_classifieds_can_moderate' ] ),

        );

        return $return;
    }
}