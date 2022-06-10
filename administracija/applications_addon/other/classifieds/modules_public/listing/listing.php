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

if (! defined( 'IN_IPB' )) {
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class public_classifieds_listing_listing extends ipsCommand {
	
	public function doExecute(ipsRegistry $registry) {
		
		// Load Languages
		$this->lang->loadLanguageFile( array('public_post' ), 'forums' );
		
		// Load library
		

		$this->categories = $this->registry->classifieds->helper( 'categories' );
		$this->items = $this->registry->classifieds->helper( 'items' );
		$this->fields = $this->registry->classifieds->helper( 'fields' );
		
		$this->post_key =(isset( $this->request['attach_post_key'] ) and $this->request['attach_post_key'] != "") ? $this->request['attach_post_key'] : md5( microtime() );
		
		// Add Navigation
		$this->registry->output->addNavigation( $this->settings['classifieds_public_name'], 'app=classifieds', 'classifieds', 'index' );
		
		// Which section are we looking for?
		switch(ipsRegistry::$request['do']) {
			
			case 'cat' :
				$this->chooseCategory();
				break;
							
			case 'add' :
				$this->listingForm( 'add' );
				break;
			
			case 'edit' :
				$this->listingForm( 'edit' );
				break;
			
			case 'doadd' :
				$this->listingSave( 'add' );
				break;
			
			case 'doedit' :
				$this->listingSave( 'edit' );
				break;
			
			case 'renew' :
				$this->renewalForm();
				break;
			
			case 'dorenew' :
				$this->renewalSave();
				break;
			
			default :
				$this->listingForm();
				break;
		}
		
		if ($this->registry->output->getTitle() == "") {
			$this->registry->output->setTitle( $this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] );
		}
		
		$this->registry->output->addToDocumentHead( 'raw', "<link rel='stylesheet' type='text/css' title='Main' media='screen' href='public/style_css/master_css/classifieds_styles.css' />" );
		$this->registry->output->addContent( $this->output );
        $this->registry->output->addContent( base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpyaWdodDtmb250LXNpemU6MC45ZW07JyBjbGFzcz0naXBzUGFkIGNsZWFyJz5Qb3dlcmVkIGJ5IDxhIGhyZWY9J2h0dHA6Ly9kZXYubWlsbG5lLmNvbS9saW5rL2NsYXNzaWZpZWRzLyc+Q2xhc3NpZmllZHM8L2E+PC9kaXY+"));
		$this->registry->output->sendOutput();
	}
	
	/**
	 * Choose the category
	 *
	 * @param	string		$type		Type of form[new|edit]
	 * @param	string		$error		Error to show in the form
	 * @return	@e void
	 */	
	protected function chooseCategory()
	{
		
		// Error?
		$error = "";
		
		if ($this->request['error'] == 1) {
			$error = $this->lang->words['cfds_no_list_in_cat'];
		}
		
		//-------------------------------------------
		// Grab categories for dropdown
		//-------------------------------------------
		
		$jumpList = $this->categories->buildJumpList(false, false, true);
		array_unshift($jumpList, array(0, $this->lang->words['cfds_select_cat']));
		
        $form['category'] = $this->categories->formDropdown('category_id', $jumpList, $this->request['category_id']);

		//-------------------------------------------
		// And output
		//-------------------------------------------
		
        $this->registry->output->addNavigation( $this->lang->words['cfds_listing_new_item'], '' );
        
		$this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->chooseCategory( $form, $error );
		
		$this->registry->output->setTitle( $this->settings['board_name'] );
	}	
	
	function listingForm($type = 'add') {
		
		$form = array();
		
		if ($type == 'edit') {
			
			$item = $this->items->getItemById( intval( $this->request['item_id']) );
			
			// Set post key
			$this->post_key = $item['post_key'];
			
			// Check member can list
			$this->canEdit( $item );
			
			$this->registry->output->addNavigation( $this->lang->words['cfds_editing'] . ' ' . $item['name'], '' );
			
			$form['formcode'] = 'doedit';
			$form['button'] = $this->lang->words['cfds_edit_item'];
			
			// Set title
			$this->registry->output->setTitle( $this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_editing'] . ' ' . $item['name'] );
		
		} else {
			
			$item['category_id'] = intval( $this->request['category_id'] );
			
			// Check not a guest and group has permission to list
			$this->canList( $item );
			
			$this->registry->output->addNavigation( $this->lang->words['cfds_listing_new_item'], '' );
			
			// Build The packages options
			$packages = $this->registry->classifieds->helper( 'packages' )->getPackages( true, true );
			
			if (! $packages) {
				$this->registry->getClass( 'output' )->showError( $this->lang->words['cfds_no_packages'], '20CFDM2004', false );
			}
			
			$form['formcode'] = 'doadd';
			$form['button'] = $this->lang->words['cfds_add_item_button'];
		}
		
		// We need the category
		if ($item['category_id']) {    
			$category = $this->categories->getNode( $item['category_id'] );
		}
		
		//If we're adding check it's a leaf or redirect to category form
		if ($type == 'add' && !$this->categories->isLeaf($category)) {
			$this->registry->output->silentRedirect( $this->settings['base_url']."app=classifieds&amp;module=listing&amp;do=cat&amp;error=1" );
        	
		}
			
		// Get fields
		// Load custom field library
		$this->fields = $this->registry->classifieds->helper( 'fields' );
			
		$fields = $this->fields->getFieldsByItemId( $item['item_id'], true, $category );
		
		//-----------------------------------------
		// Load attachments so we get some stats
		//-----------------------------------------
		

		require_once(IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php');
		$class_attach = new class_attach( $this->registry );
		$class_attach->type = 'classifieds';
		$class_attach->attach_post_key = $this->post_key;
		$class_attach->init();
		$class_attach->getUploadFormSettings();
		
		$form['uploadForm'] =($this->memberData['g_classifieds_attach_max'] != - 1) ? $this->registry->getClass( 'output' )->getTemplate( 'classifieds' )->uploadForm( $this->post_key, 'classifieds', $class_attach->attach_stats, intval( $item['item_id'] ) ) : "";
		
		/* Show description in editor, get editor */
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$_editor = new $classToLoad();
		
		$_editor->setAllowBbcode( true );
		$_editor->setAllowSmilies( true );
		$_editor->setAllowHtml( false );
		
		/* Set content in editor */
		$editor = $_editor->show( 'description', array(), $item['description'] );
		
		// Set title
		$this->registry->output->setTitle( $this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_listing_new_item'] );

		$this->output .= $this->registry->getClass( 'output' )->getTemplate( 'classifieds' )->listing_form( $item, $form, $type, $editor, $fields, $this->post_key, $packages, $category );
	}
	
	function listingSave($type = 'add') {

		//validate
		$name = trim( IPSText::stripslashes( $this->request['name'] ) );
		
		/* Clean */
		if( $this->settings['cfds_ucwords'] )
		{
			if( function_exists('mb_convert_case') )
			{
				if( in_array( strtolower( $this->settings['gb_char_set'] ), array_map( 'strtolower', mb_list_encodings() ) ) )
				{
					$name = mb_convert_case( $name, MB_CASE_TITLE, $this->settings['gb_char_set'] );
				}
				else
				{
					$name = ucwords( strtolower($name) );
				}
			}
			else
			{
				$name = ucwords( strtolower($name) );
			}
		}
		
		if ((IPSText::mbstrlen( $name ) < 2) or(! $name)) {
			$this->registry->output->showError( $this->lang->words['cfds_name_too_short'], '10CFDM2005' );
		}
		
		if (IPSText::mbstrlen( $name ) > 64) {
			$this->registry->output->showError( $this->lang->words['cfds_name_too_long'], '10CFDM2006' );
		}
		
		// Build seo title
		$seo_title = IPSText::makeSeoTitle( $name );
		
		$adtype = intval( $this->request['advert_type'] );
		
		
		$price = floatval(trim( $this->request['price'] ));
		
		if (!is_numeric( $price )) {
			$this->registry->output->showError( $this->lang->words['cfds_invalid_price'], '10CFDM2008' );
		}
		
		// Check category exists
		$category = $this->categories->getNode( intval( $this->request['category_id'] ) );
		
		// Check category is a leaf node
		if ($type == 'add' && !$this->categories->isLeaf($category)) {
			$this->registry->output->showError( $this->lang->words['cfds_no_list_in_cat'], '10CFDM2009' );
		}
		
		$description = trim( nl2br( IPSText::stripslashes( $this->request['description'] ) ) );
		
		// Check description length
		if (IPSText::mbstrlen( $description ) >($this->settings['max_post_length'] * 1024)) {
			$this->registry->output->showError( $this->lang->words['cfds_desc_too_long'], '10CFDM2010' );
		}
		
		if ((IPSText::mbstrlen( $description ) < 1) or(! $description)) {
			$this->registry->output->showError( $this->lang->words['cfds_no_desc'], '10CFDM2011' );
		}
		
		// Do we require an image?
		if ($this->settings['classifieds_must_have_image']) {
			
			$count = $this->DB->buildAndFetch( array('select' => 'count(*) as count', 'from' => array('attachments' => 'a' ), 'where' => "a.attach_rel_module='classifieds' AND a.attach_post_key = '{$this->post_key}'" ) );
			
			if ($count['count'] < 1) {
				$this->registry->output->showError( $this->lang->words['cfds_no_image'], '10CFDM2012' );
			}
		}
		
		// Validate custom fields
		// get fields
		

		$validatefields = $this->fields->getFlatFields( $category );
		
		if (count( $validatefields )) {
			
			foreach( $validatefields as $field ) {
				$key = "custom-" . $field['field_id'];
				$field['value'] = IPSText::stripslashes( trim( $this->request[$key] ) );
				
				// check for required field
				

				if ($field['required'] && $field['value'] == "") {
					$this->registry->getClass( 'output' )->showError( sprintf( $this->lang->words['cfds_empty_field'], $field['title'] ), '10CFDM2013', false );
				}
				
				$fields[] = $field;
			}
		}
		
		
		
		/* Format description */
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
		$editor = new $classToLoad();
		
		$editor->setAllowBbcode( true );
		$editor->setAllowSmilies( true );
		$editor->setAllowHtml( false );
		
		$editor_content = $editor->process( $_POST['description'] );
		
		// Process editor
		IPSText::getTextClass( 'bbcode' )->parse_html = 0;
		IPSText::getTextClass( 'bbcode' )->parse_smilies = 1;
		IPSText::getTextClass( 'bbcode' )->parse_bbcode = 1;
		IPSText::getTextClass( 'bbcode' )->parsing_section = 'classifieds_description';
		
		$description = IPSText::getTextClass( 'bbcode' )->preDbParse( $editor_content );
		
		$current_time = IPSTime::getTimestamp();
		
		if ($type == 'add') {
			
			// Has selected a package?
		
			$package = trim( $this->request['package'] );
		
			if (! is_numeric( $package )) {
				$this->registry->output->showError( $this->lang->words['cfds_no_package_selected'], '10CFDM2025' );
			}
			
			$this->canList( $item );
			
			// Check not a double post
			

			$this->DB->buildAndFetch( array('select' => '*', 'from' => 'classifieds_items', 'where' => 'post_key = "' . $this->post_key . '"' ) );
			
			if ($this->DB->getTotalRows() != 0) {
				$this->registry->output->showError( "Double post error", '10CFDM2014' );
			}
			
			// Which package did they choose?
			$package = $this->registry->classifieds->helper( 'packages' )->getPackageByID( intval($this->request['package']) );

			//sms service code
			//require_once(IPSLib::getAppDir( 'classifieds' ).'/sms_fns.php');
			$code = $this->request['sms_code'];
			if(!$code)
				$this->registry->output->showError( $this->lang->words['cfds_no_sms_code'], '10CFDM2025' );
			
			$service_text = $this->request['service_text'];
			if(valid_code($service_text, $code))
				use_code($service_text, $code);
			else
				$this->registry->output->showError( $this->lang->words['cfds_sms_code_not_valid'], '10CFDM2026' );

			$db_arr = array(
				'member_id' => $this->memberData['member_id'], 
				'name' => $name, 
				'description' => $description, 
				'category_id' => intval( $category['category_id'] ), 
				'price' => $price, 
				'advert_type' => $adtype, 
				'date_added' => $current_time, 
				'date_updated' => $current_time, 
				'date_expiry' => $current_time +(intval( $package['duration'] ) * 86400), 
				'post_key' => $this->post_key, 
				'seo_title' => $seo_title, 
				'package' => intval( $package['package_id'] ), 
				'package_info' => serialize( $package ), 
				'enhancements' => serialize($package['enhancements']),
				'featured' => $package['enhancements']['feature'],
				'open' => 1, 
			);
			
			$this->DB->insert( 'classifieds_items', $db_arr );
			$item_id = $this->DB->getInsertId();
		
		} else {
			
			// Grab Item
			
			$item = $this->items->getItemById( intval( $this->request['item_id'] ) );
			$item_id = $item['item_id'];
			
			$this->canEdit( $item );
			
			$db_arr = array('name' => $name, 'description' => $description, 'category_id' => intval( $category['category_id'] ), 'advert_type' => $adtype, 'price' => doubleval( $price ), 'date_updated' => $current_time, 'seo_title' => $seo_title );
			
			$this->DB->update( 'classifieds_items', $db_arr, 'item_id = ' . intval( $item_id ) );
		}
		
		//-----------------------------------------
		// Make attachments "permanent"
		//-----------------------------------------
		

		$this->makeAttachmentsPermanent( $this->post_key, $item_id, 'classifieds', array('item_id' => $item_id ) );
		
		// Process custom fields
		if ($fields) {
			foreach( $fields as $field ) {
				
				$db_arr = array('field_id' => intval( $field['field_id'] ), 'value' => $field['value'], 'item_id' => intval( $item_id ) );
				
				// Check field entry exists as new field may have been created after listing.
				

				$this->DB->buildAndFetch( array('select' => '*', 'from' => 'classifieds_field_entries', 'where' => 'field_id = ' . $field['field_id'] . ' AND item_id = ' . $item_id ) );
				
				if ($this->DB->getTotalRows() == 0) {
					$this->DB->insert( 'classifieds_field_entries', $db_arr );
				} else {
					$this->DB->update( 'classifieds_field_entries', $db_arr, 'field_id = ' . intval( $field['field_id'] ) . ' AND item_id = ' . intval( $item_id ) );
				}
			}
		}
		
		// Do the output stuff
		if ($type == 'add') {
			
			// What's the damage?

			switch($package['pricing_format']) {
				
				case 'flat' :
					$final_price = $package['price'];
					break;
			
				case 'value' :
					$final_price = $this->registry->classifieds->helper( 'packages' )->calculatePrice($price, $package['rates'], 'base');
					break;
			
				default :
					$price = $package['price'];
					break;
				
			}
			
			// Do we need to pay?
			if ($final_price > 0) {
				
				if (! IPSLib::appIsInstalled( 'nexus' )) {
					$this->registry->output->showError( 'error_generic', '10CFDM2015', null, null, 500 );
				}
				
				//-----------------------------------------
				// Generate Invoice
				//-----------------------------------------
				

				require_once(IPSLib::getAppDir( 'nexus' ) . '/sources/nexusApi.php');
				
				try {
					$invoice = nexusApi::generateInvoice( $name, $this->memberData['member_id'], array(array('act' => 'new', 'app' => 'classifieds', 'type' => 'new_classified', 'cost' => $final_price, 'tax' => $package['tax_class'], 'physical' => FALSE, 'itemName' => "Listing fee for Classifieds Item - " . $name, 'itemID' => $item_id, 'itemURI' => "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item_id ) ) );
				} catch( Exception $e ) {
					$this->registry->output->showError( "An error occurred while trying to generate your invoice. Please try again or contact an administrator.({$e->getMessage()})", '10CFDM2016' );
				}
				
				//-----------------------------------------
				// Boink
				//-----------------------------------------
				

				$this->registry->getClass( 'output' )->silentRedirect( $this->settings['base_url'] . 'app=nexus&amp;module=payments&amp;section=pay&amp;id=' . $invoice );
			} else {
				
				// We don't need to pay so better activate the listing and send notifications
				$this->DB->update( 'classifieds_items', array('active' => 1 ), 'item_id = ' . intval( $item_id ) );
				
				// Send notifications
				$this->registry->classifieds->sendNotifications( $item_id, $name, $seo_title, $category['category_id'], $category['name'] );
				
				$this->registry->output->redirectScreen( $this->lang->words['cfds_item_added'], $this->settings['base_url'] . "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item_id, $seo_title , "view_item" );
			}
		} else {
			$this->registry->output->redirectScreen( $this->lang->words['cfds_item_edited'], $this->settings['base_url'] . "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item_id, $seo_title , "view_item" );
		}
	}
	
	// Convert temp uploads into permanent
	

	protected function makeAttachmentsPermanent($post_key = "", $rel_id = "", $rel_module = "", $args = array()) {
		$cnt = array('cnt' => 0 );
		
		//-----------------------------------------
		// Attachments: Re-affirm...
		//-----------------------------------------
		

		require_once(IPSLib::getAppDir( 'core' ) . '/sources/classes/attach/class_attach.php');
		$class_attach = new class_attach( $this->registry );
		$class_attach->type = $rel_module;
		$class_attach->attach_post_key = $post_key;
		$class_attach->attach_rel_id = $rel_id;
		$class_attach->init();
		
		// Build the square thumb and medium image
		

		$return = $class_attach->postProcessUpload( $args );
		
		return intval( $return['count'] );
	}
	
	function renewalForm() {
		
		$item_id = $this->request['item_id'] ? intval( $this->request['item_id'] ) : 0;
		$item = $this->items->getItemById( $item_id );
		
		// Validate renewal
		$this->canRenew( $item );
		
		// Build breadcrumb
		$this->registry->output->addNavigation( $this->lang->words['cfds_renewing'] . ' ' . $item['name'], '' );
		
		// Build form options
		$form['formcode'] = 'dorenew';
		$form['button'] = $this->lang->words['cfds_renew_item'];
		
		// Set title
		$this->registry->output->setTitle( $this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . $this->lang->words['cfds_renewing'] . ' ' . $item['name'] );
		
		$this->output .= $this->registry->getClass( 'output' )->getTemplate( 'classifieds' )->renewal_form( $item, $form );
	}
	
	function renewalSave() {
		
		$item_id = $this->request['item_id'] ? intval( $this->request['item_id'] ) : 0;
		$item = $this->items->getItemById( $item_id );
		
		// Validate renewal
		$this->canRenew( $item );
		
		$price = floatval(trim( $this->request['price'] ));
		//$price = $this->registry->classifieds->price_to_float($price);
		
		if (! is_numeric( $price )) {
			$this->registry->output->showError( $this->lang->words['cfds_invalid_price'], '10CFDM2017' );
		}

				$db_arr = array('price' => doubleval( $price ), 
				'date_added' => IPSTime::getTimestamp(), 
				'date_updated' => IPSTime::getTimestamp(), 
				'date_expiry' => IPSTime::getTimestamp() + ($item['package_info']['duration'] * 86400), 
				'open' => 1, 
				'active' => 0, 
				'renewals' => $item['renewals'] + 1 );
		
		$this->DB->update( 'classifieds_items', $db_arr, 'item_id = ' . intval( $item['item_id'] ) );
			
				switch($package['pricing_format']) {
				
				case 'flat' :
					$final_price = $item['package_info']['renewal_price'];
					break;
			
				case 'value' :
					$final_price = $this->registry->classifieds->helper( 'packages' )->calculatePrice($price, $item['package_info']['rates'], 'renewal');
					break;
			
				default :
					$this->registry->output->showError( "Invalid Pricing Format", '10CFDM2026' );
					break;
				
			}
		
		// Do we need to pay?
		if ($final_price > 0) {
			
			// Get package
			$package = $this->registry->classifieds->helper( 'packages' )->getPackageById( $item['package'] );
			
			if (! IPSLib::appIsInstalled( 'nexus' )) {
				$this->registry->output->showError( 'error_generic', '10CFDM2018', null, null, 500 );
			}
			
			//-----------------------------------------
			// Generate Invoice
			//-----------------------------------------
			

			require_once(IPSLib::getAppDir( 'nexus' ) . '/sources/nexusApi.php');
			
			try {
				$invoice = nexusApi::generateInvoice( $item['name'], $this->memberData['member_id'], array(array('act' => 'new', 'app' => 'classifieds', 'type' => 'renew_classified', 'cost' => $final_price, 'tax' => $package['tax_class'], 'physical' => FALSE, 'itemName' => "Listing renewal fee for Classifieds Item - " . $item['name'], 'itemID' => $item['item_id'], 'itemURI' => "app=classifieds&amp;module=core&amp;do=view_item&amp;item_id=" . $item['item_id'] ) ) );
			} catch( Exception $e ) {
				$this->registry->output->showError( "An error occurred while trying to generate your invoice. Please try again or contact an administrator.({$e->getMessage()})", '10CFDM2019' );
			}
			
			//-----------------------------------------
			// Boink
			//-----------------------------------------
			

			$this->registry->getClass( 'output' )->silentRedirect( $this->settings['base_url'] . 'app=nexus&amp;module=payments&amp;section=pay&amp;id=' . $invoice );
		} else {
			
			// We don't need to pay so better activate the listing and send notifications
			$this->DB->update( 'classifieds_items', array('active' => 1, 'expired' => 0 ), 'item_id = ' . intval( $item['item_id'] ) );
			
			$this->registry->output->redirectScreen( $this->lang->words['cfds_item_renewed'], $this->settings['base_url'] . "app=classifieds&amp;module=manage&amp;do=expired" );
		}
	
	}
	
	private function canRenew($item) {
		
		// Is owner
		if ($this->memberData['member_id'] != $item['member_id']) {
			$this->registry->output->showError( $this->lang->words['cfds_not_owner'], '10CFDM2020' );
		}
		
		// Renewed too many times
		if ($item['renewals'] >= $item['package_info']['max_renewals']) {
			$this->registry->output->showError( $this->lang->words['cfds_too_many_renewals'], '10CFDM2021' );
		}
		
		// Is Expired?
		if ($item['expired'] == 0) {
			$this->registry->output->showError( $this->lang->words['cfds_item_not_expired'], '10CFDM2022' );
		}
		
		return true;
	}
	
	private function canEdit($item) {
		
		if (! $this->memberData['g_classifieds_can_moderate']) {
			
			// Check users group can edit
			if (! $this->memberData['g_classifieds_can_edit_item']) {
				$this->registry->output->showError( $this->lang->words['cfds_cant_edit'], '10CFDM2001', null, null, 403 );
			}
			
			// Check item belongs to user
			if ($this->memberData['member_id'] != $item['member_id']) {
				$this->registry->output->showError( $this->lang->words['cfds_not_own_item_edit'], '10CFDM2002', null, null, 403 );
			}
			
			//Check edit time restriction hasn't lapsed
			if ( ($item['date_added'] +($this->memberData['g_classifieds_edit_time'] * 60) < time()) && ($this->memberData['g_classifieds_edit_time'] != 0) ) {
				$this->registry->output->showError( $this->lang->words['cfds_edit_time_elapsed'], '10CFDM2003' );
			}
		
		}
		
		return true;
	}
	
	private function canList($item) {
		
		if (! $this->memberData['member_id']) {
			$this->registry->output->showError( $this->lang->words['cfds_not_logged_in'], '10CFDM2023' );
		}
		
		if (! $this->memberData['g_classifieds_can_list']) {
			$this->registry->output->showError( $this->lang->words['cfds_cant_list'], '10CFDM2024' );
		}
		
		return true;
	}

}


	function db_payments_connect(){
	
	$result = new mysqli('localhost', 'reklamb_userxtra', '&*V?FD7lJ[84', 'reklamb_xtra');
	if(!$result)
		return false;
	
	$result->query("SET names 'utf8'");
	return $result;
	}
	
	function db_result_to_array($result){
	$res_array = array();
	
	for($count = 0; $row = $result->fetch_assoc(); $count++){
		$res_array[$count] = $row;
		}
	
	return $res_array;
	}
	
	//////////////////////
		
	function valid_code($service_text, $code){
	$conn = db_payments_connect();
	
	$query = "select * from codes where service_text = '$service_text' and code = '$code' and used = 0";
	$result = $conn->query($query);
	if($conn->error) exit($conn->error);
	
	if ($result->num_rows == 1)
		 return true;
	else
		 return false;
	}
	
	////////////////////////
	
	function use_code($service_text, $code){
	$conn = db_payments_connect();
	
	$query = "UPDATE `codes`  
			 SET 
			  `used` = '1'
			 WHERE
			  `code` = '$code' and `service_text` = '$service_text'";
	
	$result = $conn->query($query);
	
	if($conn->error) 
		exit($conn->error);
	}


// end class
?>