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

if (!defined('IN_IPB')) {
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
    exit();
}

class public_classifieds_manage_manage extends ipsCommand {

    public function doExecute(ipsRegistry $registry) {

        // Check not a guest
        if (!$this->memberData['member_id']) {
            $this->registry->output->showError($this->lang->words['cfds_not_logged_in'], '10CFDM3001');
        }
        
        // Load library
        
        $this->items = $this->registry->classifieds->helper('items');

        // Load Languages
        $this->lang->loadLanguageFile(array('public_lang'), 'classifieds');


        // Add Navigation
		$this->registry->output->addNavigation( $this->settings['classifieds_public_name'], 'app=classifieds', 'classifieds', 'index' );
		$this->registry->output->addNavigation( $this->lang->words['cfds_my_classifieds'], '' );
		
        // Which section are we looking for?
        switch (ipsRegistry::$request['do']) {
        	
        	case 'active':
                $this->viewActive();
                break;

            case 'expired':
                $this->viewExpired();
                break;

            default:
                $this->viewActive();
                break;
        }

        if ($this->registry->output->getTitle() == "") {
            $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name']);
        }

        
        $this->registry->output->addToDocumentHead('raw', "<link rel='stylesheet' type='text/css' title='Main' media='screen' href='public/style_css/master_css/classifieds_styles.css' />");
        $this->registry->output->addContent($this->output);
        $this->registry->output->addContent( base64_decode("PGRpdiBzdHlsZT0ndGV4dC1hbGlnbjpyaWdodDtmb250LXNpemU6MC45ZW07JyBjbGFzcz0naXBzUGFkIGNsZWFyJz5Qb3dlcmVkIGJ5IDxhIGhyZWY9J2h0dHA6Ly9kZXYubWlsbG5lLmNvbS9saW5rL2NsYXNzaWZpZWRzLyc+Q2xhc3NpZmllZHM8L2E+PC9kaXY+"));
        $this->registry->output->sendOutput();

    }

    
    function viewActive() {
      
        // Set title
        $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . 'Manage Classifieds');

        // Filters
        
        $filters = array();
        
        $filters[] = "i.member_id = " . $this->memberData['member_id'];
        $filters[] = "i.expired = 0";   	
        
        // Grab items    
 		$items = $this->items->getItems('', '', TRUE, $order, $filters);

        $total_items = $this->items->countItems('', $filters);

        //-----------------------------------------
        // Start Pagination
        //-----------------------------------------

        $after_magic_quote .= "&amp;do=active";

        $pages = $this->registry->output->generatePagination( array(
                'totalItems'  		  => $total_items,
                'itemsPerPage'    	  => (intval($this->settings['classifieds_items_per_page']) < 1) ? 10 : $this->settings['classifieds_items_per_page'],
                'currentStartValue'       => ipsRegistry::$request['st'],
                'baseUrl'                 => "app=classifieds&amp;module=manage" .$after_magic_quote,
                )		);        
        $this->registry->output->addNavigation( $this->lang->words['cfds_active_adverts'], '' );
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds_manage')->items($items, $pages);
    }
    
    function viewExpired() {
      
        // Set title
        $this->registry->output->setTitle($this->settings['board_name'] . ' -> ' . $this->settings['classifieds_public_name'] . ' -> ' . 'Manage Classifieds');
        
        // Filters
        
        $filters = array();
        
        $filters[] = "i.member_id = " . $this->memberData['member_id'];
        $filters[] = "i.expired = 1";   	
        
        // Grab items    
 		$items = $this->items->getItems('', '', TRUE, $order, $filters);

        $total_items = $this->items->countItems('', $filters);

        //-----------------------------------------
        // Start Pagination
        //-----------------------------------------

        $after_magic_quote .= "&amp;do=expired";

        $pages = $this->registry->output->generatePagination( array(
                'totalItems'  		  => $total_items,
                'itemsPerPage'    	  => (intval($this->settings['classifieds_items_per_page']) < 1) ? 10 : $this->settings['classifieds_items_per_page'],
                'currentStartValue'       => ipsRegistry::$request['st'],
                'baseUrl'                 => "app=classifieds&amp;module=manage" .$after_magic_quote,
                )		);   
        $this->registry->output->addNavigation( $this->lang->words['cfds_expired_adverts'], '' );
        $this->output .= $this->registry->getClass('output')->getTemplate('classifieds_manage')->items($items, $pages);
    }


} // end class

?>