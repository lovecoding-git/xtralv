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

class admin_classifieds_manage_types extends ipsCommand {
    /**
     * Skin object
     *
     * @access	private
     * @var		object			Skin templates
     */
    private $html;

    /**
     * Shortcut for url
     *
     * @access	private
     * @var		string			URL shortcut
     */
    private $form_code;

    /**
     * Shortcut for url (javascript)
     *
     * @access	private
     * @var		string			JS URL shortcut
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
        // Load libraries
        //-----------------------------------------

        $this->types = $this->registry->classifieds->helper('types');


        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_classifieds' );

        $this->html->form_code    = $this->form_code    = 'module=manage&amp;section=types&amp;';
        $this->html->form_code_js = $this->form_code_js = 'module=manage&section=types&';

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );

        switch( $this->request['do'] ) {

            case 'managetypes':
                $this->manageTypes();
                break;

            case 'addtype':
                $this->typeForm( 'add' );
                break;

            case 'doaddtype':
                $this->typeSave( 'add' );
                break;

            case 'edittype':
                $this->typeForm( 'edit' );
                break;

            case 'doedittype':
                $this->typeSave( 'edit' );
                break;

            case 'deletetype':
                $this->deleteTypeForm();
                break;

            case 'dodeletetype':
                $this->doDeleteType();
                break;

            case 'reorder':
                $this->reorder();
                break;

            default:
                $this->manageTypes();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }


    public function manageTypes() {
        $types = $this->types->getTypes();
        $this->registry->output->html .= $this->html->manageType( $types );
    }

    public function typeForm( $type='add' ) {

        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the type
            //-----------------------------------------

            $type = $this->types->getTypeById($this->request['id']);

            $form['formcode']	= 'doedittype';
            $form['button']	= $this->lang->words['cfds_edit_type_title'];
        }
        else {

            $type = array(
                    'id'     => 0,
            );

            $form['formcode'] = 'doaddtype';
            $form['button']   = $this->lang->words['cfds_add_type_title'];
        }
        
        
        //-----------------------------------------
        // Available Colors
        //-----------------------------------------

        $badge_colors      = array(
                0 => array( "green", "Green" ),
                1 => array( "purple", "Purple" ),
                2 => array( "grey", "Grey" ),
                3 => array( "lightgrey", "Light Grey" ),
                4 => array( "orange", "Orange" ),
                5 => array( "red", "Red"),
        );
        

        $form['name'] 	= $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $type['name'] );
		$form['show_badge'] 	= $this->registry->output->formYesNo( 'show_badge', $this->request['show_badge'] ? $this->request['show_badge'] : $type['show_badge'] );
        $form['badge_color']     = $this->registry->output->formDropdown( 'badge_color', $badge_colors ,$this->request['badge_color'] ? $this->request['badge_color'] : $type['badge_color'], 'badge_color');
        $form['zero_text'] 	= $this->registry->output->formInput( 'zero_text', $this->request['zero_text'] ? $this->request['zero_text'] : $type['zero_text'] );
		
        
        $this->registry->output->html .= $this->html->typeForm( $type, $form, $type );
    }

    /**
     * Handles the add/edit type form
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function typeSave( $savetype = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_type_name'], 1196 );
        }

        if( $savetype == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_type_noid'], 1197 );
            }

            //-----------------------------------------
            // Grab type
            //-----------------------------------------

            $type = $this->types->getTypeById($this->request['id']);

            if( !$type['type_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_type_noid'], 1198 );
            }
        }

        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),
        		'show_badge'	=> intval($this->request['show_badge']),
        		'badge_color'	=> IPSText::stripslashes($this->request['badge_color']),
				'zero_text'          => IPSText::stripslashes($this->request['zero_text']),        
        );

        if( $savetype == 'edit' ) {

            $this->DB->update( 'classifieds_types', $db_arr, 'type_id=' . $type['type_id'] );

            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managetypes", sprintf( $this->lang->words['cfds_type_save_edit'], $db_arr['name'] ) );

        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_types' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_types', $db_arr );
            $typeid = $this->DB->getInsertId();

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managetypes", sprintf( $this->lang->words['cfds_type_save_add'], $db_arr['name'] ) );
    }

    /**
     * Displays the delete type form
     *
     * @access	public
     * @return	void
     */
    public function deleteTypeForm() {

        $this->request['type'] = intval( $this->request['type'] );

        //-----------------------------------------
        // Grab type
        //-----------------------------------------

        $type = $this->types->getTypeById($this->request['type']);

        //-----------------------------------------
        // Change to type
        //-----------------------------------------

        $types = $this->types->getTypes();

        $typeslist[] = array(0, $this->lang->words['cfds_none']);

        foreach ($types as $row) {
            if ($row['type_id'] != $type['type_id']) {
                $typeslist[] = array($row['type_id'], $row['name']);
            }
        }
        $change_type = $this->registry->output->formDropdown( 'change_type', $typeslist );

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->typeDeleteForm( $type, $change_type );
    }

    /**
     * Handle the delete type form
     *
     * @access	public
     * @return	void
     */
    public function doDeleteType() {

        $this->request['type'] 		= intval( $this->request['type'] );
        $this->request['change_type'] 	= intval( $this->request['change_type'] );

        //-----------------------------------------
        // grab type
        //-----------------------------------------

        $type = $this->types->getTypeById($this->request['type']);

        //-----------------------------------------
        // Update Items
        //-----------------------------------------

        $this->DB->update( 'classifieds_items', array( 'advert_type' => $this->request['change_type']), 'advert_type=' . $type['type_id'] );
        
        //-----------------------------------------
        // Delete type
        //-----------------------------------------
        
        if( !$type['type_id'] ) {
            $this->registry->output->showError( $this->lang->words['cfds_cat_noid'], 11910 );
        } else {
            $this->DB->delete( 'classifieds_types', 'type_id = ' . $type['type_id']);
        }
        $this->registry->output->main_msg = $this->lang->words['cfds_type_deleted'];

        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managetypes", $this->lang->words['cfds_type_deleted'] );
    }



    /**
     * Reorder Types
     *
     * @access	public
     * @return	void
     */
    public function reorder() {

		$classToLoad			= IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classAjax.php', 'classAjax' );
		$ajax					= new $classToLoad();

        //-----------------------------------------
        // Checks...
        //-----------------------------------------

        if( $this->registry->adminFunctions->checkSecurityKey( $this->request['md5check'], true ) === false ) {
            $ajax->returnString( $this->lang->words['cfds_type_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['types']) AND count($this->request['types']) ) {

            foreach( $this->request['types'] as $type ) {
                $this->DB->update( 'classifieds_types', array( 'sort_order' => $position ), 'type_id=' . $type );

                $position++;
            }
        }

        $ajax->returnString( 'OK' );
        exit();
    }


}