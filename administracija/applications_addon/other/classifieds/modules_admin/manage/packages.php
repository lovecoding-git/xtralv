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

class admin_classifieds_manage_packages extends ipsCommand {
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

        $this->packages = $this->registry->classifieds->helper('packages');


        //-----------------------------------------
        // Load Skin Template
        //-----------------------------------------

        $this->html = $this->registry->output->loadTemplate( 'cp_skin_classifieds' );

        $this->html->form_code    = $this->form_code    = 'module=manage&amp;section=packages&amp;';
        $this->html->form_code_js = $this->form_code_js = 'module=manage&section=packages&';

        ipsRegistry::getClass('class_localization')->loadLanguageFile( array( 'admin_lang' ) );
        $this->lang->loadLanguageFile( array( 'admin_lang' ), "classifieds" );

        switch( $this->request['do'] ) {

            case 'managepackages':
                $this->managePackages();
                break;

            case 'addpackage':
                $this->packageForm( 'add' );
                break;

            case 'doaddpackage':
                $this->packageSave( 'add' );
                break;

            case 'editpackage':
                $this->packageForm( 'edit' );
                break;

            case 'doeditpackage':
                $this->packageSave( 'edit' );
                break;

            case 'deletepackage':
                $this->deletePackageForm();
                break;

            case 'dodeletepackage':
                $this->doDeletePackage();
                break;

            case 'reorder':
                $this->reorder();
                break;

            default:
                $this->managePackages();
                break;
        }

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }


    public function managePackages() {
        $packages = $this->packages->getPackages();
        $this->registry->output->html .= $this->html->managePackages( $packages );
    }

    public function packageForm( $type='add' ) {

        $form = array();

        if( $type == 'edit' ) {
            $this->request['id'] = intval( $this->request['id'] );

            //-----------------------------------------
            // Grab the package
            //-----------------------------------------

            $package = $this->packages->getPackageById($this->request['id']);            

            $form['formcode']	= 'doeditpackage';
            $form['button']	= $this->lang->words['cfds_edit_package_title'];
            
            $rates = $package['rates'];
            
        }
        else {

            $package = array(
                    'id'     => 0,
            );
            
            $rates = array();

            $form['formcode'] = 'doaddpackage';
            $form['button']   = $this->lang->words['cfds_add_package_title'];
        }
        
        $rates[] = array( 'value' => '', 'base' => '', 'renewal' => '' );


        $form['name']           = $this->registry->output->formInput( 'name', $this->request['name'] ? $this->request['name'] : $package['name'] );
        $form['description'] 	= $this->registry->output->formTextArea( 'description', $this->request['description'] ? $this->request['description'] : $package['description'] );
        $form['price']          = $this->registry->output->formInput( 'price', $this->request['price'] ? $this->request['price'] : $package['price'] );
        $form['duration'] 	= $this->registry->output->formInput( 'duration', $this->request['duration'] ? $this->request['duration'] : $package['duration'] );
        $form['active'] 	= $this->registry->output->formYesNo( 'active', $this->request['active'] ? $this->request['active'] : $package['active'] );
        $form['renewal_price']  = $this->registry->output->formInput( 'renewal_price', $this->request['renewal_price'] ? $this->request['renewal_price'] : $package['renewal_price'] );
        $form['max_renewals']   = $this->registry->output->formInput( 'max_renewals', $this->request['max_renewals'] ? $this->request['max_renewals'] : $package['max_renewals'] );
		$form['member_groups'] = ipsRegistry::getClass('output')->generateGroupDropdown( 'member_groups[]', ( empty( $package ) or $package['member_groups'] == '*' ) ? NULL : explode( ',', $package['member_groups'] ), TRUE );
        $form['feature'] 	= $this->registry->output->formYesNo( 'feature', $this->request['feature'] ? $this->request['feature'] : $package['enhancements']['feature'] );
        
        //-----------------------------------------
        // Available Pricing Formats
        //-----------------------------------------

        $price_formats      = array(
                0 => array( "flat", "Flat Rate" ),
                1 => array( "value", "Item Value" ),
        );        
        
        $form['pricing_format']     = $this->registry->output->formDropdown( 'pricing_format', $price_formats ,$this->request['pricing_format'] ? $this->request['pricing_format'] : $package['pricing_format'], 'pricing_format', 'onchange="change()"' );
        
        
        if (IPSLib::appIsInstalled('nexus')) {
            $this->lang->loadLanguageFile( array( 'admin_nexus' ), 'nexus' );

            $dropdown = array( array( 0, $this->lang->words['package_notax'] ) );
            $this->DB->build( array( 'select' => '*', 'from' => 'nexus_tax', 'order' => 't_order' ) );
            $this->DB->execute();

            while ( $row = $this->DB->fetch() )
            {
                $dropdown[] = array( $row['t_id'], $row['t_name'] );
            }

            $form['tax_class'] = $this->registry->output->formDropdown( 'tax_class', $dropdown, $this->request['tax_class'] ? $this->request['tax_class'] : $package['tax_class'] );
        }

        $this->registry->output->html .= $this->html->packageForm( $package, $form, $type, $rates );
    }

    /**
     * Handles the add/edit package form
     *
     * @access	public
     * @param	string  $type  Either add or edit
     * @return	void
     */
    public function packageSave( $type = 'add' ) {
        $this->request['name'] = trim( $this->request['name'] );

        if( $this->request['name'] == "" ) {
            $this->registry->output->showError( $this->lang->words['cfds_no_package_name'], 1196 );
        }

        if( !is_numeric($this->request['duration']) || $this->request['duration'] < 1 ) {
            $this->registry->output->showError( $this->lang->words['cfds_invalid_duration'], "####" );
        }

        if( !is_numeric($this->request['price']) && ($this->request['price'] != "" ) ) {
            $this->registry->output->showError( $this->lang->words['cfds_invalid_price'], "####" );
        }

        if( !is_numeric($this->request['renewal_price']) && ($this->request['renewal_price'] != "" ) ) {
            $this->registry->output->showError( $this->lang->words['cfds_invalid_renewal_price'], "####" );
        }

        if( ($this->request['price'] > 0 || $this->request['renewal_price'] > 0)  && (!IPSLib::appIsInstalled('nexus')) ) {
            $this->registry->output->showError( $this->lang->words['cfds_price_no_nexus'], "1196308" );
        }
        
    	if ( empty( $this->request['member_groups'] ) )
		{
			$member_groups = '*';
		}
		else
		{
			$member_groups = implode( ',', $this->request['member_groups'] );
		}
		
		// Build enhancements array
		$enhancements = array(
							'feature' => intval($this->request['feature']),
		);
		
		// Rates
		$rates = array();
		
		if ( in_array($this->request['pricing_format'], array('flat', 'value'))) {
								
			$count = 0;
			do
			{
				if ( $this->request[ 'rate-to-' . $count ] and (!is_numeric( $this->request[ 'rate-base-' . $count ] ) || !is_numeric( $this->request[ 'rate-renewal-' . $count ] ) ) )
				{
					$this->registry->output->showError( 'Invalid Rates', '20CFDM2005', FALSE, '', 500 );
				}
				$rates[ $count ] = array( 'value' => $this->request[ 'rate-to-' . $count ], 'base' => $this->request[ 'rate-base-' . $count ], 'renewal' => $this->request[ 'rate-renewal-' . $count ] );
				$count++;
			}
			while ( $this->request[ 'rate-to-' . $count ] or $this->request[ 'rate-to-' . $count ] === '0' );
		
		}


        if( $type == 'edit' ) {
            $this->request['id'] = intval($this->request['id']);

            if( !$this->request['id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_package_noid'], 1197 );
            }

            //-----------------------------------------
            // Grab package
            //-----------------------------------------

            $package = $this->packages->getPackageById($this->request['id']);

            if( !$package['package_id'] ) {
                $this->registry->output->showError( $this->lang->words['cfds_package_noid'], 1198 );
            }
        }

        $db_arr =  array (
                'name'          => IPSText::stripslashes($this->request['name']),
                'description'          => IPSText::stripslashes($this->request['description']),
                'duration'          => intval($this->request['duration']),
                'price'          => IPSText::stripslashes($this->request['price']),
                'active'          => IPSText::stripslashes($this->request['active']),
                'max_renewals'      => intval($this->request['max_renewals']),
                'tax_class'      => intval($this->request['tax_class']),
                'renewal_price'          => IPSText::stripslashes($this->request['renewal_price']),
        		'member_groups'		=> $member_groups,
        		'enhancements' => serialize($enhancements),
        		'pricing_format' => IPSText::stripslashes($this->request['pricing_format']),
        		'rates'	=> ( !empty($rates) ) ? serialize($rates) : "",
        );

        if( $type == 'edit' ) {

            $this->DB->update( 'classifieds_packages', $db_arr, 'package_id=' . $package['package_id'] );

            $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managepackages", sprintf( $this->lang->words['cfds_package_save_edit'], $db_arr['name'] ) );

        } else {

            $max = $this->DB->buildAndFetch( array( 'select' => 'MAX(sort_order) as pos', 'from' => 'classifieds_packages' ) );
            $db_arr['sort_order'] = $max['pos'] + 1;
            $this->DB->insert( 'classifieds_packages', $db_arr );
            $packageid = $this->DB->getInsertId();

        }


        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managepackages", sprintf( $this->lang->words['cfds_package_save_add'], $db_arr['name'] ) );
    }

    /**
     * Displays the delete package form
     *
     * @access	public
     * @return	void
     */
    public function deletePackageForm() {

        $this->request['package'] = intval( $this->request['package'] );

        //-----------------------------------------
        // Grab package
        //-----------------------------------------

        $package = $this->packages->getPackageById($this->request['package']);

        //-----------------------------------------
        // Active items
        //-----------------------------------------

        $this->checkActiveItems($package['package_id']);

        //-----------------------------------------
        // Change to package
        //-----------------------------------------

        $packages = $this->packages->getPackages();

        $packageslist[] = array(0, $this->lang->words['cfds_none']);

        foreach ($packages as $row) {
            if ($row['package_id'] != $package['package_id']) {
                $packageslist[] = array($row['package_id'], $row['name']);
            }
        }
        $change_package = $this->registry->output->formDropdown( 'change_package', $packageslist );

        //-----------------------------------------
        // Output
        //-----------------------------------------

        $this->registry->output->html .= $this->html->packageDeleteForm( $package, $change_package );
    }

    /**
     * Handle the delete package form
     *
     * @access	public
     * @return	void
     */
    public function doDeletePackage() {

        $this->request['package'] = intval( $this->request['package'] );

        //-----------------------------------------
        // grab package
        //-----------------------------------------

        $package = $this->packages->getPackageById($this->request['package']);

        //-----------------------------------------
        // Active items
        //-----------------------------------------

        $this->checkActiveItems($package['package_id']);
             
        //-----------------------------------------
        // Delete package
        //-----------------------------------------
        
        if( !$package['package_id'] ) {
            $this->registry->output->showError( $this->lang->words['cfds_cat_noid'], 11910 );
        } else {
            $this->DB->delete( 'classifieds_packages', 'package_id = ' . $package['package_id']);
        }
        $this->registry->output->main_msg = $this->lang->words['cfds_package_deleted'];

        $this->registry->output->redirect( $this->settings['base_url'].$this->form_code."do=managepackages", $this->lang->words['cfds_package_deleted'] );
    }



    /**
     * Reorder Packages
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
            $ajax->returnString( $this->lang->words['cfds_package_badmd5'] );
            exit();
        }

        //-----------------------------------------
        // Save new position
        //-----------------------------------------

        $position	= 1;

        if( is_array($this->request['packages']) AND count($this->request['packages']) ) {

            foreach( $this->request['packages'] as $package ) {
                $this->DB->update( 'classifieds_packages', array( 'sort_order' => $position ), 'package_id=' . $package );

                $position++;
            }
        }

        $ajax->returnString( 'OK' );
        exit();
    }

    private function checkActiveItems($package) {
                $items = $this->DB->buildAndFetch(array('select' => 'i.item_id',
                    'from' => array('classifieds_items' => 'i'),
                    'where' => 'package = ' . intval($package),
                    'limit' => 1,
                        ));

        if ($this->DB->getTotalRows() > 0) {
            $this->registry->output->showError('You cannot delete a package with active items. Please disable instead.', 109304, false);
        }
    }


}