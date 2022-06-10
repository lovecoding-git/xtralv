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

class admin_classifieds_manage_fields extends ipsCommand {
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

        $this->fields = $this->registry->classifieds->helper('fields');


        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_fields' );

        $this->html->form_code    = $this->form_code    = 'module=manage&amp;section=fields&amp;';
        $this->html->form_code_js = $this->form_code_js = 'module=manage&section=fields&';

        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );
        $this->lang->loadLanguageFile( array( 'admin_member' ), "members" );

        switch( $this->request['do'] ) {

            case 'managesets':
                $this->manageSets();
                break;
                
            case 'addset':
                $this->setForm( 'add' );
                break;      

            case 'doaddset':
                $this->setSave( 'add' );
                break;      

            case 'editset':
                $this->setForm( 'edit' );
                break;

            case 'doeditset':
                $this->setSave( 'edit' );
                break;

            case 'deleteset':
                $this->deleteSetForm();
                break;

            case 'dodeleteset':
                $this->doDeleteSet();
                break;                
                        	
            case 'managefields':
                $this->manageFields();
                break;

            case 'addfield':
                $this->fieldForm( 'add' );
                break;

            case 'doaddfield':
                $this->fieldSave( 'add' );
                break;

            case 'editfield':
                $this->fieldForm( 'edit' );
                break;

            case 'doeditfield':
                $this->fieldSave( 'edit' );
                break;

            case 'deletefield':
                $this->deleteFieldForm();
                break;

            case 'dodeletefield':
                $this->doDeleteField();
                break;

            case 'reorder':
                $this->reorder();
                break;

            case 'addfieldgroup':
                $this->fieldGroupForm( 'add' );
                break;

            case 'doaddfieldgroup':
                $this->fieldGroupSave( 'add' );
                break;

            case 'editfieldgroup':
                $this->fieldGroupForm( 'edit' );
                break;

            case 'doeditfieldgroup':
                $this->fieldGroupSave( 'edit' );
                break;

            case 'deletefieldgroup':
                $this->deleteFieldGroupForm();
                break;

            case 'dodeletefieldgroup':
                $this->doDeleteFieldGroup();
                break;

            case 'reorderfieldgroups':
                $this->reorderFieldGroups();
                break;

            default:
                $this->manageSets();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }

    public function manageSets() {
    	$globalfields = $this->fields->getGlobals();
        $sets = $this->fields->getSets();
        $this->registry->output->html .= $this->html->manageSets( $globalfields, $sets );
    }
    
    public function setForm( $type='add' ) {

        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the field
            //-----------------------------------------

            $set = $this->fields->getSetById($this->request['id']);


            $form['formcode']	= 'doeditset';
            $form['button']	= "Edit Set";
        }
        else {

            $set = array(
                    'id'     => 0,
            );

            $form['formcode'] = 'doaddset';
            $form['button']   = "Add Set";
        }



        $form['name']          = $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $set['name'] );
        
        $this->registry->output->html .= $this->html->setForm( $set, $form, $type);
    }

    /**
     * Saves the field set info to DB
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function setSave( $type = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_set_name'], 11111 );
            
        }

        if( $type == 'edit' ) {
            $this->request['set_id'] = intval($this->request['set_id']);

            if( !$this->request['set_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_set_noid'], 11111 );
            }

            // Grab set
            $set = $this->fields->getSetById($this->request['set_id']);

            if( !$set['set_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_set_noid'], 11111 );
            }
        }


        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),

        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_field_sets', $db_arr, 'set_id=' . $set['set_id'] );

            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets", sprintf( $this->lang->words['cfds_fieldset_save_edit'], $db_arr['name'] ) );

        } else {

            $this->DB->insert( 'classifieds_field_sets', $db_arr );

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets", sprintf( $this->lang->words['cfds_fieldset_save_add'], $db_arr['name'] ) );
    }

    /**
     * Displays the delete set form
     *
     * @access	public
     * @return	void
     */
    public function deleteSetForm() {
        $this->request['id'] = intval( $this->request['id'] );

        //-----------------------------------------
        // Grab field
        //-----------------------------------------

        $set = $this->fields->getSetById($this->request['id']);

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->setDeleteForm( $set );

    }

    /**
     * Handles the deletion of field set
     *
     * @access	public
     * @return	void
     */
    public function doDeleteSet() {
        $this->request['set_id'] 		= intval( $this->request['set_id'] );

        //-----------------------------------------
        // grab field
        //-----------------------------------------

        $set = $this->fields->getSetById($this->request['set_id']);

        //-----------------------------------------
        // Delete it
        //-----------------------------------------

        $this->fields->deleteSet($set['set_id']);

        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets", $this->lang->words['cfds_fieldset_deleted'] );

    }
    
    
     /**
     * Builds the manage fields overview
     *
     * @access	public
     * @return	void
     */   
    public function manageFields() {
        
    	$_set = intval( $this->request['set'] );
    	
    	// Grab the set
    	
    	$set = $this->fields->getSetById($_set);
    	
    	// Grab the fields
    	
    	$fields = $this->fields->getFields($_set);
    	
    	$this->registry->output->extra_nav[] = array( "{$this->settings['base_url']}&amp;{$this->form_code}do=managefields&amp;set={$set['set_id']}", $set['name'] );

    	
        $this->registry->output->html .= $this->html->manageFields( $fields, $set );
    }

     /**
     * Build the add/edit field form
     *
     * @access	public
     * @return	void
     */
    public function fieldForm( $type='add' ) {

        $form = array();
        $field_groups = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the field
            //-----------------------------------------

            $field = $this->fields->getFieldById($this->request['id']);

            $field['options'] = str_replace( '|', "\n", $field['options'] );

            $form['formcode']	= 'doeditfield';
            $form['button']	= "Edit Field";
        }
        else {

            $field = array(
                    'id'     => 0,
            		'set_id' => intval($this->request['set'])
            );

            $form['formcode'] = 'doaddfield';
            $form['button']   = "Add Field";
        }

        //-----------------------------------------
        // Set field types
        //-----------------------------------------

        $field_types      = array(
                0 => array( "input", "Input" ),
                1 => array( "dropdown", "Dropdown" ),
                2 => array( "radio", "Radio" ),
                3 => array( "checkbox", "Checkbox" ),
                4 => array( "textarea", "Text Area" ),
        );

        //-----------------------------------------
        // Grab field groups
        //-----------------------------------------

        $this->DB->build( array(
                'select' => 'group_id, name',
                'from'   => 'classifieds_field_groups',
        		'where'  => 'set_id = ' . $field['set_id'],
                'order'  => 'sort_order',
        ));

        $this->DB->execute();        
        while ( $row = $this->DB->fetch() ) {
            $field_groups[] = array($row['group_id'], $row['name']);
        }
        
        // Are there any groups to add to?
        
        if ($this->request['global'] != 1) {
	        if (empty($field_groups)) {      	
	        	$this->registry->output->showError( "No group to add to", 11111 );
	        }
        }
        

        $form['title']          = $this->registry->output->formInput( 'title', $this->request['title'] ? $this->request['title'] : $field['title'] );
        $form['description']    = $this->registry->output->formInput( 'description', $this->request['description'] ? $this->request['description'] : $field['description'] );
        if ($this->request['global'] != 1) {
        	$form['group']          = $this->registry->output->formDropdown( 'group', $field_groups ,$this->request['group'] ? $this->request['group'] : $field['group_id'] );
        }
        $form['required']       = $this->registry->output->formYesNo( 'required', $this->request['required'] ? $this->request['required'] : $field['required'] );
        $form['active']         = $this->registry->output->formYesNo( 'active', $this->request['active'] ? $this->request['active'] : $field['active'] );
        $form['field_type']     = $this->registry->output->formDropdown( 'field_type', $field_types ,$this->request['field_type'] ? $this->request['field_type'] : $field['type'], 'field_type', 'onchange="change()"' );
        $form['options']        = $this->registry->output->formTextArea( 'options', $this->request['options'] ? $this->request['options'] : $field['options'], '20', '5' );

        $this->registry->output->html .= $this->html->fieldForm( $field, $form, $type );
    }

    /**
     * Handles the saving of field info to DB
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function fieldSave( $type = 'add' ) {
        $this->request['title'] = trim( $this->request['title'] );

        if( $this->request['title'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_field_name'], 11111 );
        }

        if( $type == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_field_noid'], 11111 );
            }

            // Grab field
            $field = $this->fields->getFieldById($this->request['id']);

            if( !$field['field_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_field_noid'], 11111 );
            }
        }

        $options = str_replace( "\n", '|', str_replace( "\n\n", "\n", str_replace( "\r", "\n", trim( $_POST['options'] ) ) ) );


        $db_arr =  array (
                'title'          => IPSText::stripslashes($this->request['title']),
                'description'    => IPSText::stripslashes($this->request['description']),
                'required'       => intval($this->request['required']),
                'max'            => intval($this->request['max']),
                'min'            => intval($this->request['min']),
                'type'           => IPSText::stripslashes($this->request['field_type']),
                'active'         => intval($this->request['active']),
                'group_id'       => intval($this->request['group']),
                'options'        => IPSText::stripslashes($options),
        		'set_id'		 => intval($this->request['set_id']),


        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_fields', $db_arr, 'field_id=' . $field['field_id'] );
			if($db_arr['set_id']) {
            	$this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managefields&amp;set={$db_arr['set_id']}", sprintf( $this->lang->words['cfds_field_save_edit'], $db_arr['title'] ) );
			} else {
				$this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets", sprintf( $this->lang->words['cfds_field_save_edit'], $db_arr['title'] ) );
			}
        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_fields' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_fields', $db_arr );

        }

        if($db_arr['set_id']) {
        	$this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managefields&amp;set={$db_arr['set_id']}", sprintf( $this->lang->words['cfds_field_save_add'], $db_arr['title'] ) );
        } else {
        	$this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets", sprintf( $this->lang->words['cfds_field_save_add'], $db_arr['title'] ) );
        }
    }

    /**
     * Displays the delete field form
     *
     * @access	public
     * @return	void
     */
    public function deleteFieldForm() {
        $this->request['id'] = intval( $this->request['id'] );

        //-----------------------------------------
        // Grab field
        //-----------------------------------------

        $field = $this->fields->getFieldById($this->request['id']);

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->fieldDeleteForm( $field );

    }

    /**
     * Handle the delete field form
     *
     * @access	public
     * @return	void
     */
    public function doDeleteField() {
        $this->request['field_id'] 		= intval( $this->request['field_id'] );

        //-----------------------------------------
        // grab field
        //-----------------------------------------

        $field = $this->fields->getFieldById($this->request['field_id']);

        //-----------------------------------------
        // Delete it
        //-----------------------------------------

        $this->fields->deleteField($field['field_id']);

        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managesets&amp;set={$field['set_id']}", $this->lang->words['cfds_field_deleted'] );

    }



    /**
     * Reorder Fields
     *
     * @access	public
     * @return	void
     */
    public function reorder() {

        require_once( IPS_KERNEL_PATH . 'classAjax.php' );
        $ajax			= new classAjax();

        //-----------------------------------------
        // Checks...
        //-----------------------------------------

        if( $this->registry->adminFunctions->checkSecurityKey( $this->request['md5check'], true ) === false ) {
            $ajax->returnString( $this->lang->words['cfds_fields_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['fields']) AND count($this->request['fields']) ) {

            foreach( $this->request['fields'] as $field ) {
                $this->DB->update( 'classifieds_fields', array( 'sort_order' => $position ), 'field_id=' . $field );

                $position++;
            }
        }

        $ajax->returnString( 'OK' );
        exit();
    }



    /**
     * Build the field group form
     *
     * @access	public
     * @return	void
     */
    
    public function fieldGroupForm( $type='add' ) {

        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the group
            //-----------------------------------------

            $group = $this->fields->getGroupById($this->request['id']);

            $form['formcode']	= 'doeditfieldgroup';
            $form['button']	= "Edit Group";
        }
        else {

            $group = array(
                    'id'     => 0,
            		'set_id' => intval($this->request['set'])
            );

            $form['formcode'] = 'doaddfieldgroup';
            $form['button']   = "Add Group";
        }




        $form['name']          = $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $group['name'] );

        $this->registry->output->html .= $this->html->fieldGroupForm( $group, $form, $type );
    }

    /**
     * Save field group to DB
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function fieldGroupSave( $type = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_fieldgroup_name'], 11111 );
        }

        if( $type == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_fieldgroup_noid'], 11111 );
            }

            //-----------------------------------------
            // Grab group
            //-----------------------------------------

            $group = $this->fields->getGroupById($this->request['id']);

            if( !$group['group_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_fieldgroup_noid'], 11111 );
            }
        }

        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),
        		'set_id'		=> intval($this->request['set_id'])

        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_field_groups', $db_arr, 'group_id=' . $group['group_id'] );

            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managefieldgroups", sprintf( $this->lang->words['cfds_fieldgroup_save_edit'], $db_arr['name'] ) );

        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_field_groups' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_field_groups', $db_arr );

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managefields&amp;set={$db_arr['set_id']}", sprintf( $this->lang->words['cfds_fieldgroup_save_add'], $db_arr['name'] ) );
    }


    /**
     * Displays the delete field group form
     *
     * @access	public
     * @return	void
     */
    public function deleteFieldGroupForm() {
        $this->request['id'] = intval( $this->request['id'] );

        //-----------------------------------------
        // Grab group
        //-----------------------------------------

        $group = $this->fields->getGroupById($this->request['id']);

        //-----------------------------------------
        // Build list of potential new groups menu
        //-----------------------------------------

        $groups = $this->fields->getGroups($group['set_id']);

        $menu[] = array( "0","None, Delete");

        foreach ($groups as $row) {
            if ($row['group_id'] != $group['group_id']  ) {

                $menu[] = array($row['group_id'], $row['name']);

            }
        }

        $move_fields = $this->registry->output->formDropdown( 'move_fields', $menu );

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->fieldGroupDeleteForm( $group, $move_fields );

    }

    /**
     * Handle the delete field group
     *
     * @access	public
     * @return	void
     */
    public function doDeleteFieldGroup() {
        $this->request['group'] 		= intval( $this->request['group'] );
        $this->request['move_fields'] 	= intval( $this->request['move_fields'] );

        //-----------------------------------------
        // grab group
        //-----------------------------------------

        $group = $this->fields->getGroupById($this->request['group']);

        //-----------------------------------------
        // Update fields
        //-----------------------------------------
        
        if( $this->request['move_fields'] > 0 ) {

            $this->DB->update( 'classifieds_fields', array( 'group_id' => $this->request['move_fields']), 'group_id=' . $group['group_id'] );

        } else {

            $this->DB->delete( 'classifieds_fields', 'group_id = ' . $group['group_id']);

        }

        $this->DB->delete( 'classifieds_field_groups', 'group_id = ' . $group['group_id']);
        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managefields&amp;set={$group['set_id']}", $this->lang->words['cfds_field_group_deleted'] );

    }

    /**
     * Reorder Groups
     *
     * @access	public
     * @return	void
     */
    public function reorderFieldGroups() {

        require_once( IPS_KERNEL_PATH . 'classAjax.php' );
        $ajax			= new classAjax();

        //-----------------------------------------
        // Checks...
        //-----------------------------------------

        if( $this->registry->adminFunctions->checkSecurityKey( $this->request['md5check'], true ) === false ) {
            $ajax->returnString( $this->lang->words['cfds_fieldgroups_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['groups']) AND count($this->request['groups']) ) {

            foreach( $this->request['groups'] as $group ) {
                $this->DB->update( 'classifieds_field_groups', array( 'sort_order' => $position ), 'group_id=' . $group );

                $position++;
            }
        }

        $ajax->returnString( 'OK' );
        exit();
    }

}