<?php

/**
 *
 * Classifieds 1.1.2
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

class admin_classifieds_manage_conditions extends ipsCommand {
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

        $this->conditions = $this->registry->classifieds->helper('conditions');


        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_classifieds' );

        $this->html->form_code    = $this->form_code    = 'module=manage&amp;section=conditions&amp;';
        $this->html->form_code_js = $this->form_code_js = 'module=manage&section=conditions&';

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );

        switch( $this->request['do'] ) {

            case 'manageconditions':
                $this->manageConditions();
                break;

            case 'addcondition':
                $this->conditionForm( 'add' );
                break;

            case 'doaddcondition':
                $this->conditionSave( 'add' );
                break;

            case 'editcondition':
                $this->conditionForm( 'edit' );
                break;

            case 'doeditcondition':
                $this->conditionSave( 'edit' );
                break;

            case 'deletecondition':
                $this->deleteConditionForm();
                break;

            case 'dodeletecondition':
                $this->doDeleteCondition();
                break;

            case 'reorder':
                $this->reorder();
                break;

            default:
                $this->manageConditions();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }


    public function manageConditions() {
        $conditions = $this->conditions->getConditions();
        $this->registry->output->html .= $this->html->manageCondition( $conditions );
    }

    public function conditionForm( $type='add' ) {

        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the condition
            //-----------------------------------------

            $condition = $this->conditions->getConditionById($this->request['id']);

            $form['formcode']	= 'doeditcondition';
            $form['button']	= $this->lang->words['cfds_edit_condition_title'];
        }
        else {

            $condition = array(
                    'id'     => 0,
            );

            $form['formcode'] = 'doaddcondition';
            $form['button']   = $this->lang->words['cfds_add_condition_title'];
        }

        $form['name'] 	= $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $condition['name'] );

        $this->registry->output->html .= $this->html->conditionForm( $condition, $form, $type );
    }

    /**
     * Handles the add/edit condition form
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function conditionSave( $type = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_condition_name'], 1196 );
        }

        if( $type == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_condition_noid'], 1197 );
            }

            //-----------------------------------------
            // Grab condition
            //-----------------------------------------

            $condition = $this->conditions->getConditionById($this->request['id']);

            if( !$condition['condition_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_condition_noid'], 1198 );
            }
        }

        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),
        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_conditions', $db_arr, 'condition_id=' . $condition['condition_id'] );

            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=manageconditions", sprintf( $this->lang->words['cfds_condition_save_edit'], $db_arr['name'] ) );

        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_conditions' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_conditions', $db_arr );
            $conditionid = $this->DB->getInsertId();

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=manageconditions", sprintf( $this->lang->words['cfds_condition_save_add'], $db_arr['name'] ) );
    }

    /**
     * Displays the delete condition form
     *
     * @access	public
     * @return	void
     */
    public function deleteConditionForm() {

        $this->request['condition'] = intval( $this->request['condition'] );

        //-----------------------------------------
        // Grab condition
        //-----------------------------------------

        $condition = $this->conditions->getConditionById($this->request['condition']);

        //-----------------------------------------
        // Change to condition
        //-----------------------------------------

        $conditions = $this->conditions->getConditions();

        $conditionslist[] = array(0, $this->lang->words['cfds_none']);

        foreach ($conditions as $row) {
            if ($row['condition_id'] != $condition['condition_id']) {
                $conditionslist[] = array($row['condition_id'], $row['name']);
            }
        }
        $change_condition = $this->registry->output->formDropdown( 'change_condition', $conditionslist );

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->conditionDeleteForm( $condition, $change_condition );
    }

    /**
     * Handle the delete condition form
     *
     * @access	public
     * @return	void
     */
    public function doDeleteCondition() {

        $this->request['condition'] 		= intval( $this->request['condition'] );
        $this->request['change_condition'] 	= intval( $this->request['change_condition'] );

        //-----------------------------------------
        // grab condition
        //-----------------------------------------

        $condition = $this->conditions->getConditionById($this->request['condition']);

        //-----------------------------------------
        // Update Items
        //-----------------------------------------

        $this->DB->update( 'classifieds_items', array( 'item_condition' => $this->request['change_condition']), 'item_condition=' . $condition['condition_id'] );
        
        //-----------------------------------------
        // Delete condition
        //-----------------------------------------
        
        if( !$condition['condition_id'] ) {
            $this->registry->output->showError( $this->lang->words['cfds_cat_noid'], 11910 );
        } else {
            $this->DB->delete( 'classifieds_conditions', 'condition_id = ' . $condition['condition_id']);
        }
        $this->registry->output->main_msg = $this->lang->words['cfds_condition_deleted'];

        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=manageconditions", $this->lang->words['cfds_condition_deleted'] );
    }



    /**
     * Reorder Conditions
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
            $ajax->returnString( $this->lang->words['cfds_condition_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['conditions']) AND count($this->request['conditions']) ) {

            foreach( $this->request['conditions'] as $condition ) {
                $this->DB->update( 'classifieds_conditions', array( 'sort_order' => $position ), 'condition_id=' . $condition );

                $position++;
            }
        }

        $ajax->returnString( 'OK' );
        exit();
    }


}