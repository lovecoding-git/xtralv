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

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class public_classifieds_moderate_moderate extends ipsCommand
{
	/**
	 * Stored temporary output
	 *
	 * @var 	string 				Page output
	 */
	protected $output				= "";


	/**
	 * Message to show on the mod CP
	 *
	 * @var 	string
	 */
	protected $message				= "";

	/**
	 * Main class entry point
	 *
	 * @param	object		ipsRegistry reference
	 * @return	@e void
	 */	
	public function doExecute( ipsRegistry $registry )
	{
		
		
	    //-----------------------------------------
        // Not a mod
        //-----------------------------------------

        if (!$this->memberData['g_classifieds_can_moderate']) {
        	// @todo lang error code
            $this->registry->output->showError( $this->lang->words['cfds_no_permission'], '30CFDM4001' );
        }
			
		//-------------------------------------------
		// Get libraries
		//-------------------------------------------
		
		$this->categories = $this->registry->classifieds->helper('categories');
		$this->items = $this->registry->classifieds->helper('items');

		switch( $this->request['do'] )
		{

			
			case 'multimod':
				$this->_multiModeration();
			break;
			

		}
		
		//-------------------------------------------
		// Print output
		//-------------------------------------------
		
		// @todo lang abstract
		
        $this->registry->output->setTitle( $this->lang->words['cfds_moderate'] . ' - ' . $this->settings['board_name'] );
		$this->registry->output->addContent( $this->output );
        $this->registry->output->addContent( base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpyaWdodDtmb250LXNpemU6MC45ZW07JyBjbGFzcz0naXBzUGFkIGNsZWFyJz5Qb3dlcmVkIGJ5IDxhIGhyZWY9J2h0dHA6Ly9kZXYubWlsbG5lLmNvbS9saW5rL2NsYXNzaWZpZWRzLyc+Q2xhc3NpZmllZHM8L2E+PC9kaXY+"));
		$this->registry->output->sendOutput();
	}
	
	
	/**
	 * File multi-moderation
	 *
	 * @return	@e void
	 */	
	protected function _multiModeration()
	{
		/* Security Check */
		if ( $this->request['secure_key'] != $this->member->form_hash )
		{
			$this->registry->output->showError( $this->lang->words['cfds_no_permission'], '20CFDM4002', null, null, 403 );
		}
		
		$ids	= IPSLib::cleanIntArray( explode( ',', $this->request['selecteditemids'] ) );
		$catid = ($this->request['category_id']) ? intval($this->request['category_id']) : 1;
		$category	= $this->categories->getNode($catid);
		
		if( !is_array($ids) OR !count($ids) )
		{
			$this->registry->output->showError( 'error_generic', '20CFDM4003', null, null, 404 );
		}
		
		
		if( $this->request['doaction'] == 'move' AND !$this->request['moveto'] )
		{
			$categories = $this->categories->formDropdown('moveto', $this->categories->buildJumpList(), $category['category_id']);
			$this->output .= $this->registry->getClass('output')->getTemplate('classifieds')->moderateSelectCategory( $categories );
			return;
		}
		

		switch( $this->request['doaction'] )
		{
			case 'del':
				
				$cnt			= $this->items->deleteItems( $ids );
				$this->message	.= sprintf( $this->lang->words['cfds_items_deleted'], $cnt );
			break;
			
			case 'move':
				
				$cnt			= $this->items->moveItems( $ids, intval($this->request['moveto']) );
				$this->message	.= sprintf( $this->lang->words['cfds_items_moved'], $cnt );
				
			break;
			
			case 'feature':
				
				$cnt			= $this->items->featureItems( $ids );
				$this->message	.= sprintf( $this->lang->words['cfds_items_featured'], $cnt );
				
			break;		

			case 'unfeature':
				
				$cnt			= $this->items->unfeatureItems( $ids );
				$this->message	.= sprintf( $this->lang->words['cfds_items_unfeatured'], $cnt );
				
			break;				
			
			
			default:
				$this->registry->output->showError( 'error_generic', '20CFDM4004');
			break;
		}
		
		IPSCookie::set('modcfdsids', '', 0);

		$this->registry->output->redirectScreen( $this->message, $this->settings['base_url'] . "app=classifieds&amp;module=core&amp;do=view_category&amp;category_id={$category['category_id']}", $category['seo_title'], 'view_category' );
	}

	

}